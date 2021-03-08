<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="container">
  <div class="col-lg-4 col-md-6 ml-auto mr-auto">
    <div class="card card-lock text-center">
      <div class="card-header ">
        <?= img('images/password.png')  ?>
      </div>
      <?= form_open(admin('changePassword'), 'class="form" id="forgotValidatio"') ?>
      <div class="card-body ">
        <h4 class="card-title">Change Password</h4>
        <div class="form-group">
          <?= form_input([
          'type' => "password",
          'name' => "password",
          'class' => "form-control",
          'id' => "password",
          'placeholder' => "Password"
          ]) ?>
        </div>
        <?= form_error('password') ?>
        <div class="form-group">
          <?= form_input([
          'type' => "password",
          'name' => "confirm_password",
          'class' => "form-control",
          'id' => "confirm_password",
          'placeholder' => "Confirm Password"
          ]) ?>
        </div>
        <?= form_error('confirm_password') ?>
      </div>
      <div class="card-footer ">
        <?= form_button([ 'content' => 'Change Password',
        'type'  => 'submit',
        'class' => 'btn btn-warning btn-round btn-block mb-3']) ?>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>