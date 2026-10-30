<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../validations/auth-validation.php';require_once __DIR__.'/../../repositories/user-repository.php';
if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['login']))redirect(LOGIN_PATH);
$data=['email'=>trim($_POST['email']??''),'password'=>$_POST['password']??''];$errors=validateLogin($data);
if($errors){setErrors($errors,$data);redirect(LOGIN_PATH);}
$user=getUserByEmail($data['email']);$ok=password_verify($data['password'],$user['password']??'$2y$10$fhRn3hZ2.kIJiMZ9JaXQe.l0IcSg9k.OGpf0rB6wSymtAcJ3E31AC');
if(!$user||!$ok){setErrors(['login'=>'Email atau kata sandi salah.'],$data);redirect(LOGIN_PATH);}
loginUser($user);setFlash('success','Selamat datang, '.$user['name'].'!');redirect(HOME_PATH);
