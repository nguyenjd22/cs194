<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>About</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">



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
    <link href="AboutPage.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <?php
      /*
        session_start();
        echo '<h3 id="username" class="float-md-start mb-0">'.$_SESSION ['username'].'</h3>';
        */
        ?>
      <!-- <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link" href="index.php">Home</a>
        <a class="nav-link active" aria-current="page" href="#">About</a>
        <a href="logout.php" class="nav-link">Logout</a>
      </nav> -->
      <table class="nav nav-masthead justify-content-center float-md-end">
        <tr>
          <td width="80%">
            <nav class="nav nav-masthead justify-content-center float-md-end">
              <a class="nav-link" href="index.php">Home</a>
              <a class="nav-link active" aria-current="page" href="#">About</a>
              <a class="nav-link" href="datepicker.html">Create</a>
              <!-- <a href="logout.php" class="nav-link navbar-right" margin-right="0px">Logout</a> -->
            </nav>
          </td>
          <td width="20%">
            <a href="logout.php" class="nav-link" margin-right="0px">Logout</a>
          </td>
        </tr>
      </table>
    </div>
  </header>
  <main class="px-3">
    <h1>About Us</h1>
    <p class="lead">We are a group of Stanford Undergraduates who are passionate about sharing stories with others. With this project we aim to create a tool that helps social media users enhance the quality of their media posts. We help them by creating a one-of-a-kind capsule of their shared photo experiences.</p>
    <p class="lead">
    </p>
  </main>

  <footer class="mt-auto text-white-50">
    <p>Stanford CS194 Project Round-About</p>
  </footer>
</div>



  </body>
</html>
