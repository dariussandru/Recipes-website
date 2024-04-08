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
    <link rel="stylesheet" href="style/style-recipe.css">
    <link rel="icon" href="icons/icons8-pizza-48.png" type="image/x-icon" />
    <title>More recipes</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="index.php">Logo</a> </p>
            
        </div>
        
        <div class="right-links">
        <a href="index.php">Home</a>
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

    <header>
      <div class="search">
        <input
          type="text"
          id="searchInput"
          placeholder="Enter an ingredient..."
        />
        <button id="searchButton">Search</button>
      </div>
    </header>

    <div id="mealList" class="meal-list"></div>
    <div class="modal-container">
      <button id="recipeCloseBtn" class="close-button">&times;</button>
      <div class="meal-details-content">
        <!-- Content from js will be inserted here -->
      </div>
    </div>

    <script src="script-recipe.js"></script>


</body>
</html>