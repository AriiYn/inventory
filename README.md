<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation - Web Inventory</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --danger: #e74c3c;
            --light: #f4f6f9;
            --dark: #212529;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--dark);
            background-color: var(--light);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        header {
            text-align: center;
            border-bottom: 2px solid var(--light);
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        h1 { color: var(--primary); margin-bottom: 10px; }
        h2 { color: var(--secondary); border-left: 5px solid var(--secondary); padding-left: 15px; margin-top: 30px; }

        .badge {
            background: var(--secondary);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .login-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        table th { background-color: var(--primary); color: white; }

        .code-block {
            background: #272822;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Courier New', Courier, monospace;
            overflow-x: auto;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .feature-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .feature-item {
            display: flex;
            align-items: center;
        }

        .feature-item i {
            color: var(--secondary);
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <i class="fas fa-boxes fa-4x" style="color: var(--danger);"></i>
        <h1>Web Inventory System</h1>
        <span class="badge">v1.0.0</span>
        <p>Sistem Manajemen Stok Barang Berbasis PHP & MySQL</p>
    </header>

    <h2><i class="fas fa-info-circle"></i> Deskripsi</h2>
    <p>Aplikasi ini dikembangkan untuk memudahkan pengelolaan inventaris barang secara digital. Sistem mencakup pelacakan barang keluar, barang masuk, dan sinkronisasi stok secara otomatis berdasarkan ajuan dari petugas.</p>

    <h2><i class="fas fa-user-lock"></i> Kredensial Login</h2>
    <div class="login-box">
        <table>
            <thead>
                <tr>
                    <th>Level Akses</th>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Administrator</strong></td>
                    <td>admin</td>
                    <td><code>admin</code></td>
                </tr>
                <tr>
                    <td><strong>Petugas</strong></td>
                    <td>petugas</td>
                    <td><code>petugas</code></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2><i class="fas fa-star"></i> Fitur Utama</h2>
    <div class="feature-list">
        <div class="feature-item"><i class="fas fa-check-circle"></i> Multi-level User (Admin & Petugas)</div>
        <div class="feature-item"><i class="fas fa-check-circle"></i> Laporan Barang Keluar & Masuk</div>
        <div class="feature-item"><i class="fas fa-check-circle"></i> Cetak Laporan PDF/Print</div>
        <div class="feature-item"><i class="fas fa-check-circle"></i> Penomoran Otomatis (No. Keluar)</div>
        <div class="feature-item"><i class="fas fa-check-circle"></i> UI Responsif (Mobile Friendly)</div>
        <div class="feature-item"><i class="fas fa-check-circle"></i> Filter Berdasarkan Bulan & Tahun</div>
    </div>

    <h2><i class="fas fa-terminal"></i> Instalasi</h2>
    <ol>
        <li>Clone atau Download file ZIP project ini.</li>
        <li>Buat database di MySQL dengan nama <code>db_inventory</code>.</li>
        <li>Buka file <code>koneksi.php</code> dan sesuaikan host, user, dan password database Anda.</li>
        <li>Akses aplikasi melalui browser: <code>http://localhost/inventory</code>.</li>
    </ol>

    <div class="footer">
        <p>Copyright &copy; 2025 - <strong>Fakhri Afkar</strong>. All Rights Reserved.</p>
    </div>
</div>

</body>
</html>
