<?php 
session_start();
if (isset($_POST['user']))
	$_SESSION['user'] = $_POST['user'];
if (!$_SESSION['user'])
	header("Location: auth.php");
require_once('../Manipulators/Managment.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	
</head>
<body><!-- Home page -->
	<?php echo '<h1>'.$_SESSION['user'].'</h1>'; 
	echo "<form action='Home.php' method='post'>
			<input type='hidden' name='user' value=''>
			<input type='submit' value='Sign out'>
		</form>
	"?> 
	<form action = "../Manipulators/TaskCreate.php" method="post">
		<select size="1" name="status">
			<option value="1">Finished</option>
			<option selected value="2">Not finished</option>
		</select>
		<p><input type="text" placeholder="priority" name="priority" value=""></p>
		<p><input type="date" placeholder="deadline" name="deadline" value="2023-12-12" id="calendarForTasks"></p>
		<p><input type="text" placeholder="title" name="title" required></p>
		<p><input type="submit" onclick="alert('Задача создана');return true;" value="Create"></p>
	</form>
	<script type="text/javascript">
		function showCurrentDate(){
			var d = new Date(),
			new_value=d.toISOString().slice(0,10);
			document.getElementById("calendarForTasks").value=new_value;
		}
		showCurrentDate();
	</script>
	<form action="../Manipulators/TextFileExport.php" method="post">
		<input type="hidden" name="export">
		<input type="submit" value="Export">
	</form>
	<form action="../Manipulators/TextFileImport.php" method="post" enctype="multipart/form-data">
	    <input type="file" name="fileToImport">
	    <input type="submit" name="import" value="Import">
	</form>
	<form action="ProjectCreate.php" method="post">
		<button>Create project</button>
	</form>
	<?php 
	output_of_projects();
	?>
	<center><?php 
	
	if (isset($_GET['project_id']))
		output_of_tasks_by_project($_GET['project_id']);
	else  
		output_of_tasks();
	?></center>

</body>
</html>