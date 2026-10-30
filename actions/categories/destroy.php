<?php
require_once __DIR__.'/../../helpers/auth.php';require_once __DIR__.'/../../repositories/category-repository.php';requireRole('admin');
$id=(int)($_GET['id']??0);$item=getCategoryById($id);if(!$item){setFlash('error','Kategori tidak ditemukan.');redirect('/pages/categories/index.php');}
if((int)$item['total_books']>0){setFlash('error','Kategori masih digunakan oleh buku.');redirect('/pages/categories/index.php');}
deleteCategory($id);setFlash('success','Kategori berhasil dihapus.');redirect('/pages/categories/index.php');
