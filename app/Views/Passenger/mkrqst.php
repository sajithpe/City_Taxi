<h1>Make request page</h1>


<button class="btn btn-success" onclick="getLocation();">Get my location</button>

<div class="col-8">



    <h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
    <div id="map">

        <iframe src='https://www.google.com/maps?q=7.157438,79.994105&h1=es;z=14&output=embed'></iframe>

    </div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&libraries=&v=weekly" async></script> -->
</div>



<script type="text/javascript">
    function getLocation(_url) {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPossition, showError, {maximumAge:60000, timeout:5000, enableHighAccuracy:true}) 
        } else {

        }
    }

    function showPossition(possition) {


        console.log("latitude is " + possition.coords.latitude + " And, Longitude is " + possition.coords.longitude);
        var long = possition.coords.longitude;
        var lat = possition.coords.latitude;
        $("#map").text("")
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("you must allow google to get your location...");
                break;
        }
    }

   
</script>