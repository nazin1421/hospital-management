<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

if(isset($_POST['submit']))
{	
	$docid=$_SESSION['id'];
	$patname=$_POST['patname'];
	$patcontact=$_POST['patcontact'];
	$patemail=$_POST['patemail'];
	$gender=$_POST['gender']; 
	$cabin_type=$_POST['cabin_type'];
	$c_number=$_POST['c_number'];
	$day=$_POST['day'];	
	$pataddress=$_POST['pataddress'];
	$patage=$_POST['patage'];
	$medhis=$_POST['medhis'];

	$query ="select * from  tblpatient where c_number='$c_number'";
    $query_check = mysqli_query($con,$query);


if(mysqli_num_rows($query_check)<1)
{
	$query2="select * from cabin where Cabin_No='$c_number'";
	$query_check2 = mysqli_query($con,$query2);
	$value= mysqli_fetch_assoc($query2);
	$available=$value['avail'];
	if($available==0)
	{
		$sql=mysqli_query($con,"insert into tblpatient(Docid,PatientName,PatientContno,PatientEmail,PatientGender,cabin_type,c_number,day,PatientAdd,PatientAge,PatientMedhis) values('$docid','$patname','$patcontact','$patemail','$gender','$cabin_type','$c_number','$day','$pataddress','$patage','$medhis')");

		if($sql)
		{
			$sql1=mysqli_query($con,"Update cabin set avail=avail+1 where Cabin_No ='$c_number'");
		    $sql2=mysqli_query($con,"Update cabin_type set total_cabin=total_cabin-1 where cabin_type ='$cabin_type'");
			echo"
		    <script>
		    alert ('patient successfully added');
		    window.location.href='add-patient.php';
		    </script>
		    ";


		}
		
	}
	else
	{
	    echo"
	    <script>
	    alert ('Cabin number patient added');
	    window.location.href='add-patient.php';
	    </script>
	    ";

}
}
else
{

	echo"
    <script>
    alert ('Cabin number patient added');
    window.location.href='add-patient.php';
    </script>
    ";
}

}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor | Add Patient</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />

	<script>
		function userAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_availability.php",
		data:'email='+$("#patemail").val(),
		type: "POST",
		success:function(data){
		$("#user-availability-status1").html(data);
		$("#loaderIcon").hide();
		},
		error:function (){}
		});
		}
	</script>
	</head>
	<body>
		<div id="app">		
			<?php include('include/sidebar.php');?>
			<div class="app-content">
			<?php include('include/header.php');?>
									
			<div class="main-content" >
			<div class="wrap-content container" id="container">
									
			<section id="page-title">
			<div class="row">
			<div class="col-sm-8">
			<h1 class="mainTitle">Patient | Add Patient</h1>
			</div>
			<ol class="breadcrumb">
			<li>
			<span>Patient</span>
			</li>
			<li class="active">
			<span>Add Patient</span>
			</li>
			</ol>
			</div>
			</section>
			<div class="container-fluid container-fullw bg-white">
			<div class="row">
			<div class="col-md-12">
			<div class="row margin-top-30">
			<div class="col-lg-8 col-md-12">
			<div class="panel panel-white">
			<div class="panel-heading">
			<h5 class="panel-title">Add Patient</h5>
			</div>
			<div class="panel-body">
			<form role="form" name="" method="post">

			<div class="form-group">
			<label for="doctorname">
			Patient Name
			</label>
			<input type="text" name="patname" class="form-control"  placeholder="Enter Patient Name" required="true">
			</div>
			<div class="form-group">
			<label for="fess">
			 Patient Contact no
			</label>
			<input type="text" name="patcontact" class="form-control"  placeholder="Enter Patient Contact no" required="true" maxlength="11" pattern="[0-9]+">
			</div>
			<div class="form-group">
			<label for="fess">
			Patient Email
			</label>
			<input type="email" id="patemail" name="patemail" class="form-control"  placeholder="Enter Patient Email id" required="true" onBlur="userAvailability()">
			<span id="user-availability-status1" style="font-size:12px;"></span>
			</div>
			<div class="form-group">
			<label class="block">
			Gender
			</label>
			<div class="clip-radio radio-primary">
			<input type="radio" id="rg-female" name="gender" value="female" >
			<label for="rg-female">
			Female
			</label>
			<input type="radio" id="rg-male" name="gender" value="male">
			<label for="rg-male">
			Male
			</label>
			</div>
			</div>
	        <div class="form-group">
				<label for="cabin_type">
					Cabin Type
				</label>
				<select name="cabin_type" class="form-control" onChange="getdoctor(this.value);" required="required">
					<option value="">Select Cabin type</option>
<?php $ret=mysqli_query($con,"select * from cabin_type");
while($row=mysqli_fetch_array($ret))
{
?>
					<option value="<?php echo htmlentities($row['cabin_type']);?>">
						<?php echo htmlentities($row['cabin_type']);?>
					</option>
					<?php } ?>
																
				</select>
			</div>

			<div class="form-group">
			<label for="doctorname">
			Cabin Number
			</label>
			<input type="text" name="c_number" class="form-control"  placeholder="Enter a cabin number" required="true">
			</div>
			<div class="form-group">
			<label for="doctorname">
			Day
			</label>
			<input type="text" name="day" class="form-control"  placeholder="" required="true">
			</div>
			<div class="form-group">
			<label for="address">
			Patient Address
			</label>
			<textarea name="pataddress" class="form-control"  placeholder="Enter Patient Address" required="true"></textarea>
			</div>
			<div class="form-group">
			<label for="fess">
			 Patient Age
			</label>
			<input type="text" name="patage" class="form-control"  placeholder="Enter Patient Age" required="true">
			</div>
			<div class="form-group">
			<label for="fess">
			 Medical History
			</label>
			<textarea type="text" name="medhis" class="form-control"  placeholder="Enter Patient Medical History(if any)" required="true"></textarea>
			</div>	

			<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
			Add
			</button>
			</form>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="col-lg-12 col-md-12">
			<div class="panel panel-white">
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>				
			</div>
			</div>
			</div>
			
<?php include('include/footer.php');?>
			
		
		
<!-- <?php include('include/setting.php');?>
 -->			
			
		</div>
		
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		
		<script src="assets/js/main.js"></script>
		
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		
	</body>
</html>
