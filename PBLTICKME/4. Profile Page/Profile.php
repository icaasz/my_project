<?php
// Mulai sesi
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Tickme </title>
</head>

<body>
    <style>
        .btn.btn-primary.btn-block.mb-3 {
            background-color: #985A10;
            color: white;
        }

        .navbar-brand {
      font-size: 24px;
      font-weight: bold;
    }

        .kotak {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 180px;
            height: 50px;
            background-color: #985A10;
            color: white;
            border: 2px solid #2c3e50;
            margin-left: 70px;
        }

        .kotak h3 {
            font-size: 20px;
            text-align: center;

        }

        @media (max-width: 768px) {

            
            .paw-icons {
                justify-content: space-between;
            }

            .col-xs-1 {
                flex: 0 0 8.333333%;
                max-width: 8.333333%;
            }
        }

       
        input[type=text] {
          
            width: 150px;
        }

        button {
            
            cursor: pointer;
        }

        .kila1 {
            border-radius:20px;
            height : 80vh;
            background-color: #FFE4B5;
            width:100%;
        }

        .kila2 {
            display:flex;
            justify-content:space-between;
            margin-top:30px;
        }

        .kila3 {
            margin-top:30px;
        }

        .kila4 {
            margin-left:20px;
        }

        .hidden {
            display:none;
        }

        .kila5 {
            border-radius:30px;
            background-color:red;
            margin-top: 30px;
        }

        .kila6 {
            display:flex;
            justify-content:center;
        }

        .kila7 {
            border-radius:50px;
            color:white;
            background-color:#985A10;
            width:40%;
            margin-top:30px;
            text-align:center;
            font-size:20px;
            padding: 10px 0 10px 0;
        }
        .kila12 {
          
            margin-top: 30px;
        }
    </style>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light mb-2 d-flex align-items-center justify-content-between sticky-top container-fluid"
     style="border-bottom: 2px solid #000000;">
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

<!-- paw kiri -->
<div class="container kila1">
    <div class="kila2">
<h2 class="kila12">Profile Details</h2>
<form method="post" action="Log_out.php">
<button class="btn btn-secondary kila5" type="submit">LOG OUT</button>
    </form>
    </div>
    <div class="kila6">
    <a href="#"><i class="fas fa-user" style="font-size: 1200%; color:black;"></i></a><br>
</div>

    <div class="kila6">
        <label class="kila7"><?php echo $username; ?></label>
    </div>
</div>          


    <script src="script.js"></script>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>