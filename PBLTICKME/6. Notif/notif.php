<?php
session_start();

// Setel zona waktu PHP
date_default_timezone_set('UTC'); 


// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil nama pengguna dari sesi
$username = $_SESSION['username'];

// Konfigurasi koneksi ke database
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "db_tickme";

// Buat koneksi ke database
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Gantilah dengan query yang telah Anda definisikan sebelumnya
$sql = "SELECT name, date, message FROM list2 WHERE user_id = (SELECT Id FROM user WHERE username = '$username')";
$result = $conn->query($sql);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ambil hasil query dan simpan dalam array $notifications
    $notifications = [];
    while ($row = $result->fetch_assoc()) {
      $notificationDate = strtotime($row['date']);
      $currentDate = strtotime(date('Y-m-d'));
      

        // Cek apakah notifikasi memiliki tanggal yang sama dengan tanggal hari ini
        if ($notificationDate === $currentDate) {
            // Buat pesan pengingat yang dinamis
            $notifications[] = "Hey, $username! You have '{$row['name']}' that you haven't bought yet. {$row['message']}";
        }
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi ke database
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tickme</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 <style>
    body {
      background-color: #e4dacf;
    }

    .navbar {
      background-color: #e4dacf;
    }

    .navbar-brand {
      font-size: 24px;
      font-weight: bold;
    }

    .fa-question-circle,
    .fa-list {
      font-size: 24px;
      color: #333;
      
    }

    .btn-login,
    .btn-signup {
      background-color: #985A10;
      color: white;

    }

    .image-logo {
      max-width: 100%;
      height: auto;
    }


    .sticky-top {
      position: sticky;
      top: 0;
      z-index: 1000;
      background-color: #e4dacf;
      
    }
  

  </style>
</head>


    <nav class="navbar navbar-expand-lg navbar-light mb-2 d-flex align-items-center justify-content-between sticky-top "
    style="border-bottom:2px solid #000000 ;">
    <a class="navbar-brand" href="#" style="margin-left: 10px;">Tickme</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../10.faq/faq.html"><i class="fas fa-question-circle" style="font-size: 20px;"></i></a>
          </li>
          <li class="nav-item">
          <li class="nav-item">
            <a class="nav-link" href="../7. List/list.php"><i class="fas fa-clipboard-list"
                style="font-size: 20px;"></i></a>
          </li>
          <li class="nav-item">
          <li class="nav-item">
          <a class="nav-link" href="../6. Notif/notif.php"><i class="fas fa-bell" style="font-size: 20px;"></i></a>
          </li>
          <li class="nav-item">
          <li class="nav-item">
            <a class="nav-link" href="../4. Profile Page/Profile.php"><i class="fas fa-user" style="font-size: 20px;"></i></a>
          </li>

          </li>
        </ul>
      </div>
</nav>

<div class='container mt-4'>
        <div class='row'>
            <div class='col-md-4'>
                <?php foreach ($notifications as $notification): ?>
                    <div class="alert alert-primary mb-3 pt-4 pb-4" href="#"><?php echo $notification; ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    
    </body>
    </html>