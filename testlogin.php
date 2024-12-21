<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=K2D:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for centering */
        html, body {
            
            height: 100%;
            margin: 0;
        }
        
        body {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center;     /* Center vertically */
            background-color: #f5f5f5;
        }

        .card {
            width: 100%;
            max-width: 400px;
        }

        /* Adjust logo size */
        .logo {
            width: 120px; /* You can adjust the width of the logo as needed */
            height: auto;
            display: block;
            margin: 0 auto 20px; /* Center logo and add some space below */
        }
    </style>
</head>
<body class="bg-light">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
            <!-- Logo added here -->
            <img src="logosolar.png" alt="Logo" class="logo"> 

            <h3 class="text-center mb-4">Login</h3>

            <!-- Display Success/Error Message -->
            <?php
            session_start();
            if (isset($_SESSION['success_message'])) {
                echo '<div class="alert alert-success text-center">' . $_SESSION['success_message'] . '</div>';
                unset($_SESSION['success_message']); // Remove after displaying
            }

            if (isset($_SESSION['error_message'])) {
                echo '<div class="alert alert-danger text-center">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']); // Remove after displaying
            }
            ?>

            <!-- PHP Processing -->
            <?php
            include_once("config/Database.php");
            include_once("class/UserLogin.php");
            include_once("class/Utils.php");

            $connectDB = new Database();
            $db = $connectDB->getConnection();

            $users = new UserLogin($db);
            $bs = new Bootstrap();

            if(isset($_POST['signin'])) {
                $users->setEmail($_POST['email']);
                $users->setPassword($_POST['password']);
                
                if ($users->emailNotExists()) {
                    $bs->displayAlert('Email does not exist', 'danger');
                } else {
                    if ($users->verifyPassword()) {
                        // Successful login logic here
                        $bs->displayAlert('Login successful', 'success');
                    } else {
                        $bs->displayAlert('Password does not match', 'danger');
                    }
                }
            }
            ?>

            <!-- Login Form -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" name="signin" class="btn btn-primary w-100">Sign in</button>
            </form>
            
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">Don't have an account yet? <a href="testreg.php" class="text-decoration-none">Sign Up</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
