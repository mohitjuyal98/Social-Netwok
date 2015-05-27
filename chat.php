<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Gebo Admin Panel</title>
    
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
            <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css" />
        <!-- jQuery UI theme-->
            <link rel="stylesheet" href="lib/jquery-ui/css/Aristo/Aristo.css" />
		<!-- gebo blue theme-->
            <link rel="stylesheet" href="css/blue.css" id="link_theme" />
        <!-- breadcrumbs-->
            <link rel="stylesheet" href="lib/jBreadcrumbs/css/BreadCrumb.css" />
        <!-- tooltips-->
            <link rel="stylesheet" href="lib/qtip2/jquery.qtip.min.css" />
        <!-- notifications -->
            <link rel="stylesheet" href="lib/sticky/sticky.css" />    
        <!-- splashy icons -->
            <link rel="stylesheet" href="img/splashy/splashy.css" />
		<!-- colorbox -->
            <link rel="stylesheet" href="lib/colorbox/colorbox.css" />
		<!-- CLEditor -->
            <link rel="stylesheet" href="lib/CLEditor/jquery.cleditor.css" />
			
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
		<div id="loading_layer" style="display:none"></div>
		
		<div id="maincontainer" class="clearfix">
			<!-- header -->
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
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-list-alt icon-white"></i>Friend Request<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="form_elements.html">Intel</a></li>
                                                <li><a href="form_extended.html">Google</a></li>
                                                <li><a href="form_validation.html">Microsoft</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th icon-white"></i>Notifications<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="alerts_btns.html">intel comment on share</a></li>
                                                <li><a href="icons.html">Google coommct on post</a></li>
                                                <li><a href="notifications.html">Microsoft like you post</a></li>
                                               			
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-wrench icon-white"></i> Setting <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="charts.html">Account Setting</a></li>
                                                <li><a href="calendar.html">Personal Setting</a></li>
                                            </ul>
                                        </li>
                                        
                                        <li>
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
                    <div class="modal-body">
                        <div class="alert alert-info">In this table jquery plugin turns a table row into a clickable link.</div>
                       
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
                        
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0)" class="btn">Go to task manager</a>
                    </div>
                </div>
            </header>
            
            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content">
                                        
					<div class="row-fluid">
						<div class="span12">
							<div class="chat_box">
								<div class="row-fluid">
									<div class="span8 chat_content">
										<div class="chat_heading clearfix">
											<div class="pull-right"><i class="icon-remove chat_close"></i></div>
											Active users: <span class="act_users">2</span>
										</div>
										
										<div class="msg_window">
											<div class="chat_msg clearfix msg_clone" style="display:none">
												<div class="chat_msg_heading"><span class="chat_msg_date"></span><span class="chat_user_name"></span></div>
												<div class="chat_msg_body"></div>
											</div>
											
											<div class="chat_msg clearfix">
												<div class="chat_msg_heading"><span class="chat_msg_date">12:44</span><span class="chat_user_name">Summer Throssell</span></div>
												<div class="chat_msg_body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at porta odio. Sed non consectetur neque. Donec nec enim eget ligula tristique scelerisque.</div>
											</div>
											
											<div class="chat_msg clearfix">
												<div class="chat_msg_heading"><span class="chat_msg_date">12:46</span><span class="chat_user_name">Johny Smith</span></div>
												<div class="chat_msg_body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at porta odio. Sed non consectetur neque. Donec nec enim eget ligula tristique scelerisque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at porta odio. Sed non consectetur neque. Donec nec enim eget ligula tristique scelerisque.</div>
											</div>
											
										</div>
										
										<div class="chat_editor_box">
											<textarea name="chat_editor" id="chat_editor" cols="30" rows="3" class="span12"></textarea>
											<div class="btn-group send_btns">
												<a href="#" class="btn btn-mini send_msg">Send</a><a href="javascript:void(0)" class="btn btn-mini enter_msg active" data-toggle="button"><i class="icon-adt_enter"></i></a>
											</div>
											
											<input type="hidden" name="chat_user" id="chat_user" value="Johny Smith" />
										</div>
									</div>
									<div class="span4 chat_sidebar">
										<div class="chat_heading clearfix">
											<div class="btn-group pull-right">
												<a href="#" class="btn btn-mini ttip_t" title="Refresh list"><i class="icon-refresh"></i></a>
												<a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-mini ttip_t" title="Options"><i class="icon-cog"></i></a>
												<ul class="dropdown-menu">
													<li><a href="#">Ban selected users</a></li>
													<li><a href="#">Another action</a></li>
												</ul>	
											</div>
											User list
										</div>
										<ul class="chat_user_list">
											<li class="online active chat_you">
												<a href="javascript:void(0)">
													<img src="http://www.placehold.it/30x30/EFEFEF/AAAAAA" alt="" />
													Johny Smith <span>(you)</span>
												</a>
											</li>
											<li class="online active">
												<input type="checkbox" name="chat_user" />
												<a href="#">
													<img src="http://www.placehold.it/30x30/EFEFEF/AAAAAA" alt="" />
													Summer Throssell
												</a>
											</li>
											<li class="online">
												<input type="checkbox" name="chat_user" />
												<a href="#">
													<img src="http://www.placehold.it/30x30/EFEFEF/AAAAAA" alt="" />
													Declan Pamphlett
												</a>
											</li>
											<li class="offline">
												<input type="checkbox" name="chat_user" />
												<a href="#">
													<img src="http://www.placehold.it/30x30/EFEFEF/AAAAAA" alt="" />
													Erin Church
												</a>
											</li>
											<li class="online">
												<input type="checkbox" name="chat_user" />
												<a href="#">
													<img src="http://www.placehold.it/30x30/EFEFEF/AAAAAA" alt="" />
													Koby Auld
												</a>
											</li>
										</ul>
									</div>
								</div>
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
													<li><a href="javascript:void(0)">All Message</a></li>
													<li><a href="javascript:void(0)">Send Message</a></li>
													<li><a href="javascript:void(0)">Recive Message</a></li>
													
												</ul>
											</div>
										</div>
									</div>
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapseThree" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
												<i class="icon-user"></i> Group Setting
											</a>
										</div>
										<div class="accordion-body collapse" id="collapseThree">
											<div class="accordion-inner">
												<ul class="nav nav-list">
													<li><a href="javascript:void(0)">Members</a></li>
													<li><a href="javascript:void(0)">Members groups</a></li>
													<li><a href="javascript:void(0)">Users</a></li>
													<li><a href="javascript:void(0)">Users groups</a></li>
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
												</ul>
											</div>
										</div>
									</div>																			
								
									<div class="accordion-group">
										<div class="accordion-heading">
											<a href="#collapse7" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
											   <i class="icon-th"></i> Create group
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
			<!-- fix for ios orientation change -->
			<script src="js/ios-orientationchange-fix.js"></script>
            <!-- scroll -->
			<script src="lib/antiscroll/antiscroll.js"></script>
			<script src="lib/antiscroll/jquery-mousewheel.js"></script>
			<!-- common functions -->
			<script src="js/gebo_common.js"></script>
			
			<!-- CLEditor -->
			<script src="lib/CLEditor/jquery.cleditor.js"></script>
			<script src="lib/CLEditor/jquery.cleditor.icon.min.js"></script>
			<!-- date library -->
			<script src="lib/moment_js/moment.min.js"></script>
			<!-- chat functions -->
			<script src="js/gebo_chat.js"></script>
			
			<script>
				$(document).ready(function() {
					//* show all elements & remove preloader
					setTimeout('$("html").removeClass("js")',1000);
				});
			</script>
		
		</div>
	</body>
</html>