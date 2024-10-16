<!DOCTYPE html>
<html>
<head>
<title>Admin Login: Dubai International Real Estate, Luxury Homes/Properties for Sale – Morgan’s International Realty </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<link href="https://myprojectdemonstration.net/development/morgan/web/css/common.css" rel="stylesheet" type="text/css">

<!------ Include the above in your HEAD tag ---------->
</head>
<body>

<section class="a-login-section">
	<div class="container-fluid p-0">
		<div class="a-login-main">
				<div class="row no-gutters">
					 <div class="col-md-6 col-12">
						 <div class="a-login-img">
							<img src="../img/login-image.png" class="" alt="" />
						 </div>
					</div>
				
			  
				 <div class="col-md-6 col-12">
					<div class="a-login-panel">
						<div class="a-login-heading">
							<h2>Application Login</h2>
							<p>Login from here to access.</p>
						 </div>
						<form action="{{ route('admin.login.submit') }}" method="POST">
							@csrf
							<div class="form-group" style="position: relative;">
								@if ($errors->any())
									<div>
										@foreach ($errors->all() as $error)
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
											  {{ $error }}
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
										@endforeach
									</div>
								@endif
							</div>
							<div class="form-group">
								<label for="email">Email:</label>
								<input type="email" class="form-control" placeholder="User Name" name="email" required>
								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="password">Password:</label>
								<input type="password" class="form-control" placeholder="Password" name="password" required>
							</div>
							<button type="submit" class="green-btn">Login</button> 
						</form>
					</div>
				 </div>
			</div> 
		</div>
	</div>
</section>
 
</body>
</html>



<style>
body{
	margin-top:0;
}
.a-login-section {
    height: 100vh;
    width: 100%;
    background: #FCF9F2;
    display: flex;
    justify-content: center;
}

.a-login-main {
    
    overflow: hidden;
	height: 100%;
}

a-login-img{
	background-color:#3A3526;
}

.a-login-panel {
    height: 100%;
    padding: 60px 180px;
    background: #F2EFE5;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.a-login-heading h2,.a-login-heading p {
    color: #3A3526;
}

.a-login-heading h2 {
    margin-bottom: 0px;
}

.a-login-heading p {
    margin-bottom: 20px;
    font-weight: 700 !important;
}

.a-login-panel .form-group input {
    height: 53px;
    background-color: #FCF9F2;
    font-family: ClashGrotesk-Medium;
    font-size: 14px;
    font-weight: 500;
    line-height: 17.22px;
    letter-spacing: 1px;
    border: 0;
    padding: 16px 20px;
}
.a-login-panel .green-btn {
    margin-top: 30px;
    width: 100%;
    font-size: 18px;
    font-family: 'ClashGrotesk-Medium';
}
.a-login-main .row {
    height: 100%;
}
.a-login-img {
    height: 100%;
    width: 100%;
    overflow: hidden;
}
.a-login-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}







@media (max-width:1500px){
	.a-login-panel {
		padding: 60px 110px;
	}
}

@media (max-width:767px){
	.a-login-panel {
		padding: 30px 20px;
	}
}
</style> 
