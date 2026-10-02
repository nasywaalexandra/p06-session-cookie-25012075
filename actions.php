<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$action = $_POST['action'] ?? '';

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);
/*
|--------------------------------------------------------------------------
| Mengubah tema
|--------------------------------------------------------------------------
*/

if ($action === 'theme') {

    $candidate = $_POST['theme'] ?? '';

    if (in_array($candidate, ['light', 'dark'], true)) {

        setcookie('theme', $candidate, [
            'expires' => time() + 60 * 60 * 24 * 30,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        setFlash('Tema berhasil disimpan.');

    } else {

        setFlash('Tema tidak valid.');
    }

    header('Location: index.php');
    exit;
}

/*
|--------------------------------------------------------------------------
| ID Produk
|--------------------------------------------------------------------------
*/

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);

/*
|--------------------------------------------------------------------------
| Tambah Produk
|--------------------------------------------------------------------------
*/

if (
    $action === 'add' &&
    $id !== false &&
    $id !== null &&
    isset($products[$id])
) {

    $_SESSION['cart'][$id] =
        ($_SESSION['cart'][$id] ?? 0) + 1;

    setFlash('Produk ditambahkan ke keranjang.');

    header('Location: index.php');
    exit;
}

/*
|--------------------------------------------------------------------------
| Hapus Produk
|--------------------------------------------------------------------------
*/

if (
    $action === 'remove' &&
    $id !== false &&
    $id !== null &&
    isset($_SESSION['cart'][$id])
) {

    unset($_SESSION['cart'][$id]);

    setFlash('Produk dihapus dari keranjang.');

    header('Location: cart.php');
    exit;
}

/*
|--------------------------------------------------------------------------
| Kosongkan Keranjang
|--------------------------------------------------------------------------
*/

if ($action === 'clear') {

    $_SESSION['cart'] = [];

    setFlash('Keranjang dikosongkan.');

    header('Location: cart.php');
    exit;
}

/*
|--------------------------------------------------------------------------
| Request Tidak Valid
|--------------------------------------------------------------------------
*/

setFlash('Permintaan tidak valid.');

header('Location: index.php');
exit;