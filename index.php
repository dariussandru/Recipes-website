<?php 
   session_start();
   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: login.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" href="icons/icons8-pizza-48.png" type="image/x-icon" />
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="index.php">Logo</a> </p>
            
        </div>
        
        <div class="right-links">
        <a href="#">Home</a>
        <a href="recipe.php"> View more</a>
            <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['UserName'];
                $res_Email = $result['Email'];
                $res_Age = $result['Age'];
                $res_id = $result['Id'];
            }
            
            echo "<a href='edit.php?Id=$res_id'>My profil</a>";
            ?>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>


    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Uname ?></b>, what are you eating today?</p>
            </div>
          </div>
       </div>
    </main>



    <div class="container-search" id="home">
      <div class="search-box">
        <input type="text" id="search-input" placeholder="Type Dish Name..." />
        <button id="search-button">Search</button>
      </div>
      <div id="result"></div>
    </div>

    <script src="script.js"></script>

</body>
</html>