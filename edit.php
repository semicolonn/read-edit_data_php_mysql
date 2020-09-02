<?php

	$c= mysqli_connect("localhost","root","","editphp");
	if (!$c) {
		echo "Not connected to database!";
	}

	$flag=false;

	//EDIT THE RECORD
	if (isset($_POST['ed'])) {
		$id=$_POST['ed'];
		$flag= true;
		$q="SELECT* FROM edit WHERE id=$id";

		$r=mysqli_query($c, $q);

		if (mysqli_num_rows($r)>0) {
			$recd=mysqli_fetch_array($r);
			$un=$recd['NAME'];
			$CC=$recd['CONTACT'];
		}
	}


?>



<!DOCTYPE html>
<html>
<head>
	<title>Edit</title>
</head>
<body>
	<h2>Edit and Read of the data with database</h2>
	<form action="" method="POST">
		<?php if($flag==false):?>
			<input type="text" name="username" value="" placeholder="Name">
			<input type="text" name="contact" value="" placeholder="Contact">
		<?php else: ?>

			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="text" name="username" value="<?php echo $un; ?>">
			<input type="text" name="contact" value="<?php echo $CC; ?>">
		<?php endif?>
		<?php if($flag==true): ?>
			<button name="update">Update</button>
		<?php else: ?>
			<button name="save">Save</button>

		<?php endif ?>

<table border="2">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Contact</th>
		<th>Actions</th>

	</tr>


<?php
	

	if (isset($_POST['save'])) {
		
		$n=$_POST['username'];
		$ct=$_POST['contact'];

		$s="INSERT INTO edit VALUES(NULL,'$n',$ct)";
		$r=mysqli_query($c,$s);
		if ($r) {
			echo "Record added!";
		}

	}
	elseif (isset($_POST['update'])) {
		$id=$_POST['id'];
		$name=$_POST['username'];
		$contact=$_POST['contact'];

		if(mysqli_query($c, "UPDATE edit SET NAME='$name', CONTACT=$contact WHERE id=$id")){
			echo "Record ID# " . " ". $id. " updated!";
		}


	}

	echo "<hr>";

	$s="SELECT* FROM edit";
	$r=mysqli_query($c, $s);
	if (mysqli_num_rows($r)>0) {
		while ($row=mysqli_fetch_array($r)) {
			

			?>


	<tr>
		<td><?php echo $row['id']; ?></td>
		<td><?php echo $row['NAME']; ?></td>
		<td><?php echo $row['CONTACT']; ?></td>
		<td><button name="ed" value="<?php echo $row['id']?>">Edit</button></td>
	</tr>



			<?php
		}
	}

?>

</table>
	</form>


</body>
</html>