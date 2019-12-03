<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
<!-- Favicon -->
<link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">

<!-- Fonts -->
<link href="" rel="stylesheet">


<!--  CSS -->
<link type="text/css" href="../assets/css/argon-dashboard.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/css/login.css')}}" >

</head>
<body>
<div class="login-page" style="padding-top: 80px; padding-bottom: -80px;">
  <div class="form" style="padding-top: 20px; margin-bottom: 0;">
    <form class="login-form" action="{{ route('checkRegister') }}" method="POST">
    {{csrf_field()}}
        <h1 style="margin: 0;">Register</h1>
        <br>
      <input type="text" placeholder="Full Name" name="nama"/>
      <input type="email" placeholder="email" name="email"/>
      <input type="text" placeholder="Class Name" name="nama_kelas"/>
      <div class="row">
        <div class="col-8"><input type="text" id="output" placeholder="Click Play" name="kode_kelas"/></div>
        <div class="col-4" id="create" style="padding-left: 0;"><button type="button">random</button></div>
      </div>     
      <input type="password" placeholder="password"name="password"/>
      <button type="submit">Register</button>
    </form>
  </div>
</div>
<script>
    function createRandomString( length ) {
    
    var str = "";
    for ( ; str.length < length; str += Math.random().toString( 36 ).substr( 2 ) );
    return str.substr( 0, length );
}

document.addEventListener( "DOMContentLoaded", function() {
    var button = document.querySelector( "#create" ),
        output = document.querySelector( "#output" );
    button.addEventListener( "click", function() {
        var str = createRandomString( 6 );
        output.value = str;
    }, false)
  
});
</script>

<!-- Core -->
<script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
<script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
