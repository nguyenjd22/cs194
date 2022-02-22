<?php
  // session_start();
  // header("Content-Type: application/json"); 

  // try {
  //   $json_str = file_get_contents('php://input');
  //   $json_obj = json_decode($json_str, true);
  //   $username = $json_obj['username'];
  //   $password = $json_obj['password'];
  // ;

  //   // Storing session data
  //   if (isset($_SESSION ['username'])) {
  //   } else {
  //     $_SESSION ['username'] = $username;
  //   }
  //   echo json_encode(array(
  //     "success" => true
  //   ));
  // } catch (Exception $e) {
  //   echo json_encode(array(
  //     "Caught exception" => $e->getMessage()
  //   ));
  // }
  // Initialize the session
  session_start();
  
  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      header("location: welcome.php");
      exit;
  }
  
  // Include config file
  require_once "config.php";
  
  // Define variables and initialize with empty values
  $username = $password = "";
  $username_err = $password_err = $login_err = "";
  
  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">


    <!-- <img src="TR1020_WOM_Delta01.png" class="themephoto"/> -->
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
  </head>
  <body class="text-center">
  <main class="form-signin">
    <img src="4.png" class="logo"/>
    <form>
      <form>
      </form>
      <h1 class="Title">Round-About</h1>
      <h2 class="h3 mb-3 fw-normal">Please sign in</h2>
  
      <!-- <div class="form-floating">
        <input type="username" class="form-control" id="username" placeholder="Username">
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" placeholder="Password">
      </div> -->
      <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <!-- <label>Username</label> -->
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <!-- <label>Password</label> -->
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
  
      <!-- <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div> -->
      <!-- <button onclick="loginAjax()" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button> -->
      <!-- <p>Don't have an account yet? <a href="register.php">Register</a>.</p> -->
      <p>Testing php <a href="test.php">Test</a>.</p>
      <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
    </form>
  </main>

<script>
function loginAjax() {
    const username = document.getElementById("username").value; 
    const password = document.getElementById("password").value; 
    const data = { username: username, password: password};
    console.log(username);
    console.log(password);

    fetch("/login.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
          window.location.href='index.php';
        })
        .catch(err => console.error(err));
}

 </script>

  </body>
</html>

