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
            <?= anchor($url.'/add', 'Add Category', 'title="Add Category" class="btn btn-info btn-round float-right"') ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
          <thead>
            <th class="text-center target">Sr No.</th>
            <th class="text-center">Category</th>
            <th class="text-center target">Actions</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>