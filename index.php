<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
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
    <script src="https://unpkg.com/d3@5"></script>
    <script src="https://unpkg.com/d3-gridding@0.1"></script>
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
            <a class="nav-link" href="datepicker.html">Create</a>
            <a href="logout.php" class="nav-link">Logout</a>
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
      <!-- <div id="cnvdiv"></div>
      <a id="download" download="collage.png">
        <button id ="svbtn" hidden="hidden" onclick="saveImg()" class="btn btn-lg btn-secondary fw-bold border-white big-white">Save Collage</button>
      </a> -->
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
          access_token = "token=" + response["access_token"];
          document.cookie = access_token; // Set access token as cookie
          location.href = 'datepicker.html'; // Redirect to date picker where we do the rest of the API calls
          // getUserData(access_token);
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

    // async function getMediaData(data, access_token) {
    //       var listOfMediaData = [];
    //       var promises = [];
    //       data.forEach(function(item) {
    //           const mediaID = item["id"];
    //           var url = 'https://graph.instagram.com/'+ mediaID + '?fields=media_type,media_url,timestamp&access_token='+access_token;
    //           promises.push(fetch(url)
    //                 .then( response => response.json() )
    //                 .then( response => {
    //                 if (response["media_type"] == "IMAGE") {
    //                   listOfMediaData.push(response["media_url"]);
    //                     // Put image into server
    //                     fetch("/imageProcessor.php", {
    //                         method: 'POST',
    //                         body: JSON.stringify({
    //                             image_url: response["media_url"]
    //                         }),
    //                         headers: { 'Content-type': 'application/json' }
    //                     })
    //                     .then(response => response.json())
    //                     .then( response => {
    //                         console.log(response);
    //                     })
    //                     .catch((error) => {
    //                           console.error('Error:', error);
    //                       });
    //                 } else if (response["media_type"] == "CAROUSEL_ALBUM") {
    //                     // Will fetch the individual photos of this in getIndividualCarouselPhotos
    //                     // We didn't utilize recursion here as it is hard to implement correctly with Promises
    //                     var url = 'https://graph.instagram.com/'+ mediaID + '/children?fields=id&access_token='+access_token;
    //                     listOfMediaData.push(url);
    //                 } else {
    //                     console.log("Not support video for now.");
    //                 }
    //             }));
    //       });
    //       return Promise.all(promises).then(() => {
    //           return listOfMediaData;
    //       });
    // }

    // // Utilize CAROUSEL_ALBUM fetch urls to get each CAROUSEL_ALBUM's data object.
    // function getIndividualCarouselDatas(car_urls) {
    //   var individual_datas = [];
    //   var promises = [];
    //   car_urls.forEach(function(url) {
    //     promises.push(fetch(url)
    //       .then( response => response.json() )
    //       .then( response => {
    //           data = response["data"];
    //           individual_datas.push(data);
    //       }));
    //   });
    //   return Promise.all(promises).then(() => {
    //       return individual_datas;
    //   });
    // }

    // // With each CAROUSEL_ALBUM's data object, we can loop over each item in it to get each photo URL.
    // function getIndividualCarouselPhotos(individual_datas, access_token) {
    //   var promises = [];
    //   var listOfPhotos = [];

    //   individual_datas.forEach(function(data) {
    //     data.forEach(function(item) {
    //           const mediaID = item["id"];
    //           var url = 'https://graph.instagram.com/'+ mediaID + '?fields=media_type,media_url,timestamp&access_token='+access_token;
    //           promises.push(fetch(url)
    //                 .then( response => response.json() )
    //                 .then( response => {
    //                   if (response["media_type"] == "IMAGE") {
    //                     listOfPhotos.push(response["media_url"]);
    //                       // Put image into server
    //                       fetch("/imageProcessor.php", {
    //                           method: 'POST',
    //                           body: JSON.stringify({
    //                               image_url: response["media_url"]
    //                           }),
    //                           headers: { 'Content-type': 'application/json' }
    //                       })
    //                       .then(response => response.json())
    //                       .then( response => {
    //                           console.log(response);
    //                       })
    //                       .catch((error) => {
    //                             console.error('Error:', error);
    //                       });
    //                   }
    //                 })
    //           );
    //     });
    //   });

    //   return Promise.all(promises).then(() => {
    //           return listOfPhotos;
    //   });
    // }

    // function getUserData(access_token) {
    //       var data = [];
    //       var startTime = new Date();
    //       startTime.setMonth(startTime.getMonth() - 3);
    //       startTime = getUnixTime(startTime);
    //       var endTime = new Date();
    //       endTime = getUnixTime(endTime);
    //       var url = 'https://graph.instagram.com/me/media?access_token=' + access_token + '&since=' + startTime + '&until=' + endTime;
    //       fetch(url)
    //       .then( response => response.json() )
    //       .then( response => {
    //           data = response["data"];
    //           getMediaData(data, access_token).then((listOfMediaData) => {
    //                 var car_urls = [];
    //                 var temp = [];

    //                 // Separate our links to images and CAROUSEL_ALBUM fetch urls
    //                 listOfMediaData.forEach( function(item) {
    //                     if (item.startsWith("https://graph.instagram.com/")) {
    //                       car_urls.push(item);
    //                     } else {
    //                       temp.push(item);
    //                     }
    //                 });

    //                 // Utilize CAROUSEL_ALBUM fetch urls to get each CAROUSEL_ALBUM's data object.
    //                 getIndividualCarouselDatas(car_urls).then((individual_datas) => {
    //                     // With each CAROUSEL_ALBUM's data object, we can loop over each item in it to get each photo URL.
    //                     getIndividualCarouselPhotos(individual_datas, access_token).then((listOfPhotos) => {
    //                         listOfPhotos = listOfPhotos.concat(temp);
    //                         displayCollage(listOfPhotos);
    //                     });
    //                 });
    //           });
    //       })
    //       .catch((error) => {
    //         console.error('Error:', error);
    //       });
    // }

    // function getUnixTime(date) {
    //   return Math.floor(date.getTime() / 1000);
    // }

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

    // function displayCollage(listOfPhotos) {
    //   document.getElementById("svbtn").removeAttribute("hidden");
    //   var width = 800,
    //       height = 800;
    //   var gridding = d3.gridding()
    //     .size([width, height])
    //     .padding(50)
    //     .mode("grid");

    //   var data = d3.range(8);
    //   var beach_bknd = "https://media.istockphoto.com/photos/tropical-beach-copy-space-scene-picture-id1144456717?k=20&m=1144456717&s=612x612&w=0&h=z6AXl5vv_YMupxWfJ-RMR9KjpSAcVIoV9TlUaVzqRKM="

    //   var griddingData = gridding(data);

    //   var cnv = d3.select("#cnvdiv").append("canvas")
    //       .attr("id", "cnv")
    //       .attr("width", width)
    //       .attr("height", height);

    //   d3.select("body").append('img')
    //         .attr("x", 0)
    //         .attr("y", 0)
    //         .attr("width", 1)
    //         .attr("height", 1)
    //         .attr("id", "bkd")
    //         //.attr("hidden", "hidden")
    //         .attr("crossorigin", "anonymous")
    //         .attr("src", beach_bknd);

    //   for (let x = 0; x < listOfPhotos.length; x++) {
    //     d3.select("body").append('img')
    //           .attr("id", x)
    //           .attr("crossorigin", "anonymous")
    //           .attr("src", listOfPhotos[x]);

    //   }

    //   var c = document.getElementById("cnv");
    //   console.log(c);
    //   var ctx = c.getContext("2d");
    //   var img = document.getElementById("bkd");
    //   img.onload = function() {
    //     ctx.drawImage(img, 0, 0);
    //     img.remove();
    //   };
    //   pic = new Array(9)
    //   for (let i = 0; i < 3; i++) {
    //     for (let j = 0; j < 3; j++) {
    //       if (!(i===2 && j===2)){
    //         pic[i*3 + j] = document.getElementById(i*3 + j);
    //         console.log(pic[i*3+j]);
    //         pic[i*3 + j].onload = function() {
    //           ctx.drawImage(pic[i*3+j], (35*(j+1) + 150*j), (35*(i+1) + 150*i), 150, 150);
    //           pic[i*3+j].remove();
    //         };
    //       }
    //     }
    //   }
    // };


      // function saveImg() {
      //   var download = document.getElementById("download");
      //   var canvas = document.getElementById("cnv");
      //   var img = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
      //   download.setAttribute("href", img);
      //   console.log(img);
      // };
  </script>
</html>
