<nav class="navbar navbar-expand-lg bg-body-tertiary"> 

    <div class="container">

        <a class="navbar-brand px-3" href="index.php"><h2>Galaxy!</h2></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <!-- <li class="nav-item">

                <a class="nav-link active" aria-current="page" href="index.php">Home</a>

            </li> -->
            <?php if (isset($_SESSION['userid'])) { ?> 

<li class="nav-item mx-2" >

    <a class="btn btn-warning" href="welcome.php">E-lernning</a>

</li>

<li class="nav-item mx-2">
    
        <a  class="btn btn-primary" href="profileuser.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"></path>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"></path>
        </svg>
                        Viewprofile
    </a>
</li>

<?php } else{ }?>

        </ul>

        

        <ul class="navbar-nav">

            <?php if (isset($_SESSION['userid'])) { ?> 
                

            <li class="nav-item" >

                <a class="btn btn-danger" href="logout.php">Log out</a>

                <div class="icons">
                <div id="sidebar-toggle" class="icon">
                    <i class="fas fa-bars"></i>
                </div>

            </li>

            <?php } else{ ?>

            <li class="nav-item" style="margin-right: 10px;">

                <a class="nav-link" href="signin.php">LogIn</a>

            </li>

            <li class="nav-item">

                <a class="btn btn-primary" href="signup.php">Sign Up</a>

            </li>

            <?php } ?>

        </ul>



        </div>

    </div>

    </nav>



    <link rel="stylesheet" href="font.css">