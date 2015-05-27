<?php
include "operation.php";
    session_start();  
    
    $user= new user();
   // $comment=$user->comment($_GET['share_id']);
    
if(isset($_POST)){
	$share_id=$_POST['share_id'];
	$comment=$_POST['comment'];
$user_id=$user->comment_post($share_id,$comment,$_SESSION['email']);

echo "$comment||$_SESSION[email]";

}
	
?>

