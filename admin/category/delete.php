<?php
include "../../src/connection.php";

$id     = $_GET["id"];
$sql    = "DELETE FROM category WHERE id_category = '$id' ";
$delete = mysqli_query($connection, $sql);

echo "
    <script>
        alert('Data deleted successfully!');
        window.location.replace('../bookCategory.php');
    </script>
";