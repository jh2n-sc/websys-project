<?php
require_once __DIR__ . '/db_conn.php';
if (isset($_GET['listing_id'])) {
    $sql = "SELECT property_photo FROM listings WHERE listing_id=?";
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $_GET['listing_id']);
    $statement->execute() or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_connect_error());
    $result = $statement->get_result();

    $row = $result->fetch_assoc();
    header("Content-type: " . $row[".jpg"]);
    echo $row["property_photo"];
}
?>