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
        <?= form_open_multipart($url.'/update/'.$id, 'id="validateForm"', ['image' => $data['image']]) ?>
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Item Title', 'title', 'class="col-form-label"') ?>
              <?= form_input([
              'type' => "text",
              'name' => "title",
              'class' => "form-control",
              'id' => "title",
              'maxLength' => '255',
              'required' => "true",
              'placeholder' => "Enter Item Title",
              'value' => (set_value('title')) ? set_value('title') : $data['title']
              ]) ?>
            </div>
            <?= form_error('title') ?>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Item details', 'details', 'class="col-form-label"') ?>
              <?= form_textarea([
              'name' => "details",
              'class' => "form-control",
              'id' => "details",
              'required' => "true",
              'placeholder' => "Enter Item details",
              'value' => (set_value('details')) ? set_value('details') : $data['details']
              ]) ?>
            </div>
            <?= form_error('details') ?>
          </div>
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Item price', 'price', 'class="col-form-label"') ?>
              <?= form_input([
              'type' => "text",
              'name' => "price",
              'maxLength' => '30',
              'number' => "true",
              'required' => "true",
              'class' => "form-control",
              'id' => "price",
              'maxlength' => 30,
              'placeholder' => "Enter Item price",
              'value' => (set_value('price')) ? set_value('price') : $data['price']
              ]) ?>
            </div>
            <?= form_error('price') ?>
          </div>
          <div class="col-md-4">
            <h4 class="card-title">
            <?= form_label('Item image', 'image', 'class="col-form-label"') ?>
            </h4>
            <div class="fileinput text-center fileinput-new" data-provides="fileinput">
              <div class="fileinput-new thumbnail">
                <?= img('assets/img/image_placeholder.jpg') ?>
              </div>
              <div class="fileinput-preview fileinput-exists thumbnail" style=""></div>
              <div>
                <span class="btn btn-rose btn-round btn-file">
                  <span class="fileinput-new">Select image</span>
                  <span class="fileinput-exists">Change</span>
                  <?= form_input([
                  'type' => "file",
                  'name' => "image",
                  'class' => "form-control",
                  'id' => "image"
                  ]) ?>
                </span>
                <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h4 class="card-title">
            <?= form_label('Item category', 'c_id', 'class="col-form-label"') ?>
            </h4>
            <select class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" title="Single Category" id="c_id" name="c_id" required="true" >
              <option disabled>Single Category</option>
              <?php foreach ($cats as $cat): ?>
              <option value="<?= e_id($cat['id']) ?>" <?= (set_value('c_id') == e_id($cat['id']) || e_id($data['c_id']) == e_id($cat['id'])) ? 'selected' : '' ?>><?= $cat['name'] ?></option>
              <?php endforeach ?>
            </select>
            <h4 class="card-title">
            <?= form_label('Available', 'availability', 'class="col-form-label"') ?>
            </h4>
            <input class="bootstrap-switch" type="checkbox" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" name="availability" id="availability" <?= (set_value('availability') || $data['availability']) ? 'checked' : '' ?> />
          </div>
          <div class="col-md-4">
            <h4 class="card-title">
            <?= form_label('Item availability', 'week_avail', 'class="col-form-label"') ?>
            </h4>
            <select class="selectpicker" data-style="btn btn-info btn-round" multiple title="Choose days" data-size="7" name="week_avail[]" id="week_avail" required="true">
              <option disabled> Multiple days</option>
              <?php foreach (['Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday', 'Sunday' => 'Sunday'] as $day): ?>
              <option value="<?= $day ?>"
                <?= ((set_value('week_avail') && in_array($day, set_value('week_avail'))) || (in_array($day, explode(', ', $data['week_avail'])))) ? 'selected' : '' ?>>
                <?= $day ?>
              </option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-md-12 col-sm-12">
            <?= form_button([ 'content' => 'Save Changes',
            'type'  => 'submit',
            'class' => 'btn btn-outline-info btn-round col-md-2']) ?>
            <?= anchor($url, 'Go back', ['class' => 'btn btn-outline-danger btn-round col-md-2']) ?>
          </div>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>