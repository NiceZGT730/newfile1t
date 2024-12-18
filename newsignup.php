<?php include_once('header.php'); ?>
<?php include_once('nav.php'); ?>



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
            $users->setPassword($_POST['password']);
            $users->setConfirmPassword($_POST['confirm_password']);

            if (!$users->validatePassword()) {
                $bs->displayAlert('Passwords do not match', 'danger');
            }

            if (!$users->checkPasswordLength()) {
                $bs->displayAlert('Password must be at least 6 characters long.', 'danger');
            } 

            if ($users->checkEmail()) {
                $bs->displayAlert('This email already exists. Try another.', 'danger');
            }
            
            if ($users->createUser()) {
                $bs->displayAlert('User created successfully!', 'success');
            } else {
                $bs->displayAlert('Failed to create user!', 'danger');
            }
        }
    ?>

    <link rel="stylesheet" href="BG-1.css">
    <link rel="stylesheet" href="font.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "K2D", sans-serif;
            color: #fff;
            overflow: auto; /* Allow scrolling */
        }

        canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .nav {
            width: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            padding: 10px;
            text-align: center;
        }

        .nav a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nav a:hover {
            color: #00e6e6;
        }

        .container {

        }
        .containerform {
            max-width: 30%;
            width: 70%;
            margin: 0 auto;
            margin-top: 60px;
            margin-bottom: 15%;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(8px);
            box-sizing: border-box;
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

        .form-check-input:checked {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            .nav {
                padding: 15px;
            }

            .form-label {
                font-size: 14px;
            }

            .form-control {
                font-size: 14px;
            }
        }

    </style>
<div class="containerform">
<h3 class="my-4 text-center">Sign Up for E-learning <br>Solar System</h3>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm your password" required>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
            <label class="form-check-label" for="flexCheckDefault">
                I agree to all statements in the <a href="#">Terms of Service</a>
            </label>
        </div>
        <button type="submit" name="signup" class="btn btn-primary w-100 mt-3">Sign Up</button>
    </form>

    <p class="mt-3 text-center">Already have an account? <a href="signin.php">Sign In</a></p>
    <hr>
    <div class="text-center">
        <a href="index.php" class="btn btn-secondary">Go Back</a>
    </div>
</div>

<canvas id="starfield"></canvas>
<script type="module">
    import * as THREE from "https://cdn.jsdelivr.net/npm/three@0.153.0/build/three.module.js";

    function getStarfield({ numStars = 500 } = {}) {
        function randomSpherePoint() {
            const radius = Math.random() * 25 + 25;
            const u = Math.random();
            const v = Math.random();
            const theta = 2 * Math.PI * u;
            const phi = Math.acos(2 * v - 1);
            let x = radius * Math.sin(phi) * Math.cos(theta);
            let y = radius * Math.sin(phi) * Math.sin(theta);
            let z = radius * Math.cos(phi);

            return {
                pos: new THREE.Vector3(x, y, z),
                hue: 0.6,
            };
        }
        const verts = [];
        const colors = [];
        for (let i = 0; i < numStars; i += 1) {
            const { pos, hue } = randomSpherePoint();
            verts.push(pos.x, pos.y, pos.z);
            const col = new THREE.Color().setHSL(hue, 0.8, Math.random() * 0.5 + 0.5);
            colors.push(col.r, col.g, col.b);
        }
        const geo = new THREE.BufferGeometry();
        geo.setAttribute("position", new THREE.Float32BufferAttribute(verts, 3));
        geo.setAttribute("color", new THREE.Float32BufferAttribute(colors, 3));
        const mat = new THREE.PointsMaterial({
            size: 0.2,
            vertexColors: true,
        });
        const points = new THREE.Points(geo, mat);
        return points;
    }

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 50;

    const renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('starfield') });
    renderer.setSize(window.innerWidth, window.innerHeight);

    const starfield = getStarfield();
    scene.add(starfield);

    function animate() {
        requestAnimationFrame(animate);
        starfield.rotation.y += 0.001;
        renderer.render(scene, camera);
    }

    animate();
</script>

<?php include_once('footer.php'); ?>
