<?php
// Initialize the session
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <script src="https://d3js.org/d3.v4.min.js"></script>
  <script src="https://d3js.org/topojson.v0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/2.13.0/d3-legend.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style type="text/css">
  .nav-masthead .nav-link {
  padding: .25rem 0;
  font-weight: 700;
  color: rgba(255, 255, 255, .5);
  background-color: transparent;
  border-bottom: .25rem solid transparent;
}

.nav-masthead .nav-link:hover,
.nav-masthead .nav-link:focus {
  border-bottom-color: rgba(255, 255, 255, .25);
}

.nav-masthead .nav-link + .nav-link {
  margin-left: 1rem;
}

.nav-masthead .active {
  color: #fff;
  border-bottom-color: #fff;
}

  body {
    font-family:Arial;
    font-size: 12px;
    color: #212529;
    margin:0;
  }
  .tooltips {
    position: absolute;
    text-align: left;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 3px;
    line-height: 1;
    color:white;
  }
  .tool-title {
    font-size: 11px;
    font-weight: 700;
  }
  .tool-text {
    font-size: 9px;
    font-weight: 500;
  }
  .tool-data {
    font-size: 9px;
    font-weight: 500;
    line-height: 0.7;
  }
  .D {
    color: #2471A3;
  }
  .R{
    color: #CA6F1E;
  }
  .headerpart {
    background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(Travel_2.jpeg);
    background-position: center;
    background-size: cover;
    height: 400px;
  }
  .header-text1{
    text-align: center;
    padding: 100px 0;
    margin-left: 200px;
    margin-right: 200px;
  }
  .header-text1 h1{
    margin-top: 20px;
    font-size: 70px !important;
    font-weight: 700;
    color:white;
  }
  .header-text1 h2{
    margin-top: 30px;
    font-size: 20px !important;
    font-weight: normal;
/*    font-weight: 700;
*/    color:white;
    line-height: 150%;
  }
  .body-text{
    text-align: center;
    padding-top:80px;
    padding-bottom: 100px;
    padding-left: 350px;
    padding-right: 350px;
    background-color: #F8F9F9;
  }
  .body-text h1{
    margin-top: 0px;
    font-size: 25px;
  }
  .body-text h2{
    margin-top: 0px;
    font-size: 18px;
    font-weight: normal;
  }

  .footer h2{
    margin-top: 0px;
    font-size: 18px;
    font-weight: 600;
  }

  .selector {
    margin-top: 50px;
    margin-left: 100px;
    margin-right: 100px;
  }

  .gdp {
    float: left;
    width: 50%;
    margin-bottom: 50px;
  }
  .scatter_plot {
    margin: auto;
    width: 68.5%;
  }
  .legendTitle {
    font-size: 12px;
    font-weight: 600;
  }
  .scatterPlotX path, line{
    stroke: #B2BABB !important;
  }
  .scatterPlotY path, line{
    stroke: #B2BABB !important;
  }
  .tick text {
    font-weight: lighter !important;
    fill: #2C3E50 !important;
  }
  .section {
    margin-bottom: 50px;
  }
  .scatter .body-text h1{
    margin-top: 20px;
    margin-bottom: 0px;
    font-size: 25px;
  }

  .scatter {
    background-color: #F8F9F9;
    height: 700px;
  }

  .slider {
    width: 70%;
    margin: auto;
  }

  .time-slider {
    background: #E5E8E8;
    outline: none;
    opacity: 0.8;
    -webkit-appearance: none;
    appearance: none;
    width: 100%;
    height: 30px;
  }

  .time-slider::-webkit-slider-thumb {
    appearance: none;
    width: 10px;
    height: 30px;
    background: #85C1E9;
    -webkit-appearance: none;
  }

  .body-text h1{
    font-weight: 100;
    font-size: 40px;
    color: #566573;
  }

  .body-text h2 {
    font-weight: 600;
    font-size: 18px;
    color: #283747;
    margin-bottom:30px;
  }

  .body-text p {
    font-weight: 300;
    font-size: 16px;
    color: #566573;
    line-height: 170%;
    margin-bottom:-10px;
  }

  .body-text img {
    margin-top: 30px;
  }

  .body-text-map {
    margin: auto;
    width: 80%;
    margin-top: 75px;
    margin-bottom: 75px;
  }

  .body-text-map h1{
    text-align: center;
    font-weight: 600;
    font-size: 27px;
    color: #2C3E50;
  }

  .body-text-map p{
    font-weight: 300;
    font-size: 16px;
    color: #566573;
    line-height: 170%;
    margin-bottom:-10px;
  }

  .footer {
    background-color: #F8F9F9;
    padding-top: 60px;
    text-align: center;
    padding-bottom: 40px;
  }

  .sc {
    padding-bottom: 30px;
  }

  .country {
  fill: #b8b8b8;
  stroke: #fff;
  stroke-width: .5px;
  stroke-linejoin: round;
}

