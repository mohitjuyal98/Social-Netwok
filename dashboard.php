<!DOCTYPE html>


<?php
    include "operation.php";
    session_start();
 error_reporting(0);   
   
   
    $user= new user();
    $date = date_create();
    $personal=$user->search(NULL,$_SESSION['email']);
    
    $req_list=$user->req_list($_SESSION['email']);
    $fri_list=$user->fri_list($_SESSION['email']);
    $create_group=$user->group_info($_SESSION['email'],'create');
    $join_group=$user->group_info($_SESSION['email'],'join');
    $new_message=$user->New_message($_SESSION['email'],date_format($date,'Y-m-d H:i:s'));
    $Notification=$user->notification($_SESSION['email'],date_format($date,'Y-m-d H:i:s'));
        

if(is_array($new_message))
    {
        if(isset($new_message)){
            $new_message1=$new_message['success'];
            
        }
    }
    
    if(is_array($fri_list)){
        if(isset($fri_list['success'])){
            $fri_list1=$fri_list['success'];
        }

    }

    if(is_array($req_list)){
        if(isset($req_list['success'])){
            $req_list1=$req_list['success'];

        }  
          }
       
    if(isset($_POST['approved'])){
        

        $user->action('approve',$_POST['email'],$_SESSION['email']);
    }
    else if(isset($_POST['reject'])){

        $user->action('reject',$_POST['email'],$_SESSION['email']);
    }
    elseif(isset($_POST['text'])){
        $user->share($_SESSION['email'],$_POST['post'],'text');
    }
    elseif(isset($_POST['pic'])){

        echo $_POST['label'];
        
        $user->share($_SESSION['email'],$_FILES,'image',$_POST['label']);
    }

    $_SESSION['user_name']=$personal['success']['0']['First_Name'];

    if(isset($personal['success']['0']['pic'])){
    $_SESSION['pic']=$personal['success']['0']['pic'];
}
else
{
    $_SESSION['pic']="img/User-icon.png";

}

    ?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Gebo Admin Panel</title>
    
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
        <!-- gebo blue theme-->
            <link rel="stylesheet" href="css/blue.css" />
        <!-- tooltips-->
            <link rel="stylesheet" href="lib/qtip2/jquery.qtip.min.css" />
        <!-- main styles -->
            <link rel="stylesheet" href="css/style.css" />
			
            

             <link rel="stylesheet" href="img/splashy/splashy.css" />
	
        <!-- Favicon -->
            <link rel="shortcut icon" href="favicon.ico" />

            <script src="js/jquery.min.js">
</script>

<script>

