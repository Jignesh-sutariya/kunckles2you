<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="row">
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-body ">
				<div class="row">
					<div class="col-5 col-md-4">
						<div class="icon-big text-center icon-warning">
							<i class="fa fa-shopping-cart text-warning"></i>
						</div>
					</div>
					<div class="col-7 col-md-8">
						<div class="numbers">
							<p class="card-category">Current Orders</p>
							<p class="card-title"><?= $this->main->count('orders', ['status' => 'In process']) ?></p><p>
						</p></div>
					</div>
				</div>
			</div>
			<div class="card-footer ">
				<hr>
				<div class="stats">
					<i class="fa fa-calendar-o"></i>
					As on <?= date('d-m-Y') ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-body ">
				<div class="row">
					<div class="col-5 col-md-4">
						<div class="icon-big text-center icon-warning">
							<i class="fa fa-shopping-cart text-warning"></i>
						</div>
					</div>
					<div class="col-7 col-md-8">
						<div class="numbers">
							<p class="card-category">Total Orders</p>
							<p class="card-title"><?= $this->main->count('orders', ['status' => 'Completed']) ?></p><p>
						</p></div>
					</div>
				</div>
			</div>
			<div class="card-footer ">
				<hr>
				<div class="stats">
					<i class="fa fa-calendar-o"></i>
					As on <?= date('d-m-Y') ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-body ">
				<div class="row">
					<div class="col-5 col-md-4">
						<div class="icon-big text-center icon-warning">
							<i class="nc-icon nc-money-coins text-success"></i>
						</div>
					</div>
					<div class="col-7 col-md-8">
						<div class="numbers">
							<p class="card-category">Revenue</p>
							<p class="card-title">$ <?= $this->main->totalIncome() ?></p><p>
						</p></div>
					</div>
				</div>
			</div>
			<div class="card-footer ">
				<hr>
				<div class="stats">
					<i class="fa fa-calendar-o"></i>
					As on <?= date('d-m-Y') ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-body ">
				<div class="row">
					<div class="col-5 col-md-4">
						<div class="icon-big text-center icon-warning">
							<i class="nc-icon nc-single-copy-04 text-danger"></i>
						</div>
					</div>
					<div class="col-7 col-md-8">
						<div class="numbers">
							<p class="card-category">Menu Items</p>
							<p class="card-title"><?= $this->main->count('menu', ['is_deleted' => 0]) ?></p><p>
						</p></div>
					</div>
				</div>
			</div>
			<div class="card-footer ">
				<hr>
				<div class="stats">
					<i class="fa fa-calendar-o"></i>
					As on <?= date('d-m-Y') ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-body ">
				<div class="row">
					<div class="col-5 col-md-4">
						<div class="icon-big text-center icon-warning">
							<i class="fa fa-image text-primary"></i>
						</div>
					</div>
					<div class="col-7 col-md-8">
						<div class="numbers">
							<p class="card-category">Gallery</p>
							<p class="card-title"><?= $this->main->count('gallery', ['id != ' => 0]) ?></p><p>
						</p></div>
					</div>
				</div>
			</div>
			<div class="card-footer ">
				<hr>
				<div class="stats">
					<i class="fa fa-calendar-o"></i>
					As on <?= date('d-m-Y') ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-body ">
				<div class="row">
					<div class="col-5 col-md-4">
						<div class="icon-big text-center icon-warning">
							<i class="fa fa-qrcode text-dark"></i>
						</div>
					</div>
					<div class="col-7 col-md-8">
						<div class="numbers">
							<p class="card-category">QR Scans</p>
							<p class="card-title"><?= $this->main->count('scans', ['id != ' => 0]) ?></p><p>
						</p></div>
					</div>
				</div>
			</div>
			<div class="card-footer ">
				<hr>
				<div class="stats">
					<i class="fa fa-calendar-o"></i>
					As on <?= date('d-m-Y') ?>
				</div>
			</div>
		</div>
	</div>
</div>