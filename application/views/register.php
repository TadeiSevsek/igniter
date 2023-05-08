
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sign Up</title>
        <link rel="stylesheet" href="<?php echo base_url('css_js\style.css')?>">
        
     
       
    </head>
    <body>
        <div class="login-box">
            <form autocomplete="off" action="<?php echo site_url('welcome/registracija');  ?>" method="post">
                <h1>Sign Up</h1>
                
                <div class="textbox">
                    <box-icon class = "icon"  name='user' color = "white"></box-icon>
                    <input type="text" name="username" required placeholder="Enter your username">
                </div>
                <div class="textbox">
                    <box-icon color="white" name='envelope' ></box-icon>
                    <input type="email" name="email" required placeholder="Enter your email">
                </div>
                <div class="textbox">
                    <box-icon color ="white" name='lock-open-alt' ></box-icon>
                    <input type="password" name="pass" required placeholder="Enter your password">
                </div>
                <div class="textbox">
                    <box-icon class = "icon" name='lock-alt' color = "white" ></box-icon>
                    <input type="password" name="conPass" required placeholder="Confirm your password">
                </div>
                <p class = "msg">Already have an account? <a href="<?php echo site_url('welcome/login')?>">Log in</a></p>
                <?php
                if($error!=""){
                        echo '<span class = "error">'.$error.'</span>';}
                ?>
                <input class="btn" name ="submit" type="submit" value="Sign in">
            </form>
        </div>

        <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    </body>
</html>