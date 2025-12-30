<?php 
  include '../koneksi.php';
  
  // Cek Session Petugas (idinv2)
  if ( !isset($_SESSION["idinv2"])) {
    header("Location: login_petugas.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dashboard Petugas Inventory">
    <meta name="author" content="Fakhri afkar">
    
    <title><?php echo isset($judul) ? $judul : 'Dashboard Petugas'; ?></title>

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

        .sidebar-nav { padding: 20px 0; }

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
            border-left: 4px solid #f1c40f; /* Warna Kuning untuk Petugas */
        }

        .sidebar-nav i { width: 30px; font-size: 1.2rem; }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            transition: all 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navbar */
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

        .card-stat:hover { transform: translateY(-5px); }

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

        .stat-value { font-size: 32px; font-weight: 700; }
        .stat-label { font-size: 14px; opacity: 0.9; text-transform: uppercase; }

        /* Gradients */
        .bg-blue { background: linear-gradient(45deg, #2980b9, #3498db); }
        .bg-orange { background: linear-gradient(45deg, #e67e22, #f39c12); }
        .bg-green { background: linear-gradient(45deg, #27ae60, #2ecc71); }

        footer {
            background: #fff;
            padding: 20px;
            text-align: center;
            color: #7f8c8d;
            border-top: 1px solid #eee;
            margin-top: auto;
        }

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
            <a href="?m=barangMasuk&s=awal"><i class="fas fa-cart-arrow-down"></i> Data Barang Masuk</a>
            <a href="?m=ajuan&s=awal"><i class="fas fa-gift"></i> Data Ajuan Barang Keluar</a>
            
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
            <h4 class="mb-0 fw-bold text-secondary d-none d-md-block">Dashboard Petugas</h4>

            <?php 
                $id = $_SESSION['idinv2'];
                // Logic mengambil data petugas
                $sql = "SELECT * FROM tb_petugas WHERE id_petugas = '$id'";
                $query = mysqli_query($koneksi, $sql);
                $r = mysqli_fetch_array($query);
            ?>
            
            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle fa-2x text-warning me-2"></i>
                    <span class="fw-bold"><?php echo $r['nama']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
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
                    <div class="alert alert-warning border-0 shadow-sm text-dark d-flex align-items-center" role="alert">
                        <i class="fas fa-smile-beam fa-2x me-3"></i>
                        <div>
                            <h5 class="alert-heading fw-bold mb-0">Selamat Datang, <?php echo $r['nama']; ?>!</h5>
                            <p class="mb-0 text-muted">Selamat bertugas di sistem inventory.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-stat bg-blue">
                        <div class="card-body">
                            <div>
                                <?php
                                    include_once "../koneksi.php";
                                    $sql="SELECT count(id_brg_in) as jbrg_in FROM tb_barang_in";
                                    $query=mysqli_query($koneksi,$sql);
                                    $r_stat=mysqli_fetch_assoc($query);
                                ?>
                                <div class="stat-value"><?php echo $r_stat['jbrg_in']; ?></div>
                                <div class="stat-label">Barang Masuk</div>
                            </div>
                            <div class="icon-bg"><i class="fas fa-cart-plus"></i></div>
                            <i class="fas fa-cart-plus fa-3x"></i>
                        </div>
                        <a href="?m=barangMasuk&s=awal" class="text-white text-decoration-none px-3 py-2 bg-dark bg-opacity-10 d-block text-center small">
                            Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-stat bg-orange">
                        <div class="card-body">
                            <div>
                                <?php
                                    include_once "../koneksi.php";
                                    $sql="SELECT count(no_ajuan) as jajuan FROM tb_ajuan";
                                    $query=mysqli_query($koneksi,$sql);
                                    $r_stat=mysqli_fetch_assoc($query);
                                ?>
                                <div class="stat-value"><?php echo $r_stat['jajuan']; ?></div>
                                <div class="stat-label">Total Ajuan</div>
                            </div>
                            <div class="icon-bg"><i class="fas fa-gift"></i></div>
                            <i class="fas fa-gift fa-3x"></i>
                        </div>
                        <a href="?m=ajuan&s=awal" class="text-white text-decoration-none px-3 py-2 bg-dark bg-opacity-10 d-block text-center small">
                            Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-stat bg-green">
                        <div class="card-body">
                            <div>
                                <?php
                                    include_once "../koneksi.php";
                                    $sql="SELECT count(val) as jval FROM tb_ajuan WHERE val='0'";
                                    $query=mysqli_query($koneksi,$sql);
                                    $r_stat=mysqli_fetch_assoc($query);
                                ?>
                                <div class="stat-value"><?php echo $r_stat['jval']; ?></div>
                                <div class="stat-label">Ajuan Disetujui</div>
                            </div>
                            <div class="icon-bg"><i class="fas fa-check-circle"></i></div>
                            <i class="fas fa-check-circle fa-3x"></i>
                        </div>
                        <a href="?m=ajuan&s=awal" class="text-white text-decoration-none px-3 py-2 bg-dark bg-opacity-10 d-block text-center small">
                            Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <footer>
            <p class="mb-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> <strong>Fakhri afkar</strong>. All rights reserved</p>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 800 });
        
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
        });
    </script>

</body>
</html>