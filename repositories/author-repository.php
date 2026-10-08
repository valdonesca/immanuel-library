<?php require_once __DIR__ . '/../config/bootstrap.php';
function getAuthors(?string $search = null): array
{
    $d = db();
    return array_values(array_filter($d['authors'], fn($a) => !$search || stripos($a['name'] . ' ' . $a['bio'], $search) !== false));
}
function getAuthor(int $id): ?array
{
    return findById(db()['authors'], $id);
}