.graticule {
  fill: none;
  stroke: #000;
  stroke-opacity: .3;
  stroke-width: .5px;
}

.graticule-outline {
  fill: none;
  stroke: #333;
  stroke-width: 1.5px;
}

.nav-masthead .nav-link {
  padding: .25rem 0;
  font-weight: 700;
   font-size: 16px;
  color: rgba(0, 0, 0, 0.6);
  background-color: transparent;
  border-bottom: .25rem solid transparent;
}

.nav-masthead .nav-link:hover,
.nav-masthead .nav-link:focus {
  border-bottom-color: rgba(0, 0, 0, 0.6);
}

.nav-masthead .nav-link + .nav-link {
  margin-left: 1rem;
}

.nav-masthead .active {
   font-size: 16px;
  color: rgba(0, 0, 0, 0.6);
  border-bottom-color: rgba(0, 0, 0, 0.6);
}
.dropdown {
  margin-right: 30px;
}
.country-selector{
  margin-right: 30px;
}
.dropdown-menu {
    max-height: 280px;
    overflow-y: auto;
}
.country-table {
  margin-top: 50px;
  margin-left: auto;
  margin-right: auto;
  width: 500px;
}
.select-image-section{
  /*background-color: #F8F9F9;*/
}
.image-list-section {
  margin-top: 50px;
  padding-top: 10px;
  padding-bottom: 50px;
  background-color: #f0edea;
}
.blue-bt{
  background-color: #85C1E9;
  color: white;
}
/*
 * Header
 */

 .toolBar {
  width:100%;
  margin:0px;
  /* background-color: #5e5e5e; */
  background-color: white;
  height: 45px;
  padding-top: 15px;
  padding-left: 15px;
  font-size:17px;
}
.menuItems {
 padding-left:40px;
 text-align:left;
}
.menuItem, .logoutText {
 padding: .25rem 0;
 padding-left: 10px;
 padding-right: 10px;
 font-weight: 700;
 color: rgba(255, 255, 255, .5);
 /* color: #fff; */
 color: #5e5e5e;
 background-color: transparent;
 border-bottom: .25rem solid transparent;
 margin:7px;
 text-align:left;
}

.menuItem:hover,
.menuItem:focus {
  /* color: white; */
  color: #5e5e5e;
  border-bottom-color: #5e5e5e;
  /* border-bottom-color: rgba(255, 255, 255, .25); */
}

.active {
 /* color: white; */
 color: #5e5e5e;
 border-bottom-color: #5e5e5e;;
 /* border-bottom-color: white; */
}
.logoutText {
  color: white;
}

.logoutText:hover {
  color: #5a5a5a;
}

