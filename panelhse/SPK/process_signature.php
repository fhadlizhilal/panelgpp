<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $signatureImage = $_POST['signatureImage'];

    // Decode the base64 encoded image
    list($type, $data) = explode(';', $signatureImage);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    // Set the file path to save the image
    $filePath = 'signatures/' . uniqid() . '.png';

    // Save the image
    file_put_contents($filePath, $data);

    echo "Name: " . $name . "<br>";
    echo "Signature saved at: <a href='$filePath'>$filePath</a>";
}
?>