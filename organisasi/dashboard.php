<?php
include('db.php');

// Pastikan hanya admin yang bisa mengakses halaman ini
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");  // Arahkan ke halaman login jika admin belum login
    exit;
}

?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <h1 class="mb-4">Dashboard Admin</h1>

    <!-- Tombol Logout -->
    <div class="text-end mb-4">
        <a href="dashboard.php?logout=true" class="btn btn-danger">Logout</a>
    </div>

<div class="container my-5">

    <div class="row">
        <!-- Tombol untuk mengarahkan ke arsip berita -->
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Arsip Berita</h5>
                    <p class="card-text">Lihat semua berita yang telah dipublikasikan.</p>
                    <a href="archives.php" class="btn btn-primary">Lihat Arsip</a>
                </div>
            </div>
        </div>

        <!-- Tombol untuk menuju halaman input member -->
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Input Member Baru</h5>
                    <p class="card-text">Tambah member baru ke situs.</p>
                    <a href="inputmember.php" class="btn btn-primary">Input Member</a>
                </div>
            </div>
        </div>
		<!-- Tombol untuk mengarahkan ke arsip member -->
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Arsip Member</h5>
                    <p class="card-text">Lihat semua member yang telah dipublikasikan.</p>
                    <a href="archivesmember.php" class="btn btn-primary">Lihat Member</a>
                </div>
            </div>
        </div>

        <!-- Tombol untuk menuju halaman input berita -->
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Input Berita Baru</h5>
                    <p class="card-text">Tambah berita baru ke situs.</p>
                    <a href="inputnews.php" class="btn btn-primary">Input Berita</a>
                </div>
            </div>
        </div>
		<!-- Tombol untuk mengarahkan ke arsip Gallery -->
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Arsip Gallery</h5>
                    <p class="card-text">Lihat semua gallery yang telah dipublikasikan.</p>
                    <a href="archivesgallery.php" class="btn btn-primary">Lihat Gallery</a>
                </div>
            </div>
        </div>

        <!-- Tombol untuk menuju halaman input Gallery -->
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Input Gallery Baru</h5>
                    <p class="card-text">Tambah gallery baru ke situs.</p>
                    <a href="inputgallery.php" class="btn btn-primary">Input Gallery</a>
                </div>
            </div>
        </div>
		
    </div>
</div>

<?php include('footer.php'); ?>
