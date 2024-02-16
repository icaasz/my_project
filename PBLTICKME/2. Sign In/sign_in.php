
<?php
//  menghubungkan ke database
include("koneksi.php");


$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input dari formulir
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Query untuk mencari pengguna dengan email yang sesuai
    $query = "SELECT * FROM user WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    // Ambil hasil query
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $user = mysqli_fetch_assoc($result)) {
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan informasi pengguna ke dalam sesi
            session_start();
            $_SESSION['username'] = $user['username']; 
            $pesan = "Login successful!";
            //  redirect setelah login berhasil
            header("Location:../5. Category/category.php");
            exit();
        } else {
            $pesan = "Incorrect password.";
        }
    } else {
        $pesan = "User not found.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Sign In Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body style="background-color:#e4dacf ;">

    <style>
        .form-group {
            margin-bottom: 1px;
        }

        .judul {
            margin-bottom: 1px;
        }
    </style>

    <div>
        <i class="fas fa-paw " style="margin-left:100px; font-size: 30px; "></i>
    </div>
    <div>
        <i class="fas fa-paw " style="margin-left:60px; font-size: 30px; "></i>
    </div>
    <div>
        <h2 align="center">TICKME</h2>
        <p align="center" style="color: #985A10;">Save money and time with Grocery Shopping Organizer</p>
    </div>

    <div class="row justify-content-center" style="margin-top: 2px;">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"
                    style="margin-top: 1px; margin-bottom: 1px; padding-top: 2px; padding-bottom: 2px;">
                    <h2 class="text-center">Sign In</h2>
                </div>
                <div class="card-body">
                    <!-- Menampilkan pesan setelah submit -->
                    <?php if (!empty($pesan)): ?>
                        <div class="alert <?php echo (strpos($pesan, 'successful') !== false) ? 'alert-success' : 'alert-danger'; ?>"
                            role="alert">
                            <?php echo $pesan; ?>
                        </div>
                    <?php endif; ?>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="email" placeholder="Enter your Email" class="form-control" name="email"
                                id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" placeholder="Enter your password" class="form-control"
                                name="password" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block"
                            style="border-radius: 40px; background-color:#985A10 ; margin-top: 3px;">Sign In</button>
                    </form>
                </div>
                <div class="card-footer text-muted text-center">
                    <p>Don't have an account? <a href="../3. Sign Up/sign_up.php">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>