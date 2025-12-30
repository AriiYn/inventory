<?php 
  include '../koneksi.php';
  // Cek Session
  if ( !isset($_SESSION["idinv"])) {
    header("Location: login.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dashboard Admin Inventory">
    <meta name="author" content="Fakhri afkar">
    
    <title><?php echo isset($judul) ? $judul : 'Dashboard Admin'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            width: 260px;
            background: #2c3e50;
            color: #fff;
            position: fixed;
            transition: all 0.3s;
            z-index: 100;
        }
        
        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            background: rgba(0,0,0,0.1);
            color: #ecf0f1;
            text-decoration: none;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .sidebar-nav a {
            padding: 15px 25px;
            display: flex;
            align-items: center;
            color: #bdc3c7;
            text-decoration: none;
            transition: 0.3s;
            border-left: 4px solid transparent;
        }

        .sidebar-nav a:hover, .sidebar-nav a.active {
            color: #fff;
            background: rgba(255,255,255,0.05);
            border-left: 4px solid #3498db;
        }

        .sidebar-nav i {
            width: 30px;
            font-size: 1.2rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            transition: all 0.3s;
        }

        /* Navbar */
        .top-navbar {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            height: 70px;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Dashboard Cards */
        .card-stat {
            border: none;
            border-radius: 15px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            margin-bottom: 25px;
        }

        .card-stat:hover {
            transform: translateY(-5px);
        }

        .card-stat .card-body {
            padding: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 2;
            position: relative;
        }

        .card-stat .icon-bg {
            position: absolute;
            right: 10px;
            bottom: -10px;
            font-size: 100px;
            opacity: 0.2;
            z-index: 1;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
        }

        /* Gradients for Cards */
        .bg-blue { background: linear-gradient(45deg, #2980b9, #3498db); }
        .bg-green { background: linear-gradient(45deg, #27ae60, #2ecc71); }
        .bg-orange { background: linear-gradient(45deg, #e67e22, #f39c12); }
        .bg-red { background: linear-gradient(45deg, #c0392b, #e74c3c); }
        .bg-purple { background: linear-gradient(45deg, #8e44ad, #9b59b6); }
        .bg-teal { background: linear-gradient(45deg, #16a085, #1abc9c); }
        .bg-dark { background: linear-gradient(45deg, #2c3e50, #34495e); }

        /* Footer */
        footer {
            background: #fff;
            padding: 20px;
            text-align: center;
            color: #7f8c8d;
            border-top: 1px solid #eee;
            margin-top: auto;
        }

        /* Responsive */
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
        <a href="#" class="sidebar-brand">
            <i class="fas fa-boxes me-2"></i> INVENTORY
        </a>
        <div class="sidebar-nav">
            <a href="?m=awal.php" class="active"><i class="fas fa-tachometer-alt"></i> Beranda</a>
            <a href="?m=admin&s=awal"><i class="fas fa-user-shield"></i> Data Admin</a>
            <a href="?m=petugas&s=awal"><i class="fas fa-users"></i> Data Petugas</a>
            <a href="?m=supplier&s=awal"><i class="fas fa-building"></i> Data Supplier</a>
            <a href="?m=rak&s=awal"><i class="fas fa-cubes"></i> Data Rak</a>
            <a href="?m=barang&s=awal"><i class="fas fa-box-open"></i> Data Barang</a>
            <a href="?m=barangMasuk&s=awal"><i class="fas fa-dolly"></i> Barang Masuk</a>
            <a href="?m=barangKeluar&s=awal"><i class="fas fa-dolly"></i> Barang Keluar</a>
            
            <a href="logout.php" onclick="return confirm('Yakin ingin logout?')" class="text-danger mt-5">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content" id="content">
        
        <nav class="top-navbar">
            <button class="btn btn-outline-secondary d-md-none" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <h4 class="mb-0 d-none d-md-block fw-bold text-secondary">Dashboard</h4>

            <?php 
                $id = $_SESSION['idinv'];
                // Menggunakan koneksi yang sudah di-include di atas
                $sql = "SELECT * FROM tb_admin WHERE id_admin = '$id'";
                $query = mysqli_query($koneksi, $sql);
                $r = mysqli_fetch_array($query);
            ?>
            
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../images/admin/<?php echo $r['foto']; ?>" alt="Admin" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #3498db;">
                    <span class="fw-bold"><?php echo $r['nama']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                    <li>
                        <form action="logout.php" method="post" onclick="return confirm('Yakin ingin logout?');">
                            <button class="dropdown-item text-danger" type="submit" name="keluar">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid p-4">
            
            <div class="row mb-4" data-aos="fade-down">
                <div class="col-12">
                    <div class="alert alert-info border-0 shadow-sm bg-white text-dark d-flex align-items-center" role="alert">
                        <i class="fas fa-smile-wink fa-2x text-info me-3"></i>
                        <div>
                            <h5 class="alert-heading fw-bold mb-0">Selamat Datang, <?php echo $r['nama']; ?>!</h5>
                            <p class="mb-0 text-muted">Selamat bekerja, semoga harimu menyenangkan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-stat bg-blue">
                        <div class="card-body">
                            <div>
                                <?php
                                    include_once "../koneksi.php";
                                    $sql="SELECT count(id_admin) as jadmin FROM tb_admin";
                                    $query=mysqli_query($koneksi,$sql);
                                    $r_stat=mysqli_fetch_assoc($query);
                                ?>
                                <div class="stat-value"><?php echo $r_stat['jadmin']; ?></div>
                                <div class="stat-label">Jumlah Admin</div>
                            </div>
                            <div class="icon-bg"><i class="fas fa-user-shield"></i></div>
                            <i class="fas fa-user-shield fa-3x"></i>
                        </div>
                        <a href="?m=admin&s=awal" class="text-white text-decoration-none px-3 py-2 bg-dark bg-opacity-10 d-block text-center small">
                            Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-stat bg-green">
                        <div class="card-body">
                            <div>
                                <?php
                                    include_once "../koneksi.php";
                                    $sql="SELECT count(id_sup) as jsup FROM tb_sup";
                                    $query=mysqli_query($koneksi,$sql);
                                    $r_stat=mysqli_fetch_assoc($query);
                                ?>
                                <div class="stat-value"><?php echo $r_stat['jsup']; ?></div>
                                <div class="stat-label">Jumlah Supplier</div>
                            </div>
                            <div class="icon-bg"><i class="fas fa-building"></i></div>
                            <i class="fas fa-building fa-3x"></i>
                        </div>
                        <a href="?m=supplier&s=awal" class="text-white text-decoration-none px-3 py-2 bg-dark bg-opacity-10 d-block text-center small">
                            Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-stat bg-purple">
                        <div class="card-body">
                            <div>
                                <?php
                                    include_once "../koneksi.php";
                                    $sql="SELECT count(id_rak) as jrak FROM tb_rak";
                                    $query=mysqli_query($koneksi,$sql);
                                    $r_stat=mysqli_fetch_assoc($query);
                                ?>
                                <div class="stat-value"><?php echo $r_stat['jrak']; ?></div>
                                <div class="stat-label">Jumlah Rak</div>
                            </div>
                            <div class="icon-bg"><i class="fas fa-cubes"></i></div>
                            <i class="fas fa-cubes fa-3x"></i>
                        </div>
                        <a href="?m=rak&s=awal" class="text-white text-decoration-none px-3 py-2 bg-dark bg-opacity-10 d-block text-center small">
                            Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-stat bg-orange">
                        <div class="card-body">
                            <div>
                                <?php
                                    include_once "../koneksi.php";
                                    $sql="SELECT count(kode_brg) as jbrg FROM tb_barang";
                                    $query=mysqli_query($koneksi,$sql);
                                    $r_stat=mysqli_fetch_array($query);
                                ?>
                                <div class="stat-value"><?php echo $r_stat['jbrg']; ?></div>
                                <div class="stat-label">Jumlah Barang</div>
                            </div>
                            <div class="icon-bg"><i class="fas fa-box"></i></div>
                            <i class="fas fa-box fa-3x"></i>
                        </div>
                        <a href="?m=barang&s=awal" class="text-white text-decoration-none px-3 py-2 bg-dark bg-opacity-10 d-block text-center small">
                            Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="card-stat bg-teal">
                        <div class="card-body">
                            <div>
                                <?php
                                    include_once "../koneksi.php";
                                    $sql="SELECT count(id_brg_in) as jbrg_in FROM tb_barang_in";
                                    $query=mysqli_query($koneksi,$sql);
                                    $r_stat=mysqli_fetch_array($query);
                                ?>
                                <div class="stat-value"><?php echo $r_stat['jbrg_in']; ?></div>
                                <div class="stat-label">Barang Masuk</div>
                            </div>
                            <div class="icon-bg"><i class="fas fa-cart-arrow-down"></i></div>
                            <i class="fas fa-cart-arrow-down fa-3x"></i>
                        </div>
                        <a href="#" class="text-white text-decoration-none px-3 py-2 bg-dark bg-opacity-10 d-block text-center small">
                            Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>
                
                 <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="card-stat bg-dark">
                        <div class="card-body">
                            <div>
                                <?php
                                    include_once "../koneksi.php";
                                    $sql="SELECT count(no_ajuan) as jajuan FROM tb_ajuan";
                                    $query=mysqli_query($koneksi,$sql);
                                    $r_stat=mysqli_fetch_assoc($query);
                                ?>
                                <div class="stat-value"><?php echo $r_stat['jajuan']; ?></div>
                                <div class="stat-label">Jumlah Ajuan</div>
                            </div>
                            <div class="icon-bg"><i class="fas fa-file-alt"></i></div>
                            <i class="fas fa-file-alt fa-3x"></i>
                        </div>
                        <a href="#" class="text-white text-decoration-none px-3 py-2 bg-dark bg-opacity-10 d-block text-center small">
                            Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="700">
                    <div class="card-stat bg-red">
                        <div class="card-body">
                            <div>
                                <?php
                                    include_once "../koneksi.php";
                                    $sql="SELECT count(no_brg_out) as jbrg_out FROM tb_barang_out";
                                    $query=mysqli_query($koneksi,$sql);
                                    $r_stat=mysqli_fetch_assoc($query);
                                ?>
                                <div class="stat-value"><?php echo $r_stat['jbrg_out']; ?></div>
                                <div class="stat-label">Barang Keluar</div>
                            </div>
                            <div class="icon-bg"><i class="fas fa-truck-loading"></i></div>
                            <i class="fas fa-truck-loading fa-3x"></i>
                        </div>
                        <a href="#" class="text-white text-decoration-none px-3 py-2 bg-dark bg-opacity-10 d-block text-center small">
                            Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>

            </div> </div>

        <footer>
            <p class="mb-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> <strong>Fakhri afkar</strong>. All rights reserved</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 800
        });

        // Sidebar Toggle Script
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
        });
    </script>

</body>
</html>