<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php
function redirect_to($New_Location){
    header("location:".$New_Location);
    exit;
}
function Login_Attempt($Username,$Password){
<<<<<<< HEAD
    $conn=mysqli_connect("localhost","root","Emaochi99","westlabels");
=======
    $conn=mysqli_connect("us-cdbr-east-06.cleardb.net","b956bb0ee3087a","bc710314","heroku_6ea7b0f1369f42f");
>>>>>>> f46ca14fee6383ab387d48f3f84cc2c8fa6432f9
    $sql="SELECT * FROM registration WHERE username='$Username' AND password='$Password'";
    $result=$conn->query($sql);
    if($admin=mysqli_fetch_assoc($result)){
        return $admin;
    }else{
        return null;
    }
}
function Login(){
    if(isset($_SESSION["User_Id"])){
        return true;
    }
}
function Confirm_Login(){
    if(!Login()){
        $_SESSION["ErrorMessage"]="Login Required";
        redirect_to("login.php");
    }
}
?>
