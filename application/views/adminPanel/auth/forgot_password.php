<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="container">
  <div class="col-lg-4 col-md-6 ml-auto mr-auto">
    <div class="card card-lock text-center">
      <div class="card-header ">
        <?= img('images/profile.png')  ?>
      </div>
      <?= form_open(admin('forgot-password'), 'class="form" id="forgotValidatio"') ?>
      <div class="card-body ">
        <h4 class="card-title">Forgot Password</h4>
        <div class="form-group">
          <?= form_input([
          'type' => "text",
          'name' => "mobile",
          'class' => "form-control",
          'id' => "mobile",
          'placeholder' => "Email OR Mobile No.",
          'value' => set_value('mobile')
          ]) ?>
        </div>
        <?= form_error('mobile') ?>
      </div>
      <div class="card-footer ">
        <?= form_button([ 'content' => 'Send OTP',
        'type'  => 'submit',
        'class' => 'btn btn-warning btn-round btn-block mb-3']) ?>
        <div class="form-group">
          <?= anchor(base_url(admin('login')), '<span class="form-check-sign"></span>
          Login', 'class="form-check-label"'); ?>
        </div>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>