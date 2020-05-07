<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php require_once'include/db.php'; ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_POST["submit"])){
	$Category=$conn->real_escape_string($_POST["category"]);
	$Description=$conn->real_escape_string($_POST["description"]);

			date_default_timezone_set("Africa/Nairobi");
			$currentTime=time();
			$DateTime=strftime("%B-%d-%Y %H:%M:%S",$currentTime);

$Admin=$_SESSION["Username"];

	if(empty($Category)||empty($Description)){
		$_SESSION["ErrorMessage"]="All fields must be filled out";
		redirect_to("categories.php");
	}elseif(strlen($Category)>99){
		$_SESSION["ErrorMessage"]="Category name too long";
		redirect_to("categories.php");
	}elseif(strlen($Description)>150){
		$_SESSION["ErrorMessage"]="Description is too long";
		redirect_to("categories.php");
	}else{
		//inserting the data into the database
		$sql="INSERT INTO category (datetime,name,description,creatorname) VALUES ('$DateTime','$Category','$Description','$Admin')";
		if(mysqli_query($conn,$sql)){
			$_SESSION["SuccessMessage"]= "New category created successfully";
			redirect_to("categories.php");
		}else{
			$_SESSION["ErrorMessage"]= "Something went wrong";
			redirect_to("categories.php");
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
			<p>Add Categories Here...</p>
		</header>
		
		<span> 
			<?php 
				echo Message();
				echo SuccessMessage();
			?>
		</span>
        <section>
            <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" >
                <div class="row gtr-uniform">
                    <div class="col-6 col-12-xsmall">
                        <input type="text" name="category" id="category" value="" placeholder="Enter Category Name" />
                    </div>
                    <div class="col-12">
                        <textarea name="description" id="description" placeholder="Describe the category here..." rows="6"></textarea>
                    </div>
                    <div class="col-12">
                        <ul class="actions">
                            <li><input type="submit" name="submit" value="Add category" class="primary" /></li>
                            <li><input type="reset" value="Reset" /></li>
                        </ul>
                    </div>
                </div>
            </form>
        </section>	
		<br><br>

<section>
<div class="table-wrapper">
<table>
	<thead>
		<tr>
			<th>No</th>
			<th>Date&Time</th>
			<th>Category Name</th>
			<th>Category Description</th>
			<th>Creator Name</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
		//selecting data from the database
		$query="SELECT * FROM category ORDER BY id desc";
		$result=$conn->query($query);
		$SrNo=0;
		//Using while loop to fetch data from the database
		while($rows=$result->fetch_assoc()){
			$SrNo++;
	?>
		<tr>
			<td><?php echo $SrNo;?></td>
			<td><?php echo $rows["datetime"]; ?></td>
			<td><?php echo $rows["name"]; ?>.</td>
			<td><?php echo $rows["description"]; ?></td>
			<td><?php echo $rows["creatorname"]; ?>.</td>
			<td><a href="DeleteCategory.php?id=<?php echo $rows["id"]; ?>"><span class="button primary">Delete</span></a></td>
		</tr>
	<?php }?>
	</tbody>
</table>
</div>
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

	</body>
</html>