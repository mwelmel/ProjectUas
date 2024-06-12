<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">

        <?php 
        
         include("php/config.php");
         if(isset($_POST['submit'])){
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password

         //verifying the unique email    
         $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

         if(mysqli_num_rows($verify_query) > 0 ){
            echo "<div class='message'>
                    <p>This email is already used, please try another one.</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
         }
         else{
            $insert_query = "INSERT INTO users(Username, Email, Password) VALUES('$username', '$email', '$hashed_password')" or die("Error Occured");
            if(mysqli_query($con, $insert_query)){
                echo "<div class='message'>
                        <p>Sign Up successful!</p>
                      </div> <br>";
                echo "<a href='Login.php'><button class='btn'>Login Now</button></a>";
            }
            else{
                echo "<div class='message'>
                        <p>An error occurred during sign up. Please try again.</p>
                      </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
            }
         }
        }
        else{
        ?>
            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" name="submit" value="Sign Up" required>
                </div>
                <div class="links">
                    Already have an account? <a href="Login.php">Sign In</a>
                </div>

            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>