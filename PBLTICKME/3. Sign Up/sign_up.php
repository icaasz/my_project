<?php
//  menghubungkan ke database
include("koneksi.php");


$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input dari formulir
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($koneksi, $_POST['confirmPassword']);

    
    if ($password != $confirmPassword) {
        $pesan = "Password and Confirm Password do not match.";
    } else {
        // Cek apakah email sudah terdaftar sebelumnya
        $queryCheckEmail = "SELECT * FROM user WHERE email = ?";
        $stmtCheckEmail = mysqli_prepare($koneksi, $queryCheckEmail);
        mysqli_stmt_bind_param($stmtCheckEmail, "s", $email);
        mysqli_stmt_execute($stmtCheckEmail);
        mysqli_stmt_store_result($stmtCheckEmail);

        if (mysqli_stmt_num_rows($stmtCheckEmail) > 0) {
            $pesan = "Email is already registered. Please use a different email.";
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user data into the database using prepared statement
            $query = "INSERT INTO user (email, username, password) VALUES (?, ?, ?)";
            
            $stmt = mysqli_prepare($koneksi, $query);

            // Bind parameter
            mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashedPassword);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Registrasi berhasil, simpan informasi ke dalam sesi
                session_start();
                $_SESSION['username'] = $username;
                
                $pesan = "Registration successful. You can now sign in.";
                
                // Redirect ke  create.php 
                header("Location:../2. Sign in/sign_in.php");
                exit(); 
            } else {
                $pesan = "Error: " . mysqli_error($koneksi);
            }
        
            mysqli_stmt_close($stmt);
        }
        mysqli_stmt_close($stmtCheckEmail);
    }

    mysqli_close($koneksi);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Sign Up Form</title>
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
            <div class="card-header" style="margin-top: 1px; margin-bottom: 1px; padding-top: 2px; padding-bottom: 2px;">
                <h2 class="text-center">Sign Up</h2>
            </div>
            <div class="card-body">
                <!-- Menampilkan pesan setelah submit -->
                <?php if (!empty($pesan)) : ?>
                    <div class="alert <?php echo (strpos($pesan, 'successfully') !== false) ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                        <?php echo $pesan; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" placeholder="Enter Email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" placeholder="Create Username" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" placeholder="Create Password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password:</label>
                        <input type="password" placeholder="Confirm Password" class="form-control" name="confirmPassword" id="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" style="border-radius: 40px; background-color:#985A10 ; margin-top: 3px;">Sign Up</button>
                </form>
            </div>
            <div class="card-footer text-muted text-center">
                <p>Already have an account? <a href="../2. Sign in/sign_in.php">Sign In</a></p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
