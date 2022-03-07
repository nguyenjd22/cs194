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

<div class="cover-container d-flex w-100 h-100 flex-column">
  <table class="toolBar">
      <tr>
        <td class="menuItems">
          <a style="text-decoration: none;" href="index.php" class="menuItem">Home</a>
          <a style="text-decoration: none;" class="menuItem active" aria-current="page" href="#">About</a>
          <!-- GATING SYSTEM - AUTHORIZATION PAGE IF NOT AUTHORIZED; OTHERWISE - DATEPICKER -->
          <a style="text-decoration: none;" class="menuItem" href="datepicker.php">Create</a>

        </td>
        <td width="10%">
          <button class="logoutButton">
            <a class="logoutText" href="logout.php" margin-right="0px">Logout</a>
          </button>
          <!-- <a class="menuItem" href="logout.php" margin-right="0px">Logout</a> -->
        </td>
      </tr>
    </table>
  <header class="mb-auto">
    <div>
      <?php
      /*
        session_start();
        echo '<h3 id="username" class="float-md-start mb-0">'.$_SESSION ['username'].'</h3>';
        */
        ?>
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
