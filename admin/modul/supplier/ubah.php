<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Edit Data Supplier">
    <meta name="author" content="Fakhri afkar">
    <title>Edit Data Supplier | Fakhri afkar</title>

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

        /* Card Form Style */
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            background: white;
            padding: 30px;
        }

        .form-control:focus {
            border-color: #2ecc71; /* Warna hijau supplier */
            box-shadow: 0 0 0 0.2rem rgba(46, 204, 113, 0.25);
        }

        .btn-save {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            transition: 0.3s;
            font-weight: 600;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
            color: white;
        }

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
            <a href="?m=supplier&s=awal" class="active"><i class="fas fa-building"></i> Data Supplier</a>
            <a href="?m=rak&s=awal"><i class="fas fa-cubes"></i> Data Rak</a>
            <a href="?m=barang&s=awal"><i class="fas fa-box-open"></i> Data Barang</a>
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
            <h4 class="mb-0 fw-bold text-secondary">Edit Supplier</h4>

            <div class="dropdown">
                <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle fa-2x text-secondary me-2"></i>
                    <span class="fw-bold d-none d-md-inline">Admin</span>
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

        <?php 
            $id = $_GET['id_sup'];
            include '../koneksi.php';
            // Query data Supplier berdasarkan ID yang dikirim
            $sql = "SELECT * FROM tb_sup WHERE id_sup = '$id'";
            $query = mysqli_query($koneksi, $sql);
            $r = mysqli_fetch_array($query);
        ?>

        <div class="container-fluid p-4">
            
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
                        <div>
                            <h5 class="text-muted mb-0">Formulir Edit</h5>
                            <h2 class="fw-bold text-dark">Perbarui Data Supplier</h2>
                        </div>
                        <a href="?m=supplier&s=awal" class="btn btn-outline-secondary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>

                    <div class="card-custom" data-aos="fade-up">
                        <form action="?m=supplier&s=update" method="POST" enctype="multipart/form-data">
                            
                            <input type="hidden" name="id_sup" value="<?php echo $r['id_sup'];?>">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Nama Supplier</label>
                                    <input type="text" class="form-control" name="nama_sup" value="<?php echo $r['nama_sup']; ?>" placeholder="Nama Perusahaan" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Kontak Person</label>
                                    <input type="text" class="form-control" name="kontak_sup" value="<?php echo $r['kontak_sup']; ?>" placeholder="Nama PIC">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Telepon</label>
                                    <input type="text" class="form-control" name="telepon_sup" value="<?php echo $r['telepon_sup']; ?>" placeholder="Nomor Telepon">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Alamat</label>
                                    <textarea class="form-control" name="alamat_sup" rows="1" placeholder="Alamat Lengkap"><?php echo $r['alamat_sup']; ?></textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="?m=supplier&s=awal" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" name="simpan" class="btn btn-save">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                            </div>

                        </form>
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