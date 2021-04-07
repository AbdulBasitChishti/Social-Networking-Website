<?php 
    include_once("config.php");
    session_start();
    $user = $_SESSION['user'];
    if(isset($_POST['submit'])){
        $subject = $_POST['subject'];
        $issue = $_POST['issue'];
        if(empty($subject) || empty($issue)){
            if(empty($subject)){
                $error = "Subject not specified!";
            }
            if(empty($issue)){
                $error = "Issue not specified!";
            }
        }
        else{
            $result = mysqli_query($mysqli,"INSERT INTO reports(username, topic, report) VALUES('$user','$subject','$issue')");
            $error = $result;
            if($result == false){
                $error = "Unable to send report!";
            }else{
                $sent = "Report sent";
                unset($subject);
                unset($issue);
                unset($error);
            }

        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font awesomee -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Sweat Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        :root{
            --parrot: #21c4ba;
            --light-gray: #ebebeb;
        }   
        body{
            background-color: #b3fff2;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h1,p{
            text-align: center;
        }
        .parrot{
            color: var(--parrot);
        }
        .container{
            margin-top: 5rem;
            padding-top: 2rem;
            padding-bottom: 2rem;
            background-color: white;
            box-shadow: 0px 0px 0.5rem 0.5rem #8cffeb;
        }
        #issue{
            resize: none;
            outline: none;
            overflow: hidden;
        }
        .form{
            margin: auto;
        }
        #submit{
            background-color: var(--parrot);
            color: white;
            font-weight: bold;
            margin-top: 1rem;
            outline:none !important;
        }
        .size20px{
            font-size: 20px;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <div class="report-div">
        <div class="container">
            <div class="col-lg-6 form">
                <h1 class="parrot">Report a problem!</h1>
                <p>We encourage to listen issues from you and fix them so that you can have better experience.</p>
            </div>
            <form action="report.php" method="post">
                <div class="col-lg-6 form form-group">
                    <label for="subject" class="parrot size20px">Suggest a topic</label>
                    <input type="text" name="subject" class="form-control" value="<?php if(isset($subject))echo $subject; ?>" id="subject" placeholder="Suggest a topic that best refer to the problem">
                    <label for="issue" class="parrot size20px">Enter details of the problem</label>
                    <textarea name="issue" id="issue" class="form-control" rows="10" placeholder="Enter the details of the problem you are facing" ><?php if(isset($issue))echo $issue; ?></textarea> 
                    <p class="error"><?php if(isset($error))echo $error;?></p>
                    <input type="submit" id="submit" name="submit" class="form-control"> 
                </div>
            </form>
                <div align="right" style="padding-right: 290px">
                    <a href="index.php" style="color: blue; text-decoration: underline;">Go back to home</a> 
                </div>
        </div>
    </div>
    
    <?php if(isset($sent)){?>
    <script type="text/javascript">
        swal("Report submited!", "", "success");
    </script>
    <?php } unset($sent); ?>

    <!-- Prevents from resubmission -->
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>