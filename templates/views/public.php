<!-- <?php
	if(isset($_SESSION['role'])){
		echo json($_SESSION);
	}	
?> -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= BASE_URL ?>css/trongate.css">
	<link rel="stylesheet" href="<?= BASE_URL ?>css/app.css">
	<!-- don't change anything above here -->
	<!-- add your own stylesheet below here -->
	<title>Public</title>
</head>

<body>
	<div class="wrapper">
	<?php 
	if($view_file != 'sign_in') {
	?>
		<header>
			<div id="header-sm">
				<div id="hamburger" onclick="openSlideNav()">
					&#9776;
				</div>
				<div class="logo">
				<!--	<?= anchor(BASE_URL, WEBSITE_NAME)?> 	-->
				<?= WEBSITE_NAME ?>
				</div>
				<div>
					<?php 
            echo anchor('account', '<i class="fa fa-user"></i>', array('onclick'=>"alert('coming soon as God willing!'); return false;")); 
            echo anchor('persons/logout', '<i class="fa fa-sign-out"></i>'); 
            ?>
				</div>
			</div>
			<div id="header-lg">
				<div class="logo">
				<!--	<?= anchor(BASE_URL, WEBSITE_NAME) ?> -->
					<?= WEBSITE_NAME ?>
				</div>
				<div>
					<ul id="top-nav">
						<li><a href="<?= BASE_URL ?>persons"><i class="fa fa-home"></i> Home</a></li>
						<?php
						if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ 
							?>
						<li><a href="<?= BASE_URL ?>persons/create"><i class="fa fa-lightbulb-o"></i> Add a record</a></li>
						<?php }?>
						<li><a href="<?= BASE_URL ?>persons/search"><i class="fa fa-street-view"></i> Search a
								record</a></li>
								<?php
						if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ 
							?>
						<li><a href="<?= BASE_URL ?>persons/add_a_person"><i class="fa fa-gears"></i> Add a Person</a></li>
						<?php }?>
						<li><a href="<?= BASE_URL ?>" onclick="alert('coming soon as God willing!'); return false;"><i
									class="fa fa-send"></i> Get In Touch</a></li>
						<li><a href="<?= BASE_URL ?>persons/logout"><i
									class="fa fa-send"></i>Logout</a></li>
									
					</ul>
				</div>
			</div>
		</header>
		<?php
		}
		?>
		<main class="container">
			<?= Template::display($data) ?>
		</main>
	</div>
	<footer>
		<div class="container">
			<!-- it's okay to remove the links and content here - everything is cool (DC) -->
			<div>&copy; Copyright
				<?= date('Y').' '.OUR_NAME ?>
			</div>
			<div>
				<?= anchor('https://trongate.io', 'Powered by Trongate') ?>
			</div>
		</div>
	</footer>
	<div id="slide-nav">
		<div id="close-btn" onclick="closeSlideNav()">&times;</div>
		<ul auto-populate="true"></ul>
	</div>
	<script src="<?= BASE_URL  ?>js/app.js"></script>
</body>

</html>
