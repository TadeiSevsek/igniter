<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Library</title>

    <link rel="stylesheet" href="<?php echo base_url('css_js\style.css')?>">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>
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
                <form action="<?php echo site_url('welcome/libFilter');  ?>" method="post">
                    <div class="searchbox">
                        <input type="text" name= "search" placeholder="Search">
                        <button id="search-btn" type="submit"><box-icon color = "white"name='search-alt-2'></box-icon></button>
                    </div>
                </form>
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
                        <li><a href="<?php echo site_url('welcome/editFeatured');  ?>">Edit featured games</a></li>
                    <?php endif;?>
                    <li><a href="<?php echo site_url('welcome/logout');  ?>">Log out</a></li>
                </div>
            </div>
        </div>
        </header>
       

     <section class="container">
            <div class="allheading">
            <box-icon color="white" name='library'></box-icon>
                <h2>Library</h2>
            </div>
            <div class="listGame">
            <?php foreach ($igre as $row):?>
           
           <div class="content">
           <div class="box">
           <form action="<?php echo site_url('welcome/gamepage');  ?>" method="POST">
           <button class="click" type="submit" value="<?php echo $row->idgame;?>" name="submit"></button>
       <img src="<?php echo base_url('uploads/').$row->coverImg?>" class = "box-img"alt="cover art">
       <div class="box-text">
       <form action="<?php echo site_url('welcome/gamepage');  ?>" method="POST">
               <button class="click" type="submit" value="<?php echo $row->idgame;?>" name="submit"></button>
           <h3><?php echo $row->name?></h3>
           <h3><?php echo $row->genre?></h3>
           <div class="rating-price">
           <div class="rating">
               <box-icon name='star' color="white"></box-icon>
               <span> <?php echo $row->avg?></span>  
           </div>
           <h3><?php echo $row->displayPrice?></h3>
           </div>
       </form>
       </div>
       </form>      
   </div>
          
       </div> 
           </div>  
       <?php endforeach;?>
    </section>
     
     
     
    

    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url('css_js\main.js')?>"></script>
    <script src="<?php echo base_url('css_js\list.js')?>"></script>
    </body>
    
</html>