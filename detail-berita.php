<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Geomuda</title>
    <!-- Include CSS styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .title-besar {
            font-size: 24pt !important;
            font-weight: bold;
            text-align:center;
        }

        .news-besar {
            padding: 20px;
        }

        .news-items-besar .image {
            display: block;
            margin: 0 auto; /* Menengahkan gambar */
            max-width: 100%;
            height: auto;
        }

        .description {
            text-align: justify;
            font-size: 18px; 
            margin: 50px;
        }

        .banner {
            background-color:white;
        }

        
    </style>
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
        <!--<img src="images/media.png" alt="Media Geomuda">-->
        <h1>MEDIA GEOMUDA</h1>
        <p>Asosiasi Geomuda Indonesia</p>
    </div>

    <!-- Daftar Berita -->
    <div class="news-besar">
        <?php
        // Contoh data berita;
        require("db.php");
        $idx = isset($_GET["id"]) ? $_GET["id"] : 1;
        $sss = "select *
                from   articles
                where  id='$idx'
               ";
        $news = ExecQuery1R($sss);
        $item = $news;
        $isi  = str_replace("\n", "<br />", $item->content);

        // Menampilkan daftar berita
        echo "<div class='news-items-besar'>";
        echo "<h2 class='title-besar'>$item->title</h2>";
        echo "<p><img src='http://localhost/geo/img/artikel/$item->photo' alt='$item->title' class='image'></p>";
        echo "<p class='description'>$isi</p>";
        echo "</div>";
        ?>
    </div>

    <footer>
        <p>&copy; 2024 Geomuda. All rights reserved.</p>
    </footer>


</body>
</html>
