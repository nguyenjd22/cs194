<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Home | Round-About</title>

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
    <link href="homepage.css" rel="stylesheet">
  </head>
  <body>
    <table class="toolBar">
      <tr>
        <td class="menuItems">
          <a style="text-decoration: none;" href="#" class="menuItem active">Home</a>
          <a style="text-decoration: none;" class="menuItem" href="AboutPage.php">About</a>
          <a style="text-decoration: none;" class="menuItem" href="datepicker.php">Create</a>
          <a style="text-decoration: none;" class="menuItem" href="instructions.html">Help</a>
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
  <!-- <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Carousel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav> -->
</header>

<main>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <!-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg> -->
        <div class="img-gradient">
          <img class="firstCarousel" src="background-color2.png" width="100%" height="100%"/>
        </div>
        <div class="container">
          <div class="carousel-caption text-start">
            <?php
            session_start();
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
              echo '<h1>Welcome!</h1>';
              echo '<p>Welcome to Round-About, create a collage or interactive map that encapsulates your travel experiences.</p> <p><a class="btn btn-lg btn-primary" href="login.php">Sign up / Login</a></p>';
            } else {
              echo '<h1>Hello, '.$_SESSION ['first_name'].'</h1>';
              echo '<p>Welcome to Round-About, create a collage or interactive map that encapsulates your travel experiences.</p> <p><a class="btn btn-lg btn-primary" href="datepicker.php">Create</a></p>';
            }
            ?>
            <!-- <h1>Hello (NAME)</h1> -->
            <!-- <p>Welcome to Round-About, create a collage or interactive map that encapsulates your travel experiences.</p> -->

            <!-- <p><a class="btn btn-lg btn-primary" href="datepicker.php">Create</a></p>
            <p><a class="btn btn-lg btn-primary" href="login.php">Sign up/Login</a></p> -->
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <!-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg> -->
        <div class="img-gradient">
          <img src="carousel-image2.jpeg" width="100%" height="100%"/>
        </div>
        <div class="container">
          <div class="carousel-caption">
            <h1>Your journey in a capsule.</h1>
            <p>Discover what you can do with our website.</p>
            <p><a class="btn btn-lg btn-primary" href="#learnMore">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <!-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg> -->
        <div class="img-gradient">
          <img src="carousel-image3.jpeg" width="100%" height="100%"/>
        </div>
        <div class="container">
          <div class="carousel-caption">
            <h1>Quick how-to</h1>
            <p>Learn how to encapsulate your travel experiences at the click of a button.</p>
            <p><a class="btn btn-lg btn-primary" href="instructions.html">Instructions</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">


    <!-- START THE FEATURETTES -->

    <hr id="learnMore" class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Link Your Instagram Account</h2>
        <p class="lead">Authorize your Instagram account to let us access your social media account photos. </p>
      </div>
      <div class="col-md-5">
        <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
        <img src="instagram-logo.png" width="450" height="450" class="instaLogo"/>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Automatically Generate Travel Collages</h2>
        <p class="lead">Click through our different collage options, decide which one you like best and share with your friends.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
        <img src="collage-ad.png" width="500" height="500"/>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading"> Trace Your Journey </h2>
        <p class="lead"> Relive your global travel with our interactive map feature.</p>
      </div>
      <div class="col-md-5">
        <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg> -->
        <img src="globemap.png" width="550" height="500"/>
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; 2021-2022 Round-About &middot; </p>
  </footer>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


  </body>
</html>
