<?php require_once __DIR__ . '/../config/bootstrap.php';
function getUsers(?string $search = null): array
{
    $d = db();
    return array_values(array_map(fn($u) => array_diff_key($u, ['password' => true]), array_filter($d['users'], fn($u) => !$search || stripos($u['name'] . ' ' . $u['email'], $search) !== false)));
}
function getUser(int $id): ?array
{
    $u = findById(db()['users'], $id);
    if ($u)
        unset($u['password']);
    return $u;
}
{
    $u = findById(db()['users'], $id);
    return ['phone' => $u['phone'] ?? '', 'address' => $u['address'] ?? '', 'bio' => $u['bio'] ?? ''];
}
