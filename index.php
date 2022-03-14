<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: homepage.php");
  exit;
}
?>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Authorize</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
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

    .username {
      color: #5a5a5a;
      font-weight: 700;
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="authorization.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-black">
  <script src="https://unpkg.com/d3@5"></script>
  <script src="https://unpkg.com/d3-gridding@0.1"></script>
  <div class="cover-container d-flex w-100 h-100 flex-column">
    <table class="toolBar">
      <tr>
        <td class="menuItems">
        </td>
        <td width="13%">
          <?php
          session_start();
          // Display user name if logged in
          if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            echo '';
          } else {
            echo '<h5 class="nameToolbar username">' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '</h5>';
          }
          ?>
        </td>
        <td width="10%">
          <button class="logoutButton">
            <a style="text-decoration: none;" class="logoutText" href="logout.php" margin-right="0px">Logout</a>
          </button>
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
    <div class="mainBox">
      <main class="px-3" id="authorizeBottom">
        <h1>Welcome To Round-About</h1>
        <p class="lead">Encapsulate and share your adventures with the world. Authorize your Instagram to get started!</p>
        <form>
          <form>
          </form>
          <button onclick="authorizeInstagram()" class="w-10 btn btn-lg btn-primary" color="white" type="submit">
            Authorize Instagram
          </button>
        </form>
      </main>
    </div>
    <footer class="mt-auto text-white-50">
      <p>Stanford CS194 Project Round-About</p>
    </footer>
  </div>
</body>
<script>
  // Redirect to authorization page to provide authorization info
  function authorizeInstagram() {
    window.location.href = 'https://www.instagram.com/oauth/authorize?client_id=978419269749571&redirect_uri=https://www.roundabout-cs194.com/&scope=user_profile,user_media&response_type=code';
  }

  // Setup and get necessary parameters for Instagram authorization
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  var container = document.getElementById('imageContainer');
  var docFrag = document.createDocumentFragment();
  var code = urlParams.get('code');

  if (code) {
    hideAuthorizeBottom();
    const client_secret = getClientSecret();
    getClientSecret().then(
      function(client_secret) {
        // Utilize Instagram client secret to get Instagram access token (necessary to make media requests)
        getAccessToken(client_secret);
      }
    );
  }

  /**
   * Get access token necessary to make Instagram Media object requests. 
   * Set access token as a cookie to be utilized by other pages.
   *
   * @param client_secret : string;
   */
  function getAccessToken(client_secret) {
    // Setup parameters for access token request
    const paramsToken = {
      client_id: '978419269749571',
      client_secret: client_secret,
      code: code,
      grant_type: 'authorization_code',
      redirect_uri: 'https://www.roundabout-cs194.com/',
    };

    var access_token;
    const optionForToken = getOption(paramsToken);
    fetch('https://api.instagram.com/oauth/access_token', optionForToken)
      .then(response => response.json())
      .then(response => {
        // Utilize access token as cookie s.t. collage.php and earth.php can use it
        access_token = "token=" + response["access_token"];
        document.cookie = access_token; // Set access token as cookie
        location.href = 'homepage.php'; // Redirect to date picker where we do the rest of the API calls
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  }

  /**
   * Return the client secret from secrets.php (similar to username and password)
   *
   * @return string
   */
  async function getClientSecret() {
    var client_secret;
    // Fetch client secret from secrets.php 
    await fetch('/secrets.php', {
        method: "GET",
        headers: {
          'Content-Type': 'application/json'
        },
      })
      .then(response => response.json())
      .then(response => {
        // Successfully got the client secret!
        client_secret = response["client_secret"];
      })
      .catch((error) => {
        console.error('Error:', error);
      });
    return client_secret;
  }


  /**
   * Removes authorization button
   */
  function hideAuthorizeBottom() {
    document.getElementById("authorizeBottom").remove();
  }

  /**
   * Return access token options
   *
   * @param params : { client_id, client_secret, code, grant_type, redirect_uri };
   * @return { method, headers, body }
   */
  function getOption(params) {
    var formBody = [];

    // Set up the form body via params's values
    for (var property in params) {
      var encodedKey = encodeURIComponent(property);
      var encodedValue = encodeURIComponent(params[property]);
      formBody.push(encodedKey + "=" + encodedValue);
    }
    formBody = formBody.join("&");

    return {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
      },
      body: formBody
    };
  }
</script>
</html>