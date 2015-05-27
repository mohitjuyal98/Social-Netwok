
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Blackhats</title>
    
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
        <!-- gebo blue theme-->
           <!-- <link rel="stylesheet" href="css/blue.css" id="link_theme" />-->
        <!-- breadcrumbs-->
            <!--<link rel="stylesheet" href="lib/jBreadcrumbs/css/BreadCrumb.css" />-->
        <!-- tooltips-->
            <link rel="stylesheet" href="lib/qtip2/jquery.qtip.min.css" />
        <!-- colorbox -->
            <link rel="stylesheet" href="lib/colorbox/colorbox.css" />    
        <!-- code prettify -->
            <link rel="stylesheet" href="lib/google-code-prettify/prettify.css" />    
        <!-- notifications -->
            <link rel="stylesheet" href="lib/sticky/sticky.css" />    
        <!-- splashy icons -->
            <link rel="stylesheet" href="img/splashy/splashy.css" />
        <!-- flags -->
            <!--<link rel="stylesheet" href="img/flags/flags.css" />--> 
        <!-- calendar -->
            <link rel="stylesheet" href="lib/fullcalendar/fullcalendar_gebo.css" />
            
        <!-- main styles -->
            <link rel="stylesheet" href="css/style.css" />
            
            <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />-->
    
        <!-- Favicon -->
            <link rel="shortcut icon" href="favicon.ico" />
        
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
            <script src="js/ie/respond.min.js"></script>
            <script src="lib/flot/excanvas.[]min.js"></script>
        <![endif]-->
        
        <script>
            //* hide all elements & show preloader
            //document.documentElement.className += 'js';
        </script>
         <script src="js/jquery.min.js">
