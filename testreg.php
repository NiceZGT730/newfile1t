<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Register</h3>
                        
                        <!-- PHP Processing -->
                        <?php
                        include_once("config/Database.php");
                        include_once("class/UserRegister.php");
                        include_once("class/Utils.php");

                        $connectDB = new Database();
                        $db = $connectDB->getConnection();

                        $users = new UserRegister($db);
                        $bs = new Bootstrap();

                        // เก็บค่าจากฟอร์มในตัวแปร
                        $name = isset($_POST['name']) ? $_POST['name'] : '';
                        $email = isset($_POST['email']) ? $_POST['email'] : '';
                        $password = isset($_POST['password']) ? $_POST['password'] : '';
                        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

                        if (isset($_POST['signup'])) {
                            $users->setName($name);
                            $users->setEmail($email);
                            $users->setPassword($password);
                            $users->setConfirmPassword($confirm_password);

                            if (!$users->validatePassword()) {
                                $bs->displayAlert('Passwords do not match', 'danger');
                            } elseif (!$users->checkPasswordLength()) {
                                $bs->displayAlert('Password must be at least 6 characters long.', 'danger');
                            } elseif ($users->checkEmail()) {
                                $bs->displayAlert('This email already exists. Try another.', 'danger');
                            } else {
                                if ($users->createUser()) {
                                    session_start();
                                    $_SESSION['success_message'] = "Registration successful! Please login.";
                                    header("Location: testlogin.php");
                                    exit();
                                } else {
                                    $bs->displayAlert('Registration failed. Please try again.', 'danger');
                                }
                            }
                        }
                        ?>
                        
                        <!-- Registration Form -->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" value="<?php echo htmlspecialchars($password); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" value="<?php echo htmlspecialchars($confirm_password); ?>" required>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-decoration-none">Terms of Service</a>.
                                </label>
                            </div>
                            <button type="submit" name="signup" class="btn btn-primary w-100">Sign Up</button>
                        </form>
                        
                        <hr class="my-4">
                        <div class="text-center">
                            <p class="mb-0">Already have an account? <a href="signin.php" class="text-decoration-none">Sign In</a></p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="testlogin.php" class="btn btn-secondary">Go Back</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
