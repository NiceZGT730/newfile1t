<?php
include_once('header.php');
include_once('nav.php');
?>

<!-- Main Container -->
<div class="container">
    <!-- Contact Button -->
    <div style="position: fixed; bottom: 20px; right: 20px;">
        <a href="contact.php" class="btn btn-primary btn-lg rounded-circle">
            <i class="bi bi-envelope"></i>
        </a>
    </div>

    <!-- Page Header -->
    <div class="text-centermy-5">
        <h1 class="display-4">Welcome to Solar System E-Learning</h1>
        <p class="lead">Explore and learn about the wonders of the solar system!</p>
    </div>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .profile-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            padding: 20px;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }
        .profile-header .user-info {
            flex-grow: 1;
        }
        .profile-header .user-info h2 {
            margin: 0;
            color: #333;
        }
        .profile-header .user-info p {
            margin: 5px 0;
            color: #666;
        }
        .profile-header .actions button {
            margin-right: 10px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .profile-header .actions button.edit {
            background-color: #4caf50;
            color: white;
        }
        .profile-header .actions button.upload {
            background-color: #2196f3;
            color: white;
        }
        .score-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .score-table th, .score-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .score-table th {
            background-color: #f8f8f8;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="profile-card">
        <!-- Profile Header -->
        <div class="profile-header">
            <img src="user-placeholder.jpg" alt="User Image" id="userImage">
            <div class="user-info">
                <h2 id="userName">John Doe</h2>
                <p id="userEmail">johndoe@example.com</p>
            </div>
            <div class="actions">
                <button class="edit">Edit Profile</button>
                <button class="upload">Upload Image</button>
            </div>
        </div>

        <!-- Score Table -->
        <table class="score-table">
            <thead>
                <tr>
                    <th>Test</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pre-Test</td>
                    <td id="scorePreTest">85</td>
                </tr>
                <tr>
                    <td>Chapter 1</td>
                    <td id="scoreChapter1">90</td>
                </tr>
                <tr>
                    <td>Chapter 2</td>
                    <td id="scoreChapter2">88</td>
                </tr>
                <tr>
                    <td>Chapter 3</td>
                    <td id="scoreChapter3">92</td>
                </tr>
                <tr>
                    <td>Chapter 4</td>
                    <td id="scoreChapter4">89</td>
                </tr>
                <tr>
                    <td>Post-Test</td>
                    <td id="scorePostTest">93</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        // This is where you can fetch data dynamically using AJAX and populate the fields
        // Example (dummy data for now):
        // document.getElementById("userName").textContent = "Jane Doe";
    </script>
</body>
</html>


<?php include_once('footer.php'); ?>
