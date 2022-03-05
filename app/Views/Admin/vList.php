<div class="container mt-5">

    <div class="d-flex flex-row-reverse bd-highlight">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formAddV" onclick="" id="addV">Add new Vehicle</button>
    </div>


    <div class="mt-3 table-responsive pt-1 mt-1">
        <table class="table table-bordered table-striped table-hover styled-table" id="v-list">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Vehicle Number</th>
                    <th>Vehicle Model</th>
                    <th>Brand</th>
                    <th>Vehicle Type</th>
                    <th>Driver</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($vehicles) : ?>
                    <?php foreach ($vehicles as $vehicle) : ?>
                        <tr>
                            <td><?php echo $vehicle['v_id']; ?></td>
                            <td><?php echo $vehicle['v_number']; ?></td>
                            <td><?php echo $vehicle['v_model']; ?></td>
                            <td><?php echo $vehicle['v_brand']; ?></td>
                            <td><?php echo $vehicle['v_type']; ?></td>
                            <td><?php echo $vehicle['name1']; ?> <?php echo $vehicle['name2']; ?></td>
                            <td><?php
                                switch ($vehicle['v_delStatus']) {
                                    case "n":
                                        echo "Active";
                                        break;
                                    case "y":
                                        echo "In-Active";
                                        break;
                                    case null:
                                        echo "Active";
                                        break;
                                }
                                ?>
                            </td>

                            <td>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="edit_v(<?php echo $vehicle['v_id']; ?>)">Edit</button>
                                <?php
                                switch ($vehicle['v_delStatus']) {
                                    case "n":
                                        echo '<button type="button" class="btn-outline-danger btn-sm" onclick="delete_v(' . $vehicle['v_id'] . ');" >Disable</button>';
                                        break;
                                    case "y":
                                        echo '<button type="button" class="btn btn-outline-warning btn-sm" onclick="delete_v(' . $vehicle['v_id'] . ');" >Enable</button>';
                                        break;
                                    case null:
                                        echo '<button type="button" class="btn btn-outline-danger btn-sm" onclick="delete_v(' . $vehicle['v_id'] . ');" >Disable</button>';
                                        break;
                                }
                                ?>


                                <button type="button" class="btn-outline-secondary btn-sm" onclick="vehicle_d(<?php echo $vehicle['v_id']; ?>)">Driver</button>


                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<<div class="modal fade" id="formAddV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="color: black;">
                <form action="" id="addV_form">
                    <div class="row g-3 align-items-center py-2">
                        <input type="hidden" id="vid" name="vid" class="form-control">
                        <div class="col-5">
                            <label class="form-label">Vehicle Number</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="vNum" name="vNum" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">Model</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="vModel" name="vModel" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">Brand</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="vBrand" name="vBrand" class="form-control">

                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">Vehicle Type</label>
                        </div>
                        <div class="col-5">
                            <select class="form-select" name="vType" id="vType">
                                <option value=""></option>
                                <?php if ($types) : ?>
                                    <?php foreach ($types as $t) : ?>
                                        <option value="<?php echo $t['vm_id'] ?>"><?php echo $t['v_type'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnVsave" onclick="save_v();">Create Type</button>
                <button type="button" class="btn btn-success" id="btnVupdate" onclick="update_v();">Update Type</button>
            </div>
            </form>
        </div>
    </div>
    </div>
    <<div class="modal fade" id="formAddD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modTitle2"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color: black;" id="dListBody">

                    
                    </div>

                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#v-list").dataTable();
                
            });

           

            $(document).ready(function() {

                $("#addV").click(function() {
                    $('#formAddV').modal('show');
                    $('#modTitle').text("Add New Vehicle");
                    $('#btnVupdate').hide();
                    $('#btnVsave').show();

                });
            });

            function vehicle_d(v) {

                $.ajax({
                    url: "/all-drivers",
                    type: 'post',
                    success: function(data) {
                        $('#formAddD').modal('show');
                        console.log(data.drivers);
                        

                    },
                    error: function(data) {
                        console.log(data);
                        $('#mainDiv').text('An error occurred');
                    }
                });


            }

            
            function delete_v(vid) {

                alertify.confirm('Confirm Action', 'Are you sure you want to change the status of Vehicle id ' + vid + ' ?', function() {
                    delete_confirm(vid);
                }, function() {

                });
            }

            function delete_confirm(vid) {

                $.ajax({
                    url: "/delete-v",
                    type: 'POST',
                    data: {
                        'v_id': vid,
                    },
                    dataType: "json",
                    success: function(data) {

                        getV();
                        $("#v-list").dataTable();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(data.status);
                        console.log(data.status);
                    },
                    error: function(data) {
                        console.log(data.item);
                        getV();
                        $("#v-list").dataTable();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error(data.status);
                    }
                });

            }

            function getV() {
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

            function update_v() {

                var formData = {
                    'vid': $('#vid').val(),
                    'v_number': $('#vNum').val(),
                    'v_model': $('#vModel').val(),
                    'v_brand': $('#vBrand').val(),
                    'v_type': $('#vType').val(),
                };

                var errorData = [];

                if (formData.v_type.length == 0 || formData.v_number.length == 0 || formData.v_model == 0 || formData.v_brand.length == 0) {

                    errorData.push("All fields must be filled")

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(errorData[0]);

                } else {

                    $.ajax({
                        url: "/update-v",
                        type: 'POST',
                        data: formData,
                        dataType: "json",
                        success: function(data) {


                            $('#formAddV').modal('hide');
                            getV();
                            $("#v-list").dataTable();
                            $("#addV_form")[0].reset()

                            // var response = JSON.parse(data); 
                            console.log(data.status);
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(data.status);
                        },
                        error: function(data) {

                            $('#formAddV').modal('hide');
                            $("#v-list").dataTable();
                            // var response = JSON.parse(data); 
                            console.log(data.status);
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.error(data.status);
                        }
                    });
                }

            }

            function edit_v(vid) {

                $.ajax({
                    url: "/get-v",
                    type: 'POST',
                    data: {
                        'vid': vid,
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response.vehicles);

                        //    var myobj = JSON.parse(response);
                        ve = response.vehicles[0];
                        $('#vid').val(ve.v_id),
                            $('#vType').val(ve.vm_id),
                            $('#vNum').val(ve.v_number),
                            $('#vModel').val(ve.v_model),
                            $('#vBrand').val(ve.v_brand)


                        $('#modTitle').text("Update vehicle");
                        $('#formAddV').modal('show');
                        $('#btnVsave').hide();
                        $('#btnVupdate').show();

                    },
                    error: function(response) {

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error(data.status);
                    }

                });
            }

            function save_v() {

                var formData = {
                    'vid': $('#vid').val(),
                    'v_number': $('#vNum').val(),
                    'v_model': $('#vModel').val(),
                    'v_brand': $('#vBrand').val(),
                    'v_type': $('#vType').val(),
                };


                var errorData = [];

                if (formData.v_type.length == 0 || formData.v_number.length == 0 || formData.v_model == 0 || formData.v_brand.length == 0) {

                    errorData.push("All fields must be filled")

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(errorData[0]);

                } else {

                    $.ajax({
                        url: "/save-v",
                        type: 'POST',
                        data: formData,
                        dataType: "json",
                        success: function(data) {


                            $('#formAddV').modal('hide');
                            getV();
                            $("#v-list").dataTable();
                            $("#addV_form")[0].reset()

                            // var response = JSON.parse(data); 
                            console.log(data.status);
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(data.status);
                        },
                        error: function(data) {

                            $('#formAddV').modal('hide');
                            $("#v-list").dataTable();
                            // var response = JSON.parse(data); 
                            console.log(data.status);
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.error(data.status);
                        }
                    });
                }

            }
        </script>