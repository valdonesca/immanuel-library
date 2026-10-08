<?php require_once '../../config/bootstrap.php';
logoutUser();
session_start();
flash('Anda sudah keluar.');
redirect('../../pages/auth/login.php');
