<?php
session_start();

if (!isset($_SESSION['step'])) {
    $_SESSION['step'] = 0;
    $_SESSION['nama'] = '';
    $_SESSION['umur'] = '';
    $_SESSION['hobi'] = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SESSION['step'] === 0 && isset($_POST['nama'])) {
        $_SESSION['nama'] = trim($_POST['nama']);
        $_SESSION['step'] = 1;
    } elseif ($_SESSION['step'] === 1 && isset($_POST['umur'])) {
        $_SESSION['umur'] = trim($_POST['umur']);
        $_SESSION['step'] = 2;
    } elseif ($_SESSION['step'] === 2 && isset($_POST['hobi'])) {
        $_SESSION['hobi'] = trim($_POST['hobi']);
        $_SESSION['step'] = 3;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Form Bertahap</title>
</head>
<body>

<h1>Form Bertahap</h1>

<?php if ($_SESSION['step'] === 0): ?>
    <form method="post">
        <label for="nama">Nama Anda</label>
        <input type="text" id="nama" name="nama" required autofocus />
        <br />
        <button type="submit">Submit</button>
    </form>

<?php elseif ($_SESSION['step'] === 1): ?>
    <form method="post">
        <label for="umur">Umur Anda</label>
        <input type="number" id="umur" name="umur" min="1" max="120" required autofocus />
        <br />
        <button type="submit">Submit</button>
    </form>

<?php elseif ($_SESSION['step'] === 2): ?>
    <form method="post">
        <label for="hobi">Hobi Anda</label>
        <input type="text" id="hobi" name="hobi" required autofocus />
        <br />
        <button type="submit">Submit</button>
    </form>

<?php else: ?>
    <h2>Data Anda:</h2>
    <p><strong>Nama:</strong> <?= htmlspecialchars($_SESSION['nama']) ?></p>
    <p><strong>Umur:</strong> <?= htmlspecialchars($_SESSION['umur']) ?></p>
    <p><strong>Hobi:</strong> <?= htmlspecialchars($_SESSION['hobi']) ?></p>

    <form method="post" action="">
        <button type="submit" name="reset">Mulai Lagi</button>
    </form>

    <?php
    // Reset session jika tombol mulai lagi ditekan
    if (isset($_POST['reset'])) {
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    ?>
<?php endif; ?>

</body>
</html>
