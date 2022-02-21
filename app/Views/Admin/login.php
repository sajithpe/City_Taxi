<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/style.css">
  <title>City Taxi Login Form</title>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

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
    <form class="form-signin" method="post">
      <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>

      <div class="form-group">
        <label class="fs-4">Email</label>
        <input type="text" id="uemail" name="uemail" class="form-control">

      </div>
      <div class="form-group">
        <label class="fs-4">Password</label>
        <input type="password" id="upass" name="upass" class="form-control">

      </div>


      <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>

      <hr>
      <!-- <p>Don't have an account!</p>  -->
      <a href="/register">
        <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
      </a>
    </form>
    <div class="container mt-4" id="alertId">
      <div class="row">
        <div class="col-md-12">

          <?php
          if (isset($validation)) { ?>
            <div class="mt-3" id="loginError">
              <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
              </div>
            </div>

          <?php }
          ?>
        </div>
        <div class="col-md-12">
          <?php
          $session = session();
          if (!empty($session->getFlashdata('success'))) {
          ?>
            <div class="alert alert-success">
              <?php echo $session->getFlashdata('success'); ?>
            </div>
          <?php
          }

          ?>
        </div>
      </div>
    </div>


  </div>
  <p style="text-align:center">
    <a href="" style="color:black">By Group 6</a>
  </p>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
    $(function() {

      $('.alert').delay(3000).fadeOut(300);

    });
  </script>
</body>

</html>