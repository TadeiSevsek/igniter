<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Add Game</title>

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
        <div class="login-box" id = "menufix">
        <form autocomplete="off" action="<?php echo site_url('welcome/upload');  ?>" method="POST" enctype="multipart/form-data">
            <h1>Add Game</h1>
            <div class="textbox">
                <input type="text" name="name" required placeholder="Enter game name">
            </div>
            <div class="textbox">
                <input type="text" name="description" required placeholder="Enter game description">
            </div>
            <div class="textbox">
                <input type="number" name="price" required placeholder="Enter game price" min="0" step="0.01">
            </div>
            <div class="textbox">
                <input type="text" name="genre" required placeholder="Enter game genre">
            </div>
            <div class="textbox">
                <input type="text" name="developer" required placeholder="Enter game developer">
            </div>
            <div class="textbox">
                <input type="text" name="studio" required placeholder="Enter game studio">
            </div>

            <div class="textbox">
                <input type="text"  name="date" placeholder="Enter release date" onfocus="(this.type='date')" required>
                
            </div>
            <div class="textbox">
                <input name ="file-upload" id = "file-upload" type="file" onchange="javascript:updateList()" required>
                <label class = "labelBtn"for="file-upload">Upload</label>
                <span id = "filename"class="result">Upload cover img</span>
            </div>
            
            <div class="textbox">
                <input name ="file-upload2[]" id = "file-upload2"type="file" onchange="javascript:updateList2()" required>
                <label class = "labelBtn"for="file-upload2">Upload</label>
                <span id ="filename2" class="result">Upload exe file</span>
            </div>
            <div class="textbox">
                <input name ="file-upload1[]" id = "file-upload1"type="file" multiple = "multiple"onchange="javascript:updateList1()" required>
                <label class = "labelBtn"for="file-upload1">Upload</label>
                <span id ="filename1" class="result">Upload files(videos .mp4)</span>
            </div>
                <input class="btn" name ="submit" type="submit" value="Submit">
            </form>
        </div>

        <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url('css_js\main.js')?>"></script>
    </body>
</html>