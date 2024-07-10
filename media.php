<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Geomuda</title>
    <!-- Include CSS styles -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
        <div class="logo">
            <img src="assets/images/logo.png" alt="Geomuda Logo">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="media.php">Media</a></li>
                <li><a href="/geo/login.php">Keanggotaan</a></li>
            </ul>
        </nav>
    </header>
    <!-- Banner -->
    <div class="banner">
        <!--<img src="../assets/images/bg.png" alt="Media Geomuda">-->
        <h1>MEDIA GEOMUDA</h1>
        <p>Asosiasi Geomuda Indonesia</p>
    </div>

    <!-- Daftar Berita -->
    <div class="news">
        <?php
        // Contoh data berita;
        require("db.php");
        $sss = "select *
                from   articles
                where  status='approved'
               ";
        $news = ExecQuery($sss);
        /*
        $news = [
            [
                'title' => 'Judul Berita 1',
                'description' => 'Deskripsi singkat berita 1...',
                'read_time' => '1 Min Read',
                'image' => 'images/news1.jpg'
            ],
            [
                'title' => 'Judul Pengumuman 1',
                'description' => 'Deskripsi singkat pengumuman 1...',
                'read_time' => '2 Min Read',
                'image' => 'images/news2.jpg'
            ],
    
        ];
        */

        // Menampilkan daftar berita
        if ($news) foreach ($news as $item) {
            echo "<div class='news-item'>";
            echo "<h2 class='title'>$item->title</h2>";
            echo "<p class='description'>$item->deskripsi</p>";
            echo "<div class='meta'>";
            echo "<img src='http://localhost/geo/img/artikel/$item->photo' alt='$item->title' class='image'>";
            echo "<p class='read-time'>";
            echo "<a href='detail-berita.php?id=$item->id'>Read more</a>";
            echo "</p>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
 
    <footer>
        <p>&copy; 2024 Geomuda. All rights reserved.</p>
    </footer>


</body>
</html>
