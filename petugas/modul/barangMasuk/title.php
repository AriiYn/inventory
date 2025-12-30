<?php 
    date_default_timezone_set("Asia/Jakarta");
    $tanggalSekarang = date("Y-m-d");
    $jamSekarang = date("H:i"); // Format 24 jam lebih standar
    
    include '../koneksi.php';

    // Cek Session Petugas
    if ( !isset($_SESSION["idinv2"])) {
        header("Location: login_petugas.php");
        exit();
    }

    // --- LOGIKA ID OTOMATIS (BARANG MASUK: IN-XXX) ---
    // (Opsional: Jika Anda ingin menampilkan ID otomatis di form)
    $query_max = mysqli_query($koneksi, "SELECT max(id_brg_in) as maxKode FROM tb_barang_in");
    $data_max  = mysqli_fetch_array($query_max);
    $kode_terakhir = $data_max['maxKode'];
    // Logika ini bisa disesuaikan jika format ID berbeda

    // --- LOGIKA FILTER BULAN & TAHUN ---
    $bulan_filter = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
    $tahun_filter = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Data Barang Masuk">
    <meta name="author" content="Fakhri afkar">
    <title><?php echo isset($judul) ? $judul : 'Barang Masuk'; ?></title>

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
        .btn-add { background: linear-gradient(45deg, #1abc9c, #16a085); color: white; border: none; box-shadow: 0 4px 6px rgba(26, 188, 156, 0.3); }
        .btn-add:hover { color: white; transform: translateY(-2px); }
        /* Style Tombol Print */
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
            <a href="?m=barangMasuk&s=awal" class="active"><i class="fas fa-cart-arrow-down"></i> Data Barang Masuk</a>
            <a href="?m=ajuan&s=awal"><i class="fas fa-gift"></i> Data Ajuan Barang Keluar</a>
            
            <a href="logout.php" onclick="return confirm('Yakin ingin logout?')" class="text-danger mt-5">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content" id="content">
        
        <nav class="top-navbar">
            <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <h4 class="mb-0 fw-bold text-secondary">Barang Masuk</h4>

            <?php 
                $id = $_SESSION['idinv2'];
                $sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
                $query = mysqli_query($koneksi, $sql);
                $r = mysqli_fetch_array($query);
            ?>
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-user-circle fa-2x text-warning me-2"></i>
                    <span class="fw-bold d-none d-md-inline"><?php echo $r['nama']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                    <li>
                        <form action="logout.php" method="post" onclick="return confirm('Yakin ingin logout?');">
                            <button class="dropdown-item text-danger" type="submit" name="keluar"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid p-4">
            
            <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
                <div>
                    <h5 class="text-muted mb-0">Transaksi</h5>
                    <h2 class="fw-bold text-dark">Data Barang Masuk</h2>
                </div>
                <button type="button" class="btn btn-add px-4 py-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                    <i class="fas fa-plus me-2"></i> Tambah Data
                </button>
            </div>

            <div class="card-custom mb-4" data-aos="fade-up">
                <form action="" method="GET" class="row g-3 align-items-end">
                    <input type="hidden" name="m" value="barangMasuk">
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
                            // Loop tahun dari sekarang mundur ke 2020
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
                        <a href="modul/barangMasuk/cetak.php?bulan=<?php echo $bulan_filter; ?>&tahun=<?php echo $tahun_filter; ?>" target="_blank" class="btn btn-print w-100">
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
                                <th class="py-3 ps-3 rounded-start">ID Masuk</th>
                                <th class="py-3">Tanggal</th>
                                <th class="py-3">No. Invoice</th>
                                <th class="py-3">Supplier</th>
                                <th class="py-3">Kode Barang</th>
                                <th class="py-3">Nama Barang</th>
                                <th class="py-3">Stok Awal</th>
                                <th class="py-3">Jml Masuk</th>
                                <th class="py-3">Jam</th>
                                <th class="py-3">Petugas</th>
                                <th class="py-3 pe-3 rounded-end text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'paging.php'; ?>
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php if($halaman <= 1){ echo 'disabled'; } ?>">
                            <a class="page-link" <?php if($halaman > 1){ echo "href='?m=barangMasuk&s=awal&halaman=$previous&bulan=$bulan_filter&tahun=$tahun_filter'"; } ?>>Previous</a>
                        </li>
                        
                        <?php for($x=1;$x<=$total_halaman;$x++){ ?> 
                            <li class="page-item <?php if($halaman == $x) echo 'active'; ?>">
                                <a class="page-link" href="?m=barangMasuk&s=awal&halaman=<?php echo $x ?>&bulan=<?php echo $bulan_filter; ?>&tahun=<?php echo $tahun_filter; ?>"><?php echo $x; ?></a>
                            </li>
                        <?php } ?>
                        
                        <li class="page-item <?php if($halaman >= $total_halaman) { echo 'disabled'; } ?>">
                            <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=barangMasuk&s=awal&halaman=$next&bulan=$bulan_filter&tahun=$tahun_filter'"; } ?>>Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>

        <footer>
            <p class="mb-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> <strong>Fakhri afkar</strong>. All rights reserved</p>
        </footer>

    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"> 
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold" id="exampleModalLongTitle"><i class="fas fa-cart-plus me-2"></i> Input Barang Masuk</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="?m=barangMasuk&s=simpan" method="POST" enctype="multipart/form-data">
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tanggal Masuk</label>
                                    <input type="text" class="form-control" name="tanggal" value="<?php echo $tanggalSekarang; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Jam</label>
                                    <input type="text" class="form-control" name="jam" value="<?php echo $jamSekarang; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">No. Invoice</label>
                                    <input type="text" class="form-control" name="noinv" placeholder="Contoh: INV/2025/001" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Petugas Bertugas</label>
                                    <input type="text" class="form-control" name="petugas" value="<?php echo $r['nama']; ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Pilih Barang</label>
                                    <?php 
                                        include ("../koneksi.php");
                                        $supp = ("SELECT * FROM tb_barang");
                                        $result = mysqli_query($koneksi, $supp);
                                        $jsArray = "var prdName = new Array();";
                                    ?>
                                    <select class="form-select" name="kode_brg" onchange="changeValue(this.value)" required>
                                        <option value="" disabled selected>--- Pilih Kode Barang ---</option>
                                        <?php 
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo '<option value="'. $row['kode_brg'] .'">'.$row['kode_brg'].' - '.$row['nama_brg'].'</option>';
                                                $jsArray .= "prdName['". $row['kode_brg'] ."'] = {
                                                    nama_brg:'". addslashes($row['nama_brg']) ."',
                                                    stok:'". addslashes($row['stok']) ."',
                                                    supplier:'". addslashes($row['supplier']) ."'
                                                };";
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nama Barang</label>
                                    <input type="text" class="form-control bg-light" name="nama_brg" id="prd_nmbrg" readonly>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-bold">Stok Awal</label>
                                        <input type="text" class="form-control bg-light" name="stok" id="prd_stk" readonly>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label fw-bold">Jml Masuk</label>
                                        <input type="number" class="form-control border-success" name="jml_masuk" placeholder="0" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Supplier</label>
                                    <input type="text" class="form-control bg-light" name="supplier" id="prd_sup" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-success fw-bold"><i class="fas fa-save me-1"></i> Simpan Data</button>
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

        // PHP Generated JS Array
        <?php echo $jsArray; ?>

        function changeValue(id){
            if(prdName[id]){
                document.getElementById('prd_nmbrg').value = prdName[id].nama_brg;
                document.getElementById('prd_stk').value = prdName[id].stok;
                document.getElementById('prd_sup').value = prdName[id].supplier;
            } else {
                document.getElementById('prd_nmbrg').value = '';
                document.getElementById('prd_stk').value = '';
                document.getElementById('prd_sup').value = '';
            }
        }
    </script>

</body>
</html>