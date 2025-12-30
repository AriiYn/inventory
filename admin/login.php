<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin | Fakhri afkar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .card-login {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            transition: transform 0.3s ease;
        }

        .card-login:hover {
            transform: translateY(-5px);
        }

        .login-header h3 {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #3498db; /* Biru Admin */
            background-color: #fff;
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1px solid #ddd;
            background-color: #fff;
            color: #3498db; /* Biru Admin */
        }
        
        .input-group .form-control {
            border-radius: 0 10px 10px 0;
        }

        .btn-login {
            background: linear-gradient(45deg, #2980b9, #3498db); /* Gradasi Biru */
            border: none;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: linear-gradient(45deg, #3498db, #5dade2);
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.4);
            color: white;
        }

        .btn-back {
            color: #95a5a6;
            text-decoration: none;
            font-size: 0.9rem;
            margin-top: 20px;
            display: inline-block;
            transition: 0.3s;
        }

        .btn-back:hover {
            color: #34495e;
        }

        .footer-copy {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                
                <div class="card-login" data-aos="fade-down" data-aos-duration="1000">
                    <div class="text-center login-header mb-4">
                        <i class="fas fa-user-shield fa-3x text-primary mb-3"></i>
                        <h3>Login Admin</h3>
                        <p>Akses Administrator Sistem</p>
                    </div>

                    <form action="pro_login_admin.php" method="post">
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" name="user" required placeholder="Masukkan username admin">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted small">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" name="pass" required placeholder="Masukkan password">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <input type="submit" name="daftar" class="btn btn-login" value="MASUK">
                        </div>

                        <div class="text-center mt-3">
                            <a href="../index.php" class="btn-back">
                                <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                            </a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-copy">
        <p class="mb-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> <strong>Fakhri afkar</strong> All rights reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>
</html>