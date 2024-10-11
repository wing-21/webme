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

// Fungsi untuk menulis data ke file JSON
function writeWebsites($json_file, $websites) {
    $json_data = json_encode($websites, JSON_PRETTY_PRINT);
    file_put_contents($json_file, $json_data);
}

// Baca data dari file JSON
$websites = readWebsites($json_file);

// Variabel untuk menampilkan pesan
$message = '';

// Tambahkan website baru
if (isset($_POST['add'])) {
    $target_dir = "img/";
    // Menambahkan timestamp untuk membuat nama file unik
    $unique_file_name = time() . '_' . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $unique_file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $message = "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        $message = "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message .= "Sorry, your file was not uploaded.<br>";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $new_website = [
                'name' => $_POST['name'],
                'image' => $target_file, // Path ke file yang di-upload
                'link' => $_POST['link'],
            ];
            $websites[] = $new_website; // Tambahkan website baru ke array
            writeWebsites($json_file, $websites); // Simpan perubahan ke file JSON
            $message = "Website baru berhasil ditambahkan.<br>"; // Pesan sukses
        } else {
            $message = "Sorry, there was an error uploading your file.<br>";
        }
    }
}

// Hapus website
if (isset($_POST['delete'])) {
    $index = $_POST['index'];
    unset($websites[$index]);
    $websites = array_values($websites); // Reindex array
    writeWebsites($json_file, $websites); // Simpan perubahan ke file
}

?>

<?php include 'dashboard/header.php'; ?>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h2 class="mt-5">Kelola Website</h2>

            <!-- Form untuk menambah website baru -->
            <form method="POST" enctype="multipart/form-data" class="mb-5">
                <div class="form-group">
                    <label for="name">Nama Website</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="link">Link Website</label>
                    <input type="text" class="form-control" id="link" name="link" required>
                </div>
                <div class="form-group">
                    <label for="image">Upload Gambar</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image" required>
                        <label class="custom-file-label" for="image">Pilih gambar...</label>
                    </div>
                </div>

                <button type="submit" name="add" class="btn btn-primary">Tambah Website</button>
            </form>

            <!-- Daftar website yang sudah ada -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Link</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($websites as $index => $website): ?>
                    <tr>
                        <td><?php echo $website['name']; ?></td>
                        <td><img src="<?php echo $website['image']; ?>" alt="<?php echo $website['name']; ?>" width="100"></td>
                        <td><a href="<?php echo $website['link']; ?>" target="_blank"><?php echo $website['link']; ?></a></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Modal untuk pemberitahuan -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Pemberitahuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (!empty($message)): ?>
                    <?php echo $message; ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?php include 'dashboard/footer.php'; ?>

<script>
// Menampilkan modal setelah halaman dimuat
$(document).ready(function() {
    <?php if (!empty($message)): ?>
        $('#notificationModal').modal('show');
    <?php endif; ?>
});

// Menampilkan nama file yang dipilih di input
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var fileName = document.getElementById("image").files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
});
</script>
