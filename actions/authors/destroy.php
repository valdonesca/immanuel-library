<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../repositories/author-repository.php';requireRole('admin');
$id=(int)($_GET['id']??0);$item=getAuthorById($id);if(!$item){setFlash('error','Penulis tidak ditemukan.');redirect('/pages/authors/index.php');}
if((int)$item['total_books']>0){setFlash('error','Penulis masih digunakan oleh buku.');redirect('/pages/authors/index.php');}
deleteAuthor($id);setFlash('success','Penulis berhasil dihapus.');redirect('/pages/authors/index.php');
