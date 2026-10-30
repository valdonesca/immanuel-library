<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../validations/category-validation.php';require_once __DIR__.'/../../repositories/category-repository.php';requireRole('admin');
if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['update']))redirect('/pages/categories/index.php');
$id=(int)($_POST['id']??0);if(!getCategoryById($id)){setFlash('error','Kategori tidak ditemukan.');redirect('/pages/categories/index.php');}
$data=['name'=>trim($_POST['name']??''),'description'=>trim($_POST['description']??'')];
$errors=validateCategory($data,$id);if($errors){setErrors($errors,$data);redirect('/pages/categories/edit.php?id='.$id);}
saveCategory($data,$id);setFlash('success','Kategori berhasil diperbarui.');redirect('/pages/categories/index.php');
