<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';

$flash = pullFlash();
$pageTitle = 'Katalog Produk';
require __DIR__ . '/components/header.php';


require __DIR__ . '/components/footer.php';

?>
<!DOCTYPE html>
<html lang="id" data-theme="<?= e($theme) ?>">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Katalog Produk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #222;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        h1 {
            text-align: center;
        }

        .cart {
            text-align: right;
            margin-bottom: 20px;
        }

        .produk {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .harga {
            font-weight: bold;
            color: #198754;
        }

        button {
            background: #198754;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #146c43;
        }

        .flash {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #0d6efd;
        }

        [data-theme="dark"] {
            background: #121212;
            color: white;
        }

        [data-theme="dark"] .card {
            background: #1e1e1e;
            color: white;
        }

        [data-theme="dark"] .cart a {
            color: #6ea8fe;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Katalog Produk</h1>

    <div class="cart">
        <a href="cart.php">
            🛒 Keranjang:
            <?= cartCount($_SESSION['cart']) ?>
        </a>
    </div>

    <div style="text-align: center; margin-bottom: 20px;">

        <form method="post" action="actions.php">

            <input
                type="hidden"
                name="action"
                value="theme"
            >

            <button type="submit" name="theme" value="light">
                ☀️ Tema Terang
            </button>

            <button type="submit" name="theme" value="dark">
                🌙 Tema Gelap
            </button>

        </form>

    </div>

    <?php if ($flash !== null): ?>

        <div class="flash">
            <?= e($flash) ?>
        </div>

    <?php endif; ?>

    <div class="produk">

        <?php foreach ($products as $id => $product): ?>

            <div class="card">

                <h2>
                    <?= e($product['nama']) ?>
                </h2>

                <p class="harga">
                    Rp <?= number_format(
                        $product['harga'],
                        0,
                        ',',
                        '.'
                    ) ?>
                </p>

                <form method="post" action="actions.php">

                    <input
                        type="hidden"
                        name="action"
                        value="add"
                    >

                    <input
                        type="hidden"
                        name="id"
                        value="<?= (int) $id ?>"
                    >

                    <button type="submit">
                        Tambah ke Keranjang
                    </button>

                </form>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>