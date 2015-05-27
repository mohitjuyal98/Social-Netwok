<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Gebo Admin Panel</title>
    
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="../bootstrap/css/bootstrap-responsive.min.css" />
        <!-- gebo blue theme-->
           <!-- <link rel="stylesheet" href="css/blue.css" id="link_theme" />-->
        <!-- breadcrumbs-->
            <!--<link rel="stylesheet" href="lib/jBreadcrumbs/css/BreadCrumb.css" />-->
        <!-- tooltips-->
            <link rel="stylesheet" href="../lib/qtip2/jquery.qtip.min.css" />
        <!-- colorbox -->
            <link rel="stylesheet" href="../lib/colorbox/colorbox.css" />    
        <!-- code prettify -->
            <link rel="stylesheet" href="../lib/google-code-prettify/prettify.css" />    
        <!-- notifications -->
            <link rel="stylesheet" href="../lib/sticky/sticky.css" />    
        <!-- splashy icons -->
            <link rel="stylesheet" href="../img/splashy/splashy.css" />
        <!-- flags -->
            <!--<link rel="stylesheet" href="img/flags/flags.css" />--> 
        <!-- calendar -->
            <link rel="stylesheet" href="../lib/fullcalendar/fullcalendar_gebo.css" />
            
        <!-- main styles -->
            <link rel="stylesheet" href=../"css/style.css" />
            
            <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" />-->
    
        <!-- Favicon -->
            <link rel="shortcut icon" href="favicon.ico" />
        
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
            <script src="js/ie/respond.min.js"></script>
            <script src="lib/flot/excanvas.min.js"></script>
        <![endif]-->
        
        <script>
            //* hide all elements & show preloader
            //document.documentElement.className += 'js';
        </script>
    <!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  -->

   <?php
    include "../classes/operation.php";
    session_start();
    error_reporting(0);
    $user= new user();
    $req_list=$user->req_list($_SESSION['user_id']);
    $fri_list=$user->fri_list($_SESSION['user_id']);
    $share=$user->share($_SESSION['user_id']);
    
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

    if(is_array($comment)){
        if(isset($comment['success'])){
            
    
        }
    }


    ?>
    </head>
    <body class="gebo-fixed">
        <div id="loading_layer" style="display:none"><img src="../img/ajax_loader.gif" alt="" /></div>
        
        </div>
        
        <div id="maincontainer">
          <div class="main-content" style="margin-left: 260px;margin-top: 59px;">
          
            <div class="col-4 col-sm-10 col-lg-4">
                     <?php
                         $show=$user->show($_SESSION['user_id']);
                                               
                         if(is_array($show))
                            if(isset($show['success'])){
                                foreach($show as $value){
                                    if($value['share_text']!=NULL){
                                        echo "<div><h2> $value[share_by]<h2</div>";
                                        echo "<div><h2>$value[share_text]<h2></div>";
                                        echo "<div><h1>$value[comment_by]<h2></div>";                                                                    

                                }
                                else if($value['share_image']!=NULL){
                                    echo "<div><h2> $value[share_by]<h2</div>";
                                    echo "<div><h2>$value[share_text]<h2></div>";
                                    echo "<div><h1>$value[comment_by]<h2></div>";
                                    }                                                                  
                                }
                             }                                                 
                                                    
                         ?>
            </div><!--/span-->
         </div>
     </div>
 </div>

            <header>
                <div class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">
                            <a class="brand" href="dashboard.html"><i class="icon-home icon-white"></i> Gebo Admin</a>
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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Johny Smith <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="user_profile.html">My Profile</a></li>
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
                                                foreach($req_list as $value)
                                                {
                                                    echo"<li><a href=''><img src='$filename'>$value</a><li>";
                                                }
                                                ?>
                                                <li><a href="form_elements.html">intel</a></li>
                                                <li><a href="form_extended.html">google</a></li>
                                                <li><a href="form_validation.html">good</a></li>
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
                                <form action="index.php?uid=1&amp;page=search_page" class="input-append" method="post" >
                                    <input autocomplete="off" name="query" class="search_query input-medium" size="16" type="text" placeholder="Search..." /><button type="submit" class="btn"><i class="icon-search"></i></button>
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
                                                    <li><a href="javascript:void(0)">All message</a></li>
                                                    <li><a href="javascript:void(0)">Send Message</a></li>
                                                    <li><a href="javascript:void(0)">Recived Message</a></li>
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
                                            <a href="#collapseLong" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle" class="icon-leaf"></i> Create group
                                            </a>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="push"></div>
                            </div>
                               
                            <div class="sidebar_info">
                                <ul class="unstyled">
                                    <li>
                                        <span class="act act-warning">65</span>
                                        <strong>New comments</strong>
                                    </li>
                                    <li>
                                        <span class="act act-success">10</span>
                                        <strong>New articles</strong>
                                    </li>
                                    <li>
                                        <span class="act act-danger">85</span>
                                        <strong>New registrations</strong>
                                    </li>
                                </ul>
                            </div> 
                        
                        </div>
                    </div>
                </div>
            
            </div>
            
            <script src="../js/jquery.min.js"></script>
            <!-- smart resize event -->
            <script src="../js/jquery.debouncedresize.min.js"></script>
            <!-- hidden elements width/height -->
            <script src="../js/jquery.actual.min.js"></script>
            <!-- js cookie plugin -->
            <script src="../js/jquery.cookie.min.js"></script>
            <!-- main bootstrap js -->
            <script src="../bootstrap/js/bootstrap.min.js"></script>
            <!-- tooltips -->
            <script src="../lib/qtip2/jquery.qtip.min.js"></script>
            <!-- jBreadcrumbs -->
            <script src="../lib/jBreadcrumbs/js/jquery.jBreadCrumb.1.1.min.js"></script>
            <!-- lightbox -->
            <script src="../lib/colorbox/jquery.colorbox.min.js"></script>
            <!-- fix for ios orientation change -->
            <script src="../js/ios-orientationchange-fix.js"></script>
            <!-- scrollbar -->
            <script src="../lib/antiscroll/antiscroll.js"></script>
            <script src="../lib/antiscroll/jquery-mousewheel.js"></script>
            <!-- common functions -->
            <script src="../js/gebo_common.js"></script>
            
            <script src="../lib/jquery-ui/jquery-ui-1.8.20.custom.min.js"></script>
            <!-- touch events for jquery ui-->
            <script src="../js/forms/jquery.ui.touch-punch.min.js"></script>
            <!-- multi-column layout -->
            <script src="../js/jquery.imagesloaded.min.js"></script>
            <script src="../js/jquery.wookmark.js"></script>
            <!-- responsive table -->
            <script src="../js/jquery.mediaTable.min.js"></script>
            <!-- small charts -->
            <script src="../js/jquery.peity.min.js"></script>
            <!-- charts -->
            <script src="../lib/flot/jquery.flot.min.js"></script>
            <script src="../lib/flot/jquery.flot.resize.min.js"></script>
            <script src="../lib/flot/jquery.flot.pie.min.js"></script>
            <!-- calendar -->
            <script src="../lib/fullcalendar/fullcalendar.min.js"></script>
            <!-- sortable/filterable list -->
            <script src="../lib/list_js/list.min.js"></script>
            <script src="../lib/list_js/plugins/paging/list.paging.min.js"></script>
            <!-- dashboard functions -->
            <script src="../js/gebo_dashboard.js"></script>
    
            <script>
                $(document).ready(function() {
                    //* show all elements & remove preloader
                    setTimeout('$("html").removeClass("js")',1000);
                });
            </script>
        
        </div>
    </body>
</html>