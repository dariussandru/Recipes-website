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

    <title>My profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="index.php"> Logo</a></p>
        </div>

        <div class="right-links">
        <a href="index.php">Home</a>
        <a href="recipe.php"> View more</a>
            <a href="#">My profile</a>
            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $userName = $_POST['userName'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $passwprd = $_POST['password'];

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con,"UPDATE users SET UserName='$userName', Email='$email', Age='$age', Password='$passwprd' WHERE Id=$id ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
              echo "<a href='index.php'><button class='btn'>Go Home</button>";
       
                }
               }
               elseif(isset($_POST['delete'])){
                $id = $_SESSION['id'];
                $delete_query = mysqli_query($con,"DELETE FROM users WHERE Id=$id") or die("Error occurred while deleting account");
                if($delete_query){
                    // Dacă ștergerea a fost reușită, deconectăm utilizatorul și îl redirecționăm către pagina de autentificare sau acțiunea relevantă
                    session_destroy();
                    echo "<script>window.location='index.php'</script>";
                }
               }
               else{

                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['UserName'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                    $res_Password = $result['Password'];
                }

            ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="userName">Username</label>
                    <input type="text" name="userName" id="userName" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo $res_Age; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php echo $res_Password; ?>" autocomplete="off" required>
                </div>
                
                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Update" required>
                    <button type="submit" class="btn-delete" name="delete" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>