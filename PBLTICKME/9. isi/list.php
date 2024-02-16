<?php
// Ambil nilai item_id dari URL
$item_id = isset($_GET['item_id']) ? $_GET['item_id'] : '';

// Lakukan koneksi ke database (disesuaikan dengan konfigurasi Anda)
$conn = new mysqli('localhost', 'root', '', 'db_tickme');

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set nilai default untuk $nama_item
$nama_item = "Nama Item Tidak Ditemukan";

// Kueri SQL untuk mendapatkan nama dari tabel list2 sesuai dengan item_id
$sql = "SELECT name FROM list2 WHERE list_id = '$item_id'";
$result = $conn->query($sql);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ambil data dari hasil kueri
    $row = $result->fetch_assoc();

    // Periksa apakah data ditemukan
    if ($row) {
        $nama_item = $row['name'];
    } else {
        echo "Data not found for Item ID: $item_id";
    }
} else {
    echo "Query failed: " . $conn->error;
}

// Ambil nilai dari parameter 'item_id'
if (!empty($item_id)) {  
    // Query SQL untuk mencocokkan list2_id dan mengambil item2_id, price, dan quantity dari list2_item2
    $sql_list2_item2 = "SELECT item2_id, price, quantity FROM list2_item2 WHERE list2_id = '$item_id'";
    $result_list2_item2 = $conn->query($sql_list2_item2);

    
    if ($result_list2_item2) {
        
        if ($result_list2_item2->num_rows > 0) {
            // Inisialisasi array untuk menyimpan data dari list2_item2
            $list2_item2_data = array();

            // Loop untuk membaca semua hasil dari list2_item2
            while ($row_list2_item2 = $result_list2_item2->fetch_assoc()) {
                // Ambil data dari setiap baris hasil
                $item2_id = $row_list2_item2['item2_id'];
                $price = $row_list2_item2['price'];
                $quantity = $row_list2_item2['quantity'];

                // Query SQL untuk mencocokkan item2_id dan mengambil nama dari item2
                $sql_item2 = "SELECT id, nama FROM item2 WHERE id = '$item2_id'";
                $result_item2 = $conn->query($sql_item2);

                // Periksa apakah query item2 berhasil dieksekusi
                if ($result_item2) {
                    // Periksa apakah ada hasil yang ditemukan
                    if ($result_item2->num_rows > 0) {
                        // Ambil nama dari hasil query item2
                        $row_item2 = $result_item2->fetch_assoc();
                        $item_name = $row_item2['nama'];
                        $item_id2 = $row_item2['id'];

                        // Simpan data ke dalam array
                        $list2_item2_data[] = array('item_id' => $item_id2, 'item_name' => $item_name, 'price' => $price, 'quantity' => $quantity);
                    } else {
                        // Jika tidak ada hasil yang ditemukan untuk item2_id tertentu
                        $list2_item2_data[] = array('item_name' => "Nama tidak ditemukan untuk item2_id: $item2_id", 'price' => $price, 'quantity' => $quantity);
                    }
                } else {
                    // Jika query item2 tidak berhasil dieksekusi
                    $list2_item2_data[] = array('item_name' => "Error: " . $conn->error, 'price' => $price, 'quantity' => $quantity);
                }
            }
        } else {
            
            
        }
    } else {
        // Jika query list2_item2 tidak berhasil dieksekusi
        echo "Error: " . $conn->error;
    }
} else {
    // Jika parameter tidak ada
    echo "Parameter item_id tidak ditemukan dalam URL.";
}

