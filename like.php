<?php

include "operation.php";
    session_start();  
    
    $user= new user();

    if(isset($_POST)){
    	
    	$share_id=$_POST['share_id'];
    	$status=$_POST['status'];
    	$user_id=$_POST['user_id'];
    	
    	$like =$user->likes($user_id,$status,$share_id);

   	echo $like['success']['0']['no'];
	

}
else
{
	echo "no post";
}

?>