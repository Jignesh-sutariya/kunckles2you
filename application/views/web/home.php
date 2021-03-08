<?php defined('BASEPATH') OR exit('No direct script access allowed');
$rest = $this->main->get('restaurant', 'name, sub_title, address, contact_no, email_id, facebook, instagram', ['id' => 1]) ?>
<div id="slides" class="cover-slides">
	<ul class="slides-container">
		<?php foreach ($banners as $banner): ?>
		<li class="text-left">
			<?= img(['src' => $banner['banner']]) ?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1><strong><?= $rest['name'] ?><br> <?= $rest['sub_title'] ?></strong></h1>
					</div>
					<div class="col-md-12">
						<div class="search-box">
							<input type="text" id="search-food" name="search" placeholder="search your favourite food">
						</div>
					</div>
					<div class="col-md-12 text-center">
						<div class="order-btn">
							<button type="button" class="btn btn-info btn-lg order-btn1" data-toggle="modal" data-target="#orderNow">Order Now</button>
							<button type="button" class="btn btn-info btn-lg order-btn2" data-toggle="modal" data-target="#preOrder">Pre order</button>
						</div>
					</div>
				</div>
			</div>
		</li>
		<?php endforeach ?>
	</ul>
	<div class="slides-navigation">
		<a href="javascript:;" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
		<a href="javascript:;" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
	</div>
</div>
<div class="about-section-box">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 text-center">
				<div class="inner-column">
					<h1>About us</h1>
					<h4>Little Story</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque auctor suscipit feugiat. Ut at pellentesque ante, sed convallis arcu. Nullam facilisis, eros in eleifend luctus, odio ante sodales augue, eget lacinia lectus erat et sem. </p>
					<p>Sed semper orci sit amet porta placerat. Etiam quis finibus eros. Sed aliquam metus lorem, a pellentesque tellus pretium a. Nulla placerat elit in justo vestibulum, et maximus sem pulvinar.</p>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<img src="<?= base_url('assets/web/images/about-img.jpg') ?>" alt="" class="img-fluid">
			</div>
		</div>
	</div>
</div>
<div class="menu-box">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="heading-title text-left">
					<h2>Our Menu</h2>
					<p><a href="<?= base_url('menu') ?>" class="btn">See All dishes &nbsp &nbsp<i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
				</div>
			</div>
		</div>
		<div class="row inner-menu-box">
			<div class="col-3">
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<!-- <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">All</a> -->
					<?php foreach ($cats as $k => $cat): ?>
					<a class="nav-link <?= ($k === 0) ? 'active' : '' ?>" id="v-pills-<?= $cat['name'] ?>-tab" data-toggle="pill" href="#v-pills-<?= $cat['name'] ?>" role="tab" aria-controls="v-pills-<?= $cat['name'] ?>" aria-selected="false"><?= ucwords($cat['name']) ?></a>
					<?php endforeach ?>
				</div>
			</div>
			<div class="col-9">
				<div class="tab-content" id="v-pills-tabContent">
					<!-- <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
							<div class="row">
							<?php foreach ($cats as $cat): ?>
							<?php foreach ($cat['menu'] as $allMenu):  ?>
							<div class="col-lg-4 col-md-6 special-grid drinks">
								<div class="gallery-single fix">
									<?= img(['src' => $allMenu['image'], 'class' => "img-fluid"]) ?>
									<div class="why-text">
										<h4><?= $allMenu['title'] ?></h4>
										<p><?= $allMenu['details'] ?></p>
										<div class="price"><h5> $<?= $allMenu['price'] ?></h5><i class="fa fa-plus-circle" aria-hidden="true"style="color:#d65106"></i></div>
									</div>
								</div>
							</div>
							<?php endforeach ?>
							<?php endforeach ?>
						</div>
					</div> -->
					<?php foreach ($cats as $k => $cat): ?>
					<div class="tab-pane fade <?= ($k === 0) ? 'show active' : '' ?>" id="v-pills-<?= $cat['name'] ?>" role="tabpanel" aria-labelledby="v-pills-<?= $cat['name'] ?>-tab">
						<div class="row">
							<?php foreach ($cat['menu'] as $allMenu):  ?>
							<div class="col-lg-4 col-md-6 special-grid drinks">
								<div class="gallery-single fix">
									<?= img(['src' => $allMenu['image'], 'class' => "img-fluid"]) ?>
									<div class="why-text">
										<h4><?= $allMenu['title'] ?></h4>
										<p><?= $allMenu['details'] ?></p>
										<div class="price"><h5> $<?= $allMenu['price'] ?></h5><i class="fa fa-plus-circle" aria-hidden="true"style="color:#d65106"></i></div>
									</div>
								</div>
							</div>
							<?php endforeach ?>
						</div>
					</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="gallery-box">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="heading-title text-rigt">
					<h2>Gallery</h2>
					<p><a href="<?= base_url('gallery') ?>" class="btn">See All photos &nbsp &nbsp<i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
				</div>
			</div>
		</div>
		<div class="tz-gallery">
			<div class="row">
				<?php foreach ($gallery as $g): ?>
				<div class="col-sm-12 col-md-3 col-lg-3">
					<a class="lightbox" href="<?= base_url($g['image']) ?>">
						<?= img(['src' => $g['image'], 'class' => "img-fluid"]) ?>
					</a>
				</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="orderNow" role="dialog">
	<div class="modal-dialog text-center">
		<!-- Modal content-->
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
</div>
<div class="modal fade" id="preOrder" role="dialog">
	<div class="modal-dialog text-center">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">pre order</h2>
			</div>
			<div class="modal-body" onload=addoption_list1();>
				<form name="drop_list" action="" method="POST" >
					<div class="date-m">
						<p>Date</p>
						<select  NAME="dt_list">
							<option value="" >Date</option>
						</select>
						<select  NAME="Month_list">
							<option value="" >Month</option>
						</select>
						<select  NAME="year_list">
							<option value="" >Year</option>
						</select>
					</div>
					<div class="time-m">
						<p>Time</p>
						<select  NAME="tm_list">
							<option value="" >6:30</option>
						</select>
						<select  NAME="Month_list">
							<option value="" >am</option>
							<option value="" >pm</option>
						</select>
					</div>
				</form>
				<p>You can pick your order from</p>
				<textarea placeholder="Address 2" rows="5"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>