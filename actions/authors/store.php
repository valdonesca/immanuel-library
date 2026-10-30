<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../validations/author-validation.php';require_once __DIR__.'/../../repositories/author-repository.php';requireRole('admin');
if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['store']))redirect('/pages/authors/index.php');
$data=['name'=>trim($_POST['name']??''),'bio'=>trim($_POST['bio']??'')] ;

$errors=validateAuthor($data);if($errors){setErrors($errors,$data);redirect('/pages/authors/create.php');}
saveAuthor($data);setFlash('success','Penulis berhasil ditambahkan.');redirect('/pages/authors/index.php');
