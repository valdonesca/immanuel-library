<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../validations/user-validation.php';require_once __DIR__.'/../../repositories/user-repository.php';requireRole('admin');
if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['store']))redirect('/pages/users/index.php');
$data=['name'=>trim($_POST['name']??''),'email'=>trim($_POST['email']??''),'password'=>$_POST['password']??'','role'=>$_POST['role']??''];
$errors=validateUser($data);if($errors){setErrors($errors,$data);redirect('/pages/users/create.php');}
try{createUser(['name'=>$data['name'],'email'=>$data['email'],'password'=>password_hash($data['password'],PASSWORD_DEFAULT),'role'=>$data['role']]);setFlash('success','Pengguna berhasil ditambahkan.');redirect('/pages/users/index.php');}catch(PDOException $e){setErrors(['email'=>'Email sudah digunakan.'],$data);redirect('/pages/users/create.php');}
