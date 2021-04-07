<?php
    include_once("config.php");
    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($mysqli, $_POST['username']);
        $password = mysqli_real_escape_string($mysqli, $_POST['password']);
        if(empty($username) || empty($password)){
            if(empty($username)){
                $error="Username is required";
            }
            if(empty($password)){
                $error="Password is required";
            }
        }else{
            $result = mysqli_query($mysqli, "SELECT * FROM user WHERE Username = '$username' AND Password = '$password'");
            if(mysqli_num_rows($result)){
                session_start();
                $_SESSION["user"] = $username;
                header("Location: index.php");
            }
            else{
                $error="Invalid username or password!";
            }
        }
    }
    $mysqli->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../images/fav.png" type="image/png" sizes="16x16"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="container login-page">
        <div class="side-left">
            <img src="../images/login.jpg" alt="login.jpg">
        </div>
        <div class="side-right">
            <h2>User Login</h2>
            <div class="login-input-div">
                <form method="POST" action="#">
                    <input type="text" name="username" id="username" class="user-input marg10"placeholder="Username"> <b>
                    <input type="password" name="password" id="password" class="user-input marg10"placeholder="Password"> <br>
                    <?php if(isset($error)){ ?>
                    <div class=" container error">
                        <p class="err marg20"><?php echo $error;unset($error);?></p>
                    </div>
                    <?php }else{?>
                    <div class="marg20"></div>
                    <?php }?>
                    <input type="submit" name="login" id="login">
                </form>
            </div>
            <p class="log-text">Don't have an account yet?</p>
            <p><a id="log-btn" href="signup.php">Create Account</a></p>
        </div>
    </div>

    <!-- Prevents from resubmission -->
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>