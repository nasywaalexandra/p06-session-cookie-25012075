<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/functions.php';

$products = require __DIR__ . '/data/products.php';
$flash = pullFlash();

$total = 0;

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Keranjang Belanja</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
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

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #198754;
            color: white;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        button {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .clear {
            background: #dc3545;
            padding: 10px 15px;
        }

        .flash {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        a {
            color: #0d6efd;
            text-decoration: none;
        }

        .actions {
            margin-top: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
        }
    </style>

</head>

<body>

<div class="container">

    <h1>Keranjang Belanja</h1>

    <?php if ($flash !== null): ?>

        <div class="flash">
            <?= e($flash) ?>
        </div>

    <?php endif; ?>

    <?php if (empty($_SESSION['cart'])): ?>

        <div class="card">

            <p>Keranjang masih kosong.</p>

            <a href="index.php">
                Kembali ke katalog
            </a>

        </div>

    <?php else: ?>

        <div class="card">

            <table>

                <thead>

                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                <?php foreach ($_SESSION['cart'] as $id => $qty): ?>

                    <?php

                    if (!isset($products[$id])) {
                        continue;
                    }

                    $qty = (int) $qty;

                    $subtotal =
                        $products[$id]['harga'] * $qty;

                    $total += $subtotal;

                    ?>

                    <tr>

                        <td>
                            <?= e($products[$id]['nama']) ?>
                        </td>

                        <td>
                            Rp
                            <?= number_format(
                                $products[$id]['harga'],
                                0,
                                ',',
                                '.'
                            ) ?>
                        </td>

                        <td>
                            <?= $qty ?>
                        </td>

                        <td>
                            Rp
                            <?= number_format(
                                $subtotal,
                                0,
                                ',',
                                '.'
                            ) ?>
                        </td>

                        <td>

                            <form
                                method="post"
                                action="actions.php"
                            >

                                <input
                                    type="hidden"
                                    name="action"
                                    value="remove"
                                >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $id ?>"
                                >

                                <button type="submit">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

            <div class="total">

                Total:
                Rp
                <?= number_format(
                    $total,
                    0,
                    ',',
                    '.'
                ) ?>

            </div>

            <div class="actions">

                <form
                    method="post"
                    action="actions.php"
                >

                    <input
                        type="hidden"
                        name="action"
                        value="clear"
                    >

                    <button
                        class="clear"
                        type="submit"
                    >
                        Kosongkan Keranjang
                    </button>

                </form>

                <a href="index.php">
                    Tambah Produk
                </a>

            </div>

        </div>

    <?php endif; ?>

</div>

</body>

</html>