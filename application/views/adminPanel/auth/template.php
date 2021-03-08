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
        <footer class="footer footer-black  footer-white ">
          <div class="container-fluid">
            <div class="row">
              <div class="credits ml-auto">
                <span class="copyright">
                  © <script>
                  document.write(new Date().getFullYear())
                  </script>, made with <i class="fa fa-heart heart"></i> by <a href="https://densetek.com" title="Densetek Infotech" class="text-danger" target="_blank"><b>Densetek Infotech</b></a>
                </span>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="<?= base_url('assets/js/core/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/login.js') ?>"></script>
    <?php if ($this->session->message): ?>
    <script>
    login.showSwal("<?= $this->session->message ?>", "<?= $this->session->notify ?>");
    </script>
    <?php endif ?>
  </body>
</html>