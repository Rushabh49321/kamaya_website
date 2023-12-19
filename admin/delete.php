<?php
// Retrieve product name from query parameter
$name = $_GET['name'] ?? '';

// Perform deletion (assuming you have a products.csv file)
if (($handle = fopen("products.csv", "r+")) !== false) {
    $newData = [];

    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        // Exclude the product with the specified name
        if ($data[0] !== $name) {
            $newData[] = $data;
        } else {
            // Delete the associated image file
            $imagePath = $data[3];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }

    // Rewind and truncate the file
    ftruncate($handle, 0);
    rewind($handle);

    // Write the new data back to the file
    foreach ($newData as $data) {
        fputcsv($handle, $data);
    }

    fclose($handle);

    // Redirect to the main page after deletion
    header("Location: index.php");
    exit();
}
?>
