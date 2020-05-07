<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php
        $DeleteFromURL=$_GET['id'];
        $sql="DELETE FROM about  WHERE id='$DeleteFromURL'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION["SuccessMessage"]= "Bio deleted successfully";
            redirect_to("about.php");
        } else {
            $_SESSION["ErrorMessage"]= "Something went wrong";
            redirect_to("about.php");
        }
?>