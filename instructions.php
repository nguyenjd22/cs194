<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Instructions | Round-About</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <link href="instructions.css" rel="stylesheet">
  </head>
  <body>
    <table class="toolBar">
      <tr>
        <td class="menuItems">
          <a style="text-decoration: none;" href="homepage.php" class="menuItem">Home</a>
          <a style="text-decoration: none;" class="menuItem" href="AboutPage.php">About</a>
          <!-- GATING SYSTEM - AUTHORIZATION PAGE IF NOT AUTHORIZED; OTHERWISE - DATEPICKER -->
          <?php
            session_start();
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
              echo '';
            } else {
              echo '<a style="text-decoration: none;" class="menuItem" href="datepicker.php">Create</a>';
            }
          ?>
          <a style="text-decoration: none;" class="menuItem active" href="#">Help</a>
        </td>
        <td width="13%">
          <?php
          session_start();
          if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            echo '';
          } else {
            echo '<h5>'.$_SESSION['first_name'].' '.$_SESSION['last_name'].'</h5>';
          }
          ?>
        </td>
        <td width="10%">
          <?php
          session_start();
          if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            echo '<button class="logoutButton">
              <a style="text-decoration: none;" class="logoutText" href="login.php" margin-right="0px">Login</a>
            </button>';
          } else {
            echo '<button class="logoutButton">
              <a style="text-decoration: none;" class="logoutText" href="logout.php" margin-right="0px">Logout</a>
            </button>';
          }
          ?>
        </td>
      </tr>
    </table>
<header>
</header>

<main>

  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">


    <!-- START THE FEATURETTES -->


    <div class="row featurette">
      <div class="col-md-5">
        <h2 class="featurette-heading-main">How to use our website </h2>
      </div>
    </div>
    <hr class="featurette-divider">


    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Step 1: Sign up / Login </h2>
        <p class="lead">Click the Login button in the top navigation bar or on the home page to get started. </p>
      </div>
      <div class="col-md-5">
        <img src="signin.png"  height="100" class="create"/>
      </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Step 2: Link your Instagram account </h2>
        <p class="lead">Authorize your Instagram account to let us access your social media account photos.</p>
      </div>
      <div class="col-md-5">
        <img src="instagram-logo.png" width="150" height="150" class="instaLogo"/>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Step 3: Create</h2>
        <p class="lead">Click the Create button in the top navigation bar or on the home page to start creating content. </p>
      </div>
      <div class="col-md-5">
        <img src="create.png"  height="100" class="create"/>
      </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Step 4: Select a date range, create Collage / Interactive Map</h2>
        <p class="lead">Choose a date range to pick which pictures will be used from your Instagram. Then, choose to create either a collage or an interactive map. </p>
      </div>
      <div class="col-md-5">
        <img src="datepick.png" height="200" class="datepick"/>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Create a Collage</h2>
        <p class="lead"> Play around with the different buttons to customize your collage! Here are a couple features that we have: </p>
        <ul>
          <li>Choose a background that fits your aesthetic </li>
          <li>Choose between 4 different drawing patterns </li>
          <li>Click each draw button multiple times to randomly generate image location</li>
          <li>Download the collage to your local machine</li>
        </ul>
      </div>

      <div class="col-md-5 order-md-1">
        <img src="collage-ad.png" width="500" height="500"/>
      </div>

    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Create an Interactive Map </h2>
        <p class="lead">You have full control over what pictures you want in the visualization.</p>
        <ul>
          <li>Use the Select Image button to choose the image you want to location tag</li>
          <li>Tag the country corresponding to the selected image</li>
          <li>You can always delete images from the visualization </li>
          <li>When you are satisfied, click Generate Map</li>
        </ul>
      </div>
      <div class="col-md-5">
        <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
        <img src="locationselection.png" height="500"/>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading"> Enjoy the map visualization </h2>
        <p class="lead">You can screen record the visualization if you want to save it to your local machine</p>
      </div>
      <div class="col-md-5">
        <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
        <img src="earth.png"  height="500"/>
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; 2021-2022 Round-About &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


  </body>
</html>
