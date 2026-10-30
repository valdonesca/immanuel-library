<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../validations/category-validation.php';require_once __DIR__.'/../../repositories/category-repository.php';requireRole('admin');
if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['store']))redirect('/pages/categories/index.php');
$data=['name'=>trim($_POST['name']??''),'description'=>trim($_POST['description']??'')] ;

$errors=validateCategory($data);if($errors){setErrors($errors,$data);redirect('/pages/categories/create.php');}
saveCategory($data);setFlash('success','Kategori berhasil ditambahkan.');redirect('/pages/categories/index.php');
