<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="col-lg-4 col-md-6 ml-auto mr-auto">
	<?= form_open(admin('login'), 'class="form" id="LoginValidation"') ?>
	<div class="card card-login">
		<div class="card-header ">
			<div class="card-header ">
				<h3 class="header text-center">Login</h3>
			</div>
		</div>
		<div class="card-body">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="nc-icon nc-single-02"></i>
					</span>
				</div>
				<?= form_input([
				'type' => "text",
				'name' => "mobile",
				'class' => "form-control",
				'id' => "mobile",
				'maxlength' => 10,
				'placeholder' => "Enter Mobile No.",
				'required' => 'true',
				'value' => set_value('mobile')
				]) ?>
			</div>
			<?= form_error('mobile') ?>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="nc-icon nc-key-25"></i>
					</span>
				</div>
				<?= form_input([
				'type' => "password",
				'name' => "password",
				'class' => "form-control",
				'id' => "password",
				'required' => 'true',
				'placeholder' => "Enter Password"
				]) ?>
			</div>
			<?= form_error('password') ?>
			<br />
			<div class="card-footer ">
				<?= form_button([ 'content' => 'Login',
				'type'  => 'submit',
				'class' => 'btn btn-warning btn-round btn-block mb-3']) ?>
			</div>
			<div class="form-group">
				<?= anchor(base_url(admin('forgot-password')), '<span class="form-check-sign"></span>
				Forgot Password?', 'class="form-check-label"'); ?>
			</div>
		</div>
	</div>
	<?= form_close() ?>
</div>