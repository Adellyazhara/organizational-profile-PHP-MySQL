<?php  
include('db.php');
include('header.php'); ?>

<main>
    <h1 class="banner display-4" style="color:white"><b>KOMUNITAS MAHASISWA BOYOLALI</b></h1>
    
    <!-- Bagian Profil Organisasi -->
    <div class="container profile-section">
        <p>
            KMB Boyolali Solo Raya adalah komunitas mahasiswa yang beranggotakan pemuda-pemudi 
			asal Boyolali yang melanjutkan pendidikan di perguruan tinggi yang tersebar di wilayah 
			Solo Raya. Komunitas ini hadir sebagai wadah untuk mempererat tali silaturahmi, berbagi 
			pengalaman, serta mendukung pengembangan potensi anggotanya, baik secara akademik maupun 
			non-akademik. Dengan semangat kebersamaan, KMB Boyolali menjadi rumah kedua bagi para anggotanya, 
			memberikan ruang untuk bertumbuh bersama melalui berbagai kegiatan seperti diskusi, pelatihan, 
			aksi sosial, hingga perayaan budaya.  

			Sebagai organisasi yang mengedepankan nilai kekeluargaan, KMB Boyolali tidak hanya fokus pada 
			peningkatan kapasitas individu anggotanya, tetapi juga turut aktif dalam kegiatan yang memberikan 
			dampak positif bagi masyarakat, khususnya di Boyolali dan Solo Raya. Melalui berbagai program, seperti 
			aksi sosial, seminar tematik, festival budaya, dan pelatihan kepemimpinan, KMB Boyolali berkomitmen untuk 
			melahirkan generasi muda yang tidak hanya berprestasi, tetapi juga peduli terhadap lingkungannya.  

			Komunitas ini terus berkembang seiring waktu, menciptakan tradisi-tradisi positif yang mampu menjaga 
			keakraban antaranggota, sekaligus memberikan kontribusi nyata bagi masyarakat. Dengan visi untuk menjadi 
			komunitas yang solid dan inspiratif, KMB Boyolali Solo Raya siap menjadi penghubung antara tradisi, edukasi, 
			dan inovasi, mencetak generasi muda yang siap menghadapi tantangan global tanpa melupakan akar budaya mereka.
        </p>
    </div>

    <!-- Berita Terbaru -->
    <section class="mb-5">
        <h2>Berita Terbaru</h2>
        <div class="row">
            <?php
            $news = $conn->query("SELECT title, date FROM news ORDER BY date DESC LIMIT 3");
            while ($row = $news->fetch_assoc()) {
                echo "<div class='col-md-4'><div class='card'><div class='card-body'><h5 class='card-title'>{$row['title']}</h5><p class='card-text'>{$row['date']}</p></div></div></div>";
            }
            ?>
        </div>
    </section>
    
    <!-- Kegiatan Terbaru -->
    <section>
        <h2>Kegiatan Terbaru</h2>
        <div class="row">
            <?php
            $events = $conn->query("SELECT title, image FROM Events ORDER BY date DESC LIMIT 3");
            while ($row = $events->fetch_assoc()) {
                echo "<div class='col-md-4'><div class='card'><img src='{$row['image']}' class='card-img-top' alt='{$row['title']}' style='max-height: 200px; object-fit: cover;'><div class='card-body'><h5 class='card-title'>{$row['title']}</h5></div></div></div>";
			}
            ?>
        </div>
    </section>
</div>
</main>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
