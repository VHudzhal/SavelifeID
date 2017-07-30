<?php
/**
 * @var $model \app\modules\patient\models\ActivateForm
 * @var $this \yii\web\View
 */
use yii\helpers\Html;
use app\components\ActiveForm;

$this->title = 'Complete registration';
$template = "<div class='form-group'>*{label}:\n{input}\n{hint}\n{error}</div>";

$menu = [
	['href' => '/', 'title' => 'Home'],
	['href' => '/about-us', 'title' => 'About Us'],
	['href' => '/faq', 'title' => 'FAQ'],
];
Yii::$app->view->params['menu'] = Yii::$app->controller->getMenuHtml($menu);

?>
<div class="container-fluid">
  <h1>Complete Registration</h1>
</div>
<?php if ( $model->loaded && ! $model->patient ) { ?>
  <div class="has-error">
    <h4 class="help-block alert alert-danger">Error: no account found. Please contact card issuer.</h4>
  </div>
<?php } else { ?>
	<?php if ( $model->loaded && $model->patient && $model->patient->password ) { ?>
		<?php
		if ( ! Yii::$app->patient->isGuest ) {
			Yii::$app->response->redirect( '/activate-complete-registration' );
			Yii::$app->end();
		}
		?>
    Account already registered, please sign in
		<?php $loginForm = new \app\models\LoginForm(); ?>
		<?php $form = \app\components\ActiveForm::begin( [
			'id'                     => 'activateLoginForm',
			'action'                 => '/login',
			'enableClientValidation' => false,
			'enableAjaxValidation'   => false,
			'fieldConfig'            => [
				'template'     => "\n<div class='form-group'>{label}:{input}</div>",
				'labelOptions' => [ 'class' => 'control-label' ],
			],
		] ); ?>
		<?= $form->field( $loginForm, 'email' ) ?>
		<?= $form->field( $loginForm, 'password', [ 'template' => "<div class='form-group'>{label}:<div class='input-group'>{input}<div class='input-group-btn'><button  type='button' class='btn btn-default btn-forgot' tabindex='999'>I forgot</button></div></div></div>" ] )->passwordInput() ?>
    <button type="submit" class="btn btn-success pull-right">Sign In</button>
    <!--<div class="checkbox">
				<label><input type="checkbox"> Remember me</label>
			  </div>-->
		<?php \app\components\ActiveForm::end(); ?>
    <!-- Forgot password -->
    <div class="forgotPassMessage">If this email address is associated with an account, instructions for resetting your
      password have just been emailed to you.
    </div>
	<?php } else { ?>
		<?php $form = \app\components\TimedClientForm::begin([
			'id' => 'sa_member_edit_form',
  	  'method' => 'post',
			'enableClientValidation' => true,
			'enableAjaxValidation' => false,
		]); ?>
		<?php $form->registerTries($model); ?>
    <div class="container-fluid">
      <h4><?= $model->loaded ? "Welcome, ".$model->patient->getFullName() : "New member with Slim Card" ?></h4>
    </div>
		<?= \yii\helpers\Html::errorSummary($model, ['class' => 'alert alert-danger', 'header' => '']); ?>
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-sm-4 remove-padding--tablet">
          <div class="error"></div>
	        <?= $form->field($model, 'last3hidden', ['template' => '{input}'])->textInput(['class' => 'hidden']); ?>
          <?php if ($model->scenario == \app\modules\patient\models\ActivateForm::SCENARIO_REGISTER) { ?>
            <div class="row">
              <div class="col-sm-12">
	              <?= $form->field( $model, 'enrollment_code')->textInput()->label('*Please type the 6 digit registration code provided by the Doctor\'s staff:') ?>
              </div>
            </div>
          <?php } else { ?>
            <div class="col-sm-12">
              <div class="col-sm-9 padding-left-0 padding-right-0">
                <label for="activateform-last3slid">* SLID: <?= $model->hiddenSlid() ?></label>
              </div>
              <div class="col-sm-3 padding-right-0" style="padding-left:5px">
		          <?= $form->field( $model, 'last3slid', [ 'template' => '{input}' ] )->textInput( [ 'placeholder' => 'Last 3', 'autocomplete' => 'off', 'maxlength'=>3 ] ) ?>
              </div>
            </div>
            <div class="help-block">Please type the last 3 symbols of ID on the card</div>
	          <?= $form->field( $model, 'last3slid', [ 'template' => '{error}' ] ) ?>
          <?php } ?>
			<?= $form->field( $model, 'birthyear', [ 'template' => $template ] )->textInput( [
		  'autocomplete' => 'off', 'maxlength' => 4
			] ) ?>
          <p>Your password must be at least 8 characters long. Ideally it will be longer. Do not choose common words or
            names. Including numbers or punctuation characters or even non-English characters can make your password
            stronger, but that is up to you.</p>
          <?= $form->field( $model, 'password', [ 'template' => $template ] )->passwordInput() ?>
          <?= $form->field( $model, 'password_repeat', [ 'template' => $template ] )->passwordInput() ?>
        </div>
        <div class="col-sm-8 remove-padding--tablet" style="padding:0 0 0 30px">
          <h3>Terms of Use</h3>
          <div class="terms-of-use-5-lines-scroll">
            <p>1.&nbsp;&nbsp; &nbsp;DEFINITIONS<br><br>1.1.&nbsp;&nbsp; &nbsp;“Emergency Profile” means the portion of the medical data that You or your designated representative provides to CommLife Solutions, Inc., that You have chosen or will choose to make available and visible to anyone with access to your Save Life ID Card or account information. <strong>Please consider carefully before choosing to make available your medical information through your Emergency Profile.</strong><br><br>1.2.&nbsp;&nbsp; &nbsp;“Health Profile” means all of the medical data that You or your designated representative provides to CommLife Solutions, Inc., in accordance with this Agreement.<br><br>2.&nbsp;&nbsp; &nbsp;TERMS OF AGREEMENT<br><br>This Agreement is between you (“You”) and CommLife Solutions, Inc. (“CommLife”) and covers your use of the applicable services (as defined below) such as the Save Life ID Applications and other Save Life ID products and/or services which may be released from time-to-time. Please carefully read the Agreement.<br><br>By using this website, accessing and using the Save Life ID Applications or any other Save Life ID products and/or services which may be released from time-to-time, You agree to be bound by this Agreement. By using these Applications or any other Save Life ID products and/or services which may be released from time-to-time, You represent and warrant to CommLife that You have read this Agreement, understand it, that You are at least 18 years of age, and that You agree to be bound by the terms and conditions of this Agreement.<br><br>By using these Applications or any other Save Life ID products and/or services which may be released from time-to-time, You understand that You or your designated representative have control over the information submitted to CommLife to be stored in your Health Profile, and the information You decide to display in your Emergency Profile and that your Emergency Profile information will become visible to anyone with access to your Save Life ID account information. By accessing and using the Save Life ID Applications or any other Save Life ID products and/or services which may be released from time-to-time, You understand that You have the ability to make any information in your Health Profile private so that it is only viewable with your username and password.<br><br>If You do not agree with all of the terms and conditions of this Agreement, You may not use the Save Life ID Applications or any other Save Life ID products and/or services which may be released from time-to-time.<br><br>2.1.&nbsp;&nbsp; &nbsp;Through the Save Life ID Version [VERSION NUMBER] web-based software application (the “Save Life ID Web Application” or the “Web App”), CommLife provides You with access to and use of its Web App located at www.savelifeid.com solely for your entering and maintaining your personal health and health-related information. In connection with the use of the Web App and such other services as may be offered from time to time by CommLife. You may also separately purchase any Save Life ID products, as they may be made available from time to time, to retrieve your personal health and health-related information that You or your designated representative have submitted and/or otherwise entered on a relevant Save Life ID product. The Save Life ID products currently available and future Save Life ID products that may become available in the future are collectively defined as the “Services.” The Services comprise of information tools that contain health and health-related information about You that is submitted and/or entered by your or with your consent on your behalf by your designated representative.<br><br>2.2.&nbsp;&nbsp; &nbsp;CommLife may revise this Agreement at any time and at its sole discretion. If this Agreement is amended or modified, You will be required to agree to be bound by such modifications, amendments or revisions to the terms and conditions in order to continue to use the Services.<br><br>2.3.&nbsp;&nbsp; &nbsp;Any such revisions shall be effective immediately and shall be posted at www.savelifeid.com/about-us/terms-of-use.<br><br>2.4.&nbsp;&nbsp; &nbsp;The Services are not a substitute for professional medical advice, including, without limitation, analysis, diagnosis, or treatment. Always seek the advice of your physician or other qualified health provider with any questions you may have regarding your general health or a specific medical condition. Never disregard professional medical advice or delay in seeking it based on your use of the Services.<br><br>2.5.&nbsp;&nbsp; &nbsp;Content available through the Services is for informational purposes only. CommLife does not represent that any medical data that you or your designated representative provide or content contained in the Services is complete or accurate. You should contact your physician if You have any questions about your medical condition, or if You need medical help. If You need emergency medical help, you should immediately call 911 or your physician or visit the nearest Hospital Emergency Room.<br><br>3.&nbsp;&nbsp; &nbsp;DATA COLLECTION; STORAGE<br><br>3.1.&nbsp;&nbsp; &nbsp;CommLife stores your personal health information, and by using the Services, You provide CommLife consent to release your personal health information via your&nbsp; SaveLife ID products and services to services providers, such as emergency medical technicians, fire and rescue personnel, police, emergency room professionals, physicians, nurses, hospitals, and each of their staff personnel, lay first responders, among others. <strong>Your personal health information contained in your Emergency Profile will be available and visible to anyone with access to your Save Life ID Emergency Profile access product(s) or account information. Please consider carefully before choosing to make available your medical information through your SaveLife ID products and services.</strong><br><br>3.2.&nbsp;&nbsp; &nbsp;CommLife will also release your personal or medical information to third parties, if such release is required by law or is subpoenaed in judicial or governmental proceedings.<br><br>4.&nbsp;&nbsp; &nbsp;REGISTRATION, ACCOUNTS AND PASSWORDS<br><br>4.1.&nbsp;&nbsp; &nbsp;If You become a registered subscriber and create an account to use the Services, You agree to be responsible for maintaining the confidentiality of passwords or other account identifiers. You agree to notify CommLife of: (i) any loss of your password or account identifiers and (ii) any unauthorized use of your password or account identifiers. CommLife will not be responsible or liable, directly or indirectly, in any way for any loss or damage of any kind incurred as a result of, or in connection with, your failure to comply with this section of the Agreement.<br><br>5.&nbsp;&nbsp; &nbsp;LINKS AND/OR REFERENCES TO OTHER WEBSITES<br><br>5.1.&nbsp;&nbsp; &nbsp;Portions of the Services may provide links and/or references to other websites (“Third-Party Site(s)”). CommLife has no responsibility for such Third-Party Sites and will not be liable for any damages or injury arising from your use of any Third-Party Sites. All links and/or references to Third-Party Sites are provided solely as a convenience and should not be construed as endorsements of any content, products, or services available on those Third-Party Sites. CommLife makes no representations or warranties with respect to the content, products and services, ownership, or legality of any such Third-Party Sites. Your access and use of such Third-Party Sites and the products and services available on those Third-Party Sites, are at your own risk.<br><br>6.&nbsp;&nbsp; &nbsp;CONDITIONS AND PROHIBITIONS<br><br>6.1.&nbsp;&nbsp; &nbsp;As a condition of your use of the Services, You agree that You will not use the Services for any purpose that is unlawful or prohibited by this Agreement, including, without limitation, posting or transmitting any threatening, libelous, defamatory, obscene, scandalous, inflammatory, pornographic, or profane material. Any violation of this Agreement immediately terminates, without notice, your permission to use the Services.<br><br>6.2.&nbsp;&nbsp; &nbsp;You are specifically prohibited from using or allowing others to use any of the Services to perform any action that (i) imposes an unreasonably large load on Services’ infrastructure, including, without limitations, “spam” or other unsolicited mass emails, (ii) discloses or shares any registration information with any unauthorized third parties, (iii) attempts to decipher, decompile, or reverse engineer any part of the Services, (iv) uploads, posts, emails, or otherwise transmits to or from the Services information or content that You do not have a right to transmit under any state, federal, or foreign law, regulation, contract, or fiduciary relationship, (v) violates any applicable state, federal, or foreign law or regulation, (vi) uses any robot, spider, intelligent agent, or other automatic device other than a web browser to search, monitor or copy any pages or information on the Services without CommLife’s express written permission.<br><br>7.&nbsp;&nbsp; &nbsp;OWNERSHIP OF INTELLECTUAL PROPERTY<br><br>7.1.&nbsp;&nbsp; &nbsp;Except for your personal health, lifestyle and medical information, all data and materials on and information related to the Services including, without limitation, the text, graphics, logos, and all other audible, visual or downloadable materials, as well as the selection, organization, coordination, compilation and overall “look and feel” of the Services are the proprietary or intellectual property of CommLife, its licensors or its suppliers, as the case may be. The Services in their entirety are protected by copyright, trademark, patent and any other intellectual property laws and all ownership rights remain with CommLife, its licensors or its suppliers, as the case may be.<br><br>7.2.&nbsp;&nbsp; &nbsp;Other that your own personal health, lifestyle and medical information that you submit and/or otherwise post to the Services, You may only use the data retrieved from the Services for your own personal, non-commercial purposes. Any other use, including the copying, distribution or redistribution of the data by caching, framing or similar means, or selling, reselling, re-transmitting or otherwise making the data retrieved from CommLife’s Services available in any manner to any third party is strictly prohibited.<br><br>7.3.&nbsp;&nbsp; &nbsp;Nothing contained on the Services or in this Agreement serves to grant to You, by implication or otherwise, any license or right to use any content displayed on the Services without the written permission of CommLife or such third party that may own the displayed content.<br><br>8.&nbsp;&nbsp; &nbsp;MEDICAL DISCLAIMER; ASSUMPTION OF RISK<br><br>8.1.&nbsp;&nbsp; &nbsp;CommLife Not Liable. COMMLIFE IS NOT RESPONSIBLE OR LIABLE FOR ANY ADVICE, COURSE OF TREATMENT, DIAGNOSIS OR ANY OTHER INFORMATION, PRODUCTS OR SERVICES THAT YOU MAY OBTAIN FROM THIRD PARTIES.<br><br>8.2.&nbsp;&nbsp; &nbsp;Rely at Your Own Risk. RELIANCE ON THE SERVICES IS SOLELY AT YOUR OWN RISK. YOU ARE SOLELY RESPONSIBLE FOR ENSURING THE ACCURACY OF ANY INFORMATION YOU PROVIDE TO OTHER THROUGH THE USE OF THE SERVICES INCLUDING, WITHOUT LIMITATION, YOUR GIVING ACCESS TO AND USE BY ANY THIRD PARTIES FOR EMERGENCY PURPOSES OR OTHERWISE.<br><br>8.3.&nbsp;&nbsp; &nbsp;You Are Responsible for Security. It is your responsibility to maintain equipment needed to access the Services and to maintain the security of IDs, passwords, and other confidential information You may provide. You are responsible for any other hardware or software necessary to use and access the Services. CommLife is not responsible for any damage to or incompatibility with such hardware and software due to use of the Services.<br><br>8.4.&nbsp;&nbsp; &nbsp;Restrictions on Use. As a condition to your use of the Services, You agree not to use the Services to: (i) infringe the intellectual property rights of others in any way; (ii) attempt to penetrate, modify or manipulate the Services or any of the hardware or software related thereto, in order to: invade the privacy of, obtain the identity of, or obtain any personal information about any other CommLife customers; (iii) attempt to access information that is not otherwise deliberately made available to you through the Services; (iv) modify, erase or damage any information contained on the computer of any user connected to the Services; or (v) reverse engineer, decompile, disassemble, or otherwise allow others to do so, any portion of the Services. The Services or any portion thereof may not be reproduced, duplicated, copied, sold, resold, or otherwise exploited for any commercial purposes not expressly permitted in writing by CommLife.<br><br>8.5.&nbsp;&nbsp; &nbsp;Termination. CommLife reserves the right to refuse use of the Services, in whole or in part, and terminate accounts, for reasons including, without limitation, non-conversion of a trial offer to a paid subscription, non-payment of subsequent renewals or a belief by CommLife, in its absolute discretion, that your conduct violates applicable law or is harmful to the interests of CommLife, its partners, suppliers, or other subscribers, or for any other reason, at CommLife’s sole discretion, with or without cause. After termination, CommLife will purge all subscriber entered data from its databases within sixty (60) days and deem the account unrecoverable.<br><br>9.&nbsp;&nbsp; &nbsp;DISCLAIMERS OF WARRANTIES; LIMITATION OF LIABILITY AND LIQUIDATED DAMAGES<br><br>9.1.&nbsp;&nbsp; &nbsp;LIMITED WARRANTY. CommLife warrants that the Services will be free from defects in materials and workmanship for a period of ninety (90) days beginning on the date of purchase by the original purchaser and as verified by a receipt or other proof of purchase. During the warranty period, CommLife will, at its sole discretion: (1) provide replacement parts necessary to repair the relevant Save Life ID Service; (2) replace the relevant Save Life ID Service with a comparable Save Life ID Service; or (3) refund the amount paid by You for the relevant Save Life ID Service, less depreciation, if applicable, upon return.<br><br>Any replacement parts or Save Life ID Products will be new or serviceably used, comparable in function and performance to the original part or Save Life ID Product, and warranted for the remainder of the original warranty or ninety (90) days from the date of shipment of the replacement part or Save Life ID Product, whichever is longer. Purchasing additional parts or Save Life ID Products from CommLife does not extend this warranty period.<br><br>The warranty does not apply to: (1) damage caused by accident, abuse, neglect, mishandling, dropping, failure or surge of electrical power, air conditioning or humidity control, transportation, or other causes other than ordinary use; (2) products that have been subjected to unauthorized repair, opened or taken apart; (3) products not used or operated in accordance with CommLife’s directions; and (4) damages exceeding the cost of the Save Life ID Product(s).<br><br>THE FOREGOING WARRANTIES APPLY ONLY TO THE ORIGINAL PURCHASER AND MAY NOT BE TRANSFERRED, ASSIGNED OR PASSED THROUGH BY YOU. THIS LIMITED WARRANTY IS THE ONLY WARRANTY AND IS ONLY APPLICABLE TO PRODUCTS OFFERED BY COMMLIFE RELATED TO THE SERVICES. NO ORAL OR WRITTEN INFORMATION OR ADVICE GIVEN BY COMMLIFE, ITS AGENTS OR EMPLOYEES SHALL CREATE A WARRANTY OR IN ANY WAY INCREASE THE SCOPE OF THIS LIMITED WARRANTY. EXCEPT AS SET FORTH HEREIN, COMMLIFE UNDERTAKES NO RESPONSIBILITY FOR THE QUALITY OR PERFORMANCE OF THE SERVICES, AND COMMLIFE DISCLAIMS ALL OTHER WARRANTIES AND CONDITIONS, EXPRESS OR IMPLIED, INCLUDING, WITHOUT LIMITATION, IMPLIED WARRANTIES OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE.<br><br>THE RIGHT TO RETURN YOUR DEFECTIVE SAVE LIFE ID PRODUCT(S), AS DESCRIBED ABOVE, SHALL CONSTITUTE COMMLIFE’S SOLE LIABILITY AND YOUR EXCLUSIVE REMEDY IN CONNECTION WITH ANY CLAIM OF ANY KIND RELATING TO THE QUALITY, CONDITION OR PERFORMANCE OF ANY SAVE LIFE ID PRODUCT, WHETHER SUCH CLAIM IS BASED UPON PRINCIPLES OF CONTRACT, WARRANTY, NEGLIGENCE OR OTHER TORT, BREACH OF ANY STATUTORY DUTY, PRINCIPLES OF INDEMNITY OR CONTRIBUTION, OR OTHERWISE.<br><br>COMMLIFE INCLUDING ITS SUBSIDIARIES, AFFILIATES, PARTNERS, LICENSORS OR VENDORS AND EACH OF THEIR DIRECTORS, MANAGERS, OFFICERS, SHAREHOLDERS, EMPLOYEES, AGENTS, AND OTHER REPRESENTATIVES ALL OF WHICH ARE REFERRED TO HEREIN COLLECTIVELY AS THE “COMMLIFE AFFILIATES” SHALL NOT BE LIABLE UNDER ANY CIRCUMSTANCE TO YOU OR ANY OTHER PARTY FOR ANY SPECIAL, CONSEQUENTIAL, INCIDENTAL OR EXEMPLARY DAMAGES ARISING OUT OF OR IN ANY WAY CONNECTED WITH THE SERVICES OR OTHERWISE, INCLUDING BUT NOT LIMITED TO DAMAGES FOR LOST PROFITS, FAILURE OF ANY OF THE SERVICES FOR ANY REASON WHATSOEVER, THE LOSS OF THE SERVICES INCLUDING THE LOSS OF THE INFORMATION OR DATA CONTAINED THEREIN, THE ACCURACY OF THE CONTENT OF ANY INFORMATION OR DATA DOWNLOADED OR OTHERWISE TRANSFERRED TO OR FROM THE SERVICES BY YOU OR ANY OTHER THIRD PARTY, ANY PARTY’S OR ANY OTHER THIRD PARTY’S RELIANCE ON THE INFORMATION OR DATA CONTAINED OR RETAINED IN CONNECTION WITH THE SERVICS, THE USE OF THE SERVICES IN COMBINATION WITH ANY ELECTRICAL OR ELECTRONIC COMPONENTS, CIRCUITS, SYSTEMS OR ASSEMBLIES OR FOR THE UNSUITABILITY OF THE SERVICES FOR USE WITH ANY CIRCUIT, ASSEMBLY OR ENVIRONMENT, INJURY TO PROPERTY OR ANY DAMAGES OR SUMS PAID BY YOU TO THIRD PARTIES, EVEN IF COMMLIFE OR ANY OF THE COMMLIFE AFFILIATES HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. THE FOREGOING LIMITATON OF LIABILITY SHALL APPLY WHETHER ANY CLAIM IS BASED UPON PRINCIPLES OF CONTRACT, WARRANTY, NEGLIGENCE, OR OTHER TORT, BREACH OF ANY STATUTORY DUTY, PRINCIPLES OF INDEMNITY OR CONTRIBUTION, THE FAILURE OF ANY LIMITED OR EXCLUSIVE REMEDY TO ACHIEVE ITS ESSENTIAL PURPOSE, OR OTHERWISE.<br><br>COMMLIFE DISCLAIMS ANY WARRANTIES OF NON-INFRINGEMENT WITH RESPECT TO THE SERVICES AND NEITHER COMMLIFE OR ANY COMMLIFE AFFILIATES SHALL HAVE ANY DUTY TO DEFEND, INDEMNIFY, OR HOLD YOU HARMLESS FROM AND AGAINST ANY OR ALL DAMAGES OR COSTS INCURRED BY YOU ARISING FROM THE INFRINGEMENT OF PATENTS, TRADEMARKS OR ANY OTHER THIRD PARTY INTELLECTUAL PROPERTY RIGHTS, OR VIOLATIONS OF COPYRIGHTS RELATED TO OR OTHERWISE INVOLVING ANY OF THE SERVICES.<br><br>9.2.&nbsp;&nbsp; &nbsp;Breach of Warranty. COMMLIFE AND THE COMMLIFE AFFILIATES HEREBY DISCLAIM ANY AND ALL LIABILITY TO YOU OR ANY OTHER PARTY FOR ANY BREACH OF ANY ALLEGED WARRANTY OF COMMLIFE OR COMMLIFE AFFILIATES, EVEN IF COMMLIFE, THE COMMLIFE AFFILIATES OR SUCH PARTY HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.<br><br>9.3.&nbsp;&nbsp; &nbsp;Limitation of Liability. COMMLIFE AND THE COMMLIFE AFFILIATES, HEREBY DISCLAIM ANY LIABILITY TO YOU FOR THE USE OF THE SERVICES, AND FOR ANY CLAIMS RELATING TO ALLEGATIONS OF PERSONAL INJURY, WRONGFUL DEATH, LOSS OF USE, LOSS OF PROFITS, INTERRUPTION OF SERVICE OR LOSS OF DATA, WHETHER IN ANY ACTION IN WARRANTY, CONTRACT, TORT (INCLUDING, BUT NOT LIMITED TO NEGLIGENCE OR FUNDAMENTAL BREACH), OR OTHERWISE ARISING OUT OF OR IN NAY WAY CONNECTED WITH THE USE OF, OR THE INABILITY TO USE, THE SERVICES EVEN IF ANY AUTHORIZED REPRESENTATIVE OF COMMLIFE OR THE COMMLIFE AFFILIATES ARE ADVISED OF THE LIKELIHOOD OR POSSIBILITY OF THE SAME.<br><br>9.4.&nbsp;&nbsp; &nbsp;Consequential Damages. AS ANY ALLEGATION OF DAMAGES WOULD BE DIFFICULT IF NOT IMPOSSIBLE TO DETERMINE, YOU AGREE THAT THE TOTAL LIABILITY OF COMMLIFE AND THE COMMLIFE AFFILIATES FOR ACTUAL DAMAGES SHALL NOT EXCEED THE TOTAL AMOUNTS PAID BY YOU TO COMMLIFE DURING THE TWELVE MONTHS PRECEDING THE EVENT GIVING RISE TO SUCH ALLEGATIONS OF LIABILITY, OR IF NO AMOUNT HAVE BEEN PAID BY YOU, TEN DOLLARS ($10.00). IN NO EVENT, SHALL COMMLIFE NOR ANY OF THE COMMLIFE AFFILIATES BE LIABLE FOR ANY SPECIAL, PUNITIVE, INDIRECT, INCIDENTAL, OR CONSEQUENTIAL DAMAGES OR ANY OTHER DAMAGES OF ANY KIND.<br><br>9.5.&nbsp;&nbsp; &nbsp;Release. You release CommLife and the CommLife Affiliates, and each of their assigns and successors-in-interest from any and all liability, direct or indirect, and for any liability, loss or damage that is caused or alleged to have been caused to You from your use of the Services.<br><br>10.&nbsp;&nbsp; &nbsp;LEGAL REQUESTS<br><br>10.1.&nbsp;&nbsp; &nbsp;CommLife cooperates with law enforcement inquiries as a matter of policy. CommLife will use IP addresses and other available information to attempt to identify a subscriber when CommLife is legally compelled to do so or when CommLife feels it is necessary to protect our products, services, sites, customers, or others.<br><br>11.&nbsp;&nbsp; &nbsp;GOVERNING LEGAL PROVISIONS<br><br>11.1.&nbsp;&nbsp; &nbsp;Governing Law and Jurisdiction. This Agreement is governed by the laws of the United States of America and New York for all purposes, without regard to or application of choice of law rules or principles, except that the United Nations Convention on Contracts for the International Sale of Goods will not apply. You hereby consent that any legal action or proceeding with respect to this Agreement shall be shall be brought and maintained exclusively in the state or federal courts in New York County, New York. You should be aware that some jurisdictions do not allow for the exclusion of certain warranties or the limitation or exclusion of incidental or consequential damages which are contained in this Agreement. By agreeing to be bound by these terms and conditions You may be waiving legal rights which could be available to You in another jurisdiction.<br><br>11.2.&nbsp;&nbsp; &nbsp;Export Laws. The U.S. export control laws regulate the export and re-export of technology originating in the United States. This includes the electronic transmission of information and software to foreign countries and certain foreign nationals. You agree to abide by these laws and their regulations, including but not limited to the Export Administration Act and the Arms Export Control Act, and not to transfer, by electronic transmission or otherwise, any materials or information derived from the Services to either a foreign national or a foreign destination in violation of such laws.<br><br>11.3.&nbsp;&nbsp; &nbsp;Indemnification. You agree to indemnify, defend, and hold harmless CommLife and the CommLife Affiliates from and against any claims, actions or demands, liabilities, and settlements, including but not limited to, reasonable legal and accounting fees resulting from, or alleged to result from, your violation of the terms and conditions of this Agreement or any activity related to your account (including infringement of third parties’ worldwide intellectual property rights or negligent or wrongful conduct) by You or any other person accessing the Services.<br><br>11.4.&nbsp;&nbsp; &nbsp;International Laws. CommLife is based in the United States of America. CommLife makes no claims that the content is appropriate or may be downloaded outside of the United States. Access to the content may not be legal by certain persons or in certain countries. If You access any of the Services, its content and any related services from outside the United States, You do so at your own risk and are responsible for compliance with the laws of that jurisdiction.<br><br>11.5.&nbsp;&nbsp; &nbsp;Entire Agreement. This Agreement and all other legal notices (including but not limited to the Privacy Policy) posted by CommLife at http://savelifeid.com/about-us/privacy-policy&nbsp; [URL] constitute the entire agreement between You and CommLife with respect to the Services. In the event of a conflict involving the terms and conditions of this Agreement with any other agreement (whether written or oral) relating to the Services, this Agreement will control. You also may be subject to additional terms and conditions that may apply when You use affiliate services, third-party content, or third-party software.<br><br>11.6.&nbsp;&nbsp; &nbsp;Waiver. Our failure to exercise or enforce any right or provision of this Agreement or other legal notices posted by CommLife shall not constitute a waiver of such right or provision. No waiver of any of the terms and conditions of this Agreement or of any other legal notices posted by CommLife shall be deemed a further or continuing waiver of such term or condition or any other term or condition.<br><br>11.7.&nbsp;&nbsp; &nbsp;Severability. If any provision of this Agreement or of any other legal notices posted by CommLife is found by a court of competent jurisdiction to be invalid, the parties nevertheless agree that the court should endeavor to give effect to the parties’ intentions as reflected in the provision, and the other provisions of this Agreement shall remain in full force and effect.<br><br>11.8.&nbsp;&nbsp; &nbsp;Modification. Neither the course of conduct between the parties nor trade practice shall act to modify any provision of this Agreement or of any other legal notice posted by CommLife.<br><br>11.9.&nbsp;&nbsp; &nbsp;Assignment. CommLife may assign its rights and duties under this Agreement to any party at any time without notice to you and/or your approval.<br><br>11.10.&nbsp;&nbsp; &nbsp;Headings. The section titles in this Agreement are for convenience only and have no legal or contractual effect.<br><br>11.11.&nbsp;&nbsp; &nbsp;Notices. If you have questions or comments regarding Services, please contact us at info@savelifeid.com.<br><br></p>
          </div>

          <div class="checkbox">
            <?= $form->field( $model, 'agree', [ 'template' => '{input}{label}  I agree to the terms of use' ] )->checkbox( [ 'label' => null], false ) ?>
            <?= $form->field( $model, 'agree', [ 'template' => '{error}' ] )->error() ?>
            <?= $form->field( $model, 'terms_readed', [ 'template' => '{error}' ] )->error() ?>
            <?= $form->field( $model, 'terms_readed', [ 'template' => '{input}' ] )->hiddenInput(['value' => $model->agree]) ?>
          </div>

          <h3>Member Information disclosure preference</h3>
          <div class="member-information-disclosure-preference-5-lines-scroll">
            <p>You understand and agree that by selecting this option, you are making immediately available on your emergency profile page all your information as we receive it, including medical information, whether received from your participating medical practice or manually entered by yourself. Your emergency profile page will be seen by anyone scanning your SaveLifeID QR bar-code, NFC or other embedded chip or following its link. You will still retain the ability to manually hide the information you would rather not share. However, if you do not, that information will be part of your viewable profile. Should you decide to hide certain information, a later update may make that information available and viewable again if it was edited by your participating medical practice in any way (e.g. an update to your profile following a visit to the doctor).</p><p>Leaving that option unchecked means only the information you explicitly indicate you have decided to display will be shown on your emergency profile page.  If you don't do this it will result in your emergency profile remaining empty when viewed in an emergency situation regardless of how much information is uploaded by you or your physician.</p>
          </div>

          <div class="checkbox">
            <?= $form->field( $model, 'display_all', [ 'template' => '{input}{label}  DISPLAY ALL my medical information as transmitted by medical practice(s) and/or manually entered on the site, so I won\'t have to enable display of each item individually.' ] )->checkbox( [ 'label' => null ], false ) ?>
          </div>

	        <?= Html::button( 'Continue Registration', [ 'class' => 'btn btn-info right js-submit-activate-form disabled', 'title'=>'You must fill out the form completely including review and accept terms of use.', 'data-toggle'=>'tooltip', 'data-placement'=>'top' ] ) ?>
        </div>
      </div>
    </div>

		<?php \app\components\TimedClientForm::end(); ?>
	<?php } ?>
<?php } ?>


  <div class="hidden popup-display-all">
    <div class="popup-message">
      <p>By choosing "display all" you are enabling the system to display all medical information provided by your doctor or yourself,
        unless you specifically choose items not to display. This applies to information arriving from your Doctor on enrollment,
        as well as future information that may be added.  You will be notified at <?= $model->patient?$model->patient->email:'email' ?> any time new information arrives,
        so you can review the changes and select any items to hide at that time.  You will be able to turn this "display all" feature off if you choose later,
          as well as disabling the email notifications if you prefer.</p>
      <button class="btn btn-primary" data-fancybox-close="">Acknowledge</button>
    </div>
  </div>
  <div class="hidden popup-submit-form">
    <div class="popup-message">
      <p>By not selecting "display all" you will need to manually select every item you wish to have displayed in your emergency profile,
        both now, and with every new update to your medical profile we receive from your doctor(s), or new information you add yourself,
        in the future.  We strongly recommend enabling notification by email on profile updates in the next screen,
        so that you will know when new medical information has arrived from your doctor and needs your authorization for display.
        If you do not individually authorize items in your medical information they will not be shown to emergency personnel scanning your card,
        and your displayed emergency profile could even be blank if you do not authorize anything.</p>
      <p>Do you want to continue with "display all" unchecked?</p>
      <button class="btn btn-info js-send-activate-form">Yes, continue with registration</button>
      <button class="btn btn-primary" data-fancybox-close="">No, give me a chance to change it</button>
    </div>
  </div>

