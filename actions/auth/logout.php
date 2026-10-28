<?php
require_once __DIR__ . "/../../helpers/auth.php";

// Logout wajib lewat POST agar tidak bisa dipicu lewat link/gambar dari situs lain.
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
  redirect(HOME_PATH);
}

logoutUser();

// Session lama sudah dihancurkan, mulai session baru untuk pesan flash.
session_start();
setFlash('success', 'Anda telah keluar.');
redirect(LOGIN_PATH);
