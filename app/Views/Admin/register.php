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
  <title>City Taxi Register Form</title>
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
    <form class="col col-sm-12" method="post" id="regForm" name="regForm">
        <div class="form-group row">

            <label>First Name</label>
            <input type="text" id="uname1" name="uname1" class="form-control" >
            
        </div>
        <div class="form-group row">
            <label>Last Name</label>
            <input type="text" id="uname2" name="uname2" class="form-control" >
            
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" id="uemail" name="uemail" class="form-control"  >
           
        </div>
        <div class="from-group">
            <label>User Name</label>
            <input type="text" id="uuname" name="uuname" class="form-control" >
           
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" id="uadd" name="uadd" class="form-control"  >
           
        </div>
        <div class="form-group">
            <label>Contact</label>
            <input type="text" id="ucontact" name="ucontact" class="form-control" >
            
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" id="upass" name="upass" class="form-control" >
          
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" id="upass2" name="upass2" class="form-control" >   
        </div>       
        <?php 
        if (isset($validation)){ ?>
            <div class="">
              <div class="alert alert-danger" role="alert">
              <?= $validation->listErrors() ?>
              </div>
            </div>

        <?php }
        ?> 
      <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
      <a href="/" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
    </form>
    <br>

  </div>
  <p style="text-align:center">
    <a href="" target="_blank" style="color:black">By Group 6</a>
  </p>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>