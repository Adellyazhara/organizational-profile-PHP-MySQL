<?php  
include('db.php');
include('header.php'); ?>

include('header.php'); ?>
<h1>Profil Anggota</h1>
<section>
    <?php
    $members = $conn->query("SELECT name, role, photo, bio FROM Members");
    while ($row = $members->fetch_assoc()) {
        echo "<div><img src='{$row['photo']}' alt='{$row['name']}'><h3>{$row['name']}</h3><p>{$row['role']}</p><p>{$row['bio']}</p></div>";
    }
    ?>
</section>
<?php include('footer.php'); ?>