<?php
// Lakukan koneksi ke database (disesuaikan dengan konfigurasi Anda)
$conn = new mysqli('localhost', 'root', '', 'db_tickme');

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses edit form
if (isset($_POST['editItemId'])) {
    // Ambil data yang dikirimkan melalui formulir
    $itemId = $_POST['editItemId'];
    $newPrice = $_POST['editPrice'];
    $newQuantity = $_POST['editQuantity'];

    // Lakukan kueri SQL dengan prepared statement
    $sql_update = "UPDATE list2_item2 SET price=?, quantity=? WHERE item2_id=?";
    $stmt = $conn->prepare($sql_update);
    
    // Pencegahan SQL injection: Binding parameters
    $stmt->bind_param("dds", $newPrice, $newQuantity, $itemId);
    
    $result_update = $stmt->execute();

    // Periksa apakah kueri berhasil dieksekusi
    if ($result_update) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'error' => $stmt->error);
    }

    // Keluarkan respons dalam format JSON
    echo json_encode($response);
    exit();
}

// Proses penghapusan item
if (isset($_POST['delete_item'])) {
    $item_id_to_delete = $_POST['delete_item'];

    // Lakukan kueri SQL untuk menghapus item dari list2_item2
    $sql_delete = "DELETE FROM list2_item2 WHERE item2_id=?";
    $stmt_delete = $conn->prepare($sql_delete);
    
    // Pencegahan SQL injection: Binding parameters
    $stmt_delete->bind_param("s", $item_id_to_delete);
    
    $result_delete = $stmt_delete->execute();

    // Periksa apakah kueri berhasil dieksekusi
    if ($result_delete) {
        $response = array('success' => true, 'message' => 'Item deleted successfully.');
    } else {
        $response = array('success' => false, 'error' => $stmt_delete->error);
    }

    // Keluarkan respons dalam format JSON
    echo json_encode($response);
    exit();
}

// Tutup koneksi ke database
$conn->close();
?>
