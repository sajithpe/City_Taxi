<div class="container mt-5">

    <div class="d-flex flex-row-reverse bd-highlight">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formAddUser" onclick="" id="addUser">Add new user</button>
    </div>


    <div class="mt-3 table-responsive pt-1 mt-1">
        <table class="table table-bordered table-striped table-hover styled-table" id="users-list">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Contact</th>
                    <th>E-mail</th>
                    <th>Status</th>
                    <th>User Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users) : ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user['uid']; ?></td>
                            <td><?php echo $user['name1']; ?> <?php echo $user['name2']; ?></td>
                            <td><?php echo $user['userName']; ?></td>
                            <td><?php echo $user['contact']; ?></td>
                            <td><?php echo $user['email']; ?></td>

                            <td><?php
                                switch ($user['delStatus']) {
                                    case "n":
                                        echo "Active";
                                        break;
                                    case "y":
                                        echo "In-Active";
                                        break;
                                }
                                ?>
                            </td>
                            <td><?php
                                switch ($user['userType']) {
                                    case "a":
                                        echo "Admin";
                                        break;
                                    case "p":
                                        echo "Passenger";
                                        break;
                                    case "d":
                                        echo "Driver";
                                        break;
                                }
                                ?></td>
                            <td>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="edit_user(<?php echo $user['uid']; ?>)">Edit</button>
                                <?php
                                switch ($user['delStatus']) {
                                    case "n":
                                        echo '<button type="button" class="btn-outline-danger btn-sm" onclick="delete_user(' . $user['uid'] . ');" >Disable</button>';
                                        break;
                                    case "y":
                                        echo '<button type="button" class="btn btn-outline-warning btn-sm" onclick="delete_user(' . $user['uid'] . ');" >Enable</button>';
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

<<div class="modal fade" id="formAddUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">


    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="color: black;">
                <form action="" id="addUser_form">
                    <div class="row g-3 align-items-center py-2">
                        <input type="hidden" id="uid" name="uid" class="form-control">
                        <div class="col-5">
                            <label class="form-label">First Name</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="uname1" name="uname1" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">Last Name</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="uname2" name="uname2" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">Email</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="uemail" name="uemail" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">User Name</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="uuname" name="uuname" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">Address</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="uadd" name="uadd" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">Contact</label>
                        </div>
                        <div class="col-5">
                            <input type="text" id="ucontact" name="ucontact" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">Password</label>
                        </div>
                        <div class="col-5">
                            <input type="password" id="upass" name="upass" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center py-2">
                        <div class="col-5">
                            <label class="form-label">User Type</label>
                        </div>
                        <div class="col-5">
                            <select class="form-select" name="uType" id="uType">
                                <option value="a">Admin</option>
                                <option value="d">Driver</option>
                                <option value="p">Passenger</option>
                            </select>
                        </div>
                    </div>
            </div>



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnUsave" onclick="save_user();">Create User</button>
                <button type="button" class="btn btn-success" id="btnUupdate" onclick="update_user();">Update User</button>
            </div>
            </form>
        </div>
    </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            $("#users-list").dataTable();
        });


        $(document).ready(function() {

            $("#addUser").click(function() {
                $('#formAddUser').modal('show');
                $('#modTitle').text("Add New User");
                $('#btnUupdate').hide();
                $('#btnUsave').show();

            });
        });

        function delete_user(uid) {

            alertify.confirm('Confirm Action', 'Are you sure you want to change the status of user id ' + uid + ' ?', function() {
                delete_confirm(uid);
            }, function() {

            });
        }

        function delete_confirm(uid) {


            $.ajax({
                url: "/delete-user",
                type: 'POST',
                data: {
                    'uid': uid,
                },
                dataType: "json",
                success: function(data) {

                    getUsers();
                    $("#users-list").dataTable();

                    
  
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(data.status);
                },
                error: function(data) {

                    $("#users-list").dataTable();

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(data.status);
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

        function update_user() {

            var formData = {
                'uid': $('#uid').val(),
                'uname1': $('#uname1').val(),
                'uname2': $('#uname2').val(),
                'uemail': $('#uemail').val(),
                'uuname': $('#uuname').val(),
                'uadd': $('#uadd').val(),
                'ucontact': $('#ucontact').val(),
                'upass': $('#upass').val(),
                'uType': $('#uType').val(),

            };

            var errorData = [];

            if (formData.uname1.length == 0 || formData.uname2.length == 0 || formData.uemail.length == 0 ||
                formData.ucontact.length != 10 || formData.uadd.length < 10 || formData.upass.length < 3) {


                errorData.push("All fields must be filled")

                alertify.set('notifier', 'position', 'top-right');
                alertify.error(errorData[0]);

            } else {

                $.ajax({
                    url: "/update-user",
                    type: 'POST',
                    data: formData,
                    dataType: "json",
                    success: function(data) {


                        $('#formAddUser').modal('hide');
                        getUsers();
                        $("#users-list").dataTable();
                        $("#addUser_form")[0].reset()

                        // var response = JSON.parse(data); 
                        console.log(data.status);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(data.status);
                    },
                    error: function(data) {

                        $('#formAddUser').modal('hide');
                        $("#users-list").dataTable();
                        // var response = JSON.parse(data); 
                        console.log(data.status);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error(data.status);
                    }
                });
            }

        }

        function edit_user(uid) {

            var formData = {
                'uid': uid,
            }

            $.ajax({
                url: "/getUser",
                type: 'POST',
                data: {
                    'uid': uid,
                },
                dataType: "json",
                success: function(response) {

                    $.each(response, function(key, udata) {


                        $('#uid').val(udata['uid']),
                            $('#uname1').val(udata['name1']),
                            $('#uname2').val(udata['name2']),
                            $('#uemail').val(udata['email']),
                            $('#uuname').val(udata['userName']),
                            $('#uadd').val(udata['address']),
                            $('#ucontact').val(udata['contact']),
                            $('#upass').val(udata['password']),
                            $('#uType').val(udata['userType'])
                    });
                    $('#modTitle').text("Update User");
                    $('#formAddUser').modal('show');
                    $('#btnUsave').hide();
                    $('#btnUupdate').show();

                },
                error: function(response) {

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(data.status);
                }

            });
        }

        function save_user() {

            var formData = {
                'uname1': $('#uname1').val(),
                'uname2': $('#uname2').val(),
                'uemail': $('#uemail').val(),
                'uuname': $('#uuname').val(),
                'uadd': $('#uadd').val(),
                'ucontact': $('#ucontact').val(),
                'upass': $('#upass').val(),
                'uType': $('#uType').val(),

            };

            var errorData = [];

            if (formData.uname1.length == 0 || formData.uname2.length == 0 || formData.uemail.length == 0 ||
                formData.ucontact.length != 10 || formData.uadd.length < 10 || formData.upass.length < 3) {


                errorData.push("All fields must be filled")

                alertify.set('notifier', 'position', 'top-right');
                alertify.error(errorData[0]);

            } else {

                $.ajax({
                    url: "/save-user",
                    type: 'POST',
                    data: formData,
                    dataType: "json",
                    success: function(data) {


                        $('#formAddUser').modal('hide');
                        getUsers();
                        $("#users-list").dataTable();
                        $("#addUser_form")[0].reset()

                        // var response = JSON.parse(data); 
                        console.log(data.status);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(data.status);
                    },
                    error: function(data) {

                        $('#formAddUser').modal('hide');
                        $("#users-list").dataTable();
                        // var response = JSON.parse(data); 
                        console.log(data.status);
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error(data.status);
                    }
                });
            }

        }
    </script>