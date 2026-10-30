<?php
require_once __DIR__ . '/../config/database.php';
function getAuthors(string $search=''): array {global $pdo;$s=$pdo->prepare("SELECT a.id,a.name,a.bio,COUNT(ba.book_id) AS total_books FROM authors a LEFT JOIN book_author ba ON ba.author_id=a.id WHERE (:q='' OR a.name LIKE :likeq) GROUP BY a.id ORDER BY a.name");$s->execute(['q'=>$search,'likeq'=>"%{$search}%"]);return $s->fetchAll();}
function getAuthorById(int $id): ?array {global $pdo;$s=$pdo->prepare("SELECT a.id,a.name,a.bio,COUNT(ba.book_id) AS total_books FROM authors a LEFT JOIN book_author ba ON ba.author_id=a.id WHERE a.id=? GROUP BY a.id");$s->execute([$id]);return $s->fetch()?:null;}
function saveAuthor(array $d,?int $id=null): void {global $pdo;if($id){$s=$pdo->prepare("UPDATE authors SET name=?,bio=? WHERE id=?");$s->execute([$d['name'],$d['bio'],$id]);}else{$s=$pdo->prepare("INSERT INTO authors(name,bio) VALUES(?,?)");$s->execute([$d['name'],$d['bio']]);}}
function deleteAuthor(int $id): void {global $pdo;$s=$pdo->prepare("DELETE FROM authors WHERE id=?");$s->execute([$id]);}
