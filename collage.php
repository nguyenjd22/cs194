<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// require_once "config.php";
// // Processing form data when form is submitted
// if($_SERVER["REQUEST_METHOD"] == "POST"){

//   // Validate first name
//   if(empty(trim($_POST["first_name"]))){
//     $first_name_err = "Please enter your first name.";
//   } else{
//       $first_name = trim($_POST["first_name"]);
//   }

//   // Validate last name
//   if(empty(trim($_POST["last_name"]))){
//     $first_name_err = "Please enter your last name.";
//   } else{
//       $last_name = trim($_POST["last_name"]);
//   }

//   // Validate username
//   if(empty(trim($_POST["username"]))){
//       $username_err = "Please enter a username.";
//   } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
//       $username_err = "Username can only contain letters, numbers, and underscores.";
//   } else{
//       // Prepare a select statement
//       $sql = "SELECT id FROM users WHERE username = ?";

//       if($stmt = mysqli_prepare($link, $sql)){
//           // Bind variables to the prepared statement as parameters
//           mysqli_stmt_bind_param($stmt, "s", $param_username);

//           // Set parameters
//           $param_username = trim($_POST["username"]);

//           // Attempt to execute the prepared statement
//           if(mysqli_stmt_execute($stmt)){
//               /* store result */
//               mysqli_stmt_store_result($stmt);

//               if(mysqli_stmt_num_rows($stmt) == 1){
//                   $username_err = "This username is already taken.";
//               } else{
//                   $username = trim($_POST["username"]);
//               }
//           } else{
//               echo "Oops! Something went wrong. Please try again later. Validate Username.";
//           }

//           // Close statement
//           mysqli_stmt_close($stmt);
//       }
//   }

//   // Validate password
//   if(empty(trim($_POST["password"]))){
//       $password_err = "Please enter a password.";
//   } elseif(strlen(trim($_POST["password"])) < 6){
//       $password_err = "Password must have atleast 6 characters.";
//   } else{
//       $password = trim($_POST["password"]);
//   }

//   // Validate confirm password
//   if(empty(trim($_POST["confirm_password"]))){
//       $confirm_password_err = "Please confirm password.";
//   } else{
//       $confirm_password = trim($_POST["confirm_password"]);
//       if(empty($password_err) && ($password != $confirm_password)){
//           $confirm_password_err = "Password did not match.";
//       }
//   }

//   // Check input errors before inserting in database
//   if(empty($first_name_err) && empty($last_name_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){

//       // Prepare an insert statement
//       $sql = "INSERT INTO users (first_name, last_name, username, password) VALUES (?, ?, ?, ?)";

//       if($stmt = mysqli_prepare($link, $sql)){
//           // Bind variables to the prepared statement as parameters
//           mysqli_stmt_bind_param($stmt, "ssss", $param_first_name, $param_last_name, $param_username, $param_password);

//           // Set parameters
//           $param_first_name = $first_name;
//           $param_last_name = $last_name;
//           $param_username = $username;
//           $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

//           // Attempt to execute the prepared statement
//           if(mysqli_stmt_execute($stmt)){
//               // Redirect to login page
//               header("location: login.php");
//           } else{
//               echo "Oops! Something went wrong. Please try again later. SQL query.";
//           }

//           // Close statement
//           mysqli_stmt_close($stmt);
//       }
//   }

