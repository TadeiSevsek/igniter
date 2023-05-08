<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Log In</title>
        <link rel="stylesheet" href="<?php echo base_url('css_js\style.css')?>">
        
     
       
    </head>
    <body>
        <div class="login-box">
        <form autocomplete="off" action="<?php echo site_url('welcome/preveriLogin');  ?>" method="post">
                <h1>Log in</h1>
                
                <div class="textbox">
                    <box-icon class = "icon"  name='user' color = "white"></box-icon>  <!-- ikone ki smo jih uvozili z boxicons.js-->
                    <input type="text" name="username" required placeholder="username">
                </div>
                <div class="textbox">
                    <box-icon color ="white" name='lock-open-alt' ></box-icon>
                    <input type="password" name="pass" required placeholder="password">
                </div>
                <p class = "msg">Don't have an account? <a href="<?php echo site_url('welcome/register');?>">Sign up</a></p>
                <?php
                
                if($error!=""){
                    echo '<span class = "error">'.$error.'</span>';}
            ?>

                
                <input class="btn" name ="submit" type="submit" value="Log in">
            </form>
            
        </div>

        <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script> <!-- uvoz ikon -->
    </body>
</html>