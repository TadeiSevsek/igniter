<?php $check = 0;?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>My Cart</title>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        </style> 
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
        <div class="box-box-box-box">
        <div>    
        
        </div>
            <?php if(count($_SESSION['cart'])== 0):?>
                <div class="fluid">
                <h1>My Cart</h1>
            </div>
                <p>The cart is empty</p>
            <?php else:?>
                <div class="fluid" id="cart">
                <h1>My Cart</h1>
            </div>
            <div class="fluid" id="check" >
                <h1>Checkout</h1>
            </div>
            
            <div class="vrst">
            <div class="listitemsoutside">
             <!-- get the list of games working, removing on and checkout-->
               
                <?php foreach( $cart as $row):?>
                <div class="listitems">
                <div class="items">
            
                    <h2><?php echo $row->name;?></h2>
                    <h3><?php echo $row->displayPrice;?></h3>
                    <div class="iconclick">
                    <form action="<?php echo site_url('welcome/removeFromCart');  ?>" method="post">
                        <input type="hidden" name="remove" value="<?php echo $row->idgame;?>">
                        <input type="submit" name="delete" value="" class="click2">
                    </form>
                    <box-icon color="white"name='minus-circle'></box-icon></div>
                   <p><?php 
                  
                    ?></p>
                    
                </div>
                </div>
            <?php endforeach;?>
            </div>
            <div class="details">
            
            <?php if(count($_SESSION['cart'])==1):?>
            <form action="<?php echo site_url('welcome/addToLibrary');  ?>" method="post">
                <?php foreach ($cart as $row):?>
                    <input class="btn" type="submit" name="submit" value="<?php echo $row->displayPrice;?>">
                    <?php endforeach;?>
            </form>
            <?php else:?>
                
                <?php foreach ($cart as $row):?>
                    <h3><?php if($check!=0) {echo '+ '.$row->displayPrice;$check=1; }else {echo  $row->displayPrice; }  ?></h3>
                    <br>
                <?php $sest+=$row->price; endforeach;?>
                <form class="bottom" action="<?php echo site_url('welcome/addToLibrary');  ?>" method="post">
                    <input class="btn" type="submit" name="submit" value="<?php echo $sest.'$';?>">
            </form>
            <?php endif;?>
            </div>
            
                </div>
                <?php endif;?>
   
                <?php
                
                if($error!=""){
                    echo '<span class = "error">'.$error.'</span>';}
            ?>
             
        
                
        </div>
     
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url('css_js\main.js')?>"></script>
    </body>
</html>