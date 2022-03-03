<ul class="nav nav-tabs nav-justified">

  <li class="nav-item">
    <a class="nav-link active" data-bs-toggle="tab" href="#usr_tab" onclick="getUsers();" id="usr_btn">Users</a>
  </li>
  <!-- <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#drvr_tab" onclick="getDrivers();" id="drvr_btn">Drivers</a>
  </li> -->
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#vhcl_tab" onclick="getVehicles();" id="vcle_btn">Vehicles</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#vtype_tab" onclick="getVtypes();" id="vty_btn">Vehicle Types</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content" style="border-width: 2px; border-color: green;">
  <div class="tab-pane container active" id="usr_tab"></div>
  <div class="tab-pane container fade" id="drvr_tab"></div>
  <div class="tab-pane container fade" id="vhcl_tab"></div>
  <div class="tab-pane container fade" id="vtype_tab"></div>
</div>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    var usrBtn = $("#usr_btn");
    usrBtn.click();
  });



  function getVtypes(){

    $.ajax({
      url: "/vTypeList",
      type: 'post',
      success: function(data) {
        $('#vtype_tab').load("<?php echo site_url('vTypeControl/index') ?>");
        $('#vType-list').DataTable();

      },
      error: function(data) {
        console.log(data);
        $('#mainDiv').text('An error occurred');
      }
    });
    
  }



  function getVehicles() {

    $.ajax({
      url: "/vehicleList",
      type: 'post',
      success: function(data) {
        $('#vhcl_tab').load("<?php echo site_url('vehicleControl/index') ?>");
        $('#vehicle-list').DataTable();

      },
      error: function(data) {
        console.log(data);
        $('#mainDiv').text('An error occurred');
      }
    });

  }

  function getDrivers() {

    $.ajax({
      url: "/driverList",
      type: 'post',
      success: function(data) {
        $('#drvr_tab').load("<?php echo site_url('driverControl/index') ?>");
        $('#driver-list').DataTable();

      },
      error: function(data) {
        console.log(data);
        $('#mainDiv').text('An error occurred');
      }
    });

  }

  function getUsers() {
    $.ajax({
      url: "/usersList",
      type: 'post',
      success: function(data) {
        $('#usr_tab').load("<?php echo site_url('userControl/index') ?>");
        $('#users-list').DataTable();

      },
      error: function(data) {
        console.log(data);
        $('#mainDiv').text('An error occurred');
      }
    });
  }
</script>