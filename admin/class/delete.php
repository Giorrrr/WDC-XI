<?php
include "../../src/connection.php";

$id = $_GET["id"];
$sql = "DELETE FROM class WHERE id = '$id' ";
$delete = mysqli_query($connection, $sql);

echo "
    <script>
        alert('Data deleted successfully!');
        window.location.replace('../class.php');
    </script>
";