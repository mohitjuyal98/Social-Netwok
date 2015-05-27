<html>
<head>
	 <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Gebo Admin Panel</title>
    
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
        <!-- splashy icons -->
            <link rel="stylesheet" href="img/splashy/splashy.css" />
        <!-- enhanced select -->
            <link rel="stylesheet" href="lib/chosen/chosen.css" />
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

<?php

include "operation.php";
    session_start(); 
     $date = date_create();

    if(isset($_GET['friend_id'])){
			$_SESSION['friend_id']=$_GET['friend_id'];
		}
  



   		$user= new user();
		if(isset($_POST['submit'])){

			$user->message_send($_SESSION['email'],$_SESSION['friend_id'],$_POST['wg_message'],date_format($date,'Y-m-d H:i:s'));

			header('Location:dashboard.php');
		}
?>
</head>
<body>
			<div class="row-fluid">
								<form action="message.php" method="POST">
							<div class="span4">
								<div class="w-box" id="w_sort05">    
									<div class="w-box-header">
										Message
										<div class="pull-right">
											<i class="splashy-document_letter_upload"></i>
										</div>
									</div>
										<div class="w-box-content cnt_a">
										<div class="sepH_b">
											<label for="w_name">Friend</label>
											<input type="text" name="w_name" id="w_name" value=<?php echo $_SESSION['friend_id'];?> class="span12" disabled/>
										</div>
										<div class="formSep">
											<label for="wg_message">Message</label>
											<textarea name="wg_message" id="wg_message" cols="10" rows="6" class="span12 auto_expand"></textarea>
										</div>
										<div class="clearfix">
											<input type="submit"  name="submit" class="btn btn-gebo pull-right">
										</div>
									</div>
								</div>
							</div>
						</form>
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
			<!-- scrollbar -->
			<script src="lib/antiscroll/antiscroll.js"></script>
			<script src="lib/antiscroll/jquery-mousewheel.js"></script>
			<!-- lightbox -->
            <script src="lib/colorbox/jquery.colorbox.min.js"></script>
            <!-- common functions -->
			<script src="js/gebo_common.js"></script>
			
			<!-- code prettifier -->
			<script src="lib/google-code-prettify/prettify.min.js"></script>
			<!-- plupload and all it's runtimes and the jQuery queue widget (attachments) -->
			<script type="text/javascript" src="lib/plupload/js/plupload.full.js"></script>
			<script type="text/javascript" src="lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.full.js"></script>
			<!-- autosize textareas (new message) -->
			<script src="js/forms/jquery.autosize.min.js"></script>
			<script src="lib/jquery-ui/jquery-ui-1.8.20.custom.min.js"></script>
			<!-- touch events for jquery ui-->
			<script src="js/forms/jquery.ui.touch-punch.min.js"></script>
			<!-- widget functions -->
			<script src="js/gebo_widgets.js"></script>   
			
			<script>
				$(document).ready(function() {
					//* show all elements & remove preloader
					setTimeout('$("html").removeClass("js")',1);
				});
			</script>

					</body>
</html>