$(document).ready(function(){
    $("#label").hide();
  $("#file").click(function(){
    $("#label").toggle();
  });
});
</script>

		
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
        <![endif]-->
		
		<script>
			//* hide all elements & show preloader
			document.getElementsByTagName('html')[0].className = 'js';
		</script>
    <!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>
    <body class="gebo-fixed">
		<div id="maincontainer" class="clearfix">
			<!-- header -->
            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="dashboard.php"><i class="icon-home icon-white"></i>Home</a>
                            <ul class="nav user_menu pull-right">

                            	<li class="hidden-phone hidden-tablet">
                                    <div class="nb_boxes clearfix">
                                        <a data-toggle="modal" href="message_box.php?msg_type=recived"  class="label ttip_b" title="New messages"><?php echo count($new_message1);?> <i class="splashy-mail_light"></i></a>
                                        <a data-toggle="modal" data-backdrop="static" href="" class="label ttip_b" title="New tasks">10 <i class="splashy-calendar_week"></i></a>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user_name'];?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
										<li><a href="user_profile.php">My profile</a></li>
										<li class="divider"></li>
										<li><a href=<?php echo "logout.php?action=logout";?>>Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
							<a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
								<span class="icon-align-justify icon-white"></span>
							</a>
                            <nav>
                                <div class="nav-collapse">
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php if(count($req_list['success'])>0) echo count($req_list['success']);?> Friends request <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <?php

                                                //print_r($req_list);
                                                        if(isset($req_list['success'])){
                                                        foreach ($req_list['success'] as $value) {

                                                            $_SESSION['Friend']=$value['Email'];
                                                            echo "<li>$value[First_Name]  $value[Last_Name]  <form action='dashboard.php' method=POST ><input type=hidden value=$value[Email] name=email><input type ='submit' name='approved' value='confirm'>&nbsp;&nbsp;<input type ='submit' name='reject' value='reject'></form><li>";
                                                        }
                                                    }
                                                    elseif(isset($req_list['error'])){
                                                       echo "<div class='alert alert-error'><strong><li></li>$req_list[error]!</strong></div>";                              
                                                                                             
                                                    }
                                                ?>         
                                            </ul>
                                        </li>
										<li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> Notification<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                 <?php                                               
                                                            
                                                if(isset($Notification['success'])){
                                                    
                                                foreach($Notification as $value){

                                                    echo "<li>$value[share_by]</li>";
                                                }
                                            }
                                            else  {

                                                echo "<div class='alert alert-error'>                                
                               <strong><li>No notification found</li>!</strong></div>";                                                                                                                                    
                                                   }


                                                ?>
                                               
                                            </ul>
                                        </li>
										<li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> Setting <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="setting.php">Account setting </a></li>
                                               
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- main content -->
           <div class="row-fluid"  style="margin-left:260px;margin-top:59px;">
                        <div class="span12">
                            <div class="chat_box">
                                <div class="row-fluid">
                                    <div class="span8 chat_content">

                                        
                                         <div>
                    <form action="dashboard.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="post" >
                        <input type="submit" name="text" value="post">
                        <div>
                               <input type="text" id="label" name="label" placeholder="Say about something Video or Picture..">
                        <input type="file" name="file" id="file">
                     
                        <input type="submit" name="pic" value='picture/video'>
                    </div>
                    </form>
                </div>
                <hr />

                <div class="sepH_a item-list clearfix">


               
                 <?php
                         $show=$user->show($_SESSION['email']);
                         $group_req=$user->group_invite($_SESSION['email']);
                         $my_post=$user->my_post($_SESSION['email']);

                         //print_r($group_req);

                         if(is_array($my_post))

                            if(isset($my_post['success'])){

                                foreach($my_post['success'] as $value){


                                     if(isset($value['share_text'])){


                                         if($value['like_status']=="like")
                                                {
                                                    $value['like_status']="unlike";

                                                }
                                                else if($value['like_status']=="unlike")                                               
                                                {
                                                    $value['like_status']="like";

                                                }
                                                $share_id=$value['share_id'];
                                       
                                       echo "<pre><div><div><img src='$value[pic]' width=60 height=60><h3> $value[First_Name]&nbsp;$value[Last_Name]</h3></div>
                                       <div>$value[label]</div>
                                        <div><h2>$value[share_text]</h2></div>
                                       <script>
                                                $(document).ready(function(){
                                                  $('#button$value[share_id]').click(function(){
                                                    $.post('comment.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      comment:text$value[share_id].value
                                                    },
                                                    function(data,status){

                                                      $('#place$value[share_id]').append(data);
                                                      
                                                    });
                                                  });
                                                });
                                                </script>

                                                <script>
                                                
                                                $(document).ready(function(){                                                                                               
                                                  $('#b1$value[share_id]').click(function(){                                                    

                                                    $.post('like.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      status:b1$value[share_id].value,
                                                      user_id:'$_SESSION[email]'
                                                    },
                                                    function(data,status){

                                                      $('#no$value[share_id]').text(data);
                                                      
                                                    });
                                                    
                                                   });
                                                });
                                                </script>

                                                <script  language='javascript'>

                                                        
                                                    function like$value[share_id](){

                                                       
                                                        var x=form$value[share_id].b1$value[share_id].value;

                                                        if(x =='like'){

                                                            form$value[share_id].b1$value[share_id].value='unlike';

                                                        }
                                                        else if (x =='unlike') {
                                                            form$value[share_id].b1$value[share_id].value='like';
                                                            
                                                        }                                                      

                                                        } 
                                                </script>

                                              
                                                <div><form name=form$value[share_id]><input type=button id=b1$value[share_id] name=b1$value[share_id] onclick='like$value[share_id]();' value=$value[like_status]><button id='button$value[share_id]'>write comment</button><input type='text' id='text$value[share_id]' placeholder='write comment...'> </form></div>
                                                <div id='place$value[share_id]'>";
                                   $comment1=$user->comment_access($value['share_id']);
                                   $like1=$user->no_likes($value['share_id']);
                                   if(isset($like1['success']))
                                    foreach ($like1['success'] as $value4) {
                                        echo "<div><label><h3>likes</h3></label><label id='no$share_id'>$value4[no]</label></div></div></pre>";
                                    }

                                   if(isset($comment1)) 
                                        foreach($comment1['success'] as $value3)
                                            echo "<pre><div><img src='$value3[pic]'  width=50 height=50>&nbsp;<b>$value3[First_Name]&nbsp;&nbsp;</b>$value3[comment]</div><div>Comment at &nbsp;$value3[timestamp]</div></pre>";
                                        
                                    } 

                                else if(isset($value['share_pic'])){


                                         if($value['like_status']=="like")
                                                {
                                                    $value['like_status']="unlike";

                                                }
                                                else if($value['like_status']=="unlike")                                               
                                                {
                                                    $value['like_status']="like";

                                                }
                                                $share_id=$value['share_id'];

                                   echo "<pre><div><div><img src='$value[pic]' width=60 height=60><h3> $value[First_Name]&nbsp;$value[Last_Name]</h3></div>
                                       <div>$value[label]</div>
                                        <div><h2><img src=image/$value[share_pic] width=300 height=300 ></img></h2></div>
                                       <script>
                                                $(document).ready(function(){
                                                  $('#button$value[share_id]').click(function(){
                                                    $.post('comment.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      comment:text$value[share_id].value
                                                    },
                                                    function(data,status){

                                                      $('#place$value[share_id]').append(data);
                                                      
                                                    });
                                                  });
                                                });
                                                </script>

                                                <script>
                                                
                                                $(document).ready(function(){                                                                                               
                                                  $('#b1$value[share_id]').click(function(){                                                    

                                                    $.post('like.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      status:b1$value[share_id].value,
                                                      user_id:'$_SESSION[email]'
                                                    },
                                                    function(data,status){

                                                      $('#no$value[share_id]').text(data);
                                                      
                                                    });
                                                    
                                                   });
                                                });
                                                </script>

                                                <script  language='javascript'>

                                                        
                                                    function like$value[share_id](){

                                                       
                                                        var x=form$value[share_id].b1$value[share_id].value;

                                                        if(x =='like'){

                                                            form$value[share_id].b1$value[share_id].value='unlike';

                                                        }
                                                        else if (x =='unlike') {
                                                            form$value[share_id].b1$value[share_id].value='like';
                                                            
                                                        }                                                      

                                                        } 
                                                </script>

                                              
                                                <div><form name=form$value[share_id]><input type=button id=b1$value[share_id] name=b1$value[share_id] onclick='like$value[share_id]();' value=$value[like_status]><button id='button$value[share_id]'>write comment</button><input type='text' id='text$value[share_id]' placeholder='write comment...'> </form></div>
                                                <div id='place$value[share_id]'>";
                                   $comment1=$user->comment_access($value['share_id']);
                                   $like1=$user->no_likes($value['share_id']);
                                   if(isset($like1['success']))
                                    foreach ($like1['success'] as $value4) {
                                        echo "<div><label><h3>likes</h3></label><label id='no$share_id'>$value4[no]</label></div></div></pre>";
                                    }

                                   if(isset($comment1)) 
                                        foreach($comment1['success'] as $value3)
                                            echo "<pre><div><img src='$value3[pic]'  width=50 height=50>&nbsp;<b>$value3[First_Name]&nbsp;&nbsp;</b>$value3[comment]</div><div>Comment at &nbsp;$value3[timestamp]</div></pre>";
                                        
                                    } 

                                    else if(isset($value['share_video'])){


                                         if($value['like_status']=="like") 
                                                {
                                                    $value['like_status']="unlike";

                                                }
                                                else if($value['like_status']=="unlike")                                               
                                                {
                                                    $value['like_status']="like";

                                                }

                                   echo "<pre><div><div><img src='$value[pic]' width=60 height=60><h3> $value[First_Name]&nbsp;$value[Last_Name]</h3></div>
                                       <div>$value[label]</div>
                                        <div><h2><video width=300 height=300 controls>
                                        <source src=image/$value[share_video] type=video/mp4>
                                        </video></h2></div>
                                       <script>
                                                $(document).ready(function(){
                                                  $('#button$value[share_id]').click(function(){
                                                    $.post('comment.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      comment:text$value[share_id].value
                                                    },
                                                    function(data,status){

                                                      $('#place$value[share_id]').append(data);
                                                      
                                                    });
                                                  });
                                                });
                                                </script>

                                                <script>
                                                
                                                $(document).ready(function(){                                                                                               
                                                  $('#b1$value[share_id]').click(function(){                                                    

                                                    $.post('like.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      status:b1$value[share_id].value,
                                                      user_id:'$_SESSION[email]'
                                                    },
                                                    function(data,status){

                                                      $('#no$value[share_id]').text(data);
                                                      
                                                    });
                                                    
                                                   });
                                                });
                                                </script>

                                                <script  language='javascript'>

                                                        
                                                    function like$value[share_id](){

                                                       
                                                        var x=form$value[share_id].b1$value[share_id].value;

                                                        if(x =='like'){

                                                            form$value[share_id].b1$value[share_id].value='unlike';

                                                        }
                                                        else if (x =='unlike') {
                                                            form$value[share_id].b1$value[share_id].value='like';
                                                            
                                                        }                                                      

                                                        } 
                                                </script>

                                              
                                                <div><form name=form$value[share_id]><input type=button id=b1$value[share_id] name=b1$value[share_id] onclick='like$value[share_id]();' value=$value[like_status]><button id='button$value[share_id]'>write comment</button><input type='text' id='text$value[share_id]' placeholder='write comment...'> </form></div>
                                                <div id='place$value[share_id]'>";
                                   $comment1=$user->comment_access($value['share_id']);
                                   $like1=$user->no_likes($value['share_id']);
                                   if(isset($like1['success']))
                                    foreach ($like1['success'] as $value4) {
                                        echo "<div><label><h3>likes</h3></label><label id='no$share_id'>$value4[no]</label></div></div></pre>";
                                    }

                                   if(isset($comment1)) 
                                        foreach($comment1['success'] as $value3)
                                            echo "<pre><div><img src='$value3[pic]'  width=50 height=50>&nbsp;<b>$value3[First_Name]&nbsp;&nbsp;</b>$value3[comment]</div><div>Comment at &nbsp;$value3[timestamp]</div></pre>";
                                        
                                    } 


                                    } 
                                }



                                                                                            
                         if(is_array($show))

                            if(isset($show['success'])){

                                foreach($show['success'] as $value){

                                    if(isset($value['share_text'])){


                                         if($value['like_status']=="like")
                                                {
                                                    $value['like_status']="unlike";

                                                }
                                                else if($value['like_status']=="unlike")                                               
                                                {
                                                    $value['like_status']="like";

                                                }
                                                 $share_id=$value['share_id'];
                                       
                                       echo "<pre><div><div><img src='$value[pic]' width=60 height=60><h3> $value[First_Name]&nbsp;$value[Last_Name]</h3></div>
                                       <div>$value[label]</div>
                                        <div><h2>$value[share_text]</h2></div>
                                       <script>
                                                $(document).ready(function(){
                                                  $('#button$value[share_id]').click(function(){
                                                    $.post('comment.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      comment:text$value[share_id].value
                                                    },
                                                    function(data,status){

                                                      $('#place$value[share_id]').append(data);
                                                      
                                                    });
                                                  });
                                                });
                                                </script>

                                                <script>
                                                
                                                $(document).ready(function(){                                                                                               
                                                  $('#b1$value[share_id]').click(function(){                                                    

                                                    $.post('like.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      status:b1$value[share_id].value,
                                                      user_id:'$_SESSION[email]'
                                                    },
                                                    function(data,status){

                                                      $('#no$value[share_id]').text(data);
                                                      
                                                    });
                                                    
                                                   });
                                                });
                                                </script>

                                                <script  language='javascript'>

                                                        
                                                    function like$value[share_id](){

                                                       
                                                        var x=form$value[share_id].b1$value[share_id].value;

                                                        if(x =='like'){

                                                            form$value[share_id].b1$value[share_id].value='unlike';

                                                        }
                                                        else if (x =='unlike') {
                                                            form$value[share_id].b1$value[share_id].value='like';
                                                            
                                                        }                                                      

                                                        } 
                                                </script>

                                              
                                                <div><form name=form$value[share_id]><input type=button id=b1$value[share_id] name=b1$value[share_id] onclick='like$value[share_id]();' value=$value[like_status]><button id='button$value[share_id]'>write comment</button><input type='text' id='text$value[share_id]' placeholder='write comment...'> </form></div>
                                                <div id='place$value[share_id]'>";
                                   $comment1=$user->comment_access($value['share_id']);
                                   $like1=$user->no_likes($value['share_id']);
                                   if(isset($like1['success']))
                                    foreach ($like1['success'] as $value4) {
                                        echo "<div><label><h3>likes</h3></label><label id='no$share_id'>$value4[no]</label></div></div></pre>";
                                    }

                                   if(isset($comment1)) 
                                        foreach($comment1['success'] as $value3)
                                            echo "<pre><div><img src='$value3[pic]'  width=50 height=50>&nbsp;<b>$value3[First_Name]&nbsp;&nbsp;</b>$value3[comment]</div><div>Comment at &nbsp;$value3[timestamp]</div></pre>";
                                        
                                    } 
       
                                
                                else if(isset($value['share_pic'])){


                                         if($value['like_status']=="like")
                                                {
                                                    $value['like_status']="unlike";

                                                }
                                                else if($value['like_status']=="unlike")                                               
                                                {
                                                    $value['like_status']="like";

                                                }
                                                $share_id=$value['share_id'];

                                   echo "<pre><div><div><img src='$value[pic]' width=60 height=60><h3> $value[First_Name]&nbsp;$value[Last_Name]</h3></div>
                                       <div>$value[label]</div>
                                        <div><h2><img src=image/$value[share_pic] width=300 height=300 ></img></h2></div>
                                       <script>
                                                $(document).ready(function(){
                                                  $('#button$value[share_id]').click(function(){
                                                    $.post('comment.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      comment:text$value[share_id].value
                                                    },
                                                    function(data,status){

                                                      $('#place$value[share_id]').append(data);
                                                      
                                                    });
                                                  });
                                                });
                                                </script>

                                                <script>
                                                
                                                $(document).ready(function(){                                                                                               
                                                  $('#b1$value[share_id]').click(function(){                                                    

                                                    $.post('like.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      status:b1$value[share_id].value,
                                                      user_id:'$_SESSION[email]'
                                                    },
                                                    function(data,status){

                                                      $('#no$value[share_id]').text(data);
                                                      
                                                    });
                                                    
                                                   });
                                                });
                                                </script>

                                                <script  language='javascript'>

                                                        
                                                    function like$value[share_id](){

                                                       
                                                        var x=form$value[share_id].b1$value[share_id].value;

                                                        if(x =='like'){

                                                            form$value[share_id].b1$value[share_id].value='unlike';

                                                        }
                                                        else if (x =='unlike') {
                                                            form$value[share_id].b1$value[share_id].value='like';
                                                            
                                                        }                                                      

                                                        } 
                                                </script>

                                              
                                                <div><form name=form$value[share_id]><input type=button id=b1$value[share_id] name=b1$value[share_id] onclick='like$value[share_id]();' value=$value[like_status]><button id='button$value[share_id]'>write comment</button><input type='text' id='text$value[share_id]' placeholder='write comment...'> </form></div>
                                                <div id='place$value[share_id]'>";
                                   $comment1=$user->comment_access($value['share_id']);
                                   $like1=$user->no_likes($value['share_id']);
                                   if(isset($like1['success']))
                                    foreach ($like1['success'] as $value4) {
                                        echo "<div><label><h3>likes</h3></label><label id='no$share_id'>$value4[no]</label></div></div></pre>";
                                    }

                                   if(isset($comment1)) 
                                        foreach($comment1['success'] as $value3)
                                            echo "<pre><div><img src='$value3[pic]'  width=50 height=50>&nbsp;<b>$value3[First_Name]&nbsp;&nbsp;</b>$value3[comment]</div><div>Comment at &nbsp;$value3[timestamp]</div></pre>";
                                        
                                    } 
                                    

                                    else if(isset($value['share_video'])){


                                         if($value['like_status']=="like")
                                                {
                                                    $value['like_status']="unlike";

                                                }
                                                else if($value['like_status']=="unlike")                                               
                                                {
                                                    $value['like_status']="like";

                                                }

                                  echo "<pre><div><div><img src='$value[pic]' width=60 height=60><h3> $value[First_Name]&nbsp;$value[Last_Name]</h3></div>
                                       <div>$value[label]</div>
                                        <div><h2><video width=300 height=300 controls>
                                        <source src=image/$value[share_video] type=video/mp4>
                                        </video></h2></div>
                                       <script>
                                                $(document).ready(function(){
                                                  $('#button$value[share_id]').click(function(){
                                                    $.post('comment.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      comment:text$value[share_id].value
                                                    },
                                                    function(data,status){

                                                      $('#place$value[share_id]').append(data);
                                                      
                                                    });
                                                  });
                                                });
                                                </script>

                                                <script>
                                                
                                                $(document).ready(function(){                                                                                               
                                                  $('#b1$value[share_id]').click(function(){                                                    

                                                    $.post('like.php',
                                                    {
                                                      share_id:'$value[share_id]',
                                                      status:b1$value[share_id].value,
                                                      user_id:'$_SESSION[email]'
                                                    },
                                                    function(data,status){

                                                      $('#no$value[share_id]').text(data);
                                                      
                                                    });
                                                    
                                                   });
                                                });
                                                </script>

                                                <script  language='javascript'>

                                                        
                                                    function like$value[share_id](){

                                                       
                                                        var x=form$value[share_id].b1$value[share_id].value;

                                                        if(x =='like'){

                                                            form$value[share_id].b1$value[share_id].value='unlike';

                                                        }
                                                        else if (x =='unlike') {
                                                            form$value[share_id].b1$value[share_id].value='like';
                                                            
                                                        }                                                      

                                                        } 
                                                </script>

                                              
                                                <div><form name=form$value[share_id]><input type=button id=b1$value[share_id] name=b1$value[share_id] onclick='like$value[share_id]();' value=$value[like_status]><button id='button$value[share_id]'>write comment</button><input type='text' id='text$value[share_id]' placeholder='write comment...'> </form></div>
                                                <div id='place$value[share_id]'>";
                                   $comment1=$user->comment_access($value['share_id']);
                                   $like1=$user->no_likes($value['share_id']);
                                   if(isset($like1['success']))
                                    foreach ($like1['success'] as $value4) {
                                        echo "<div><label><h3>likes</h3></label><label id='no$share_id'>$value4[no]</label></div></div></pre>";
                                    }

                                   if(isset($comment1)) 
                                        foreach($comment1['success'] as $value3)
                                            echo "<pre><div><img src='$value3[pic]'  width=50 height=50>&nbsp;<b>$value3[First_Name]&nbsp;&nbsp;</b>$value3[comment]</div><div>Comment at &nbsp;$value3[timestamp]</div></pre>";
                                        
                                    } 
                                    } 



                                }
                             


                         if(is_array($group_req))

                            if(isset($group_req['success'])){

                                foreach($group_req['success'] as $value){

                                    echo "<pre><div class='row-fluid'><img src='$value[pic]' width=60 height=60><h3>$value[group_name]&nbsp;</div><div>likes $value[likes]</h3></div>

                                    <pre width=20 width=20><input type='submit' value='join'></pre>
                                    </pre>";
                                }
                            }


                                                    
                         ?>

                                    </div>

                                    <a href="#" data-items="3" class="item-list-show btn btn-mini">Show 5 more...</a>
                                </div>
                                    <div class="span3 chat_sidebar" style="margin-left:60px;">
                                        <div class="chat_heading clearfix">
                                            <div class="btn-group pull-right">
                                                <a href="#" class="btn btn-mini ttip_t" title="Refresh list"><i class="icon-refresh"></i></a>
                                                <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-mini ttip_t" title="Options"><i class="icon-cog"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Ban selected users</a></li>
                                                    <li><a href="#">Another action</a></li>
                                                </ul>   
                                            </div>
                                            Friends
                                        </div>
                                        <ul class="chat_user_list">
                                            <?php                             
                                   
                                    if(isset($fri_list['success']))
                                        foreach($fri_list['success'] as $value){

                                            $arr[]=$value['Email'];

                                           
                                    echo " <li class=offline active chat_you>  

                                    <a href=message.php?friend_id=$value[Email] target=_blank>
                                      
                                    $value[First_Name] <span></span>   </a>

                                        
                                    </li>";
                                }

                                $_SESSION['friend']=$arr;
                               
                                    ?>                                          
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

            
			<!-- sidebar -->
            <a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
            <div class="sidebar">
				<div class="antiScroll">
					<div class="antiscroll-inner">
						<div class="antiscroll-content">
							<div class="sidebar_inner">
								<form action="search_page1.php" class="input-append" method="POST" >
                                    <input autocomplete="off"  class="search_query input-medium" size="16" type="text"  name="find"/><button type="submit" class="btn" name="search"><i class="icon-search"></i></button>
                                </form>
								<div id="side_accordion" class="accordion">

									 <div><img src=<?php echo $_SESSION['pic'];?> width=200 height=200><br><br>
									
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseOne" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												TimeLine
											</a>
										</div>
										<div class="accordion-body collapse" id="collapseOne">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													<li><a href=<?php echo "timeline.php?req_to=$_SESSION[email]";?>> TimeLine</a></li>
													
												</ul>
											</div>
										</div>
									</div>
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseTwo" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												Message
											</a>
										</div>
										<div class="accordion-body collapse" id="collapseTwo">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													<li><a href="message_box.php?msg_type=all" target=_blank>All message</a></li>
                                                    <li><a href="message_box.php?msg_type=send" target=_blank>Send Message</a></li>
                                                    <li><a href="message_box.php?msg_type=recived" target=_blank>Recived Message</a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseThree" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												Group
											</a>
										</div>
										<div class="accordion-body collapse" id="collapseThree">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													 <?php
                                                    if(isset($join_group['success'])){
                                                    foreach($join_group['success'] as $value){
                                                        echo "<li><a href=group_user.php?group_id=$value[admin]&group_name=$value[group_name] target=_blank >$value[group_name]</a><li>";
                                                      $group[]=$value['group_name'];
                                                    }
                                                }
                                                else{
                                                    echo "No group found";
                                                }
                                                $_SESSION['group_name']=$group;                                                

                                                    ?>
												</ul>
											</div>
										</div>
									</div>
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseFour" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												Group created
											</a>
										</div>
										<div class="accordion-body collapse in" id="collapseFour">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													 <?php             
                            if(isset($create_group['success']))
                              foreach($create_group['success'] as $value ){
                               echo "<li><a href=group_admin.php?id=$value[id]&group_id=$value[Email]&group_name=$value[First_Name] target=_blank>$value[First_Name]</a></li>";
                                                 
                                }

                                 ?>
                                 <li><a href ="group_reg.php"><b>Create New Group</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			
            
            <script src="js/jquery.min.js"></script>
			<!-- smart resize event -->
			<script src="js/jquery.debouncedresize.min.js"></script>
			<!-- hidden elements width/height -->
			<script src="js/jquery.actual.min.js"></script>
			<!-- js cookie plugin -->
			<script src="js/jquery.cookie.min.js"></script>
			<!-- main bootstrap js -->
			<script src="bootstrap/js/bootstrap.min.js"></script>
			<!-- tooltips -->
			<script src="lib/qtip2/jquery.qtip.min.js"></script>
			<!-- fix for ios orientation change -->
			<script src="js/ios-orientationchange-fix.js"></script>
			<!-- scrollbar -->
			<script src="lib/antiscroll/antiscroll.js"></script>
			<script src="lib/antiscroll/jquery-mousewheel.js"></script>
			<!-- common functions -->
			<script src="js/gebo_common.js"></script>
	
			<script>
				$(document).ready(function() {
					//* show all elements & remove preloader
					setTimeout('$("html").removeClass("js")',1);
				});
			</script>
		
		</div>
	</body>
</html>