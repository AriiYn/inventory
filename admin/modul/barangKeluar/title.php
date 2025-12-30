<?php 
    date_default_timezone_set("Asia/Jakarta");
    $tanggalSekarang = date("Y-m-d");
    
    include '../koneksi.php';
    
    // --- LOGIKA NO OTOMATIS ---
    $query_max = mysqli_query($koneksi, "SELECT max(no_brg_out) as maxKode FROM tb_barang_out");
    $data_max  = mysqli_fetch_array($query_max);
    $kode_terakhir = $data_max['maxKode'];

    if ($kode_terakhir) {
        $no_brg_out_auto = $kode_terakhir + 1;
    } else {
        $no_brg_out_auto = 1;
    }

    // --- LOGIKA FILTER BULAN & TAHUN ---
    // Jika user memilih filter, gunakan nilai tersebut. Jika tidak, gunakan bulan/tahun saat ini.
    $bulan_filter = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
    $tahun_filter = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Data Barang Keluar">
    <meta name="author" content="Fakhri afkar">
    <title><?php echo isset($judul) ? $judul : 'Barang Keluar'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; overflow-x: hidden; }
        .sidebar { min-height: 100vh; width: 260px; background: #2c3e50; color: #fff; position: fixed; transition: all 0.3s; z-index: 100; }
        .sidebar-brand { height: 70px; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 700; background: rgba(0,0,0,0.1); color: #ecf0f1; text-decoration: none; }
        .sidebar-nav { padding: 20px 0; }
        .sidebar-nav a { padding: 15px 25px; display: flex; align-items: center; color: #bdc3c7; text-decoration: none; transition: 0.3s; border-left: 4px solid transparent; }
        .sidebar-nav a:hover, .sidebar-nav a.active { color: #fff; background: rgba(255,255,255,0.05); border-left: 4px solid #3498db; }
        .sidebar-nav i { width: 30px; font-size: 1.2rem; }
        .main-content { margin-left: 260px; transition: all 0.3s; min-height: 100vh; display: flex; flex-direction: column; }
        .top-navbar { background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); height: 70px; padding: 0 30px; display: flex; align-items: center; justify-content: space-between; }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); background: white; padding: 20px; }
        .btn-add { background: linear-gradient(45deg, #e74c3c, #c0392b); color: white; border: none; box-shadow: 0 4px 6px rgba(192, 57, 43, 0.3); }
        .btn-add:hover { color: white; transform: translateY(-2px); }
        .btn-print { background: linear-gradient(45deg, #3498db, #2980b9); color: white; border: none; box-shadow: 0 4px 6px rgba(52, 152, 219, 0.3); }
        .btn-print:hover { color: white; transform: translateY(-2px); }
        footer { background: #fff; padding: 20px; text-align: center; color: #7f8c8d; border-top: 1px solid #eee; margin-top: auto; }
        .form-control[readonly] { background-color: #e9ecef; cursor: not-allowed; }
        @media (max-width: 768px) {
            .sidebar { margin-left: -260px; }
            .sidebar.active { margin-left: 0; }
            .main-content { margin-left: 0; }
            .main-content.active { margin-left: 260px; }
        }
    </style>
</head>
<body>

    <div class="sidebar" id="sidebar">
        <a href="#" class="sidebar-brand"><i class="fas fa-boxes me-2"></i> INVENTORY</a>
        <div class="sidebar-nav">
            <a href="?m=awal.php"><i class="fas fa-tachometer-alt"></i> Beranda</a>
            <a href="?m=admin&s=awal"><i class="fas fa-user-shield"></i> Data Admin</a>
            <a href="?m=petugas&s=awal"><i class="fas fa-users"></i> Data Petugas</a>
            <a href="?m=supplier&s=awal"><i class="fas fa-building"></i> Data Supplier</a>
            <a href="?m=rak&s=awal"><i class="fas fa-cubes"></i> Data Rak</a>
            <a href="?m=barang&s=awal"><i class="fas fa-box-open"></i> Data Barang</a>
            <a href="?m=barangMasuk&s=awal"><i class="fas fa-cart-arrow-down"></i> Barang Masuk</a> 
            <a href="?m=barangKeluar&s=awal" class="active"><i class="fas fa-dolly"></i> Barang Keluar</a>
            <a href="logout.php" onclick="return confirm('Yakin ingin logout?')" class="text-danger mt-5"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="main-content" id="content">
        
        <nav class="top-navbar">
            <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <h4 class="mb-0 fw-bold text-secondary">Barang Keluar</h4>
            
            <?php 
                $id = $_SESSION['idinv'];
                $sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
                $query = mysqli_query($koneksi, $sql);
                $r = mysqli_fetch_array($query);
            ?>
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../images/admin/<?php echo $r['foto']; ?>" alt="Admin" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                    <span class="fw-bold d-none d-md-inline"><?php echo $r['nama']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                    <li><form action="logout.php" method="post" onclick="return confirm('Yakin ingin logout?');"><button class="dropdown-item text-danger" type="submit" name="keluar"><i class="fas fa-sign-out-alt me-2"></i> Logout</button></form></li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid p-4">
            
            <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
                <div>
                    <h5 class="text-muted mb-0">Transaksi</h5>
                    <h2 class="fw-bold text-dark">Data Barang Keluar</h2>
                </div>
                <button type="button" class="btn btn-add px-4 py-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                    <i class="fas fa-plus me-2"></i> Tambah Data
                </button>
            </div>

            <div class="card-custom mb-4" data-aos="fade-up">
                <form action="" method="GET" class="row g-3 align-items-end">
                    <input type="hidden" name="m" value="barangKeluar">
                    <input type="hidden" name="s" value="awal">
                    
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Bulan</label>
                        <select name="bulan" class="form-select">
                            <?php
                            $bulan_array = [
                                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                            ];
                            foreach($bulan_array as $key => $val){
                                $selected = ($key == $bulan_filter) ? 'selected' : '';
                                echo "<option value='$key' $selected>$val</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Tahun</label>
                        <select name="tahun" class="form-select">
                            <?php
                            $tahun_sekarang = date('Y');
                            for($i=$tahun_sekarang; $i>=2020; $i--){
                                $selected = ($i == $tahun_filter) ? 'selected' : '';
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-filter"></i> Filter</button>
                    </div>

                    <div class="col-md-2 ms-auto">
                        <a href="modul/barangKeluar/cetak.php?bulan=<?php echo $bulan_filter; ?>&tahun=<?php echo $tahun_filter; ?>" target="_blank" class="btn btn-print w-100">
                            <i class="fas fa-print me-2"></i> Cetak Laporan
                        </a>
                    </div>
                </form>
            </div>

            <div class="card-custom" data-aos="fade-up">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="py-3 ps-3 rounded-start">No Keluar</th>
                                <th class="py-3">No Ajuan</th>
                                <th class="py-3">Tgl Ajuan</th>
                                <th class="py-3">Tgl Keluar</th>
                                <th class="py-3">Petugas</th>
                                <th class="py-3">Kode Barang</th>
                                <th class="py-3">Barang</th>
                                <th class="py-3">Jml Ajuan</th>
                                <th class="py-3">Stok</th>
                                <th class="py-3">Jml Keluar</th>
                                <th class="py-3">Admin</th>
                                <th class="py-3 pe-3 rounded-end text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                // Modifikasi Paging agar sesuai filter bulan/tahun
                                // Pastikan file paging.php mendukung query filter, atau sesuaikan query di sini
                                // Contoh sederhana query dengan filter:
                                // $sql_data = "SELECT * FROM tb_barang_out WHERE MONTH(tanggal_out) = '$bulan_filter' AND YEAR(tanggal_out) = '$tahun_filter'";
                                // ... lalu loop data
                                include 'paging.php'; 
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if($halaman <= 1){ echo 'disabled'; } ?>">
                            <a class="page-link" <?php if($halaman > 1){ echo "href='?m=barangKeluar&s=awal&halaman=$previous'"; } ?>>Previous</a>
                        </li>
                        <?php for($x=1;$x<=$total_halaman;$x++){ ?> 
                            <li class="page-item <?php if($halaman == $x) echo 'active'; ?>">
                                <a class="page-link" href="?m=barangKeluar&s=awal&halaman=<?php echo $x ?>"><?php echo $x; ?></a>
                            </li>
                        <?php } ?>
                        <li class="page-item <?php if($halaman >= $total_halaman) { echo 'disabled'; } ?>">
                            <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=barangKeluar&s=awal&halaman=$next'"; } ?>>Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>

        <footer>
            <p class="mb-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> <strong>Fakhri afkar</strong>. All rights reserved</p>
        </footer>

    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"> 
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold"><i class="fas fa-truck-loading me-2"></i> Proses Barang Keluar</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                
                <form action="?m=barangKeluar&s=simpan" method="POST" enctype="multipart/form-data">
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-danger mb-3 border-bottom pb-2">Data Transaksi</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">No Barang Keluar (Otomatis)</label>
                                    <input type="text" class="form-control bg-light fw-bold" name="no_brg_out" value="<?php echo $no_brg_out_auto; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nomor Ajuan</label>
                                    <?php 
                                        // include ("../koneksi.php"); // Sudah include
                                        $supp = ("SELECT * FROM tb_ajuan WHERE val = '1' ");
                                        $result = mysqli_query($koneksi, $supp);
                                        $jsArray = "var prdName = new Array();";
                                    ?>
                                    <select name="no_ajuan" class="form-select" onchange="changeValue(this.value)" required>
                                        <option value="" disabled selected>--- Pilih Nomor Ajuan ---</option>
                                        <?php 
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo '<option value="'. $row['no_ajuan'] .'">AJ0'.$row['no_ajuan'].' - '.$row['nama_brg'].'</option>';
                                                $jsArray .= "prdName['". $row['no_ajuan'] ."'] = {
                                                    tanggal_ajuan:'". addslashes($row['tanggal']) ."',
                                                    petugas:'". addslashes($row['petugas']) ."',
                                                    kode_brg:'". addslashes($row['kode_brg']) ."',
                                                    nama_brg:'". addslashes($row['nama_brg']) ."',
                                                    stok:'". addslashes($row['stok']) ."',
                                                    jml_ajuan:'". addslashes($row['jml_ajuan']) ."',
                                                    val:'". addslashes($row['val']) ."'
                                                };";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tanggal Keluar</label>
                                    <input type="text" class="form-control" name="tanggal_out" value="<?php echo $tanggalSekarang; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Jumlah Keluar</label>
                                    <input type="number" class="form-control border-danger" name="jml_keluar" placeholder="Masukkan Jumlah" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Admin Penanggung Jawab</label>
                                    <input type="text" class="form-control" value="<?php echo $r['nama']; ?>" readonly name="admin">
                                </div>
                            </div>

                            <div class="col-md-6 bg-light rounded p-3">
                                <h6 class="fw-bold text-secondary mb-3 border-bottom pb-2">Detail Ajuan (Otomatis)</h6>
                                <div class="mb-2"> <label class="form-label small">Tanggal Ajuan</label> <input type="text" readonly class="form-control form-control-sm" id="prd_tanggal" name="tanggal_ajuan"> </div>
                                <div class="mb-2"> <label class="form-label small">Petugas Pengaju</label> <input type="text" readonly class="form-control form-control-sm" id="prd_petugas" name="petugas"> </div>
                                <div class="mb-2"> <label class="form-label small">Kode Barang</label> <input type="text" readonly class="form-control form-control-sm" id="prd_kodebrng" name="kode_brg"> </div>
                                <div class="mb-2"> <label class="form-label small">Nama Barang</label> <input type="text" readonly class="form-control form-control-sm" id="prd_namabrg" name="nama_brg"> </div>
                                <div class="row">
                                    <div class="col-6 mb-2"> <label class="form-label small">Stok Saat Ini</label> <input type="text" class="form-control form-control-sm fw-bold" id="prd_stokbrga" name="stok" readonly> </div>
                                    <div class="col-6 mb-2"> <label class="form-label small">Jml Diajukan</label> <input type="text" class="form-control form-control-sm fw-bold text-danger" id="prd_jmlajuan" name="jml_ajuan" readonly> </div>
                                </div>
                                <input type="hidden" id="prd_val" name="val">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-danger fw-bold"><i class="fas fa-save me-1"></i> Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript">
        AOS.init({ once: true, duration: 800 });
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
        });
        <?php echo $jsArray; ?>
        function changeValue(id){
            if(prdName[id]){
                document.getElementById('prd_tanggal').value = prdName[id].tanggal_ajuan;
                document.getElementById('prd_petugas').value = prdName[id].petugas;
                document.getElementById('prd_kodebrng').value = prdName[id].kode_brg;
                document.getElementById('prd_namabrg').value = prdName[id].nama_brg;
                document.getElementById('prd_stokbrga').value = prdName[id].stok;
                document.getElementById('prd_jmlajuan').value = prdName[id].jml_ajuan;
                document.getElementById('prd_val').value = prdName[id].val;
            } else {
                document.getElementById('prd_tanggal').value = '';
                document.getElementById('prd_petugas').value = '';
                document.getElementById('prd_kodebrng').value = '';
                document.getElementById('prd_namabrg').value = '';
                document.getElementById('prd_stokbrga').value = '';
                document.getElementById('prd_jmlajuan').value = '';
            }
        }   
    </script>
</body>
</html>