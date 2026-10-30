<?php
require_once __DIR__ . '/../config/database.php';
function getCategories(string $search=''): array {global $pdo;$s=$pdo->prepare("SELECT c.id,c.name,c.description,COUNT(b.id) AS total_books FROM categories c LEFT JOIN books b ON b.category_id=c.id WHERE (:q='' OR c.name LIKE :likeq) GROUP BY c.id ORDER BY c.name");$s->execute(['q'=>$search,'likeq'=>"%{$search}%"]);return $s->fetchAll();}
function getCategoryById(int $id): ?array {global $pdo;$s=$pdo->prepare("SELECT c.id,c.name,c.description,COUNT(b.id) AS total_books FROM categories c LEFT JOIN books b ON b.category_id=c.id WHERE c.id=? GROUP BY c.id");$s->execute([$id]);return $s->fetch()?:null;}
function saveCategory(array $d,?int $id=null): void {global $pdo;if($id){$s=$pdo->prepare("UPDATE categories SET name=?,description=? WHERE id=?");$s->execute([$d['name'],$d['description'],$id]);}else{$s=$pdo->prepare("INSERT INTO categories(name,description) VALUES(?,?)");$s->execute([$d['name'],$d['description']]);}}
function deleteCategory(int $id): void {global $pdo;$s=$pdo->prepare("DELETE FROM categories WHERE id=?");$s->execute([$id]);}
