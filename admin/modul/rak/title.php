<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Data Rak Inventory">
    <meta name="author" content="Fakhri afkar">
    <title><?php echo isset($judul) ? $judul : 'Data Rak'; ?></title>

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
            border-left: 4px solid #3498db;
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

        /* Custom Card & Table */
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            background: white;
            padding: 20px;
        }

        .btn-add {
            background: linear-gradient(45deg, #8e44ad, #9b59b6); /* Warna Ungu untuk Rak */
            color: white;
            border: none;
            box-shadow: 0 4px 6px rgba(142, 68, 173, 0.3);
        }
        
        .btn-add:hover { color: white; transform: translateY(-2px); }

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
            <a href="?m=awal.php"><i class="fas fa-tachometer-alt"></i> Beranda</a>
            <a href="?m=admin&s=awal"><i class="fas fa-user-shield"></i> Data Admin</a>
            <a href="?m=petugas&s=awal"><i class="fas fa-users"></i> Data Petugas</a>
            <a href="?m=supplier&s=awal"><i class="fas fa-building"></i> Data Supplier</a>
            <a href="?m=rak&s=awal" class="active"><i class="fas fa-cubes"></i> Data Rak</a>
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
            <h4 class="mb-0 fw-bold text-secondary">Data Rak</h4>

            <?php 
                $id = $_SESSION['idinv'];
                include '../koneksi.php';
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
            
            <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
                <div>
                    <h5 class="text-muted mb-0">Manajemen Penyimpanan</h5>
                    <h2 class="fw-bold text-dark">Daftar Rak</h2>
                </div>
                <button type="button" class="btn btn-add px-4 py-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                    <i class="fas fa-plus me-2"></i> Tambah Rak
                </button>
            </div>

            <div class="card-custom" data-aos="fade-up">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="py-3 ps-3 rounded-start" width="20%">ID Rak</th>
                                <th class="py-3">Nama Rak</th>
                                <th class="py-3 pe-3 rounded-end text-center" width="20%">Aksi</th>
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
                            <a class="page-link" <?php if($halaman > 1){ echo "href='?m=rak&s=awal&halaman=$previous'"; } ?>>Previous</a>
                        </li>
                        
                        <?php for($x=1;$x<=$total_halaman;$x++){ ?> 
                            <li class="page-item <?php if($halaman == $x) echo 'active'; ?>">
                                <a class="page-link" href="?m=rak&s=awal&halaman=<?php echo $x ?>"><?php echo $x; ?></a>
                            </li>
                        <?php } ?>
                        
                        <li class="page-item <?php if($halaman >= $total_halaman) { echo 'disabled'; } ?>">
                            <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?m=rak&s=awal&halaman=$next'"; } ?>>Next</a>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: #8e44ad;">
                    <h5 class="modal-title fw-bold" id="exampleModalLongTitle"><i class="fas fa-cube me-2"></i> Tambah Rak Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="?m=rak&s=simpan" method="POST" enctype="multipart/form-data">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Rak</label>
                            <input type="text" class="form-control" name="nama_rak" placeholder="Contoh: Rak A-01" required>
                            <small class="text-muted">Masukkan nama atau kode lokasi rak penyimpanan.</small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn text-white fw-bold" style="background-color: #8e44ad;"><i class="fas fa-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
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