<?php 
include('db.php');
include('header.php'); ?>
<div class="container my-5">
    <h1 class="mb-4">Kontak Kami</h1>
    <form method="POST" action="contact_process.php" class="mb-4">
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Pesan</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Pesan" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
    <section>
        <h2>Lokasi Kami</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61951.81485559609!2d110.5661123451931!3d-7.532438623083473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a69857bdb2ec5%3A0xd0cbd65e16e6ccd4!2sSekretariat%20Duta%20Seni%20Boyolali!5e0!3m2!1sid!2sid!4v1734642527352!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
</div>
<?php include('footer.php'); ?>