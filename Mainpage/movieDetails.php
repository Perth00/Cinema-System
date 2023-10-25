<!DOCTYPE HTML>
<html lang="zxx">
<?php 
session_start();
include "../Register/classes/signClass.php";
include "../Register/classes/signControl.php";
$signup = new Signup("localhost", "email", "password", "cinema");
$mailErr = "";
$pwErr = "";
$errorMsg = "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$fname = "";
$lname = "";
$phoneNo = "";
$gender ="";

	if(isset($_POST["login"]))
	{

		$reg = new signCtrl($fname, $lname, $phoneNo, $email, $password);
		$mailErr = $reg->Errorm();
		$pwErr = $reg->Errorpw();
		if( empty($mailErr) AND empty($pwErr))
		{
			$errorMsg=$signup->login($email, $password);
		}
	}
	if (isset($_POST["logout"])) {
		header("location:movies.php");
		session_destroy();
	}
	
	if(isset($_POST["buy"]))
	{
		$movieID = empty($_POST["movieID"]) ? "" : $_POST["movieID"];
		$_SESSION["movieID"] = $movieID;
		header("Location: showtime.php");
	
	}

	include "../Database/database.php";
	$Login= new Login("localhost","user","password","cinema");

	$movieID=empty($_SESSION["movieID"])?"":$_SESSION["movieID"];


	$movie1=$Login->getMovieDetail($movieID);
	

?>	

<head>

		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Favicon Icon -->
		<link rel="icon" type="image/png" href="assets/img/favcion.png" />
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="all" />
		<!-- Slick nav CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/slicknav.min.css" media="all" />
		<!-- Iconfont CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/icofont.css" media="all" />
		<!-- Owl carousel CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
		<!-- Popup CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/magnific-popup.css">
		<!-- Main style CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="all" />
		<!-- Responsive CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="all" />

	</head>
	<body>
		<!-- Page loader -->
	    <div id="preloader"></div>
		<!-- header section start -->
		<header class="header">
			<div class="container">
				<div class="header-area">
					<div class="logo">
						<a href="index-2.php"><img src="assets/img/logo.png" alt="logo" /></a>
					</div>
					<div class="header-right">
						<form action="index-2.php" method="POST">
							<select name="searchTitle">
								<option value="Movies">Movies</option>
								<option value="Director">Director</option>
								<option value="Starring">Starring</option>
								<option value="Genre">Genre</option>
								<option value="package">package</option>
								<option value="language">language</option>
							</select>
							<input type="text" name="searchDetail" value="">
							<button name="search"><i class="icofont icofont-search"></i></button>
						</form>
						<form action="movieDetails.php" method="POST" style="border-color:transparent; margin-left:15px;">
						<ul>
							<?php
							$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
							$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
							if($username=="")
							{
							?>
							<li><a href="#">Welcome Guest!</a></li>
							<li><a class="login-popup" href="#">Login</a></li>
							<?php 
							}
							else
							{?>
							<li><a href="../User/profile.php"><?php echo $username?></a></li>
							<li><button class="logout" name="logout" style="border-color:transparent; background-color:transparent; color:white;">Log out</button></li>
							<?php }?>
						</ul>
						</form>
					</div>


					<div class="menu-area">
						<div class="responsive-menu"></div>
					    <div class="mainmenu">
                            <ul id="primary-menu">
                                <li><a class="active" href="index-2.php">Home</a></li>
                                <li><a  href="movies.php">Movies</a></li>
                                <li><a href="../Package Details/Package.php"  target="_blank">Package Detail</a></li>								
                            </ul>
					    </div>
					</div>
				</div>
			</div>
		</header>
		
		<div class="login-area">
			<div class="login-box">
				<a href="#"><i class="icofont icofont-close"></i></a>
				<form action="index-2.php" method="POST">
				<h2>LOGIN</h2>
				<div class="login-remember" style="float:right">
						<span style="font-size:10px;"><a href="../adminLogin/admin_login.php" style=" color: blue;">Admin Login</a></span>
				</div><br>
				<form action="#">
				<?php 
				if ($errorMsg == "") {
								// If the error is empty, this row does not appear
				
				} else {
								// If the error is not empty, display the error message
				?>	
				<div class="loginfor"><span style="font-size:10px; color:red; margin-bottom:0px;"><?php echo $errorMsg?></span></div>
				<?php }?>	

					<h6>EMAIL</h6>
					<input type="text" name="email"style=" margin-bottom:0px; color:black;" required>
					<?php
			   if ($mailErr == "") {
				   // If the error is empty, this row does not appear
   
			   } else {?>
					<div class="loginfor"><span style="font-size:10px; color:red;"><?php echo $mailErr?></span></div>
			   <?php }
			   ?>
					<h6>PASSWORD</h6>
					<input type="text" name="password" required style=" margin-bottom:0px; color:black;">
					<?php
			   if ($pwErr == "") {
				   // If the error is empty, this row does not appear
   
			   } else {?>
					<div class="loginfor"><span style="font-size:10px; color:red;"><?php echo $pwErr?></span></div>
			   <?php }?>
					<div class="login-remember" >
						<span><a href="../forgot/forgot.php" style=" color: blue;">Forget Password</a></span>
					</div>
					<div class="login-signup">
						<span><a href="../Register/index.php" style=" color: blue;">SIGNUP</a></span>
					</div>
					<button name="login" class="theme-btn">LOG IN</button>
					</form>				
			</div>
		</div>

