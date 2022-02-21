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
  <title>City Taxi Register Form</title>
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
    <form class="col col-sm-12" method="post" id="regForm" name="regForm">
        <div class="form-group row">

            <label class="fs-4">First Name</label>
            <input type="text" id="uname1" name="uname1" class="form-control" >
            
        </div>
        <div class="form-group row">
            <label class="fs-4">Last Name</label>
            <input type="text" id="uname2" name="uname2" class="form-control" >
            
        </div>
        <div class="form-group">
            <label class="fs-4">Email</label>
            <input type="text" id="uemail" name="uemail" class="form-control"  >
           
        </div>
        <div class="from-group">
            <label class="fs-4">User Name</label>
            <input type="text" id="uuname" name="uuname" class="form-control" >
           
        </div>
        <div class="form-group">
            <label class="fs-4">Address</label>
            <input type="text" id="uadd" name="uadd" class="form-control"  >
           
        </div>
        <div class="form-group">
            <label class="fs-4">Contact</label>
            <input type="text" id="ucontact" name="ucontact" class="form-control" >
            
        </div>
        <div class="form-group">
            <label class="fs-4">Password</label>
            <input type="password" id="upass" name="upass" class="form-control" >
          
        </div>
        <div class="form-group">
            <label class="fs-4">Confirm Password</label>
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
 
</body>

</html>