<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}

// IS INSTAGRAM AUTHORIZED
?>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/classic.css">
  <link rel="stylesheet" href="css/classic.date.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="datepicker.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Create</title>
</head>

<body>
  <table class="toolBar">
    <tr>
      <td class="menuItems">
        <a href="homepage.php" class="menuItem">Home</a>
        <a class="menuItem" href="AboutPage.php">About</a>
        <a class="menuItem active" aria-current="page" href="#">Create</a>
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
        <button class="logoutButton">
          <a class="logoutText" href="logout.php" margin-right="0px">Logout</a>
        </button>
      </td>
    </tr>
  </table>


  <table class="datepicking">
    <tr class="headerRow">
      <th width="25%" class="tableCol header">
        Start Date
      </th>
      <th width="25%" class="tableCol header">
        End Date
      </th>
      <th width="25%" class="tableCol">
      </th>
      <th width="25%" class="tableCol">
      </th>
    </tr>
    <tr class="dateRow">
      <td class="tableCol">
        <form action="#">
          <div class="form-group">
            <input type="date" id="start">
          </div>
        </form>
      </td>
      <td class="tableCol">
        <form action="#">
          <div class="form-group">
            <input type="date" id="end" width="100%">
          </div>
        </form>
      </td>
      <td class="tableCol">
        <button onclick="setDatesInCookie()" class="buttonStyle">
          Generate Collage
        </button>
      </td>
      <td class="tableCol">
        <button onclick="goToMap()" class="buttonStyle">
          Generate Map
        </button>
      </td>

    </tr>
  </table>
  <script>
    function setDatesInCookie() {
      start = document.getElementById('start').valueAsDate;
      end = document.getElementById('end').valueAsDate;


      window.sessionStorage.setItem("start", getUnixTime(start));
      window.sessionStorage.setItem("end", getUnixTime(end));

      location.href = "collage.php";
    }

    function getUnixTime(date) {
      return Math.floor(date.getTime() / 1000);
    }

    function goToMap() {
      start = document.getElementById('start').valueAsDate;
      end = document.getElementById('end').valueAsDate;

      window.sessionStorage.setItem("start", getUnixTime(start));
      window.sessionStorage.setItem("end", getUnixTime(end));

      location.href = "countryPicker.php";
    }
  </script>
</body>
</html>