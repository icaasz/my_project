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

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'db_tickme');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan user_id dari tabel 'user' berdasarkan username
$user_id_query = "SELECT id FROM db_tickme.user WHERE username = ?";
$user_id_statement = $conn->prepare($user_id_query);
$user_id_statement->bind_param("s", $username);

if (!$user_id_statement->execute()) {
    die("User ID query failed: " . $user_id_statement->error);
}

$user_id_result = $user_id_statement->get_result();

// Cek apakah user_id ada
if ($user_id_result->num_rows > 0) {
    // Ambil user_id dari hasil query
    $user_id_row = $user_id_result->fetch_assoc();
    $user_id_session = $user_id_row['id'];

    // ambil data sesuai dengan user_id sesi dari tabel 'tb_list2'
    $data_query = "SELECT name, user_id FROM db_tickme.list2 WHERE user_id = ?";
    $data_statement = $conn->prepare($data_query);
    $data_statement->bind_param("i", $user_id_session);
    
    if (!$data_statement->execute()) {
        die("Data query failed: " . $data_statement->error);
    }

    $result = $data_statement->get_result();

    // Tampilkan data
} else {
    echo "User ID not found.";
}
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


  <!-- Bootstrap CSS
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
       -->
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
      /* Warna default */
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
      width:100%;
      height:80vh;
    }

    .kila3{
      margin-top:20px;
    }

    .kila4 {
      height:62vh;
      justify-content:center;
      display:flex;
      overflow:auto;
      background-color:#985A10;
    }

    .kila5 {
      width:80%;
      height: 8vh;
      margin-top:8px;
      border-radius:20px;
      padding:5px;
    }

    .kila6 {
      margin-top:7px;
      background-color:#FFF8DC;
      width:100%;
      padding:9px;
      border-radius:20px;
      display:center;
      display:flex;
      justify-content:center;
    }

    .kila7 {
      width:100%;
    }

    .hidden {
      display:none;
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
  <?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
?>
  <div class="kila2 col-10">
    <h3 class="kila3">Add Your List</h3>
    <div class="kila4">
    <div class="kila5">
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<form method='post' action='tambah.php'>";
        echo "<input type='hidden' name='id' value='$id'>";
        echo "<input type='hidden' name='name' value='" . $row['name'] . "'>";
        echo "<label class='sticky' for='price'>Price:</label>";
        echo "<input class='sticky' type='number' name='price' placeholder='Enter the price' min='0' step='any' required>";

        echo "<label class='sticky' for='quantity'>Quantity:</label>";
        echo "<input class='sticky' type='number' name='quantity' placeholder='Enter the quantity' min='0' required>";

        echo "<button type='submit' class='kila6'>" . $row['name'] . "</button>";
        echo "</form>";
    }
    ?>
</div>

        </div>
    </div>
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