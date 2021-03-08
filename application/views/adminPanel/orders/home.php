<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-9">
            <h4 class="card-title"><?= ucwords($title) ?> List</h4>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <input type="text" class="form-control datepicker" id="o_date" data-change="this.value" />
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="javascript:;" onclick="script.status('')" role="tablist">
              <i class="now-ui-icons objects_umbrella-13"></i>
              All Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="javascript:;" onclick="script.status('In process')" role="tablist">
              <i class="now-ui-icons shopping_shop"></i>
              In process
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="javascript:;" onclick="script.status('Completed')" role="tablist">
              <i class="now-ui-icons ui-2_settings-90"></i>
              Completed
            </a>
          </li>
        </ul>
        <table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
          <thead>
            <th class="text-center target">Sr No.</th>
            <th class="text-center">Order ID</th>
            <th class="text-center">Total</th>
            <th class="text-center">date</th>
            <th class="text-center">time</th>
            <th class="text-center">mobile</th>
            <th class="text-center">email</th>
            <th class="text-center">status</th>
            <th class="text-center target">Actions</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="status" value="In process" />
<div class="modal fade modal-primary" id="changeStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <div class="modal-profile mx-auto">
          <i class="nc-icon nc-bulb-63"></i>
        </div>
      </div>
      <div class="modal-body">
        <p>Are you sure to complete this order?</p>
      </div>
      <div class="modal-footer">
        <div class="left-side">
          <?= form_open($url.'/complete') ?>
          <input type="hidden" id="order_id" name="order_id" />
          <button type="submit" class="btn btn-link">Complete</button>
          <?= form_close() ?>
        </div>
        <div class="divider"></div>
        <div class="right-side">
          <button type="button" class="btn btn-link btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>