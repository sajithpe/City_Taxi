<style type="text/css">
  #drivers {
    width: 100%;
    height: 40px;
    border: none;
    outline: none;
    margin-bottom: 15px;
    padding-left: 15px;
  }

  #vehicles {
    width: 100%;
    height: 40px;
    border: none;
    outline: none;
    margin-bottom: 15px;
    padding-left: 15px;
  }
</style>


<div class="hero_area">

  <!-- slider section -->
  <section class=" slider_section ">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7 mx-3">
          <div class="box">
            <div class="detail-box">
              <h4>
                Welcome to
              </h4>
              <h1>
                CITY TAXI
              </h1>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide mr-7" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
              </ol>
              <div class="carousel-inner ">
                <div class="carousel-item active">

                  <div class="img-box">
                    <img src="/images/slider-img.png" alt="">
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="img-box">
                    <img src="/images/slider-img.png" alt="">
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="img-box">
                    <img src="/images/slider-img.png" alt="">
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="img-box">
                    <img src="/images/slider-img.png" alt="">
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="img-box">
                    <img src="/images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>

            <!--<div class="btn-box">
                  <a href="" class="btn-1">
                    Read More
                  </a>
                </div>-->
          </div>
        </div>
        <div class="col-md-4">
          <div class="slider_form">
            <h4>
              Request A Taxi Now
            </h4>
            <form action="">
              <select name="vehicles" id="vehicles" required>
                <option value="" disabled selected hidden>Select a Vehicle</option>
                <?php if ($types) : ?>
                  <?php foreach ($types as $t) : ?>
                    <option value="<?php echo $t['vm_id'] ?>"><?php echo $t['v_type'] ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>

              </select>
              <select name="drivers" id="drivers" required>
                <option value="" disabled selected hidden>Select a Driver</option>
                <option></option>
                <option></option>
              </select>
              <input type="text" placeholder="Pick Up Location" onclick="getLocation();">
              <input type="text" placeholder="Drop Location">
              <input type="date" placeholder="Pick Up Date">
              <input type="time" placeholder="Pick Up Time">

              <div class="btm_input">

                <button>Book Now</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- end slider section -->
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOdL2aH3NpsYb2mtW1Q7pVAsYcEltDoRI&callback">
</script>


<script type="text/javascript">

  function getLocation(_url) {
    var geoOps = {
      enableHighAccuracy: true,
      timeout: 10000 //10 seconds
    }

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPossition, showError, geoOps)
    } else {

    }
  }

  function initMap(lat, lng) {

    var myLatLng = {
      lat,
      lng
    };


    // var map = new google.maps.Map(document.getElementById('map'), {
    //   zoom: 15,
    //   center: myLatLng
    // });

    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
    });
  }

  function showPossition(possition) {


    console.log("latitude is " + possition.coords.latitude + " And, Longitude is " + possition.coords.longitude);
    var long = possition.coords.longitude;
    var lat = possition.coords.latitude;
    // $("#map").text("")
  }

  function showError(error) {
    switch (error.code) {
      case error.PERMISSION_DENIED:
        alert("you must allow google to get your location...");
        break;
    }
  }
</script>