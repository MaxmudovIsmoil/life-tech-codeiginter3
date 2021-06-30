<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="<?= site_url("assets/login/images/icons/favicon.ico") ?>"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= site_url("assets/login/vendor/bootstrap/css/bootstrap.min.css") ?>">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= site_url("assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css") ?>">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= site_url("assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css") ?>">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= site_url("assets/login/vendor/animate/animate.css") ?>">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?= site_url("assets/login/vendor/css-hamburgers/hamburgers.min.css") ?>">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= site_url("assets/login/vendor/select2/select2.min.css") ?>">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?= site_url("assets/login/css/util.css") ?>">
  <link rel="stylesheet" type="text/css" href="<?= site_url("assets/login/css/main.css") ?>">
<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100" style="background-image: url('<?= site_url("assets/login/images/img-01.jpg") ?>');">
      <div class="wrap-login100 p-t-50 p-b-0">
    <?= form_open("user/login", array("method" => "POST", "class"=>"login100-form validate-form")); ?>
          <div class="login100-form-avatar">
            <img src="<?= site_url("assets/login/images/lifetech_logo.svg") ?>" alt="AVATAR">
          </div>

          <span class="login100-form-title p-t-20 p-b-40">Life Tech</span>

          <div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
            <input class="input100" type="text" name="identity" placeholder="Username">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-user"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
            <input class="input100" type="password" name="password" id="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock"></i>
            </span>
          </div>

          <div class="container-login100-form-btn p-t-10">
            <button class="login100-form-btn">Login</button>
          </div>

          <div class="text-center w-full p-t-25 p-b-0">
<!--            <a href="#" class="txt1">-->
<!--              Forgot Username / Password?-->
<!--            </a>-->
          </div>

      <?= form_close();?>
      </div>
    </div>
  </div>
  <?php if (isset($message)): ?>
    <?=$message; ?>
  <?php endif ?>

<!--===============================================================================================-->  
  <script src="<?= site_url("assets/login/vendor/jquery/jquery-3.2.1.min.js") ?>"></script>
<!--===============================================================================================-->
  <script src="<?=site_url("assets/login/vendor/bootstrap/js/popper.js"); ?>"></script>
  <script src="<?= site_url("assets/login/vendor/bootstrap/js/bootstrap.min.js") ?>"></script>
<!--===============================================================================================-->
  <script src="<?= site_url("assets/login/vendor/select2/select2.min.js") ?>"></script>
<!--===============================================================================================-->
  <script src="<?= site_url("assets/login/js/main.js") ?>"></script>
</body>
</html>
