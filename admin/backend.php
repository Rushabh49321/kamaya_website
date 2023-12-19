<?php
// File path for CSV
$csvFilePath = 'products.csv';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $name = $_POST["name"];
    $description = $_POST["description"];
    $category = $_POST["category"];

    // Handle file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // If everything is ok, try to upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
            $imagePath = $targetFile;

            // Append product to CSV file
            $csvData = "$name,$description,\"$category\",$imagePath\n";
            file_put_contents($csvFilePath, $csvData, FILE_APPEND | LOCK_EX);

            echo "Product added successfully";
            header("Location: index.php");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>