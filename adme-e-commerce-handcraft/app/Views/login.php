
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Merchant or Admin Dashboard Page</title>
        <meta name="description" content="E-Commerce CredifyShop." />
        <meta name="author" content="hencework" />
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- vector map CSS -->
		<link href="<?= base_url() ?>/vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		
		
		<!-- Custom CSS -->
		<link href="<?= base_url() ?>/dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--Preloader-->
		<div class="preloader-it">
			<div class="la-anim-1"></div>
		</div>
		<!--/Preloader-->
		
		<div class="wrapper pa-0">
			<header class="sp-header">
				<div class="sp-logo-wrap pull-left">
				</div>
				<div class="form-group mb-0 pull-right">
					<span class="inline-block pr-10">Apakah Anda Ingin Ke Halaman Utama?</span>
					<a class="inline-block btn btn-info btn-success btn-rounded btn-outline" href="http://sandy.sivia.id/">Halaman Utama</a>
				</div>
				<div class="clearfix"></div>
			</header>
			
			<!-- Main Content -->
			<div class="page-wrapper pa-0 ma-0 auth-page">
				<div class="container-fluid">
					<!-- Row -->
					<div class="table-struct full-width full-height">
						<div class="table-cell vertical-align-middle auth-form-wrap">
							<div class="auth-form  ml-auto mr-auto no-float">
								<div class="row">
									<div class="col-sm-12 col-xs-12">
                                    <?php if(isset($validation)) : ?>
                                        <div class=col-12>
                                            <div class="alert alert-danger" role="alert">
                                                <?= $validation->listErrors() ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
										<div class="mb-30">
											<h3 class="text-center txt-dark mb-10">Sign to Admin or Merchant</h3>
											<h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
										</div>	
										<div class="form-wrap">
											<form action="<?= route_to('login_post') ?>" method="post" >
                                            <?= csrf_field() ?>
												<div class="form-group">
													<label class="control-label mb-10" for="email">Email address</label>
													<input type="email" class="form-control" required="" name="email" id="email" placeholder="Enter email">
												</div>
												<div class="form-group">
													<label class="pull-left control-label mb-10" for="password">Password</label>
													<a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="forgot-password.html">forgot password ?</a>
													<div class="clearfix"></div>
													<input type="password" class="form-control" required="" name="password" id="password" placeholder="Enter pwd">
												</div>
												<div class="form-group text-center">
													<button type="submit" class="btn btn-info btn-success btn-rounded">sign in</button>
												</div>
											</form>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->	
				</div>
				
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /#wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="<?= base_url() ?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="<?= base_url() ?>/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?= base_url() ?>/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="<?= base_url() ?>/dist/js/jquery.slimscroll.js"></script>
		
		<!-- Init JavaScript -->
		<script src="<?= base_url() ?>/dist/js/init.js"></script>
	</body>
</html>
