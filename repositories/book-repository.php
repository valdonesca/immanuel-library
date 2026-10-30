<?php
require_once __DIR__ . '/../config/database.php';

function getBooks(string $search = '', string $category = ''): array {
    global $pdo;
    $sql = "SELECT b.id,b.title,b.isbn,b.year,b.stock,b.description,b.category_id,
                   c.name AS category
            FROM books b LEFT JOIN categories c ON c.id=b.category_id
            WHERE (:search = '' OR b.title LIKE :like_search)
              AND (:category = '' OR c.name = :category_name)
            ORDER BY b.id DESC";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(['search'=>$search,'like_search'=>"%{$search}%",'category'=>$category,'category_name'=>$category]);
    $books=$stmt->fetchAll();
    $authors=$pdo->query("SELECT ba.book_id,a.id,a.name FROM book_author ba JOIN authors a ON a.id=ba.author_id")->fetchAll();
    $map=[];
    foreach($authors as $a){$map[$a['book_id']]['names'][]=$a['name'];$map[$a['book_id']]['ids'][]=(int)$a['id'];}
    foreach($books as &$b){$b['authors']=$map[$b['id']]['names']??[];$b['author_ids']=$map[$b['id']]['ids']??[];}
    return $books;
}
function getBookById(int $id): ?array {
    global $pdo;
    $s=$pdo->prepare("SELECT b.*,c.name AS category FROM books b LEFT JOIN categories c ON c.id=b.category_id WHERE b.id=?");
    $s->execute([$id]); $b=$s->fetch(); if(!$b)return null;
    $s=$pdo->prepare("SELECT a.id,a.name FROM book_author ba JOIN authors a ON a.id=ba.author_id WHERE ba.book_id=?");
    $s->execute([$id]);$a=$s->fetchAll();$b['author_ids']=array_map('intval',array_column($a,'id'));$b['authors']=array_column($a,'name');
    return $b;
}
function saveBook(array $d, ?int $id=null): int {
    global $pdo; $pdo->beginTransaction();
    try {
        $v=[$d['title'],$d['isbn']?:null,(int)$d['year'],(int)$d['stock'],$d['description'],$d['category_id']?:null];
        if($id){$s=$pdo->prepare("UPDATE books SET title=?,isbn=?,year=?,stock=?,description=?,category_id=? WHERE id=?");$s->execute([...$v,$id]);}
        else{$s=$pdo->prepare("INSERT INTO books(title,isbn,year,stock,description,category_id) VALUES(?,?,?,?,?,?)");$s->execute($v);$id=(int)$pdo->lastInsertId();}
        $pdo->prepare("DELETE FROM book_author WHERE book_id=?")->execute([$id]);
        $s=$pdo->prepare("INSERT INTO book_author(book_id,author_id) VALUES(?,?)");
        foreach(array_unique(array_map('intval',$d['author_ids']??[])) as $aid)$s->execute([$id,$aid]);
        $pdo->commit();return $id;
    } catch(Throwable $e){$pdo->rollBack();throw $e;}
}
function deleteBook(int $id): void {global $pdo;$s=$pdo->prepare("DELETE FROM books WHERE id=?");$s->execute([$id]);}
