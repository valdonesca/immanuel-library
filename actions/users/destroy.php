<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../repositories/user-repository.php';requireRole('admin');
$id=(int)($_GET['id']??0);$user=getUserById($id);if(!$user){setFlash('error','Pengguna tidak ditemukan.');redirect('/pages/users/index.php');}
if($id===(int)currentUser()['id']){setFlash('error','Anda tidak dapat menghapus akun sendiri.');redirect('/pages/users/index.php');}
deleteUser($id);setFlash('success','Pengguna berhasil dihapus.');redirect('/pages/users/index.php');
