<?php
include('db.php');
include('header.php');

// Pastikan hanya admin yang bisa mengakses halaman ini
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Ambil data anggota dari database
$query = $conn->prepare("SELECT * FROM members");
$query->execute();
$result = $query->get_result();
?>

<div class="container my-5">
    <h1 class="mb-4">Arsip Anggota</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Foto</th>
                <th>Bio</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['photo']; ?></td>
                    <td><?php echo $row['bio']; ?></td>
                    <td>
                        <a href="editmember.php?id=<?php echo $row['member_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="inputmember.php" class="btn btn-primary">Tambah Anggota Baru</a>
</div>

<?php include('footer.php'); ?>
