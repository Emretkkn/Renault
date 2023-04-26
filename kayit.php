<!doctype html>
<html lang="tr" class="fullscreen-bg">
<head>
	<title>Renault Yönetim Paneli Giriş Ekranı</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="renault-icon" sizes="76x76" href="assets/img/eufak.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/e.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="assets/img/renault_yeni.png" alt="Renault Logo"></div>
								<p class="lead">Hesap Oluşturun</p>
							</div>
							<form class="form-auth-small" action="register.php" method="post">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <div class="form-group">
									<label class="control-label sr-only">Şifre</label>
									<input type="text" name="firstname" class="form-control" placeholder="İsim">
								</div>
								<div class="form-group">
									<label class="control-label sr-only">Kullanıcı Adı</label>
									<input type="email" name="uname" class="form-control" placeholder="E-posta">
								</div>
								<div class="form-group">
									<label class="control-label sr-only">Şifre</label>
									<input type="password" name="password" class="form-control" placeholder="Şifre">
								</div>
								<button type="submit" class="btn-primary btn-lg btn-block">Oluştur</button>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
</html>
