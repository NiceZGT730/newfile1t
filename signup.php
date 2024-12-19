<?php include_once('header.php'); ?>

<?php include_once('nav.php'); ?>

<div class="container">
    <h3 class="my-3">Login Page</h3>


    <?php 
        include_once('config/Database.php'); 
        include_once('class/UserRegister.php');
        include_once('class/Utils.php');

        $connectDB = new Database();
        $db = $connectDB->getConnection();
        
        $users = new UserRegister($db);
        $bs = new Bootstrap();


        if(isset($_POST['signup'])) {
            $users->setName($_POST['name']);
            $users->setEmail($_POST['email']);
            $users->setPassword($_POST['password' ]);
            $users->setConfirmPassword($_POST['confirm_password']);

        if (!$users->validatePassword()) {
            $bs->displayAlert('Password do not macht', 'danger');
            //echo '<div class="alert alert-danger" role="alert">Passwords do not match!</div>';
        }

        if (!$users->checkPasswordLength()) {
            $bs->displayAlert('Password must be at least 6 characters long.', 'danger');
            //echo '<div class="alert alert-danger" role="alert">Password must be at least 6 characters long.</div>';
        } 


        if ($users->checkEmail()) {
            $bs->displayAlert('This email is already exists try another', 'danger');
            //echo '<div class="alert alert-danger" role="alert">Email already exists!</div>';
        }
        
        if ($users->createUser()) {
            // หากสร้างผู้ใช้สำเร็จ
            $_SESSION['success_message'] = "Registration successful! Please login.";
            header("Location: signin.php"); // เปลี่ยนหน้าไป login.php
            exit();
        } else {
            // หากสร้างผู้ใช้ไม่สำเร็จ
            $_SESSION['error_message'] = "Registration failed. Please try again.";
            header("Location: signup.php"); // กลับไปหน้า register.php
            exit();
        }
    }
    
    ?>

<link rel="stylesheet" href="BG-1.css">
<link rel="stylesheet" href="font.css">

    <style>
    body {
        background-color: #E4E0E1 !important;
    }

    </style>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> " method="POST">
    <div class="mb-3">
            <label for="email" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" aria-describedby="Enter your name">
    </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" aria-describedby="Enter your email">
    </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" aria-describedby="Enter your password">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" aria-describedby="Confirm password">
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            I agree all statements in <a href="">Terms</a> of service
        </label>
        </div>
        <button type="submit" name="signup" class="btn btn-primary" style="margin-top: 20px;">Sign Up</button>
    </form>

    <p class="mt-3">Already have an account? go to <a href="signin.php">Sign In</a> page.</p>
    

    <hr>
    <a href="index.php" class="btn btn-secondary">Go back</a>
</div>


<?php include_once('footer.php'); ?>