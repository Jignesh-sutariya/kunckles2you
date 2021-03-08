<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="all-page-title page-breadcrumb">
	<div class="container text-center">
		<div class="row">
			<div class="col-lg-12">
				<h1>Gallery</h1>
			</div>
		</div>
	</div>
</div>
<div class="gallery-box">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="heading-title text-center">
					<h2>Gallery</h2>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
				</div>
			</div>
		</div>
		<div class="tz-gallery">
			<div class="row">
				<?php foreach ($gallery as $v): ?>
				<div class="col-sm-12 col-md-3 col-lg-3">
					<a class="lightbox" href="<?= base_url($v['image']) ?>">
						<img class="img-fluid" src="<?= base_url($v['image']) ?>" alt="Gallery Images">
					</a>
				</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>