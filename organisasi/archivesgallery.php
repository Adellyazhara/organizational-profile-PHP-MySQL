<?php 
include('db.php');
include('header.php');

// Pastikan hanya admin yang bisa mengakses halaman ini
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $query = $conn->prepare("DELETE FROM Events WHERE event_id = ?");
    $query->bind_param("i", $deleteId);
    if ($query->execute()) {
        $success = "Galeri berhasil dihapus!";
    } else {
        $error = "Gagal menghapus galeri.";
    }
}

$events = $conn->query("SELECT event_id, title, image FROM Events");

?>

<div class="container my-5">
    <h1 class="mb-4">Arsip Galeri</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php elseif (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <div class="row">
        <?php while ($row = $events->fetch_assoc()): ?>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['title']; ?></h5>
                        <a href="editgallery.php?id=<?php echo $row['event_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?delete_id=<?php echo $row['event_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this gallery?')">Delete</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include('footer.php'); ?>
