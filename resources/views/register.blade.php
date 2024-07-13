<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('AdminLTE') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE') }}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode login-page">
<div class="login-box">
  <h3> Register</h3>
  <hr>
  <form action="/register" method="POST">
    @csrf
    <div class="mb-3 mt-3">
      <label for="username" class="form-label">Username:</label>
      <input type="text" class="form-control" placeholder="username" name="username" placeholder="Enter username">
    </div>
    <div class="mb-3">
      <label for="pwd" class="form-label">Password:</label>
      <input type="password" class="form-control" placeholder="Enter Password" name="password">
    </div>
    <button type="submit" class="btn btn-primary col-12">Submit</button>
    <div class="row mt-3 ml-1">
      <a href="/"> Login Akun</a>
    </div>
    
  </form>
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE') }}/dist/js/adminlte.min.js"></script>
</body>
</html>
