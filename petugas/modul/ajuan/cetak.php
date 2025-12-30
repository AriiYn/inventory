<?php
// Naik 3 folder untuk mencapai koneksi.php (modul -> ajuan -> cetak.php)
include '../../../koneksi.php';

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

$nama_bulan = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
];
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan Pengajuan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12px;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px double black;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header p {
            margin: 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            background-color: #e0e0e0 !important;
            text-align: center;
            padding: 8px;
            font-weight: bold;
        }

        td {
            padding: 5px 8px;
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .signature-area {
            margin-top: 50px;
            float: right;
            width: 250px;
            text-align: center;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container-fluid">
        <div class="header">
            <h2>LAPORAN PENGAJUAN BARANG</h2>
            <p>INVENTORY GUDANG</p>
            <p>Periode: <?php echo $nama_bulan[$bulan] . " " . $tahun; ?></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>No Ajuan</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jml Ajuan</th>
                    <th>Petugas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                // Query Filter
                $sql = "SELECT * FROM tb_ajuan 
                        WHERE MONTH(tanggal) = '$bulan' 
                        AND YEAR(tanggal) = '$tahun' 
                        ORDER BY tanggal ASC";

                $query = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                        // Status Text
                        $status = ($row['val'] == 0) ? 'Selesai' : 'Menunggu';
                ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><?php echo $row['no_ajuan']; ?></td>
                            <td class="text-center"><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                            <td class="text-center"><?php echo $row['kode_brg']; ?></td>
                            <td><?php echo $row['nama_brg']; ?></td>
                            <td class="text-center" style="font-weight: bold;"><?php echo $row['jml_ajuan']; ?></td>
                            <td><?php echo $row['petugas']; ?></td>
                            <td class="text-center"><?php echo $status; ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center' style='padding: 20px;'>Tidak ada data pengajuan pada periode ini.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="signature-area">
            <p>Jakarta, <?php echo date('d F Y'); ?></p>
            <br><br><br><br>
            <p><strong>( Petugas Gudang )</strong></p>
        </div>
    </div>

</body>

</html>