<!DOCTYPE html>
<html>
<head>
	<title>LOGIN SYSTEM</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container"></div>
	<h1 class="text-center">Performance Dashboard</h1>
	<h2 class="text-center">LOGIN SYSTEM</h2>

<!--start login form -->
	<div class="card mt-5">
  	  <div class="card-header bg-danger text-white" >
    Login Performance Dashboard
  </div>
  <div class="card-body">
  	<form method="post" action="verifikasi_login.php">
  		<div class="form-group">
  			<label>Username</label>
  			<input typext="user" name="user" class="form-control" placeholder="Input Username" required>
  		</div>
  		<div class="form-group">
  			<label>Password</label>
  			<input type="password" name="password" class="form-control" placeholder="Input Password" required>
  		</div>
		  <div class="form-group">
  			<label>Pilih </label>
  			<select class="form-control" name="level">
  				<option value="Administrator">Administrator</option>
  				<option value="PIC Regional">PIC Regional</option>
				<option value="PIC Witel">PIC Witel</option>
  			</select>
  		</div>
  		
  		<button class="btn btn-primary" type="submit">Login</button>
  		<button type="reset" class="btn btn-warning text-white" name="breset">Reset</button>
 
  	</form>
  </div>
	</div>
<!-- end login form -->


</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>	
</body>
</html>