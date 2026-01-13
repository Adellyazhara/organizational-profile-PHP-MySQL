<?php
include('db.php');
include('header.php');

// Pastikan hanya admin yang bisa mengakses halaman ini
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$success = $error = "";

// Ambil ID anggota dari parameter GET
$member_id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Update data anggota berdasarkan ID
    $query = $conn->prepare("UPDATE members SET name = ?, email = ?, phone = ?, address = ? WHERE member_id = ?");
    $query->bind_param("ssssi", $name, $email, $phone, $address, $member_id);
    if ($query->execute()) {
        $success = "Data anggota berhasil diupdate!";
    } else {
        $error = "Gagal mengupdate data anggota.";
    }
    $query->close();
}

// Ambil data anggota yang akan diedit
$query = $conn->prepare("SELECT * FROM members WHERE member_id = ?");
$query->bind_param("i", $member_id);
$query->execute();
$result = $query->get_result();
$member = $result->fetch_assoc();
$query->close();

if (!$member) {
    $error = "Anggota tidak ditemukan.";
}
?>

<div class="container my-5">
    <h1 class="mb-4">Edit Anggota</h1>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <form action="editmember.php?id=<?php echo $member['member_id']; ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Anggota</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $member['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $member['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $member['phone']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea id="address" name="address" class="form-control" required><?php echo $member['address']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Anggota</button>
    </form>
</div>

<?php include('footer.php'); ?>
