<?php include_once('header.php'); ?>

<?php include_once('nav.php'); ?>


<div class="container">
    <h3 class="my-3">Login Page</h3>

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
                $bs->displayAlert('Email is not exists', 'danger');
                //echo"<div class='alert alert-danger' role='alert'>Email is not exists</div> ";
            } else {
                if ($users->verifyPassword()){
                    //$bs->displayAlert('Email is not exists', 'danger');
                    //echo"<div class='alert alert-success' role='alert'>Password matches</div>";
                }else {
                    $bs->displayAlert('Password do not match', 'danger');
                    //echo"<div class='alert alert-success' role='alert'>Password do not match</div>";
                }
                //echo"<div class='alert alert-success' role='alert'>Email is exists</div>";
        }
    }
    ?>

    <link rel="stylesheet" href="BG-1.css">
    <link rel="stylesheet" href="font.css">

    <style>
    body {
        background-color: #E4E0E1 !important;
        font-family: "K2D", sans-serif;
    }

    </style>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="mb-3">

        <?php
        
         if (isset($_SESSION['success_message'])) {
             echo "<div class='success'>" . $_SESSION['success_message'] . "</div>";
             unset($_SESSION['success_message']); // ลบข้อความหลังแสดงแล้ว
         }
         
         if (isset($_SESSION['error_message'])) {
             echo "<div class='error'>" . $_SESSION['error_message'] . "</div>";
             unset($_SESSION['error_message']); // ลบข้อความหลังแสดงแล้ว
         }
         
        ?>
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" aria-describedby="email">
</div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" aria-describedby="password">
        </div>
        <button type="submit" name="signin" class="btn btn-primary">Sign in</button>
    </form>

    <p class="mt-3">Do not have an account yet? go to <a href="signup.php">Sign Up</a> page.</p>
    

    <hr>
    <a href="index.php" class="btn btn-secondary">Go back</a>
</div>


<?php include_once('footer.php'); ?>