//   // Close connection
//   mysqli_close($link);
// }

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
            /*echo '<h3 id="username" class="float-md-start mb-0">'.$_SESSION ['username'].'</h3>';
            */?>
          <!-- <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link" href="AboutPage.php">About</a>
            <a class="nav-link" href="datepicker.html">Create</a>
            <a href="logout.php" class="nav-link">Logout</a>
          </nav> -->

        </div>
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
              <a  class="menuItem" href="datepicker.php">Create</a>
            </td>
            <td width="10%">
              <button class="logoutButton">
                <a class="logoutText" href="logout.php" margin-right="0px">Logout</a>
              </button>
              <!-- <a class="menuItem" href="logout.php" margin-right="0px">Logout</a> -->
            </td>
          </tr>
        </table>
      </header>
      <main class="px-3" id="authorizeBottom">
      </main>
      <div id="cnvdiv"></div>
      <a id="download" download="collage.png">
        <button id ="svbtn" hidden="hidden" onclick="saveImg()" class="btn btn-lg btn-secondary fw-bold border-white big-white">Download Collage</button>
      </a>
      <a id="saveToProfile" download="test.png">
        <button id ="svbtn" hidden="hidden" onclick="saveToProfile()" class="btn btn-lg btn-secondary fw-bold border-white big-white">Save to profile</button>
      </a>
      <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <input type="text" placeholder="First Name" name="first_name" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>">
                <span class="invalid-feedback"><?php echo $first_name_err; ?></span>
            </div>
            <div class="form-group">
                <input type="text" placeholder="Last Name" name="last_name" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_name; ?>">
                <span class="invalid-feedback"><?php echo $last_name_err; ?></span>
            </div>
            <div class="form-group">
                <input type="text" placeholder="Username" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-lg btn-secondary fw-bold border-white big-white" value="Save to profile">
            </div>
        </form> -->
      <footer class="mt-auto text-white-50">
        <p>Stanford CS194 Project Round-About</p>
      </footer>
    </div>
  </body>
  <script>
  import { saveAs } from 'file-saver';
    arr = document.cookie.split(';')
    token = arr[1].split('=')[1]
    startDate = arr[2].split('=')[1]
    endDate = arr[3].split('=')[1]
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

    function displayCollage(listOfPhotos) {
      document.getElementById("svbtn").removeAttribute("hidden");
      var width = 800,
          height = 800;
      var gridding = d3.gridding()
        .size([width, height])
        .padding(50)
        .mode("grid");

      var data = d3.range(8);
      var beach_bknd = "https://media.istockphoto.com/photos/tropical-beach-copy-space-scene-picture-id1144456717?k=20&m=1144456717&s=612x612&w=0&h=z6AXl5vv_YMupxWfJ-RMR9KjpSAcVIoV9TlUaVzqRKM=";
      var mtn_bknd = "https://www.roundabout-cs194.com/pictures/copyrightInfringe.jpg";

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
            .attr("src", mtn_bknd);

      //for (let x = 0; x < listOfPhotos.length; x++) {
      //  d3.select("body").append('img')
      //        .attr("id", x)
      //        .attr("crossorigin", "anonymous")
      //        .attr("src", listOfPhotos[x]);

//      }
      console.log(listOfPhotos);
      var c = document.getElementById("cnv");
      console.log(c);
      var ctx = c.getContext("2d");
      var img = document.getElementById("bkd");
      img.onload = function() {
        ctx.drawImage(img, 0, 0);
        console.log("bckd");
        var pic = new Array(9)
        for (let i = 0; i < 3; i++) {
          for (let j = 0; j < 3; j++) {
            if (!(i===2 && j===2)){
              //pic[i*3 + j] = document.getElementById(i*3 + j);
              console.log(i*3+j);
              pic[i*3 + j] = new Image()
              pic[i*3+j].src = listOfPhotos[i*3+j]
              pic[i*3+j].crossOrigin = "Anonymous";
              pic[i*3 + j].onload = function() {
                ctx.drawImage(pic[i*3+j], (35*(j+1) + 150*j), (35*(i+1) + 150*i), 150, 150);
                //pic[i*3+j].remove();
              };
            }
          }
        }
        img.remove();
      };
    };

    // const fs = require("fs");
    function saveImg() {
      var download = document.getElementById("download");
      var canvas = document.getElementById("cnv");
      var img = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
      download.setAttribute("href", img);
      console.log(img);

      // fs.writeFile("./images/" + filename, img_file, function (err) {
      //       //Once you have the file written into your images directory under the name
      //       // filename you can create the Photo object in the database
      //       if (err) {
      //         console.error('Doing /photos/new', err);
      //         response.status(400).send(JSON.stringify(err));
      //         return;
      //       }
      //       function doneCallback(err, newPhoto) {
      //         if (err) {
      //             console.error('Failed to create photo', err);
      //             response.status(400).send(JSON.stringify(err));
      //             return;
      //         }
      //         // newPhoto.save();
      //         // response.status(200).send("Upload Successful.");
      //         // console.log('Created Photo with ID', newPhoto._id);
      //       }
      //     });
    };
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

  </script>
</html>
