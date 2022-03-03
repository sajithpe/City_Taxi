<div class="container mt-5">

    <div class="d-flex flex-row-reverse bd-highlight">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formAddType" onclick="" id="addVtype">Add new type</button>
    </div>


    <div class="mt-3 table-responsive pt-1 mt-1">
        <table class="table table-bordered table-striped table-hover styled-table" id="vType-list">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Vehicle Type</th>
                    <th>Rate per KM</th>
                    <th>Fuel Type</th>
                    <th>Driver Pay</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($types) : ?>
                    <?php foreach ($types as $type) : ?>
                        <tr>
                            <td><?php echo $type['vm_id']; ?></td>
                            <td><?php echo $type['v_type']; ?></td>
                            <td><?php echo $type['cost_km']; ?></td>
                            <td><?php 

                                switch ($type['fuel_type']) {
                                    case "p":
                                        echo "Petrol";
                                        break;
                                    case "d":
                                        echo "Diesel";
                                        break;
                                    case "e":
                                        echo "Electric";
                                        break;                         
                                    }
                            ?>
                            </td>
                            <td><?php echo $type['driver_pay']; ?></td>

                            <td><?php
                                switch ($type['delStatus']) {
                                    case "n":
                                        echo "Active";
                                        break;
                                    case "y":
                                        echo "In-Active";
                                        break;
                                }
                                ?>
                            </td>

                            <td>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="edit_type(<?php echo $type['vm_id']; ?>)">Edit</button>
                                <?php
                                switch ($type['delStatus']) {
                                    case "n":
                                        echo '<button type="button" class="btn-outline-danger btn-sm" onclick="delete_type(' . $type['vm_id'] . ');" >Disable</button>';
                                        break;
                                    case "y":
                                        echo '<button type="button" class="btn btn-outline-warning btn-sm" onclick="delete_type(' . $type['vm_id'] . ');" >Enable</button>';
                                        break;
                                }
                                ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<<div class="modal fade" id="formAddType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="color: black;">
                <form action="" id="addVtype_form">
                    <div class="row g-3 align-items-center py-2">
                        <input type="hidden" id="vmid" name="vmid" class="form-control">
                        <div class="col-5">
                            <label class="form-label">Vehicle Type</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="vType" name="vType" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">Rate per KM</label>
                        </div>
                        <div class="col-5">
                            <input type="number" id="costKM" name="costKM" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">Fuel Type</label>
                        </div>
                        <div class="col-5">
                            <select class="form-select" name="fType" id="fType">
                                <option value=""></option>
                                <option value="p">Petrol</option>
                                <option value="d">Diesel</option>
                                <option value="e">Electronic</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">Driver Pay</label>
                        </div>
                        <div class="col-5">
                            <input type="number" id="dPay" name="dPay" class="form-control">
                        </div>
                    </div>
            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnVTsave" onclick="save_vType();">Create Type</button>
                <button type="button" class="btn btn-success" id="btnVTupdate" onclick="update_vType();">Update Type</button>
            </div>
            </form>
        </div>
    </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            $("#vType-list").dataTable();
        });


        $(document).ready(function() {

            $("#addVtype").click(function() {
                $('#formAddType').modal('show');
                $('#modTitle').text("Add New Vehicle Type");
                $('#btnVTupdate').hide();
                $('#btnVTsave').show();

            });
        });

        function delete_type(vtid) {

            alertify.confirm('Confirm Action', 'Are you sure you want to change the status of Type id ' + vtid + ' ?', function() {
                delete_confirm(vtid);
            }, function() {

            });
        }

        function delete_confirm(vtid) {


            $.ajax({
                url: "/delete-type",
                type: 'POST',
                data: {
                    'vmid': vtid,
                },
                dataType: "json",
                success: function(data) {

                    getVtypes();
                    $("#vType-list").dataTable();

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(data.status);
                },
                error: function(data) {

                    getVtypes();
                    $("#vType-list").dataTable();

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(data.status);
                }
            });

        }

        function getVtypes() {
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

        function update_vType() {

            var formData = {
                'vmid': $('#vmid').val(),
                'v_type': $('#vType').val(),
                'cost_km': $('#costKM').val(),
                'fuel_type': $('#fType').val(),
                'driver_pay': $('#dPay').val(),
            };

            var errorData = [];

            if (formData.v_type.length == 0 || !formData.cost_km > 0 || !formData.driver_pay > 0) {

                errorData.push("All fields must be filled")

                alertify.set('notifier', 'position', 'top-right');
                alertify.error(errorData[0]);

            } else {

                $.ajax({
                    url: "/update-vType",
                    type: 'POST',
                    data: formData,
                    dataType: "json",
                    success: function(data) {


                        $('#formAddType').modal('hide');
                        getVtypes();
                        $("#vType-list").dataTable();
                        $("#addVtype_form")[0].reset()

                        // var response = JSON.parse(data); 
                        console.log(data.status);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(data.status);
                    },
                    error: function(data) {

                        $('#formAddType').modal('hide');
                        $("#vType-list").dataTable();
                        // var response = JSON.parse(data); 
                        console.log(data.status);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error(data.status);
                    }
                });
            }

        }

        function edit_type(vtid) {

            $.ajax({
                url: "/getVtype",
                type: 'POST',
                data: {
                    'vmid': vtid,
                },
                dataType: "json",
                success: function(response) {

                    $.each(response, function(key, vtdata) {

                        $('#vmid').val(vtdata['vm_id']),
                        $('#vType').val(vtdata['v_type']),
                        $('#costKM').val(vtdata['cost_km']),
                        $('#fType').val(vtdata['fuel_type']),
                        $('#dPay').val(vtdata['driver_pay'])
                           
                    });
                    $('#modTitle').text("Update vehicle type");
                    $('#formAddType').modal('show');
                    $('#btnVTsave').hide();
                    $('#btnVTupdate').show();

                },
                error: function(response) {

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(data.status);
                }

            });
        }

        function save_vType() {

            var formData = {
                'vmid': $('#vmid').val(),
                'v_type': $('#vType').val(),
                'cost_km': $('#costKM').val(),
                'fuel_type': $('#fType').val(),
                'driver_pay': $('#dPay').val(),
            };


            var errorData = [];

            if (formData.v_type.length == 0 || !formData.cost_km > 0 || !formData.driver_pay > 0) {

                errorData.push("All fields must be filled")

                alertify.set('notifier', 'position', 'top-right');
                alertify.error(errorData[0]);

            } else {

                $.ajax({
                    url: "/save-vtype",
                    type: 'POST',
                    data: formData,
                    dataType: "json",
                    success: function(data) {


                        $('#formAddType').modal('hide');
                        getVtypes();
                        $("#vType-list").dataTable();
                        $("#addVtype_form")[0].reset()

                        // var response = JSON.parse(data); 
                        console.log(data.status);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(data.status);
                    },
                    error: function(data) {

                        $('#formAddType').modal('hide');
                        $("#vType-list").dataTable();
                        // var response = JSON.parse(data); 
                        console.log(data.status);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error(data.status);
                    }
                });
            }

        }
    </script>