</script>
    <!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  -->

    <?php
    include "operation.php";
    session_start();
    error_reporting(0);



    
   
    //error_reporting(0);
    $user= new user();

     if(isset($_GET['group_name']) && isset($_GET['id']) ){

        $_SESSION['group_name']=$_GET['group_name'];
    $_SESSION['id']= $_GET['id'];
}

    if(isset($_GET['group_id']))
        $_SESSION['group_id']=$_GET['group_id'];

    $personal=$user->search(NULL,$_SESSION['email']);
    $req_list=$user->group_req_list($_SESSION['group_id']);
    $fri_list=$user->group_member($_SESSION['group_id']);
    $create_group=$user->group_info($_SESSION['email'],'create');
    $join_group=$user->group_info($_SESSION['email'],'join');
    


   

    
    
    /*if(is_array($share))
    {
        if(isset($share['text'])){
            $share1="<h3>$share[text]<h3>";
        }
        else if(isset($share['image'])){
            $share1="<img src='$share[image]' width=200 height=200>";
        }

    }*/
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
        

        $user->group_action('approve',$_POST['email'],$_SESSION['group_id']);
    }
    else if(isset($_POST['reject'])){

        $user->group_action('reject',$_POST['email'],$_SESSION['group_id']);
    }
    elseif(isset($_POST['text'])){
        $user->group_share($_SESSION['email'],$_POST['post'],'text',$_SESSION['group_id']);
    }
    elseif(isset($_POST['pic'])){
        
        $user->group_share($_SESSION['email'],$_FILES,'image',$_SESSION['group_id']);
    }

    $_SESSION['user_name']=$personal['success']['0']['First_Name']; 
       

    ?>
    </head>
    <body class="gebo-fixed">    


        <div class="row-fluid"  style="margin-left:260px;margin-top:59px;">
                        <div class="span12">
                            <div class="chat_box">
                                <div class="row-fluid">
                                    <div class="span8 chat_content">

                                        <div><img src=<?php echo $_SESSION['pic']?> width=700 height=200></div><br>
                                         <div>
                                      
                    <form action="group_admin1.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="post" >
                        <input type="submit" name="text" value="post">
                        <div>
                        <input type="file" name="file">
                        <input type="submit" name="pic" value='picture'>
                    </div>
                    </form>
                </div>
                <hr />

               
                 <?php
                         $show=$user->group_show($_SESSION['group_id']);
                                                                                            
                         if(is_array($show))

                            if(isset($show['success'])){

                                foreach($show['success'] as $value){


                                    if(isset($value['share_text'])){
                                       
                                        echo "<pre><div><img src='$value[pic]' width=60 height=60><h3>$value[First_Name]&nbsp;$value[Last_Name]</h3></div>
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
                                                <div id='place$value[share_id]'><button id='button$value[share_id]' >write comment</button><input type='text' id='text$value[share_id]'></div></pre>";
                                                $comment1=$user->comment_access($value['share_id']);
                                        foreach($comment1['success'] as $value3)
                                               echo "<pre><div><img src='$value3[pic]'  width=50 height=50>&nbsp;&nbsp;$value3[comment]||$value3[comment_by]</div></pre>";


                                }
                                else if(isset($value['share_pic'])){
                                    echo "<pre><div><img src='$value[pic]' width=60 height=60><h3>$value[First_Name]&nbsp;$value[Last_Name]</h3></div>
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
                                                <div id='place$value[share_id]'><button id='button$value[share_id]' >write comment</button><input type='text' id='text$value[share_id]'></div></pre>";
                                                $comment1=$user->comment_access($value['share_id']);
                                        foreach($comment1['success'] as $value3)
                                             echo "<pre><div><img src='$value3[pic]'  width=50 height=50>&nbsp;&nbsp;$value3[comment]||$value3[comment_by]</div></pre>";
                                    
                                    }                                                                  
                                }
                             }

                             elseif(isset($show['error'])){
                                echo "<div><pre> $show[error]</pre></div>";

                             }                                                 
                                                    
                         ?>

                                    </div>
                                    <div class="span3 chat_sidebar">
                                        <div class="chat_heading clearfix">
                                            <div class="btn-group pull-right">
                                                <a href="#" class="btn btn-mini ttip_t" title="Refresh list"><i class="icon-refresh"></i></a>
                                                <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-mini ttip_t" title="Options"><i class="icon-cog"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Ban selected users</a></li>
                                                    <li><a href="#">Another action</a></li>
                                                </ul>   
                                            </div>
                                            Group Member
                                        </div>
                                        <ul class="chat_user_list">


                                            <?php                            
                                   


                                    if(isset($fri_list['success'])){
                                        foreach($fri_list['success'] as $value){

                                            $arr[]=$value['Email'];

                                           
                                    echo " <li class=online active chat_you>  

                                    <a href=message.php?friend_id=$value[Email] target=_blank>
                                      
                                    <img src=http://www.placehold.it/30x30/EFEFEF/AAAAAA alt= />   

                                    $value[First_Name] <span></span>   </a>

                                        
                                    </li>";
                                }
                                $_SESSION['group_member']=$arr;

                               
                            }
                                elseif(isset($fri_list['error'])){

                              // $_SESSION['group_member']="";
                           }
                               
                                    ?>                                          
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div>
                       </div>              
                       
              <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="dashboard.html"><i class="icon-home icon-white"></i><i>Blackhats</i></a>
                            <ul class="nav user_menu pull-right">
                                <li class="hidden-phone hidden-tablet">
                                    <div class="nb_boxes clearfix">
                                        <a data-toggle="modal" data-backdrop="static" href="#myMail" class="label ttip_b" title="New messages">25 <i class="splashy-mail_light"></i></a>
                                        <a data-toggle="modal" data-backdrop="static" href="#myTasks" class="label ttip_b" title="New tasks">10 <i class="splashy-calendar_week"></i></a>
                                    </div>
                                </li>
                                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                                
                                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                                <li class="dropdown">

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['group_name'];?>(Admin)<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="group_profile.php">My Profile</a></li>
                                        <li><a href="javascrip:void(0)">Another action</a></li>
                                        <li class="divider"></li>
                                        <li><a href="login.html">Log Out</a></li>
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
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-list-alt icon-white"></i> Friend Request<b class="caret"></b></a>
                                            <ul class="dropdown-menu">

                                                <?php
                                                        if(isset($req_list['success'])){
                                                        foreach ($req_list['success'] as $value) {

                                                            $_SESSION['Friend']=$value['Email'];
                                                            echo "<li>$value[First_Name]. $value[Last_Name]  <form action='group_admin.php' method=POST ><input type=hidden value=$value[Email] name=email><input type ='submit' name='approved' value='confirm'>&nbsp;&nbsp;<input type ='submit' name='reject' value='reject'></form></a><li>";
                                                        }
                                                    }
                                                    else if(isset($req_list['error'])){
                                                        echo "$req_list[error]";
                                                    }


                                                ?>
                                                
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th icon-white"></i> Notification <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="form_elements.html">intel comment on share</a></li>
                                                <li><a href="form_extended.html">google comment on share</a></li>
                                                <li><a href="form_validation.html">good comment on share </a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-wrench icon-white"></i> Setting <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="charts.html">google</a></li>
                                                <li><a href="calendar.html">intel</a></li>                                             
                                            </ul>
                                        </li>                                                                             
                                        <li>
                                            <a href="documentation.html"><i class="icon-book icon-white"></i> Help</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal hide fade" id="myMail">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button>
                        <h3>New messages</h3>
                    </div>
                    
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="btn">Go to mailbox</a>
                    </div>
                </div>
                <div class="modal hide fade" id="myTasks">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button>
                        <h3>New Tasks</h3>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">In this table jquery plugin turns a table row into a clickable link.</div>
                        <table class="table table-condensed table-striped" data-rowlink="a">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Summary</th>
                                    <th>Updated</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>P-23</td>
                                    <td><a href="javascript:void(0)">Admin should not break if URL&hellip;</a></td>
                                    <td>23/05/2012</td>
                                    <td class="tac"><span class="label label-important">High</span></td>
                                    <td>Open</td>
                                </tr>
                                <tr>
                                    <td>P-18</td>
                                    <td><a href="javascript:void(0)">Displaying submenus in custom&hellip;</a></td>
                                    <td>22/05/2012</td>
                                    <td class="tac"><span class="label label-warning">Medium</span></td>
                                    <td>Reopen</td>
                                </tr>
                                <tr>
                                    <td>P-25</td>
                                    <td><a href="javascript:void(0)">Featured image on post types&hellip;</a></td>
                                    <td>22/05/2012</td>
                                    <td class="tac"><span class="label label-success">Low</span></td>
                                    <td>Updated</td>
                                </tr>
                                <tr>
                                    <td>P-10</td>
                                    <td><a href="javascript:void(0)">Multiple feed fixes and&hellip;</a></td>
                                    <td>17/05/2012</td>
                                    <td class="tac"><span class="label label-warning">Medium</span></td>
                                    <td>Open</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="btn">Go to task manager</a>
                    </div>
                </div>
            </header>
            
            <!-- main content -->
            <div class="container">

            </div>
            
            <!-- sidebar -->
            <a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
            <div class="sidebar">
                
                <div class="antiScroll">
                    <div class="antiscroll-inner">
                        <div class="antiscroll-content">
                    
                            <div class="sidebar_inner">
                                <form action="invite.php" class="input-append" method="POST" >
                                    <input autocomplete="off"  class="search_query input-medium" size="16" type="text"  name="find"/><button type="submit" class="btn" name="search"><i class="icon-search"></i></button>
                                </form>
                                <div id="side_accordion" class="accordion">
                                    
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a href="#collapseOne" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                                <i class="icon-folder-close"></i> Content
                                            </a>
                                        </div>
                                        <div class="accordion-body collapse" id="collapseOne">
                                            <div class="accordion-inner">
                                                <ul class="nav nav-list">
                                                    <li><a href="javascript:void(0)">Articles</a></li>
                                                    <li><a href="javascript:void(0)">News</a></li>
                                                    <li><a href="javascript:void(0)">Newsletters</a></li>
                                                    <li><a href="javascript:void(0)">Comments</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a href="#collapseTwo" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                                <i class="icon-th"></i> Message
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
                                                <i class="icon-user"></i> Group
                                            </a>
                                        </div>
                                        <div class="accordion-body collapse" id="collapseThree">
                                            <div class="accordion-inner">
                                                <ul class="nav nav-list">
                                                    <li><a href="javascript:void(0)">gropu 1</a></li>
                                                    <li><a href="javascript:void(0)">group 2</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a href="#collapseFour" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                                                <i class="icon-cog"></i> Setting
                                            </a>
                                        </div>
                                        <div class="accordion-body collapse" id="collapseFour">
                                            <div class="accordion-inner">
                                                <ul class="nav nav-list">
                                                    <li class="nav-header">People</li>
                                                    <li class="active"><a href="javascript:void(0)">Account Settings</a></li>
                                                    <li><a href="javascript:void(0)">IP Adress Blocking</a></li>
                                                    <li class="nav-header">System</li>
                                                    <li><a href="javascript:void(0)">Site information</a></li>
                                                    <li><a href="javascript:void(0)">Actions</a></li>
                                                    <li><a href="javascript:void(0)">Cron</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="javascript:void(0)">Help</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a href="group_reg.php" target="_blank" ></i> Create group</a>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="push"></div>
                            </div>
                               
                            <div class="sidebar_info">
                                <ul class="unstyled">
                                    
                                </ul>
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
            <!-- jBreadcrumbs -->
            <script src="lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
            <!-- lightbox -->
            <script src="lib/colorbox/jquery.colorbox.min.js"></script>
            <!-- fix for ios orientation change -->
            <script src="js/ios-orientationchange-fix.js"></script>
            <!-- scrollbar -->
            <script src="lib/antiscroll/antiscroll.js"></script>
            <script src="lib/antiscroll/jquery-mousewheel.js"></script>
            <!-- common functions -->
            <script src="js/gebo_common.js"></script>
            
            <script src="lib/jquery-ui/jquery-ui-1.8.20.custom.min.js"></script>
            <!-- touch events for jquery ui-->
            <script src="js/forms/jquery.ui.touch-punch.min.js"></script>
            <!-- multi-column layout -->
            <script src="js/jquery.imagesloaded.min.js"></script>
            <script src="js/jquery.wookmark.js"></script>
            <!-- responsive table -->
            <script src="js/jquery.mediaTable.min.js"></script>
            <!-- small charts -->
            <script src="js/jquery.peity.min.js"></script>
            <!-- charts -->
            <script src="lib/flot/jquery.flot.min.js"></script>
            <script src="lib/flot/jquery.flot.resize.min.js"></script>
            <script src="lib/flot/jquery.flot.pie.min.js"></script>
            <!-- calendar -->
            <script src="lib/fullcalendar/fullcalendar.min.js"></script>
            <!-- sortable/filterable list -->
            <script src="lib/list_js/list.min.js"></script>
            <script src="lib/list_js/plugins/paging/list.paging.min.js"></script>
            <!-- dashboard functions -->
            <script src="js/gebo_dashboard.js"></script>
    
            <script>
                $(document).ready(function() {
                    //* show all elements & remove preloader
                    setTimeout('$("html").removeClass("js")',1000);
                });
            </script>
        
        </div>
    </body>
</html>