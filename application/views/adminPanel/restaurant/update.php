<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-10">
            <h4 class="card-title">Update <?= ucwords($title) ?></h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?= form_open($url.'/update/'.$id.(($this->input->get('day')) ? '?day='.$this->input->get('day') : ''), 'id="validateForm" name="validateForm"') ?>
        <div class="row">
          <div class="col-md-4">
            <h4 class="card-title">
            <?= form_label('Day', 'day', 'class="col-form-label"') ?>
            </h4>
            <select class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Single Day" id="day" name="day" required="true" onchange="window.location = '<?= base_url($url.'/update/'.$id) ?>?day=' + this.value" >
              <option disabled>Single Day</option>
              <?php foreach (['Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday', 'Sunday' => 'Sunday'] as $day): ?>
              <option value="<?= $day ?>" <?= (set_value('day') == $day || $this->input->get('day') == $day || $data['day'] == $day) ? 'selected' : '' ?>><?= $day ?></option>
              <?php endforeach ?>
            </select>
            <h4 class="card-title">
            <?= form_label('Available', 'availability', 'class="col-form-label"') ?>
            </h4>
            <input class="bootstrap-switch" type="checkbox" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" name="availability" id="availability" <?= (set_value('availability')) ? 'checked' : '' ?> />
          </div>
          <div class="col-md-4">
            <h4 class="card-title">
            <?= form_label('Item available', 'avail_items', 'class="col-form-label"') ?>
            </h4>
            <select class="selectpicker" data-style="btn btn-info btn-round" multiple title="Choose Items" name="avail_items[]" id="avail_items" required="true">
              <option disabled> Multiple Items</option>
              <?php foreach ($items as $item): ?>
              <option value="<?= e_id($item['id']) ?>"
                <?= ((set_value('avail_items') && in_array(e_id($item['id']), set_value('avail_items'))) || in_array($item['id'], explode(',', $data['avail_items']))) ? 'selected' : '' ?>>
                <?= $item['title'] ?>
              </option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-md-4">
            <div class="card-header ">
              <h4 class="card-title">
              <?= form_label('From time', 'from_time', 'class="col-form-label"') ?>
              </h4>
            </div>
            <div class="card-body ">
              <div class="form-group">
                <input type="text" id="from_time" name="from_time" class="form-control timepicker" value="<?= (set_value('from_time')) ? set_value('from_time') : $data['from_time'] ?>" required="true" />
              </div>
            </div>
            <div class="card-header ">
              <h4 class="card-title">
              <?= form_label('To time', 'to_time', 'class="col-form-label"') ?>
              </h4>
            </div>
            <div class="card-body ">
              <div class="form-group">
                <input type="text" id="to_time" name="to_time" class="form-control timepicker" value="<?= (set_value('to_time')) ? set_value('to_time') : $data['to_time'] ?>" required="true" />
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Address', 'address', 'class="col-form-label"') ?>
              <?= form_input([
              'type' => "text",
              'name' => "address",
              'class' => "form-control",
              'id' => "address",
              'required' => "true",
              'maxlength' => 255,
              'placeholder' => "Enter Address",
              'value' => (set_value('address')) ? set_value('address') : $data['address']
              ]) ?>
            </div>
            <?= form_error('address') ?>
          </div>
          <div class="col-md-12 col-sm-12">
            <?= form_button([ 'content' => 'Save Changes',
            'type'  => 'submit',
            'class' => 'btn btn-outline-info btn-round col-md-2']) ?>
            <?= anchor($url.'/timings', 'Go back', ['class' => 'btn btn-outline-danger btn-round col-md-2']) ?>
          </div>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>