<?php
// koneksi.php

$host    = 'localhost';
$db      = 'db_uas_pbo_trpl1a_astriyuliandani';
$user    = 'root'; // Sesuaikan dengan username phpMyAdmin Anda
$pass    = '';     // Sesuaikan dengan password phpMyAdmin Anda
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}