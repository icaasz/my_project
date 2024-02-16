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
$user_id_stmt = $conn->prepare($user_id_query);
$user_id_stmt->bind_param("s", $username);

if (!$user_id_stmt->execute()) {
    die("User ID query failed: " . $user_id_stmt->error);
}

$user_id_result = $user_id_stmt->get_result();

// Check if the user_id exists
if ($user_id_result->num_rows > 0) {
    // Ambil user_id dari hasil query
    $user_id_row = $user_id_result->fetch_assoc();
    $user_id_session = $user_id_row['id'];

    // Retrieve Data sesuai dengan user_id sesi dari tabel 'tb_list2'
    $data_query = "SELECT name, date, list_id FROM db_tickme.list2 WHERE user_id = ?";
    $data_stmt = $conn->prepare($data_query);
    $data_stmt->bind_param("i", $user_id_session);

    if (!$data_stmt->execute()) {
        die("Data query failed: " . $data_stmt->error);
    }

    $result = $data_stmt->get_result();
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
      background-color:;
      width:100%;
      height:80vh;
    }

    .kila2 {
      background-color:;

    }

    .kila3{
      margin-top:20px;
    }

    .kila4 {
      border-radius:20px;
      background-color:white;
      height:62vh;
      justify-content:center;
      display:flex;
      overflow:auto;
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
      background-color:#985A10;
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
    <h3 class="kila3">Your Shopping List</h3>
    <form class="kila4">
    <div class="kila5">
    <?php
// ...

// mengambil Data sesuai dengan user_id sesi dari tabel 'tb_list2'
$data_query = "SELECT name, date, list_id FROM db_tickme.list2 WHERE user_id = '$user_id_session'";
$result = $conn->query($data_query);

if (!$result) {
    die("Data query failed: " . $conn->error);
}

// Tampilkan data
while ($row = $result->fetch_assoc()) {
  $item_id = $row['list_id'];
  echo "<div class='kila6' style='display:flex; justify-content: space-between; align-items:center;'>";
  echo "<a href='../9. isi/list.php?item_id=$item_id' class='kila6' style='color: white; text-decoration: none;'>" . $row['name'] . " - " . $row['date'] . "</a><br>";
  echo "<a href='delete_list.php?item_id=$item_id' class='btn btn-danger btn-sm ' style='border-radius:10px;'>Delete</a>";
  echo "</div>";  
}


?>

</div>
    </form>
</div>


    </form>      
    </div> 
    <div class="">

   <a type="button" class="btn btn-primary float-end" href="create.php">
  Create List
  </a>  
  <a type="button" class="btn btn-secondary float-end" href="../5. Category/category.php">
  Category
  </a>
    </div>











    
   



    <!-- Bootstrap JS and dependencies -->
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