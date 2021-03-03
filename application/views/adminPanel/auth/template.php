<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <?= link_tag('images/favicon.png', 'png', 'image/x-icon') ?>
    <?= link_tag('images/favicon.png', 'icon', 'image/x-icon') ?>
    <title> <?= APP_NAME.' | '.ucfirst($title) ?> </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <?= link_tag('assets/css/font-awesome.min.css','stylesheet') ?>
    <?= link_tag('assets/css/bootstrap.min.css','stylesheet') ?>
    <?= link_tag('assets/css/paper-dashboard.css','stylesheet') ?>
  </head>
  <body class="login-page">
    <div class="wrapper wrapper-full-page ">
      <div class="full-page section-image">
        <div class="content">
          <div class="container">
            <?= $contents ?>
          </div>
        </div>
        <div class="full-page-background" style="background-image: url(' <?= base_url('images/fabio-mangione.jpg') ?> ') ">
        </div>
      </div>
    </div>
    <script src="<?= base_url('assets/js/core/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/jquery.validate.min.js') ?>"></script>
    <?php if ($this->session->message): ?>
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <h4 class="title title-up"><?= $this->session->notify ?></h4>
          </div>
          <div class="modal-body text-center">
            <h5><?= $this->session->message ?></h5>
          </div>
          <div class="modal-footer">
            <div class="left-side">
              <button type="button" class="btn btn-default btn-link" data-dismiss="modal">Never mind</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
    $("#messageModal").modal();
    </script>
    <?php endif ?>
      <script>
      $(document).ready(function() {
        var input = $("form").first().find(':input').first().attr('id');
        $("#"+input).focus();
        $("#LoginValidation").validate({
          rules: {
            password: "required",
            mobile: {
              required: true,
              digits: true,
              minlength: 10,
              maxlength: 10
            }
          },
          highlight: function(element) {
            $(element).closest('.input-group').removeClass('has-success').addClass('has-danger');
          },
          unhighlight: function(element) {
            $(element).closest('.input-group').removeClass('has-danger').addClass('has-success');
          },
          errorPlacement: function(error, element) {
            return true;
          }
        });
      });
    </script>
  </body>
</html>