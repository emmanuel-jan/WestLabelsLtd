<?php require_once'include/db.php'; ?>
<?php require_once'include/Sessions.php'; ?>
<?php require_once'include/Functions.php'; ?>
<?php
		if(isset($_POST["submit"])){
			$Name=$conn->real_escape_string($_POST["name"]);
			$Email=$conn->real_escape_string($_POST["email"]);
			$Message=$conn->real_escape_string($_POST["message"]);
			//setting the timezone
			date_default_timezone_set("Africa/Nairobi");
			//declaring a variable to hold the current date
			$CurrentTime=time();
			$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
			//validating the entries
			if(empty($Name)||empty($Email)||empty($Message)){
				$_SESSION["ErrorMessage"]="All Fields are required";
			}else{
				$sql="INSERT INTO message (datetime,name,email,message) VALUES 
				('$DateTime','$Name','$Email','$Message')";
				if(mysqli_query($conn,$sql)){
					$_SESSION["SuccessMessage"]="Message sent successfully";
					
				}else{
					$_SESSION["ErrorMessage"]="Something went wrong";
					
				}
			}
		}
	?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Westlabels</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
<body class="is-preload">

<!-- Wrapper -->
<div id="wrapper" class="divided">

<!-- One -->
<section class="banner style1 orient-left content-align-left image-position-right fullscreen onload-image-fade-in onload-content-fade-right">
	<div class="content">
		<h1>Westlabels</h1>
		<p class="major">The Label 
		<span class="txt-type" data-wait="3000" data-words='[" With The Golden Touch."]'></span>
		</p>
		<i><strong><span>	
			<?php 
			//These are session messages
				echo Message();
				echo SuccessMessage();
				?>
		</span></strong></i>
	</div>
	<div class="image">
		<img src="images/logo1.jpg" alt="" />
	</div>
</section>

	<!-- Bio -->
	<section class="wrapper style1 align-center">
	<div class="inner">
		<h2>Who Are We?</h2>
		<?php
		$query="SELECT * FROM about ORDER BY id desc";
		$result=$conn->query($query);
		$rows=$result->fetch_assoc();
		$Bio=$rows["bio"];
		?>
			<p><?php echo $Bio; ?></p>

		<div class="items style1 medium onscroll-fade-in">
		<?php
		$query="SELECT * FROM category ORDER BY id desc LIMIT 0,6";
		$result=$conn->query($query);
		while($rows=$result->fetch_assoc()){
			$PostId=$rows["id"];
			$CategoryName=$rows["name"];
			$Description=$rows["description"];
		?>
			<section>
				<span class="icon solid style2 major fa-check-double"></span>
				<h3><?php echo $CategoryName; ?></h3>
				<p><?php echo $Description; ?></p>
			</section>
		<?php } ?>	
		</div>
	</div>
</section>

<section align="center">
<header>
<br>
	<h2>We Also Have Updates For You!</h2>
</header>
</section>

<!-- Three -->
<?php
//fetching data from the database
$SrNo=0;
    $query="SELECT * FROM blogpost ORDER BY id desc LIMIT 0,10";
    $result=$conn->query($query);
    while($rows=$result->fetch_assoc()){
        $PostId=$rows["id"];
        $DateTime=$rows["datetime"];
        $Title=$rows["title"];
        $Category=$rows["category"];
        $Admin=$rows["author"];
        $Image=$rows["image"];
		$Post=$rows["post"];
		$SrNo++;
		if($SrNo%2==0){
    ?>
<section class="spotlight style1 orient-left content-align-left image-position-center onscroll-image-fade-in">
	<div class="content">
		<h2><?php echo $Title; ?></h2>
		<h5><i>Category:<strong><?php echo $Category;?></strong> Published On:<strong><?php echo $DateTime;?></strong></i></h5>
		<p><?php echo $Post; ?></p>
	</div>
	<div class="image">
		<img src="Upload/<?php echo $Image; ?>" alt="" />
	</div>
</section>
		<?php }else{?>
<section class="spotlight style1 orient-right content-align-left image-position-center onscroll-image-fade-in">
	<div class="content">
		<h2><?php echo $Title; ?></h2>
		<h5><i>Category:<strong><?php echo $Category;?></strong> Published On:<strong><?php echo $DateTime;?></strong></i></h5>
		<p><?php echo $Post; ?></p>
	</div>
	<div class="image">
		<img src="Upload/<?php echo $Image; ?>" alt="" />
	</div>
</section>

<?php }}?>


<!-- Five -->
<section class="wrapper style1 align-center">
	<div class="inner">
		<h2>On To Our Gallery.</h2>
	</div>

	<!-- Gallery -->
		<div class="gallery style2 medium lightbox onscroll-fade-in">
		<?php
			$query="SELECT * FROM blogpost ORDER BY id desc";
			$result=$conn->query($query);
			while($rows=$result->fetch_assoc()){
				$PostId=$rows["id"];
				$DateTime=$rows["datetime"];
				$Title=$rows["title"];
				$Category=$rows["category"];
				$Image=$rows["image"];
			
      	?>
			<article>
				<a href="Upload/<?php echo $Image; ?>" class="image">
					<img src="Upload/<?php echo $Image; ?>" alt="" width="323px" height="388px"/>
				</a>
				<div class="caption">
					<h3><?php echo $Title; ?></h3>
					<p><?php echo $Category; ?>.</p>
				</div>
			</article>
			<?php } ?>
		</div>

</section>



<!-- Seven -->
<section class="wrapper style1 align-center">
	<div class="inner medium">
		<h2>Get in touch</h2>
		<form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
			<div class="fields">
				<div class="field half">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" value="" />
				</div>
				<div class="field half">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" value="" />
				</div>
				<div class="field">
					<label for="message">Message</label>
					<textarea name="message" id="message" rows="6"></textarea>
				</div>
			</div>
			<ul class="actions special">
				<li><input type="submit" name="submit" id="submit" value="Send Message" /></li>
			</ul>
		</form>
	</div>
</section>

<!-- Footer -->
<footer class="wrapper style1 align-center">
	<div class="inner">
		<ul class="icons">
			<li><a href="#" class="icon brands style2 fa-twitter"><span class="label">Twitter</span></a></li>
			<li><a href="#" class="icon brands style2 fa-facebook-f"><span class="label">Facebook</span></a></li>
			<li><a href="#" class="icon brands style2 fa-instagram"><span class="label">Instagram</span></a></li>
			<li><a href="#" class="icon style2 fa-envelope"><span class="label">Email</span></a></li>
		</ul>
		<p>&copy; Jan-Tech 2020.</p>
	</div>
</footer>

</div>

		<!-- Scripts -->
		    <script src="assets/js/typewriter.js"></script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
