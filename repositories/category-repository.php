<?php require_once __DIR__.'/../config/bootstrap.php';
function getCategories(?string $search=null): array { $d=db(); return array_values(array_filter($d['categories'],fn($c)=>!$search||stripos($c['name'].' '.$c['description'],$search)!==false)); }
function getCategory(int $id): ?array { return findById(db()['categories'],$id); }
