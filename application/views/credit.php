<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Credit Card</title>
        <link rel="stylesheet" href="<?php echo base_url('css_js\style.css')?>">
        
        
     
       
    </head>
    <body>
    <header>
        <div class="nav moveleft" id= "menu">
            <div class="nav-icons">
                <div class="menu-icon">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
            </div>
            <a href="<?php echo site_url('welcome/store');  ?>" class="logo moveleft">Game<span>Start</span></a>
            <div class="search-box">
                
            </div>
           
            <div class="nav-icons moveright">
                <div class="iconclick">
                    <form action="<?php echo site_url('welcome/cart');  ?>" method="post">
                        <input type="submit" value="" class="click2">
                    </form>
                <box-icon name='cart' color = "white"></box-icon></div>
                <p><?php echo $_SESSION['username']." ";?> </p>
                <p><?php echo " $".$_SESSION['balance'];?></p>
            </div>
            <div class="menu">
                <div class="navbar">
                    <li><a href="<?php echo site_url('welcome/store');  ?>">Store</a></li>
                    <li><a href="<?php echo site_url('welcome/library');  ?>">Library</a></li>
                    <li><a href="<?php echo site_url('welcome/addFunds');  ?>">Add funds</a></li>
                    <?php if($_SESSION['vrstaRacuna'] == 'admin'):?>
                        <li><a href="<?php echo site_url('welcome/addGames');  ?>">Add games</a></li>
                        <li><a href="<?php echo site_url('welcome/featuredGames');  ?>">Edit featured games</a></li>
                    <?php endif;?>
                    <li><a href="<?php echo site_url('welcome/logout');  ?>">Log out</a></li>
                </div>
            </div>
        </div>
        </header>


        <div class="login-box" id="big">
        <div class="fluid">    
        <h1>Credit Card</h1>
        </div>
            
            <form action="<?php echo site_url('welcome/preveriCredit');  ?>" method="post">
                
            <div class="textbox" id="seven">
                <input type="text" name="uporabnik" required placeholder="name/surname">
            </div>
            <div class="textbox" id="three">
                <input type="text" name="cvv" required placeholder="CVV">
            </div>
            <div class="textbox">
                <input type="text" name="stKartice" required placeholder="card number">
            </div>
            <div class="textbox" id="four">
                <input type="text"   name ="exp" placeholder="exp. MM/YY" required>
            </div>

            <div class="imgs" >
            <img src="<?php echo base_url('uploads/visa.jpg')?>" alt="">
            <img src="<?php echo base_url('uploads/mastercard.jpg')?>" alt="">
            <img src="<?php echo base_url('uploads/amex.jpg')?>" alt="">
            </div>
            <input class="btn" name ="credit" type="submit" value="Submit">
        

                
            
            <?php
                            
            if($error!=""){
                echo '<span class = "error">'.$error.'</span>';}
            ?>
            
            
            </form>
        
        </div>    

        
        <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url('css_js\main.js')?>"></script>
    
    </body>
</html>