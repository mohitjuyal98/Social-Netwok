<?php
include "connection.php";

require 'vendor/autoload.php';
use Respect\Validation\Validator as v;

class user
{
	function create_user($username,$firstname,$lastname,$password,$repass,$email,$gender,$dob,$location)
	{
		$firstname1=v::alnum()->notEmpty()->validate($fname); //validation for name
		$lastname1=v::alum()->notEmpty()->validate($lname); //validation for last name
		$email1=v::email()->notEmpty()->validate($email); //validation for email
		$username1=v::string()->notEmpty()->validate($user); //validation for user
		$password1=v::string()->notEmpty()->validate($password);
		$dob=v::date()->notEmpty()->validate($dob);
		if ($firstname1 && $lastname && $email && $username && $password1){

			if(!strcmp($password,$repass) && strlen($password)>4){

				$result=mysql_query("insert into personal(firstname,lastname,email,username,password,$gender,$dob) values('$firstname','$lastname','$email','$username','$password',$dob)") or die (mysql_error());
			  try
			  {
			    if(mysql_affected_rows()==1)//query execute in database
			    {
			     
			      return array('success'=>'data add successfully'); //return sucess message if condition satisfy.
			    }
			    else
			    {
			      return array('error'=>'data not insert  sucessfully');//return error message if condition not satisfy.
			    }
			  }

			  catch(Execption $e) 
			  {
			  
			    return array('error'=>'data not able to insert  sucessfully');
			  }
			}
			}
			else
			{
			  return array('error'=>' please fill data correctly');
			}
			}

	function login($email,$password)
	{
		$email1=v::email()->notEmpty()->validate($email);
		$password1=v::string()->notEmpty()->validate($password);

		if($email1 && $password1)
		{
		$result = mysql_query("SELECT * FROM login where email='$email' and password='$password'")or die(mysql_error());
		 if(mysql_num_rows($result)>0)
		 {
		 if($row = mysql_fetch_assoc($result))
		  {
		    
		    return array("success"=>$row);
			}
		}
	}
		  else
		  {
		  return array("error"=>"Invalid username or password");
		  
		  }

	}

	function update($firstname,$lastname,$email,$dob,$location)
	{
		$firstname1=v::alnum()->notEmpty()->validate($fname); //validation for name
		$lastname1=v::alum()->notEmpty()->validate($lname); //validation for last name
		$email1=v::email()->notEmpty()->validate($email); //validation for email
		$username1=v::string()->notEmpty()->validate($user); //validation for user
		$dob=v::date()->notEmpty()->validate($dob);
		$location =v::string()->notEmpty()->validate($location);
		if ($firstname1 && $lastname && $email && $username && $password1){


		}

	}

	function upload($file,$id)
	{
		 $arr=array("image/jpeg","image/png","image/gif","image/jpg");
       $r=$file['file']['type'];


    if(($file['file']['size'])<1024*2024 && in_array($r,$arr)){

		    $f=$_FILES['upload']['name'];
			echo "$f";
		 if(move_uploaded_file($_FILES['upload']['tmp_name'],"C:/xampp-win32-1.8.2-2-VC9/xampp/htdocs/new/upload/$f")) 
		 {
		 mysql_query("update personal set image='$f'  where username ='$user'");
		 return array("success"=>"The file has been uploaded");
		 } 
	 }// End of move... IF.

		  else 
		 { // Invalid type.
		 return array("error"=>"Please upload aJPEG,PNG image");
	 }
	
	}
	function search($name,$location=false)
	{
		$result=mysql_query("select * from personal where name='$name' or location='$location'");
		if(!$result)
		{
		if(mysql_num_rows($result)>0)
		{
			while($row=mysql_fetch_assoc($result))
			{
				$arr[]=$row;
			}

			return array("success"=>$arr);

		}
	}
		else
		{
			return array("error"=>"result not found");
		}


	} 



function frs($id,$user_id)
{
	$result=mysql_query("insert into frs(req_by,req_to,status) values('$user_id','$id','pending')");

			try
			  {
			    if(mysql_affected_rows()==1)//query execute in database
			    {
			     
			      return array('success'=>'data add successfully'); //return sucess message if condition satisfy.
			    }
			    else
			    {
			      return array('error'=>'data not insert  sucessfully');//return error message if condition not satisfy.
			    }
			  }

			  catch(Execption $e) 
			  {
			  
			    return array('error'=>'data not able to insert  sucessfully');
			  }
			}

			function action($action,$req_by,$req_to)
			{
				if($action=="approve")
				{
				$result =mysql_query("update  frs set status='approved' where req_by='$rep_by' and  req_to='$req_to'");
				return array("success"=>"add");
			}
			else if($action=="reject"){
			
				$result=mysql_query("delete form frs where req_by='$rep_by' and  req_to='$req_to'");
			}

			}
			

			function fri_list($user_id)
			{
				//$result1[]=new array();
				$result=mysql_query("select req_by from frs where req_to='$user_id' and status ='approve'");
				if(mysql_num_rows($result)>0)
				{
					while($row=mysql_fetch_assoc($result))
						$arr[]=$row;
					for($i=0;$i<count($arr);$i++){
					$result1[$i]=mysql_query("select name from personal where id=$arr[$i]");
				}

					return array("success"=>$result1);

				}	
				else
				{
					return array("error"=>"not found");

				}

			}

			function req_list()
			{
				$result=mysql_query("select req_by form frs where req_to='$user' and status='pending'");
				if(mysql_num_rows($result)>0)
				{
					while($row=mysql_fetch_assoc($result))
						$arr[]=$row;
					for($i=0;$i<count($arr);$i++){
					$result1=mysql_query("select name from personal where id=$arr[i]");
					$arr1[$i]=mysqli_fetch_array($result1);
				}
					
					return array("success"=>$arr1);

				}	
				else
				{
					return array("error"=>"not found");

				}

			}

			function share($user_id,$type)
			{
				if($type='text')
				{
				$result=mysql_query("insert into share(share_by,text) values('$user','$type')");
				if(mysql_affected_rows()>0)
				{
					return array("success"=>"successfully");
				}
				else
				{
					return array("error"=>"error");

				}
			}
			else if($type='image')
			{
				$result=mysql_query("insert into share(share_by,image) values('$user','$type')");
				if(mysql_affected_rows()>0)
				{
					return array("success"=>"successfully");
				}
				else
				{
					return array("error"=>"error");

				}
			}
		}


		function show($user_id)
		{
			$result=mysql_query("select req_by from frs where req_to='$user_id' and status ='approve'");

			while($row=mysql_fetch_assoc($result))
				$arr[]=$row;

			foreach($arr as $value){
				$result1=mysql_query("SELECT distinct share.share_id FROM SHARE JOIN COMMENT WHERE comment.share_id =share.share_id AND share.share_by =$value[req_by]");

			while($row1=mysql_fetch_array($result1))
				$result2=mysql_query("select share.share_text,share.share_image,comment.comment,comment.comment_by from comment,share where comment.shere_id=$row1[share_id] and share.share_id=$row[share_id]");

			while($row=mysql_fetch_assoc($result2)){
				$arr[]=$row;

			return array("success"=>$arr);
			}
		}

	}
	
}

?>