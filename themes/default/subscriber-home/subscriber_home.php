
<!DOCTYPE html>
<html lang="ru-RU">
<head>
	<title></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="csrf-param" content="_csrf">
	<meta name="csrf-token" content="5-v4uJtZoelSpp40ZNgJ6C_QfKY5aOhc5zUcJgBK-0Vfu8ciJgIjJczfN3IVorjJUc3nDFefExUdsE5I1VjIgg==">
	<link href="\assets\295aed4b\css\bootstrap.css" rel="stylesheet">
	<link href="\assets\427dbdf7\css\font-awesome.min.css" rel="stylesheet">
	<link href="\css\jquery.fancybox.min.css" rel="stylesheet">
	<link href="\css\style.css" rel="stylesheet">
<body class="ca-default-index patient-registred">

<div id="header">
	<div class="clearfix">
		<div class="col-sm-4 col-xs-12">
			<a href="http://dev.savelifeid.com/subscriber-home"><img class="header-logo__img" src="/img/savelife logo.jpg" height="100"></a>
		</div>
		<div class="col-sm-8 col-xs-12 cr">
			<div id="signin-area">
				Signed in: Stripe Test - <a href='/'>sign out</a>               <div id="mainMenu">
					<!-- Session Progress Indicator -->
					<div class="session-countdowner" style="margin-top:0;height:30px">
						<div class="col-sm-7 col-xs-12 lpd">
							<div class="progress" style="height:7px;margin:7px 0 0 0">
								<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
							</div>
						</div>
						<div class="col-sm-5 col-xs-12 nop">Auto logout <time class="relative">in 20 minutes</time></div>
					</div>

					<!-- Page links -->
					<div class="btn-group">
                        <a class="title-mobile-icon btn btn-primary" href="/subscriberhome/subscriber_home"><span class='title-desktop'>Subscriber Home</span>
                            <span class='title-mobile'><i class="glyphicon glyphicon-home"></i></span>
                        </a>
                        <a class=" btn btn-default" href="/subscriberhome/account" item-hrefs='["\/subscriberhome\/account","\/subscriberhome\/account-cancel","\/subscriberhome\/account-status","\/subscriberhome\/account-security","\/subscriberhome\/account-support"]'>
                            <span class='title-desktop'>Account Information</span>
                            <span class='title-mobile'>Account</span></a>
                        <a class=" btn btn-default" href="/subscriberhome/record">
                            <span class='title-desktop'>Full Medical Info</span>
                            <span class='title-mobile'>MedInfo</span>
                        </a>
                        <a class=" btn btn-default" href="https://devprofile.savelifeid.com/profile/stripe_test_internal_id" target="_blank">
                            <span class='title-desktop'>Emergency Profile</span>
                            <span class='title-mobile'>Profile</span>
                        </a>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<div id="mainContent" class="content"> <h1>Welcome, Stripe Test</h1>
</div>     <!-- Modal -->
<div class="modal fade" id="signIN" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button onClick="setTimeout(signINclear,500)" type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="signinTitle">Sign In</h4>
			</div>
			<div class="modal-footer">
				<button onClick="setTimeout(signINclear,500)" id="closeButton" class="btn btn-default" data-dismiss="modal">Close</button>
				<button onClick="signIN();" id="signinButton" type="submit" class="btn btn-success">Sign In</button>
			</div>
		</div>
	</div>
</div>


<div id="messager-system-wrapper"></div>
<script src="\assets\d3c1d895\jquery.js"></script>
<script src="\assets\e8aaf060\yii.js"></script>
<script src="\assets\295aed4b\js\bootstrap.js"></script>
<script src="\js\jquery.fancybox.min.js"></script>
<script src="\js\functions.js"></script>
<script src="\js\session-countdown.js"></script>
<script src="\js\stateful-title.js"></script>
<script src="\js\eModal.min.js"></script>
<script src="\js\messager.js"></script>
<script src="\assets\6bcfab7c\js\activeform.js"></script>
<script src="\assets\e8aaf060\yii.activeForm.js"></script>
</body>
</html>
