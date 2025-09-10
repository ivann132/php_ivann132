<?php
// Koneksi database
$host = 'localhost';
$db   = 'testdb';
$user = 'root';
$pass = 'password123';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Ambil parameter pencarian
$search = $_GET['search'] ?? '';

// Query dengan join dan filter pencarian
$sql = "
    SELECT p.id, p.nama, p.alamat, GROUP_CONCAT(h.hobi SEPARATOR ', ') AS hobis
    FROM person p
    LEFT JOIN hobi h ON p.id = h.person_id
";

$params = [];
if ($search) {
    $sql .= " WHERE p.nama LIKE :search OR p.alamat LIKE :search OR h.hobi LIKE :search ";
    $params[':search'] = "%$search%";
}

$sql .= " GROUP BY p.id ORDER BY p.id ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$persons = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listing Person dan Hobi</title>
</head>
<body>
    <h2>Daftar Person dan Hobi</h2>

    <form method="get" action="">
        <input type="text" name="search" placeholder="Cari nama, alamat, atau hobi" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">SEARCH</button>
    </form>

    <table border="1" cellpadding="5" cellspacing="0" style="margin-top:10px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Hobi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($persons) > 0): ?>
                <?php foreach ($persons as $person): ?>
                    <tr>
                        <td><?= $person['id'] ?></td>
                        <td><?= htmlspecialchars($person['nama']) ?></td>
                        <td><?= htmlspecialchars($person['alamat']) ?></td>
                        <td><?= htmlspecialchars($person['hobis'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Data tidak ditemukan</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