// Proses edit form
if (isset($_POST['edit_item'])) {
  // Ambil data yang dikirimkan melalui formulir
  $selected_items = isset($_POST['item_checkbox']) ? $_POST['item_checkbox'] : array();
  $prices = isset($_POST['price']) ? $_POST['price'] : array();
  $quantities = isset($_POST['quantity']) ? $_POST['quantity'] : array();

  // Periksa apakah ada data yang dikirimkan
  if (!empty($selected_items) && !empty($prices) && !empty($quantities)) {
    // Loop untuk setiap item yang dipilih
    foreach ($selected_items as $index => $item_id2) {
      // Ambil harga dan kuantitas yang sesuai dengan indeks saat ini
      $price = $prices[$index];
      $quantity = $quantities[$index];

      // Lakukan kueri SQL untuk memperbarui data di database
      $sql_update = "UPDATE list2_item2 SET price='$price', quantity='$quantity' WHERE item2_id='$item_id2'";
      $result_update = $conn->query($sql_update);

      // Periksa apakah kueri berhasil dieksekusi
      if (!$result_update) {
        $response = array('success' => false, 'error' => $conn->error);
      } else {
        $response = array('success' => true, 'updated_price' => $price, 'updated_quantity' => $quantity);
      }
    }

    // Keluarkan respons dalam format JSON
    echo json_encode($response);
    exit();
  } else {
    $response = array('success' => false, 'error' => 'No data submitted for editing.');
    echo json_encode($response);
    exit();
  }
}




// Tutup koneksi ke database
$conn->close();
?>
<!-- ... (kode sisanya) -->





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

    .sticky-top {
      position: sticky;
      top: 0;
      z-index: 1000;
      background-color: #e4dacf;
      
    }

    .kila1 {
      background-color: ;
      width: 100%;
      height: 80vh;
    }

    .kila2 {
      background-color: ;

    }

    .kila3 {
      margin-top: 20px;
    }

    .kila4 {
      border:1px solid #000000;
      border-radius: 20px;
      background-color: #985A10;
      height: 62vh;
      justify-content: center;
      display: flex;
      overflow: auto;
      margin-bottom: 5px;
    }

    .kila5 {

      width: 80%;
      height: 8vh;
      margin-top: 8px;
      border-radius: 20px;
      padding: 5px;
    }

    .kila6 {
      margin-top: 7px;
      background-color: green;
      width: 100%;
      padding: 9px;
      border-radius: 20px;
      display: center;
      display: flex;
      justify-content: center;
    }

    .kila7 {
      width: 100%;
    }

    .kila8 {
      border-radius: 30px;
      background-color: #985A10;
      padding: 10px;
      display: flex;
      justify-content: center;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
      
    }


    td {
      border: 1px solid #ddd;
      background-color:#FFF8DC;
      
      margin: 10px;
      ;
      padding: 10px;
      
      text-align: left;
    
    }
  </style>
  </head>

  <body>

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
      <h3 class="kila3"> <?php echo "$nama_item"; ?></h3>
      <form class="kila4" method="post" action="proses_edit.php">

        <div class="kila5">
          
        <form id="addItemForm">
       
  