<!-- header section end -->



		<!-- breadcrumb area start -->
		<section class="breadcrumb-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumb-area-content">
							<h1>Movie Detalied Page</h1>
						</div>
					</div>
				</div>
			</div>
		</section><!-- breadcrumb area end -->

	
		<!-- transformers area start -->
		<section class="transformers-area">
			

			<div class="container">
				
				<div class="transformers-box">
					<div class="row flexbox-center">
						<div class="col-lg-5 text-lg-left text-center">
							<div class="transformers-content">
							<img src="../Mainpage/assets/img/Movie/<?php echo $movie1['image']; ?>" alt="about" />
							</div>
						</div>
						<div class="col-lg-7">
							<div class="transformers-content">
								<h2><?php echo $movie1['movieName']; ?></h2>
								<p><?php echo $movie1['package']; ?></p>
								<ul>

									<li>
										<div class="transformers-left">
										Director:
										</div>
										<div class="transformers-right">
										<?php echo $movie1['Director']; ?>										
									</div>
									</li>
									<li>
										<div class="transformers-left">
										Starring: 
										</div>
										<div class="transformers-right">
										<?php echo $movie1['Starring']; ?>										
									</div>
									</li>
									<li>
										<div class="transformers-left">
										Released:
										</div>
										<div class="transformers-right">
										<?php echo $movie1['Date']; ?>										
									</div>
									</li>
									<li>
										<div class="transformers-left">
											Running Time: 
										</div>
										<div class="transformers-right">
										<?php echo $movie1['RunningTime']; ?>										
									</div>
									</li>
									<li>
										<div class="transformers-left">
										Genre:
										</div>
										<div class="transformers-right">
										<?php echo $movie1['Genre']; ?>										
									</div>
									</li>
									<li>
										<div class="transformers-left">
										status:
										</div>
										<div class="transformers-right">
										<?php echo $movie1['status']; ?>										
									</div>
									</li>
									<li>
										<div class="transformers-left">
										Fee:
										</div>
										<div class="transformers-right">
										<?php echo $movie1['Fee']; ?>										
									</div>
									</li>
									<li>
										<div class="transformers-left">
											Language:
										</div>
										<div class="transformers-right">
										<?php echo $movie1['language']; ?>										
									</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<form action="movieDetails.php" method="POST">
					<input type="hidden" name="movieID" value="<?php echo $movie1["movieID"]; ?>">
					<button name="buy" class="theme-btn"><i class="icofont icofont-ticket"></i> BUY TICKET</button>
			   		</form>
				</div>
				<?php ?>
			</div>
		</section><!-- transformers area end -->
		<!-- details area start -->
		<section class="details-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-9">
						<div class="details-content">
							<div class="details-overview">
								<h2>Overview</h2>
								<p><?php echo $movie1['Synopsis']; ?></p>
							</div>
						</div>
					</div>

					<div class="col-lg-3 text-center text-lg-left">
					    <div class="portfolio-sidebar">
							<img src="assets/img/Movie/ryan.jpg" alt="sidebar" />
							<img src="assets/img/Movie/zheqian,ryan,zhiyun.jpg" alt="sidebar" />
							<img src="assets/img/Movie/zhiyun.jpg" alt="sidebar" />
						</div>
					</div>
				</div>
			</div>
		</section><!-- details area end -->



		<!-- footer section start -->
		<footer class="footer" style="display: flex; justify-content: center; align-items: center;">
			<div class="container">
				<div class="row">
                    <div class="col-lg-3 col-sm-6" >
						<div class="widget">
							<img src="assets/img/logo.png" alt="about" />
							<p>Sunway College Diploma in Information Technology</p>
							<h6><span>Call us: </span>(+60) 111 222 3456</h6>
						</div>
                    </div>
				</div>
				<hr />
			</div>	
		</footer><!-- footer section end -->
		<!-- jquery main JS -->
		<script src="assets/js/jquery.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- Slick nav JS -->
		<script src="assets/js/jquery.slicknav.min.js"></script>
		<!-- owl carousel JS -->
		<script src="assets/js/owl.carousel.min.js"></script>
		<!-- Popup JS -->
		<script src="assets/js/jquery.magnific-popup.min.js"></script>
		<!-- Isotope JS -->
		<script src="assets/js/isotope.pkgd.min.js"></script>
		<!-- main JS -->
		<script src="assets/js/main.js"></script>
	</body>

</html>