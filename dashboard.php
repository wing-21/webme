<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Nama file JSON
$json_file = 'websites.json';

// Fungsi untuk membaca data dari file JSON
function readWebsites($json_file) {
    if (file_exists($json_file)) {
        $json_data = file_get_contents($json_file);
        return json_decode($json_data, true);
    }
    return [];
}

// Baca data website dari file JSON
$websites = readWebsites($json_file);

// Tentukan berapa banyak website per halaman
$websites_per_page = 8;

// Tentukan halaman yang sedang dibuka
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = (int) $_GET['page'];
} else {
    $current_page = 1; // Default halaman 1
}

// Fungsi untuk filter hasil pencarian
$search_keyword = '';
if (isset($_GET['search'])) {
    $search_keyword = $_GET['search'];
    $websites = array_filter($websites, function($website) use ($search_keyword) {
        return stripos($website['name'], $search_keyword) !== false;
    });
}

// Tentukan total halaman
$total_websites = count($websites);
$total_pages = ceil($total_websites / $websites_per_page);

// Tentukan index untuk website yang akan ditampilkan di halaman ini
$start_index = ($current_page - 1) * $websites_per_page;
$websites_to_display = array_slice($websites, $start_index, $websites_per_page);
?>

<?php include 'dashboard/header.php'; ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-6">
                <h2 class="mt-5">Dashboard</h2>
                <p>Selamat datang di dashboard Anda, <?php echo $_SESSION['user_id']; ?>!</p>
            </div>
            
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <!-- Form Pencarian -->
                <form class="form-inline my-2 my-lg-0 search-form" method="GET" action="">
                    <div class="input-group">
                        <input class="form-control search-input" type="search" placeholder="Cari website..." aria-label="Search" name="search" value="<?php echo htmlspecialchars($search_keyword); ?>">
                        <div class="input-group-append">
                            <span class="input-group-text search-icon"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>



            <div class="row">
                <?php foreach ($websites_to_display as $website): ?>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card">
                        <img src="<?php echo $website['image']; ?>" class="card-img-top" alt="<?php echo $website['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $website['name']; ?></h5>
                            <div class="d-flex justify-content-center">
                                <a href="<?php echo $website['link']; ?>" class="btn btn-primary" style="background-color: #3c8dbc; border-color: #3c8dbc;" target="_blank">Visit Website</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination Links -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <!-- Tombol "Previous" -->
                    <?php if ($current_page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>&search=<?php echo htmlspecialchars($search_keyword); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Nomor halaman -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $current_page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($search_keyword); ?>"><?php echo $i; ?></a>
                    </li>
                    <?php endfor; ?>

                    <!-- Tombol "Next" -->
                    <?php if ($current_page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>&search=<?php echo htmlspecialchars($search_keyword); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>

        </div>
    </section>
</div>

<?php include 'dashboard/footer.php'; ?>
<style>
    .search-form {
        display: flex;
        align-items: center;
        padding-top:20px;
    }

    .input-group {
        width: 300px; /* Atur lebar sesuai kebutuhan */
    }

    .search-input {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
        border-right: none; /* Menghapus border kanan */
    }

    .input-group-append .input-group-text {
        background-color: #3c8dbc; /* Warna latar belakang ikon */
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
        border-left: none; /* Menghapus border kiri */
        color: white; /* Warna ikon */
    }

    .search-icon {
        padding: 0.5rem; /* Padding untuk ikon */
        cursor: pointer; /* Pointer saat hover */
    }

    .search-input:focus {
        box-shadow: none; /* Menghapus bayangan saat fokus */
        border-color: #3c8dbc; /* Warna border saat fokus */
    }


</style>