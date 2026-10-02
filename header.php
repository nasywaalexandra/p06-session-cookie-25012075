<?php
$pageTitle = $pageTitle ?? 'Keranjang Session';
?>

<!DOCTYPE html>
<html lang="id" data-theme="<?= e($theme) ?>">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title><?= e($pageTitle) ?></title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #222;
            margin: 0;
            padding: 0;
        }

        nav {
            background: #198754;
            padding: 15px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding: 30px;
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

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .flash {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        [data-theme="dark"] {
            background: #121212;
            color: white;
        }

        [data-theme="dark"] .card {
            background: #1e1e1e;
            color: white;
        }

        [data-theme="dark"] nav {
            background: #0b5d3b;
        }

        [data-theme="dark"] a {
            color: #6ea8fe;
        }
    </style>
</head>

<body>

<nav>
    <a href="index.php">Katalog</a>

    <a href="cart.php">
        🛒 Keranjang
        (<?= cartCount($_SESSION['cart']) ?>)
    </a>
</nav>

<div class="container">