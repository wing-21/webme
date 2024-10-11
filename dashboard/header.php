<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
    <link rel="icon" href="img/webmeid.jpg" type="image/jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Dashboard</title>
    <style>
        .logo {
            width: 1cm; 
            height: 1cm; 
        }
        .main-header {
            background-color: #3c8dbc;
        }
        .main-header.navbar-light .navbar-nav .nav-link {
            color: #fff;
        }
        .brand-link {
            height: 56px;
            background-color: #367FA9;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            white-space: nowrap;
        }
        .nav-link {
            color: white;
        }
        
        .sidebar-collapse .brand-link img {
            display: none;
        }
        .sidebar-collapse .user-panel .info {
            display: none;
        }
        .user-panel .info {
            display: block; /* Pastikan info muncul kembali saat sidebar normal */
        }
        .user-panel .image img {
            width: 100%;
            max-width: 45px;
            height: auto;
            padding-top:6px;
        }
        .card {
            text-align: center;
            padding: 20px;
        }
        .card-img-top {
            width: 100%; 
            height: 200px;
            object-fit: cover;
        }
        .card-title {
            margin: 15px 0;
        }
        .btn {
            margin-top: 10px;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .content-wrapper {
            padding: 20px; /* Menambahkan padding di sekitar content */
        }

        .row {
            display: flex;
            flex-wrap: wrap; /* Membuat card membungkus dengan baik di layar kecil */
            justify-content: center; /* Meratakan card di tengah */
        }

        .card {
            border: 1px solid #ccc; /* Menambahkan border pada card */
            border-radius: 8px; /* Menambahkan sudut membulat */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan pada card */
            transition: transform 0.2s; /* Animasi saat card dihover */
        }

        .card:hover {
            transform: scale(1.05); /* Membesarkan card saat dihover */
        }

        .card-title {
            font-size: 1em; /* Meningkatkan ukuran font judul card */
            margin: 10px 0; /* Menambahkan margin atas dan bawah */
        }

        .btn {
            width: 100%; /* Membuat tombol memenuhi lebar card */
        }
        .mt-5, .my-5 {
            margin-top: 1rem !important;
        }

    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="dashboard.php" class="brand-link">
        <img src="img/logoku.png" style="width: 160px; height: 30px;">
    </a>

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <span class="d-block" style="color:white;"><?php echo $_SESSION['user_id']; ?></span>
            <span class="badge badge-danger">Administrator</span>
        </div>
    </div>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <p class="text">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="kelola_website.php" class="nav-link">
                        <i class="fas fa-globe"></i>
                        <p class="text">Kelola Website</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
</body>
</html>
