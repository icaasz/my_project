<?php
// Mulai atau perbaharui sesi
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil nama pengguna dari sesi
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <title>Tickme</title>
</head>
<body>
<style>
.btn.btn-primary.btn-block.mb-3 {
    background-color: #985A10;
    color: white;
    border-radius: 30px;
}
.sticky-top {
      position: sticky;
      top: 0;
      z-index: 1000;
      background-color: #e4dacf;
      
    }
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

   








</style>

<!-- Navigation -->
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

<!-- Content -->
<!-- paw kiri -->
<div class="row container-fluid">
  <div class="col-lg-1 col-md-1 col-1 ">
<div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
</div>
<div style="margin-left:40px;">
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
</div>
</div>

<!-- paw kanan -->
<div class="col-lg-1 col-md-1 col-xl-1 col-1 offset-lg-10 offset-md-10 offset-xl-10 offset-10  ">
<div style="margin-left:40px;">
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
</div>
<div >
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
</div>
</div>
</div>

<h3 class="text-center">Item Category</h3>
<div class="container mt-5" >
  
  <div class="col-lg-12 ">
    <div class="row">
      <div class="col-md-4 ">
        <a href="../8. Items/items.php?category=1"class="btn btn-primary btn-block mb-3">Food and Beverages</a>
      </div>
      <div class="col-md-4 ">
        <a href="../8. Items/items.php?category=2" class="btn btn-primary btn-block mb-3">Fashion</a>
      </div>
      <div class="col-md-4">
        <a href="../8. Items/items.php?category=3" class="btn btn-primary btn-block mb-3">Stationary</a>
      </div>
      <div class="col-md-4">
        <a href="../8. Items/items.php?category=4" class="btn btn-primary btn-block mb-3">Health & Beauty</a>
      </div>
      <div class="col-md-4">
        <a href="../8. Items/items.php?category=5" class="btn btn-primary btn-block mb-3">Furniture & Electronic</a>
      </div>
      <div class="col-md-4">
        <a href="../8. Items/items.php?category=6" class="btn btn-primary btn-block mb-3">Hobbies & Toys</a>
      </div>
      <div class="col-md-4">
        <a href="../8. Items/items.php?category=7" class="btn btn-primary btn-block mb-3">Kitchen & Ingredients</a>
      </div>
      <div class="col-md-4">
        <a href="../8. Items/items.php?category=8" class="btn btn-primary btn-block mb-3">Tools</a>
      </div>
      <div class="col-md-4">
        <a href="../8. Items/items.php?category=9" class="btn btn-primary btn-block mb-3">Cleaning & Supplies</a>
      </div>
      <!-- tambahin kategori disni  -->
    </div>
    
  </div>

  <div class="row " style="margin-left: 15px">
    <!-- paw miau dibawah -->
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
</div>







  <div class="row " style="margin-left: 15px">
    <!-- paw maiu bawah-->
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
    <div class="col-lg-2 col-md-4 col-2">
      <div>
        <i class="fas fa-paw" style=" font-size: 25px;"></i>
        <i class="fas fa-paw " style=" font-size: 25px;"></i>
      </div>
     
  </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
