<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
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
    <link rel="stylesheet" href="datepicker_style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Generate Collage</title>
  </head>
  <body>
    <!-- <nav class="nav nav-masthead justify-content-center float-md-end">
      <a class="nav-link" href="index.php">Home</a>
      <a class="nav-link active" aria-current="page" href="#">About</a>
      <a href="logout.php" class="nav-link navbar-right" margin-right="0px">Logout</a>
    </nav> -->

    <!-- <table class="nav nav-masthead justify-content-center float-md-end">
      <tr>
        <td width="80%">
          <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link active" aria-current="page" href="#">About</a>
          </nav>
        </td>
        <td width="20%">
          <a href="logout.php" class="nav-link" margin-right="0px">Logout</a>
        </td>
      </tr>
    </table> -->

    <table class="toolBar">
      <tr>
        <td class="menuItems">
            <a href="index.php" class="menuItem">Home</a>
            <!-- <a aria-current="page" href="#">About</a> -->
        <!-- </td>
        <td> -->
          <a  class="menuItem" href="AboutPage.php">About</a>
        <!-- </td>
        <td> -->
          <a  class="menuItem active" aria-current="page" href="#">Create</a>
        </td>
        <td width="10%">
          <button class="logoutButton">
            <a class="logoutText" href="logout.php" margin-right="0px">Logout</a>
          </button>
          <!-- <a class="menuItem" href="logout.php" margin-right="0px">Logout</a> -->
        </td>
      </tr>
    </table>


    <table class="datepicking">
      <tr class="headerRow" >
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
          <button onclick="setDatesInCookie()" class="buttonStyle">
            Generate GIF
          </button>
        </td>

      </tr>
    </table>



    <!-- <div class="content datepickercontent">
      <div class="container containerbox">
        <div class="row justify-content-center datepicking">
          <div class="col-lg-3">
            <h3 class="mb-5 text-center">Start Date</h2>
            <form action="#">
              <div class="form-group">
                <input type="date" id="start">
              </div>
            </form>
          </div>
          <div class="col-lg-3">
            <h3 class="mb-5 text-center">End Date</h2>
            <form action="#">
              <div class="form-group">
                <input type="date" id="end">
              </div>
            </form>
          </div>
          <div class="buttonPair">
            <button onclick="setDatesInCookie()" class="buttonStyle">
              Generate Collage
            </button>
            <button onclick="setDatesInCookie()" class="buttonStyle">
              Generate GIF
            </button>
          </div>
        </div>

      </div>
    </div> -->
  <script>
    function setDatesInCookie() {
      start = document.getElementById('start').valueAsDate;
      end = document.getElementById('end').valueAsDate;

      document.cookie = "start=" + getUnixTime(start);
      document.cookie = "end=" + getUnixTime(end);

      location.href = "collage.php";
    }

    function getUnixTime(date) {
      return Math.floor(date.getTime() / 1000);
    }
  </script>
</body>
</html>
