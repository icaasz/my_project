<?php
$conn = new mysqli('localhost', 'root', '', 'db_tickme');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan bahwa formulir dikirimkan dengan metode POST

    // Ambil nilai id, name, price, dan quantity dari formulir
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';

    // Cari list_id dari tabel list2 berdasarkan name dengan prepared statement
    $list_id_query = "SELECT list_id FROM db_tickme.list2 WHERE name = ?";
    $list_id_statement = $conn->prepare($list_id_query);
    $list_id_statement->bind_param("s", $name);
    $list_id_statement->execute();
    $list_id_result = $list_id_statement->get_result();

    if (!$list_id_result) {
        die("Error getting list_id: " . $conn->error);
    }

    // Inisialisasi variabel list_id
    $list_id = '';

    // Periksa apakah ada hasil
    if ($list_id_result->num_rows > 0) {
        $list_id_row = $list_id_result->fetch_assoc();
        $list_id = $list_id_row['list_id'];

        // Setelah mendapatkan list_id, kirimkan data ke tabel list2_item2 dengan prepared statement
        $insert_query = "INSERT INTO db_tickme.list2_item2 (list2_id, item2_id, price, quantity) VALUES (?, ?, ?, ?)";
        $insert_statement = $conn->prepare($insert_query);
        $insert_statement->bind_param("iiid", $list_id, $id, $price, $quantity);

        if ($insert_statement->execute()) {
            header("Location: notif.php");
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    } else {
        echo "List ID not found for name: $name";
    }

    // Tutup prepared statements
    $list_id_statement->close();
    $insert_statement->close();
}

// Tutup koneksi
$conn->close();
?>
