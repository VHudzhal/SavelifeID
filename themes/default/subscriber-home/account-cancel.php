

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Account Information</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="csrf-param" content="_csrf">
	<meta name="csrf-token" content="xfWF1R8a4IptoIJ_809dOTA3Rlw9KVnu7wD8gXlPi1l9pbpPokFiRvPZKzmCNewYTird9lPeoqcVha7vrF24ng==">
	<link href="/assets/295aed4b/css/bootstrap.css" rel="stylesheet">
	<link href="/assets/427dbdf7/css/font-awesome.min.css" rel="stylesheet">
	<link href="/css/jquery.fancybox.min.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet"></head>
<body class="ca-default-account-cancel patient-registred">


<div id="mainContent" class="content">
	<div class="content">
		<div class="col-xs-12"><h1>Account Information</h1></div>
		<div class="admin-content-wrapper">
			<div class="col-xs-4">
				<ul class="nav nav-pills nav-stacked">
					<li class="">
						<a class="" href="/subscriberhome/account" data-target="#">
							<span class="glyphicon glyphicon-user"></span>Personal information<span class="glyphicon glyphicon-chevron-right right"></span>
							<div class="clearfix"></div>
						</a>
					</li>
					<li class="active"><a class="" href="/subscriberhome/account-cancel" data-target="#">
							<span class="glyphicon glyphicon-remove-sign"></span>Cancel lost or stolen card<span class="glyphicon glyphicon-chevron-right right"></span>
							<div class="clearfix"></div>
						</a>
					</li>
					<li class="">
						<a class="" href="/subscriberhome/account-status" item-hrefs='["\/subscriberhome\/previous-payments","\/subscriberhome\/account-status"]' data-target="#"><span class="glyphicon glyphicon-check"></span>Subscription status<span class="glyphicon glyphicon-chevron-right right"></span>
							<div class="clearfix"></div>
						</a>
					</li>
					<li class="">
						<a class="" href="/subscriberhome/account-security" data-target="#">
							<span class="glyphicon glyphicon-lock"></span>Security<span class="glyphicon glyphicon-chevron-right right"></span>
							<div class="clearfix"></div>
						</a>
					</li>
					<li class="">
						<a class="" href="/subscriberhome/account-support" data-target="#">
							<span class="glyphicon glyphicon-question-sign"></span>Support<span class="glyphicon glyphicon-chevron-right right"></span>
							<div class="clearfix"></div>
						</a>
					</li>
				</ul>
			</div>
			<div class="col-xs-8 tab-pane fade in active panel panel-default"><div class="panel-body panel-cancel-lost-or-stolen-card">
					<h3>Cancel lost or stolen card</h3>

					<div class="alert alert-danger">
						No associated card found.
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
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
<script src="/assets/d3c1d895/jquery.js"></script>
<script src="/assets/e8aaf060/yii.js"></script>
<script src="/assets/295aed4b/js/bootstrap.js"></script>
<script src="//cdn.jsdelivr.net/jquery.cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="/js/jquery.fancybox.min.js"></script>
<script src="/js/functions.js"></script>
<script src="/js/session-countdown.js"></script>
<script src="/js/stateful-title.js"></script>
<script src="/js/eModal.min.js"></script>
<script src="/js/messager.js"></script>
<script src="/js/ajax-form.js"></script></body>
</html>

