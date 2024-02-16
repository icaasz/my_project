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

// Siapkan SQL untuk mengambil user_Id dari tabel akun (gunakan prepared statement)
$sql = "SELECT Id FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);

// Eksekusi prepared statement
$stmt->execute();

// Bind the result variable
$stmt->bind_result($user_Id);

// Ambil hasil query
$stmt->fetch();

// Tutup prepared statement
$stmt->close();

// Tutup koneksi ke database
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tickme</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>


 
  <!-- Font Awesome CSS -->
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

    .kila1 {
      width: 100%;
      height: 80vh;
    }

    .kila3 {
      margin-top: 20px;
    }

    .kila4 {
      height: 62vh;
      justify-content: center;
      display: flex;
      overflow: auto;
    }

    .kila5 {
      width: 80%;
      height: 8vh;
      margin-top: 8px;
      border-radius: 20px;
      padding: 5px;
    }

    .kila7 {
      width: 100%;
    }

    .hidden {
      display: none;
    }
  </style>
  </head>

  <body>

    <!-- Navigation -->

    <nav class="navbar navbar-expand-lg navbar-light">
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
    <hr style=" width: 100%;border-top: 2px solid #000000;">


    <!-- Content -->

    <div class="kila1 row">
      <div class="col-2">
        <div>
          <i class="fas fa-paw " style="margin-left:100px; font-size: 25px; "></i>
        </div>
        <div>
          <i class="fas fa-paw " style="margin-left:60px; font-size: 25px; "></i>
        </div>
        <div>
          <i class="fas fa-paw " style="margin-left:150px; font-size: 20px; "></i>
        </div>
        <div>
          <i class="fas fa-paw " style="margin-left:110px; font-size: 20px; "></i>
        </div>
      </div>

      <div class="kila2 col-10">
        <h3 class="kila3">Add Your List</h3>
        <div class="kila4">
          <form class="kila5" method="post" action="tambah_list.php">
            <label for="item_name" class="form-label hidden"></label>
            <input type="text" id="item_name" name="user_id" value="<?php echo $user_Id; ?>" class="form-control hidden"
              value="">

            <label for="quantity" class="form-label">Name:</label>
            <input type="text" id="quantity" name="name" class="form-control">
            <br>
            <label for="date" class="form-label">Enter the reminder date:</label>
            <input type="date" id="date" name="date" class="form-control">
            <br>


            <button type="submit" class="btn btn-primary float-end">
              SUBMIT
            </button>
          </form>
        </div>
      </div>
      <div class="kila6">

      </div>



      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  </body>

</html>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>