.logoutButton {
 width:80%;
 border-width:0px;
 background-color: #F2A074;
 border-radius: 5px;
 color: #fff;
}
</style>
</head>
<body>
  <table class="toolBar">
    <tr>
      <td class="menuItems">
          <a style="text-decoration: none;" href="homepage.php" class="menuItem">Home</a>
      
        <a  style="text-decoration: none;" class="menuItem" href="AboutPage.php">About</a>
      
        <a  style="text-decoration: none;" class="menuItem active" href="datepicker.php">Create</a>
        <a style="text-decoration: none;" class="menuItem" href="instructions.php">Help</a>
      </td>
      <td width="13%">
        <?php
        session_start();
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
          echo '';
        } else {
          echo '<h5>'.$_SESSION['first_name'].' '.$_SESSION['last_name'].'</h5>';
        }
        ?>
      </td>
      <td width="10%">
        <button class="logoutButton">
          <a style="text-decoration: none;" class="logoutText" href="logout.php" margin-right="0px">Logout</a>
        </button>
        <!-- <a class="menuItem" href="logout.php" margin-right="0px">Logout</a> -->
      </td>
    </tr>
  </table>
  <!-- <header class="cover-container d-flex h-100 p-3 gap-5 justify-content-center">
    <div>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link active" aria-current="page" href="#">Map</a>
        <a class="nav-link" href="AboutPage.php">About</a>
        <a class="nav-link" href="homepage.html">Home</a>
      </nav>
    </div>

  </header> -->

  <div class="headerpart">
    <div class="header-text1">
      <h1>Interactive Map</h1>
      <h2>Please select the country for your photo, and then add it into the list. We will use this list to generate a interactive map for you! You can select the maximum 10 photos.</h2>
    </div>
  </div>
  <section class="select-image-section">
    <form class="selector d-flex gap-5 justify-content-center">
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="selectImageBt" data-bs-toggle="dropdown" aria-expanded="false">
          Select Image
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="imageDropdown">
        </ul>
      </div>
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="selectCountryBt" data-bs-toggle="dropdown" aria-expanded="false">
          Select Country
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="countryDropdown">
        </ul>
      </div>
      <div class="dropdown">
        <button type="button" class="blue-bt btn " onclick="addToList()">Add To List</button>
      </div>
      <div class="dropdown">
         <div id="warining"></div>
      </div>
    </form>
  </section>
  <section class="image-list-section">
    <div class="table-responsive country-table d-flex gap-5 justify-content-center">
      <table class="table align-middle">
        <thead>
          <tr>
            <th scope="col">Order</th>
            <th scope="col">Image</th>
            <th scope="col">Country Name</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody id="selectedImageTable">
        </tbody>
      </table>
    </div>
    <form class="selector d-flex gap-5 justify-content-center">
    <button type="button" class="blue-bt btn " onclick="generateMap()">Generate Map</button>
  </form>
  </section>


  <section class="footer">
    <h2>Stanford CS 194</h2>
  </section>
