<?php
// Initialize the session
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
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
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/2.13.0/d3-legend.js"></script>
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

    .nav-masthead .nav-link+.nav-link {
      margin-left: 1rem;
    }

    .nav-masthead .active {
      color: #fff;
      border-bottom-color: #fff;
    }

    body {
      font-family: Arial;
      font-size: 12px;
      color: #212529;
      margin: 0;
    }

    .tooltips {
      position: absolute;
      text-align: left;
      background: rgba(0, 0, 0, 0.7);
      border-radius: 3px;
      line-height: 1;
      color: white;
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

    .R {
      color: #CA6F1E;
    }

    .headerpart {
      background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(/images/Travel_2.jpeg);
      background-position: center;
      background-size: cover;
      height: 400px;
    }

    .header-text1 {
      text-align: center;
      padding: 100px 0;
    }

    .header-text1 h1 {
      margin-top: 20px;
      font-size: 70px !important;
      font-weight: 700;
      color: white;
    }

    .header-text1 h2 {
      margin-top: 30px;
      margin-right: 100px;
      margin-left: 100px;
      font-size: 20px !important;
      /*font-weight: normal;*/
      font-weight: 600;
      color: white;
      line-height: 150%;
    }

    .btn-secondary,
    .btn-secondary:hover,
    .btn-secondary:focus {
      margin-top: 20px;
      color: #333;
      text-shadow: none;
      /* Prevent inheritance from `body` */
      font-weight: 700 !important;

    }

    .body-text {
      text-align: center;
      padding-top: 80px;
      padding-bottom: 100px;
      padding-left: 350px;
      padding-right: 350px;
      background-color: #f0edea;
    }

    .body-text h1 {
      margin-top: 0px;
      font-size: 25px;
    }

    .body-text h2 {
      margin-top: 0px;
      font-size: 18px;
      font-weight: normal;
    }

    .footer h2 {
      margin-top: 0px;
      font-size: 18px;
      font-weight: 600;
    }

    .maps {
      margin-top: 50px;
      margin: auto;
      width: 1200px;
      height: 1000px;

    }

    .map {
      margin-top: 50px;
      /*margin: auto;*/
      /*width: 1200px;*/
      height: 1000px;
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

    .scatterPlotX path,
    line {
      stroke: #B2BABB !important;
    }

    .scatterPlotY path,
    line {
      stroke: #B2BABB !important;
    }

    .tick text {
      font-weight: lighter !important;
      fill: #2C3E50 !important;
    }

    .section {
      margin-bottom: 50px;
    }

    .scatter .body-text h1 {
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

    .body-text h1 {
      font-weight: 100;
      font-size: 40px;
      color: #566573;
    }

    .body-text h2 {
      font-weight: 600;
      font-size: 18px;
      color: #283747;
      margin-bottom: 30px;
    }

    .body-text p {
      font-weight: 300;
      font-size: 16px;
      color: #566573;
      line-height: 170%;
      margin-bottom: -10px;
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

    .body-text-map h1 {
      text-align: center;
      font-weight: 600;
      font-size: 27px;
      color: #2C3E50;
    }

    .body-text-map p {
      font-weight: 300;
      font-size: 16px;
      color: #566573;
      line-height: 170%;
      margin-bottom: -10px;
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

    .nav-masthead .nav-link+.nav-link {
      margin-left: 1rem;
    }

    .nav-masthead .active {
      font-size: 16px;
      color: rgba(0, 0, 0, 0.6);
      border-bottom-color: rgba(0, 0, 0, 0.6);
    }

    .tooltips {
      position: absolute;
      text-align: left;
      width: 300px;
      background: white;
      border-radius: 3px;
      line-height: 1;
    }

    .trip-photo {
      border-radius: 6px;
    }

    .country-name {
      background-color: #F8F9F9;
      padding-top: 60px;
      text-align: center;
      padding-bottom: 40px;
    }

    .country-name .h2 {
      margin-top: 30px;
      font-size: 20px !important;
      font-weight: normal;
      font-weight: 700;
      color: white;
    }

    .toolBar {
      width: 100%;
      margin: 0px;
      /* background-color: #5e5e5e; */
      background-color: white;
      height: 45px;
      padding-top: 15px;
      padding-left: 15px;
      font-size: 17px;
    }

    .menuItems {
      padding-left: 40px;
      text-align: left;
    }

    .menuItem,
    .logoutText {
      padding: .25rem 0;
      padding-left: 10px;
      padding-right: 10px;
      font-weight: 700;
      color: rgba(255, 255, 255, .5);
      color: #5e5e5e;
      background-color: transparent;
      border-bottom: .25rem solid transparent;
      margin: 7px;
      text-align: left;
    }

    .menuItem:hover,
    .menuItem:focus {
      color: #5e5e5e;
      border-bottom-color: #5e5e5e;
    }

    .active {
      color: #5e5e5e;
      border-bottom-color: #5e5e5e;
      ;
      /* border-bottom-color: white; */
    }

    .logoutText {
      color: white;
    }

    .logoutText:hover {
      color: #5a5a5a;
    }

    .username {
      font-weight: 700;
      color: #5e5e5e;
    }

    .logoutButton {
      width: 80%;
      border-width: 0px;
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
        <a style="text-decoration: none;" class="menuItem" href="AboutPage.php">About</a>
        <a style="text-decoration: none;" class="menuItem active" href="datepicker.php">Create</a>
        <a style="text-decoration: none;" class="menuItem" href="instructions.php">Help</a>
      </td>
      <td width="13%">
        <?php
        session_start();
        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
          echo '';
        } else {
          echo '<h5 class="username">' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . '</h5>';
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
  <div class="headerpart">
    <div class="header-text1">
      <h1>Interactive Map</h1>
      <h2>The earth map interacts with your photos.</h2>
    </div>
  </div>
  <section class="body-text">
    <h2> How To Generate A Video | Mac User Only</h2>
    <p>To get a video, click the search icon on the top right corner on your screen, then type Quicktime Player. Open the Quicktime Player, and then select File -> New Screen Recording. Click the red icon on Screen Recording popover, select the map area that you like, then hit Start Recording. After you finish recording, click the icon on the upper right on your screen to end the recording. Then save the file to your destination.</p>
  </section>
  <section class="maps">
    <div class="map">
    </div>
  </section>
  <section class="footer">
    <h2>Stanford CS 194 | Team 22 | Round About</h2>
  </section>
  <script type="text/javascript">
    var width = 1200,
      height = 1000;

    var projection = d3.geoOrthographic()
      .scale(300)
      .clipAngle(90);

    var path = d3.geoPath()
      .projection(projection);

    var svg = d3.select(".map")
      .append("svg")
      .attr("width", width)
      .attr("height", height)

    var data = JSON.parse(window.sessionStorage.getItem("data"));
    var timeDuration = []
    for (var i = 0; i < data.length; i++) {
      timeDuration.push(data[i].date);
    }

    svg.append("text")
      .attr("class", "title")
      .attr("text-anchor", "middle")
      .attr("transform", "translate(600, 170)")
      .style("font-size", "16px")
      .style("font-weight", "bold")
      .style("fill", "#454545");

    svg.append("circle")
      .attr("class", "graticule-outline")
      .attr("cx", width / 2)
      .attr("cy", height / 2 + 80)
      .attr("r", projection.scale());

    var defs = svg.append("defs").attr("id", "imgdefs")
    var profilePhoto = defs.append("pattern")
      .attr("id", "profilePhoto")
      .attr("height", 1)
      .attr("width", 1)
      .attr("x", "0")
      .attr("y", "0")
      .append("image")
      .attr("x", 0)
      .attr("y", 0)
      .attr("height", 100)
      .attr("width", 100)
      .attr("xlink:href", data[0].image);

    svg.append("circle")
      .attr("r", 50)
      .attr("cy", 70)
      .attr("cx", 600)
      .attr("fill", "url(#profilePhoto)");

    var domain = getDomain(timeDuration.length);
    var colorRange = getColorRange();
    var label = getLabel(timeDuration.length + 1);
    var linear = d3.scaleLinear()
      .domain(domain)
      .range(colorRange);

    var midpoint = width / 2 - (102 * (timeDuration.length + 1)) / 2;
    svg.append("g")
      .attr("class", "legend")
      .attr("transform", "translate(" + midpoint + ", 215)");

    var legend = d3.legendColor()
      .cells(timeDuration.length + 1)
      .shapeWidth(100)
      .shapeHeight(5)
      .scale(linear)
      .orient('horizontal')
      .labels(label);

    svg.select(".legend")
      .call(legend);

    var timeline = svg.select(".legend");


    d3.json("https://cdn.jsdelivr.net/npm/world-atlas@2/countries-110m.json", function(error, world) {
      var timelinePoint = timeline.selectAll("point")
        .data(timeDuration)
        .enter()
        .append("circle")
        .attr("r", 6)
        .attr("cx", function(d, i) {
          return 100 + i * 102;
        })
        .attr("cy", 2)
        .style("fill", function(d, i) {
          return getColor(i);
        });

      var date = timeline.selectAll("timePath")
        .data(timeDuration)
        .enter()
        .append("text")
        .attr("class", "date")
        .attr("text-anchor", "middle")
        .text(function(d, i) {
          return timeConverter(timeDuration[i]);
        })
        .style("font-size", "16px")
        .style("font-weight", "bold")
        .style("fill", "#ffffff")
        .attr("transform", function(d, i) {
          return "translate(" + (100 + i * 102) + ", " + (i % 2 == 0 ? -15 : 30) + ")";
        });

      var worldMap = d3.map();
      var countries = topojson.object(world, world.objects.countries).geometries;
      for (var i = 0; i < countries.length; i++) {
        var country = countries[i];
        var name = country.properties.name;
        worldMap.set(name, country)
      }
      var countries = topojson.object(world, world.objects.countries).geometries;
      var country = svg.selectAll(".country")
        .data(countries)
        .enter().insert("path", ".graticule")
        .attr("class", "country")
        .attr("d", path)
        .attr("transform", "translate(120,330)")
        .style("opacity", 0.8)
        .style("stroke-width", "0.8")
        .style("stroke", "white")
        .style("fill", "#85C1E9")
        .on("mouseover", function(d) {
          d3.select(this)
            .style("opacity", 1)
            .style("stroke", "white")
            .style("stroke-width", 3);
        })
        .on("mouseout", function(d) {
          d3.select(this)
            .style("opacity", 0.8)
            .style("stroke-width", "0.8")
            .style("stroke", "white");
        });


      var travelPhoto = svg.append("svg:image")
        .attr("class", "tooltips")
        .attr('width', 200);
      var n = data.length,
        i = -1;
      step();

      function step() {
        if (++i >= n) i = 0;
        var currentCountryName = data[i].country;
        var currentCountryGeo = worldMap.get(currentCountryName);

        var time = timeConverter(parseInt(data[i].date));

        var idx1 = i == 0 ? n - 1 : i - 1;
        var idx2 = i == n ? 0 : i;

        var c1 = d3.geoCentroid(worldMap.get(data[idx1].country));
        var c2 = d3.geoCentroid(worldMap.get(data[idx2].country));

        country.transition()
          .style("fill", function(d) {
            if (d.properties.name == data[i].country) {
              return "#4863A0";
            } else {
              return "#85C1E9";
            }
          });

        date.transition()
          .style("fill", function(d, j) {
            if (j == i) {
              return getColor(i);
            } else {
              return "#ffffff";
            }
          });

        timelinePoint.transition()
          .attr("r", function(d, j) {
            if (j == i) {
              return 12;
            } else {
              return 8;
            }
          });


        d3.transition()
          .delay(250)
          .duration(2000)
          .tween("rotate", function() {
            var point = d3.geoCentroid(currentCountryGeo),
              rotate = d3.interpolate(projection.rotate(), [-point[0], -point[1]]);
            return function(t) {
              projection.rotate(rotate(t));
              country.attr("d", path);
              svg.select(".title")
                .text(time + ", in " + data[i].country);
              svg.select(".tooltips")
                .attr('x', 600 + c2[0] + 150)
                .attr('y', 300 + c2[1])
                .attr("xlink:href", data[i].image);
            };
          })
          .transition()
          .on("end", step);
      }
    });

    function getDomain(length) {
      var domain = []
      for (var i = 0; i < length; i++) {
        domain.push(i);
      }
      return domain;
    }

    function getLabel(length) {
      var label = []
      for (var i = 0; i < length; i++) {
        label.push("");
      }
      return label;
    }

    function timeConverter(UNIX_timestamp) {
      var a = new Date(UNIX_timestamp * 1000);
      var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
      var dateStr = ['1st', '2nd', '3rd'];
      var year = a.getFullYear();
      var month = months[a.getMonth()];
      var date = a.getDate();
      if (date <= 3) {
        date = dateStr[date - 1];
      } else {
        date = date + "th";
      }
      var time = month + ' ' + date + ' ' + year;
      return time;
    }

    function getColor(i) {
      var range = getColorRange();
      return range[i];
    }

    function getColorRange() {
      var colorR = [];
      var mid = Math.floor(timeDuration.length / 2);
      for (var i = 0; i < timeDuration.length + 1; i++) {
        var j = 5 - mid + i;
        colorR.push(d3.rgb(getColorCode(j)));
      }
      return colorR;
    }

    function getColorCode(idx) {
      idx++;
      switch (idx) {
        case 1:
          return "#154360";
        case 2:
          return "#2471A3";
        case 3:
          return "#2980B9";
        case 4:
          return "#5499C7";
        case 5:
          return "#7FB3D5";
        case 6:
          return "#F0B27A";
        case 7:
          return "#EB984E";
        case 8:
          return "#E67E22";
        case 9:
          return "#CA6F1E";
        case 10:
          return "#873600";
      }
    }
  </script>
</body>
</html>