<?php
require_once __DIR__ . '/../../helpers/auth.php';
require_once __DIR__ . '/../../validations/book-validation.php';
require_once __DIR__ . '/../../repositories/book-repository.php';
requireRole('admin');
if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['store'])) redirect('/pages/books/index.php');
$data=['title'=>trim($_POST['title']??''),'isbn'=>trim($_POST['isbn']??''),'year'=>trim($_POST['year']??''),'stock'=>trim($_POST['stock']??''),'category_id'=>trim($_POST['category_id']??''),'description'=>trim($_POST['description']??''),'author_ids'=>$_POST['author_ids']??[]];
$errors=validateBook($data);if($errors){setErrors($errors,$data);redirect('/pages/books/create.php');}
saveBook($data);setFlash('success','Buku berhasil ditambahkan.');redirect('/pages/books/index.php');
