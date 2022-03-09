<?php
// Initialize the session
session_start();


// function generateRandomString($length = 10) {
//   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//   $charactersLength = strlen($characters);
//   $randomString = '';
//   for ($i = 0; $i < $length; $i++) {
//       $randomString .= $characters[rand(0, $charactersLength - 1)];
//   }
//   return $randomString;
// }

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";

// $profile_collage_image = "";
// $user_id_err = $file_name_err = $photo_type_err = $image_err;
// Processing form data when form is submitted
// if($_SERVER["REQUEST_METHOD"] == "POST"){
  // // Validate first name
  // if(empty(trim($_POST["first_name"]))){
  //   $first_name_err = "Please enter your first name.";
  // } else{
  //     $first_name = trim($_POST["first_name"]);
  // }

  // // Validate last name
  // if(empty(trim($_POST["last_name"]))){
  //   $first_name_err = "Please enter your last name.";
  // } else{
  //     $last_name = trim($_POST["last_name"]);
  // }

  // Check input errors before inserting in database
  // if(empty($user_id_err) && empty($file_name_err) && empty($photo_type_err) && empty($image_err)){

      // Prepare an insert statement
      // $sql = "INSERT INTO users (user_id, file_name, photo_type, image) VALUES (?, ?, ?, ?)";
      //
      // if($stmt = mysqli_prepare($link, $sql)){
      //     // Bind variables to the prepared statement as parameters
      //     mysqli_stmt_bind_param($stmt, "issb", $param_user_id, $param_file_name, $param_photo_type, $param_image);
      //
      //     // Set parameters
      //     $param_user_id = $_SESSION ['username'];
      //     $param_file_name = generateRandomString();
      //     $param_photo_type = "collage";
      //     $param_image = "<script>saveToProfile();</script>";
      //
      //     // Attempt to execute the prepared statement
      //     if(mysqli_stmt_execute($stmt)){
      //         // Redirect to login page
      //         header("location: index.php");
      //     } else{
      //         echo "Oops! Something went wrong. Please try again later. SQL query.";
      //     }
      //
      //     // Close statement
      //     mysqli_stmt_close($stmt);
      // // }
      // }

  // Close connection
  // mysqli_close($link);
