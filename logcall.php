<?php 
	require_once 'db.php';
	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	$sql = "SELECT * FROM incident_type";
	$result = $conn->query($sql);
	$incidentTypes = [];
	while ($row = $result->fetch_assoc()) {
		$id = $row['incident_type_id'];
		$type = $row['incident_type_desc'];
		$incidentType = ["id" => $id, "type" => $type];
		array_push($incidentTypes, $incidentType);
	}
	$conn->close()
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Log Call</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript">
		function validateForm()
		{
			//callername
			var a=document.forms["frmLogCall"]["callerName"].value;
			if (!isNaN(a))
				{
					alert("Caller name cannot be number");
					return false;				
				} else if (a.length > 30) {
					alert("Enter Shorter Caller Name");
					return false;
				}
			// contactNo
			var b = document.forms["frmLogCall"]["contactNo"].value;
			if (b==null || b=="")
				{
					alert("Contact Number is required.");
					return false;
				} else if (b.length != 8 || isNaN(b)){
					alert("Enter Valid Contact Number")
					return false;
				}
			//location
			var c = document.forms["frmLogCall"]["locationofIncident"].value;
			if (c==null || c=="")
				{
					alert("Location is required.");
					return false;
				} else if (c.length > 50) {
					alert("Enter Shorter Location")
					return false;
				}
			//type
			var d = document.forms["frmLogCall"]["typeofIncident"].value;
			if (!d) {
				alert("Choose type of inncident");
				return false;
			}
			//descriptionofIncident
			var e = document.forms["frmLogCall"]["descriptionofIncident"].value;
			if (e==null || e=="") {
				alert("Write a short Description");
				return false;
			} else if ( e.length > 100) {
				alert("Write a shorter Description");
				return false;
			}
		}
	</script>
</head>
<body>
	<div class="container" style="width: 80%;">
		<!--use php to include header image and nav from nav.php-->
		<?php require_once 'nav.php';?>
		<!--create web form-->
		<section style="margin-top: 20px;">
			<form name="frmLogCall" action="dispatch.php" method="post" onsubmit="return validateForm()">
				<!--Caller name-->
				<div class="form-group row">
					<label for="callerName" class="col-sm-4 col-form-label">Caller's name</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="callerName" name="callerName">
					</div>
				</div>
				<!--Contact NO-->
				<div class="form-group row">
					<label for="contactNo" class="col-sm-4 col-form-label">Contact Number (Required)</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="contactNo" name="contactNo">
					</div>
				</div>
				<!--Location-->
				<div class="form-group row">
					<label for="locationofIncident" class="col-sm-4 col-form-label">Location of Incident (Required)</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="locationofIncident" name="locationofIncident">
					</div>
				</div>
				<!--Type-->
				<div class="form-group row">
					<label for="typeofIncident" class="col-sm-4 col-form-label">Type of Incident (Required)</label>
					<div class="col-sm-8">
						<select id="typeofIncident" class="form-control" name="typeofIncident">
							<option value="">Select
							</option>
							<?php
								for ($i=0; $i < count($incidentTypes); $i++) { $incidentType = $incidentTypes[$i];
									echo '<option value="' . $incidentType['id'] . '">' . $incidentType['type'] . '</option>';
								}
							?>
						</select>
					</div>
				</div>
				<!--Description-->
				<div class="form-group row">
					<label for="descriptionofIncident" class="col-sm-4 col-form-label">Description of Incident (Required)</label>
					<div class="col-sm-8">
						<textarea class="form-control" rows="5" id="descriptionofIncident" name="descriptionofIncident"></textarea>
					</div>
				</div>
				<!--submit-->
				<div class="form-group row">
					<div class="col-sm-4"></div>
					<div class="col-sm-8" style="text-align: center;">
						<input class="btn btn-primary" type="submit" name="btnProcessCall" value="Process Call">
						<input class="btn btn-primary" type="reset" name="btnReset" value="Reset">
					</div>
				</div>
			</form>
		</section>
		<footer class="page-footer font-small blue pt-4 footer-copyright text-center py-3"> &copy; 2021 Copyright</footer>
	</div>
	<script type="text/javascript" src="js/jquery-3.5.0.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
</body>
</html>