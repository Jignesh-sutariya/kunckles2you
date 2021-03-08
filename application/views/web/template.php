<?php defined('BASEPATH') OR exit('No direct script access allowed');
$rest = $this->main->get('restaurant', 'name, sub_title, address, contact_no, email_id, facebook, instagram', ['id' => 1]) ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Site Metas -->
		<title><?= APP_NAME.' | '.ucfirst($title) ?></title>
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Site Icons -->
		<?= link_tag('images/favicon.png', 'shortcut icon', 'image/x-icon') ?>
		<?= link_tag('images/favicon.png', 'apple-touch-icon') ?>
		<!-- Bootstrap CSS -->
		<?= link_tag('assets/web/css/bootstrap.min.css', 'stylesheet') ?>
		<!-- Site CSS -->
		<?= link_tag('assets/web/css/style.css', 'stylesheet') ?>
		<!-- Pickadate CSS -->
		<?= link_tag('assets/web/css/classic.css', 'stylesheet') ?>
		<?= link_tag('assets/web/css/classic.date.css', 'stylesheet') ?>
		<?= link_tag('assets/web/css/classic.time.css', 'stylesheet') ?>
		<!-- Responsive CSS -->
		<?= link_tag('assets/web/css/responsive.css', 'stylesheet') ?>
		<!-- Custom CSS -->
		<?= link_tag('assets/web/css/custom.css', 'stylesheet') ?>
	</head>
	<body>
		
		<header class="top-navbar">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container">
					<a class="navbar-brand main-logo" href="<?= base_url() ?>">
						<img src="<?= base_url('images/logo.png') ?>" alt="" />
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbars-rs-food">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item <?= ($name === 'home') ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
							<li class="nav-item <?= ($name === 'menu') ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('menu') ?>">Menu</a></li>
							<li class="nav-item <?= ($name === 'about') ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('about') ?>">About</a></li>
							<li class="nav-item <?= ($name === 'gallery') ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('gallery') ?>">Gallery</a></li>
							<li class="nav-item <?= ($name === 'contact') ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('contact') ?>">Contact</a></li>
							<li class="nav-item">
								<button type="button" class="btn nav-link" data-toggle="modal" data-target="#orderNow">Order Online</button>
							</li>
							<li class="nav-item">
								<a class="nav-link">
								<img src="<?= base_url('images/cart.png') ?>" width="30px"></a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<?= $contents ?>
		<footer class="footer-area bg-f">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="f-soc-con">
							<ul class="list-inline f-social">
								<li><a href="javascript:;"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
								<li><h3><?= $rest['contact_no'] ?></h3></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="f-soc-con">
							<ul class="list-inline f-social">
								<li><a href="javascript:;"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
								<li><h3><?= $rest['email_id'] ?></h3></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="f-soc-con">
							<ul class="list-inline f-social">
								<li><a href="javascript:;"><i class="fa fa-map-marker"></i></a></li>
								<li><h3><?= $rest['address'] ?></h3></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="logo-box">
							<div class="insta-icon">
								<a href="<?= $rest['instagram'] ?>" target="_blank" title="Instagram">
									<img src="<?= base_url('images/instagram.png') ?>">
								</a>
							</div>
							<div class="fb-icon">
								<a href="<?= $rest['facebook'] ?>" target="_blank" title="Facebook">
									<img src="<?= base_url('images/fb.png') ?>">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="foter-nav">
					<div class="nav-bar text-center">
						<ul>
							<li><a href="<?= base_url() ?>">home</a></li>
							<li><a href="<?= base_url('menu') ?>">menu</a></li>
							<li><a href="<?= base_url('about') ?>">about</a></li>
							<li><a href="<?= base_url('gallery') ?>">gallery</a></li>
							<li><a href="<?= base_url('contact') ?>">contact us</a></li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<p class="company-name">All Rights Reserved. &copy; 2021 <a>Knuckles2you Food Truck</a> Design By :
							<a href="https://densetek.com">Densetek Infotech</a></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer -->
		<a id="back-to-top" title="Back to top" style="display: none;"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></a>
		<!-- ALL JS FILES -->
		<script src="<?= base_url('assets/web/js/jquery-3.2.1.min.js') ?>"></script>
		<script src="<?= base_url('assets/web/js/popper.min.js') ?>"></script>
		<script src="<?= base_url('assets/web/js/bootstrap.min.js') ?>"></script>
		<!-- ALL PLUGINS -->
		<script src="<?= base_url('assets/web/js/jquery.superslides.min.js') ?>"></script>
		<script src="<?= base_url('assets/web/js/images-loded.min.js') ?>"></script>
		<script src="<?= base_url('assets/web/js/isotope.min.js') ?>"></script>
		<script src="<?= base_url('assets/web/js/baguetteBox.min.js') ?>"></script>
		<script src="<?= base_url('assets/web/js/form-validator.min.js') ?>"></script>
		<script src="<?= base_url('assets/web/js/contact-form-script.js') ?>"></script>
		<script src="<?= base_url('assets/web/js/picker.js') ?>"></script>
		<script src="<?= base_url('assets/web/js/picker.date.js') ?>"></script>
		<script src="<?= base_url('assets/web/js/picker.time.js') ?>"></script>
		<script src="<?= base_url('assets/web/js/custom.js') ?>"></script>
	</body>
</html>
<!-- <div class="modal fade" id="orderNow" role="dialog">
					<div class="modal-dialog text-center">
											<div class="modal-content">
																	<div class="modal-header">
																							<h2 class="modal-title">Order Now</h2>
																	</div>
																	<div class="modal-body">
																							<p>You can pick your order from</p>
																							<textarea placeholder="Address 2" rows="5" ></textarea>
																	</div>
																	<div class="modal-footer">
																							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																	</div>
											</div>
					</div>
</div> -->