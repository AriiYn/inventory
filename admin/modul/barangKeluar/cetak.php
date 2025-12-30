<?php 
include '../../../koneksi.php';

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

// Array Nama Bulan untuk Judul
$nama_bulan = [
    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Barang Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid black; padding-bottom: 10px; }
        .header h2 { margin: 0; }
        .header p { margin: 0; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; text-align: center; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="container mt-4">
        <div class="header">
            <h2>LAPORAN BARANG KELUAR</h2>
            <p>Periode: <?php echo $nama_bulan[$bulan] . " " . $tahun; ?></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>No Keluar</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Petugas</th>
                    <th>Jumlah Keluar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                // Query filter berdasarkan bulan dan tahun tanggal_out
                $sql = "SELECT * FROM tb_barang_out WHERE MONTH(tanggal_out) = '$bulan' AND YEAR(tanggal_out) = '$tahun' ORDER BY tanggal_out ASC";
                $query = mysqli_query($koneksi, $sql);
                
                if(mysqli_num_rows($query) > 0) {
                    while($row = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td><?php echo $row['no_brg_out']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['tanggal_out'])); ?></td>
                    <td><?php echo $row['kode_brg']; ?></td>
                    <td><?php echo $row['nama_brg']; ?></td>
                    <td><?php echo $row['petugas']; ?></td>
                    <td align="center"><?php echo $row['jml_keluar']; ?></td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='7' align='center'>Tidak ada data pada periode ini.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="mt-5 text-end" style="margin-right: 50px;">
            <p>Jakarta, <?php echo date('d F Y'); ?></p>
            <br><br><br>
            <p><strong>( Admin Gudang )</strong></p>
        </div>
    </div>

</body>
</html>