<script type="text/javascript">
arr = document.cookie.split(';')
    token = arr[1].split('=')[1]
    startDate = JSON.parse(window.sessionStorage.getItem("start"));
    endDate = JSON.parse(window.sessionStorage.getItem("end"));
    console.log(startDate);
    console.log(endDate);
    getUserData(token)

    async function getMediaData(data, access_token) {
          var listOfPhotos = [];
          var car_urls = []
          var promises = [];
          data.forEach(function(item) {
              const mediaID = item["id"];
              var url = 'https://graph.instagram.com/'+ mediaID + '?fields=media_type,media_url,timestamp&access_token='+access_token;
              promises.push(fetch(url)
                    .then( response => response.json() )
                    .then( response => {
                    if (response["media_type"] == "IMAGE") {
                       var timestamp = new Date(response["timestamp"]).getTime();
                        timestamp = timestamp/1000;
                        console.log(timestamp);
                      listOfPhotos.push({
                            image: response["media_url"],
                            timestamp: timestamp
                        });
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
                        car_urls.push(url);
                    } else {
                        console.log("Not support video for now.");
                    }
                }));
          });
          return Promise.all(promises).then(() => {
              return {
                photos: listOfPhotos,
                car_urls: car_urls
              };
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
                        var timestamp = new Date(response["timestamp"]).getTime();
                        timestamp = timestamp/1000;
                        console.log(timestamp);
                          listOfPhotos.push({
                                image: response["media_url"],
                                timestamp: timestamp
                            });
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
          var url = 'https://graph.instagram.com/me/media?access_token=' + access_token + '&since=' + startDate + '&until=' + endDate;
          fetch(url)
          .then( response => response.json() )
          .then( response => {
              data = response["data"];
              getMediaData(data, access_token).then((data) => {
                    var car_urls = data["car_urls"];
                    var photos = data["photos"];

                    // Utilize CAROUSEL_ALBUM fetch urls to get each CAROUSEL_ALBUM's data object.
                    getIndividualCarouselDatas(car_urls).then((individual_datas) => {
                        // With each CAROUSEL_ALBUM's data object, we can loop over each item in it to get each photo URL.
                        getIndividualCarouselPhotos(individual_datas, access_token).then((listOfPhotos) => {
                            listOfPhotos = listOfPhotos.concat(photos);
                            displayMap(listOfPhotos);
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

var imageDict = [];
function displayMap(listOfPhotos) {
  console.log(listOfPhotos);
  imageDict = listOfPhotos;
  var li = "";
  for (let i = 0; i < imageDict.length; i++) {
    var data = imageDict[i];
    li +=
    "<li><a class='dropdown-item' onclick='setImage("+i+")'><img src="+data.image+" width='200px'/> Image "+(i+1)+"</a></li>";
  }
  document.getElementById("imageDropdown").innerHTML = li;

  d3.json("https://cdn.jsdelivr.net/npm/world-atlas@2/countries-110m.json", function(error, world) {
    var countries = topojson.object(world, world.objects.countries).geometries;
    var names = [];
    countries.forEach(country => {
      names.push(country.properties.name);
    });
    names.sort();
    var li = "";
    names.forEach(name => {
      li += "<li><a class='dropdown-item' onclick='setCountry(\""+name+"\")'>"+name+"</a></li>";
    });
    document.getElementById("countryDropdown").innerHTML = li;
  });
}


var selectedImageList = [];
var currentImage = "Select Image";
var currentCountry = "Select Country";
var currentTime = 0;

function setImage(index){
  currentImage = imageDict[index].image;
  currentTime = imageDict[index].timestamp;
  var imageNum = index+1;
  document.getElementById("selectImageBt").innerHTML = "Image " + imageNum;
}

function setCountry(country){
  currentCountry = country;
  document.getElementById("selectCountryBt").innerHTML = country;
}

function addToList(){
  if (!checkImageAndCountry()) {
    return;
  }
  if (!exceedImageLimitValidator()){
    return;
  }
  if (!checkDuplication(currentImage)){
    return;
  }
  selectedImageList.push({
    image:currentImage,
    country:currentCountry,
    date:currentTime,
  });
  updateList();
  resetPlaceholder();
}

function resetPlaceholder() {
  currentImage = "Select Image";
  currentCountry = "Select Country";
  document.getElementById("selectImageBt").innerHTML = currentImage;
  document.getElementById("selectCountryBt").innerHTML = currentCountry;
}

function checkImageAndCountry(){
  if (currentImage != "Select Image" && currentCountry != "Select Country") {
    document.getElementById("warining").innerHTML ="";
    return true;
  } else {
    document.getElementById("warining").innerHTML = "<div class='alert alert-danger' role='alert'> Please set both the image and the country.</div>";
    return false;
  }
  return true;
}

function checkDuplication(image){
  for (let i = 0; i < selectedImageList.length; i++) {
    var d = selectedImageList[i];
    if (d.image == image){
      document.getElementById("warining").innerHTML = "<div class='alert alert-danger' role='alert'> Add Duplicate Image.</div>";
      return false;
     }
  }
  document.getElementById("warining").innerHTML ="";
  return true;
}

function exceedImageLimitValidator(){
  if (selectedImageList.length >= 10) {
    document.getElementById("warining").innerHTML = "<div class='alert alert-danger' role='alert'>Exceed 10 photos limit!</div>";
    return false;
  } else {
    document.getElementById("warining").innerHTML ="";
    return true;
  }
}

function updateList(){
  if (selectedImageList.length != 0){
    selectedImageList.sort((d1, d2) => {
      if (d1.date > d2.date) return 1;
      if (d1.date < d2.date) return -1;
      return 0;
    });
  }
  console.log(selectedImageList);
  document.getElementById("selectedImageTable").innerHTML = "";
  for (let i = 0; i < selectedImageList.length; i++) {
    var d = selectedImageList[i];
    insertRow(d.date, d.image, d.country, i);
  }
}

function removeImage(index){
  selectedImageList.splice(index, 1);
  updateList();
}

function insertRow(date, image, country, index) {
  var table = document.getElementById("selectedImageTable");
  var row = table.insertRow(-1);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  cell1.innerHTML = timeConverter(date);
  cell2.innerHTML = "<img src=" +  image + " width='200px'/>";
  cell3.innerHTML = country;
  cell4.innerHTML =
  "<button type='button' class='btn btn-outline-dark' onclick='removeImage("+index+")'>Delete</button>";
}

function generateMap(){
  if (selectedImageList.length < 2) {
    document.getElementById("warining").innerHTML = "<div class='alert alert-danger' role='alert'>Please choose minimum 2 photos!</div>";
    return false;
  }
  window.sessionStorage.setItem("data", JSON.stringify(selectedImageList));
  window.location.replace("earth.php");
}

function timeConverter(UNIX_timestamp){
  var a = new Date(UNIX_timestamp * 1000);
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var dateStr = ['1st','2nd','3rd'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  if (date <= 3) {
    date = dateStr[date - 1];
  } else {
    date = date + "th";
  }
  var time = month + ' '+ date + ' ' + year;
  return time;
}
</script>
</body>
</html>
