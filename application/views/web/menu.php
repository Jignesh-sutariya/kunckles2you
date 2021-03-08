<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="food-menu">
	<div class="menu-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-left">
						<h2>Our Menu</h2>
						<p><a href="#" class="btn">See All dishes &nbsp &nbsp<i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
					</div>
				</div>
			</div>
			<div class="row inner-menu-box">
				<div class="col-12">
					<div class="nav flex-row nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<?php foreach ($cats as $k => $v): ?>
						<a class="col-2 mr-2 nav-link <?= ($k === 0) ? 'active' : '' ?>" id="v-pills-<?= $v['name'] ?>-tab" data-toggle="pill" href="#v-pills-<?= $v['name'] ?>" role="tab" aria-controls="v-pills-<?= $v['name'] ?>" aria-selected="false"><?= ucwords($v['name']) ?></a>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="menu-item">
		<div class="tab-content" id="v-pills-tabContent">
			<?php foreach ($cats as $k => $v): ?>
			<div class="tab-pane fade <?= ($k === 0) ? 'show active' : '' ?>" id="v-pills-<?= $v['name'] ?>" role="tabpanel" aria-labelledby="v-pills-<?= $v['name'] ?>-tab">
				<?php foreach ($v['menu'] as $menu): ?>
				<div class="menu-item special-grid">
					<div class="row gallery-single fix">
						<div class="col-md-4">
							<div class="img-box">
								<img src="<?= $menu['image'] ?>" width="100">
							</div>
						</div>
						<div class="col-md-4">
							<div class="detail">
								<h4><?= $menu['title'] ?></h4>
								<p><?= $menu['details'] ?></p>
								<h4>$<?= $menu['price'] ?></h4>
							</div>
						</div>
						<div class="col-md-4">
							<div class="add">
								<div class="add-btn">
									<?php if ($menu['availability']): ?>
									<button type="button" class="btn btn-lg add-button" onclick="script.addCart('<?= e_id($menu['id']) ?>')">Add</button>
									<!-- <div class="form-inline justify-content-center">
										<span class="minus-btn quantity-btn" onclick="script.updateCart('<?= e_id($menu['id']) ?>')">-</span>
										<span class="quantity">1</span>
										<span class="plus-btn quantity-btn" onclick="script.updateCart('<?= e_id($menu['id']) ?>')">+</span>
			                        </div> -->
									<?php else: ?>
									<a href="javascript:;" class="btn btn-info btn-lg order-btn1">Item not available.</a>
									<?php endif ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach ?>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>