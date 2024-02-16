<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "db_tickme";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Skrip untuk memeriksa pengingat
$today = date('Y-m-d', strtotime('today'));

// Ambil pengguna yang memiliki pengingat hari ini
$date_query = "SELECT u.username, l.name FROM user u
                  JOIN list2 l ON u.id = l.user_id
                  WHERE l.date = '$today'";

$date_result = $conn->query($date_query);

if ($date_result->num_rows > 0) {
    while ($date_row = $date_result->fetch_assoc()) {
        $username = $date_row['username'];
        $item_name = $date_row['name'];

        
        $insert_notification_query = "INSERT INTO notifications (username, message) 
                                      VALUES ('$username', 'Hey $username, you have $item_name that you haven\'t bought yet')";
        $conn->query($insert_notification_query);

    }
}

// Tutup koneksi ke database
$conn->close();
?>
