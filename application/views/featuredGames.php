<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edit Featured Games</title>

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
        <div class="box-box">
        <form autocomplete="off" action="<?php echo site_url('welcome/editFeatured');  ?>" method="POST" >
        <div class="fluid">    
        <h1>Featured Games</h1>
        </div>
        <?php $_SESSION['featured']=$igre;?>
            <?php foreach( $igre as $row):?>
            
                <h3><?php echo $row->name?></h3><input type="checkbox" name="<?php echo 'check'.$row->idgame?>" <?php if($row->featured==1){echo "checked"; } ?> ><br>
            <?php endforeach;?>
            
            
            
            
                <input class="btn" name ="submit" type="submit" value="Submit">
            </form>
        </div>

        <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url('css_js\main.js')?>"></script>
    </body>
</html>