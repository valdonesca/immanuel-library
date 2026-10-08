<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

const DATA_FILE = __DIR__ . '/../data/library.json';

function seedData(): array
{
    $hash = password_hash('password123', PASSWORD_DEFAULT);
    return [
        'users' => [
            ['id' => 1, 'name' => 'Kelvin', 'email' => 'kelvin@immanuel.sch.id', 'password' => $hash, 'role' => 'admin', 'phone' => '081234567890', 'address' => 'Jl. Visi No. 1, Pontianak', 'bio' => 'Administrator Sistem Immanuel Library'],
            ['id' => 2, 'name' => 'Siswa Immanuel', 'email' => 'siswa@immanuel.sch.id', 'password' => password_hash('password123', PASSWORD_DEFAULT), 'role' => 'member', 'phone' => '', 'address' => '', 'bio' => ''],
        ],
        'categories' => [
            ['id' => 1, 'name' => 'Pemrograman', 'description' => 'Buku-buku tentang bahasa pemrograman.'],
            ['id' => 2, 'name' => 'Web Development', 'description' => 'Pengembangan aplikasi berbasis web.'],
            ['id' => 3, 'name' => 'Jaringan Komputer', 'description' => 'Infrastruktur dan konsep jaringan.'],
            ['id' => 4, 'name' => 'Fiksi', 'description' => 'Novel, cerpen, dan karya fiksi.'],
        ],
        'authors' => [
            ['id' => 1, 'name' => 'Andrea Hirata', 'bio' => 'Penulis novel Indonesia.'],
            ['id' => 2, 'name' => 'Tere Liye', 'bio' => 'Penulis novel Indonesia.'],
            ['id' => 3, 'name' => 'J.K. Rowling', 'bio' => 'Penulis seri Harry Potter.'],
            ['id' => 4, 'name' => 'Pramoedya Ananta Toer', 'bio' => 'Sastrawan Indonesia.'],
            ['id' => 5, 'name' => 'Sapardi Djoko Damono', 'bio' => 'Penyair dan sastrawan Indonesia.'],
        ],
        'books' => [
            ['id' => 1, 'title' => 'Laskar Pelangi', 'isbn' => '978-979-3062-79-2', 'year' => 2005, 'stock' => 12, 'category_id' => 4, 'description' => 'Novel tentang persahabatan dan perjuangan pendidikan.', 'author_ids' => [1]],
            ['id' => 2, 'title' => 'Bumi', 'isbn' => '978-602-03-0112-9', 'year' => 2014, 'stock' => 8, 'category_id' => 4, 'description' => 'Novel petualangan fantasi remaja.', 'author_ids' => [2]],
            ['id' => 3, 'title' => 'Harry Potter dan Batu Bertuah', 'isbn' => '978-979-22-1782-8', 'year' => 1997, 'stock' => 5, 'category_id' => 4, 'description' => 'Awal petualangan Harry Potter di dunia sihir.', 'author_ids' => [3]],
            ['id' => 4, 'title' => 'Bumi Manusia', 'isbn' => '978-979-97312-3-4', 'year' => 1980, 'stock' => 6, 'category_id' => 4, 'description' => 'Novel sejarah tentang Minke dan kehidupan Hindia Belanda.', 'author_ids' => [4]],
            ['id' => 5, 'title' => 'Antologi Rasa Nusantara', 'isbn' => '978-602-1234-56-7', 'year' => 2021, 'stock' => 4, 'category_id' => 4, 'description' => 'Kumpulan karya sastra dari penulis Nusantara.', 'author_ids' => [4, 5]],
        ],
    ];
}

function ensureData(): void
{
    if (!is_dir(dirname(DATA_FILE)))
        mkdir(dirname(DATA_FILE), 0775, true);
    if (!file_exists(DATA_FILE))
        file_put_contents(DATA_FILE, json_encode(seedData(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}
function db(): array
{
    ensureData();
    $raw = file_get_contents(DATA_FILE);
    $data = json_decode($raw ?: '', true);
    return is_array($data) ? $data : seedData();
}
function saveDb(array $data): void
{
    file_put_contents(DATA_FILE, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}
function nextId(array $rows): int
{
    return $rows ? max(array_column($rows, 'id')) + 1 : 1;
}
function e(mixed $v): string
{
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
}
function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}
function flash(string $message, string $type = 'success'): void
{
    $_SESSION['flash'] = ['message' => $message, 'type' => $type];
}
function getFlash(): ?array
{
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}
function currentUser(): ?array
{
    $data = db();
    $id = $_SESSION['user_id'] ?? null;
    if (!$id)
        return null;
    foreach ($data['users'] as $u)
        if ((int) $u['id'] === (int) $id)
            return $u;
    return null;
}
function loginUser(int $id): void
{
    session_regenerate_id(true);
    $_SESSION['user_id'] = $id;
}
function logoutUser(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}
function requireLogin(string $loginPath = '../auth/login.php'): array
{
    $u = currentUser();
    if (!$u) {
        flash('Silakan masuk terlebih dahulu.', 'error');
        redirect($loginPath);
    }
    return $u;
}
function findById(array $rows, int $id): ?array
{
    foreach ($rows as $row)
        if ((int) $row['id'] === $id)
            return $row;
    return null;
}
function old(string $key, string $default = ''): string
{
    return e($_POST[$key] ?? $default);
}
