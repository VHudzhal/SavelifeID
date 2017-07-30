<?php
$action = isset($_GET['action'])?$_GET['action']:'index';
?>
<style>
	ul.menu { padding: 0; }
	ul.menu li { display: inline-block; }
	ul.menu li a { border:1px solid #00b3ee; border-radius: 5px; padding: 5px; display: inline-block; background: #9acfea; text-decoration: none; }
	ul.menu li a:hover{ background: #1c94c4; }
	div.log { border-top: 1px dashed #9acfea; padding: 15px 5px;  }
</style>
<ul class="menu">
	<li><a href="/ch.php?action=env">Update server environment</a></li>
	<li><a href="/ch.php?action=migrations">Apply migrations</a></li>
</ul>
<div class="log">

<?php

switch($action){
	case 'env':
		echo('<h1>Update server environment</h1>');
		$path   = '../.environment/';
		$target = '../.env';
		$env    = false;
		$instance_id = trim(shell_exec('/opt/aws/bin/ec2-metadata --instance-id | cut -d " " -f 2'));
		echo('Changing .env for instance '.$instance_id.' to ');

		$pdata = shell_exec('aws ec2 describe-tags --filters');
		$data = json_decode($pdata);
		if ($data && isset($data->Tags)) {
			foreach($data->Tags as $one){
				if (($one->ResourceId == $instance_id) && ($one->Key == 'ServerEnvironment')){
					$env = $one->Value;
				}
			}
		}

		if ($env){
			echo('"'.$env.'": ');
			if (file_exists($path.$env)){
				if (copy($path.$env, $target)){
					echo('Ok');
				} else {
					echo('Error while copying .env file from '.$path.$env.' to '.$target);
				}
			} else echo('Source .env file not exists: '.$path.$env);

		} else echo('UNKNOWN - error!');
		break;
	case 'migrations':
		echo('<h1>Apply migrations</h1>');
		$cmd   = 'php ../yii migrate --interactive=0';
		system($cmd);
		break;
	default:
		echo('<h1>Choose what are you want to do</h1>');
}
?>
</div>