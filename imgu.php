<?php
	error_reporting(0);
	$con=mysqli_connect("localhost","root","","abc");

	if(isset ($_POST['submit']))
	{

		$error=array();

		$img=array
		(
			'image/png',
			'image/jpg',
			'application/docx',
			'application/doc',
			'application/PDF',
			'application/xls',
			'application/xlsx',
			'application/mswrd',
		);


		$namea=$_POST['namea'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$gender=$_POST['gender'];
		$hobby=implode(',',$_POST['hobby']);
		$address=$_POST['address'];
		$city=$_POST['city'];

		$name=$_FILES['img']['name'];
		$type=$_FILES['img']['type'];
		$size=$_FILES['img']['size'];
		$tmp_name=$_FILES['img']['tmp_name'];


		if($size >= 1000000 || $size == 0)
		{
			$error[] = "Image Size too large. File must be less than 2mb megabytes.$size"; 
		}

		if(in_array($type,$img))
		{
			$error[] = "Invalid Type.$type";
		}

		if(count($error) == 0)
		{
			$rnd = mt_rand(1,99999);
			$fnm = "img". $rnd . $name;
			$lfile = str_replace(' ','_',$fnm);
			move_uploaded_file($tmp_name,'img/'.$lfile);
			$insert=mysqli_query($con,"insert into `table2` (`name`,`email`,`password`,`gender`,`hobby`,`address`,`city`,`img`)values('$namea','$email','$password','$gender','$hobby','$address','$city','$name')");

			

			if($insert)
			{
				echo "<script>alert('sucessfully upload');</script>";
		}
			}
		else
		{
			foreach($error as $err)
		{
			echo "<script>alert('$err');</script>";
			echo "<script type='text/javascript'></script>";	
			echo"window.location.href=('imgu.php')</script>";
			
		}
		die();
		}

		/*if()
		{
			$id=$_GET['id'];
			$select=mysqli_query($con,"select * from `table2` where id='".$id."'");
			$row=mysqli_fetch_array($select);
			$name=$row['img'];
			unlink("upload/" . $img);
	
			$delete=mysqli_query($con,"delete from `table2` where id='".$id."'");
	
			echo "<script type='text/javascript'></script>";
			echo "window.location='imgu.php'</script>";
	
		}*/ 



		
		if($insert)
		{
			echo "success";

		}
		else
		{                                                                                         
			echo "error";
		}

	}
?>
<form method="POST" enctype="multipart/form-data">
	<input type="text" name="namea" placeholder="Enter your name">
	<input type="text" name="email" placeholder="Enter your email">
	<input type="password" name="password" placeholder="password">
	<input type="radio" name="gender" value="male">male
	<input type="radio" name="gender" value="femae">female
	<input type="checkbox" name="hobby[]" value="php">php
	<input type="checkbox" name="hobby[]" value="java">java
	<textarea name="address" rows="5" placeholder="address"></textarea>
	<select name="city">
		<option value="select city"></option>
		<option value="Ahmedabad">Ahmedabad</option>
		<option value="Surat">Surat</option>
		<option value="Vapi">Vapi</option>
	</select>


	<input type="file" name="img" placeholder="select image">

	<input type="submit" name="submit" value="submit">

</form>