<?php 

if (isset($_POST['simpan'])) {
    include('../koneksi.php');

    // --- LOGIKA NO OTOMATIS (KHUSUS INTEGER) ---
    // 1. Ambil nilai tertinggi (MAX) dari kolom no_brg_out
    $query_max = mysqli_query($koneksi, "SELECT max(no_brg_out) as maxKode FROM tb_barang_out");
    $data_max  = mysqli_fetch_array($query_max);
    $kode_terakhir = $data_max['maxKode'];

    // 2. Cek apakah ada data sebelumnya
    if ($kode_terakhir) {
        // Jika ada, ambil angka terakhir lalu tambah 1
        // Contoh: Jika terakhir 5, maka jadi 6
        $no_brg_out = $kode_terakhir + 1;
    } else {
        // Jika belum ada data sama sekali (database kosong), mulai dari 1
        $no_brg_out = 1;
    }
    // --- SELESAI LOGIKA NO OTOMATIS ---

    // Ambil data lain dari form
    $no_ajuan      = $_POST['no_ajuan'];
    $tanggal_ajuan = $_POST['tanggal_ajuan'];
    $tanggal_out   = $_POST['tanggal_out'];
    $petugas       = $_POST['petugas'];
    $kode_brg      = $_POST['kode_brg'];
    $nama_brg      = $_POST['nama_brg'];
    $stok          = $_POST['stok'];
    $jml_ajuan     = $_POST['jml_ajuan'];
    $jml_keluar    = $_POST['jml_keluar'];
    $admin         = $_POST['admin'];
    
    // Cek duplikasi (Opsional untuk integer auto)
    $sql_cek = mysqli_query($koneksi, "SELECT * FROM tb_barang_out WHERE no_brg_out = '$no_brg_out'");
    $cek = mysqli_fetch_row($sql_cek);

    if ($cek) {
        echo "<script>alert('No barang Keluar sudah ada, silakan coba lagi.')</script>";
        echo '<script>window.history.back()</script>';
    } else {
        // Hitung sisa stok
        $kurangStok = $stok - $jml_keluar;

        // 1. Update stok di tabel master barang
        $update = ("UPDATE tb_barang SET stok = '". $kurangStok ."' WHERE kode_brg = '". $kode_brg ."' ");
        $result = mysqli_query($koneksi, $update) or die(mysqli_error($koneksi));

        // 2. Simpan ke tabel barang keluar
        // Pastikan urutan nama kolom (no_brg_out, no_ajuan, dst) sesuai dengan struktur database Anda
        $simpan = "INSERT INTO tb_barang_out (no_brg_out, no_ajuan, tanggal_ajuan, tanggal_out, petugas, kode_brg, nama_brg, stok, jml_ajuan, jml_keluar, admin) 
                   VALUES ('$no_brg_out','$no_ajuan','$tanggal_ajuan','$tanggal_out','$petugas','$kode_brg','$nama_brg', '$stok', '$jml_ajuan', '$jml_keluar', '$admin')";
        
        $result = mysqli_query($koneksi, $simpan);

        // 3. Update status di tabel ajuan
        $sqlval = "UPDATE tb_ajuan SET val='0', stok='" . $kurangStok . "' WHERE no_ajuan = '". $no_ajuan ."' ";

        if ($result && mysqli_query($koneksi, $sqlval)) {
            // Tampilkan alert sukses dengan nomor urut yang baru
            echo "<script>alert('Data Berhasil Disimpan. No Keluar: $no_brg_out'); window.location.href='?m=barangKeluar&s=awal';</script>";
        } else {
            echo "Penyimpanan data Gagal: " . mysqli_error($koneksi);
        }
    }
}
?>