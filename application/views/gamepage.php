<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $game['name']?></title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo base_url('css_js\style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('css_js\steam.css')?>">
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
                <form action="<?php echo site_url('welcome/rezultati');  ?>" method="post">
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
                        <li><a href="<?php echo site_url('welcome/featuredGames');  ?>">Edit featured games</a></li>
                    <?php endif;?>
                    <li><a href="<?php echo site_url('welcome/logout');  ?>">Log out</a></li>
                </div>
            </div>
        </div>
        </header>
        <div class="box-box-box-box">
          <div class="vrst">
        <div class="box-box-box"> 
     <!-- v tem divu se naredi tisti "steam" video/ img player in zato imamo steam.js-->
    <div
      style="--swiper-navigation-color: #554994; --swiper-pagination-color: #fff" 
      class="swiper mySwiper2"
    >                                <!-- obarva puščice vijolično -->                             
      <div class="swiper-wrapper">
        <?php foreach( $img as $row):?> <!-- istu princip kot na store ko za vsako igro naredi ločeno škatlo-->
        <div class="swiper-slide">                         <!-- samo da tu naredi slike ali pa video-->
        <?php 
          $temp= explode('.',$row->img);
          $extension = end($temp);
          $path =base_url('uploads/').$row->img;
          if($extension=='mp4'){ 
            echo "<video controls><source src='".base_url('uploads/').$row->img."'></video>";
          } 
          else{
              echo "<img src='".base_url('uploads/').$row->img."'>";
           }
          ?>
        </div>
       <?php endforeach;?>
        
      </div>
      
      <div class="swiper-button-next"></div> <!-- tu bi bil v store scrollbar tu so pa puščice-->
      <div class="swiper-button-prev"></div>
    </div>
    <div thumbsSlider="" class="swiper mySwiper">
      <div class="swiper-wrapper">
      <?php foreach ($img as $row):?> <!-- še enkrat ponovljene vse slike in video (spodaj pod prikazano sliko)-->
        <div class="swiper-slide">
        <?php 
          $temp= explode('.',$row->img);
          $extension = end($temp);
          $path =base_url('uploads/').$row->coverImg;
          if($extension=='mp4'){ 
            echo "<video controls><source src='".base_url('uploads/').$row->img."'></video>";
          } 
          else{
            echo "<img src='".base_url('uploads/').$row->img."'>";
           }
          ?>
        </div>
        <?php endforeach;?>
        
        
      </div>
    </div>
</div>
          
<div class="info">
  <div class="fluid">
<?php foreach($info as $row):?>
  <h1><?php echo $row->name;?></h1>
  </div>
  <h3><?php echo "Genre: ".$row->genre;?></h3>
  <h3><?php echo "Date Published: ".$row->datePublished;?></h3>
  <h3><?php echo "Developed By: ".$row->developer;?></h3>
  <h3><?php echo "Game Studio: ".$row->studio;?></h3>
  <?php endforeach;?>

    <?php if($_SESSION['owned']==0):?>
      <form class="bottom" action="<?php echo site_url('welcome/addToCart');  ?>" method="post">
    <input class="btn" type="submit" value="Add to cart" name="submit">
    </form>
    <?php else:?>

        <?php foreach ($info as $row):?>
      <form class="bottom" action="download.php" method="get">
      <a class ="owned" id ="owned" name="gumb" href="<?php echo 'uploads/'.$row->exe?>"download>download</a>
      <?php endforeach;?>
      
      </form>
      
    <?php endif;?>
  </form>
</div>
</div>
<div class="vrst">
  <div class="desc">
    <div class="fluid">
    <h1>Description</h1>
    </div>
    <?php foreach($info as $row):?>
    <p><?php echo $row->description?></p>
    <?php endforeach;?>
  </div>
</div>
<div class="vrst">
  <div class="desc">
    <div class="fluid">
      <h1>Comments</h1>
    </div>
    <div class="comment">
    <div class="layout">
        <p style="margin-right:auto;"><?php echo $_SESSION['username'];?></p>
        <div>
        <form action="<?php echo site_url('welcome/comment');  ?>" method="post">
      <input type="hidden" name="rating" id="rating" required/>
      <ul onmouseout="resetRating();">
      <li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onclick="addRating(this);">★</li>
      <li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onclick="addRating(this);">★</li>
      <li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onclick="addRating(this);">★</li>
      <li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onclick="addRating(this);">★</li>
      <li class="star" onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onclick="addRating(this)">★</li>
    </ul> 
    </div>
    </div>
      <div class="textbox">
        <input type="text" name="comment" placeholder="Write a comment" required>
      </div>
      <input class="btn" type="submit" name="post" value="Post">
    </form>    
    </div>
      
    
    
    <?php foreach ($comment as $row):?>
      <div class="comment">
    <div class="layout">
        <p style="margin-right:auto;"><?php echo $row->username ;?></p>
        <div>
        <ul>
      <?php for ($j=1;$j<=5;$j++):?>
        <?php if($row->rating >=$j ):?>
      <li class="zvezda osvetjen" >★</li>
      <?php else:?>
        <li class="zvezda" >★</li>
      <?php endif;?>
      <?php endfor;?>
    </ul> 
    </div>
    </div>
     
      
     
     <p><?php echo $row->comment?></p>
    </div>
     
    <?php endforeach;?>
  </div>
</div>
</div>    
     
    

    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
     <script src="<?php echo base_url('css_js\main.js')?>"></script>
    <script src="<?php echo base_url('css_js\steam.js')?>"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('css_js\rating.js')?>"></script>
    
    </body>
    
</html>