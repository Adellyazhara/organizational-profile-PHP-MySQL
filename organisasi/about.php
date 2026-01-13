<?php  
include('db.php');
include('header.php'); ?>
<div class="container my-5">
    <h1 class="mb-4">Tentang Kami</h1>
    <section>
        <h2>Sejarah Singkat</h2>
        <p>KMB Boyolali (Komunitas Mahasiswa Boyolali) Solo Raya didirikan sebagai 
			respons atas kebutuhan mahasiswa asal Boyolali yang kuliah di berbagai 
			perguruan tinggi di Solo Raya untuk memiliki wadah berkumpul dan saling 
			mendukung. Komunitas ini terbentuk pada [tahun berdiri, jika ada], diawali 
			oleh sekelompok mahasiswa yang memiliki semangat kebersamaan dan keinginan 
			untuk menjaga silaturahmi antar sesama perantau dari Boyolali.

			Seiring waktu, KMB Boyolali berkembang menjadi komunitas yang solid, 
			dengan berbagai program dan kegiatan yang mendukung pengembangan akademik, 
			sosial, dan budaya anggotanya. Selain menjadi tempat bertukar pengalaman dan 
			inspirasi, komunitas ini juga berkontribusi dalam pelestarian budaya Boyolali 
			dan memberikan dampak positif bagi masyarakat sekitar.

			Hingga kini, KMB Boyolali terus tumbuh dengan semangat kebersamaan, 
			menjadikan komunitas ini sebagai rumah kedua bagi para mahasiswa Boyolali di Solo Raya.</p>
        
        <h2>Visi dan Misi</h2>
        <p><strong>Visi:</strong> Menjadi komunitas mahasiswa Boyolali di Solo Raya yang solid, inovatif, dan berdaya saing dalam membangun hubungan sosial, akademik, dan kontribusi kepada masyarakat.</p>
        <p><strong>Misi:</strong></p>
        <ul class="list-group">
            <li >Membina hubungan yang harmonis antaranggota komunitas melalui kegiatan sosial, budaya, dan kebersamaan.</li>
            <li >Mendorong anggota untuk berkembang secara akademik, kepemimpinan, dan kreativitas melalui berbagai program dan pelatihan.</li>
			<li >Melestarikan dan mempromosikan nilai-nilai budaya khas Boyolali di lingkungan Solo Raya.</li>
            <li >Menginspirasi dan memberikan kontribusi nyata kepada masyarakat Boyolali dan Solo Raya melalui aksi sosial dan kolaborasi.</li>
            <li >Menjadi tempat berbagi pengalaman dan dukungan antar mahasiswa Boyolali dalam menghadapi tantangan perkuliahan dan kehidupan.</li>

        </ul>

        <h2>Struktur Kepengurusan</h2>
        <p>Struktur organisasi kami terdiri dari anggota-anggota berikut:</p>
        
        <!-- Menampilkan daftar anggota dengan foto -->
        <div class="row">
            <?php
            // Query untuk mengambil data anggota dari tabel 'members'
            $query = "SELECT name, role, photo FROM members ORDER BY role";
            $result = $conn->query($query);

            // Periksa jika data anggota ada
            if ($result->num_rows > 0) {
                // Loop untuk menampilkan data anggota
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='col-md-4'>
                        <div class='card'>
                            <img src='{$row['photo']}' class='card-img-top' alt='{$row['name']}' style='height: 200px; object-fit: cover;'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$row['name']}</h5>
                                <p class='card-text'>{$row['role']}</p>
                            </div>
                        </div>
                    </div>";
                }
            } else {
                echo "<p>Belum ada anggota yang terdaftar.</p>";
            }
            ?>
        </div>
    </section>
</div>

<?php include('footer.php'); ?>
