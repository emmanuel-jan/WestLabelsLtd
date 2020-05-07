<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php require_once'include/db.php'; ?>
<?php Confirm_Login(); ?>
<?php
//retriving data from the input element and taking the data to the database
if(isset($_POST["submit"])){
//getting the data using the post method
$Title=$conn->real_escape_string($_POST["title"]);
$Category=$conn->real_escape_string($_POST["category"]);
$Post=$conn->real_escape_string($_POST["post"]);

            //setting the timezone
            date_default_timezone_set("Africa/Nairobi");
            //defining a variable which holds the time give by the time() function
            $currentTime=time();
            $DateTime=strftime("%B-%d-%Y %H:%M:%S",$currentTime);//declaring the format of the time given by the currentTime variable

$Admin=$_SESSION["Username"];
//declaring a variable to hold the image file
$Image=$_FILES["image"]["name"];
//specifying the image path to the directory where the image will be stored
$Target="../Upload/".basename($_FILES["image"]["name"]);

        //validation of the title field
        if(empty($Title)||empty($Category)||empty($Post)||empty($Image)){
            $_SESSION["ErrorMessage"]="Title field must be filled out";
            redirect_to("AddNewBlog.php");
        }elseif(strlen($Title)<2){
            $_SESSION["ErrorMessage"]="Title name too short";
            redirect_to("AddNewBlog.php");
        }else{
            //inserting the data into the database
            $sql="INSERT INTO blogpost (datetime,title,category,author,image,post) 
            VALUES ('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
            //moving the file from the users pc to the web app
            //this is done using the move_uploaded_file function
            move_uploaded_file($_FILES["image"]["tmp_name"],$Target);
            if(mysqli_query($conn,$sql)){
                $_SESSION["SuccessMessage"]= "New post created successfully";
                redirect_to("AddNewBlog.php");
            }else{
                $_SESSION["ErrorMessage"]= "Something went wrong";
                redirect_to("AddNewBlog.php");
            }
        }
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Admin</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>

<body class="is-preload">
<!-- Wrapper -->
<div id="wrapper">

<!-- Header -->
<header id="header">
	<div class="inner">

<!-- Logo -->
	<a href="dashboard.php" class="logo">
		<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Westlabels</span>
	</a>

<!-- Nav -->
	<nav>
		<ul>
			<li><a href="#menu">Menu</a></li>
		</ul>
	</nav>

	</div>
</header>

<!-- Menu -->
<nav id="menu">
	<h2>Menu</h2>
	<ul>
	<li><a href="dashboard.php">Dashboard</a></li>
		<li><a href="categories.php">Categories</a></li>
		<li><a href="AddNewBlog.php">Add New Blog</a></li>
		<li><a href="ManageAdmins.php">Manage Admins</a></li>
		<li><a href="messages.php">Messages</a></li>
        <li><a href="about.php">About</a></li>
		<li><a href="../index.php" target="_blank">Live Blog</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>
</nav>

<!-- Main -->
<div id="main">
	<div class="inner">
		<header>
			<h1>West Labels Dashboard</h1>
			<p>Add New Post Here...</p>
		</header>
		<span> 
			<?php 
				echo Message();
				echo SuccessMessage();
			?>
		</span>
			
        <section>
            <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <div class="row gtr-uniform">
                    <div class="col-6 col-12-xsmall">
                        <input type="text" name="title" id="title" value="" placeholder="Enter Post Title" />
                    </div>
                    <div class="col-12">
                        <select name="category" id="category">
                            <option value="">- Select Category -</option>
							<?php 
							//fetching the categories entered in the category table
							//the fetched data is then placed in the option elements
							$query="SELECT * FROM category ORDER BY id desc";
							$result=$conn->query($query);
							while($rows=$result->fetch_assoc()){
								$id=$rows["id"];
								$CategoryName=$rows["name"];
							?>
                            <option><?php echo $CategoryName; ?></option>
                            <?php } ?>
                        </select>
                    </div>
					<div class="col-9 col-12-xsmall">
                        <input type="file" name="image" id="image" value=""  />
                    </div>
                    <div class="col-12">
                        <textarea name="post" id="post" placeholder="Type your post here..." rows="6"></textarea>
                    </div>
                    <div class="col-12">
                        <ul class="actions">
                            <li><input type="submit" name="submit" value="Add Post" class="primary" /></li>
                            <li><input type="reset" value="Reset" /></li>
                        </ul>
                    </div>
                </div>
            </form>
        </section>
	
		
	</div>
</div>

<!-- Footer -->
<footer id="footer">
<div class="inner">	
	<section>
		<h2>Follow</h2>
		<ul class="icons">
			<li><a href="#" class="icon brands style2 fa-twitter"><span class="label">Twitter</span></a></li>
			<li><a href="#" class="icon brands style2 fa-facebook-f"><span class="label">Facebook</span></a></li>
			<li><a href="#" class="icon brands style2 fa-instagram"><span class="label">Instagram</span></a></li>
			<li><a href="#" class="icon solid style2 fa-phone"><span class="label">Phone</span></a></li>
			<li><a href="#" class="icon solid style2 fa-envelope"><span class="label">Email</span></a></li>
		</ul>
	</section>
	<ul class="copyright">
		<li>&copy; Jan Technologies 2020. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
	</ul>
</div>
</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="ckeditor/ckeditor.js"></script>
            <script>
            CKEDITOR.replace('post');
            </script>

	</body>
</html>