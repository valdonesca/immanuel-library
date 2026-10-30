<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../validations/auth-validation.php';require_once __DIR__.'/../../repositories/user-repository.php';
if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['register']))redirect('/pages/auth/register.php');
$data=['name'=>trim($_POST['name']??''),'email'=>trim($_POST['email']??''),'password'=>$_POST['password']??'','password_confirmation'=>$_POST['password_confirmation']??''];
$errors=validateRegister($data);if($errors){setErrors($errors,$data);redirect('/pages/auth/register.php');}
try{$id=createUser(['name'=>$data['name'],'email'=>$data['email'],'password'=>password_hash($data['password'],PASSWORD_DEFAULT),'role'=>'member']);$user=getUserById($id);loginUser($user);setFlash('success','Akun berhasil dibuat.');redirect(HOME_PATH);}catch(PDOException $e){setErrors(['email'=>'Email sudah digunakan.'],$data);redirect('/pages/auth/register.php');}
