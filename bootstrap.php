<?php

declare(strict_types=1);

session_start();

$_SESSION['cart'] ??= [];
$_SESSION['flash'] ??= null;

$allowedThemes = ['light', 'dark'];

$theme = $_COOKIE['theme'] ?? 'light';

if (!in_array($theme, $allowedThemes, true)) {
    $theme = 'light';
}