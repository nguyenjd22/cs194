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

<body class="d-flex h-100 text-center">
  <script src="https://unpkg.com/d3@5"></script>
  <script src="https://unpkg.com/d3-gridding@0.1"></script>
  <div class="cover-container d-flex w-100 h-100 flex-column">
    <table class="toolBar">
      <tr>
        <td class="menuItems">
          <a style="text-decoration: none;" href="homepage.php" class="menuItem">Home</a>
          <a style="text-decoration: none;" class="menuItem active" aria-current="page" href="#">About</a>
          <?php
          session_start();
          if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            echo '';
          } else {
            echo '<a style="text-decoration: none;" class="menuItem" href="datepicker.php">Create</a>';
          }
          ?>
          <a style="text-decoration: none;" class="menuItem" href="instructions.php">Help</a>
        </td>
        <td width="13%">
          <?php
          session_start();
          if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            echo '';
          } else {
            echo '<h5 class="nameToolbar">' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '</h5>';
          }
          ?>
        </td>
        <td width="10%">
          <?php
          session_start();
          if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
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
    <header class="mb-auto">
      <div>
        <?php
        session_start();
        ?>
      </div>
    </header>
    <main class="px-3 mx-10" id="authorizeBottom">
      <h1 class="textHeader">About Us</h1>
      <p class="lead">We are a group of Stanford Undergraduates who are passionate about sharing stories with others. With this project we aim to create a tool that helps social media users enhance the quality of their media posts. We help them by creating a one-of-a-kind capsule of their shared photo experiences.</p>
    </main>
    <footer class="mt-auto text-white-50">
      <p>Stanford CS194 Project Round-About</p>
    </footer>
  </div>
</body>
</html>