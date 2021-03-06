<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
require_once "config.php";


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

<body class="d-flex h-100 text-center text-white">
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
    <main class="px-3" id="authorizeBottom">
    </main>
    <div class="collageImage">
      <table>
        <tr>
          <td width="50%">
            <div class="collageImage" id="cnvdiv"></div>
          </td>
          <td width="50%">
            <table class="tableWithin">
              <tr class="buttonRow">
                <td colspan="2">
                  <a id="backgrounds">
                    <button id="mountain_button" class="btn btn-lg btn-primary">Choose Mountain Background</button>
                  </a>
                </td>
                <td colspan="2">
                  <a id="backgrounds">
                    <button id="beach_button" class="btn btn-lg btn-primary">Choose Beach Background</button>
                  </a>
                </td>
              </tr>
              <tr class="buttonRow">
                <td>
                  <a id="draws">
                    <button id="cascade" class="btn btn-lg btn-primary">Draw Cascade</button>
                  </a>
                </td>
                <td>
                  <a id="draws">
                    <button id="grid" class="btn btn-lg btn-primary">Draw Grid</button>
                  </a>
                </td>
                <td>
                  <a id="draws">
                    <button id="layer" class="btn btn-lg btn-primary">Draw Layer</button>
                  </a>
                </td>
                <td>
                  <a id="draws">
                    <button id="brick" class="btn btn-lg btn-primary">Draw Brick</button>
                  </a>
                </td>
              </tr>
            </table>
          </td>

        </tr>
      </table>
    </div>
    <a id="download" download="collage.png">
      <button id="svbtn" hidden="hidden" onclick="saveImg()" class="btn btn-lg btn-primary">Download Collage</button>
    </a>
    <footer class="mt-auto text-white-50">
      <p>Stanford CS194 Project Round-About</p>
    </footer>
  </div>