</form><br> 
        <input type="text" id="searchInput" placeholder="Search...">
    <button type="button" onclick="searchTable()" >Search</button>

    
            <table>
              <thead>
                <tr>
                  <th>Checklist</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($list2_item2_data)) {
                  foreach ($list2_item2_data as $index => $item2_data) {
                    echo "<tr id='row_$index'>";
                    echo "<td><input type='checkbox' name='item_checkbox[]'></td>";
                    echo "<td>{$item2_data['item_name']}</td>";
                    echo "<td><input type='text' name='price[]' value='{$item2_data['price']}'></td>";
                    echo "<td><input type='text' name='quantity[]' value='{$item2_data['quantity']}'></td>";
                    echo "<td><button type='button' class='btn btn-primary edit-btn' data-row-id='$index' data-toggle='modal' data-target='#editModal'>Edit</button></td>";
                    echo "<td><button type='button' class=' btn btn-danger delete-btn' data-item-id='$item2_id'>Delete</button></td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='5'>No items added yet.</td></tr>";
                }
                
                ?>
              </tbody>
            </table>
          </form>
        </div>
        <div class="row">
          <div class="col-12">
        <a href="../5. Category/category.php">
    <button style="border-radius:30px; " class="btn btn-primary">Select an item +</button></a>
    </div>
    </div><br>  

      <!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form Edit -->
        <form id="editItemForm">
          <div class="form-group">
            <label for="editPrice">Price:</label>
            <input type="text" class="form-control" id="editPrice" name="editPrice">
          </div>
          <div class="form-group">
            <label for="editQuantity">Quantity:</label>
            <input type="text" class="form-control" id="editQuantity" name="editQuantity">
          </div>
          <input type="hidden" id="editItemId" name="editItemId">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<div class="row ">
  <div class="col-6"style="">
<!-- Tambahkan tombol "Hitung Total Harga" -->
<button type="button" class="btn btn-success" id="hitungTotalHargaBtn" >Calculate Total Price</button>

  </div>



  <div class="col-6" style="border: 1px solid #000000 ; background-color:#985A10; width:300px;">
  <div id="totalHargaResult" style="color:white;" >Total Price:</div>

  </div>
</div>
<br>






      

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Bootstrap JS and dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

          <script>
  // Tangani klik tombol Edit
  $('.edit-btn').on('click', function () {
    var rowId = $(this).data('row-id');
    var itemData = <?php echo json_encode($list2_item2_data); ?>;
    var selectedItem = itemData[rowId];



    // Isi nilai modal dengan data yang dipilih
    $('#editPrice').val(selectedItem.price);
    $('#editQuantity').val(selectedItem.quantity);
    $('#editItemId').val(selectedItem.item_id);

    // Tampilkan modal
    $('#editModal').modal('show');
  });

  // Tangani klik tombol Simpan Perubahan
  $('#saveChangesBtn').on('click', function () {
    var editData = {
      editItemId: $('#editItemId').val(),
      editPrice: $('#editPrice').val(),
      editQuantity: $('#editQuantity').val()
    };
    console.log( editData );

    // Kirim data ke server untuk disimpan
    $.ajax({
      type: 'POST',
      url: 'proses_edit.php',
      data: editData,
      dataType: 'json',
      // before: function( editData ) {
      //   console.log( editData );
      // }
      success: function (response, xhr) {

        // console.log( response, xhr );

        if (response.success) {
          // Update tampilan setelah berhasil disimpan
          alert('Changes saved with success!');
          location.reload();
        } else {
          alert('Error: ' + response.error);
        }
      },
      error: function (response, error) {
        alert('Error communicating with the server.');
        console.log( response, error );
      }
    });
  });
</script>

<script>
    // Tangani klik tombol Delete
    $('.delete-btn').on('click', function () {
        var itemIdToDelete = $(this).data('item-id');

        // Kirim permintaan penghapusan ke server
        $.ajax({
            type: 'POST',
            url: 'proses_edit.php',
            data: { delete_item: itemIdToDelete },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Update tampilan setelah berhasil dihapus
                    alert('Item deleted successfully!');
                    location.reload();
                } else {
                    alert('Error: ' + response.error);
                }
            },
            error: function () {
                alert('Error communicating with the server.');
            }
        });
    });
</script>

<script>
  

  // Tangani klik tombol "Hitung Total Harga"
  $('#hitungTotalHargaBtn').on('click', function () {
    // Kirim permintaan ke server untuk menghitung total harga
    $.ajax({
  type: 'GET',
  url: 'hitung_total.php',
  data: { item_id: <?php echo json_encode($item_id); ?> },
  dataType: 'json',
  success: function (response) {
    if (response.success) {
      // Tampilkan total harga
      $('#totalHargaResult').html('<p>Total Price: ' + response.total_harga + '</p>');
    } else {
      alert('Error: ' + response.error);
    }
  },
  error: function (xhr, status, error) {

    console.log (xhr, status, error);
    alert('Error communicating with the server. Status: ' + status + ', Error: ' + error);
  }
});

  });
</script>

<script>
  function searchTable() {
    // Ambil nilai input dari search bar
    var searchText = document.getElementById('searchInput').value.toUpperCase();

    // Ambil semua baris data dalam tabel
    var rows = document.querySelectorAll('table tbody tr');

    // Loop melalui setiap baris dan sembunyikan yang tidak sesuai dengan kriteria pencarian
    rows.forEach(function(row) {
      var item_id = row.cells[1].textContent.toUpperCase();
      var price = row.cells[2].textContent.toUpperCase();
      var quantity = row.cells[3].textContent.toUpperCase();

      if (
        item_id.indexOf(searchText) > -1 ||
        price.indexOf(searchText) > -1 ||
        quantity.indexOf(searchText) > -1
      ) {
        // Tampilkan baris yang sesuai dengan pencarian
        row.style.display = '';
      } else {
        // Sembunyikan baris yang tidak sesuai
        row.style.display = 'none';
      }
    });
  }
</script>



</body>

</html>