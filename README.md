<!DOCTYPE html>
<html>
<head>
    <title>README - Web Inventory</title>
</head>
<body>

    <center>
        <h1>DOKUMENTASI SISTEM WEB INVENTORY</h1>
        <p>Aplikasi Manajemen Stok Barang dan Transaksi Keluar/Masuk</p>
    </center>

    <hr>

    <h2>1. Deskripsi Proyek</h2>
    <p>
        Sistem ini adalah aplikasi berbasis web yang digunakan untuk mengelola data inventaris secara real-time. 
        Aplikasi ini mendukung otomatisasi nomor transaksi, pengelolaan data master (barang, supplier, rak), 
        serta sistem pengajuan barang oleh petugas.
    </p>

    <hr>

    <h2>2. Hak Akses & Kredensial</h2>
    <p>Sistem ini memiliki dua level pengguna (role) dengan akses yang berbeda:</p>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr bgcolor="#dddddd">
                <th>Role User</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><b>Administrator</b></td>
                <td>admin</td>
                <td>admin</td>
            </tr>
            <tr>
                <td><b>Petugas</b></td>
                <td>petugas</td>
                <td>petugas</td>
            </tr>
        </tbody>
    </table>

    <hr>

    <h2>3. Fitur Utama</h2>
    <ul>
        <li><b>Dashboard:</b> Ringkasan data inventori.</li>
        <li><b>Master Data:</b> Kelola data Admin, Petugas, Supplier, Rak, dan Barang.</li>
        <li><b>Transaksi Barang Masuk:</b> Pencatatan stok yang masuk ke gudang.</li>
        <li><b>Transaksi Barang Keluar:</b> Pencatatan pengeluaran stok berdasarkan nomor ajuan.</li>
        <li><b>Penomoran Otomatis:</b> Sistem otomatis membuat ID transaksi (No Keluar).</li>
        <li><b>Laporan:</b> Cetak laporan per periode bulan dan tahun.</li>
    </ul>

    <hr>

    <h2>4. Spesifikasi Teknis</h2>
    <ul>
        <li>Bahasa: PHP</li>
        <li>Database: MySQLi</li>
        <li>Interface: HTML (Modern Style Interface)</li>
        <li>Library: FontAwesome & Animate On Scroll (AOS)</li>
    </ul>

    <hr>

    <h2>5. Cara Instalasi</h2>
    <ol>
        <li>Ekstrak folder project ke dalam direktori <b>htdocs</b>.</li>
        <li>Buat database baru bernama <b>db_inventory</b> melalui phpMyAdmin.</li>
        <li>Import file database (SQL) yang disediakan ke dalam <b>db_inventory</b>.</li>
        <li>Konfigurasi koneksi database pada file <b>koneksi.php</b>.</li>
        <li>Buka browser dan ketik: <u>http://localhost/nama_folder_anda</u>.</li>
    </ol>

    <hr>

    <h2>6. Struktur Database Terkait</h2>
    <p>Beberapa tabel utama yang digunakan dalam sistem ini:</p>
    <ul>
        <li><b>tb_admin:</b> Menyimpan data kredensial admin.</li>
        <li><b>tb_barang_out:</b> Menyimpan riwayat transaksi barang keluar.</li>
        <li><b>tb_ajuan:</b> Menyimpan data permohonan barang dari petugas.</li>
        <li><b>tb_barang:</b> Menyimpan detail informasi stok barang.</li>
    </ul>

    <hr>

    <p align="center">
        <b>Developer:</b> Fakhri Afkar<br>
        <i>Hak Cipta &copy; 2025 - All Rights Reserved</i>
    </p>

</body>
</html>
