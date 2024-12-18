<?php include_once('header.php'); ?>
<?php include_once('nav.php'); ?>

<div class="container">
    <h3 class="my-4 text-center">Login to Solar System E-learning</h3>

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
                if ($users->verifyPassword()){
                    header("Location: dashboard.php"); // Redirect to dashboard
                    exit();
                } else {
                    $bs->displayAlert('Password does not match', 'danger');
                }
            }
        }
    ?>

    <link rel="stylesheet" href="BG-1.css">
    <link rel="stylesheet" href="font.css">

    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            font-family: "K2D", sans-serif;
            color: #fff;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8px);
        }

        .form-label {
            font-weight: bold;
            color: #f0f0f0;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 5px;
            color: #fff;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        .btn-primary {
            background: #4CAF50;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #45A049;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        a {
            color: #00e6e6;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #00b3b3;
        }
    </style>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" name="signin" class="btn btn-primary w-100">Sign In</button>
    </form>

    <p class="mt-3 text-center">Don't have an account? <a href="signup.php">Sign Up</a></p>
    <hr>
    <div class="text-center">
        <a href="index.php" class="btn btn-secondary">Go Back</a>
    </div>
</div>

<?php include_once('footer.php'); ?>
