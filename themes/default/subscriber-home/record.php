
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Medical Record</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="csrf-param" content="_csrf">
	<meta name="csrf-token" content="RO7zhEZjLo6s2mkgToUfTBmZOtiwP7H3cQWp1CTkUbX8vswe-zisQjKjwGY__65tZ4Shct7ISr6LgPu68fZicg==">
	<link href="/assets/295aed4b/css/bootstrap.css" rel="stylesheet">
	<link href="/assets/427dbdf7/css/font-awesome.min.css" rel="stylesheet">
	<link href="/css/jquery.fancybox.min.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">
	<link href="/assets/6bcfab7c/css/activeform.css" rel="stylesheet">
	<link href="/css/bootstrap-datepicker3.css" rel="stylesheet">
	<link href="/css/datepicker-kv.css" rel="stylesheet">
	<link href="/css/kv-widgets.css" rel="stylesheet">
	<link href="/css/bootstrap-touchspin.css" rel="stylesheet">
	<style> .form-inline .form-group {margin-right:10px} </style>
	<script type="text/javascript">window.kvDatepicker_94e9849d = {"autoclose":true,"format":"mm\/dd\/yyyy"};

        window.TouchSpin_ce6610d7 = {"buttonup_class":"btn btn-default","buttondown_class":"btn btn-default","buttonup_txt":"\u003Ci class=\u0022glyphicon glyphicon-forward\u0022\u003E\u003C\/i\u003E","buttondown_txt":"\u003Ci class=\u0022glyphicon glyphicon-backward\u0022\u003E\u003C\/i\u003E","min":0,"max":1000,"verticalbuttons":true,"verticalupclass":"glyphicon glyphicon-plus","verticaldownclass":"glyphicon glyphicon-minus"};
	</script></head>
<body class="ca-default-record patient-registred">

