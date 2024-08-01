<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="users"></div>

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
                        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users mr-2"></i>USERS</h1>
                        <!-- <a href="users-deleted.php" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-trash fa-sm"></i> Archived Users</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div class="card-header py-3 d-flex flex-column flex-md-row">
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
                                        <h6 class="font-weight-bold text-danger mb-0">LIST OF USERS</h6>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
                                        <div class="col-12 col-md-4 float-right mx-0 px-0">
                                            <a data-toggle="modal" data-target="#addNew" class="btn btn-success shadow-sm w-100 h-100"><i class="fa-solid fa-plus mr-1"></i>ADD USER</a>
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
                                                    <th scope="col">Name</th>                                               
                                                    <th scope="col">Username</th>                                               
                                                    <th scope="col">Designation</th>                                             
                                                    <th scope="col">Role</th>                                           
                                                    <th scope="col">Action</th>                             
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php

                                                    require '../db/dbconn.php';
                                                    $display_users = "SELECT * FROM `user_tbl` WHERE deleted = 0";
                                                    $sqlQuery = mysqli_query($con, $display_users) or die(mysqli_error($con));

                                                    $counter = 1;

                                                    while($row = mysqli_fetch_array($sqlQuery)){
                                                        $user_id = $row['user_id'];
                                                        $username = $row['username'];
                                                        $first_name = $row['first_name'];
                                                        $mid_name = $row['middle_name'];
                                                        $last_name = $row['last_name'];

                                                        $suffix_name = $row['suffix_name'];
                                                        if ($suffix_name == 'NA') {
                                                            $suffix = '';
                                                        }else{
                                                            $suffix = $suffix_name;
                                                        }

                                                        $designation = $row['designation'];
                                                        $role = $row['role'];

                                                        $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' ' . $suffix;
                                                ?>
                                                <tr>         
                                                    <td class=""><?php echo $counter; ?></td>
                                                    <td class=""><?php echo $full_name; ?></td>
                                                    <td class=""><?php echo $username; ?></td>
                                                    <td class=""><?php echo $designation; ?></td>
                                                    <td class=""><?php echo $role; ?></td>       
                                                    <td class="text-center">
                                                        <a class="btn btn-sm shadow-sm btn-primary" data-toggle="modal" data-target="#view_<?php echo $user_id; ?>"><i class="fa-solid fa-eye"></i></a>
                                                        <!-- <a href="#" class="btn btn-sm btn-danger delete-student-btn"
                                                           data-user-id="<?php echo $user_id; ?>" 
                                                           data-user-name="<?php echo htmlspecialchars($full_name); ?>"
                                                           data-user-no="<?php echo htmlspecialchars($student_no); ?>"
                                                           data-user-course="<?php echo htmlspecialchars($course); ?>">
                                                           <i class="fa-solid fa-trash"></i>
                                                        </a> -->
                                                    </td>
                                                </tr>
                                                <?php
                                                    $counter++;
                                                    // include('modal/student_view_edit_modal.php');
                                                } 
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <!-- Decline Students Account Registration -->
    <script>
        $(document).ready(function() {
            // Function for deleting event
            $('.delete-student-btn').on('click', function(e) {
                e.preventDefault();
                var declineButton = $(this);
                var userId = declineButton.data('user-id');
                var userName = decodeURIComponent(declineButton.data('user-name'));
                var userNo = decodeURIComponent(declineButton.data('user-no'));
                var userCourse = decodeURIComponent(declineButton.data('user-course'));
                Swal.fire({
                    title: 'Delete Student Account',
                    html: "You are about to delete the following student:<br><br>" +
                          "<strong>Name:</strong> " + userName + "<br>" +
                          "<strong>Student No.:</strong> " + userNo + "<br>" +
                          "<strong>Course:</strong> " + userCourse + "<br>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/delete_student.php', // Corrected 'file' to 'url'
                            type: 'POST',
                            data: {
                                user_id: userId
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Student has been deleted.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete student.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete student.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>