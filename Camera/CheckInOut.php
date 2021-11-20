<?php
    session_start();

    $server = "188.165.199.48";
    $username="genclikd_portal";
    $password="9nc5iX?2";
    $dbname="genclikdunyasi_2021_db";
    $conn = new mysqli($server,$username,$password,$dbname);
	$conn -> set_charset("utf8");

    if($conn->connect_error){
        die("Connection failed" .$conn->connect_error);
    }

    if(isset($_POST['idenity_number'])){
        
        $idenity_number = base64_decode($_POST['idenity_number']);

		$sql = "SELECT * FROM `go_giriskarti` WHERE `tc_no` = '$idenity_number'";
		$query = $conn -> query($sql);

		if($query -> num_rows < 1){
			$_SESSION['error'] = 'T.C. Kimlik Numarası Bulunamadı!s ';
		}
		else{
			$sql ="SELECT first_name,last_name FROM `Wo_Users` WHERE `tc_no` = '$idenity_number'";
			$query=$conn->query($sql);
			$row = $query -> fetch_assoc();
			
			if($query-> num_rows > 0){
			//$sql = "UPDATE attendance SET TIMEOUT='$time', STATUS='1' WHERE STUDENTID='$studentID' AND LOGDATE='$date'";
			//$query=$conn->query($sql);
			$_SESSION['success'] = 'Katılım Teyidi Onaylandı: '.$row['first_name'].' '.$row['last_name'].' '.$idenity_number;
			}else{$_SESSION['error'] = 'T.C. Kimlik Numarası Bulunamadı! ';}
			//}else{
			//		$sql = "INSERT INTO attendance(STUDENTID,TIMEIN,LOGDATE,STATUS) VALUES('$studentID','$time','$date','0')";
			//		if($conn->query($sql) ===TRUE){
					 //$_SESSION['success'] = 'Katılım Teyidi Onaylandı: '.$idenity_number;
			// }else{
			 // $_SESSION['error'] = $conn->error;
		   //}	
		//}
		}

	}else{
		$_SESSION['error'] = 'QR Code Okutun.';
}
header("location: index.php");
	   
$conn->close();
?>