<div id="mainContent" class="content">
	<div class="col-sm-12 med-info__wrap">
		<h1 class="med-info__left-title">Medical Record</h1>
		<span class="med-info__right-text">Select Medical History items to display when your SaveLifeID card, bracelet or necklace is scanned.</span>
	</div>

	<div class="col-sm-12">
		<form id="medicalRecordForm" class="medicalRecordForm form-vertical" action="/subscriberhome/record" method="post">
			<input type="hidden" name="_csrf" value="RO7zhEZjLo6s2mkgToUfTBmZOtiwP7H3cQWp1CTkUbX8vswe-zisQjKjwGY__65tZ4Shct7ISr6LgPu68fZicg=="><input type="hidden" name="form_scenario" value="main">  <div class="col-sm-12 medical-record-form">
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group field-recordform-display_all">
							<input type="hidden" name="RecordForm[display_all]" value="0"><input type="checkbox" id="recordform-display_all" name="RecordForm[display_all]" value="1"><label for="recordform-display_all" class="pull-left"></label><label for="recordform-display_all" class="pull-right" style="display: inline; width: calc(100% - 35px);"><b>DISPLAY ALL</b> of my newly arriving medical information, automatically:  Check this box to make sure new medical information from your doctors is fully active and visible to emergency medical personnel. If you select below to be notified when your medical record is updated, that will allow you to review the information and change the visibility of any individual items you wish, as soon as it arrives in the system.</label><div class="clearfix"></div>
						</div>        </div>
				</div>

				<div class="row">
					<div class="col-md-10 col-sm-12">
						<p class="delete-breakrow">Click "Preview My Profile" to preview what your emergency profile will look like including your changes. <br>Changes on this page are remembered immediately and automatically reflected in the next profile display.</p>
						<p></p>
					</div>
					<div class="col-md-2 col-sm-12" style="padding-top: 8px;">
						<a href="https://devprofile.savelifeid.com/profile/stripe_test_internal_id" target="_blank" class="btn btn-default right med-info__heading-btn">Preview My Profile</a>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12 form-inline">
						<div class="form-group field-recordform-birthday">

							<div class='form-group'>
                                <label class="control-label" for="recordform-birthday">Date of Birth</label>:<input type="text" id="recordform-birthday" class="krajee-datepicker form-control" name="RecordForm[birthday]" value="10/11/1963" placeholder="MM/DD/YYYY" data-datepicker-source="recordform-birthday" data-datepicker-type="1" data-krajee-kvDatepicker="kvDatepicker_94e9849d"></div>
						</div>
						<div class="form-group field-recordform-gender">

							<div class='form-group'><label class="control-label" for="recordform-gender">Gender</label>:<select id="recordform-gender" class="form-control" name="RecordForm[gender]">
									<option value=""></option>
									<option value="Male" selected>Male</option>
									<option value="Female">Female</option>
								</select></div>
						</div>        <div class="form-group med-info__height-group">
							<label for="sel1">Height:</label>
							<select id="recordform-height_feet" class="form-control" name="RecordForm[height_feet]">
								<option value=""></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5" selected>5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</select>          ft
							<select id="recordform-height_inch" class="form-control" name="RecordForm[height_inch]">
								<option value=""></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11" selected>11</option>
							</select>          inches
						</div>

						<div class="form-group field-recordform-weight">

							<div class='form-group med-info__weigth-group'><label class="control-label" for="recordform-weight">Weight:</label><div class='med-info__weigth-group-input-wrap' style='display: inline-block; width:70px;'><input type="text" id="recordform-weight" class="input-left-rounded" name="RecordForm[weight]" value="218" data-krajee-TouchSpin="TouchSpin_ce6610d7"></div>lbs</div>
						</div>      </div>
				</div>
			</div>
		</form></div>

	<div class="col-sm-12" id="blocks">

		<div class="panel panel-default panel-emergency-items" style="margin-top:20px;">
			<form id="medicalRecordForm-emergency" class="medicalRecordForm form-vertical" action="/subscriberhome/record" method="post">
				<input type="hidden" name="_csrf" value="RO7zhEZjLo6s2mkgToUfTBmZOtiwP7H3cQWp1CTkUbX8vswe-zisQjKjwGY__65tZ4Shct7ISr6LgPu68fZicg=="><input type="hidden" name="form_scenario" value="emergency-profile">
				<div class="panel-body" style="padding-left:11px;">
					<h3 style="margin-bottom:0; margin-left:2px;" class="js-messager-style" data-messager-style="margin-top:-2px;margin-left:-10px;"><div class="form-group field-recordform-display_emergency_profile_summary-5967620a6e1be">
							<div class="checkbox-type-plus-minus-wrapper stateful-title" data-title-checked="Click to prevent any Profile Summary from appearing on your emergency profile; otherwise, selected Hospitals will appear." data-title-unchecked="Click to allow selected Profile Summary to appear on your emergency profile; otherwise none will appear."><input type="hidden" name="RecordForm[display_emergency_profile_summary]" value="0"><input type="checkbox" id="recordform-display_emergency_profile_summary-5967620a6e1be" class="collapser" name="RecordForm[display_emergency_profile_summary]" value="1" checked data-collapse-target=".emergencyProfile">
								<label class="control-label" for="recordform-display_emergency_profile_summary-5967620a6e1be">I want to add an emergency profile summary</label>
							</div>
						</div></h3>
					<div class="panel-description">
						<div class="emergencyProfile state state-visible ">Profile Summary can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball</div>
						<div class="emergencyProfile state state-invisible hidden">Profile Summary information will not be displayed in your emergency profile until you click the section's eyeball to enable it.</div>
					</div>
					<div id="emergency" class="emergencyProfile ">
						<div id="emergencyCheckboxes" class="col-sm-12 profile-control-wrapper"><div>
								<ul class="list-group col-sm-4 margin-bottom-0">
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-8" name="RecordForm[emergency_profile_items_ids][]" value="8">	          <label for="record-form-emergency-profile-items-8"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-8">ADD/ADHD</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-7" name="RecordForm[emergency_profile_items_ids][]" value="7">	          <label for="record-form-emergency-profile-items-7"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-7">Alzheimer's/Dementia</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-9" name="RecordForm[emergency_profile_items_ids][]" value="9">	          <label for="record-form-emergency-profile-items-9"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-9">Asthma</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-10" name="RecordForm[emergency_profile_items_ids][]" value="10">	          <label for="record-form-emergency-profile-items-10"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-10">Autism</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-11" name="RecordForm[emergency_profile_items_ids][]" value="11">	          <label for="record-form-emergency-profile-items-11"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-11">Blood thinners</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-12" name="RecordForm[emergency_profile_items_ids][]" value="12">	          <label for="record-form-emergency-profile-items-12"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-12">Cancer</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-13" name="RecordForm[emergency_profile_items_ids][]" value="13">	          <label for="record-form-emergency-profile-items-13"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-13">Cardiac</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-14" name="RecordForm[emergency_profile_items_ids][]" value="14">	          <label for="record-form-emergency-profile-items-14"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-14">Carries Epi Pen</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-15" name="RecordForm[emergency_profile_items_ids][]" value="15">	          <label for="record-form-emergency-profile-items-15"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-15">Diabetes</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-16" name="RecordForm[emergency_profile_items_ids][]" value="16">	          <label for="record-form-emergency-profile-items-16"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-16">Dialysis</label>				<div class="clearfix"></div>
									</li>
								</ul>
								<ul class="list-group col-sm-4 margin-bottom-0">
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-2" name="RecordForm[emergency_profile_items_ids][]" value="2">	          <label for="record-form-emergency-profile-items-2"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-2">Drug Allergies</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-17" name="RecordForm[emergency_profile_items_ids][]" value="17">	          <label for="record-form-emergency-profile-items-17"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-17">Epilepsy</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-1" name="RecordForm[emergency_profile_items_ids][]" value="1">	          <label for="record-form-emergency-profile-items-1"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-1">Food Allergies</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-18" name="RecordForm[emergency_profile_items_ids][]" value="18">	          <label for="record-form-emergency-profile-items-18"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-18">Heart Disease</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-19" name="RecordForm[emergency_profile_items_ids][]" value="19">	          <label for="record-form-emergency-profile-items-19"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-19">Hypertension</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-20" name="RecordForm[emergency_profile_items_ids][]" value="20">	          <label for="record-form-emergency-profile-items-20"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-20">Internal Defibrillator</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-3" name="RecordForm[emergency_profile_items_ids][]" value="3">	          <label for="record-form-emergency-profile-items-3"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-3">Latex Allergies</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-21" name="RecordForm[emergency_profile_items_ids][]" value="21">	          <label for="record-form-emergency-profile-items-21"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-21">Lung Disease</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-22" name="RecordForm[emergency_profile_items_ids][]" value="22">	          <label for="record-form-emergency-profile-items-22"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-22">Multiple Sclerosis</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-23" name="RecordForm[emergency_profile_items_ids][]" value="23">	          <label for="record-form-emergency-profile-items-23"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-23">Oxygen Dependent</label>				<div class="clearfix"></div>
									</li>
								</ul>
								<ul class="list-group col-sm-4 padding-right-0 margin-bottom-0">
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-24" name="RecordForm[emergency_profile_items_ids][]" value="24">	          <label for="record-form-emergency-profile-items-24"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-24">Pacemaker</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-25" name="RecordForm[emergency_profile_items_ids][]" value="25">	          <label for="record-form-emergency-profile-items-25"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-25">Parkinson's</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-4" name="RecordForm[emergency_profile_items_ids][]" value="4">	          <label for="record-form-emergency-profile-items-4"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-4">Penicillin Allergies</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-26" name="RecordForm[emergency_profile_items_ids][]" value="26">	          <label for="record-form-emergency-profile-items-26"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-26">Psychiatric</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-27" name="RecordForm[emergency_profile_items_ids][]" value="27">	          <label for="record-form-emergency-profile-items-27"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-27">Seizures</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-28" name="RecordForm[emergency_profile_items_ids][]" value="28">	          <label for="record-form-emergency-profile-items-28"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-28">Stroke Risk</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-5" name="RecordForm[emergency_profile_items_ids][]" value="5">	          <label for="record-form-emergency-profile-items-5"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-5">Sulfa Allergies</label>				<div class="clearfix"></div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
        <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper stateful-title" data-title-checked='Click to prevent this entry from being included in your emergency profile; otherwise, it will appear' data-title-unchecked='Click to select this entry to be included in your emergency profile; otherwise, it will not appear.'>
                      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">            <input type="checkbox" id="record-form-emergency-profile-items-6" name="RecordForm[emergency_profile_items_ids][]" value="6">	          <label for="record-form-emergency-profile-items-6"></label>                  </span>
										<label class="item-name" for="record-form-emergency-profile-items-6">Sulfites Allergies</label>				<div class="clearfix"></div>
									</li>
								</ul>
							</div>

							<div class="right col-sm-6 padding-right-0 padding-left-0" style="margin-top:15px">
								<div class="input-group">
									<input class="form-control js-custom-title js-no-autosave" placeholder="Add New Item of Free Text" type="text">
									<div class="input-group-btn">
										<button type='button' class="btn btn-default js-add-custom">Add</button>
									</div>
								</div>
							</div>

							<div class="hidden record-form-templates">
								<div class="removed-profile-item">
									<span class="glyphicon glyphicon-trash trash-icon"></span><strike class="item-title"></strike>
									<span class="label label-danger">Deleted</span>
									<div class="right">
										<button type="button" class="btn btn-success btn-xs js-restore-custom" data-title="">Restore</button>
									</div>
								</div>

								<ul class="custom-emergency-profile">
									<li class="list-group-item">
      <span class="buttons-wrapper enable-wrapper checkbox-type-eye-wrapper">
  	      <input type="hidden" name="RecordForm[emergency_profile_items_ids][]" value="0">        <a href="#" class="glyphicon glyphicon-remove chk-6 top0 js-remove-profile-item" data-id=""  data-toggle="tooltip" data-placement="left" title="Click here to remove this custom-defined text from your emergency profile and from this list"></a>
      </span>
										<label class="item-name"></label>
										<div class="clearfix"></div>
									</li>
								</ul>

							</div>
						</div>
					</div>
				</div>

			</form></div>



		<div class="panel panel-default panel-physicians-items" style="margin-top:20px;">
			<form id="medicalRecordForm-physicians" class="medicalRecordForm form-vertical" action="/subscriberhome/record" method="post">
				<input type="hidden" name="_csrf" value="RO7zhEZjLo6s2mkgToUfTBmZOtiwP7H3cQWp1CTkUbX8vswe-zisQjKjwGY__65tZ4Shct7ISr6LgPu68fZicg=="><input type="hidden" name="form_scenario" value="other_physicians">
				<div class="panel-body" style="padding-left:11px;">
					<h3 style="margin-bottom:0; margin-left:2px;" class="js-messager-style" data-messager-style="margin-top:-2px;margin-left:-10px;"><div class="form-group field-recordform-display_physicians_contact_info-5967620a6e850">
							<div class="checkbox-type-plus-minus-wrapper stateful-title" data-title-checked="Click to prevent any Physicians from appearing on your emergency profile; otherwise, selected Hospitals will appear." data-title-unchecked="Click to allow selected Physicians to appear on your emergency profile; otherwise none will appear."><input type="hidden" name="RecordForm[display_physicians_contact_info]" value="0"><input type="checkbox" id="recordform-display_physicians_contact_info-5967620a6e850" class="collapser" name="RecordForm[display_physicians_contact_info]" value="1" checked data-collapse-target=".physiciansProfile">
								<label class="control-label" for="recordform-display_physicians_contact_info-5967620a6e850">Physicians Contact Info</label>
							</div>
						</div></h3>
					<div class="panel-description">
						<div class="physiciansProfile state state-visible ">Physicians can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball</div>
						<div class="physiciansProfile state state-invisible hidden">Physicians information will not be displayed in your emergency profile until you click the section's eyeball to enable it.</div>
					</div>
					<div id="physicians" class="physiciansProfile ">
						<div id="physiciansCheckboxes" class="col-sm-12 profile-control-wrapper"><ul class="list-group margin-bottom-0">
							</ul>
							<div class="clearfix"></div></div>
					</div>
				</div>

			</form></div>


		<div class="panel panel-default panel-emergency-contacts" style="margin-top:20px;">
			<div class="panel-body">
				<form id="medicalRecordForm-emergency-contacts-visibility" class="medicalRecordForm form-vertical" action="/subscriberhome/record" method="post">
					<input type="hidden" name="_csrf" value="RO7zhEZjLo6s2mkgToUfTBmZOtiwP7H3cQWp1CTkUbX8vswe-zisQjKjwGY__65tZ4Shct7ISr6LgPu68fZicg=="><input type="hidden" name="form_scenario" value="emergency-contacts-visibility">		<h3 style="margin-bottom:0; margin-left:2px;"><div class="form-group field-recordform-display_emergency_contacts-5967620a6f6a3">
							<div class="checkbox-type-plus-minus-wrapper stateful-title" data-title-checked="Click to prevent any Emergency Contacts from appearing on your emergency profile; otherwise, selected Emergency Contacts will appear." data-title-unchecked="Click to allow selected Emergency Contacts to appear on your emergency profile; otherwise none will appear."><input type="hidden" name="RecordForm[display_emergency_contacts]" value="0"><input type="checkbox" id="recordform-display_emergency_contacts-5967620a6f6a3" class="collapser" name="RecordForm[display_emergency_contacts]" value="1" checked data-active-form="#medicalRecordForm-emergency-contacts" data-collapse-target=".emergencyContactsProfile">
								<label class="control-label" for="recordform-display_emergency_contacts-5967620a6f6a3">Emergency Contacts</label>
							</div>
						</div></h3>
					<div class="panel-description">
						<div class="emergencyContactsProfile state state-visible ">Emergency Contacts can now be displayed on your profile, but only those you specifically authorize by clicking their eyeball</div>
						<div class="emergencyContactsProfile state state-invisible hidden">Emergency Contacts information will not be displayed in your emergency profile until you click the section's eyeball to enable it.</div>
					</div>
				</form>		<div id="emergency-contact-info" class="emergencyContactsProfile ">
					<div id="emergencyContactCheckboxes" class="col-sm-12 profile-control-wrapper">
						<div class="row">
							<div class="col-sm-8">
								<form id="medicalRecordForm-emergency-contacts" class="medicalRecordForm form-vertical" action="/subscriberhome/record" method="post">
									<input type="hidden" name="_csrf" value="RO7zhEZjLo6s2mkgToUfTBmZOtiwP7H3cQWp1CTkUbX8vswe-zisQjKjwGY__65tZ4Shct7ISr6LgPu68fZicg=="><input type="hidden" name="form_scenario" value="emergency-contacts">              <ul class="list-group">
									</ul>
									<div class="js-null-mesage alert alert-info ">SaveLifeID can notify your Contacts in an emergency (whenever your card is scanned). But you must add a contact including a cell phone number or email address for notification by SMS or email. Then simply click the check-boxes of the notifications you want each contact to receive.</div>
								</form>          </div>
							<div class="col-sm-4">
								<div class="panel panel-default">
									<div class="panel-body">


										<form id="addEmergencyContactForm" class="addEmergencyContactForm form-vertical" action="/subscriberhome/add-emergency-contact" method="post">
											<input type="hidden" name="_csrf" value="RO7zhEZjLo6s2mkgToUfTBmZOtiwP7H3cQWp1CTkUbX8vswe-zisQjKjwGY__65tZ4Shct7ISr6LgPu68fZicg=="><input type="hidden" name="form_scenario" value="default">
											<h4 style="margin-top:0">Add New Contact Here:</h4>
											<div class="form-group block-wrapper field-emergencycontacts-contact_name required">
												<label class="control-label" for="emergencycontacts-contact_name">Contact Name</label>
												<input type="text" id="emergencycontacts-contact_name" class="form-control" name="EmergencyContacts[contact_name]" aria-required="true">

												<div class="help-block alert alert-danger"></div>
											</div>
											<div class="block-wrapper">
												<div class="form-group field-emergencycontacts-contact_cell" style="padding-left:0">
													<label class="control-label" for="emergencycontacts-contact_cell">Cell phone</label>
													<input type="text" id="emergencycontacts-contact_cell" class="form-control" name="EmergencyContacts[contact_cell]">

													<div class="help-block alert alert-danger"></div>
												</div>
												<div class="chktext">
													<input type="hidden" name="EmergencyContacts[notify_cell]" value="0">      <input type="checkbox" id="emergency-contacts--notify-cell" name="EmergencyContacts[notify_cell]" value="1" disabled="disabled">      <label class="visible" for="emergency-contacts--notify-cell">Notify by text on scan</label>    </div>
											</div>

											<div class="block-wrapper">
												<div class="form-group field-emergencycontacts-contact_email" style="padding-left:0">
													<label class="control-label" for="emergencycontacts-contact_email">E-mail</label>
													<input type="text" id="emergencycontacts-contact_email" class="form-control" name="EmergencyContacts[contact_email]">

													<div class="help-block alert alert-danger"></div>
												</div>
												<div class="chktext">
													<input type="hidden" name="EmergencyContacts[notify_email]" value="0">      <input type="checkbox" id="emergency-contacts--notify-email" name="EmergencyContacts[notify_email]" value="1" disabled="disabled">      <label class="visible" for="emergency-contacts--notify-email">Notify by e-mail on scan</label>    </div>
											</div>

											<div class="col-sm-12 nop"><button type="submit" class="btn btn-success right">Add contact</button></div>

										</form>



									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default panel-notifications-items" style="margin-top:20px;">
			<form id="medicalRecordForm-notifications" class="medicalRecordForm form-vertical" action="/subscriberhome/record" method="post">
				<input type="hidden" name="_csrf" value="RO7zhEZjLo6s2mkgToUfTBmZOtiwP7H3cQWp1CTkUbX8vswe-zisQjKjwGY__65tZ4Shct7ISr6LgPu68fZicg=="><input type="hidden" name="form_scenario" value="notifications">
				<div class="panel-body" style="padding-left:11px;">
					<h3><div class="checkbox-big no-js no-pointer">Notifications</div></h3>
					<div id="notifications" class="notificationsProfile">
						<div id="notificationsCheckboxes" class="col-sm-12 profile-control-wrapper">
							<div class="col-sm-6">
								<h4>When should we notify you?</h4>
								<ul class="list-group">
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
										<label for="record-form-notification_scanned">Whenever my card is scanned</label>				<div class="form-group pull-right">
											<input type="hidden" name="RecordForm[notification_scanned]" value="0">					<input type="checkbox" id="record-form-notification_scanned" name="RecordForm[notification_scanned]" value="1">					<label for="record-form-notification_scanned"></label>				</div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
										<label for="record-form-notification_updates">Whenever my medical info is changed</label>				<div class="form-group pull-right">
											<input type="hidden" name="RecordForm[notification_updates]" value="0">					<input type="checkbox" id="record-form-notification_updates" name="RecordForm[notification_updates]" value="1" checked>					<label for="record-form-notification_updates"></label>				</div>
									</li>
								</ul>
							</div>
							<div class="col-sm-6">
								<h4>How should we notify you?</h4>
								<ul class="list-group">
									<li class="list-group-item">
										<label for="record-form-notify_email">By e-mail to stripe@kashirinsoftware.com</label>				<div class="form-group pull-right">
											<input type="hidden" name="RecordForm[notify_email]" value="0">					<input type="radio" id="record-form-notify_email" name="RecordForm[notify_way]" value="1">					<label for="record-form-notify_email"></label>				</div>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
										<label for="record-form-notify_phone">By text to +34722795702</label>				<div class="form-group pull-right">
											<input type="hidden" name="RecordForm[notify_phone]" value="0">					<input type="radio" id="record-form-notify_phone" name="RecordForm[notify_way]" value="2" checked>					<label for="record-form-notify_phone"></label>				</div>
									</li>
									<li class="list-group-item js-messager-style" data-messager-style="margin-left:-2px;">
										<label for="record-form-notify_both">Both ways</label>				<div class="form-group pull-right">
											<input type="hidden" name="RecordForm[notify_both]" value="0">					<input type="radio" id="record-form-notify_both" name="RecordForm[notify_way]" value="3">					<label for="record-form-notify_both"></label>				</div>
									</li>
								</ul>
							</div>

						</div>
					</div>
				</div>

			</form></div>


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
<script src="/js/record.js"></script>
<script src="/assets/6bcfab7c/js/activeform.js"></script>
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/datepicker-kv.js"></script>
<script src="/js/kv-widgets.js"></script>
<script src="/js/bootstrap-touchspin.js"></script>
<script src="/assets/e8aaf060/yii.activeForm.js"></script>
<script src="/assets/e8aaf060/yii.validation.js"></script>
<script type="text/javascript">jQuery(document).ready(function () {
        var $el=jQuery("#medicalRecordForm .kv-hint-special");if($el.length){$el.each(function(){$(this).activeFieldHint()});}
        jQuery.fn.kvDatepicker.dates={};
        if (jQuery('#recordform-birthday').data('kvDatepicker')) { jQuery('#recordform-birthday').kvDatepicker('destroy'); }
        jQuery('#recordform-birthday').kvDatepicker(kvDatepicker_94e9849d);

        if (jQuery('#recordform-weight').data('TouchSpin')) { jQuery('#recordform-weight').TouchSpin('destroy'); }
        jQuery('#recordform-weight').TouchSpin(TouchSpin_ce6610d7);

        jQuery('#medicalRecordForm').yiiActiveForm([], []);
        var $el=jQuery("#medicalRecordForm-emergency .kv-hint-special");if($el.length){$el.each(function(){$(this).activeFieldHint()});}
        jQuery('#medicalRecordForm-emergency').yiiActiveForm([], []);
        var $el=jQuery("#medicalRecordForm-physicians .kv-hint-special");if($el.length){$el.each(function(){$(this).activeFieldHint()});}
        jQuery('#medicalRecordForm-physicians').yiiActiveForm([], []);
        var $el=jQuery("#medicalRecordForm-emergency-contacts-visibility .kv-hint-special");if($el.length){$el.each(function(){$(this).activeFieldHint()});}
        jQuery('#medicalRecordForm-emergency-contacts-visibility').yiiActiveForm([], []);
        var $el=jQuery("#medicalRecordForm-emergency-contacts .kv-hint-special");if($el.length){$el.each(function(){$(this).activeFieldHint()});}
        jQuery('#medicalRecordForm-emergency-contacts').yiiActiveForm([], []);
        var $el=jQuery("#addEmergencyContactForm .kv-hint-special");if($el.length){$el.each(function(){$(this).activeFieldHint()});}
        jQuery('#addEmergencyContactForm').yiiActiveForm([{"id":"emergencycontacts-contact_name","name":"contact_name","container":".field-emergencycontacts-contact_name","input":"#emergencycontacts-contact_name","error":".help-block.alert.alert-danger","validateOnType":true,"validationDelay":1,"validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Contact Name cannot be blank."});yii.validation.string(value, messages, {"message":"Contact Name must be a string.","max":100,"tooLong":"Contact Name should contain at most 100 characters.","skipOnEmpty":1});}},{"id":"emergencycontacts-contact_cell","name":"contact_cell","container":".field-emergencycontacts-contact_cell","input":"#emergencycontacts-contact_cell","error":".help-block.alert.alert-danger","validateOnType":true,"validationDelay":1,"validate":function (attribute, value, messages, deferred, $form) {yii.validation.string(value, messages, {"message":"Cell phone must be a string.","max":20,"tooLong":"Cell phone should contain at most 20 characters.","skipOnEmpty":1});}},{"id":"emergencycontacts-contact_email","name":"contact_email","container":".field-emergencycontacts-contact_email","input":"#emergencycontacts-contact_email","error":".help-block.alert.alert-danger","validateOnType":true,"validationDelay":1,"validate":function (attribute, value, messages, deferred, $form) {(function(){
            var options = {"attribute":"emergencycontacts-contact_email","eitherAttributes":["emergencycontacts-contact_cell"],"message":"Either 'E-mail', 'Cell phone' has to be filled"};
            var values = [];
            values.push($('#' + options.attribute).val());
            for (var i in options.eitherAttributes) {
                values.push($('#' + options.eitherAttributes[i]).val());
            }
            if (values.filter(function(e){
                    return e.length > 0;
                }).length == 0) {
                messages.push(options.message);
            }
        })();yii.validation.string(value, messages, {"message":"E-mail must be a string.","max":100,"tooLong":"E-mail should contain at most 100 characters.","skipOnEmpty":1});yii.validation.email(value, messages, {"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"message":"E-mail is not a valid email address.","enableIDN":false,"skipOnEmpty":1});}}], []);

        $('#addEmergencyContactForm').on('afterValidateAttribute', function (event, attribute, messages){
            var disabled = messages.length?true:false;

            var checkbox = $(attribute.input).parents('.block-wrapper').find("input[type='checkbox']");
            disabled = disabled || ($(attribute.input).val().length == 0) ;

            checkbox.prop('disabled', disabled);
            if (disabled) {
                checkbox.prop('checked', false);
            }
        });

        $('#addEmergencyContactForm').on('after-submit', function(){
            $('.stateful-title').each(function(){
                new __stateful_title(this);
            });
            $('[data-toggle="tooltip"]').tooltip();
        });


        var $el=jQuery("#medicalRecordForm-notifications .kv-hint-special");if($el.length){$el.each(function(){$(this).activeFieldHint()});}
        jQuery('#medicalRecordForm-notifications').yiiActiveForm([], []);
    });</script></body>
</html>
