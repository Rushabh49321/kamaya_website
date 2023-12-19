<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="./assets/images/kamya-white.png" type="image/x-icon">
    <title>Kamya Textile Mills Pvt. Ltd.</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- TemplateMo 546 Sixteen Clothing -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbs5TUBd6TN/uxI6nKEl0OC3WN5PE3e3Qp3zjwF/zxyT2T5CSZMSjA2fFzKXlB7" crossorigin="anonymous">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Quill JavaScript -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.html"><img src="./assets/images/kamya-white.png" class="logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Content -->
    <div class="page-heading admin-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h2>Admin</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Product category</th>
                    <th>Product Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display products from CSV file
                if (($handle = fopen("products.csv", "r")) !== false) {
                    $productId = 1; // Start with an initial product ID
                
                    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                        echo "<tr>";
                        echo "<td>{$productId}</td>";
                        echo "<td>{$data[0]}</td>";
                        echo "<td>{$data[1]}</td>";
                        echo "<td>{$data[2]}</td>";
                        echo "<td><img src='{$data[3]}' alt='{$data[0]}' class='img-thumbnail' width='100'></td>";
                        echo "<td>";
                        echo "<a href='#' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editModal'
                                data-name='{$data[0]}' data-description='{$data[1]}' data-image='{$data[2]}'>
                                Edit
                            </a>&nbsp;";
                        echo "<a href='delete.php?name={$data[0]}' class='btn btn-danger btn-sm'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";

                        $productId++; // Increment product ID for the next product
                    }

                    fclose($handle);
                }
                ?>
            </tbody>
        </table>

    </div>
    <!-- Button trigger modal -->
    <div class="addproduct" style="text-align: right; margin-right:45px ;margin-bottom: 45px;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
            style="background-color:#44536a;">
            +
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="backend.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputEmail4">Name</label>
                            <input type="text" class="form-control" id="inputEmail4" name="name"
                                placeholder="Product Name">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Description</label>
                            <div id="quill-editor" style="height: 200px;"></div>
                            <input type="hidden" name="description" id="inputDescription">
                        </div>
                        <div class="form-group">
                            <label for="Productcategory">Product Category</label>
                            <select id="Productcategory" class="form-control" name="category">
                                <option selected>Choose...</option>
                                <option>Product Fabric</option>
                                <option>Product Ranges</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Product Image</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image"
                                accept="image/*" required>
                        </div>
                        <center><button type="submit" class="btn btn-primary">Add</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Product -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="edit.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="original_name" id="editOriginalName" value="">
                        <div class="form-group">
                            <label for="editName">Name:</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editDescription">Description:</label>
                            <div id="quill-edit-description" style="height: 200px;"></div>
                            <input type="hidden" name="description" id="editInputDescription">
                        </div>
                        <div class="form-group">
                            <label for="editProductcategory">Product Category</label>
                            <select id="editProductcategory" class="form-control" name="category">
                                <option value="Product Fabric">Product Fabric</option>
                                <option value="Product Ranges">Product Ranges</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editImage">Product Image:</label>
                            <input type="file" class="form-control-file" id="editImage" name="image" accept="image/*">
                        </div>
                        <center><button type="submit" class="btn btn-primary">Update Product</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofW8k5D4iFMEa9/sL/p9hJR3uBh/kQ1xV9"
        crossorigin="anonymous"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).on('click', '.btn-warning', function () {
            var name = $(this).data('name');
            var description = $(this).data('description');
            var image = $(this).data('image');

            $('#editOriginalName').val(name);
            $('#editName').val(name);
            $('#editDescription').val(description);
            $('#editImage').val('');

            // Open the edit modal
            $('#editModal').modal('show');
        });
    </script>
    <script>
        $(document).ready(function () {
            // Initialize Quill for the edit description field
            var quillEditDescription = new Quill('#quill-edit-description', {
                theme: 'snow'
            });

            quillEditDescription.on('text-change', function () {
                var htmlContent = quillEditDescription.root.innerHTML;
                $('#editInputDescription').val(htmlContent);
            });
        });
            $(document).ready(function () {

                var quill = new Quill('#quill-editor', {
                    theme: 'snow'
                });

                // Function to update the hidden input field with HTML content
                quill.on('text-change', function () {
                    var htmlContent = quill.root.innerHTML;
                    $('#inputDescription').val(htmlContent);
                });
                // Function to handle the submission of the form
                $("#editForm").submit(function (event) {
                    // Prevent the default form submission
                    event.preventDefault();

                    // Get the data from the form
                    var originalName = $("#editOriginalName").val();
                    var name = $("#editName").val();
                    var description = $("#editDescription").val();
                    var category = $("#editProductcategory").val();
                    var image = $("#editImage")[0].files[0];

                    // Create a FormData object to send the data as multipart/form-data
                    var formData = new FormData();
                    formData.append('original_name', originalName);
                    formData.append('name', name);
                    formData.append('description', description);
                    formData.append('category', category);

                    // Check if the image input has a file
                    if (image) {
                        formData.append('image', image);
                    }

                    // Use AJAX to send the data to edit.php
                    $.ajax({
                        type: 'POST',
                        url: 'edit.php',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            location.reload();
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });
            });

    </script>






    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>
</body>

</html>