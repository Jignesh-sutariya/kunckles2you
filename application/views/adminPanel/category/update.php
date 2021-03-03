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
        <?= form_open($url.'/update/'.$id, 'id="validateForm"') ?>
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="form-group">
              <?= form_label('Category Name', 'name', 'class="col-form-label"') ?>
              <?= form_input([
              'type' => "text",
              'name' => "name",
              'class' => "form-control",
              'id' => "name",
              'required' => "true",
              'maxlength' => 255,
              'placeholder' => "Enter Category Name",
              'value' => (set_value('name')) ? set_value('name') : $data['name']
              ]) ?>
            </div>
            <?= form_error('name') ?>
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