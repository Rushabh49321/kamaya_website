<?php
// edit.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve data from the form
    $originalName = $_POST['original_name'] ?? '';
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';

    // Handle image upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    // Check if file size is too large
    if ($_FILES["image"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        exit();
    }

    // Allow certain file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        exit();
    }

    // Remove the existing image file
    // You might want to modify this based on your file structure
    $existingImage = "uploads/" . $originalName . ".jpg"; // assuming images are named after the product
    if (file_exists($existingImage)) {
        unlink($existingImage);
    }

    // Upload the new image file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // Update the data in the CSV file
        $csvFile = "products.csv";
        $rows = array_map('str_getcsv', file($csvFile));
        $newData = [];

        foreach ($rows as $row) {
            if ($row[0] === $originalName) {
                // Update the row with new data
                $row[0] = $name;
                $row[1] = $description;
                $row[2] = $category; // Update category
                $row[3] = $targetFile; // assuming the image file path is stored in the third column
            }
            $newData[] = $row;
        }

        // Write the updated data back to the CSV file
        $csvHandle = fopen($csvFile, 'w');
        foreach ($newData as $row) {
            fputcsv($csvHandle, $row);
        }
        fclose($csvHandle);

        // Respond with a success message or redirect
        echo "Product updated successfully!";
         header("Location: index.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
