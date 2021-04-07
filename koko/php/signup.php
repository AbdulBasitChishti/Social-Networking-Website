<?php
    include_once("config.php");
    if(isset($_POST['signup'])){
        $name = mysqli_real_escape_string($mysqli, $_POST['name']);
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $usern = mysqli_real_escape_string($mysqli, $_POST['username']);
        $pass = mysqli_real_escape_string($mysqli, $_POST['password']);
        if(empty($name) || empty($email) || empty($usern) || empty($pass)){
            if(empty($pass)){
                $error = "Password is required";
            }
            if(empty($usern)){
                $error = "Username is required";
            }
            if(empty($email)){
                $error = "Email is required!";
            }
            if(empty($name)){
                $error = "Name is required!";
            }           
        }else{
            $uppercase = preg_match('@[A-Z]@', $pass);
            $lowercase = preg_match('@[a-z]@', $pass);
            $number    = preg_match('@[0-9]@', $pass);
            $specialChars = preg_match('@[^\w]@', $pass);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL) || (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8)){
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error = "Invalid Email Address!";
                }
                if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
                    $error = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
                }
            }else{
                $result = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$usern'");
                if(mysqli_num_rows($result)>0){
                    $error = "Username already exists. Please Log in!";
                }
                else{
                    $result = mysqli_query($mysqli, "INSERT INTO user(Username, Password) VALUES('$usern', '$pass')") or die("Cannot save record");
                    $result = mysqli_query($mysqli, "INSERT INTO user_details(username, Full_Name, Email) VALUES('$usern', '$name', '$email')") or die("Cannot save record");
                    session_start();
                    $_SESSION["user"] = $usern;
                    header("Location: index.php");
                    if(!$result){
                        $error = "Unable to sign up!";
                    }
                }
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
    <title>Sign Up</title>
    <link rel="icon" href="../images/fav.png" type="image/png" sizes="16x16"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="container login-page">
        <div class="side-left">
            <img src="../images/signup.jpg" alt="signup.jpg">
        </div>
        <div class="side-right">
            <h2>Create Account</h2>
            <div class="login-input-div">
                <form method="POST" action="#">
                    <input type="text" name="name" id="name" class="user-input" value="<?php if(isset($name))echo $name;?>" placeholder="Full Name"> <br>                 
                    <input type="text" name="email" id="email" class="user-input marg5" value="<?php if(isset($email))echo $email;?>" placeholder="Email"> <br>
                    <input type="text" name="username" id="username" class="user-input marg5" value="<?php if(isset($usern))echo $usern;?>" placeholder="Username"> <br>
                    <input type="password" name="password" id="password" class="user-input marg5" value="<?php if(isset($pass))echo $pass;?>" placeholder="Password"> <br>
                    <?php if(isset($error)){ ?>
                    <div class="container error">
                        <p class="err marg20"><?php echo $error; unset($error);?></p>
                    </div>
                    <?php }else{?>
                    <div class="marg20"></div>
                    <?php }?>
                    <input type="submit" name="signup" class="marg20"id="login">
                </form>
            </div>
            <p class="log-text">Already have an account?</p>
            <p><a id="log-btn" href="login.php">Login</a></p>
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