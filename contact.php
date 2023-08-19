<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>Bagan Manado - Contact Page</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="assets/css/templatemo-style.css" rel="stylesheet" />
</head>
<!--

Simple House

https://templatemo.com/tm-539-simple-house

-->

<body>

	<div class="container">
		<!-- Top box -->
		<!-- Logo & Site Name -->
		<div class="placeholder">
			<div class="parallax-window" data-parallax="scroll" data-image-src="assets/img/bgr.jpg">
				<div class="tm-header">
					<div class="row tm-header-inner">
						<div class="col-md-6 col-12">
							<img src="assets/img/simple-b-logo.png" alt="Logo" class="tm-site-logo" />
							<div class="tm-site-text-box">
								<h1 class="tm-site-title">Bagan Manado</h1>
								<hr>
								<h6 class="tm-site-description">Alat Penangkapan Ikan</h6>
							</div>
						</div>
						<nav class="col-md-6 col-12 tm-nav">
							<ul class="tm-nav-ul">
								<li class="tm-nav-li"><a href="index.php" class="tm-nav-link">Home</a></li>
								<li class="tm-nav-li"><a href="about.php" class="tm-nav-link">About</a></li>
								<li class="tm-nav-li"><a href="contact.php" class="tm-nav-link active">Contact</a></li>
								<li class="tm-nav-li"><a href="login.php" class="tm-nav-link">Login</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Contact Page</h2>
			</header>

			<div class="tm-container-inner-2 tm-contact-section">
				<div class="row">
					<div class="col-md-6">
						<form action="" method="POST" class="tm-contact-form">
							<div class="form-group">
								<input type="text" name="name" class="form-control" placeholder="Name" required="" />
							</div>

							<div class="form-group">
								<input type="email" name="email" class="form-control" placeholder="Email" required="" />
							</div>

							<div class="form-group">
								<textarea rows="5" name="message" class="form-control" placeholder="Message" required=""></textarea>
							</div>

							<div class="form-group tm-d-flex">
								<button type="submit" class="tm-btn tm-btn-success tm-btn-right">
									Send
								</button>
							</div>
						</form>
					</div>
					<div class="col-md-6">
						<div class="tm-address-box">
							<h4 class="tm-info-title tm-text-success">Our Address</h4>
							<address>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque enim odio, aliquet feugiat posuere vitae, lacinia eu felis.
							</address>
							<a href="tel:080-090-0110" class="tm-contact-link">
								<i class="fas fa-phone tm-contact-icon"></i>08x-xxx-xxxx
							</a><br>
							<a href="mailto:info@company.co" class="tm-contact-link">
								<i class="fas fa-envelope tm-contact-icon"></i>xxxx@xxxx.xxx
							</a>
							<div class="tm-contact-social">
								<a href="https://fb.com/templatemo" class="tm-social-link"><i class="fab fa-facebook tm-social-icon"></i></a>
								<a href="#" class="tm-social-link"><i class="fab fa-twitter tm-social-icon"></i></a>
								<a href="#" class="tm-social-link"><i class="fab fa-instagram tm-social-icon"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- How to change your own map point
	1. Go to Google Maps
	2. Click on your location point
	3. Click "Share" and choose "Embed map" tab
	4. Copy only URL and paste it within the src="" field below
-->
			<div class="tm-container-inner-2 tm-map-section">
				<h2 class="col-12 text-center tm-section-title"><b>Tempat Penjualan Hasil Tangkapan </b></h2>
				<div class="row">
					<div class="col-12">
						<div class="tm-map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.408517920781!2d124.8392206145547!3d1.5231861614187958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32879f95e60fab83%3A0x8ca9d4fb4628e991!2sTempat%20Pelelangan%20Ikan%20Tumumpa!5e0!3m2!1sen!2sid!4v1623726966288!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/parallax.min.js"></script>
	<script>
		$(document).ready(function() {
			var acc = document.getElementsByClassName("accordion");
			var i;

			for (i = 0; i < acc.length; i++) {
				acc[i].addEventListener("click", function() {
					this.classList.toggle("active");
					var panel = this.nextElementSibling;
					if (panel.style.maxHeight) {
						panel.style.maxHeight = null;
					} else {
						panel.style.maxHeight = panel.scrollHeight + "px";
					}
				});
			}
		});
	</script>
</body>

</html>