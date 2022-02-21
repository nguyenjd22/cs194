<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Cover Template · Bootstrap v5.1</title>

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
    <link href="cover.css" rel="stylesheet">

  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <?php
        session_start();
        echo '<h3 id="username" class="float-md-start mb-0">'.$_SESSION ['username'].'</h3>';
        ?>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="AboutPage.php">About</a>
      </nav>
    </div>
  </header>

  <main class="px-3" id="authorizeBottom">
    <h1>Welcome To Round-About</h1>
    <p class="lead">Encapsulate and share your adventures with the world. Authorize your Instagram to get started!</p>    
    <form>
      <form>
      </form>
      <button onclick="authorizeInstagram()" class="btn btn-lg btn-secondary fw-bold border-white bg-white" type="submit">
        Authorize Instagram
      </button>
    </form>
  </main>

  <div id='imageContainer'></div>

  <footer class="mt-auto text-white-50">
    <p>Stanford CS194 Project Round-About</p>
  </footer>
</div>
  </body>

  <script>

function authorizeInstagram() {
  window.location.href='https://www.instagram.com/oauth/authorize?client_id=978419269749571&redirect_uri=https://www.roundabout-cs194.com/&scope=user_profile,user_media&response_type=code';
}

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
var container = document.getElementById('imageContainer');
var docFrag = document.createDocumentFragment();
var code = urlParams.get('code');

if (code) {
  hideAuthorizeBottom();
  const client_secret = getClientSecret();
  getClientSecret().then(
    function(client_secret) {getAccessToken(client_secret);}
  );
}

function getAccessToken(client_secret){
  const paramsToken = {
    client_id: '978419269749571',
    client_secret: client_secret,
    code: code,
    grant_type: 'authorization_code',
    redirect_uri: 'https://www.roundabout-cs194.com/',
  };
  var access_token;
  const optionForToken = getOption(paramsToken);
  fetch( 'https://api.instagram.com/oauth/access_token', optionForToken )
  .then( response => response.json() )
  .then( response => {
      access_token = response["access_token"];
      getUserData(access_token);
  })
  .catch((error) => {
    console.error('Error:', error);
  });
}


async function getClientSecret() {
  var client_secret;
  await fetch('/secrets.php', {
      method: "GET",
      headers: {
      'Content-Type': 'application/json'
    },
  })
  .then( response => response.json() )
  .then( response => {
    client_secret = response["client_secret"];
  })
  .catch((error) => {
    console.error('Error:', error);
  });
  return client_secret;
}


function hideAuthorizeBottom() {
  document.getElementById("authorizeBottom").remove();
}

function getMediaData(data, access_token) {
  data.forEach(function(item) {
      const mediaID = item["id"];
      var url = 'https://graph.instagram.com/'+ mediaID + '?fields=media_type,media_url,timestamp&access_token='+access_token;
      fetch(url)
      .then( response => response.json() )
      .then( response => {
          if (response["media_type"] == "IMAGE"){
            var img = document.createElement('img');
            img.src = response["media_url"];
            docFrag.appendChild(img);
            container.appendChild(docFrag);

            // put image into server
            fetch("/imageProcessor.php", {
                method: 'POST',
                body: JSON.stringify({
                  image_url: response["media_url"]
                }),
                headers: { 'Content-type': 'application/json' }
            })
            .then(response => response.json())
            .then( response => {
                console.log(response);
            })
            .catch((error) => {
              console.error('Error:', error);
            });
          } else if (response["media_type"] == "CAROUSEL_ALBUM") {
            var url = 'https://graph.instagram.com/'+ mediaID + '/children?fields=id&access_token='+access_token;
            fetch(url)
            .then( response => response.json() )
            .then( response => {
                data = response["data"];
                getMediaData(data, access_token);
            })
            .catch((error) => {
              console.error('Error:', error);
            });
          } else {
            console.log("Not support video for now.");
          }
      } )
      .catch((error) => {
        console.error('Error:', error);
      });
  });
}

function getUserData(access_token, user_id) {
      var data = [];
      var startTime = new Date();
      startTime.setMonth(startTime.getMonth() - 3);
      startTime = getUnixTime(startTime);
      var endTime = new Date();
      endTime = getUnixTime(endTime);
      var url = 'https://graph.instagram.com/me/media?access_token=' + access_token + '&since=' + startTime + '&until=' + endTime;
      fetch(url)
      .then( response => response.json() )
      .then( response => {
          data = response["data"];
          getMediaData(data, access_token);
      } )
      .catch((error) => {
        console.error('Error:', error);
      });
}

function getUnixTime(date) {
  return Math.floor(date.getTime() / 1000);
}

function getOption(params) {
  var formBody = [];
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

