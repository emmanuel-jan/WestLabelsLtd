<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php require_once'include/db.php'; ?>
<?php Confirm_Login(); ?>
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
			<p>View Your Blogs Here...</p>
		</header>	

	<span> 
		<?php 
			echo Message();
			echo SuccessMessage();
		?>
	</span>
<section>
<div class="table-wrapper">
<table>
	<thead>
		<tr>
			<th>No</th>
			<th>Post Title</th>
			<th>Date&Time</th>
			<th>Author</th>
			<th>Category</th>
			<th>Banner</th>
			<th>Actions</th>
			<th>Details<th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$query="SELECT * FROM blogpost ORDER BY id desc";
	$result=$conn->query($query);
	$SrNo=0;
	while($rows=$result->fetch_assoc()){
		$Id=$rows["id"];
		$Datetime=$rows["datetime"];
		$Title=$rows["title"];
		$Category=$rows["category"];
		$Admin=$rows["author"];
		$Image=$rows["image"];
		$Post=$rows["post"];
		$SrNo++;
	?>
		<tr>
			<td><?php echo $SrNo;?></td>
			<td><?php echo $Title;?></td>
			<td><?php echo $Datetime;?></td>
			<td><?php echo $Admin;?></td>
			<td><?php echo $Category;?></td>
			<td><img class="																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																										" src="../Upload/<?php echo $Image;?>" width="80px" height="65px"></td>
			<td>
				<a href="EditPost.php?Edit=<?php echo $Id;?>"class="button small">Edit</a>
				<a href="DeletePost.php?Delete=<?php echo $Id;?>" class="button primary small">Delete</a>
			</td>
			<td>
			<a href="../index.php" target="_blank" class="button small">Live Preview</a>
			</td>
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