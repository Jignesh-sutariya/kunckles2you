<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-9">
            <h4 class="card-title">Manage <?= ucwords($title) ?></h4>
          </div>
          <div class="col-md-3">
            <?= anchor($url.'/timings', 'Manage Timings', 'title="Manage Timings" class="btn btn-info btn-round float-right"') ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?= form_open($url.'/restUpdate') ?>
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Restaurant Name', 'name', 'class="col-form-label"') ?>
              <?= form_input([
              'type' => "text",
              'name' => "name",
              'class' => "form-control",
              'id' => "name",
              'maxlength' => 255,
              'placeholder' => "Enter Restaurant Name",
              'value' => $data['name']
              ]) ?>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Restaurant Sub Title', 'sub_title', 'class="col-form-label"') ?>
              <?= form_input([
              'type' => "text",
              'name' => "sub_title",
              'class' => "form-control",
              'id' => "sub_title",
              'maxlength' => 255,
              'placeholder' => "Enter Restaurant Sub Title",
              'value' => $data['sub_title']
              ]) ?>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Restaurant Address', 'address', 'class="col-form-label"') ?>
              <?= form_input([
              'name' => "address",
              'class' => "form-control",
              'id' => "address",
              'placeholder' => "Enter Restaurant Address",
              'value' => $data['address']
              ]) ?>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Restaurant Contact No', 'contact_no', 'class="col-form-label"') ?>
              <?= form_input([
              'type' => "text",
              'name' => "contact_no",
              'class' => "form-control",
              'id' => "contact_no",
              'maxlength' => 20,
              'placeholder' => "Enter Restaurant Contact No",
              'value' => $data['contact_no']
              ]) ?>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Restaurant Email Id', 'email_id', 'class="col-form-label"') ?>
              <?= form_input([
              'type' => "email",
              'name' => "email_id",
              'class' => "form-control",
              'id' => "email_id",
              'maxlength' => 255,
              'placeholder' => "Enter Restaurant Email Id",
              'value' => $data['email_id']
              ]) ?>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Facebook link', 'facebook', 'class="col-form-label"') ?>
              <?= form_input([
              'type' => "text",
              'name' => "facebook",
              'class' => "form-control",
              'id' => "facebook",
              'maxlength' => 255,
              'placeholder' => "Enter Facebook link",
              'value' => $data['facebook']
              ]) ?>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Instagram link', 'instagram', 'class="col-form-label"') ?>
              <?= form_input([
              'type' => "text",
              'name' => "instagram",
              'class' => "form-control",
              'id' => "instagram",
              'maxlength' => 255,
              'placeholder' => "Enter Instagram link",
              'value' => $data['instagram']
              ]) ?>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <?= form_button([ 'content' => 'Save Changes',
            'type'  => 'submit',
            'class' => 'btn btn-outline-info btn-round col-md-2']) ?>
          </div>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>