// }
?>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Create Collage</title>
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
    <link href="collage.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    <script src="https://unpkg.com/d3@5"></script>
    <script src="https://unpkg.com/d3-gridding@0.1"></script>
    <div class="cover-container d-flex w-100 h-100 flex-column">
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
            <a style="text-decoration: none;" class="menuItem" href="instructions.php">Help</a>
          </td>
          <td width="13%">
            <?php
            session_start();
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
              echo '';
            } else {
              echo '<h5 class="nameToolbar">'.$_SESSION['first_name'].' '.$_SESSION['last_name'].'</h5>';
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
      <header class="mb-auto">
        <div>
          <?php
            session_start();
          ?>
        </div>
      </header>
      <main class="px-3" id="authorizeBottom">
      </main>
      <div class="collageImage">
        <table>
          <tr>
            <td width="50%">
              <div class="collageImage" id="cnvdiv"></div>
            </td>
            <td width="50%">
              <!-- <table> -->
                <tr class="buttonRow">
                  <td>
                  <a id="backgrounds">
                    <button id ="mountain_button" class="btn btn-lg btn-primary">Choose Mountain Background</button>
                  </a>
                  </td>
                  <td>
                    <a id="backgrounds">
                      <button id ="beach_button" class="btn btn-lg btn-primary">Choose Beach Background</button>
                    </a>
                  </td>
                </tr>
                <tr class="buttonRow">
                  <a id="draws">
                    <button id ="cascade" class="btn btn-lg btn-primary">Draw Cascade</button>
                    <button id ="grid" class="btn btn-lg btn-primary">Draw Grid</button>
                    <button id ="layer" class="btn btn-lg btn-primary">Draw Layer</button>
                    <button id ="brick" class="btn btn-lg btn-primary">Draw Brick</button>
                  </a>
                </tr>
              <!-- </table> -->
            </td>
            
          </tr>
        </table>
      </div>
      <a id="download" download="collage.png">
        <button id ="svbtn" hidden="hidden" onclick="saveImg()" class="btn btn-lg btn-primary">Download Collage</button>
      </a>
      
      <!-- <a id="saveToProfile" download="test.png">
        <button id ="svbtn" hidden="hidden" onclick="saveToProfile()" class="btn btn-lg btn-secondary fw-bold border-white big-white">Save to profile</button>
      </a> -->
      <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <button id="saveButton" name="saveToProfile" onclick="saveToProfile()" class="btn btn-lg btn-secondary fw-bold border-white big-white">Save to Profile</button>
      </form> -->
      <footer class="mt-auto text-white-50">
        <p>Stanford CS194 Project Round-About</p>
      </footer>
    </div>
  </body>
  <script>
    arr = document.cookie.split(';');
    token = arr[1].split('=')[1];
    startDate = JSON.parse(window.sessionStorage.getItem("start"));
    endDate = JSON.parse(window.sessionStorage.getItem("end"));
    getUserData(token)

    async function getMediaData(data, access_token) {
          var listOfMediaData = [];
          var promises = [];
          data.forEach(function(item) {
              const mediaID = item["id"];
              var url = 'https://graph.instagram.com/'+ mediaID + '?fields=media_type,media_url,timestamp&access_token='+access_token;
              promises.push(fetch(url)
                    .then( response => response.json() )
                    .then( response => {
                    if (response["media_type"] == "IMAGE") {
                      listOfMediaData.push(response["media_url"]);
                        // Put image into server
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
                        // Will fetch the individual photos of this in getIndividualCarouselPhotos
                        // We didn't utilize recursion here as it is hard to implement correctly with Promises
                        var url = 'https://graph.instagram.com/'+ mediaID + '/children?fields=id&access_token='+access_token;
                        listOfMediaData.push(url);
                    } else {
                        console.log("Not support video for now.");
                    }
                }));
          });
          return Promise.all(promises).then(() => {
              return listOfMediaData;
          });
    }

    // Utilize CAROUSEL_ALBUM fetch urls to get each CAROUSEL_ALBUM's data object.
    function getIndividualCarouselDatas(car_urls) {
      var individual_datas = [];
      var promises = [];
      car_urls.forEach(function(url) {
        promises.push(fetch(url)
          .then( response => response.json() )
          .then( response => {
              data = response["data"];
              individual_datas.push(data);
          }));
      });
      return Promise.all(promises).then(() => {
          return individual_datas;
      });
    }

    // With each CAROUSEL_ALBUM's data object, we can loop over each item in it to get each photo URL.
    function getIndividualCarouselPhotos(individual_datas, access_token) {
      var promises = [];
      var listOfPhotos = [];

      individual_datas.forEach(function(data) {
        data.forEach(function(item) {
              const mediaID = item["id"];
              var url = 'https://graph.instagram.com/'+ mediaID + '?fields=media_type,media_url,timestamp&access_token='+access_token;
              promises.push(fetch(url)
                    .then( response => response.json() )
                    .then( response => {
                      if (response["media_type"] == "IMAGE") {
                        listOfPhotos.push(response["media_url"]);
                          // Put image into server
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
                      }
                    })
              );
        });
      });

      return Promise.all(promises).then(() => {
              return listOfPhotos;
      });
    }

    function getUserData(access_token) {
          var data = [];
          // var startTime = new Date();
          // startTime.setMonth(startTime.getMonth() - 3);
          // startTime = getUnixTime(startTime);
          // var endTime = new Date();
          // endTime = getUnixTime(endTime);
          console.log(startDate);
          console.log(endDate);
          var url = 'https://graph.instagram.com/me/media?access_token=' + access_token + '&since=' + startDate + '&until=' + endDate;
          fetch(url)
          .then( response => response.json() )
          .then( response => {
              data = response["data"];
              getMediaData(data, access_token).then((listOfMediaData) => {
                    var car_urls = [];
                    var temp = [];

                    // Separate our links to images and CAROUSEL_ALBUM fetch urls
                    listOfMediaData.forEach( function(item) {
                        if (item.startsWith("https://graph.instagram.com/")) {
                          car_urls.push(item);
                        } else {
                          temp.push(item);
                        }
                    });

                    // Utilize CAROUSEL_ALBUM fetch urls to get each CAROUSEL_ALBUM's data object.
                    getIndividualCarouselDatas(car_urls).then((individual_datas) => {
                        // With each CAROUSEL_ALBUM's data object, we can loop over each item in it to get each photo URL.
                        getIndividualCarouselPhotos(individual_datas, access_token).then((listOfPhotos) => {
                            listOfPhotos = listOfPhotos.concat(temp);
                            displayCollage(listOfPhotos);
                        });
                    });
              });
          })
          .catch((error) => {
            console.error('Error:', error);
          });
    }

    function getUnixTime(date) {
      return Math.floor(date.getTime() / 1000);
    }

    var width = 800;
    var height = 800;
    var isLarge = false;
    var bkdType = "";
    //var currentBkd = isLarge ? bigBkd["beach"] : smallBkd["beach"];
    function displayCollage(listOfPhotos) {
      console.log(listOfPhotos);
      document.getElementById("svbtn").removeAttribute("hidden");
      //var width = 800,
      //      height = 800;
      isLarge = listOfPhotos.length > 9;
      if(isLarge) {
        width = 1000;
        height = 1000;
      }
      var gridding = d3.gridding()
        .size([width, height])
        .padding(50)
        .mode("grid");

      var data = d3.range(8);
      var beach_bknd = "https://media.istockphoto.com/photos/tropical-beach-copy-space-scene-picture-id1144456717?k=20&m=1144456717&s=612x612&w=0&h=z6AXl5vv_YMupxWfJ-RMR9KjpSAcVIoV9TlUaVzqRKM=";
      var mtn_bknd = "https://www.roundabout-cs194.com/pictures/copyrightInfringe.jpg";
      var bigBkd = {};
      var smallBkd = {};
      bigBkd["beach"] = "https://live.staticflickr.com/3872/15095543979_7f3a2814b5_b.jpg";
      smallBkd["beach"] = beach_bknd;
      bigBkd["mountain"] = "https://ae01.alicdn.com/kf/HTB1jOMjXnZRMeJjSsppq6xrEpXaE/Snow-mountain-reflection-on-the-lake-livingroom-background-3D-Wallpaper-Mural-Photowall-3d-papel-de-pared.jpg";
      smallBkd["mountain"] = mtn_bknd;
      var currentBkd = isLarge ? bigBkd["beach"] : smallBkd["beach"];
      bkdType = currentBkd;

      var griddingData = gridding(data);

      var cnv = d3.select("#cnvdiv").append("canvas")
          .attr("id", "cnv")
          .attr("width", width)
          .attr("height", height);


      d3.select("body").append('img')
            .attr("x", 0)
            .attr("y", 0)
            .attr("width", 1)
            .attr("height", 1)
            .attr("id", "bkd")
            //.attr("hidden", "hidden")
            .attr("crossorigin", "anonymous")
            .attr("src", currentBkd);

      //for (let x = 0; x < listOfPhotos.length; x++) {
      //  d3.select("body").append('img')
      //        .attr("id", x)
      //        .attr("crossorigin", "anonymous")
      //        .attr("src", listOfPhotos[x]);

      //      }
      var cascade = document.getElementById("cascade");
      cascade.onclick = function() { drawCascade(listOfPhotos, bkdType); };

      var grid = document.getElementById("grid");
      grid.onclick = function() { drawGrid(listOfPhotos, bkdType); };

      var layer = document.getElementById("layer");
      layer.onclick = function() { drawLayer(listOfPhotos, bkdType); };

      var brick = document.getElementById("brick");
      brick.onclick = function() { drawBrick(listOfPhotos, bkdType); };

      var mtn = document.getElementById("mountain_button");
      mtn.onclick = function () { setMtn(bigBkd, smallBkd); };

      var beach = document.getElementById("beach_button");
      beach.onclick = function () { setBeach(bigBkd, smallBkd); };

      var c = document.getElementById("cnv");
      var ctx = c.getContext("2d");
      var img = document.getElementById("bkd");
      img.onload = function() {
        ctx.drawImage(img, 0, 0, width, height);
        img.remove();
      };
    };

    // Returns a fresh collage context with the background drawn on top of it
    function initCollage(listOfPhotos, bkdType) {
	    shuffleArray(listOfPhotos);
	    console.log("Photos Shuffled");
	    console.log(listOfPhotos);
	    var c = document.getElementById("cnv");
	    var ctx = c.getContext("2d");
	    console.log(ctx);
	    console.log("context");
	    var img = new Image();
      img.onload = function () {
        ctx.drawImage(img, 0, 0, width, height);
      }
	    img.crossOrigin = "anonymous";
      img.src = bkdType
	    return ctx;
    }

    function drawGrid(listOfPhotos, bkdType) {
	    var loopLen = getGridSize(isLarge);
	    var ctx = initCollage(listOfPhotos, bkdType);
	    pic = new Array(loopLen * loopLen);
	    var x = isLarge ? 1.25 : 1.15;
	    var y = isLarge ? 1.25 : 1.5;
	    var loaded = 0;
	    for (let i = 0; i < loopLen; i++) {
		    for (let j = 0; j < loopLen; j++) {
			    if (listOfPhotos[i*loopLen+j] !== undefined) {
				    pic[i*loopLen+j] = new Image();
				    pic[i*loopLen+j].onload = function () {
					    loaded++;
					    console.log(loaded);
					    if (loaded === listOfPhotos.length) {
						    gridDraw(pic, ctx, x, y);
					    }
				    };
				    pic[i*loopLen+j].crossOrigin = "anonymous";
			    	    pic[i*loopLen+j].src = listOfPhotos[i*loopLen+j];
		    	    }
		    }
	    }
    };

    function gridDraw(pic, ctx, x, y) {
	    var loopLen = getGridSize(isLarge);
	    for (let i  = 0; i < loopLen; i++) {
		    for (let j = 0; j < loopLen; j++) {
			    if (i*loopLen+j < pic.length) {
				    ctx.drawImage(pic[i*loopLen+j], (35*x*(j+1)+150*y*j), (35*x*(i+1)+150*y*i), 150*x, 150*x)
			    }
		    }
	    }
    };


    function getGridSize(isLarge) {
	    var converted = isLarge ? 1:0;
	    return converted+3;
    };

    function drawLayer(listOfPhotos, bkdType) {
	    shuffleArray(listOfPhotos);
	    var ctx = initCollage(listOfPhotos, bkdType);
	    var len = isLarge ? 10:8;
	    var loaded = 0;
	    pic = new Array(len);
	    for (let x = 0; x < len; x++) {
		    pic[x] = new Image();
		    pic[x].onload = function () {
			    loaded++;
			    if (loaded === len) {
				    layerDraw(pic, ctx);
			    }
		    };
		    pic[x].crossOrigin = "anonymous";
		    pic[x].src = listOfPhotos[x];
	    }
    };

    function layerDraw(pic, ctx) {
	    var len = isLarge ? 10:8;
	    for (let x = 0; x < len; x++) {
		    ctx.drawImage(pic[x], (50*x), (100*x), (width-2*50*x), (height-100*x));
	    }
    };

    function getBrickSize(isLarge) {
	    var converted = isLarge ? 2:0;
	    return converted+3;
    };

    function drawBrick(listOfPhotos, bkdType) {
	    var ctx = initCollage(listOfPhotos, bkdType);
	    var loaded = 0;
	    var loopLen = getBrickSize(isLarge);
	    pic = new Array(listOfPhotos.length + 1);
	    for (let i = 0; i < loopLen; i++) {
		    for (let j = 0; j < loopLen; j++) {
			    pic[i*loopLen+j] = new Image();
			    pic[i*loopLen+j].onload = function () {
				    loaded++;
				    if (loaded === listOfPhotos.length) {
					    brickDraw(pic, ctx);
				    }
			    };
			    pic[i*loopLen+j].crossOrigin = "anonymous";
			    pic[i*loopLen+j].src = listOfPhotos[i*loopLen+j];
		    }
	    }
    };

    function brickDraw(pic, ctx) {
	    loopLen = getBrickSize(isLarge);
	    for (let i = 0; i < loopLen; i++) {
		    for (let j = 0; j < loopLen; j++) {
			    if ((j%2) === 0) {
				    if (isLarge) {
					    ctx.drawImage(pic[i*loopLen+j], (35*(j+1)+150*j), (50+35*(i+1)+150*i), 150, 150);
				    }
				    else {
					    ctx.drawImage(pic[i*loopLen+j], (85*(j+1)+150*j), (100*(i+1)+150*i), 150, 150);
				    }
			    }
			    else {
				    if (isLarge) {
					    ctx.drawImage(pic[i*loopLen+j], (35*(j+1)+150*j), (35*(i+1)+150*i), 150, 150);
				    }
				    else {
					    ctx.drawImage(pic[i*loopLen+j], (85*(j+1)+150*j), (50*(i+1)+150*i), 150, 150);
				    }
			    }
		    }
	    }
    };

    function drawCascade(listOfPhotos, bkdType) {
	    var ctx = initCollage(listOfPhotos, bkdType);
	    var loopLen = isLarge ? 10:7;
	    var loaded = 0;
	    pic = new Array(loopLen+1);
	    for (let x = 0; x < loopLen; x++) {
		    pic[x] = new Image();
		    pic[x].onload = function () {
			    loaded++;
			    if (loaded === loopLen) {
				    cascadeDraw(pic, ctx);
			    }
		    };
		    pic[x].crossOrigin = "anonymous";
		    pic[x].src = listOfPhotos[x];
	    }
    };

    function cascadeDraw(pic, ctx) {
	    loopLen = isLarge ? 10:7;
	    for (let x = 0; x < loopLen; x++) {
		    ctx.drawImage(pic[x], (75*(x+1)), (75*(x+1)), 175, 175);
	    }
    };


    function shuffleArray(arr) {
	    for (var i = arr.length - 1; i > 0; i--) {
		    var j = Math.floor(Math.random()*(i+1));
		    var temp = arr[i];
		    arr[i] = arr[j];
		    arr[j] = temp;
	    }
    };

    // const fs = require("fs");
    function saveImg() {
      var download = document.getElementById("download");
      var canvas = document.getElementById("cnv");
      var img = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
      download.setAttribute("href", img);
    };


    // function saveToProfile() {
    //   // var download = document.getElementById("saveButton");
    //   var canvas = document.getElementById("cnv");
    //   var img = canvas.toDataURL("image/png");
    //   // download.setAttribute("href", img);
    //   console.log(img);
    //   return image;
    // };

    // function saveToProfile() {
    //   var download = document.getElementById("saveToProfile");
    //   var canvas = document.getElementById("cnv");
    //   var img = canvas.toDataURL("image/png");
    //   download.setAttribute("href", img);
    //   console.log(img);
    //
    //   console.log("test");
    //   saveAs(canvas.toDataURL(), 'file-name.png')
    //
    //   function saveAs(uri, filename){
    //       var link = document.createElement('a');
    //
    //       if (typeof link.download === 'string'){
    //           link.href = uri;
    //           link.download = filename;
    //
    //           document.body.appendChild(link);
    //
    //           link.click();
    //
    //           document.body.removeChild(link);
    //       } else {
    //         window.open(uri);
    //       }
    //
    //   };
    //   }

    function setBeach(bigBkd, smallBkd) {
      bkdType = isLarge ? bigBkd["beach"] : smallBkd["beach"];
      var c = document.getElementById("cnv");
      var ctx = c.getContext("2d");
      var img = new Image();
      img.onload = function () {
        ctx.drawImage(img, 0, 0, width, height);
      }
	    img.crossOrigin = "anonymous";
      img.src = bkdType;
    }

    function setMtn(bigBkd, smallBkd) {
      bkdType = isLarge ? bigBkd["mountain"] : smallBkd["mountain"];
      var c = document.getElementById("cnv");
      var ctx = c.getContext("2d");
      var img = new Image();
      img.onload = function () {
        ctx.drawImage(img, 0, 0, width, height);
      }
	    img.crossOrigin = "anonymous";
      img.src = bkdType;
    }

  </script>
</html>
