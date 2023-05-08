<!DOCTYPE html>
<html>
    <!-- od tu-->
<head>
    <meta charset="utf-8">
    <title>main</title>

    <link rel="stylesheet" href="<?php echo base_url('css_js\style.css')?>">
     <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css" 
    /><!-- o swiperju kasneje-->
    </head>
    <body>
        <header>
        <div class="nav moveleft" id= "menu">
            <div class="nav-icons">
                <div class="menu-icon"> <!-- dizajn za menu-->
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
            </div>
            <a href="<?php echo site_url('welcome/store');  ?>" class="logo moveleft">Game<span>Start</span></a> <!-- "logo"-->
            <div class="search-box"> <!-- searchbar-->
                <form action="<?php echo site_url('welcome/rezultati');  ?>" method="post">
                    <div class="searchbox">
                        <input type="text" name= "search" placeholder="Search">
                        <button id="search-btn" type="submit"><box-icon color = "white"name='search-alt-2'></box-icon></button>
                    </div>
                </form>
            </div>
           
            <div class="nav-icons moveright">
                <div class="iconclick"> <!-- gumb za košarico-->
                    <form action="<?php echo site_url('welcome/cart');  ?>" method="post">
                        <input type="submit" value="" class="click2">
                    </form>
                <box-icon name='cart' color = "white"></box-icon></div>
                <p><?php echo $_SESSION['username']." ";?> </p>
                <p><?php echo " $".$_SESSION['balance'];?></p>
            </div>
            <div class="menu"> <!-- menu+i ki je skrit-->
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
       <!--pa do tu imajo isto kodo tudi gamepage, rezultati, library in libResault ostale pa imajo podobno kodo samo da brez searchbara -->
        <section class="container">
            <div class="heading"> <!-- naslov + ikoma-->
                <box-icon name='flame' type='solid' color="white" ></box-icon>
                <h2>New and hot games</h2>
            </div>
    
        <div class="container mySwiper"> <!-- tukaj swiper omogoča da naš div scrollamo horizontalno-->
      <div class="swiper-wrapper">
      <?php foreach($featured as $row):?> <!-- gre čez array in za vsako igro naredi svoj izgled in povezavo do njihovega game page-a-->
        
        <div class="swiper-slide">
<div class="box" id="<?php echo $row->idgame?>"  onclick="getId(this)"> <!-- tukaj gumb dobi vrednost id igre-->
<form action="<?php echo site_url('welcome/gamepage');  ?>" method="POST">
<button class="click" type="submit" value="<?php echo $row->idgame;?>" name="submit"></button>
<img src="<?php echo base_url('uploads/').$row->coverImg?>" class = "box-img"alt="cover art">
<div class="box-text">
    <h3><?php echo $row->name?></h3>
    <h3><?php echo $row->genre?></h3>
    <div class="rating-price">
    <form action="<?php echo site_url('welcome/gamepage');  ?>" method="POST">
    <button class="click" type="submit" value="<?php echo $row->idgame;?>" name="submit"></button>
    <div class="rating">
        <box-icon name='star' color="white"></box-icon>
        <span><?php echo $row->avg;?></span>  
    </div>
    <h3><?php echo $row->displayPrice?></h3>
    </form>
    </div>
    
</div>
</form>
</div>


</div>
<?php endforeach;?>
        
       
      </div>
      <div class="swiper-scrollbar"></div>
    </div>
    
     </section> 
     <section class="container">
    <div class="heading">
    <box-icon name='football' color="white"></box-icon>
        <h2>Sport</h2>
    </div>

        <div class="container mySwiper">
      <div class="swiper-wrapper">
      <?php foreach($sport as $row):?> <!-- gre čez array in za vsako igro naredi svoj izgled in povezavo do njihovega game page-a-->
        
        <div class="swiper-slide">
