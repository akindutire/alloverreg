<?php

use \CliqsStudio\service\CQS_Session as CQS_Session;

$session = new CQS_Session;



?>

<div class="w3-sidebar w3-bar-block w3-cloud-bg" style="margin-top: 0px;">
	
	<?php  ?>

		<a class="w3-bar-item w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}studentpanel"; ?>" style="text-decoration: none; "><i class="fa fa-home"></i>&nbsp;Home</a>

		<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-green w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}studentpanel/regcourse/{$session_id}/{$FacultyId}/{$DepartmentId}/{$Level}/{$semester}"; ?>" style="text-decoration: none; "><i class="fa fa-plus"></i>&nbsp;Course</a>
		
		
		<a class="w3-bar-item w3-margin-top w3-rightbar w3-border-red w3-grey w3-hover-green" href="<?php echo "{$absForLinksAndInclusion}studentpanel/logout"; ?>" style="text-decoration: none; "><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
	
	<?php  ?>


</div>