<?php

$this->registerJs( "
$('.field-activateform-display_all label').one('click', function(){
  $.fancybox.open($('.popup-display-all').html(), {
    closeBtn: false,
    buttons: false 
  });
});  

$('.terms-of-use-5-lines-scroll').on('scroll', function(e){
  if ($(this).scrollTop() + 115 > $('p', this).outerHeight()){
    $('.field-activateform-terms_readed .help-block').html('');
    $('.field-activateform-terms_readed').removeClass('has-error');
    $('#activateform-terms_readed').val(1);  
  }
});

$('.field-activateform-agree:first').on('click', function(e){
  if($('#activateform-terms_readed').val() != 1){
    $('#sa_member_edit_form').yiiActiveForm('validateAttribute', 'activateform-terms_readed');
    e.preventDefault();
    return false;
  }
});

$(document).on('click', '.js-send-activate-form', function(){
    $.fancybox.close();  
    $('#sa_member_edit_form').submit();
});

$('#sa_member_edit_form').on('afterValidateAttribute', function(){
  setTimeout(function(){
    if ($('#sa_member_edit_form').find('.has-error').length > 0 || !checkValidate()) {
      $('.js-submit-activate-form').addClass('disabled').attr('title', 'You must fill out the form completely including review and accept terms of use.').tooltip();
    } else {
      $('.js-submit-activate-form').removeClass('disabled').tooltip('destroy').removeAttr('title');
    }
  }, 500);
});

function checkValidate(){
  var validated = true;
  validated = validated && $('#activateform-agree').is(':checked');
  
   ".
    ($model->scenario == \app\modules\patient\models\ActivateForm::SCENARIO_REGISTER?"
      validated = validated && $('#activateform-enrollment_code').val();
    ":"
      validated = validated && $('#activateform-last3slid').val();
    "). " 

  validated = validated && $('#activateform-birthyear').val(); 
  validated = validated && $('#activateform-password').val(); 
  validated = validated && $('#activateform-password_repeat').val(); 
  
  return validated;
}


$('.js-submit-activate-form').on('click', function(){
  if ($(this).hasClass('disabled')){ return false; }
  $('#sa_member_edit_form').data('yiiActiveForm').submitting = false;
  $('#sa_member_edit_form').yiiActiveForm('validate', false);
  if ($('#sa_member_edit_form').find('.has-error').not('.field-activateform-last3hidden').length) {
    return false;
  } else {
    if ($('#activateform-display_all').is(':checked')){
      $('#sa_member_edit_form').submit();
    } else {
      if ($('#sa_member_edit_form').find('.has-error').length) {
        return false;
      } else {
        $.fancybox.open($('.popup-submit-form').html(), {
          closeBtn: false,
          buttons: false 
        });
      }
    }
  }
});

$('#activateform-birthyear').on('keyup', function(){
  var val = $(this).val();
  if (val != parseInt(val)){
    $('#sa_member_edit_form').yiiActiveForm('updateAttribute', 'activateform-birthyear', ['Birth Year must be an integer.']);
  } else {
    $('#sa_member_edit_form').yiiActiveForm('updateAttribute', 'activateform-birthyear', []);
  }
});
$('#activateform-password, #activateform-password_repeat').on('blur', function(){
  $('#sa_member_edit_form').yiiActiveForm('validateAttribute', $(this).attr('id'));
});  

$('#activateform-password_repeat').on('keyup', function(){
  var p1 = $('#activateform-password').val();
  var p2 = $('#activateform-password_repeat').val();
  p1 = p1.substr(0, p2.length);
  
  if (p1 != p2) {
    $('#sa_member_edit_form').yiiActiveForm('updateAttribute', 'activateform-password_repeat', ['Passwords don\'t match']);
  } else {
    $('#sa_member_edit_form').yiiActiveForm('updateAttribute', 'activateform-password_repeat', []);
  }
});  

  " );