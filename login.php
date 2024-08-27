<?php

include 'config.php';

error_reporting(0);

session_start();
if (isset($_SESSION['login'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM user WHERE user='$user' AND pass='$pass'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row['user'];
        $_SESSION['login'] = true;
        header("Location: login.php");
    } else {
        echo "<script>alert('User atau Password Anda salah. Silahkan coba lagi!')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap"
        rel="stylesheet" />

    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="dist/css/login.css" />
</head>

<body>
    <!-- <?php echo $_SESSION['error'] ?> -->
    <section style="background-image: url(assets/pens-gedung.jpg)" class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <!-- <h2 class="heading-section">Login #04</h2> -->
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <div
                                class="img"
                                style="background-image: url(assets/pens-gedung.jpg)"></div>
                            <div class="login-wrap p-4 p-md-5">
                                <div class="d-flex">
                                    <div class="w-100">
                                        <h5 class="mb-4">Welcome to Lab. Telephony</h5>
                                        <h3 class="mb-4">Sign In</h3>
                                    </div>
                                </div>
                                <form action="#" class="signin-form">
                                    <div class="form-group mb-3">
                                        <label class="label" for="name">Username</label>
                                        <input
                                            type="text"
                                            name="user"
                                            id="user"
                                            class="form-control"
                                            placeholder="Username"
                                            required
                                            autocomplete="off" />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="label" for="password">Password</label>
                                        <input
                                            type="password"
                                            name="pass"
                                            id="pass"
                                            class="form-control"
                                            placeholder="Password"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <button
                                            type="submit"
                                            name="submit"
                                            value="submit"
                                            class="form-control btn btn-primary rounded submit px-3">
                                            Sign In
                                        </button>
                                    </div>
                                    <!-- <div class="form-group d-md-flex">
                                        <div class="w-50 text-left">
                                            <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                                <input type="checkbox" checked />
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="w-50 text-md-right">
                                            <a href="#">Forgot Password</a>
                                        </div>
                                    </div> -->
                                </form>
                                <p class="text-center">
                                    Not a member? <a data-toggle="tab" href="#signup">Sign Up</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>