<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../validations/profile-validation.php';require_once __DIR__.'/../../repositories/user-repository.php';requireLogin();
if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['update']))redirect('/pages/profile/edit.php');
$id=(int)currentUser()['id'];$data=['name'=>trim($_POST['name']??''),'email'=>trim($_POST['email']??''),'phone'=>trim($_POST['phone']??''),'address'=>trim($_POST['address']??''),'bio'=>trim($_POST['bio']??'')];
$errors=validateProfile($data,$id);if($errors){setErrors($errors,$data);redirect('/pages/profile/edit.php');}
try{updateProfile($data,$id);$_SESSION['user']['name']=$data['name'];$_SESSION['user']['email']=$data['email'];setFlash('success','Profil berhasil diperbarui.');redirect('/pages/profile/edit.php');}catch(PDOException $e){setErrors(['email'=>'Email sudah digunakan.'],$data);redirect('/pages/profile/edit.php');}
