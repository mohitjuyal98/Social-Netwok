<?php
/*Total number of function :-32
1.create_user
2.login
3.update
4.delete
5.upload
6.search
7.friend_request_send
8.action
9.fri_list
10.request_list
11.share
12.show
13.post comment.
14.comment_access
15.user_info.
15.message_send
16.message_box
17.create group.
18.join group.
19.show_group.
20.group_share.
21.group_update
22.New message.(notification )
23.group_info.
24*/



include "connection.php";

require 'vendor/autoload.php';
use Respect\Validation\Validator as v;

class user
{
	function create_user($firstname,$lastname,$password,$repass,$email,$gender,$dob,$status)
	{
		$firstname1=v::string()->notEmpty()->validate($firstname); //validation for name
		$lastname1=v::string()->notEmpty()->validate($lastname); //validation for last name
		$email1=v::email()->notEmpty()->validate($email); //validation for email
		
		$password1=v::string()->notEmpty()->validate($password);

		$dob1=v::date()->notEmpty()->validate($dob);
		if ($firstname1 && $lastname1 && $email1  && $password1 && $dob1){

			if(!strcmp($password,$repass) && strlen($password)>4){


				$result3=mysql_query("select * from personal where email='$email'");

				if(mysql_num_rows($result3)>0)
				{
					return array("error"=>"email _id already taken");
				}

				$password=md5($password);

				$result=mysql_query("insert into personal(First_name,Last_name,Email,Password,Gender,dob,account_status) values('$firstname','$lastname','$email','$password','$gender','$dob','$status')") or die (mysql_error());
				$result1=mysql_query("insert into setting (email)values('$email')") or die(mysql_error());
			  try
			  {
			    if(mysql_affected_rows()==1)//query execute in database
			    {
			    	$result=mysql_query("insert into login(email,password) values('$email','$password')") or die (mysql_error());			     

			      return array('success'=>'Your acccout create successfully'); //return sucess message if condition satisfy.
			    }
			    else
			    {
			      return array('error'=>'All fields are required');//return error message if condition not satisfy.
			    }
			  }

			  catch(Execption $e) 
			  {
			  
			    return array('error'=>'Exception');
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

			$password=md5($password);
		$result = mysql_query("SELECT * FROM login where email='$email' and password='$password'")or die(mysql_error());
		 if(mysql_num_rows($result)>0)
		 {
		 if($row = mysql_fetch_assoc($result))
		  {
		  	$result1=mysql_query("update personal set account_status='yes' where email='$email'") or die(mysql_error());		    
		    return array("success"=>$row);
			}
		}
	}
		  else
		  {
		  return array("error"=>"Invalid username or password");
		  
		  }

	}

	function update($firstname,$lastname,$password,$gender,$current,$home,$country,$repass,$education,$dob,$email,$sign)
	{
		$firstname1=v::string()->notEmpty()->validate($firstname); //validation for name
		$lastname1=v::string()->notEmpty()->validate($lastname); //validation for last name
		//$password1=v::string()->notEmpty()->validate($password); //validation for email
		$current1=v::string()->validate($current); //validation for user
		$dob1=v::date()->validate($dob);
		$home1 =v::string()->validate($home);
		$education1=v::string()->validate($education);
		if ($firstname1 && $lastname1 && $current1 && $dob1 && $home1 && $education1){

			$repass=md5($repass);			

			if(!strcmp($password,$repass) && strlen($password)>4){

				$result=mysql_query("update personal set First_Name='$firstname',Last_Name='$lastname',Password='$password',gender='$gender',Current_city='$current',Hometown='$home',Education='$education',dob='$dob', country='$country',sign='$sign' where email='$email'  ") or die(mysql_error());
		}

		else{
			return array("error"=>"please check password");
		}


	}
	else
	{
		return array("error"=>"Wrong data");
	}
}
	function upload($file,$email)
	{
		 $arr=array("image/jpeg","image/png","image/gif","image/jpg");
       $r=$file['file']['type'];
   
    if(in_array($r,$arr)){

		    $f=$file['file']['name'];
			echo "$f";
		 if(move_uploaded_file($file['file']['tmp_name'],"upload/$f")) 
		 {
		 mysql_query("update personal set pic='upload/$f'  where email ='$email'")or die(mysql_error());
		 return array("success"=>"The file has been uploaded");
		 } 
	 }// End of move... IF.

		  else 
		 { // Invalid type.
		 return array("error"=>"Please upload aJPEG,PNG image");
	 }
	
	}
	function search($name=false,$email=false)

	{
	
		$result=mysql_query("select * from personal where First_Name='$name' and in_search_result='yes' or email='$email' ") or die(mysql_error());

		if($result)
		{

		if(mysql_num_rows($result)>0) 
		{
			while($row=mysql_fetch_assoc($result))
			{
				$arr[]=$row;
			}

			
		}
	}

	if(isset($arr)){

		return array("success"=>$arr);

	}
		else
		{
			return array("error"=>"Result not found");
		}


	} 



function frs($id,$user_id)
{

	$result=mysql_query("insert into friend(fri_by,fri_to,fri_status) values('$user_id','$id','pending')") or die(mysql_error());

			try
			  {
			    if(mysql_affected_rows()==1)//query execute in database
			    {
			     
			      return array('success'=>'friend request send successfully'); //return sucess message if condition satisfy.
			    }
			    else
			    {
			      return array('error'=>'friend request not send');//return error message if condition not satisfy.
			    }
			  }

			  catch(Execption $e) 
			  {
			  
			    return array('error'=>'unable to send reuest due to some problem');
			  }
			}

		function action($action,$fri_by,$fri_to)
			{
				if($action=="approve")
				{

				$result =mysql_query("update  friend set fri_status='approve' where fri_by='$fri_by' and  fri_to='$fri_to'") or die(mysql_error());
				$result1=mysql_query("insert into friend (fri_by,fri_to,fri_status)values('$fri_to','$fri_by','approve')")or die(mysql_error());
				return array("success"=>"add");
			}
			elseif($action=="reject"){
			
				$result=mysql_query("delete from friend where fri_status='$rep_by' and  fri_by='$req_to'")or die(mysql_error());
			}

			}
			

			function fri_list($user_id)
			{
				//$result1[]=new array();
				$result=mysql_query("select fri_by from friend where fri_to='$user_id' and fri_status ='approve'")or die(mysql_error());
				if(mysql_num_rows($result)>0)
				{
					while($row=mysql_fetch_assoc($result))
						$arr[]=$row;
					foreach($arr as $value) {
											
					$result1=mysql_query("select * from personal where email='$value[fri_by]'");
					while ($row=mysql_fetch_assoc($result1))
						$arr1[]=$row;
				}

					return array("success"=>$arr1);

				}	
				else
				{
					return array("error"=>"No friend ");

				}

			}

			function req_list($email)
			{
				$result=mysql_query("select fri_by from friend where fri_to='$email' and fri_status='pending'") or die(mysql_error());
				if(mysql_num_rows($result)>0)
				{
					while($row=mysql_fetch_assoc($result))
						$arr[]=$row;					

					foreach($arr as $value){
						$result1=mysql_query("select * from personal where Email='$value[fri_by]'");
					while ($row=mysql_fetch_assoc($result1))
						$arr1[]=$row;

					//print_r($arr);

					
				}	
				return array("success"=>$arr1);
							
			}
			else
			{
				
				return array("error"=>"No friend request found");
		}
		}

			function share($email,$file,$type,$label=false)
			{

				$image=array("image/jpeg","image/png","image/gif","image/jpg");
				$video=array("video/mp4","video/avi");
				$both=array("image/jpeg","image/png","image/gif","image/jpg","video/mp4","video/avi");

				if(isset($file))
					$r=$file['file']['type'];

				if($type=='text'){

				$result=mysql_query("insert into share(share_by,share_text) values('$email','$file')") or die(mysql_error());

				$result1=mysql_query("select share_id from share where share_by='$email' ORDER BY share_id DESC LIMIT 1")or die(mysql_error());
				if($row=mysql_fetch_assoc($result1))
				$result2=mysql_query("insert into comment(share_id)values('$row[share_id]')")or die(mysql_error());
			$result3=mysql_query("insert into likes(share_id) values('$row[share_id]')") or die(mysql_error());
				if(mysql_affected_rows()>0){ 

					return array("success"=>"successfully");
				}
				else{

					return array("error"=>"error");

				}
			}
			else if($type=='image')	{
			    			     	 
      			    $f=$file['file']['name'];

      			    $f = str_replace(' ', '', $f);

   				 if(in_array($r,$both)){
		    		
		 			if(move_uploaded_file($file['file']['tmp_name'],"image/$f")){	

		 			if(in_array($r,$image)){
		 			 $result=mysql_query("insert into share(share_by,share_pic,label) values('$email','$f','$label')")or die(mysql_error());
		 			 
		 			 		 			}
		 			else if (in_array($r,$video))
		 			{
		 				$result=mysql_query("insert into share(share_by,share_video,label) values('$email','$f','$label')")or die(mysql_error());

		 			}
		 			 $result1=mysql_query("select share_id from share where share_by='$email' ORDER BY share_id DESC LIMIT 1")or die(mysql_error());
				if($row=mysql_fetch_assoc($result1))
				$result2=mysql_query("insert into comment(share_id)values('$row[share_id]')")or die(mysql_error());
				$result3=mysql_query("insert into likes(share_id) values('$row[share_id]')") or die(mysql_error());

 
		 		
		 				return array("success"=>"The file has been uploaded");
		 		} 
		 	}

		  		else  { 
		 					return array("error"=>"Please upload aJPEG,PNG image");
		 			}

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


		function last_post($email){



		} 


		function show($email)
		{
			$result2;
			$result=mysql_query("select fri_by from friend where fri_to='$email' and fri_status ='approve'") or die(mysql_error());

			while($row=mysql_fetch_assoc($result))
				$arr[]=$row;

				
			foreach($arr as $value){
				$result1=mysql_query("SELECT distinct share.share_id FROM SHARE JOIN COMMENT WHERE comment.share_id=share.share_id AND share.share_by ='$value[fri_by]'") or die(mysql_error());

			while($row1=mysql_fetch_assoc($result1)){

				$result3=mysql_query("select like_status from likes where share_id='$row1[share_id]' and user='$email'") or die(mysql_error()); 
				//$row=mysql_fetch_assoc($result3);
				if(mysql_num_rows($result3)>0){



				$result2=mysql_query("select distinct personal.First_Name,personal.Last_Name,personal.pic,share.share_id,share.share_by,share.share_text,share.share_pic,share.share_video,share.label,likes.like_status, likes.user from likes,comment,share,personal where comment.share_id='$row1[share_id]' and share.share_id='$row1[share_id]' AND personal.email = share.share_by and likes.share_id='$row1[share_id]' and likes.user='$email'") or die(mysql_error());
			}
			else
			{
				

				$result2=mysql_query("select distinct personal.First_Name,personal.Last_Name,personal.pic,share.share_id,share.share_by,share.share_text,share.share_pic,share.share_video,share.label,likes.like_status, likes.user from likes,comment,share,personal where comment.share_id='$row1[share_id]' and share.share_id='$row1[share_id]' AND personal.email = share.share_by and likes.share_id='$row1[share_id]' and likes.user IS NULL") or die(mysql_error());

			}
			while ($row2=mysql_fetch_assoc($result2))
				$arr1[]=$row2;

			
				}
			

		}
		
			
			return array("success"=>$arr1);			
		

	
}



	function comment_access($share_id){


		$result=mysql_query("SELECT personal.First_Name,personal.Last_Name,comment.timestamp,comment.comment,personal.pic FROM COMMENT , personal WHERE share_id = '$share_id' AND personal.Email = comment.comment_by LIMIT 0 , 30") or die(mysql_error());

		while($row=mysql_fetch_assoc($result))
			$arr[]=$row;

			if(isset($arr))
				return array("success"=>$arr);		

	}

	function comment_post($share_id,$comment,$user_id){

		try{
		$result=mysql_query("insert into comment(share_id,comment,comment_by) values('$share_id','$comment','$user_id')") or die(mysql_error());
	}
	catch(Execption $ex)
	{
		return array("error"=>"unable to post comment try later");
	} 
}

	/*function comment($share_id){	


		$r1=mysql_query("select share.share_text,share.share_by,share.share_pic,comment.comment,comment.comment_by from share,comment where share.share_id='$share_id' and comment.share_id='$share_id' limit 1") or die(mysql_error());
		while($row=mysql_fetch_assoc($r1)){
			$arr[]=$row;
		}


		return array("success"=>$arr);					
			
}*/

function user_info($email){


	try{
	$result=mysql_query("select * from personal where email='$email'") or die(mysql_error());

	while($row=mysql_fetch_assoc($result)){
		$arr[]=$row;
	}

	return array("success"=>$arr);

}

catch(Execption $ex){

	return array("error"=>"Some problem to display userinfo");
}
}



function message_send($message_by,$message_to,$message,$timestamp){

	try{
		$result=mysql_query("insert into message(message_by,message_to,message,timestamp)values('$message_by','$message_to','$message','$timestamp')")or die(mysql_error());
				}
				catch(Execption $ex){

				return array("error"=>"Some problem to send your message .try after some time");

				}

					}
function message_box($email,$type){

	$s=0;

	if($type=='all'){

		$result=mysql_query("select * from message where message_to='$email' or message_by='$email'")or die(mysql_error());

		while($row=mysql_fetch_assoc($result)){

			$arr[]=$row;
		}
		$result1=mysql_query("update message set status='1' where status='$s' and message_to='$email'") or die(mysql_errno());

	}

	elseif($type=='send'){

		$result=mysql_query("select * from message where message_by='$email'")or die(mysql_error());

		while($row=mysql_fetch_assoc($result)){

			$arr[]=$row;
		}

	}
	elseif ($type=="recived") {
		
		$result=mysql_query("select * from message where message_to='$email'")or die(mysql_error());

		while($row=mysql_fetch_assoc($result)){

			$arr[]=$row;
		}
		

		$result1=mysql_query("update message set status='1' where status='$s' and message_to='$email'") or die(mysql_errno());
	
	}

	
	return array("success"=>$arr);
}


function create_group($name,$email,$user_id){

	$result=mysql_query("select * from personal where First_Name='$name' or Email='$email'")or die(mysql_error());

	if(mysql_num_rows($result)>0){

		return array("error"=>"group name  or group_id already exists");
	}

	$result1=mysql_query("insert into personal(First_Name,Email,group_status,create_by,account_status)values('$name','$email','yes','$user_id','yes')")or die(mysql_error());

	if(mysql_affected_rows()>0){
		return array("success"=>"group create successfully.Invite you friend");
	}


}

 function join_group($group_id,$group_name,$group_email,$user_id){

 	$result=mysql_query("insert into social_group(group_id,group_name,group_member,admin,membership_status)values('$group_id','$group_name','$user_id','$group_email','pending')") or die(mysql_error());
}

function group_member($email){

	$result=mysql_query("select personal.First_Name,social_group.group_member,personal.Email from personal,social_group where social_group.admin ='$email' and social_group.group_member=personal.Email and social_group.membership_status='approve'") or die(mysql_error());

	if(mysql_num_rows($result)>0){
	while($row=mysql_fetch_assoc($result))

		$arr[]=$row	;

		return array("success"=>$arr);	
	}
	else
	{
		return array("error"=>"invite your friend");

	}

	

} 

function group_req_list($email){

	$result=mysql_query("select personal.First_Name,personal.Last_Name,social_group.group_member ,personal.Email from personal,social_group where social_group.admin ='$email' and social_group.group_member=personal.Email and social_group.membership_status='pending'") or die(mysql_error());

	while($row=mysql_fetch_assoc($result)){

		$arr[]=$row; 
	}

	return array("success"=>$arr);

} 

function group_show($email){

	$result=mysql_query("select group_member from social_group where admin='$email' and membership_status='approve'")or die(mysql_error());

			while($row=mysql_fetch_assoc($result))
				$arr[]=$row;

			if(isset($arr)){
			
			foreach($arr as $value){
				$result1=mysql_query("SELECT DISTINCT share.share_id FROM SHARE JOIN COMMENT WHERE comment.share_id = share.share_id AND share.share_by = '$value[group_member]' AND share.group_share = '$email'") or die(mysql_error());

		while($row1=mysql_fetch_assoc($result1)){

				$result3=mysql_query("select like_status from likes where share_id='$row1[share_id]' and user='$email'") or die(mysql_error()); 
				//$row=mysql_fetch_assoc($result3);
				if(mysql_num_rows($result3)>0){



				$result2=mysql_query("select distinct personal.First_Name,personal.Last_Name,personal.pic,share.share_id,share.share_by,share.share_text,share.share_pic,share.share_video,share.label,likes.like_status, likes.user from likes,comment,share,personal where comment.share_id='$row1[share_id]' and share.share_id='$row1[share_id]' AND personal.email = share.share_by and likes.share_id='$row1[share_id]' and likes.user='$email'") or die(mysql_error());
			}
			else
			{
				

				$result2=mysql_query("select distinct personal.First_Name,personal.Last_Name,personal.pic,share.share_id,share.share_by,share.share_text,share.share_pic,share.share_video,share.label,likes.like_status, likes.user from likes,comment,share,personal where comment.share_id='$row1[share_id]' and share.share_id='$row1[share_id]' AND personal.email = share.share_by and likes.share_id='$row1[share_id]' and likes.user IS NULL") or die(mysql_error());

			}
			while ($row2=mysql_fetch_assoc($result2))
				$arr1[]=$row2;

			
				}
			

		}
		
			
			


		if(isset($arr1)){

		return array("success"=>$arr1);
	}
	else{

		return array("error"=>"invite your friend");

	}
}
}

function group_info($email,$action){

	if($action=='create'){

	$result=mysql_query("select id,First_Name,Email,create_by from personal where create_by='$email'")or die(mysql_error());
	if(mysql_num_rows($result)>0){
	while ($row=mysql_fetch_assoc($result)) 		
	$arr[]=$row;
}
	
	}
elseif($action=='join'){

	$result1=mysql_query("select group_name,admin from social_group where group_member='$email' and membership_status='approve'")or die(mysql_error());
	if(mysql_num_rows($result1)>0){
	while ($row=mysql_fetch_assoc($result1)) 		
	$arr[]=$row;
	}
	}

	if(isset($arr))
		return array("success"=>$arr);

}

function group_action($action,$group_member,$admin,$label){

	if($action=="approve")
				{

				$result =mysql_query("update  social_group set membership_status='approve' where group_member='$group_member' and  admin='$admin'") or die(mysql_error());
				$result1=mysql_query("insert into friend (fri_by,fri_to,fri_status)values('$fri_to','$fri_by','approve')")or die(mysql_error());
				return array("success"=>"add");
			}
			else if($action=="reject"){
			
				$result=mysql_query("delete from social_group where group_member='$group_member' and  admin='$admin'");
			}

}

function group_share($email,$file,$type,$group_id,$label=false){

	$image=array("image/jpeg","image/png","image/gif","image/jpg");
				$video=array("video/mp4","video/avi");
				$both=array("image/jpeg","image/png","image/gif","image/jpg","video/mp4","video/avi");

				if(isset($file))
					$r=$file['file']['type'];

	if($type=='text'){

				$result=mysql_query("insert into share(share_by,share_text,group_share) values('$email','$file','$group_id')") or die(mysql_error());
				$result1=mysql_query("select share_id from share where share_by='$email' ORDER BY share_id DESC LIMIT 1")or die(mysql_error());
				if($row=mysql_fetch_assoc($result1))
				$result2=mysql_query("insert into comment(share_id)values('$row[share_id]')")or die(mysql_error());
			$result3=mysql_query("insert into likes(share_id) values('$row[share_id]')") or die(mysql_error());
				
				if(mysql_affected_rows()>0){ 

					return array("success"=>"successfully");
				}
				else{

					return array("error"=>"error");

				}
			}
			else if($type=='image')	{
			    			     	 
      			    $f=$file['file']['name'];

      			    $f = str_replace(' ', '', $f);

   				 if(in_array($r,$both)){
		    		
		 			if(move_uploaded_file($file['file']['tmp_name'],"image/$f")){	

		 			if(in_array($r,$image)){
		 			 $result=mysql_query("insert into share(share_by,share_pic,label,group_share) values('$email','$f','$label','$group_id')")or die(mysql_error());
		 			 
		 			 		 			}
		 			else if (in_array($r,$video))
		 			{
		 				$result=mysql_query("insert into share(share_by,share_video,label,group_share) values('$email','$f','$label','yes')")or die(mysql_error());

		 			}
		 			 $result1=mysql_query("select share_id from share where share_by='$email' ORDER BY share_id DESC LIMIT 1")or die(mysql_error());
				if($row=mysql_fetch_assoc($result1))
				$result2=mysql_query("insert into comment(share_id)values('$row[share_id]')")or die(mysql_error());
				$result3=mysql_query("insert into likes(share_id) values('$row[share_id]')") or die(mysql_error());

 
		 		
		 				return array("success"=>"The file has been uploaded");
		 		} 
		 	}

		  		else  { 
		 					return array("error"=>"Please upload aJPEG,PNG image");
		 			}

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

function group_update($name,$sign,$email){

	$result=mysql_query("update personal set First_Name='$name',sign='$sign' where Email='$email'") or die(mysql_error());

}

function New_message($email,$current_time){

	$s=0;


	$result=mysql_query("select Last_login from login  where email='$email'") or die(mysql_errno());

	if($row=mysql_fetch_assoc($result))
		$result1=mysql_query("select message from message where status='$s' and  message_to='$email' and timestamp between '$row[Last_login]' and '$current_time'") or die(mysql_error());
	if(mysql_num_rows($result1)>0){

	while($row=mysql_fetch_assoc($result1))
		$arr[]=$row;

	return array("success"=>$arr);

}
else
{
	return array("errro"=>"no mea");
}
	
}

function invite($group_id,$group_email,$group_name,$user_id){

 	$result=mysql_query("insert into social_group(group_id,group_name,group_member,admin,membership_status)values('$group_id','$group_name','$user_id','$group_email','request')") or die(mysql_error());
}

function group_invite($email){

	$result=mysql_query("select group_name from social_group where group_member='$email' and membership_status='request'") or die(mysql_error());

	while($row=mysql_fetch_assoc($result)){
	$result1=mysql_query("select personal.pic,social_group.group_name,count(group_member)as likes from social_group,personal where social_group.group_name='$row[group_name]' and personal.First_name='$row[group_name]'") or die(mysql_error());
while($row1=mysql_fetch_assoc($result1))
	$arr[]=$row1;

}

//print_r($arr);

if(isset($arr)){
return array("success"=>$arr);
}

}

function logout($email,$time){

	$resutl =mysql_query("update login set Last_login='$time' where email='$email'") or die(mysql_error());
}

function notification($email,$time){

	$result=mysql_query("select group_name,admin from social_group where membership_status='approve' and group_member='$email' ") or die(mysql_error());
	$result2=mysql_query("select Last_login from login where email='$email'")or die(mysql_error());
	if($row1 =mysql_fetch_assoc($result2))
		$Last_login=$row1['Last_login'];

	while($row=mysql_fetch_assoc($result)){
		$result1=mysql_query("select share_by from share  where group_share='$row[admin]' and  Timestamp between '$Last_login' and '$time'") or die(mysql_error());

	while($row3=mysql_fetch_assoc($result1))

		$arr[]=$row3['share_by'];
}

return array("success"=>$arr);

}

function notificaition_birth(){

} 


function setting($email,$status=false,$friend_req=false,$search=false){

	if($status=='yes'){
	$result=mysql_query("update personal set account_status='no' where email='$email'") or die(mysql_error());
		}

if($search=='yes' or $friend_req=='yes'){
	$result=mysql_query("update personal set in_search_result='no' where email='$email'") or die(mysql_error());
	
}
}

function my_post($email){

	
				$result1=mysql_query("SELECT distinct share.share_id FROM SHARE JOIN COMMENT WHERE comment.share_id=share.share_id AND share.share_by ='$email'") or die(mysql_error());

			while($row1=mysql_fetch_assoc($result1)){

				$result3=mysql_query("select like_status from likes where share_id='$row1[share_id]' and user='$email'") or die(mysql_error()); 
				
				if(mysql_num_rows($result3)>0){


				$result2=mysql_query("select distinct personal.First_Name,personal.Last_Name,personal.pic,share.share_id,share.share_by,share.share_text,share.share_pic,share.share_video,share.label,likes.like_status,count(likes.like_status) as no, likes.user from likes,comment,share,personal where comment.share_id='$row1[share_id]' and share.share_id='$row1[share_id]' AND personal.email = share.share_by and likes.share_id='$row1[share_id]' and likes.user='$email'") or die(mysql_error());
			}
			else
			{
				
				$result2=mysql_query("select distinct personal.First_Name,personal.Last_Name,personal.pic,share.share_id,share.share_by,share.share_text,share.share_pic,share.share_video,share.label,likes.like_status, likes.user from likes,comment,share,personal where comment.share_id='$row1[share_id]' and share.share_id='$row1[share_id]' AND personal.email = share.share_by and likes.share_id='$row1[share_id]' and likes.user IS NULL") or die(mysql_error());

			}
				

			while ($row2=mysql_fetch_assoc($result2))
				$arr1[]=$row2;

			
				}

				if(isset($arr1))
				{
					return array("success"=>$arr1);

				}
				else
				{
					return array("error"=>"No post avilable");

				}
}

function likes($email,$status,$share_id){
	

	if($status=='like')
	{
		$result=mysql_query("select * from likes where share_id='$share_id' and user='$email' and like_status='like'")or die(mysql_errno());
		if(mysql_num_rows($result)>0){
			$result1=mysql_query("update likes set like_status='unlike' where share_id='$share_id' and user='$email'" ) or die(mysql_error());
			$result2=mysql_query("select count(like_status)as no from likes where like_status='like' and share_id='$share_id'") or die(mysql_error());

		}
		else{
			$result1=mysql_query("insert into likes(share_id,user,like_status)values('$share_id','$email','unlike')") or die(mysql_errno());
			$result2=mysql_query("select count(like_status)as no from likes where like_status='like' and share_id='$share_id'") or die(mysql_error());	


		}


	}
	else if($status=='unlike'){

		$result=mysql_query("select * from likes where share_id='$share_id' and user='$email' and like_status='unlike'")or die(mysql_errno());
		//$result2=mysql_query("setect count(like_status) from like where like_status='like' and share_id='$share'") or die(mysql_error());
		if(mysql_num_rows($result)>0){
			$result1=mysql_query("update likes set like_status='like' where share_id='$share_id' and user='$email'" ) or die(mysql_error());
			$result2=mysql_query("select count(like_status)as no from likes where like_status='like' and share_id='$share_id'") or die(mysql_error());
		}
		else{
			
			$result1=mysql_query("insert into likes(share_id,user,like_status)values('$share_id','$email','like')") or die(mysql_errno());
		    $result2=mysql_query("select count(like_status) as no from likes where like_status='like' and share_id='$share_id'") or die(mysql_error());
				

		}


	}

	while($row=mysql_fetch_assoc($result2))
		$arr[]=$row;

	return array("success"=>$arr);
}

function no_likes($share_id){

	$result=mysql_query("select count(like_status)as no from likes where like_status='like' and share_id='$share_id'") or die(mysql_error());
while($row=mysql_fetch_assoc($result))
	$arr[]=$row;

return array("success"=>$arr);


}




}


?>

