<?php session_start();?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gençlik Otobüsü - QR</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="js/instascan.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">	<style>
	#divvideo{
			box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.1);
	}
	</style>
</head>
<body style="background:#eee">
	<div class="container">
		<div class="row">
			<div class="col-md-4" style="padding:10px;background:#fff;border-radius: 5px;" id="divvideo">
				<form action="CheckInOut.php" method="post" class="form-horizontal" style="border-radius: 5px;padding:10px;background:#fff;" id="divvideo">
						<i class="glyphicon glyphicon-qrcode"></i> <label>Türkiye GB QR</label> <p id="time"></p>
					<input type="text" name="idenity_number" id="text" class="form-control" autofocus>
				</form>
				<video id="preview" width="100%" height="50%" style="border-radius:10px;"></video>
				<br>
				<br>
				<?php
				if(isset($_SESSION['error'])){
					echo "
					<div class='alert alert-danger alert-dismissible' style='background:red;color:#fff'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-warning'></i> Hata!</h4>
						".$_SESSION['error']."
					</div>
					";
					unset($_SESSION['error']);
				}
				if(isset($_SESSION['success'])){
					echo "
					<div class='alert alert-success alert-dismissible' style='background:green;color:#fff'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Başarılı!</h4>
						".$_SESSION['success']."
					</div>
					";
					unset($_SESSION['success']);
				}
				?>

			</div>
			
		</div>
					
	</div>
	<script>
		let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
		Instascan.Camera.getCameras().then(function(cameras){
			if(cameras.length > 0 ){
				scanner.start(cameras[0]);
			} else{
				alert('No cameras found');
			}

		}).catch(function(e) {
			console.error(e);
		});

		scanner.addListener('scan',function(c){
			document.getElementById('text').value=c;
			document.forms[0].submit();
		});
	</script>
	<script type="text/javascript">
	var timestamp = '<?=time();?>';
	function updateTime(){
		$('#time').html(Date(timestamp));
		timestamp++;
	}
	$(function(){
		setInterval(updateTime, 1000);
	});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script></body>
</html>