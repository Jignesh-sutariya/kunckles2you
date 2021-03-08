<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-10">
            <h4 class="card-title"><?= ucwords($title) ?> List</h4>
          </div>
          <div class="col-md-2">
            <?= anchor($url.'/add', 'Add Banner', 'title="Add Banner" class="btn btn-info btn-round"') ?>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
          <thead>
            <th class="text-center target">Sr No.</th>
            <th class="text-center target">Banner</th>
            <th class="text-center target">Actions</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>