<!DOCTYPE html>

<?php
 include "operation.php";
 //error_reporting(0);
 session_start();

 $search1="";
$user = new user();

 $date = date_create();
    $personal=$user->search(NULL,$_SESSION['email']);
    $req_list=$user->req_list($_SESSION['email']);
    $fri_list=$user->fri_list($_SESSION['email']);
    $create_group=$user->group_info($_SESSION['email'],'create');
    $join_group=$user->group_info($_SESSION['email'],'join');
    $new_message=$user->New_message($_SESSION['email'],date_format($date,'Y-m-d H:i:s'));
    
   
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
if(isset($_POST['search'])){
    
    
$search1=$user->search($_POST['find']);

}

if(isset($_GET['req_to'])){

    $f=$_GET['req_to'];
    
    $user->frs($_GET['req_to'],$_SESSION['email']);
    
}

if(isset($_POST['submit'])){
    
    $user->invite($_SESSION['id'],$_SESSION['group_id'],$_SESSION['group_name'],$_POST['email']);
}
    ?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title></title>
    
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
        <!-- gebo blue theme-->
            <link rel="stylesheet" href="css/blue.css" id="link_theme" />
        <!-- breadcrumbs-->
            <link rel="stylesheet" href="lib/jBreadcrumbs/css/BreadCrumb.css" />
        <!-- tooltips-->
            <link rel="stylesheet" href="lib/qtip2/jquery.qtip.min.css" />
        <!-- notifications -->
            <link rel="stylesheet" href="lib/sticky/sticky.css" />
        <!-- notifications -->
            <link rel="stylesheet" href="lib/sticky/sticky.css" />    
        <!-- splashy icons -->
            <link rel="stylesheet" href="img/splashy/splashy.css" />
		<!-- colorbox -->
            <link rel="stylesheet" href="lib/colorbox/colorbox.css" />	

        <!-- main styles -->
            <link rel="stylesheet" href="css/style.css" />
			
            <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />
	
        <!-- Favicon -->
            <link rel="shortcut icon" href="favicon.ico" />
		
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
        <![endif]-->
		
		<script>
			//* hide all elements & show preloader
			document.documentElement.className += 'js';
		</script>
    <!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>
    <body class="gebo-fixed">
		
		
		<div id="maincontainer" class="clearfix">
			<!-- header -->
            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="#"><i class="icon-home icon-white"></i> Name</a>
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
                                        <li><a href=<?php echo "logout.php?action=logout"?>>Logout</a></li>
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
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php if(count($req_list)>0) echo count($req_list);?> Friends request <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <?php
                                                        if(isset($req_list['success'])){
                                                        foreach ($req_list['success'] as $value) {

                                                            $_SESSION['Friend']=$value['Email'];
                                                            echo "<li><a href=''>$value[First_Name]. $value[Last_Name]  <form action='dashboard.php' method=POST ><input type=hidden value=$value[Email] name=email><input type ='submit' name='approved' value='confirm'>&nbsp;&nbsp;<input type ='submit' name='reject' value='reject'></form></a><li>";
                                                        }
                                                    }
                                                    else if(isset($req_list['error'])){
                                                        echo "$req_list[error]";
                                                    }
                                                ?>         
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> Notification<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">menu section</a></li>
                                                <li><a href="#">menu section</a></li>
                                                <li><a href="#">menu section</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"> Setting <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Account setting </a></li>
                                               
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
            <div id="contentwrapper">
                <div class="main_content">
                                     
                    
                    <div class="row-fluid search_page">
                        <div class="span12">
                            <h3 class="heading"><small>Search results for</small> Search term</h3>
                            <div class="well clearfix">
                                <div class="row-fluid">
                                    <div class="pull-left">Showing 1 - 20 of 204 Results</div>
                                    <div class="pull-right">
                                        <span class="sepV_c">
                                            Sort by:
                                            <select>
                                                <option>Name</option>
                                                <option>Date</option>
                                                <option>Relevance</option>
                                            </select>
                                        </span>
                                            <span class="result_view">
											<a href="javascript:void(0)" class="box_trgr sepV_b"><i class="icon-th-large"></i></a>
											<a href="javascript:void(0)" class="list_trgr"><i class="icon-align-justify"></i></a>
										</span>
                                    </div>
                                </div>
                            </div>
                             <div class="search_panel clearfix">
                               <?php                                                       
                                  foreach($search1['success'] as $value){

                                    $name=$value['Email'];
                                    $group1=$value['First_Name'];

                                    if($value['Email']==$_SESSION['group_id']){

                                        echo "                     
                                   <div class='search_item clearfix'>

                                   <span class='searchNb'>1</span>
                                    <div class='thumbnail pull-left'>
                                        <img src=$value[pic] width=80 heigth=80></img>
                                 </div>
                                    <div class='search_content'>
                                        <h4>
                                            $value[First_Name] .$value[Last_Name]
                                        </h4>
                                        <p class='sepH_b item_description'>$value[Email]</p>
                                        <p class='sepH_a'><strong>$value[sign]</strong> </p>
                                        
                                    </div>
                                    </div>";
                                    }       

                                    elseif(!in_array($name,$_SESSION['group_member']))  {

                                        echo "                     
                                   <div class='search_item clearfix'>

                                   <span class='searchNb'>1</span>
                                    <div class='thumbnail pull-left'>
                                        <img src=$value[pic] width=80 heigth=80>
                                 </div>
                                    <div class='search_content'>
                                        <h4>
                                            $value[First_Name] 
                                        </h4>
                                        <p class='sepH_b item_description'>$value[Email]</p>
                                        <p class='sepH_a'><strong>$value[sign]</strong> </p>
                                        <small><form action=invite.php method=POST>
                                        <input type=hidden value=$value[Email] name=email>
                                        <input type=hidden value=$value[Id] name=id>
                                       
                                        <input type=submit class='btn btn-gebo' value='invite' name='submit'>                                      
                                        </form>
                                    </div>
                                    </div>"; 

                                  }

                                   elseif(in_array($name,$_SESSION['group_member']))  {

                                        echo "                     
                                   <div class='search_item clearfix'>

                                   <span class='searchNb'>1</span>
                                    <div class='thumbnail pull-left'>
                                        <img src=$value[pic] width=80 heigth=80>
                                 </div>
                                    <div class='search_content'>
                                        <h4>
                                            $value[First_Name] 
                                        </h4>
                                        <p class='sepH_b item_description'>$value[Email]</p>
                                        <p class='sepH_a'><strong>$value[sign]</strong> </p>
                                        <small><form action=invite.php method=POST>
                                        <input type=hidden value=$value[Email] name=email>
                                        <input type=hidden value=$value[Id] name=id>
                                        <input type=hidden value=$value[First_Name] name=g_name>
                                                                             
                                        </form>
                                    </div>
                                    </div>"; 

                                  }

                                   }                    
                                  
                                  ?>                              
                               </div>
                              
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
							<div class="sidebar_filters">
								<h3>Friend Name</h3>

                                <form action ="search_page.php" method="POST">
								<div class="filter_items">
									<input type="text" class="input-medium" name="find"/>
                                    <input type="submit" value="Search" class="btn btn-gebo" name="search"></form>
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
			 <!-- bootstrap plugins -->
			<script src="js/bootstrap.plugins.min.js"></script>
			<!-- tooltips -->
			<script src="lib/qtip2/jquery.qtip.min.js"></script>
			<!-- jBreadcrumbs -->
			<script src="lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
			<!-- sticky messages -->
            <script src="lib/sticky/sticky.min.js"></script>
			<!-- fix for ios orientation change -->
			<script src="js/ios-orientationchange-fix.js"></script>
			<!-- scrollbar -->
			<script src="lib/antiscroll/antiscroll.js"></script>
			<script src="lib/antiscroll/jquery-mousewheel.js"></script>
			<!-- lightbox -->
            <script src="lib/colorbox/jquery.colorbox.min.js"></script>
            <!-- common functions -->
			<script src="js/gebo_common.js"></script>
            
            <!-- search page functions -->
            <script src="js/gebo_search.js"></script>
    
			<script>
				$(document).ready(function() {
					//* show all elements & remove preloader
					setTimeout('$("html").removeClass("js")',1000);
				});
			</script>
		
		</div>
	</body>
</html>