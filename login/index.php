<?php
session_start();


if(!$_SESSION['authentication']){
    ?>
    <!DOCTYPE html>
<html>
    <head>
        <title>
            
        </title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <br><br><br><br><br><br><br>
        <center>
            <div style="width: 400px;height: 600px;background-color: transparent;">
                <div style="width: 400px;height: 50px">
                   <img src="../ric.png" style="width: 100px;height: 50px;">
                </div>
            <h2>Welcome to Ricst</h2>
            <span style="color: #fff;font-family: Open Sans,sans-serif;font-size: 14px;font-weight: 400;">Login with you <b>Ricst ID</b></span>
            <br><br><br><br><br>
               <form method="post" action="check_login.php">
                <input name="u_name" type="text" class="login_input_field" placeholder="Ricst ID">
                <br><br><br>
                <input name="password" type="password" class="login_input_field" placeholder="Password">
                <br><br><br><br>
                <input name="login" type="submit" value="Login" class="login_submit_button">
                <br><br><br><br>
                <span style="color: white;text-decoration: none;">
                    <a href="#">Forget Password?</a> &nbsp &nbsp | &nbsp &nbsp<a href="../signup">Create Account</a>
                </span>
               </form>
            </div>
        </center>
    </body>
</html>
    
    <?php
}
else{
    header('Location:../home');
    exit();
}

?>



