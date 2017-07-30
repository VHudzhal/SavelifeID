

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Account Information</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="csrf-param" content="_csrf">
	<meta name="csrf-token" content="-JQNIzdNkdKMMFlP2nNknZ7_HlwhlAAfFg6PHBLyG31AxDK5ihYTHhJJ8AmrCdW84OKF9k9j-1bsi91yx-Aoug==">
	<link href="/assets/295aed4b/css/bootstrap.css" rel="stylesheet">
	<link href="/assets/427dbdf7/css/font-awesome.min.css" rel="stylesheet">
	<link href="/css/jquery.fancybox.min.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">
	<link href="/assets/6bcfab7c/css/activeform.css" rel="stylesheet"></head>
<body class="ca-default-account-security patient-registred">

<div id="mainContent" class="content"> <div class="content">
		<div class="col-xs-12"><h1>Account Information</h1></div>
		<div class="admin-content-wrapper">
			<div class="admin-content-wrapper">
				<div class="col-xs-4">
					<ul class="nav nav-pills nav-stacked">
						<li class="">
							<a class="" href="/subscriberhome/account" data-target="#">
								<span class="glyphicon glyphicon-user"></span>Personal information<span class="glyphicon glyphicon-chevron-right right"></span>
								<div class="clearfix"></div>
							</a>
						</li>
						<li class=""><a class="" href="/subscriberhome/account-cancel" data-target="#">
								<span class="glyphicon glyphicon-remove-sign"></span>Cancel lost or stolen card<span class="glyphicon glyphicon-chevron-right right"></span>
								<div class="clearfix"></div>
							</a>
						</li>
						<li class="">
							<a class="" href="/subscriberhome/account-status" item-hrefs='["\/subscriberhome\/previous-payments","\/subscriberhome\/account-status"]' data-target="#"><span class="glyphicon glyphicon-check"></span>Subscription status<span class="glyphicon glyphicon-chevron-right right"></span>
								<div class="clearfix"></div>
							</a>
						</li>
						<li class="active">
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
				</div>			<div class="col-xs-8 tab-pane fade in active panel panel-default">
				<div class="panel-body">
					<h3 class="pointer" data-toggle="collapse" data-target="#chMyPass">Change my password</h3>
					<div id="chMyPass" class="panel-change-password">

						<form id="subscriber-home-security-change-password-form" class="kvk-ajax-form form-vertical" action="/subscriberhome/account-security" method="post" data-target=".panel-change-password">
							<input type="hidden" name="_csrf" value="-JQNIzdNkdKMMFlP2nNknZ7_HlwhlAAfFg6PHBLyG31AxDK5ihYTHhJJ8AmrCdW84OKF9k9j-1bsi91yx-Aoug=="><input type="hidden" name="form_scenario" value="change-password">
							<p>Your password must be at least 8 characters long. Ideally it will be longer. Do not choose common words or names. Including numbers or punctuation characters or even non-English characters can make your password stronger, but that is up to you.</p>
							<div class="row">
								<div class="alert alert-danger" style="display:none"><ul></ul></div>      <div class="form-group col-md-4 margin-bottom-0 field-changepasswordform-old_password required">
									<div class='form-group'><label class="control-label" for="changepasswordform-old_password">Current password</label>:<div class='input-group'><input type="password" id="changepasswordform-old_password" class="form-control" name="ChangePasswordForm[old_password]" autocomplete="off" aria-required="true"><div class='input-group-btn'>
                                                    <button type="submit" form="signInForm" class="btn btn-default" tabindex="999">I forgot</button>
                                            </div></div></div>
								</div>      <div class="form-group col-md-4 margin-bottom-0 field-changepasswordform-password required">

									<div class='form-group'><label class="control-label" for="changepasswordform-password">New password</label>:<input type="password" id="changepasswordform-password" class="form-control" name="ChangePasswordForm[password]" autocomplete="off" aria-required="true"><div class="help-block alert alert-danger"></div></div>
								</div>      <div class="form-group col-md-4 margin-bottom-0 field-changepasswordform-password_repeat required">

									<div class='form-group'><label class="control-label" for="changepasswordform-password_repeat">Retype password</label>:<input type="password" id="changepasswordform-password_repeat" class="form-control" name="ChangePasswordForm[password_repeat]" autocomplete="off" aria-required="true"><div class="help-block alert alert-danger"></div></div>
								</div>    </div>

							<button type="submit" class="btn btn-default right" style="margin-top:25px">Change password</button>

						</form>
						<div style="display: none;">
							<form id="signInForm" class="form-vertical" action="/login" method="post">
								<input type="hidden" name="_csrf" value="-JQNIzdNkdKMMFlP2nNknZ7_HlwhlAAfFg6PHBLyG31AxDK5ihYTHhJJ8AmrCdW84OKF9k9j-1bsi91yx-Aoug=="><input type="hidden" name="form_scenario" value="default">                <input type="text" id="loginform-email" class="form-control" name="LoginForm[email]" value="stripe@kashirinsoftware.com">
								<input type="text" id="loginform-forgot" class="form-control" name="LoginForm[forgot]" value='1' >

								<script type="text/javascript">
                                    setTimeout(function(){
                                        var $el=jQuery("#subscriber-home-security-change-password-form .kv-hint-special");if($el.length){$el.each(function(){$(this).activeFieldHint()});}
                                        jQuery('#subscriber-home-security-change-password-form').yiiActiveForm([{"id":"changepasswordform-old_password","name":"old_password","container":".field-changepasswordform-old_password","input":"#changepasswordform-old_password","error":".help-block.alert.alert-danger","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Current password cannot be blank."});}},{"id":"changepasswordform-password","name":"password","container":".field-changepasswordform-password","input":"#changepasswordform-password","error":".help-block.alert.alert-danger","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"New password cannot be blank."});yii.validation.string(value, messages, {"message":"New password must be a string.","min":8,"tooShort":"New password should contain at least 8 characters.","skipOnEmpty":1});yii.validation.regularExpression(value, messages, {"pattern":/^(?=.*[0-9])(.*)$/,"not":false,"message":"at least one digit required","skipOnEmpty":1});}},{"id":"changepasswordform-password_repeat","name":"password_repeat","container":".field-changepasswordform-password_repeat","input":"#changepasswordform-password_repeat","error":".help-block.alert.alert-danger","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Retype password cannot be blank."});yii.validation.compare(value, messages, {"operator":"==","type":"string","compareAttribute":"changepasswordform-password","skipOnEmpty":1,"message":"Passwords don't match"});}}], []);
                                    }, 1000);
								</script>

							</form>    </div>

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
<script src="/js/ajax-form.js"></script>
<script src="/assets/6bcfab7c/js/activeform.js"></script>
<script src="/assets/e8aaf060/yii.validation.js"></script>
<script src="/assets/e8aaf060/yii.activeForm.js"></script>
<script type="text/javascript">jQuery(document).ready(function () {
        var $el=jQuery("#subscriber-home-security-change-password-form .kv-hint-special");if($el.length){$el.each(function(){$(this).activeFieldHint()});}
        jQuery('#subscriber-home-security-change-password-form').yiiActiveForm([{"id":"changepasswordform-old_password","name":"old_password","container":".field-changepasswordform-old_password","input":"#changepasswordform-old_password","error":".help-block.alert.alert-danger","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Current password cannot be blank."});}},{"id":"changepasswordform-password","name":"password","container":".field-changepasswordform-password","input":"#changepasswordform-password","error":".help-block.alert.alert-danger","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"New password cannot be blank."});yii.validation.string(value, messages, {"message":"New password must be a string.","min":8,"tooShort":"New password should contain at least 8 characters.","skipOnEmpty":1});yii.validation.regularExpression(value, messages, {"pattern":/^(?=.*[0-9])(.*)$/,"not":false,"message":"at least one digit required","skipOnEmpty":1});}},{"id":"changepasswordform-password_repeat","name":"password_repeat","container":".field-changepasswordform-password_repeat","input":"#changepasswordform-password_repeat","error":".help-block.alert.alert-danger","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Retype password cannot be blank."});yii.validation.compare(value, messages, {"operator":"==","type":"string","compareAttribute":"changepasswordform-password","skipOnEmpty":1,"message":"Passwords don't match"});}}], []);
        var $el=jQuery("#signInForm .kv-hint-special");if($el.length){$el.each(function(){$(this).activeFieldHint()});}
        jQuery('#signInForm').yiiActiveForm([], []);

        $(document).on('blur keyup', '#changepasswordform-password, #changepasswordform-password_repeat', function(){
            $('#subscriber-home-security-change-password-form').yiiActiveForm('validateAttribute', $(this).attr('id'));
        });

        $(document).on('keyup', '#changepasswordform-password_repeat', function(){
            setTimeout(function(){
                var p1 = $('#changepasswordform-password').val();
                var p2 = $('#changepasswordform-password_repeat').val();
                // p1 = p1.substr(0, p2.length);

                if (p1 != p2) {
                    $('#subscriber-home-security-change-password-form').yiiActiveForm('updateAttribute', 'changepasswordform-password_repeat', ['Passwords don\'t match']);
                } else {
                    $('#subscriber-home-security-change-password-form').yiiActiveForm('updateAttribute', 'changepasswordform-password_repeat', []);
                }
            }, 100);
        });


    });</script></body>
</html>

