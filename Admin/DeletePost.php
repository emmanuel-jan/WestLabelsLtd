<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php
        $DeleteFromURL=$_GET['Delete'];
        $sql="DELETE FROM blogpost  WHERE id='$DeleteFromURL'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["SuccessMessage"]= "Post deleted successfully";
            redirect_to("dashboard.php");
        } else {
            $_SESSION["ErrorMessage"]= "Something went wrong";
            redirect_to("dashboard.php");
        }
?>