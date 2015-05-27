<?php
include "operation.php";
    session_start();


$user=new user();
$output="";
if(isset($_POST['submit'])){
	$group=$user->create_group($_POST['g_name'],$_POST['group_id'],$_SESSION['email']);

	if(is_array($group)){
		if(isset($group['success'])){

			$_SESSION['group_name']=$_POST['g_name'];
			$_SESSION['group_id']=$_POST['group_id'];

			header('Location:group_admin.php');

		}
		else if(isset($group['error'])){
			$output=$group['error'];
		}
	}
}


?>
<html>
<body>
	<form action="group_reg.php" method="POST">

		<?php echo $output; ?>
		Enter your group name<input type="text" name='g_name'>
		Enter your group Email_id<input type="text" name="group_id">
		<input type="submit" name="submit">
	</form>
</body>

</html>