</body>
<script>

  // Setup variables necessary to load in Instagram photos
  arr = document.cookie.split(';');
  token = arr[1].split('=')[1];
  startDate = JSON.parse(window.sessionStorage.getItem("start"));
  endDate = JSON.parse(window.sessionStorage.getItem("end"));
  getUserData(token); // Get the user's data from the access token

  /**
   * Returns list of photo URLs (listOfPhotos) and carousel GET request URLs (car_urls) when
   * the list of Promises return is fulfilled.
   *
   * @param data : an array of Media ids. You must send a request on that id to get a Media object.
   *               Each Media object could be an IMAGE, VIDEO, or CAROUSEL_ALBUM.
   * @param access_token : Instagram access token that we retrieved from index.php 
   * @return { listOfPhotos, car_urls }
   */
  async function getMediaData(data, access_token) {
    var listOfMediaData = [];
    var promises = [];

    // Loops over each Media id
    data.forEach(function(item) {
      const mediaID = item["id"];

      // Sends a request on current Media id in order to get Media object (could be of type IMAGE, VIDEO, or CAROUSEL_ALBUM)
      var url = 'https://graph.instagram.com/' + mediaID + '?fields=media_type,media_url,timestamp&access_token=' + access_token;
      promises.push(fetch(url)
        .then(response => response.json())
        .then(response => {
          if (response["media_type"] == "IMAGE") {
            // If Media object is an IMAGE, store the photo's URL to listOfPhotos
            listOfMediaData.push(response["media_url"]);

            // Put image into server
            fetch("/imageProcessor.php", {
                method: 'POST',
                body: JSON.stringify({
                  image_url: response["media_url"]
                }),
                headers: {
                  'Content-type': 'application/json'
                }
              })
              .then(response => response.json())
              .then(response => {
                console.log(response);
              })
              .catch((error) => {
                console.error('Error:', error);
              });
          } else if (response["media_type"] == "CAROUSEL_ALBUM") {
            // Will fetch the individual photos of this in getIndividualCarouselPhotos. Store GET url in car_urls.
            // We didn't utilize recursion here as it is hard to implement correctly with Promises
            var url = 'https://graph.instagram.com/' + mediaID + '/children?fields=id&access_token=' + access_token;
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

  /**
   * Returns list of data objects for each CAROUSEL_ALBUM fetch URL when
   * the list of Promises return is fulfilled.
   *
   * @param car_urls : a list of fetch URLs. Each fetch URL is associated with one CAROUSEL_ALBUM.
   * @return individual_datas : a list of each CAROUSEL_ALBUM's data object. 
   *                           Each data object will contain ids for each photo in that CAROUSEL_ALBUM.
   */
  function getIndividualCarouselDatas(car_urls) {
    var individual_datas = [];
    var promises = [];

    // Loop over each fetch URL/CAROUSEL_ALBUM
    car_urls.forEach(function(url) {
      // Fetch url to get each CAROUSEL_ALBUM's data object based
      promises.push(fetch(url)
        .then(response => response.json())
        .then(response => {
          data = response["data"];
          individual_datas.push(data);
        }));
    });
    return Promise.all(promises).then(() => {
      return individual_datas;
    });
  }

  /**
   * Returns list of photo URLs containing all of the photos from each CAROUSEL_ALBUM's data object
   * when the list of Promises return is fulfilled.
   *
   * @param individual_datas : a list of each CAROUSEL_ALBUM's data object. 
   *                           Each data object will contain ids for each photo in that CAROUSEL_ALBUM.
   * @param access_token : Instagram access token necessary to make request on specific photo IDs
   * @return listOfPhotos : a list containing all of the photos URLs from each CAROUSEL_ALBUM's data object
   */
  function getIndividualCarouselPhotos(individual_datas, access_token) {
    var promises = [];
    var listOfPhotos = [];

    // Loop over each CAROUSEL_ALBUM's data object
    individual_datas.forEach(function(data) {

      // Loop over each of the items in the data object
      data.forEach(function(item) {
        const mediaID = item["id"];

        // Sends a request on current Media id in order to get Media object (could be of type IMAGE or VIDEO)
        var url = 'https://graph.instagram.com/' + mediaID + '?fields=media_type,media_url,timestamp&access_token=' + access_token;
        promises.push(fetch(url)
          .then(response => response.json())
          .then(response => {
            if (response["media_type"] == "IMAGE") {
              // If Media object is an IMAGE, store the photo's URL to listOfPhotos
              listOfPhotos.push(response["media_url"]);

              // Put image into server
              fetch("/imageProcessor.php", {
                  method: 'POST',
                  body: JSON.stringify({
                    image_url: response["media_url"]
                  }),
                  headers: {
                    'Content-type': 'application/json'
                  }
                })
                .then(response => response.json())
                .then(response => {
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

  /**
   * Utilizing the access token, this function gets all of photo URLs and displays the map.
   *
   * @param access_token : Instagram access token necessary to make request on specific photo IDs
   */
  function getUserData(access_token) {
    var data = [];
    var url = 'https://graph.instagram.com/me/media?access_token=' + access_token + '&since=' + startDate + '&until=' + endDate;
    fetch(url)
      .then(response => response.json())
      .then(response => {
        data = response["data"];
        getMediaData(data, access_token).then((listOfMediaData) => {
          var car_urls = [];
          var temp = [];

          // Separate our links to images and CAROUSEL_ALBUM fetch urls
          listOfMediaData.forEach(function(item) {
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

  /**
   * Get UNIX time based off of date object
   *
   * @param  date : Date object
   * @return number
   */
  function getUnixTime(date) {
    return Math.floor(date.getTime() / 1000);
  }

  var width = 800;
  var height = 800;
  var isLarge = false;
  var bkdType = "";

  /**
   * Initializes the collage elements in order to be ready 
   * to display when a user clicks on a display button.
   *
   * @param listOfPhotos : a list containing all of the photos URLs for the trip
   */
  function displayCollage(listOfPhotos) {
    document.getElementById("svbtn").removeAttribute("hidden");

    // Set up the background according to the number of photos
    isLarge = listOfPhotos.length > 9;
    if (isLarge) {
      width = 1000;
      height = 1000;
    }
    var gridding = d3.gridding()
      .size([width, height])
      .padding(50)
      .mode("grid");

    // Background options for both lots of photos and less photos
    var data = d3.range(8);
    var beach_bknd = "https://media.istockphoto.com/photos/tropical-beach-copy-space-scene-picture-id1144456717?k=20&m=1144456717&s=612x612&w=0&h=z6AXl5vv_YMupxWfJ-RMR9KjpSAcVIoV9TlUaVzqRKM=";
    var mtn_bknd = "https://www.roundabout-cs194.com/images/copyrightInfringe.jpg";
    var bigBkd = {};
    var smallBkd = {};
    bigBkd["beach"] = "https://live.staticflickr.com/3872/15095543979_7f3a2814b5_b.jpg";
    smallBkd["beach"] = beach_bknd;
    bigBkd["mountain"] = "https://ae01.alicdn.com/kf/HTB1jOMjXnZRMeJjSsppq6xrEpXaE/Snow-mountain-reflection-on-the-lake-livingroom-background-3D-Wallpaper-Mural-Photowall-3d-papel-de-pared.jpg";
    smallBkd["mountain"] = mtn_bknd;
    var currentBkd = isLarge ? bigBkd["beach"] : smallBkd["beach"];
    bkdType = currentBkd;

    // Intialize canvas elements and buttons to draw collages
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
      .attr("crossorigin", "anonymous")
      .attr("src", currentBkd);

    // Creates the cascade button and functionality
    var cascade = document.getElementById("cascade");
    cascade.onclick = function() {
      drawCascade(listOfPhotos, bkdType);
    };

    // Creates the grid button and functionality
    var grid = document.getElementById("grid");
    grid.onclick = function() {
      drawGrid(listOfPhotos, bkdType);
    };

    // Creates the layer button and functionality
    var layer = document.getElementById("layer");
    layer.onclick = function() {
      drawLayer(listOfPhotos, bkdType);
    };

    // Creates the brick button and functionality
    var brick = document.getElementById("brick");
    brick.onclick = function() {
      drawBrick(listOfPhotos, bkdType);
    };

    // Creates the mountain background button and functionality
    var mtn = document.getElementById("mountain_button");
    mtn.onclick = function() {
      setMtn(bigBkd, smallBkd);
    };

    // Creates the beach background button and functionality
    var beach = document.getElementById("beach_button");
    beach.onclick = function() {
      setBeach(bigBkd, smallBkd);
    };

    // Loads up an intial background for users to see
    var c = document.getElementById("cnv");
    var ctx = c.getContext("2d");
    var img = document.getElementById("bkd");
    img.onload = function() {
      ctx.drawImage(img, 0, 0, width, height);
      img.remove();
    };
  };

  /**
   * Creates a fresh collage context with the background drawn on top of it
   *
   * @param listOfPhotos : a list containing all of the photos URLs for the trip
   * @param bkdType : the type of background (beach or mountain)
   */
  function initCollage(listOfPhotos, bkdType) {
    // Shuffles photos randomly to be displayed and creates new contexts for canvas
    shuffleArray(listOfPhotos);
    var c = document.getElementById("cnv");
    var ctx = c.getContext("2d");

    // Draws new background
    var img = new Image();
    img.onload = function() {
      ctx.drawImage(img, 0, 0, width, height);
    }
    img.crossOrigin = "anonymous";
    img.src = bkdType
    return ctx;
  }

  /**
   * Drawing new background and grid functionality. Draws a 3x3 if photo size <= 9. Else, draws a 4x4.
   *
   * @param listOfPhotos : a list containing all of the photos URLs for the trip
   * @param bkdType : the type of background (beach or mountain)
   */
  function drawGrid(listOfPhotos, bkdType) {
    // Redraws background to refresh collage
    var loopLen = getGridSize(isLarge);
    var ctx = initCollage(listOfPhotos, bkdType);
    pic = new Array(loopLen * loopLen);

    // x and y are used to scale depending on the collage size (4x4 or 5x5)
    var x = isLarge ? 1.25 : 1.15; 
    var y = isLarge ? 1.25 : 1.5;
    var loaded = 0;
    for (let i = 0; i < loopLen; i++) {
      for (let j = 0; j < loopLen; j++) {
        if (listOfPhotos[i * loopLen + j] !== undefined) {
          pic[i * loopLen + j] = new Image();
          pic[i * loopLen + j].onload = function() {
            loaded++;
            if (loaded === listOfPhotos.length) {
              gridDraw(pic, ctx, x, y);
            }
          };
          pic[i * loopLen + j].crossOrigin = "anonymous";
          pic[i * loopLen + j].src = listOfPhotos[i * loopLen + j];
        }
      }
    }
  };

  /**
   * Drawing grid functionality.
   *
   * @param pic : the photo to draw
   * @param ctx : the context to draw in
   * @param x : a scaling factor
   * @param y : a scaling factor
   */
  function gridDraw(pic, ctx, x, y) {
    var loopLen = getGridSize(isLarge);
    for (let i = 0; i < loopLen; i++) {
      for (let j = 0; j < loopLen; j++) {
        if (i * loopLen + j < pic.length) {
          ctx.drawImage(pic[i * loopLen + j], (35 * x * (j + 1) + 150 * y * j), (35 * x * (i + 1) + 150 * y * i), 150 * x, 150 * x)
        }
      }
    }
  };

  /**
   * Get grid size. Returns 3 if isLarge is false, else returns 4.
   *
   * @param  isLarge : boolean (true if listOfPhotos > 9)
   * @return number
   */
  function getGridSize(isLarge) {
    var converted = isLarge ? 1 : 0;
    return converted + 3;
  };

  /**
   * Drawing new background and layer functionality.
   * 
   * @param listOfPhotos : a list containing all of the photos URLs for the trip
   * @param bkdType : the type of background (beach or mountain)
   */
  function drawLayer(listOfPhotos, bkdType) {
    // Redraws background to refresh collage
    shuffleArray(listOfPhotos);
    var ctx = initCollage(listOfPhotos, bkdType);

    var len = isLarge ? 10 : 8;
    var loaded = 0;
    pic = new Array(len);
    for (let x = 0; x < len; x++) {
      pic[x] = new Image();
      pic[x].onload = function() {
        loaded++;
        if (loaded === len) {
          layerDraw(pic, ctx);
        }
      };
      pic[x].crossOrigin = "anonymous";
      pic[x].src = listOfPhotos[x];
    }
  };

  /**
   * Drawing layer functionality.
   *
   * @param pic : the photo to draw
   * @param ctx : the context to draw in
   */
  function layerDraw(pic, ctx) {
    var len = isLarge ? 10 : 8;
    for (let x = 0; x < len; x++) {
      ctx.drawImage(pic[x], (50 * x), (100 * x), (width - 2 * 50 * x), (height - 100 * x));
    }
  };

  /**
   * Get brick size. Returns 3 if isLarge is false, else returns 5.
   *
   * @param  isLarge : boolean (true if listOfPhotos > 9)
   * @return number
   */
  function getBrickSize(isLarge) {
    var converted = isLarge ? 2 : 0;
    return converted + 3;
  };

  /**
   * Drawing new background and brick functionality. Draws a 3x3 if photo size <= 9. Else, draws a 5x5.
   *
   * @param listOfPhotos : a list containing all of the photos URLs for the trip
   * @param bkdType : the type of background (beach or mountain)
   */
  function drawBrick(listOfPhotos, bkdType) {
    // Redraws background to refresh collage
    var ctx = initCollage(listOfPhotos, bkdType);
    var loaded = 0;
    var loopLen = getBrickSize(isLarge);

    pic = new Array(listOfPhotos.length + 1);
    for (let i = 0; i < loopLen; i++) {
      for (let j = 0; j < loopLen; j++) {
        pic[i * loopLen + j] = new Image();
        pic[i * loopLen + j].onload = function() {
          loaded++;
          if (loaded === listOfPhotos.length) {
            brickDraw(pic, ctx);
          }
        };
        pic[i * loopLen + j].crossOrigin = "anonymous";
        pic[i * loopLen + j].src = listOfPhotos[i * loopLen + j];
      }
    }
  };

  /**
   * Drawing brick functionality.
   *
   * @param pic : the photo to draw
   * @param ctx : the context to draw in
   */
  function brickDraw(pic, ctx) {
    loopLen = getBrickSize(isLarge);
    for (let i = 0; i < loopLen; i++) {
      for (let j = 0; j < loopLen; j++) {
        if ((j % 2) === 0) {
          if (isLarge) {
            ctx.drawImage(pic[i * loopLen + j], (35 * (j + 1) + 150 * j), (50 + 35 * (i + 1) + 150 * i), 150, 150);
          } else {
            ctx.drawImage(pic[i * loopLen + j], (85 * (j + 1) + 150 * j), (100 * (i + 1) + 150 * i), 150, 150);
          }
        } else {
          if (isLarge) {
            ctx.drawImage(pic[i * loopLen + j], (35 * (j + 1) + 150 * j), (35 * (i + 1) + 150 * i), 150, 150);
          } else {
            ctx.drawImage(pic[i * loopLen + j], (85 * (j + 1) + 150 * j), (50 * (i + 1) + 150 * i), 150, 150);
          }
        }
      }
    }
  };

  /**
   * Drawing new background and brick functionality. Draws 7 photos cascading if photo size <= 9. Else, draws 10 cascading photos.
   *
   * @param listOfPhotos : a list containing all of the photos URLs for the trip
   * @param bkdType : the type of background (beach or mountain)
   */
  function drawCascade(listOfPhotos, bkdType) {
    // Refreshes collage and background
    var ctx = initCollage(listOfPhotos, bkdType);
    var loopLen = isLarge ? 10 : 7;
    var loaded = 0;

    pic = new Array(loopLen + 1);
    for (let x = 0; x < loopLen; x++) {
      pic[x] = new Image();
      pic[x].onload = function() {
        loaded++;
        if (loaded === loopLen) {
          cascadeDraw(pic, ctx);
        }
      };
      pic[x].crossOrigin = "anonymous";
      pic[x].src = listOfPhotos[x];
    }
  };

  /**
   * Drawing cascade functionality.
   *
   * @param pic : the photo to draw
   * @param ctx : the context to draw in
   */
  function cascadeDraw(pic, ctx) {
    loopLen = isLarge ? 10 : 7;
    for (let x = 0; x < loopLen; x++) {
      ctx.drawImage(pic[x], (75 * (x + 1)), (75 * (x + 1)), 175, 175);
    }
  };

  /**
   * Shuffle arr in place such that photo order is randomized on each draw button click.
   * 
   * @param arr : a list containing all of the photos URLs for the trip
   */
  function shuffleArray(arr) {
    for (var i = arr.length - 1; i > 0; i--) {
      var j = Math.floor(Math.random() * (i + 1));
      var temp = arr[i];
      arr[i] = arr[j];
      arr[j] = temp;
    }
  };

  /**
   * Save image button functionality s.t. people can download their collages
   */
  function saveImg() {
    var download = document.getElementById("download");
    var canvas = document.getElementById("cnv");
    var img = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
    download.setAttribute("href", img);
  };

  /**
   * Set beach background button functionality.
   * 
   * @param bigBkd : a dictionary containing all big backgrounds for different types like "beach", "mountain"
   * @param smallBkd : a dictionary containing all small backgrounds for different types like "beach", "mountain"
   */
  function setBeach(bigBkd, smallBkd) {
    bkdType = isLarge ? bigBkd["beach"] : smallBkd["beach"];
    var c = document.getElementById("cnv");
    var ctx = c.getContext("2d");
    var img = new Image();
    img.onload = function() {
      ctx.drawImage(img, 0, 0, width, height);
    }
    img.crossOrigin = "anonymous";
    img.src = bkdType;
  }

  /**
   * Set mountain background button functionality.
   * 
   * @param bigBkd : a dictionary containing all big backgrounds for different types like "beach", "mountain"
   * @param smallBkd : a dictionary containing all small backgrounds for different types like "beach", "mountain"
   */
  function setMtn(bigBkd, smallBkd) {
    bkdType = isLarge ? bigBkd["mountain"] : smallBkd["mountain"];
    var c = document.getElementById("cnv");
    var ctx = c.getContext("2d");
    var img = new Image();
    img.onload = function() {
      ctx.drawImage(img, 0, 0, width, height);
    }
    img.crossOrigin = "anonymous";
    img.src = bkdType;
  }
</script>
</html>