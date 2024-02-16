
<?php
// Mengambil nilai category dari parameter kueri
if (isset($_GET['category'])) {
    // Sanitize the input to prevent SQL injection
    $category = filter_input(INPUT_GET, 'category', FILTER_VALIDATE_INT);

    if ($category === false || $category === null) {
        die("Invalid category parameter");
    }

    // Database Connection
    $conn = new mysqli('localhost', 'root', '', 'db_tickme');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM item2 WHERE category_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    // Memeriksa apakah query berhasil dijalankan
    if ($result) {
        // Menampilkan hasil query
    } else {
        echo "Query failed: " . $conn->error;
    }

    // Menutup koneksi
    $stmt->close();
    $conn->close();
} else {
    echo "<p>Kategori tidak diatur.</p>";
}
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

    .kila1 {
        background-color:white;
        height: 60vh;
        overflow:auto;
    }
   
    .kila2 {
        width:100%;
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

<h3 class="text-center">Item </h3>
<div class="container mt-5">
    <!-- Right Side - Product Categories -->
    <div class="col-lg-12 kila1 mb-4">
    <div class="col-lg-12 kila1">
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="col-md-12">
            <a href="tambah_item.php?id=<?php echo $row['id']; ?>&category=<?php echo $row['category_id']; ?>&nama=<?php echo urlencode($row['nama']); ?>" class="btn btn-primary btn-block mb-3" type="button" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Right popover"><?php echo $row['nama']; ?></a>
        </div>
    <?php } ?>
</div>

    </div>
</div>


  <div class="row " style="margin-left: 15px">
    <!-- paw bawah -->
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
    <!-- paw bawah meow -->
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
