<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../validations/user-validation.php';require_once __DIR__.'/../../repositories/user-repository.php';requireRole('admin');
if($_SERVER['REQUEST_METHOD']!=='POST'||!isset($_POST['update']))redirect('/pages/users/index.php');
$id=(int)($_POST['id']??0);$user=getUserById($id);if(!$user){setFlash('error','Pengguna tidak ditemukan.');redirect('/pages/users/index.php');}
$data=['name'=>trim($_POST['name']??''),'email'=>trim($_POST['email']??''),'role'=>$_POST['role']??''];$errors=validateUser($data,$id);
if($id===(int)currentUser()['id']&&$data['role']!==currentUser()['role'])$errors['role']='Anda tidak dapat mengubah role akun sendiri.';
if($errors){setErrors($errors,$data);redirect('/pages/users/edit.php?id='.$id);}
try{updateUser($data,$id);if($id===(int)currentUser()['id']){$_SESSION['user']['name']=$data['name'];$_SESSION['user']['email']=$data['email'];}setFlash('success','Pengguna berhasil diperbarui.');redirect('/pages/users/index.php');}catch(PDOException $e){setErrors(['email'=>'Email sudah digunakan.'],$data);redirect('/pages/users/edit.php?id='.$id);}
