<?php 
include '../../../koneksi.php';

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

// Array Nama Bulan
$nama_bulan = [
    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Barang Masuk</title>
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
            <h2>LAPORAN BARANG MASUK</h2>
            <p>Periode: <?php echo $nama_bulan[$bulan] . " " . $tahun; ?></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>ID Masuk</th>
                    <th>Tanggal</th>
                    <th>No Invoice</th>
                    <th>Supplier</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th class="text-center">Jumlah Masuk</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                // Filter berdasarkan bulan dan tahun pada kolom 'tanggal'
                $sql = "SELECT * FROM tb_barang_in WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun' ORDER BY tanggal ASC";
                $query = mysqli_query($koneksi, $sql);
                
                if(mysqli_num_rows($query) > 0) {
                    while($row = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td><?php echo $row['id_brg_in']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                    <td><?php echo $row['noinv']; ?></td>
                    <td><?php echo $row['supplier']; ?></td>
                    <td><?php echo $row['kode_brg']; ?></td>
                    <td><?php echo $row['nama_brg']; ?></td>
                    <td align="center"><?php echo $row['jml_masuk']; ?></td>
                    <td><?php echo $row['petugas']; ?></td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='9' align='center'>Tidak ada data pada periode ini.</td></tr>";
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