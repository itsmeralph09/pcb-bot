<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="polls"></div>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include './include/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include './include/topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-square-poll-vertical mr-2"></i>POLLS</h1>
                        <!-- <a href="users-deleted.php" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-trash fa-sm"></i> Archived Users</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div class="card-header py-3 d-flex flex-column flex-md-row">
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
                                        <h6 class="font-weight-bold text-danger mb-0">LIST OF POLLS</h6>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
                                        <div class="col-12 col-md-4 float-right mx-0 px-0">
                                            <a data-toggle="modal" data-target="#addNew" class="btn btn-success shadow-sm w-100 h-100"><i class="fa-solid fa-plus mr-1"></i>ADD POLL</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered nowrap" id="myTable" width="100%" cellspacing="0">
                                            <thead class="">
                                                <tr>
                                                  
                                                    <th scope="col">#</th>                                        
                                                    <th scope="col">Title</th>                                               
                                                    <th scope="col">Description</th>                                  
                                                    <th scope="col">Participants</th>                                       
                                                    <th scope="col">Status</th>                                              
                                                    <th scope="col">Action</th>                            
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php

                                                    require '../db/dbconn.php';
                                                    $display_users = "SELECT * FROM `poll_tbl` WHERE deleted = 0";
                                                    $sqlQuery = mysqli_query($con, $display_users) or die(mysqli_error($con));

                                                    $counter = 1;

                                                    while($row = mysqli_fetch_array($sqlQuery)){
                                                        $poll_id = $row['poll_id'];
                                                        $poll_title = $row['poll_title'];
                                                        $poll_description = $row['poll_description'];
                                                        $poll_status = $row['poll_status'];

                                                        if ($poll_status == "CLOSED") {
                                                            $status_text = "<span class='text-danger'>CLOSED</span>";
                                                        }elseif ($poll_status == "OPEN") {
                                                            $status_text = "<span class='text-success'>OPEN</span>";
                                                        }

                                                        if ($poll_status == "CLOSED") {
                                                            $status_button = "<a class='btn btn-sm btn-success start-poll-btn shadow-sm'
                                                                                data-toggle='tooltip' data-placement='right' title='Open ".$poll_title."'
                                                                                data-poll-id=".$poll_id."
                                                                                data-poll-name=".htmlspecialchars($poll_title)."
                                                                                data-poll-description=".htmlspecialchars($poll_description)."><i class='fa-solid fa-play'></i>
                                                                              </a>";
                                                        } elseif ($poll_status == "OPEN") {
                                                            $status_button = "<a class='btn btn-sm btn-secondary stop-poll-btn shadow-sm'
                                                                                data-toggle='tooltip' data-placement='right' title='Close ".$poll_title."'
                                                                                data-poll-id=".$poll_id."
                                                                                data-poll-name=".htmlspecialchars($poll_title)."
                                                                                data-poll-description=".htmlspecialchars($poll_description)."><i class='fa-solid fa-stop'></i>
                                                                              </a>";
                                                        }

                                                ?>
                                                <tr>         
                                                    <td class=""><?php echo $counter; ?></td>
                                                    <td class=""><?php echo $poll_title; ?></td>
                                                    <td class=""><?php echo $poll_description; ?></td>
                                                    <td class=""><?php ?></td>
                                                    <td class=""><?php echo $status_text; ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm shadow-sm btn-primary" data-toggle="modal" data-target="#edit_<?php echo $poll_id; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        <?= $status_button ?>
                                                        <a href="#" class="btn btn-sm btn-danger delete-poll-btn"
                                                           data-user-id="<?php echo $poll_id; ?>" 
                                                           data-user-title="<?php echo htmlspecialchars($poll_title); ?>"
                                                           data-user-description="<?php echo htmlspecialchars($poll_description); ?>"
                                                           data-user-status="<?php echo htmlspecialchars($poll_status); ?>"
                                                           >
                                                           <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $counter++;
                                                    // include('modal/user_edit_modal.php');
                                                } 
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php // include('modal/user_add_modal.php'); ?>
                    </div>
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include './include/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include './include/logout_modal.php'; ?>

    <?php include './include/script.php'; ?>

    <script>
        $(document).ready(function(){
            //inialize datatable
            $('#myTable').DataTable({
                scrollX: true
            })
        });
    </script>

    <!-- Delete User Account -->
    <script>
        $(document).ready(function() {
            // Function for deleting event
            $('.delete-poll-btn').on('click', function(e) {
                e.preventDefault();
                var deleteButton = $(this);
                var pollID = deleteButton.data('user-id');
                var pollTitle = decodeURIComponent(deleteButton.data('user-title'));
                var pollDescription = decodeURIComponent(deleteButton.data('user-description'));
                var pollStatus = decodeURIComponent(deleteButton.data('user-status'));
                Swal.fire({
                    title: 'Delete Poll',
                    html: "You are about to delete the following poll:<br><br>" +
                          "<strong>Title:</strong> " + pollTitle + "<br>" +
                          "<strong>Description:</strong> " + pollDescription + "<br>" +
                          "<strong>Status:</strong> " + pollStatus + "<br>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/delete_poll.php',
                            type: 'POST',
                            data: {
                                poll_id: pollID
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Poll has been deleted.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete poll.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete poll.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
    <!-- Add User Account-->
    <script>
        $(document).ready(function() {
            // Function to show SweetAlert2 warning message
            const showWarningMessage = (message) => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: message
                });
            };

            // Function to check if username or email already exists
            const checkExistingUser = (formData) => {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: 'action/check_user_exists.php', // URL to check the database
                        type: 'POST',
                        data: formData.serialize(), // Serialize form data
                        success: function(response) {
                            if (response.exists) {
                                // Highlight the corresponding input fields with red border
                                if (response.exists.username && response.exists.email) {
                                    showWarningMessage('Username and Email already exists.');
                                    formData.find('input[name="username"]').addClass('input-error');
                                    formData.find('input[name="email"]').addClass('input-error');
                                } else if (response.exists.username) {
                                    showWarningMessage('Username already exists.');
                                    formData.find('input[name="username"]').addClass('input-error');
                                } else if (response.exists.email) {
                                    showWarningMessage('Email already exists.');
                                    formData.find('input[name="email"]').addClass('input-error');
                                }
                                reject(); // Reject the promise if department already exists
                            } else {
                                resolve(); // Resolve the promise if department doesn't exist
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); // Output error response to console (for debugging)
                            reject(); // Reject the promise if there's an error
                        }
                    });
                });
            };

            $('#addUser').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = $('#addNew form'); // Select the form element

                const requiredFields = formData.find('[required], select');
                let fieldsAreValid = true; // Initialize as false

                // Remove existing error classes
                $('.form-control').removeClass('input-error');

                requiredFields.each(function() {
                    // Check if the element is a select and it doesn't have a selected value
                    if ($(this).is('select') && $(this).val() === null) {
                        fieldsAreValid = false; // Set to false if any required select field doesn't have a value
                        showWarningMessage('Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    }
                    // Check if the element is empty
                    else if ($(this).val().trim() === '') {
                        fieldsAreValid = false; // Set to false if any required field is empty
                        showWarningMessage('Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    } else {
                        $(this).removeClass('is-invalid'); // Remove red border if field is filled
                    }
                });

                let passwordsAreValid = true; // Initialize as true
                const password = formData.find('input[name="password"]').val();
                const confirmPassword = formData.find('input[name="confirm_password"]').val();

                if (fieldsAreValid) {
                    if (password !== confirmPassword) {
                        passwordsAreValid = false;
                        showWarningMessage("Passwords don't match. Please check and try again.");
                        formData.find('input[name="confirm_password"]').addClass('is-invalid'); // Add red border to confirm password field
                    } else {
                        formData.find('input[name="confirm_password"]').removeClass('is-invalid'); // Remove red border if passwords match
                    }
                }

                if (fieldsAreValid && passwordsAreValid) {
                    checkExistingUser(formData).then(() => {
                        // If username or email doesn't exist, proceed with form submission
                        $.ajax({
                            url: 'action/add_user.php', // URL to submit the form data
                            type: 'POST',
                            data: formData.serialize(), // Serialize form data
                            success: function(response) {
                                // Handle the success response
                                console.log(response); // Output response to console (for debugging)
                                if (response === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'User added successfully!',
                                        showConfirmButton: true, // Show OK button
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed to add user!',
                                        text: 'Please try again later.',
                                        showConfirmButton: true,
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        location.reload();
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                // Handle the error response
                                console.error(xhr.responseText); // Output error response to console (for debugging)
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to add user',
                                    text: 'Please try again later.',
                                    showConfirmButton: true, // Show OK button
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                     }).catch(() => {
                        // If user exists, do nothing (error message already shown)
                    });
                }
            });
        });
    </script>
    <!-- Update User Account -->
    <script>
        $(document).ready(function() {
            // Function to show SweetAlert2 messages
            const showSweetAlert = (icon, title, message) => {
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: message
                });
            };

            // Delegate click event handling to a parent element
            $(document).on('click', '[id^="updateUser_"]', function(e) {
                e.preventDefault(); // Prevent default form submission
                var userID = $(this).attr('id').split('_')[1]; // Extract event ID
                var formData = $('#updateForm_' + userID); // Get the form data
                var modalDiv = $('#edit_' + userID);

                let fieldsAreValid = true; // Initialize as true
                // const requiredFields = formData.find('[required]'); // Select required fields
                const requiredFields = modalDiv.find(':input[required]'); // Select required fields

                // Remove existing error classes
                $('.form-control').removeClass('input-error');

                requiredFields.each(function() {
                    // Check if the element is a select and it doesn't have a selected value
                    if ($(this).is('select') && $(this).val() === null) {
                        fieldsAreValid = false; // Set to false if any required select field doesn't have a value
                        showSweetAlert('warning', 'Oops!', 'Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    }
                    // Check if the element is empty
                    else if ($(this).val().trim() === '') {
                        fieldsAreValid = false; // Set to false if any required field is empty or null
                        showSweetAlert('warning', 'Oops!', 'Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    } else {
                        $(this).removeClass('is-invalid'); // Remove red border if field is filled
                    }
                });

                let passwordsAreValid = true; // Initialize as true
                const password = modalDiv.find('input[name="password"]').val();
                const confirmPassword = modalDiv.find('input[name="confirm_password"]').val();

                if (fieldsAreValid && password !== '') {
                    if (password !== confirmPassword) {
                        passwordsAreValid = false;
                        showSweetAlert('warning','Oops!',"Passwords don't match. Please check and try again.");
                        modalDiv.find('input[name="confirm_password"]').addClass('is-invalid'); // Add red border to confirm password field
                    } else {
                        modalDiv.find('input[name="confirm_password"]').removeClass('is-invalid'); // Remove red border if passwords match
                    }
                }
                
                if (fieldsAreValid && passwordsAreValid) {
                    // Perform check for crop name existence
                    $.ajax({
                        url: 'action/check_user_existence.php', // URL to check if UID and email exist
                        type: 'POST',
                        data: formData.serialize(), // Form data to be checked
                        dataType: 'json', // Specify JSON data type for response
                        success: function(response) {
                            // Remove existing error classes
                            $('.form-control').removeClass('input-error');

                            if (response.exists.username && response.exists.email) {
                                showSweetAlert('error', 'Oops!', 'Username and Email already exists.');
                                modalDiv.find('input[name="username"]').addClass('input-error');
                                modalDiv.find('input[name="email"]').addClass('input-error');
                            }else if (response.exists.username) {
                                showSweetAlert('error', 'Oops!', 'Username already exists.');
                                modalDiv.find('input[name="username"]').addClass('input-error');
                            } else if (response.exists.email) {
                                showSweetAlert('error', 'Oops!', 'Email already exists.');
                                modalDiv.find('input[name="email"]').addClass('input-error');
                            } else {
                                // If Garden Code and Garden Name do not exist, proceed with updating
                                $.ajax({
                                    url: 'action/update_user.php', // URL to submit the form data
                                    type: 'POST',
                                    data: formData.serialize(), // Form data to be submitted
                                    dataType: 'json',
                                    success: function(response) {
                                        // Handle the success response
                                        console.log(response); // Output response to console (for debugging)
                                        if (response.status === 'success') {
                                            Swal.fire(
                                                'Success!',
                                                response.message,
                                                'success'
                                            ).then(() => {
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire(
                                                'Error!',
                                                response.message,
                                                'error'
                                            );
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        // Handle the error response
                                        console.error(xhr.responseText); // Output error response to console (for debugging)
                                        showSweetAlert('error', 'Error', 'Failed to update user. Please try again later.');
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle the error response for existence check
                            console.error(xhr.responseText); // Output error response to console (for debugging)
                            showSweetAlert('error', 'Error', 'Failed to check Username and Email existence. Please try again later.');
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>