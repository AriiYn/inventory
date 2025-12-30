<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Inventory Barang">
    <meta name="author" content="Fakhri afkar">
    
    <title>Inventory Barang | Fakhri afkar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        /* Custom CSS Modern */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            overflow-x: hidden;
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 15px 0;
        }
        .navbar-brand {
            font-weight: 700;
            color: #2c3e50 !important;
            font-size: 1.5rem;
        }
        .nav-link {
            color: #555 !important;
            font-weight: 500;
            margin-left: 20px;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: #3498db !important;
            transform: translateY(-2px);
        }

        /* Carousel / Hero Section */
        .carousel-item {
            height: 85vh; /* Tinggi layar penuh */
            background-color: #000;
        }
        .carousel-item img {
            height: 100%;
            object-fit: cover;
            opacity: 0.6; /* Gelapkan gambar sedikit agar teks terbaca */
        }
        .carousel-caption {
            bottom: 40%;
            z-index: 2;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
        }

        /* Login Section */
        .section-padding {
            padding: 80px 0;
        }
        .card-custom {
            border: none;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: 0.3s;
            padding: 40px;
        }
        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            width: 100%;
            margin-bottom: 15px;
            transition: 0.3s;
            border: none;
        }
        .btn-admin {
            background: linear-gradient(45deg, #2980b9, #3498db);
            color: white;
        }
        .btn-petugas {
            background: linear-gradient(45deg, #f39c12, #f1c40f);
            color: white;
        }
        .btn-custom:hover {
            opacity: 0.9;
            transform: scale(1.05);
            color: white;
        }

        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            padding: 40px 0;
            margin-top: 50px;
        }
        .social-icons a {
            color: white;
            margin: 0 15px;
            font-size: 1.5rem;
            transition: 0.3s;
        }
        .social-icons a:hover {
            color: #3498db;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-boxes"></i> INVENTORY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#login">Masuk</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/logistic1.jpg" class="d-block w-100" alt="Gudang 1" onerror="this.src='https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'"> <div class="carousel-caption d-none d-md-block" data-aos="fade-up">
                    <h1 class="hero-title">Sistem Manajemen Gudang</h1>
                    <p class="lead">Kelola stok barang masuk dan keluar dengan efisien.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/logistic2.jpg" class="d-block w-100" alt="Gudang 2" onerror="this.src='https://images.unsplash.com/photo-1553413077-190dd305871c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="hero-title">Akurat & Terpercaya</h1>
                    <p class="lead">Monitoring data secara real-time.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/logistic3.jpg" class="d-block w-100" alt="Gudang 3" onerror="this.src='https://images.unsplash.com/photo-1566576912906-2543b8146e6a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="hero-title">Efisiensi Tinggi</h1>
                    <p class="lead">Optimalkan operasional logistik perusahaan Anda.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <section id="login" class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 text-center">
                    <div class="card-custom" data-aos="zoom-in" data-aos-duration="1000">
                        <h2 class="mb-4" style="font-weight: 700;">Masuk Sebagai</h2>
                        <p class="text-muted mb-5">Silakan pilih akses login Anda di bawah ini</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <a href="admin/login.php" target="_blank" style="text-decoration: none;">
                                    <button class="btn btn-custom btn-admin">
                                        <i class="fas fa-user-shield me-2"></i> ADMIN
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="petugas/login_petugas.php" target="_blank" style="text-decoration: none;">
                                    <button class="btn btn-custom btn-petugas">
                                        <i class="fas fa-users me-2"></i> PETUGAS
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="section-padding bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right">
                    <img src="https://img.freepik.com/free-vector/warehouse-workers-checking-inventory-goods-flat-vector-illustration-storehouse-staff-using-embedded-system-managing-order-distribution-logistics-stock-management-concept_74855-26127.jpg" class="img-fluid rounded" alt="Tentang Inventory">
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <h2 style="font-weight: 700; color: #2c3e50;">Tentang Website Inventory</h2>
                    <hr style="width: 50px; border: 3px solid #3498db; opacity: 1;">
                    <p class="lead text-muted">
                        Website inventory adalah aplikasi berbasis Web modern untuk mengatur dan mencatat keluar masuk barang di masing-masing gudang dalam satu perusahaan.
                    </p>
                    <p class="text-muted">
                        Meliputi pencatatan barang masuk dari Supplier dan pencatatan barang keluar secara terstruktur, akurat, dan mudah digunakan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container text-center">
            <div class="social-icons mb-4">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <hr class="mx-auto" style="width: 50%; border-color: rgba(255,255,255,0.2);">
            <p class="mt-3 mb-0" style="font-size: 14px;">
                Copyright &copy; <script>document.write(new Date().getFullYear());</script> 
                <strong>Fakhri afkar</strong>. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi Animasi
        AOS.init({
            once: true, // animasi hanya sekali saat scroll
            duration: 1000, // durasi animasi
        });
    </script>

</body>
</html>