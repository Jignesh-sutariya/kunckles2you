<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-10">
            <h4 class="card-title">Add <?= ucwords($title) ?></h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?= form_open_multipart($url.'/upload', 'onsubmit="if(document.getElementById(\'image\').value === \'\') return false;"') ?>
        <div class="row">
          <div class="col-md-4 col-sm-4">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
              <div class="fileinput-new thumbnail">
                <?= img('assets/img/image_placeholder.jpg') ?>
              </div>
              <div class="fileinput-preview fileinput-exists thumbnail"></div>
              <div>
                <span class="btn btn-rose btn-round btn-file">
                  <span class="fileinput-new">Select image</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" name="image" id="image" />
                </span>
                <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6">
            <?= form_button([ 'content' => 'Upload image',
            'type'  => 'submit',
            'class' => 'btn btn-outline-info btn-round col-md-4']) ?>
            <br>
            <?= anchor($url, 'Go back', ['class' => 'btn btn-outline-danger btn-round col-md-4']) ?>
          </div>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>