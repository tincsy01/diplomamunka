<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TenderTours-Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="js/scripts/get_workers.js"></script>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <?php
    require 'menu.php';
    ?>
    <!-- Content Wrapper -->
    < <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <?php
            require 'navbar.php';
            ?>


            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Workers</h1>

                <div class="row">

                    <div class="col-lg-10">

                        <!-- Circle Buttons -->
                        <div class="card shadow mb-6">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">List of workers</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <button type="button" class="btn btn-success" id="newWorker">Add new worker</button>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Active</th>
                                            <th>Phone</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Active</th>
                                            <th>Phone</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="newWorkerModal" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Worker</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="newWorkerForm">
<!--                                        <div class="form-group">-->
<!--                                            <label for="name">Name</label>-->
<!--                                            <input type="text" class="form-control" id="name" name="name" required>-->
<!--                                        </div>-->
<!--                                        <div class="form-group">-->
<!--                                            <label for="username">Username</label>-->
<!--                                            <input type="text" class="form-control" id="username" name="username" required>-->
<!--                                        </div>-->
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
<!--                                        <div class="form-group">-->
<!--                                            <label for="password">Password</label>-->
<!--                                            <input type="password" class="form-control" id="password" name="password" required>-->
<!--                                        </div>-->
<!--                                        <div class="form-group">-->
<!--                                            <label for="address">Address</label>-->
<!--                                            <input type="text" class="form-control" id="address" name="address" required>-->
<!--                                        </div>-->
<!--                                        <div class="form-group">-->
<!--                                            <label for="phone">Phone</label>-->
<!--                                            <input type="text" class="form-control" id="phone" name="phone" required>-->
<!--                                        </div>-->
<!--                                        <div class="form-group">-->
<!--                                            <label for="phone">Working at</label>-->
<!--                                            <select name="working" id="working">-->
<!--                                                <option value=""></option>-->
<!--                                            </select>-->
<!--                                        </div>-->
                                        <!-- További mezők a város hozzáadásához -->
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" id="addWorkerBtn" class="btn btn-primary">Send Mail</button>
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="modal fade" id="updateCityModal" tabindex="-1" role="dialog" aria-labelledby="updateCityModalLabel" aria-hidden="true">-->
<!--                        <div class="modal-dialog" role="document">-->
<!--                            <div class="modal-content">-->
<!--                                <div class="modal-header">-->
<!--                                    <h5 class="modal-title" id="updateCityModalLabel">Update City</h5>-->
<!--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                                        <span aria-hidden="true">&times;</span>-->
<!--                                    </button>-->
<!--                                </div>-->
<!--                                <div class="modal-body">-->
<!--                                    <form id="updateCityForm">-->
<!--                                        <input type="hidden" id="updateCityId" name="cityId">-->
<!--                                        <div class="form-group">-->
<!--                                            <label for="updateCityName">City Name</label>-->
<!--                                            <input type="text" class="form-control" id="updateCityName" name="cityName" required>-->
<!--                                        </div>-->
<!--                                        <div class="form-group">-->
<!--                                            <label for="longitude">Longitude</label>-->
<!--                                            <input type="text" class="form-control" id="updateLongitude" name="longitude" required>-->
<!--                                        </div>-->
<!--                                        <div class="form-group">-->
<!--                                            <label for="lattitude">Lattitude</label>-->
<!--                                            <input type="text" class="form-control" id="updateLattitude" name="lattitude" required>-->
<!--                                        </div>-->
<!--                                    </form>-->
<!--                                </div>-->
<!--                                <div class="modal-footer">-->
<!--                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                                    <button type="button" id="updateCityBtn" class="btn btn-primary">Update City</button>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="modal fade" id="deleteCityModal" tabindex="-1" role="dialog" aria-labelledby="deleteCityModalLabel" aria-hidden="true">-->
<!--                        <div class="modal-dialog" role="document">-->
<!--                            <div class="modal-content">-->
<!--                                <div class="modal-header">-->
<!--                                    <h5 class="modal-title" id="deleteCityModalLabel">Delete City</h5>-->
<!--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                                        <span aria-hidden="true">&times;</span>-->
<!--                                    </button>-->
<!--                                </div>-->
<!--                                <div class="modal-body">-->
<!--                                    Are you sure you want to delete the city <span id="cityNameToDelete"></span>?-->
<!--                                </div>-->
<!--                                <div class="modal-footer">-->
<!--                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>-->
<!--                                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <!--<script src="vendor/chart.js/Chart.min.js"></script>-->

        <!-- Page level custom scripts -->
        <!--<script src="js/demo/chart-area-demo.js"></script>-->
        <!--<script src="js/demo/chart-pie-demo.js"></script>-->
        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>
</body>

</html>
