<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="container">
  <div class="col-lg-4 col-md-6 ml-auto mr-auto">
    <div class="card card-lock text-center">
      <div class="card-header ">
        <?= img('images/otp.png')  ?>
      </div>
      <?= form_open(admin('checkOtp'), 'class="form" id="forgotValidatio"') ?>
      <div class="card-body ">
        <h4 class="card-title">OTP Verify</h4>
        <div class="form-group">
          <?= form_input([
          'type' => "text",
          'name' => "otp",
          'class' => "form-control",
          'id' => "otp",
          'maxlength' => 6,
          'placeholder' => "Enter OTP we mailed you.",
          'value' => set_value('otp')
          ]) ?>
        </div>
        <?= form_error('otp') ?>
      </div>
      <div class="card-footer ">
        <?= form_button([ 'content' => 'Verify OTP',
        'type'  => 'submit',
        'class' => 'btn btn-warning btn-round btn-block mb-3']) ?>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>