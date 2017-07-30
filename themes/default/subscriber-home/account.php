<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account Information</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token"
          content="mFxktGyqySCvckyaeskKLsxAl42Q81vkSZGJ_0mXByYgDFsu0fFL7DEL5dwLs7sPsl0MJ_4EoK2zFNuRnIU04Q==">
    <link href="/assets/295aed4b/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/427dbdf7/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/assets/6bcfab7c/css/activeform.css" rel="stylesheet">
    <link href="/css/jquery.fileupload.css" rel="stylesheet">
    <script type="text/javascript" >
        $(function(){
            var btnUpload=$('#w0');
            new AjaxUpload(btnUpload, {
                action: 'uploader_profile.php',
                name: 'uploadfile',
                onSubmit: function(file, ext){
                    if (! (ext && /^(bmp|jpg|png|jpeg|gif)$/.test(ext))){
                        // extension is not allowed
                        status.text('Поддерживаемые форматы bmp, jpg, jpeg, png, gif');
                        return false;
                    }
                    status.text('Загрузка...');
                },
                onComplete: function(file, response){
                    //On completion clear the status
                    status.text('');
                    //Add uploaded file to list
                    if(response==="success"){
                        $('<li></li>').appendTo('#patient-picture').html('<img src="./uploads/'+file+'" alt=""><br>'+file).addClass('success');
                    } else{
                        $('<li></li>').appendTo('#patient-picture').text('Файл не загружен!' + file).addClass('error');
                    }
                }
            });

        });
    </script>
</head>
<body class="ca-default-account patient-registred">

<div id="mainContent" class="content">
    <div class="content">
        <div class="col-xs-12"><h1>Account Information</h1></div>
        <div class="admin-content-wrapper">
            <div class="col-xs-4">
                <ul class="nav nav-pills nav-tabs nav-stacked">
                    <li class="active">
                        <a class="" href="/subscriberhome/account" data-target="#">
                            <span class="glyphicon glyphicon-user"></span>Personal information<span
                                    class="glyphicon glyphicon-chevron-right right"></span>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="/subscriberhome/account-cancel" data-target="#">
                            <span class="glyphicon glyphicon-remove-sign"></span>Cancel lost or stolen card<span
                                    class="glyphicon glyphicon-chevron-right right"></span>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="/subscriberhome/account-status"
                           item-hrefs='["\/subscriber-home\/previous-payments","\/subscriber-home\/account-status"]'
                           data-target="#">
                            <span class="glyphicon glyphicon-check"></span>Subscription status<span
                                    class="glyphicon glyphicon-chevron-right right"></span>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li class=""><a class="" href="/subscriberhome/account-security" data-target="#">
                            <span class="glyphicon glyphicon-lock"></span>Security<span
                                    class="glyphicon glyphicon-chevron-right right"></span>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="/subscriberhome/account-support" data-target="#">
                            <span class="glyphicon glyphicon-question-sign"></span>Support<span
                                    class="glyphicon glyphicon-chevron-right right"></span>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-8 tab-pane fade in active panel panel-default">
                <div class="panel-body">
                    <form id="subscriber-home-account-personal-information-form" class="form-vertical"
                          action="/subscriberhome/account" method="post">
                        <input type="hidden" name="_csrf"
                               value="mFxktGyqySCvckyaeskKLsxAl42Q81vkSZGJ_0mXByYgDFsu0fFL7DEL5dwLs7sPsl0MJ_4EoK2zFNuRnIU04Q=="><input
                                type="hidden" name="form_scenario" value="default">
                        <h3>Personal information</h3>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="form-group col-md-5 field-patient-first_name">

                                        <div class='form-group'><label class="control-label" for="patient-first_name">First
                                                Name</label>:<input type="text" id="patient-first_name"
                                                                    class="form-control" name="Patient[first_name]"
                                                                    value="Stripe">
                                            <div class="help-block alert alert-danger"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 field-patient-middle_initial">

                                        <div class='form-group'><label class="control-label"
                                                                       for="patient-middle_initial">MI</label>:<input
                                                    type="text" id="patient-middle_initial" class="form-control"
                                                    name="Patient[middle_initial]" value="X">
                                            <div class="help-block alert alert-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 field-patient-last_name">

                                        <div class='form-group'><label class="control-label" for="patient-last_name">Last
                                                Name</label>:<input type="text" id="patient-last_name"
                                                                    class="form-control" name="Patient[last_name]"
                                                                    value="Test">
                                            <div class="help-block alert alert-danger"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 field-patient-address_1">

                                        <div class='form-group'><label class="control-label" for="patient-address_1">Address</label>:<input
                                                    type="text" id="patient-address_1" class="form-control"
                                                    name="Patient[address_1]" value="Ayora">
                                            <div class="help-block alert alert-danger"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 field-patient-address_2">

                                        <div class='form-group'><label class="control-label" for="patient-address_2">Address
                                                2</label>:<input type="text" id="patient-address_2" class="form-control"
                                                                 name="Patient[address_2]" value="5">
                                            <div class="help-block alert alert-danger"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-5 field-patient-city">

                                        <div class='form-group'><label class="control-label"
                                                                       for="patient-city">City</label>:<input
                                                    type="text" id="patient-city" class="form-control"
                                                    name="Patient[city]" value="Valencia">
                                            <div class="help-block alert alert-danger"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 field-patient-state">

                                        <div class='form-group'><label class="control-label"
                                                                       for="patient-state">State</label>:<input
                                                    type="text" id="patient-state" class="form-control"
                                                    name="Patient[state]" value="Valencia">
                                            <div class="help-block alert alert-danger"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 field-patient-zip">

                                        <div class='form-group'><label class="control-label"
                                                                       for="patient-zip">Zip</label>:<input type="text"
                                                                                                            id="patient-zip"
                                                                                                            class="form-control"
                                                                                                            name="Patient[zip]"
                                                                                                            value="46021">
                                            <div class="help-block alert alert-danger"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group field-patient-display_address">
                                                <input type="hidden" name="Patient[display_address]" value="0"><input
                                                        type="checkbox" id="patient-display_address"
                                                        name="Patient[display_address]" value="1" checked><label
                                                        class="control-label" for="patient-display_address">Display
                                                    address on my profile</label>&nbsp;<label class="control-label"
                                                                                              for="patient-display_address">Display
                                                    address on my profile</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-sm-4">
                                <!-- User picture -->

                                <div class="patient-photo">
                                    <div class="form-group field-patient-picture">
                                        <input type="hidden" id="patient-picture" class="form-control"
                                               name="Patient[picture]"
                                               value="8adcb8d8449ca9fd99d05bd0d232c3c3d796af75.jpg">
                                    </div>
                                    <img src=""
                                         class="img-rounded" style="width:100%">
