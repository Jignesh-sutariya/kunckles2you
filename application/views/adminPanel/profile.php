<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="row">
  <div class="col-md-4">
    <div class="card card-user">
      <?php $id=0; if (file_exists(strtolower(str_replace(" ", '_', APP_NAME)).'.png')): ?>
      <div class="card-footer">
        <div class="button-container">
          <div class="row">
            <div class="col-lg-12 ml-auto">
              <h5><a href="<?= base_url(admin('create_qr?message=Qr Updated')) ?>" title="Update QR Code">Update QR Code</a></h5>
            </div>
          </div>
        </div>
        <hr>
      </div>
      <div class="card-body">
        <?= img(strtolower(str_replace(" ", '_', APP_NAME)).'.png') ?>
      </div>
      <div class="card-footer">
        <hr>
        <div class="button-container">
          <div class="row">
            <div class="col-lg-12 ml-auto">
              <h5><a href="<?= base_url(strtolower(str_replace(" ", '_', APP_NAME)).'.png') ?>" title="Download QR Code">Download QR Code</a></h5>
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
      <div class="card-footer">
        <div class="button-container">
          <div class="row">
            <div class="col-lg-12 ml-auto">
              <h5><a href="<?= base_url(admin('create_qr?message=Qr Created')) ?>" title="Create QR Code">Create QR Code</a></h5>
            </div>
          </div>
        </div>
      </div>
      <?php endif ?>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h5 class="title">Update Profile</h5>
      </div>
      <div class="card-body">
        <?= form_open($url.'/profile', 'id="validateForm"') ?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>User Name</label>
              <input type="text" class="form-control" placeholder="User Name" value="<?= $this->session->name ?>" name="name" id="name" required="true" maxLength="255" />
              <?= form_error('name') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Mobile No.</label>
              <input type="text" class="form-control" placeholder="Mobile No." value="<?= $this->session->mobile ?>" name="mobile" id="mobile" required="true" number="true" maxLength="10" />
              <?= form_error('mobile') ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" class="form-control" placeholder="Email Address" value="<?= $this->session->email ?>" name="email" id="email" required="true" maxLength="255" email="true" />
              <?= form_error('email') ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
            </div>
          </div>
          <div class="col-md-12">
            <?= form_button([ 'content' => 'Update Profile',
            'type'  => 'submit',
            'class' => 'btn btn-outline-info btn-round col-md-4']) ?>
            
            <?= anchor($url, 'Go back', ['class' => 'btn btn-outline-danger btn-round col-md-4']) ?>
          </div>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>