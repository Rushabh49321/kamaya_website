<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kamya Textile Mills Pvt. Ltd.</title>
    <link rel="icon" href="./assets/images/kamya-white.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <img src="./assets/images/kamya-white.png" style="height: 50px;">
                        </div>
                        <h3 class="text-center mb-4" style="text-align: center;">Admin Login</h3><br>
                        
                        <?php
                        // Check if the form is submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Check if username and password are set
                            if (isset($_POST["username"]) && isset($_POST["password"])) {
                                // Replace the following with your actual authentication logic
                                $username = $_POST["username"];
                                $password = $_POST["password"];

                                // Example: Check if the username and password match a predefined set of credentials
                                if ($username === "admin" && $password === "admin") {
                                    // Authentication successful
                                    // You can store additional information in the session if needed
                                    session_start();
                                    $_SESSION["username"] = $username;

                                    // Redirect to index.php
                                    header("Location: index.php");
                                    exit();
                                } else {
                                    // Authentication failed
                                    echo '<p class="text-danger">Invalid username or password</p>';
                                }
                            }
                        }
                        ?>

                        <form action="#" method="post" class="login-form">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control rounded-left" placeholder="Username" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
