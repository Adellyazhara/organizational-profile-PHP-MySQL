<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit();
}

include "conector.php"; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $kontak = $_POST['kontak'];

    // Validasi sederhana
    if (empty($nama) || empty($jabatan)) {
        $error = "Nama dan jabatan wajib diisi!";
    } else {
        // Insert data ke tabel pengurus
        $stmt = $conn->prepare("INSERT INTO pengurus (nama, jabatan, kontak) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $jabatan, $kontak);
        if ($stmt->execute()) {
            $success = "Data pengurus berhasil ditambahkan!";
        } else {
            $error = "Terjadi kesalahan: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengurus</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        .form-container input, .form-container button { width: 100%; padding: 10px; margin-bottom: 10px; }
        .form-container .error { color: red; }
        .form-container .success { color: green; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Pengurus</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <input type="text" name="nama" placeholder="Nama Pengurus" required>
            <input type="text" name="jabatan" placeholder="Jabatan" required>
            <input type="text" name="kontak" placeholder="Kontak (Opsional)">
            <button type="submit">Tambah</button>
        </form>
        <p><a href="admin_dashboard.php">Kembali ke Dashboard</a></p>
    </div>
</body>
</html>