<div class="box" id="<?php echo $row->idgame?>"  onclick="getId(this)"> <!-- tukaj gumb dobi vrednost id igre-->
<form action="<?php echo site_url('welcome/gamepage');  ?>" method="POST">
<button class="click" type="submit" value="<?php echo $row->idgame;?>" name="submit"></button>
<img src="<?php echo base_url('uploads/').$row->coverImg?>" class = "box-img"alt="cover art">
<div class="box-text">
    <h3><?php echo $row->name?></h3>
    <h3><?php echo $row->genre?></h3>
    <div class="rating-price">
    <form action="<?php echo site_url('welcome/gamepage');  ?>" method="POST">
    <button class="click" type="submit" value="<?php echo $row->idgame;?>" name="submit"></button>
    <div class="rating">
        <box-icon name='star' color="white"></box-icon>
        <span><?php echo $row->avg;?></span>  
    </div>
    <h3><?php echo $row->displayPrice?></h3>
    </form>
    </div>
    
</div>
</form>
</div>


</div>
<?php endforeach;?>
        
       
      </div>
      <div class="swiper-scrollbar"></div>
    </div>
</section>

<section class="container">
    <div class="heading">
    <box-icon name='joystick' color="white"></box-icon>
        <h2>Action</h2>
    </div>

        <div class="container mySwiper">
      <div class="swiper-wrapper">
      <?php foreach($action as $row):?> <!-- gre čez array in za vsako igro naredi svoj izgled in povezavo do njihovega game page-a-->
        
        <div class="swiper-slide">
<div class="box" id="<?php echo $row->idgame?>"  onclick="getId(this)"> <!-- tukaj gumb dobi vrednost id igre-->
<form action="<?php echo site_url('welcome/gamepage');  ?>" method="POST">
<button class="click" type="submit" value="<?php echo $row->idgame;?>" name="submit"></button>
<img src="<?php echo base_url('uploads/').$row->coverImg?>" class = "box-img"alt="cover art">
<div class="box-text">
    <h3><?php echo $row->name?></h3>
    <h3><?php echo $row->genre?></h3>
    <div class="rating-price">
    <form action="<?php echo site_url('welcome/gamepage');  ?>" method="POST">
    <button class="click" type="submit" value="<?php echo $row->idgame;?>" name="submit"></button>
    <div class="rating">
        <box-icon name='star' color="white"></box-icon>
        <span><?php echo $row->avg;?></span>  
    </div>
    <h3><?php echo $row->displayPrice?></h3>
    </form>
    </div>
    
</div>
</form>
</div>


</div>
<?php endforeach;?>
        
       
      </div>
      <div class="swiper-scrollbar"></div>
    </div>
</section>

<section class="container">
    <div class="heading">
    <box-icon name='cross' color="white"></box-icon>
        <h2>Shooter</h2>
    </div>
        <div class="container mySwiper">
      <div class="swiper-wrapper">
      <?php foreach($shooter as $row):?> <!-- gre čez array in za vsako igro naredi svoj izgled in povezavo do njihovega game page-a-->
        
        <div class="swiper-slide">
<div class="box" id="<?php echo $row->idgame?>"  onclick="getId(this)"> <!-- tukaj gumb dobi vrednost id igre-->
<form action="<?php echo site_url('welcome/gamepage');  ?>" method="POST">
<button class="click" type="submit" value="<?php echo $row->idgame;?>" name="submit"></button>
<img src="<?php echo base_url('uploads/').$row->coverImg?>" class = "box-img"alt="cover art">
<div class="box-text">
    <h3><?php echo $row->name?></h3>
    <h3><?php echo $row->genre?></h3>
    <div class="rating-price">
    <form action="<?php echo site_url('welcome/gamepage');  ?>" method="POST">
    <button class="click" type="submit" value="<?php echo $row->idgame;?>" name="submit"></button>
    <div class="rating">
        <box-icon name='star' color="white"></box-icon>
        <span><?php echo $row->avg;?></span>  
    </div>
    <h3><?php echo $row->displayPrice?></h3>
    </form>
    </div>
    
</div>
</form>
</div>


</div>
<?php endforeach;?>

        
       
      </div>
      <div class="swiper-scrollbar"></div>
    </div>
</section>

<section class="container">
            <div class="allheading">
            <box-icon type='solid' name='joystick' color="white"></box-icon>
                <h2>All games</h2>
            </div>
            <br>
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
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url('css_js\main.js')?>"></script>
    <script src="<?php echo base_url('css_js\list.js')?>"></script>
    </body>
    
</html>