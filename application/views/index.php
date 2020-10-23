<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css');?>style.css">
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="<?php echo $this->config->item('img');?>user.png" id="icon" alt="User Icon" />
      <center><span id="err" style="color: red; font-size: 13px;"></span></center>
    </div>

    <!-- Login Form -->
    <form method="post" id="login_form">
      <input type="text" id="username" class="fadeIn second" name="login" placeholder="Username">
      <input type="password" id="password" class="fadeIn third" name="login" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In" id="submit">
    </form>
  </div>
</div>

  <script>
    $(document).ready(function(){
      $('body #submit').on('click',function(e){
          e.preventDefault();
          $('#err').text('');
          var is_error = false;
          var username = $.trim($('#username').val());
          var password = $.trim($('#password').val());
          if (username == '' && password == '') {
              $('#err').text('Please Enter Username & Password');
              return false;
          }
          var formData = {
              password: password,
              username: username
          };
          $.ajax({
          url: "<?php echo base_url('Site/login_check')?>",
          method: 'post',
          data: formData,
          dataType: 'json',
          success:function(resp)
          {
            if (resp.status == 'success') 
            {
              window.location.href = "<?php echo base_url('Site/dashboard')?>";
            }
            if (resp.status == 'error') 
            {
              $('#err').text('Incorrect Username & Password');
            }
          }

        }); 
      });
    });
  </script>
</body>
</html>