<!--	                                --><?php //if($model->image): ?>
<!--                                        <img src="/uploads/--><?//= $model->image?><!--" alt="">-->
<!--	                                --><?php //endif; ?>

                                    <span class="btn btn-default btn-sm pull-right fileinput-button"
                                          style="margin-top:10px;">
               <span>Change profile picture</span>
                  <input type="file" id="w0" name="profile-image" value="Change profile picture" accept="uploads/*"
                         data-url="/subscriberhome/uploader_profile">               </span>
                                </div>
                                <br>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="form-group col-md-5 field-patient-cell_phone">

                                        <div class='form-group'><label class="control-label" for="patient-cell_phone">Mobile
                                                Phone</label>:<input type="text" id="patient-cell_phone"
                                                                     class="form-control" name="Patient[cell_phone]"
                                                                     value="+34722795702">
                                            <div class="help-block alert alert-danger"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-7 field-patient-email">
                                        <div class='form-group'><label class="control-label"
                                                                       for="patient-email">E-mail</label>:<input
                                                    type="text" id="patient-email" class="form-control"
                                                    name="Patient[email]" value="stripe@kashirinsoftware.com"
                                                    disabled="disabled" aria-required="true">
                                            <div class="help-block alert alert-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="control-label">&nbsp;</label>
                                        <div class="clearfix"></div>
                                        <button type="submit" class="btn btn-success right">Save information</button>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </form>
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
                <button onClick="setTimeout(signINclear,500)" type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h4 class="modal-title" id="signinTitle">Sign In</h4>
            </div>
            <div class="modal-footer">
                <button onClick="setTimeout(signINclear,500)" id="closeButton" class="btn btn-default"
                        data-dismiss="modal">Close
                </button>
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
<script src="/js/jquery.ui.widget.js"></script>
<script src="/js/jquery.iframe-transport.js"></script>
<script src="/js/jquery.fileupload.js"></script>
<script src="/assets/e8aaf060/yii.activeForm.js"></script>
<script src="/js/ajaxupload.3.5.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">jQuery(document).ready(function () {
        var $el = jQuery("#subscriber-home-account-personal-information-form .kv-hint-special");
        if ($el.length) {
            $el.each(function () {
                $(this).activeFieldHint()
            });
        }
        ;
        jQuery('#w0').fileupload({"maxFileSize": 2000000, "url": "/subscriberhome/upload_profile"});
        jQuery('#w0').on('fileuploadstart', function (e, data) {
            $(".patient-photo img").data("src", $(".patient-photo img").attr("src")).attr("src", "/img/preloader.gif");
        });
        jQuery('#w0').on('fileuploaddone', function (e, data) {
            if (data.result.error) {
                eModal.alert("<div class=\"alert alert-danger\">" + data.result.error + "</div>", "Upload error");
                $(".patient-photo img").attr("src", $(".patient-photo img").data("src"));
            } else {
                $(".patient-photo img").attr("src", data.result.url);
                $("#patient-picture").val(data.result.filename);
            }
        });
        jQuery('#w0').on('fileuploadfail', function (e, data) {
            console.log(e);
            console.log(data);
        });
        jQuery('#subscriber-home-account-personal-information-form').yiiActiveForm([
            {
                "id": "patient-first_name",
                "name": "first_name",
                "container": ".field-patient-first_name",
                "input": "#patient-first_name",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                            "message": "First Name must be a string.",
                            "max": 255,
                            "tooLong": "First Name should contain at most 255 characters.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            },
            {
                "id": "patient-middle_initial",
                "name": "middle_initial",
                "container": ".field-patient-middle_initial",
                "input": "#patient-middle_initial",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                            "message": "MI must be a string.",
                            "max": 10,
                            "tooLong": "MI should contain at most 10 characters.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            },
            {
                "id": "patient-last_name",
                "name": "last_name",
                "container": ".field-patient-last_name",
                "input": "#patient-last_name",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                            "message": "Last Name must be a string.",
                            "max": 255,
                            "tooLong": "Last Name should contain at most 255 characters.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            },
            {
                "id": "patient-address_1",
                "name": "address_1",
                "container": ".field-patient-address_1",
                "input": "#patient-address_1",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                            "message": "Address must be a string.",
                            "max": 255,
                            "tooLong": "Address should contain at most 255 characters.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            },
            {
                "id": "patient-address_2",
                "name": "address_2",
                "container": ".field-patient-address_2",
                "input": "#patient-address_2",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                            "message": "Address 2 must be a string.",
                            "max": 255,
                            "tooLong": "Address 2 should contain at most 255 characters.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            },
            {
                "id": "patient-city",
                "name": "city",
                "container": ".field-patient-city",
                "input": "#patient-city",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                            "message": "City must be a string.",
                            "max": 50,
                            "tooLong": "City should contain at most 50 characters.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            },
            {
                "id": "patient-state",
                "name": "state",
                "container": ".field-patient-state",
                "input": "#patient-state",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                            "message": "State must be a string.",
                            "max": 50,
                            "tooLong": "State should contain at most 50 characters.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            },
            {
                "id": "patient-zip",
                "name": "zip",
                "container": ".field-patient-zip",
                "input": "#patient-zip",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                            "message": "Zip must be a string.",
                            "max": 20,
                            "tooLong": "Zip should contain at most 20 characters.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            },
            {
                "id": "patient-display_address",
                "name": "display_address",
                "container": ".field-patient-display_address",
                "input": "#patient-display_address",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.number(value, messages, {
                            "pattern": /^\s*[+-]?\d+\s*$/,
                            "message": "Display address on my profile must be an integer.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            },
            {
                "id": "patient-picture",
                "name": "picture",
                "container": ".field-patient-picture",
                "input": "#patient-picture",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                            "message": "Picture must be a string.",
                            "max": 100,
                            "tooLong": "Picture should contain at most 100 characters.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            },
            {
                "id": "patient-cell_phone",
                "name": "cell_phone",
                "container": ".field-patient-cell_phone",
                "input": "#patient-cell_phone",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                            "message": "Mobile Phone must be a string.",
                            "max": 20,
                            "tooLong": "Mobile Phone should contain at most 20 characters.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            },
            {
                "id": "patient-email",
                "name": "email",
                "container": ".field-patient-email",
                "input": "#patient-email",
                "error": ".help-block.alert.alert-danger",
                "validate": function (attribute, value, messages, deferred, $form) {
                    yii.validation.string(value, messages, {
                            "message": "E-mail must be a string.",
                            "max": 100,
                            "tooLong": "E-mail should contain at most 100 characters.",
                            "skipOnEmpty": 1
                        }
                    );
                }
            }], []);
    });</script>

</body>
</html>

