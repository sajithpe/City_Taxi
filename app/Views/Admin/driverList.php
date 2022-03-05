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