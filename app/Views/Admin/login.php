<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/style.css">
  <title>Bootstrap 4 Login/Register Form</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
        <div href="#" class="text-secondary d-flex align-items-center justify-content-center justify-content-lg-start">
          <h1>CITY TAXI</h1>
        </div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse container" id="navbarSupportedContent">

      </div>
    </div>
  </nav>


  <div id="logreg-forms">
    <form class="form-signin">
      <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>

      <input type="email" id="inEmail" name="inEmail" class="form-control" value="<?php set_value("inEmail") ?>" placeholder="Email address" required="" autofocus="">
      <input type="password" id="inPass" name="inPass" class="form-control" value="<?php set_value("inPass") ?>" placeholder="Password" required="">

      <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>

      <hr>
      <!-- <p>Don't have an account!</p>  -->
      <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
    </form>

    <form action="/reset/password/" class="form-reset">
      <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required="" autofocus="">
      <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
      <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
    </form>

    <form action="/signup/" class="form-signup">

      <input type="text" id="uname1" name="uname1" class="form-control" placeholder="First Name" required="" autofocus="" value="<?php set_value("uname1") ?>">
      <input type="text" id="uname2" name="uname2" class="form-control" placeholder="Last Name" required="" autofocus="" value="<?php set_value("uname2") ?>">
      <input type="email" id="uemail" name="uemail" class="form-control" placeholder="Email address" required autofocus="" value="<?php set_value("uadd") ?>">
      <input type="email" id="uuname" name="uuname" class="form-control" placeholder="User Name" required autofocus="" value="<?php set_value("uuname") ?>">
      <input type="text" id="uadd" name="uadd" class="form-control" placeholder="Address" required autofocus="" value="<?php set_value("uadd") ?>">
      <input type="number" id="ucontact" name="ucontact" class="form-control" placeholder="Contact no." required autofocus="" value="<?php set_value("ucontact") ?>">
      <input type="password" id="user-pass" class="form-control" placeholder="Password" required autofocus="">
      

      <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
      <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
    </form>
    <br>

  </div>
  <p style="text-align:center">
    <a href="http://bit.ly/2RjWFMfunction toggleResetPswd(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle() // display:block or none
    $('#logreg-forms .form-reset').toggle() // display:block or none
}

function toggleSignUp(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(()=>{
    // Login Register Form
    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
    $('#logreg-forms #cancel_reset').click(toggleResetPswd);
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
})g" target="_blank" style="color:black">By Group 6</a>
  </p>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="/assets/script.js"></script>
</body>

</html>