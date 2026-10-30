<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../validations/author-validation.php';require_once __DIR__.'/../../repositories/author-repository.php';requireRole('admin');
if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['update']))redirect('/pages/authors/index.php');
$id=(int)($_POST['id']??0);if(!getAuthorById($id)){setFlash('error','Penulis tidak ditemukan.');redirect('/pages/authors/index.php');}
$data=['name'=>trim($_POST['name']??''),'bio'=>trim($_POST['bio']??'')];
$errors=validateAuthor($data,$id);if($errors){setErrors($errors,$data);redirect('/pages/authors/edit.php?id='.$id);}
saveAuthor($data,$id);setFlash('success','Penulis berhasil diperbarui.');redirect('/pages/authors/index.php');
