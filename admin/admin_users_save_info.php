<?php
//  print_r($_POST);
// exit;
ini_set('display_errors',1);
session_start();
// print_r($_SESSION);
// echo $_SESSION['admin'];
if($_SESSION['admin']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();

// 
 	$form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
	$web_district=web_decryptIt(str_replace(" ", "+", $_POST['web_district']));
	$date=date('Y-m-d');
	$time=date('H:i:s');
	
// Array ( [form_type] => 9ZQy351cQ8U0kTPIXpTe6RVA9YIHUJrBV2zC4uAEMJs= [web_district] => 7O+ZYoFrMuqU9jg93mpIacLh1IB0/t/5cNC/gZyUZg4= [user_roles] => 1 [user_name] => user1 [designation_name] => field user [employee_id] => 920 [email_id] => program [mobile_no] => 893031103 )
// print_r($_POST);

	if($form_type=='Admin Add user Info'){
		$form_type=$_POST['form_type'];
		$web_district=$_POST['web_district'];
		$user_roles=$_POST['user_roles'];
		$user_name=$_POST['user_name'];
		$designation_name=$_POST['designation_name'];
		$employee_id=$_POST['employee_id'];
		$mobile_no=$_POST['mobile_no'];
		$email_id=$_POST['email_id'];

		$oldpassword=mt_rand();
		$oldpassword_hash = md5($oldpassword);
		$oldpassword_hash_id = $oldpassword;

		$query="SELECT * FROM `care_master_system_user` WHERE `employee_id`='$employee_id' ";
	    
        $result=mysqli_query($conn,$query);
        $num_rows=mysqli_num_rows($result);
        if($num_rows==0){

			$insert_query="INSERT INTO `care_master_system_user`(`sl_no`, `user_name`, `email_id`, `level`, `designation`, `employee_id`, `password`, `password_hash`, `mobile_no`, `status`, `assign_status`, `date`, `time`) VALUES (Null,'$user_name','$email_id','$user_roles','$designation_name','$employee_id','$oldpassword_hash_id','$oldpassword_hash','$mobile_no','1','0','$date','$time')";
			
			$sql_exe=mysqli_query($conn,$insert_query);
				
				if($sql_exe){ //check if error is in the record
					$msg->success('SuccessFully Employee Id Is Add to Our Records');
					header('Location:admin_userid_new_userid.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
		
		}else{
			$msg->warning('Employee Id Is Already Present In Our Record');
			header('Location:index.php');
			exit;
		}
	}else if($form_type=='Admin Add user Info2'){
			// Array ( [form_type] => GPr26nL2kCrpFRY+PdjmW2dSTVxll3MvKEWappEk+8o= [web_district] => 51DJ14Ip0Blb1ha8nevKj7ILsaVIpQ7uOnB+8yz79Jw= [employee_id] => user@ilab.com [District_name] => kalahandi [block_name] => junagarh [care_vlg_gp] => Array ( [0] => bankpalas [1] => bankpalas ) [care_vlg_name] => Array ( [0] => balarampur [1] => bankpalas ) [care_vlg_slno] => Array ( [0] => 1 [1] => 2 ) [batch_id] => 2 )
			
			$employee_id=$_POST['employee_id'];
			$District_name=$_POST['District_name'];
			$block_name=$_POST['block_name'];
			$care_vlg_gp=$_POST['care_vlg_gp'];
			$care_vlg_name=$_POST['care_vlg_name'];
			$care_vlg_slno=$_POST['care_vlg_slno'];
			$batch_id=$_POST['batch_id'];
			if(!empty($batch_id)){
				for ($i=0; $i <count($care_vlg_slno) ; $i++) {
					$care_vlg_slno_SINGLE=$care_vlg_slno[$i];
					 if(in_array($care_vlg_slno_SINGLE,$batch_id)){
					 	$care_vlg_slno_SINGLE_id=$care_vlg_slno[$i];
					 	$care_vlg_gp_single=$care_vlg_gp[$i];
						$care_vlg_name_single=$care_vlg_name[$i];

						$insert_assgined="INSERT INTO `care_master_assigned_user_info`(`care_assU_slno`, `care_assU_employee_id`, `care_assU_district_id`, `care_assU_block_id`, `care_assU_gp_id`, `care_assU_village_id`, `care_assU_date`, `care_assU_time`) VALUES (Null,'$employee_id','$District_name','$block_name','$care_vlg_gp_single','$care_vlg_name_single','$date','$time')";

						$sql_exe=mysqli_query($conn,$insert_assgined);

						$village_status="UPDATE `care_master_village_info` SET `care_vlg_assign_status`='1' WHERE`care_vlg_slno`='$care_vlg_slno_SINGLE_id'";
						$sql_exe1=mysqli_query($conn,$village_status);

					 
					 }
					# code...
				}
				$updaet_employee="UPDATE `care_master_system_user` SET `assign_status`='1' WHERE`employee_id`='$employee_id' ";
				$sql_exe_update=mysqli_query($conn,$updaet_employee);
			}
			if($sql_exe_update){ //check if error is in the record
					$msg->success('SuccessFully CPR Is Assiged To Village Loaction');
					header('Location:admin_userid_assign_view_userid_assign.php');
					exit;
				}else{
					$msg->error('Some Problem Occur');
					header('Location:index.php');
					exit;
				}
			exit;
	}else{
		header('Location:logout.php');
		exit;
	}



}else{
	header('Location:logout.php');
	exit;
}