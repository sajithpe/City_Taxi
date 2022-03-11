<!DOCTYPE html>
<html>
    <head>
        <title>
            City Taxi (PVT) Ltd | Trips History
        </title>

        <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<style type="text/css">

*{margin: 100px;
  margin-top: 30px;
}

*{
font-family: sans-serif;
}
#menu{
position: absolute;

float: left;
}
#check:checked ~ label #cancel{
left: 190px;
}
a:hover{
text-decoration: none;
}
body{
background: url(dash2.png) no-repeat;
background-position: center;
background-size: cover;
height: 100vh;
transition: all .5s;
}
.col-sm-9 h4{
margin-top: 10px;
}
.content-table{
border-collapse: collapse;
margin: 25px 0;
font-size: 0.9em;
min-width: 400px;
border-radius: 5px 5px 0 0;
overflow: hidden;
box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.content-table thead tr{
background-color: #343a40;
color: #ffffff;
text-align: left;
font-weight: bold;
}
.content-table th,
.content-table td {
padding: 10px 15px;
}

.content-table tbody tr {
border-bottom: 1px solid #dddddd;
}
.content-table tbody tr:nth-of-type(even){
background-color: #f3f3f3;
}
.content-table tbody tr:last-of-type{
border-bottom: 2px solid #343a40;
}
.content-table tbody tr.active-row{
font-weight: bold;
color: #343a40;
}

* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('images/search-icon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 25%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}

</style>
    </head>
    <body background="hero-bg.jpg">
        <h4 style="font-family:Helvetica;" align="center">Trips History</h4>
        </br>

        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for ID.." title="Type in a name">
</br>

            <table class="content-table" align="left">
                <thead>
                <tr>
                <th>Trip Id</th>
                <th>Request Id</th>
                <th>Customer Id</th>
                <th>Driver Id</th>
                <th>Car Type</th>
                <th>Pick Up Location</th>
                <th>Distance km</th>
                <th>Confirm Date & Time</th>
                <th>Pick Date & Time</th>
                <th>Drop Location</th>
                <th>Drop Date & Time</th>
                <th>Total Cost</th>
                <th>Driver Payment</th>
                </tr>
                </thead>
        </table>

        <script>
            function myFunction() {
              var input, filter, table, tr, td, i, txtValue;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              table = document.getElementById("myTable");
              tr = table.getElementsByTagName("tr");
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                  txtValue = td.textContent || td.innerText;
                  if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                }       
              }
            }
            </script>

    </body>
</html>