<?php
// print_r($_POST);
// exit;
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();


	$form_type_new=web_decryptIt(str_replace(" ", "+", $_POST['form_type_new']));
	echo $form_type_id=web_decryptIt(str_replace(" ", "+", $_POST['form_type_id'])); //to acess switcjh value
	// $slno=web_decryptIt(str_replace(" ", "+", $_POST['form_type_id_div'])); // serilano tobe impact
	$months=web_decryptIt(str_replace(" ", "+", $_POST['form_type_user']));// month
	$comments_mt=$_POST['comments_mt'];
	$slno=$_POST['form_type_id_div'];//
	$date=date('Y-m-d');
	$time=date('H:i:s');
	$meo_user=$_SESSION['meo_user'];
	// exit;
	if($form_type_new=='MEO_comment'){

		switch ($form_type_id) {
			case 'form1':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form1']); // serial mo
				
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				//$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form1']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form1']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form1']);

				$datepicker=$_POST['datepicker'];
				$Activity=$_POST['Activity'];
				$Support=$_POST['Support'];
				$Production=$_POST['Production'];
				$Consumption=$_POST['Consumption'];
				$Remarks=$_POST['Remarks'];
				$Signature=$_POST['Signature'];
				$Sale=$_POST['Sale'];
				// echo count($Activity);
				// echo "<br>".count($slno);
				
				// for ($k=0; $k < count($slno); $k++) { 
				// 			echo "<br>".$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$k]))."<br>";
				// }
				// exit;
				// $filteredarray = (array_filter($Activity));
				// if(!empty($filteredarray)){
					if(count($Activity)==count($slno)){
						for ($j=0; $j < count($slno); $j++) { 
							 $slno_single=web_decryptIt(str_replace(" ", "+", $slno[$j]));
							 // here update of meo in crp table of i/o tracking
							 $update_meo="UPDATE `care_master_Input_output_tracking_TARINA` SET `care_IP_OP_MEO_status`='1',`care_IP_OP_MEO_date`='$date',`care_IP_OP_MEO_time`='$time',`care_IP_OP_MEO_id`='$meo_user' WHERE`care_TARINA_slno`='$slno_single'";
							 $sql_get_detail_update_meo=mysqli_query($conn,$update_meo);
							 // here basic information of crp table is uploade in one go
							  $check_before_uploade="SELECT * FROM `care_master_Input_output_tracking_TARINA_meo` where `care_crp_slno_entry`='$slno_single' ";
							 $sql_check=mysqli_query($conn,$check_before_uploade);
							 $num_upload_hhi=mysqli_num_rows($sql_check);
							 if($num_upload_hhi==0){
							 	$get_info="INSERT INTO `care_master_Input_output_tracking_TARINA_meo`(`care_crp_slno_entry`, `care_TARINA_year`, `care_TARINA_month`, `care_TARINA_district_name`, `care_TARINA_block_name`, `care_TARINA_gp_name`, `care_TARINA_vlg_name`, `care_TARINA_hhi`, `care_TARINA_hhi_slno`, `care_TARINA_w_farmer_name`, `care_TARINA_spouse_name`, `care_TARINA_event_date`, `care_TARINA_activity_name`, `care_TARINA_support_provide`, `care_TARINA_production`, `care_TARINA_consumption`, `care_TARINA_sale`, `care_TARINA_remarks`, `care_TARINA_participant_sign`, `care_TARINA_shg_name`, `care_TARINA_social_caste`, `care_TARINA_status`, `care_TARINA_entry_date`, `care_TARINA_entry_time`, `care_TARINA_long_id`, `care_TARINA_lat_id`, `care_TARINA_employee_id`, `care_IP_OP_mt_comment_empty`, `care_IP_OP_mt_comment_date`, `care_IP_OP_mt_comment_time`, `care_IP_OP_mt_id`, `care_IP_OP_mt_status`, `care_IP_OP_CBO_comment_empty`, `care_IP_OP_CBO_comment_date`, `care_IP_OP_CBO_comment_time`, `care_IP_OP_CBO_comment_status`, `care_IP_OP_CBO_id`, `care_IP_OP_MEO_status`, `care_IP_OP_MEO_date`, `care_IP_OP_MEO_time`, `care_IP_OP_MEO_id`) SELECT * FROM `care_master_Input_output_tracking_TARINA` WHERE `care_master_Input_output_tracking_TARINA`.`care_TARINA_slno`= '$slno_single'";
								$sql_get_detail_int=mysqli_query($conn,$get_info);
							}

						}
						for ($i=0; $i <count($slno) ; $i++) {
							$din[]=$slno_singles=web_decryptIt(str_replace(" ", "+", $slno[$i]));
							$datepicker_single=date('Y-m-d',strtotime(trim($datepicker[$i])));
							$Activity_single=$Activity[$i];
							$Support_single=$Support[$i];
							$Production_single=$Production[$i];
							$Consumption_single=$Consumption[$i];
							$Remarks_single=$Remarks[$i];
							$Signature_single=$Signature[$i];
							$Sale_s=$Sale[$i];

							$update="UPDATE `care_master_Input_output_tracking_TARINA_meo` SET `care_TARINA_event_date_edit`='$datepicker_single',`care_TARINA_event_date_status`='2',`care_TARINA_activity_name_edit`='$Activity_single',`care_TARINA_activity_name_status`='2',`care_TARINA_support_provider_edit`='$Support_single',`care_TARINA_support_provider_status`='2',`care_TARINA_production_edit`='$Production_single',`care_TARINA_production_status`='2',`care_TARINA_consumption_edit`='$Consumption_single',`care_TARINA_consumption_status`='2',`care_TARINA_sale_edit`='$Sale_s',`care_TARINA_sale_status`='2',`care_TARINA_remarks_edit`='$Remarks_single',`care_TARINA_remarks_status`='2',`care_TARINA_participant_sign_edit`='$Signature_single',`care_TARINA_participant_sign_status`='2',`care_TARINA_entry_date_edit`='$date',`care_TARINA_entry_time_edit`='$time' WHERE `care_crp_slno_entry`='$slno_singles'";
							$sql_get_detailsss=mysqli_query($conn,$update);


						}
						// here information is uploaded once
					// Consumption_single
					$update_1="UPDATE `care_master_Input_output_tracking_TARINA_meo` INNER JOIN `care_master_Input_output_tracking_TARINA` ON `care_master_Input_output_tracking_TARINA`.`care_TARINA_slno` = `care_master_Input_output_tracking_TARINA_meo`.`care_crp_slno_entry` AND `care_master_Input_output_tracking_TARINA`.`care_TARINA_consumption`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_consumption_edit`SET `care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_consumption_status`= '1'";
					$sql_get_detail1=mysqli_query($conn,$update_1);
					// datepicker_single
					$update_2="UPDATE `care_master_Input_output_tracking_TARINA_meo` INNER JOIN `care_master_Input_output_tracking_TARINA` ON `care_master_Input_output_tracking_TARINA`.`care_TARINA_slno` = `care_master_Input_output_tracking_TARINA_meo`.`care_crp_slno_entry` AND `care_master_Input_output_tracking_TARINA`.`care_TARINA_event_date`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_event_date_edit`SET `care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_event_date_status`= '1'";
					$sql_get_detail2=mysqli_query($conn,$update_2);
					// Activity_single
					$update_3="UPDATE `care_master_Input_output_tracking_TARINA_meo` INNER JOIN `care_master_Input_output_tracking_TARINA` ON `care_master_Input_output_tracking_TARINA`.`care_TARINA_slno` = `care_master_Input_output_tracking_TARINA_meo`.`care_crp_slno_entry` AND `care_master_Input_output_tracking_TARINA`.`care_TARINA_activity_name`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_activity_name_edit`SET `care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_activity_name_status`= '1'";
					$sql_get_detail3=mysqli_query($conn,$update_3);
					// Support_single
					$update_4="UPDATE `care_master_Input_output_tracking_TARINA_meo` INNER JOIN `care_master_Input_output_tracking_TARINA` ON `care_master_Input_output_tracking_TARINA`.`care_TARINA_slno` = `care_master_Input_output_tracking_TARINA_meo`.`care_crp_slno_entry` AND `care_master_Input_output_tracking_TARINA`.`care_TARINA_support_provide`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_support_provider_edit`SET `care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_support_provider_status`= '1'";
					$sql_get_detail4=mysqli_query($conn,$update_4);
					// Production_single
					$update_5="UPDATE `care_master_Input_output_tracking_TARINA_meo` INNER JOIN `care_master_Input_output_tracking_TARINA` ON `care_master_Input_output_tracking_TARINA`.`care_TARINA_slno` = `care_master_Input_output_tracking_TARINA_meo`.`care_crp_slno_entry` AND `care_master_Input_output_tracking_TARINA`.`care_TARINA_production`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_production_edit`SET `care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_production_status`= '1'";
					$sql_get_detail5=mysqli_query($conn,$update_5);
					// Remarks_single
					$update_6="UPDATE `care_master_Input_output_tracking_TARINA_meo` INNER JOIN `care_master_Input_output_tracking_TARINA` ON `care_master_Input_output_tracking_TARINA`.`care_TARINA_slno` = `care_master_Input_output_tracking_TARINA_meo`.`care_crp_slno_entry` AND `care_master_Input_output_tracking_TARINA`.`care_TARINA_remarks`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_remarks_edit`SET `care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_remarks_status`= '1'";
					$sql_get_detail6=mysqli_query($conn,$update_6);
					// Signature_single
					$update_7="UPDATE `care_master_Input_output_tracking_TARINA_meo` INNER JOIN `care_master_Input_output_tracking_TARINA` ON `care_master_Input_output_tracking_TARINA`.`care_TARINA_slno` = `care_master_Input_output_tracking_TARINA_meo`.`care_crp_slno_entry` AND `care_master_Input_output_tracking_TARINA`.`care_TARINA_participant_sign`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_participant_sign_edit`SET `care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_participant_sign_status`= '1'";
					$sql_get_detail7=mysqli_query($conn,$update_7);
					// Sale_s
					$update_8="UPDATE `care_master_Input_output_tracking_TARINA_meo` INNER JOIN `care_master_Input_output_tracking_TARINA` ON `care_master_Input_output_tracking_TARINA`.`care_TARINA_slno` = `care_master_Input_output_tracking_TARINA_meo`.`care_crp_slno_entry` AND `care_master_Input_output_tracking_TARINA`.`care_TARINA_sale`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_sale_edit`SET `care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_sale_status`= '1'";
					$sql_get_detail8=mysqli_query($conn,$update_8);
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}
				
				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_MEO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							$array_form2[]=2;
						}
					}else{
						$array_date[]=$get_userilaze_form1_date_single;
						$array_form1[]=$care_MEO_status_form1[$i];
						
					}

				}
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form1);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form1`='$care_MEO_status_form1_new',`care_MEO_date_form1`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully Edited information of Input & Output tracking of HHI '.$hhi);
				header('Location:index.php');
				exit;				
				break;
			case 'form2':
			
				$care_CT_status=$_POST['care_CT_status'];
				$care_CT_subject_matter=$_POST['care_CT_subject_matter'];
				$care_CT_male_present=$_POST['care_CT_male_present'];
				$care_CT_feamle_present=$_POST['care_CT_feamle_present'];
				$care_DP_status=$_POST['care_DP_status'];
				$care_DP_subject_matter=$_POST['care_DP_subject_matter'];
				$care_DP_male_present=$_POST['care_DP_male_present'];
				$care_DP_female_present=$_POST['care_DP_female_present'];
				$care_IP_name=$_POST['care_IP_name'];
				// $care_IP_others=$_POST['care_IP_others'];
				$care_implements=$_POST['care_implements'];
				$care_farmer_parcticing=$_POST['care_farmer_parcticing'];
				// UPDATE `care_master_Post_Harvest_Loss` SET `care_PHL_MEO_status`=[value-40],`care_PHL_MEO_date`=[value-41],`care_PHL_MEO_time`=[value-42],`care_PHL_MEO_id`=[value-43] WHERE `care_PHL_slno`
				if(count($slno)==count($care_CT_status)){
					for ($i=0; $i <count($slno) ; $i++) { 
						$care_CT_status_edit=$care_CT_status[$i];
						$care_CT_subject_matter_edit=$care_CT_subject_matter[$i];
						$care_CT_male_present_edit=$care_CT_male_present[$i];
						$care_CT_female_present_edit=$care_CT_feamle_present[$i];
						$care_DP_status_edit=$care_DP_status[$i];
						$care_DP_subject_matter_edit=$care_DP_subject_matter[$i];
						$care_DP_male_present_edit=$care_DP_male_present[$i];
						$care_DP_female_present_edit=$care_DP_female_present[$i];
						$care_IP_name_edit=$care_IP_name[$i];
						$care_implements_edit=$care_implements[$i];
						$care_farmer_parcticing_edit=$care_farmer_parcticing[$i];

						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));

						$phl_update="UPDATE `care_master_Post_Harvest_Loss` SET `care_PHL_MEO_status`='1',`care_PHL_MEO_date`='$date',`care_PHL_MEO_time`='$time',`care_PHL_MEO_id`='$meo_user' WHERE `care_PHL_slno`='$slno_single'";
						mysqli_query($conn,$phl_update);
						$check_meo_phl="SELECT * FROM `care_master_Post_Harvest_Loss_meo` WHERE `care_phl_serial_id`='$slno_single'";
						$sql_exe_check=mysqli_query($conn,$phl_update);
						$num_check_phl=mysqli_num_rows($sql_exe_check);
						if($num_check_phl==0){

							$insert_phl=" INSERT INTO `care_master_Post_Harvest_Loss_meo`(`care_phl_serial_id`, `care_PHL_hhid`, `care_PHL_women_farmer`, `care_PHL_spouse_name`, `care_CT_status`, `care_CT_date`, `care_CT_subject_matter`, `care_CT_male_present`, `care_CT_feamle_present`, `care_DP_status`, `care_DP_date`, `care_DP_subject_matter`, `care_DP_male_present`, `care_DP_female_present`, `care_IP_name`, `care_IP_others`, `care_implements`, `care_farmer_parcticing`, `care_PHL_lat_id`, `care_PHL_long_id`, `care_PHL_employee_id`, `care_PHL_villege_name`, `care_PHL_block_name`, `care_PHL_district_name`, `care_PHL_month`, `care_PHL_year`, `care_PHL_status`, `care_PHL_date`, `care_PHL_time`, `care_PHL_mt_comment_empty`, `care_PHL_mt_comment_date`, `care_PHL_mt_comment_time`, `care_PHL_mt_comment_status`, `care_PHL_mt_id`, `care_PHL_CBO_comment_empty`, `care_PHL_CBO_comment_date`, `care_PHL_CBO_comment_time`, `care_PHL_CBO_comment_status`, `care_PHL_CBO_id`, `care_PHL_MEO_status`, `care_PHL_MEO_date`, `care_PHL_MEO_time`, `care_PHL_MEO_id`) SELECT * FROM `care_master_Post_Harvest_Loss` where `care_master_Post_Harvest_Loss`.`care_PHL_slno`='$slno_single'";
							$sql_insert=mysqli_query($conn,$insert_phl);
							if($sql_insert){
								$update_info_meo="UPDATE `care_master_Post_Harvest_Loss_meo` SET `care_CT_status_edit`='$care_CT_status_edit',`care_CT_status_status`='2',`care_CT_subject_matter_edit`='$care_CT_subject_matter_edit',`care_CT_subject_matter_status`='2',`care_CT_male_present_edit`='$care_CT_male_present_edit',`care_CT_male_present_status`='2',`care_CT_female_present_edit`='$care_CT_female_present_edit',`care_CT_female_present_status`='2',`care_DP_status_edit`='$care_DP_status_edit',`care_DP_status_status`='2',`care_DP_subject_matter_edit`='$care_DP_subject_matter_edit',`care_DP_subject_matter_status`='2',`care_DP_male_present_edit`='$care_DP_male_present_edit',`care_DP_male_present_status`='2',`care_DP_female_present_edit`='$care_DP_female_present_edit',`care_DP_female_present_status`='2',`care_IP_name_edit`='$care_IP_name_edit',`care_IP_name_status`='2',`care_implements_edit`='$care_implements_edit',`care_implements_status`='2',`care_farmer_parcticing_edit`='$care_farmer_parcticing_edit',`care_farmer_parcticing_status`='2' WHERE `care_phl_serial_id`='$slno_single'";
								mysqli_query($conn,$update_info_meo);
							}
						}
					}
					// update_1
					$update_1="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_CT_status`=`care_master_Post_Harvest_Loss_meo`.`care_CT_status_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_CT_status_status`= '1'";
					$sql_get_detail1=mysqli_query($conn,$update_1);
					// update_2
					$update_2="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_CT_subject_matter`=`care_master_Post_Harvest_Loss_meo`.`care_CT_subject_matter_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_CT_subject_matter_status`= '1'";
					$sql_get_detail2=mysqli_query($conn,$update_2);
					// update_3
					$update_3="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_CT_male_present`=`care_master_Post_Harvest_Loss_meo`.`care_CT_male_present_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_CT_male_present_status`= '1'";
					$sql_get_detail3=mysqli_query($conn,$update_3);
					// update_4
					$update_4="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_CT_feamle_present`=`care_master_Post_Harvest_Loss_meo`.`care_CT_female_present_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_CT_female_present_status`= '1'";
					$sql_get_detail4=mysqli_query($conn,$update_4);
					// update_5
					$update_5="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_DP_status`=`care_master_Post_Harvest_Loss_meo`.`care_DP_status_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_DP_status_status`= '1'";
					$sql_get_detail5=mysqli_query($conn,$update_5);
					// update_6
					$update_6="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_DP_subject_matter`=`care_master_Post_Harvest_Loss_meo`.`care_DP_subject_matter_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_DP_subject_matter_status`= '1'";
					$sql_get_detail6=mysqli_query($conn,$update_6);
					// update_7
					$update_7="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_DP_male_present`=`care_master_Post_Harvest_Loss_meo`.`care_DP_male_present_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_DP_male_present_status`= '1'";
					$sql_get_detail7=mysqli_query($conn,$update_7);
					// update_8
					$update_8="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_DP_female_present`=`care_master_Post_Harvest_Loss_meo`.`care_DP_female_present_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_DP_female_present_status`= '1'";
					$sql_get_detail8=mysqli_query($conn,$update_8);
					// update_9
					$update_9="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_IP_name`=`care_master_Post_Harvest_Loss_meo`.`care_IP_name_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_IP_name_status`= '1'";
					$sql_get_detail9=mysqli_query($conn,$update_9);
					// update_10
					$update_10="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_implements`=`care_master_Post_Harvest_Loss_meo`.`care_implements_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_implements_status`= '1'";
					$sql_get_detail10=mysqli_query($conn,$update_10);
					// update_11
					$update_11="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_farmer_parcticing`=`care_master_Post_Harvest_Loss_meo`.`care_farmer_parcticing_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_farmer_parcticing_status`= '1'";
					$sql_get_detail11=mysqli_query($conn,$update_11);
					// // update_12
					// $update_12="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_TARINA_support_provide`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_support_provider_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_TARINA_support_provider_status`= '1'";
					// $sql_get_detail12=mysqli_query($conn,$update_12);
					// // update_13
					// $update_13="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_TARINA_production`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_production_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_TARINA_production_status`= '1'";
					// $sql_get_detail13=mysqli_query($conn,$update_13);
					// // update_14
					// $update_14="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_TARINA_remarks`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_remarks_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_TARINA_remarks_status`= '1'";
					// $sql_get_detail14=mysqli_query($conn,$update_14);
					// // update_15
					// $update_15="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_TARINA_participant_sign`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_participant_sign_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_TARINA_participant_sign_status`= '1'";
					// $sql_get_detail15=mysqli_query($conn,$update_15);
					// // update_18
					// $update_16="UPDATE`care_master_Post_Harvest_Loss_meo` INNER JOIN`care_master_Post_Harvest_Loss` ON`care_master_Post_Harvest_Loss`.`care_PHL_slno` =`care_master_Post_Harvest_Loss_meo`.`care_phl_serial_id` AND`care_master_Post_Harvest_Loss`.`care_TARINA_sale`=`care_master_Input_output_tracking_TARINA_meo`.`care_TARINA_sale_edit`SET`care_master_Post_Harvest_Loss_meo`.`care_TARINA_sale_status`= '1'";
					// $sql_get_detail16=mysqli_query($conn,$update_16);

				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}



				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form2']); // serial mo
				$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form2']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form2']);


				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_MEO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							$array_form2[]=2;
						}
					}else{
						$array_date[]=$get_userilaze_form1_date_single;
						$array_form1[]=$care_MEO_status_form1[$i];
						
					}

				}
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form1);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form2`='$care_MEO_status_form1_new',`care_MEO_date_form2`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);
				$msg->success('SuccessFully Edited information on Post Harvest Loss of HHI '.$hhi);
				header('Location:index.php');
				exit;
				break;
			case "form3" :
			
				$care_LS_IP_training=$_POST['care_LS_IP_training'];
				$care_LS_IP_extension_support=$_POST['care_LS_IP_extension_support'];
				$care_LS_ES_no_of_animal=$_POST['care_LS_ES_no_of_animal'];
				$care_LS_IP_medicine=$_POST['care_LS_IP_medicine'];
				$care_LS_Med_no_of_animal=$_POST['care_LS_Med_no_of_animal'];
				$care_LS_IP_vaccination=$_POST['care_LS_IP_vaccination'];
				$care_LS_VN_no_of_animal=$_POST['care_LS_VN_no_of_animal'];
				$care_LS_IP_others=$_POST['care_LS_IP_others'];
				$care_LS_IP_others_specify=$_POST['care_LS_IP_others_specify'];
				$care_LS_other_no_of_animal=$_POST['care_LS_other_no_of_animal'];
				$care_LS_total_animal=$_POST['care_LS_total_animal'];
				$care_LS_cultivating_fodder=$_POST['care_LS_cultivating_fodder'];
				$care_LS_cultivated_area=$_POST['care_LS_cultivated_area'];
				$care_LS_new_farmer=$_POST['care_LS_new_farmer'];
				$care_LS_continued_farmer=$_POST['care_LS_continued_farmer'];
				$care_LS_QP_extension_support=$_POST['care_LS_QP_extension_support'];
				$care_QP_slno=$_POST['care_QP_slno'];
				$care_QP_item_name=$_POST['care_QP_item_name'];
				$care_QP_quantity=$_POST['care_QP_quantity'];
				$care_QP_type=$_POST['care_QP_type'];
				if(count($slno)==count($care_LS_IP_training)){
					for ($i=0; $i <count($slno) ; $i++) {

						$care_LS_IP_training_edit=$care_LS_IP_training[$i];
						$care_LS_IP_extension_support_edit=$care_LS_IP_extension_support[$i];
						$care_LS_ES_no_of_animal_edit=$care_LS_ES_no_of_animal[$i];
						$care_LS_IP_medicine_edit=$care_LS_IP_medicine[$i];
						$care_LS_Med_no_of_animal_edit=$care_LS_Med_no_of_animal[$i];
						$care_LS_IP_vaccination_edit=$care_LS_IP_vaccination[$i];
						$care_LS_VN_no_of_animal_edit=$care_LS_VN_no_of_animal[$i];
						$care_LS_IP_others_edit=$care_LS_IP_others[$i];

						$care_LS_IP_others_specify_edits=$care_LS_IP_others_specify[$i];
						if(!empty($care_LS_IP_others_specify_edits)){
							$care_LS_IP_others_specify_edit=$care_LS_IP_others_specify_edits;
						}else{
							$care_LS_IP_others_specify_edit="--";
						}
						$care_LS_other_no_of_animal_edits=$care_LS_other_no_of_animal[$i];
						if(!empty($care_LS_other_no_of_animal_edits)){
							$care_LS_other_no_of_animal_edit=$care_LS_other_no_of_animal_edits;
						}else{
							$care_LS_other_no_of_animal_edit=0;
						}
						$care_LS_total_animal_edit=$care_LS_total_animal[$i];
						$care_LS_cultivating_fodder_edit=$care_LS_cultivating_fodder[$i];
						$care_LS_cultivated_area_edit=$care_LS_cultivated_area[$i];
						$care_LS_new_farmer_edit=$care_LS_new_farmer[$i];
						$care_LS_continued_farmer_edit=$care_LS_continued_farmer[$i];
						$care_LS_QP_extension_support_edit=$care_LS_QP_extension_support[$i];

						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));

						$update_ls="UPDATE `care_master_MTF_livestock_TARINA` SET `care_LS_MEO_date`='$date',`care_LS_MEO_time`='$time',`care_LS_MEO_status`='1',`care_LS_MEO_id`='$meo_user' WHERE `care_LS_slno`='$slno_single'";
						$sql_ls_update=mysqli_query($conn,$update_ls);
						if($sql_ls_update){
							$check_ls="SELECT * FROM `care_master_MTF_livestock_TARINA_meo` where `$care_serial_id`='$slno_single'";
							$sql_check_ls=mysqli_query($conn,$check_ls);
							$num_check_ls=mysqli_num_rows($sql_check_ls);
							if($num_check_ls==0){
								$insert_ls="INSERT INTO `care_master_MTF_livestock_TARINA_meo`( `care_serial_id`, `care_LS_hhid`, `care_LS_women_farmer`, `care_LS_spouse_name`, `care_LS_IP_training`, `care_LS_IP_extension_support`, `care_LS_ES_no_of_animal`, `care_LS_IP_medicine`, `care_LS_Med_no_of_animal`, `care_LS_IP_vaccination`, `care_LS_VN_no_of_animal`, `care_LS_IP_others`, `care_LS_IP_others_specify`, `care_LS_other_no_of_animal`, `care_LS_total_animal`, `care_LS_cultivating_fodder`, `care_LS_cultivated_area`, `care_LS_new_farmer`, `care_LS_continued_farmer`, `care_LS_QP_extension_support`, `care_LS_district_name`, `care_LS_block_name`, `care_LS_gp_name`, `care_LS_vlg_name`, `care_LS_employee_id`, `care_LS_lat_id`, `care_LS_long_id`, `care_LS_month`, `care_LS_year`, `care_LS_date`, `care_LS_time`, `care_LS_status`, `livestock`, `care_LS_mt_comment_empty`, `care_LS_mt_comment_date`, `care_LS_mt_comment_time`, `care_LS_mt_comment_status`, `care_LS_mt_id`, `care_LS_CBO_comment_empty`, `care_LS_CBO_comment_date`, `care_LS_CBO_comment_time`, `care_LS_CBO_comment_status`, `care_LS_CBO_id`, `care_LS_MEO_date`, `care_LS_MEO_time`, `care_LS_MEO_status`, `care_LS_MEO_id`) SELECT * FROM `care_master_MTF_livestock_TARINA` WHERE `care_LS_slno`='$slno_single'";
								$sql_insert_ls=mysqli_query($conn,$insert_ls);
								if($sql_insert_ls){
									$update_meo_ls="UPDATE `care_master_MTF_livestock_TARINA_meo` SET `care_LS_IP_training_edit`='$care_LS_IP_training_edit',`care_LS_IP_training_status`='2',`care_LS_IP_extension_support_edit`='$care_LS_IP_extension_support_edit',`care_LS_IP_extension_support_status`='2',`care_LS_ES_no_of_animal_edit`='$care_LS_ES_no_of_animal_edit',`care_LS_ES_no_of_animal_status`='2',`care_LS_IP_medicine_edit`='$care_LS_IP_medicine_edit',`care_LS_IP_medicine_status`='2',`care_LS_Med_no_of_animal_edit`='$care_LS_Med_no_of_animal_edit',`care_LS_Med_no_of_animal_status`='2',`care_LS_IP_vaccination_edit`='$care_LS_IP_vaccination_edit',`care_LS_IP_vaccination_status`='2',`care_LS_VN_no_of_animal_edit`='$care_LS_VN_no_of_animal_edit',`care_LS_VN_no_of_animal_status`='2',`care_LS_IP_others_edit`='$care_LS_IP_others_edit',`care_LS_IP_others_status`='2',`care_LS_IP_others_specify_edit`='$care_LS_IP_others_specify_edit',`care_LS_IP_others_specify_status`='2',`care_LS_other_no_of_animal_edit`='$care_LS_other_no_of_animal_edit',`care_LS_other_no_of_animal_status`='2',`care_LS_total_animal_edit`='$care_LS_total_animal_edit',`care_LS_total_animal_status`='2',`care_LS_cultivating_fodder_edit`='$care_LS_cultivating_fodder_edit',`care_LS_cultivating_fodder_status`='2',`care_LS_cultivated_area_edit`='$care_LS_cultivated_area_edit',`care_LS_cultivated_area_status`='2',`care_LS_new_farmer_edit`='$care_LS_new_farmer_edit',`care_LS_new_farmer_status`='2',`care_LS_continued_farmer_edit`=$care_LS_continued_farmer_edit,`care_LS_continued_farmer_status`='2',`care_LS_QP_extension_support_edit`=$care_LS_QP_extension_support_edit,`care_LS_QP_extension_support_status`='2' WHERE `care_serial_id`='$slno_single'";
									$sql_usp_ls=mysqli_query($conn,$update_meo_ls);
								}
							}
						}

					}
					// care_LS_IP_training_edit
									$update_1="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_training`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_training_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_training_status`= '1'";
									$sql_get_detail1=mysqli_query($conn,$update_1);

									// care_LS_IP_extension_support_edit

									$update_2="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_extension_support`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_extension_support_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_extension_support_status`= '1'";
									$sql_get_detail2=mysqli_query($conn,$update_2);

									// care_LS_ES_no_of_animal_edit

									$update_3="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_ES_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_ES_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_ES_no_of_animal_status`= '1'";
									$sql_get_detail3=mysqli_query($conn,$update_3);

									// care_LS_IP_medicine_edit

									$update_4="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_medicine`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_medicine_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_medicine_status`= '1'";
									$sql_get_detail4=mysqli_query($conn,$update_4);

									// care_LS_Med_no_of_animal_edit

									$update_5="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_Med_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_Med_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_Med_no_of_animal_status`= '1'";
									$sql_get_detail5=mysqli_query($conn,$update_5);

									// care_LS_IP_vaccination_edit

									$update_6="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_vaccination`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_vaccination_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_vaccination_status`= '1'";
									$sql_get_detail6=mysqli_query($conn,$update_6);

									// care_LS_VN_no_of_animal_edit

									$update_7="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_VN_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_VN_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_VN_no_of_animal_status`= '1'";
									$sql_get_detail7=mysqli_query($conn,$update_7);

									// care_LS_IP_others_edit

									$update_8="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_others`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_status`= '1'";
									$sql_get_detail8=mysqli_query($conn,$update_8);

									// care_LS_IP_others_specify_edit

									$update_9="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_others_specify`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_specify_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_specify_status`= '1'";
									$sql_get_detail9=mysqli_query($conn,$update_9);

									// care_LS_other_no_of_animal_edit

									$update_10="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_other_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_other_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_other_no_of_animal_status`= '1'";
									$sql_get_detail10=mysqli_query($conn,$update_10);

									// care_LS_total_animal_edit

									$update_11="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_total_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_total_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_total_animal_status`= '1'";
									$sql_get_detail11=mysqli_query($conn,$update_11);

									// care_LS_cultivating_fodder_edit

									$update_12="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_cultivating_fodder`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivating_fodder_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivating_fodder_status`= '1'";
									$sql_get_detail12=mysqli_query($conn,$update_12);

									// care_LS_cultivated_area_edit

									$update_13="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_cultivated_area`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivated_area_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivated_area_status`= '1'";
									$sql_get_detail13=mysqli_query($conn,$update_13);

									// care_LS_new_farmer_edit

									$update_14="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_new_farmer`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_new_farmer_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_new_farmer_status`= '1'";
									$sql_get_detail14=mysqli_query($conn,$update_14);

									// care_LS_continued_farmer_edit

									$update_15="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_continued_farmer`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_continued_farmer_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_continued_farmer_status`= '1'";
									$sql_get_detail15=mysqli_query($conn,$update_15);

									// care_LS_QP_extension_support_edit
									
									$update_16="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_QP_extension_support`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_QP_extension_support_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_QP_extension_support_status`= '1'";
									$sql_get_detail16=mysqli_query($conn,$update_16);


					for ($j=0; $j < count($care_QP_slno) ; $j++) { 
						$care_QP_slno_edit=$care_QP_slno[$j];
						$care_QP_item_name_edit=$care_QP_item_name[$j];
						$care_QP_quantity_edit=$care_QP_quantity[$j];
						$care_QP_type_edit=$care_QP_type[$j];

						$check_med=" SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_med_serial`='$care_QP_slno_edit'";
						$sql_med_check=mysqli_query($conn,$check_med);
						$num_med=mysqli_num_rows($sql_med_check);
						
						if($num_med==0){
							$sql_qnty="INSERT INTO `care_master_livestock_quantity_provided_meo`( `care_med_serial`, `care_QP_hhid`, `live_stock_id`, `care_QP_livestock_slno`, `care_QP_item_name`, `care_QP_quantity`, `care_QP_type`, `care_QP_month`, `care_QP_date`, `care_QP_time`, `care_QP_status`, `care_QP_year`) SELECT * FROM `care_master_livestock_quantity_provided` WHERE `care_QP_slno`='$care_QP_slno_edit'";
							$sql_med_check_insert=mysqli_query($conn,$sql_qnty);
							if($sql_med_check_insert){
								$query_update="UPDATE `care_master_livestock_quantity_provided_meo` SET `care_QP_item_name_edit`='$care_QP_item_name_edit',`care_QP_item_name_status`='2',`care_QP_quantity_edit`='$care_QP_quantity_edit',`care_QP_quantity_status`='2',`care_QP_type_edit`='$care_QP_type_edit',`care_QP_type_status`='2' WHERE `care_med_serial`='$care_QP_slno_edit'";
								$sql_med_check_insert12=mysqli_query($conn,$query_update);

								$data = file_get_contents('php://input');
								$file = fopen("test.txt", "a+");
								fwrite($file, "---" . $query_update . "---che".$sql_med_check_insert12);
								fclose($file);
							}
						}
						

					}
					// care_QP_quantity_edit

					$update_17="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_item_name`=`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_status`= '1'";
					$sql_get_detail17=mysqli_query($conn,$update_17);

					// care_QP_quantity_edit

					$update_18="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_quantity`=`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_status`= '1'";
					$sql_get_detail18=mysqli_query($conn,$update_18);

					// care_QP_type_edit
					
					$update_19="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_type`=`care_master_livestock_quantity_provided_meo`.`care_QP_type_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_type_status`= '1'";
					$sql_get_detail16=mysqli_query($conn,$update_19);
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}
	// usha fill here
				$hhi=$_POST['care_hhi'];
					$Year=$_POST['Year'];
					$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
					$sql_get_detail=mysqli_query($conn,$get_details);

					$fetch_check=mysqli_fetch_assoc($sql_get_detail);
					$slno_md=$fetch_check['care_hhi_sl_no'];
					$get_userilaze_form1=unserialize($fetch_check['care_form3']); // serial mo
					$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form3']);//
					$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form3']);


					for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
						$get_userilaze_form1_q=$get_userilaze_form1[$i];
						$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
						if(in_array($get_userilaze_form1_q,$din)){
							if($care_MEO_status_form1[$i]==2){
								$array_date[]=$date;
								$array_form1[]=1;
								$array_form2[]=2;
							}else{
								$array_date[]=$get_userilaze_form1_date_single;
								$array_form1[]=1;
								$array_form2[]=2;
							}
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=$care_MEO_status_form1[$i];
							
						}

					}
						$date_mt=serialize($array_date);
						$care_CBO_status_form1_new=serialize($array_form1);
						$care_MEO_status_form1_new=serialize($array_form1);
					 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form3`='$care_MEO_status_form1_new',`care_MEO_date_form3`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
					mysqli_query($conn,$update);
					$msg->success('SuccessFully Edited information on Post Harvest Loss of HHI '.$hhi);
					header('Location:index.php');
					exit;

				break;
			case "form4" :
			
				$care_LS_IP_training=$_POST['care_LS_IP_training'];
				$care_LS_IP_extension_support=$_POST['care_LS_IP_extension_support'];
				$care_LS_ES_no_of_animal=$_POST['care_LS_ES_no_of_animal'];
				$care_LS_IP_medicine=$_POST['care_LS_IP_medicine'];
				$care_LS_Med_no_of_animal=$_POST['care_LS_Med_no_of_animal'];
				$care_LS_IP_vaccination=$_POST['care_LS_IP_vaccination'];
				$care_LS_VN_no_of_animal=$_POST['care_LS_VN_no_of_animal'];
				$care_LS_IP_others=$_POST['care_LS_IP_others'];
				$care_LS_IP_others_specify=$_POST['care_LS_IP_others_specify'];
				$care_LS_other_no_of_animal=$_POST['care_LS_other_no_of_animal'];
				$care_LS_total_animal=$_POST['care_LS_total_animal'];
				$care_LS_cultivating_fodder=$_POST['care_LS_cultivating_fodder'];
				$care_LS_cultivated_area=$_POST['care_LS_cultivated_area'];
				$care_LS_new_farmer=$_POST['care_LS_new_farmer'];
				$care_LS_continued_farmer=$_POST['care_LS_continued_farmer'];
				$care_LS_QP_extension_support=$_POST['care_LS_QP_extension_support'];
				$care_QP_slno=$_POST['care_QP_slno'];
				$care_QP_item_name=$_POST['care_QP_item_name'];
				$care_QP_quantity=$_POST['care_QP_quantity'];
				$care_QP_type=$_POST['care_QP_type'];
				if(count($slno)==count($care_LS_IP_training)){
					for ($i=0; $i <count($slno) ; $i++) {

						$care_LS_IP_training_edit=$care_LS_IP_training[$i];
						$care_LS_IP_extension_support_edit=$care_LS_IP_extension_support[$i];
						$care_LS_ES_no_of_animal_edit=$care_LS_ES_no_of_animal[$i];
						$care_LS_IP_medicine_edit=$care_LS_IP_medicine[$i];
						$care_LS_Med_no_of_animal_edit=$care_LS_Med_no_of_animal[$i];
						$care_LS_IP_vaccination_edit=$care_LS_IP_vaccination[$i];
						$care_LS_VN_no_of_animal_edit=$care_LS_VN_no_of_animal[$i];
						$care_LS_IP_others_edit=$care_LS_IP_others[$i];
						$care_LS_IP_others_specify_edit=$care_LS_IP_others_specify[$i];
						$care_LS_other_no_of_animal_edit=$care_LS_other_no_of_animal[$i];
						$care_LS_total_animal_edit=$care_LS_total_animal[$i];
						$care_LS_cultivating_fodder_edit=$care_LS_cultivating_fodder[$i];
						$care_LS_cultivated_area_edit=$care_LS_cultivated_area[$i];
						$care_LS_new_farmer_edit=$care_LS_new_farmer[$i];
						$care_LS_continued_farmer_edit=$care_LS_continued_farmer[$i];
						$care_LS_QP_extension_support_edit=$care_LS_QP_extension_support[$i];

						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));

						$update_ls="UPDATE `care_master_MTF_livestock_TARINA` SET `care_LS_MEO_date`='$date',`care_LS_MEO_time`='$time',`care_LS_MEO_status`='1',`care_LS_MEO_id`='$meo_user' WHERE `care_LS_slno`='$slno_single'";
						$sql_ls_update=mysqli_query($conn,$update_ls);
						if($sql_ls_update){
							$check_ls="SELECT * FROM `care_master_MTF_livestock_TARINA_meo` where `$care_serial_id`='$slno_single'";
							$sql_check_ls=mysqli_query($conn,$check_ls);
							$num_check_ls=mysqli_num_rows($sql_check_ls);
							if($num_check_ls==0){
								$insert_ls="INSERT INTO `care_master_MTF_livestock_TARINA_meo`( `care_serial_id`, `care_LS_hhid`, `care_LS_women_farmer`, `care_LS_spouse_name`, `care_LS_IP_training`, `care_LS_IP_extension_support`, `care_LS_ES_no_of_animal`, `care_LS_IP_medicine`, `care_LS_Med_no_of_animal`, `care_LS_IP_vaccination`, `care_LS_VN_no_of_animal`, `care_LS_IP_others`, `care_LS_IP_others_specify`, `care_LS_other_no_of_animal`, `care_LS_total_animal`, `care_LS_cultivating_fodder`, `care_LS_cultivated_area`, `care_LS_new_farmer`, `care_LS_continued_farmer`, `care_LS_QP_extension_support`, `care_LS_district_name`, `care_LS_block_name`, `care_LS_gp_name`, `care_LS_vlg_name`, `care_LS_employee_id`, `care_LS_lat_id`, `care_LS_long_id`, `care_LS_month`, `care_LS_year`, `care_LS_date`, `care_LS_time`, `care_LS_status`, `livestock`, `care_LS_mt_comment_empty`, `care_LS_mt_comment_date`, `care_LS_mt_comment_time`, `care_LS_mt_comment_status`, `care_LS_mt_id`, `care_LS_CBO_comment_empty`, `care_LS_CBO_comment_date`, `care_LS_CBO_comment_time`, `care_LS_CBO_comment_status`, `care_LS_CBO_id`, `care_LS_MEO_date`, `care_LS_MEO_time`, `care_LS_MEO_status`, `care_LS_MEO_id`) SELECT * FROM `care_master_MTF_livestock_TARINA` WHERE `care_LS_slno`='$slno_single'";
								$sql_insert_ls=mysqli_query($conn,$insert_ls);
								if($sql_insert_ls){
									$update_meo_ls="UPDATE `care_master_MTF_livestock_TARINA_meo` SET `care_LS_IP_training_edit`='$care_LS_IP_training_edit',`care_LS_IP_training_status`='2',`care_LS_IP_extension_support_edit`='$care_LS_IP_extension_support_edit',`care_LS_IP_extension_support_status`='2',`care_LS_ES_no_of_animal_edit`='$care_LS_ES_no_of_animal_edit',`care_LS_ES_no_of_animal_status`='2',`care_LS_IP_medicine_edit`='$care_LS_IP_medicine_edit',`care_LS_IP_medicine_status`='2',`care_LS_Med_no_of_animal_edit`='$care_LS_Med_no_of_animal_edit',`care_LS_Med_no_of_animal_status`='2',`care_LS_IP_vaccination_edit`='$care_LS_IP_vaccination_edit',`care_LS_IP_vaccination_status`='2',`care_LS_VN_no_of_animal_edit`='$care_LS_VN_no_of_animal_edit',`care_LS_VN_no_of_animal_status`='2',`care_LS_IP_others_edit`='$care_LS_IP_others_edit',`care_LS_IP_others_status`='2',`care_LS_IP_others_specify_edit`='$care_LS_IP_others_specify_edit',`care_LS_IP_others_specify_status`='2',`care_LS_other_no_of_animal_edit`='$care_LS_other_no_of_animal_edit',`care_LS_other_no_of_animal_status`='2',`care_LS_total_animal_edit`='$care_LS_total_animal_edit',`care_LS_total_animal_status`='2',`care_LS_cultivating_fodder_edit`='$care_LS_cultivating_fodder_edit',`care_LS_cultivating_fodder_status`='2',`care_LS_cultivated_area_edit`='$care_LS_cultivated_area_edit',`care_LS_cultivated_area_status`='2',`care_LS_new_farmer_edit`='$care_LS_new_farmer_edit',`care_LS_new_farmer_status`='2',`care_LS_continued_farmer_edit`=$care_LS_continued_farmer_edit,`care_LS_continued_farmer_status`='2',`care_LS_QP_extension_support_edit`=$care_LS_QP_extension_support_edit,`care_LS_QP_extension_support_status`='2' WHERE `care_serial_id`='$slno_single'";
									$sql_update_ls=mysqli_query($conn,$update_meo_ls);
									
									// care_LS_IP_training_edit
									$update_1="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_training`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_training_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_training_status`= '1'";
									$sql_get_detail1=mysqli_query($conn,$update_1);

									// care_LS_IP_extension_support_edit

									$update_2="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_extension_support`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_extension_support_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_extension_support_status`= '1'";
									$sql_get_detail2=mysqli_query($conn,$update_2);

									// care_LS_ES_no_of_animal_edit

									$update_3="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_ES_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_ES_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_ES_no_of_animal_status`= '1'";
									$sql_get_detail3=mysqli_query($conn,$update_3);

									// care_LS_IP_medicine_edit

									$update_4="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_medicine`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_medicine_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_medicine_status`= '1'";
									$sql_get_detail4=mysqli_query($conn,$update_4);

									// care_LS_Med_no_of_animal_edit

									$update_5="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_Med_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_Med_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_Med_no_of_animal_status`= '1'";
									$sql_get_detail5=mysqli_query($conn,$update_5);

									// care_LS_IP_vaccination_edit

									$update_6="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_vaccination`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_vaccination_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_vaccination_status`= '1'";
									$sql_get_detail6=mysqli_query($conn,$update_6);

									// care_LS_VN_no_of_animal_edit

									$update_7="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_VN_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_VN_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_VN_no_of_animal_status`= '1'";
									$sql_get_detail7=mysqli_query($conn,$update_7);

									// care_LS_IP_others_edit

									$update_8="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_others`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_status`= '1'";
									$sql_get_detail8=mysqli_query($conn,$update_8);

									// care_LS_IP_others_specify_edit

									$update_9="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_others_specify`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_specify_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_specify_status`= '1'";
									$sql_get_detail9=mysqli_query($conn,$update_9);

									// care_LS_other_no_of_animal_edit

									$update_10="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_other_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_other_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_other_no_of_animal_status`= '1'";
									$sql_get_detail10=mysqli_query($conn,$update_10);

									// care_LS_total_animal_edit

									$update_11="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_total_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_total_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_total_animal_status`= '1'";
									$sql_get_detail11=mysqli_query($conn,$update_11);

									// care_LS_cultivating_fodder_edit

									$update_12="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_cultivating_fodder`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivating_fodder_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivating_fodder_status`= '1'";
									$sql_get_detail12=mysqli_query($conn,$update_12);

									// care_LS_cultivated_area_edit

									$update_13="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_cultivated_area`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivated_area_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivated_area_status`= '1'";
									$sql_get_detail13=mysqli_query($conn,$update_13);

									// care_LS_new_farmer_edit

									$update_14="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_new_farmer`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_new_farmer_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_new_farmer_status`= '1'";
									$sql_get_detail14=mysqli_query($conn,$update_14);

									// care_LS_continued_farmer_edit

									$update_15="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_continued_farmer`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_continued_farmer_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_continued_farmer_status`= '1'";
									$sql_get_detail15=mysqli_query($conn,$update_15);

									// care_LS_QP_extension_support_edit
									
									$update_16="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_QP_extension_support`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_QP_extension_support_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_QP_extension_support_status`= '1'";
									$sql_get_detail16=mysqli_query($conn,$update_16);
								}else{	
									$msg->error('Some Error Please Try Again');
									header('Location:index.php');
									exit;
								}

							}else{
								$msg->error('Some Error Please Try Again');
								header('Location:index.php');
								exit;
							}
						}else{
							$msg->error('Some Error Please Try Again');
							header('Location:index.php');
							exit;
						}

					}


					for ($j=0; $j < count($care_QP_slno) ; $j++) { 
						$care_QP_slno_edit=$care_QP_slno[$j];
						$care_QP_item_name_edit=$care_QP_item_name[$j];
						$care_QP_quantity_edit=$care_QP_quantity[$j];
						$care_QP_type_edit-$care_QP_type[$j];

						$check_med=" SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_med_serial`='$care_QP_slno_edit'";
						$sql_med_check=mysqli_query($conn,$check_med);
						$num_med=mysqli_num_rows($sql_med_check);
						if($num_med==0){
							$sql_qnty="INSERT INTO `care_master_livestock_quantity_provided_meo`( `care_med_serial`, `care_QP_hhid`, `live_stock_id`, `care_QP_livestock_slno`, `care_QP_item_name`, `care_QP_quantity`, `care_QP_type`, `care_QP_month`, `care_QP_date`, `care_QP_time`, `care_QP_status`, `care_QP_year`) SELECT * FROM `care_master_livestock_quantity_provided` WHERE `care_QP_slno`='$care_QP_slno_edit'";
							$sql_med_check_insert=mysqli_query($conn,$check_med);
							if($sql_med_check_insert){
								$query_update="UPDATE `care_master_livestock_quantity_provided_meo` SET `care_QP_item_name_edit`='$care_QP_item_name_edit',`care_QP_item_name_status`='2',`care_QP_quantity_edit`='$care_QP_quantity_edit',`care_QP_quantity_status`='2',`care_QP_type_edit`='$care_QP_type_edit',`care_QP_type_status`='2' WHERE `care_med_serial`='$care_QP_slno_edit'";
								$sql_med_check_insert=mysqli_query($conn,$query_update);


							}
						}


					}
					// care_QP_quantity_edit

					$update_17="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_item_name`=`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_status`= '1'";
					$sql_get_detail17=mysqli_query($conn,$update_17);

					// care_QP_quantity_edit

					$update_18="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_quantity`=`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_status`= '1'";
					$sql_get_detail18=mysqli_query($conn,$update_18);

					// care_QP_type_edit
					
					$update_19="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_type`=`care_master_livestock_quantity_provided_meo`.`care_QP_type_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_type_status`= '1'";
					$sql_get_detail16=mysqli_query($conn,$update_19);
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}
	// usha fill here
				$hhi=$_POST['care_hhi'];
					$Year=$_POST['Year'];
					$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
					$sql_get_detail=mysqli_query($conn,$get_details);

					$fetch_check=mysqli_fetch_assoc($sql_get_detail);
					$slno_md=$fetch_check['care_hhi_sl_no'];
					$get_userilaze_form1=unserialize($fetch_check['care_form3']); // serial mo
					$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form3']);//
					$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form3']);


					for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
						$get_userilaze_form1_q=$get_userilaze_form1[$i];
						$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
						if(in_array($get_userilaze_form1_q,$din)){
							if($care_MEO_status_form1[$i]==2){
								$array_date[]=$date;
								$array_form1[]=1;
								$array_form2[]=2;
							}else{
								$array_date[]=$get_userilaze_form1_date_single;
								$array_form1[]=1;
								$array_form2[]=2;
							}
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=$care_MEO_status_form1[$i];
							
						}

					}
						$date_mt=serialize($array_date);
						$care_CBO_status_form1_new=serialize($array_form1);
						$care_MEO_status_form1_new=serialize($array_form1);
					 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form3`='$care_MEO_status_form1_new',`care_MEO_date_form3`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
					mysqli_query($conn,$update);
					$msg->success('SuccessFully Edited information on Post Harvest Loss of HHI '.$hhi);
					header('Location:index.php');
					exit;

				break;
			case "form5" :
			
				$care_LS_IP_training=$_POST['care_LS_IP_training'];
				$care_LS_IP_extension_support=$_POST['care_LS_IP_extension_support'];
				$care_LS_ES_no_of_animal=$_POST['care_LS_ES_no_of_animal'];
				$care_LS_IP_medicine=$_POST['care_LS_IP_medicine'];
				$care_LS_Med_no_of_animal=$_POST['care_LS_Med_no_of_animal'];
				$care_LS_IP_vaccination=$_POST['care_LS_IP_vaccination'];
				$care_LS_VN_no_of_animal=$_POST['care_LS_VN_no_of_animal'];
				$care_LS_IP_others=$_POST['care_LS_IP_others'];
				$care_LS_IP_others_specify=$_POST['care_LS_IP_others_specify'];
				$care_LS_other_no_of_animal=$_POST['care_LS_other_no_of_animal'];
				$care_LS_total_animal=$_POST['care_LS_total_animal'];
				$care_LS_cultivating_fodder=$_POST['care_LS_cultivating_fodder'];
				$care_LS_cultivated_area=$_POST['care_LS_cultivated_area'];
				$care_LS_new_farmer=$_POST['care_LS_new_farmer'];
				$care_LS_continued_farmer=$_POST['care_LS_continued_farmer'];
				$care_LS_QP_extension_support=$_POST['care_LS_QP_extension_support'];
				$care_QP_slno=$_POST['care_QP_slno'];
				$care_QP_item_name=$_POST['care_QP_item_name'];
				$care_QP_quantity=$_POST['care_QP_quantity'];
				$care_QP_type=$_POST['care_QP_type'];
				if(count($slno)==count($care_LS_IP_training)){
					for ($i=0; $i <count($slno) ; $i++) {

						$care_LS_IP_training_edit=$care_LS_IP_training[$i];
						$care_LS_IP_extension_support_edit=$care_LS_IP_extension_support[$i];
						$care_LS_ES_no_of_animal_edit=$care_LS_ES_no_of_animal[$i];
						$care_LS_IP_medicine_edit=$care_LS_IP_medicine[$i];
						$care_LS_Med_no_of_animal_edit=$care_LS_Med_no_of_animal[$i];
						$care_LS_IP_vaccination_edit=$care_LS_IP_vaccination[$i];
						$care_LS_VN_no_of_animal_edit=$care_LS_VN_no_of_animal[$i];
						$care_LS_IP_others_edit=$care_LS_IP_others[$i];
						$care_LS_IP_others_specify_edit=$care_LS_IP_others_specify[$i];
						$care_LS_other_no_of_animal_edit=$care_LS_other_no_of_animal[$i];
						$care_LS_total_animal_edit=$care_LS_total_animal[$i];
						$care_LS_cultivating_fodder_edit=$care_LS_cultivating_fodder[$i];
						$care_LS_cultivated_area_edit=$care_LS_cultivated_area[$i];
						$care_LS_new_farmer_edit=$care_LS_new_farmer[$i];
						$care_LS_continued_farmer_edit=$care_LS_continued_farmer[$i];
						$care_LS_QP_extension_support_edit=$care_LS_QP_extension_support[$i];

						$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));

						$update_ls="UPDATE `care_master_MTF_livestock_TARINA` SET `care_LS_MEO_date`='$date',`care_LS_MEO_time`='$time',`care_LS_MEO_status`='1',`care_LS_MEO_id`='$meo_user' WHERE `care_LS_slno`='$slno_single'";
						$sql_ls_update=mysqli_query($conn,$update_ls);
						if($sql_ls_update){
							$check_ls="SELECT * FROM `care_master_MTF_livestock_TARINA_meo` where `$care_serial_id`='$slno_single'";
							$sql_check_ls=mysqli_query($conn,$check_ls);
							$num_check_ls=mysqli_num_rows($sql_check_ls);
							if($num_check_ls==0){
								$insert_ls="INSERT INTO `care_master_MTF_livestock_TARINA_meo`( `care_serial_id`, `care_LS_hhid`, `care_LS_women_farmer`, `care_LS_spouse_name`, `care_LS_IP_training`, `care_LS_IP_extension_support`, `care_LS_ES_no_of_animal`, `care_LS_IP_medicine`, `care_LS_Med_no_of_animal`, `care_LS_IP_vaccination`, `care_LS_VN_no_of_animal`, `care_LS_IP_others`, `care_LS_IP_others_specify`, `care_LS_other_no_of_animal`, `care_LS_total_animal`, `care_LS_cultivating_fodder`, `care_LS_cultivated_area`, `care_LS_new_farmer`, `care_LS_continued_farmer`, `care_LS_QP_extension_support`, `care_LS_district_name`, `care_LS_block_name`, `care_LS_gp_name`, `care_LS_vlg_name`, `care_LS_employee_id`, `care_LS_lat_id`, `care_LS_long_id`, `care_LS_month`, `care_LS_year`, `care_LS_date`, `care_LS_time`, `care_LS_status`, `livestock`, `care_LS_mt_comment_empty`, `care_LS_mt_comment_date`, `care_LS_mt_comment_time`, `care_LS_mt_comment_status`, `care_LS_mt_id`, `care_LS_CBO_comment_empty`, `care_LS_CBO_comment_date`, `care_LS_CBO_comment_time`, `care_LS_CBO_comment_status`, `care_LS_CBO_id`, `care_LS_MEO_date`, `care_LS_MEO_time`, `care_LS_MEO_status`, `care_LS_MEO_id`) SELECT * FROM `care_master_MTF_livestock_TARINA` WHERE `care_LS_slno`='$slno_single'";
								$sql_insert_ls=mysqli_query($conn,$insert_ls);
								if($sql_insert_ls){
									$update_meo_ls="UPDATE `care_master_MTF_livestock_TARINA_meo` SET `care_LS_IP_training_edit`='$care_LS_IP_training_edit',`care_LS_IP_training_status`='2',`care_LS_IP_extension_support_edit`='$care_LS_IP_extension_support_edit',`care_LS_IP_extension_support_status`='2',`care_LS_ES_no_of_animal_edit`='$care_LS_ES_no_of_animal_edit',`care_LS_ES_no_of_animal_status`='2',`care_LS_IP_medicine_edit`='$care_LS_IP_medicine_edit',`care_LS_IP_medicine_status`='2',`care_LS_Med_no_of_animal_edit`='$care_LS_Med_no_of_animal_edit',`care_LS_Med_no_of_animal_status`='2',`care_LS_IP_vaccination_edit`='$care_LS_IP_vaccination_edit',`care_LS_IP_vaccination_status`='2',`care_LS_VN_no_of_animal_edit`='$care_LS_VN_no_of_animal_edit',`care_LS_VN_no_of_animal_status`='2',`care_LS_IP_others_edit`='$care_LS_IP_others_edit',`care_LS_IP_others_status`='2',`care_LS_IP_others_specify_edit`='$care_LS_IP_others_specify_edit',`care_LS_IP_others_specify_status`='2',`care_LS_other_no_of_animal_edit`='$care_LS_other_no_of_animal_edit',`care_LS_other_no_of_animal_status`='2',`care_LS_total_animal_edit`='$care_LS_total_animal_edit',`care_LS_total_animal_status`='2',`care_LS_cultivating_fodder_edit`='$care_LS_cultivating_fodder_edit',`care_LS_cultivating_fodder_status`='2',`care_LS_cultivated_area_edit`='$care_LS_cultivated_area_edit',`care_LS_cultivated_area_status`='2',`care_LS_new_farmer_edit`='$care_LS_new_farmer_edit',`care_LS_new_farmer_status`='2',`care_LS_continued_farmer_edit`=$care_LS_continued_farmer_edit,`care_LS_continued_farmer_status`='2',`care_LS_QP_extension_support_edit`=$care_LS_QP_extension_support_edit,`care_LS_QP_extension_support_status`='2' WHERE `care_serial_id`='$slno_single'";
									$sql_update_ls=mysqli_query($conn,$update_meo_ls);
									
									// care_LS_IP_training_edit
									$update_1="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_training`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_training_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_training_status`= '1'";
									$sql_get_detail1=mysqli_query($conn,$update_1);

									// care_LS_IP_extension_support_edit

									$update_2="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_extension_support`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_extension_support_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_extension_support_status`= '1'";
									$sql_get_detail2=mysqli_query($conn,$update_2);

									// care_LS_ES_no_of_animal_edit

									$update_3="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_ES_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_ES_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_ES_no_of_animal_status`= '1'";
									$sql_get_detail3=mysqli_query($conn,$update_3);

									// care_LS_IP_medicine_edit

									$update_4="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_medicine`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_medicine_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_medicine_status`= '1'";
									$sql_get_detail4=mysqli_query($conn,$update_4);

									// care_LS_Med_no_of_animal_edit

									$update_5="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_Med_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_Med_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_Med_no_of_animal_status`= '1'";
									$sql_get_detail5=mysqli_query($conn,$update_5);

									// care_LS_IP_vaccination_edit

									$update_6="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_vaccination`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_vaccination_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_vaccination_status`= '1'";
									$sql_get_detail6=mysqli_query($conn,$update_6);

									// care_LS_VN_no_of_animal_edit

									$update_7="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_VN_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_VN_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_VN_no_of_animal_status`= '1'";
									$sql_get_detail7=mysqli_query($conn,$update_7);

									// care_LS_IP_others_edit

									$update_8="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_others`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_status`= '1'";
									$sql_get_detail8=mysqli_query($conn,$update_8);

									// care_LS_IP_others_specify_edit

									$update_9="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_IP_others_specify`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_specify_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_IP_others_specify_status`= '1'";
									$sql_get_detail9=mysqli_query($conn,$update_9);

									// care_LS_other_no_of_animal_edit

									$update_10="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_other_no_of_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_other_no_of_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_other_no_of_animal_status`= '1'";
									$sql_get_detail10=mysqli_query($conn,$update_10);

									// care_LS_total_animal_edit

									$update_11="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_total_animal`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_total_animal_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_total_animal_status`= '1'";
									$sql_get_detail11=mysqli_query($conn,$update_11);

									// care_LS_cultivating_fodder_edit

									$update_12="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_cultivating_fodder`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivating_fodder_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivating_fodder_status`= '1'";
									$sql_get_detail12=mysqli_query($conn,$update_12);

									// care_LS_cultivated_area_edit

									$update_13="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_cultivated_area`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivated_area_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_cultivated_area_status`= '1'";
									$sql_get_detail13=mysqli_query($conn,$update_13);

									// care_LS_new_farmer_edit

									$update_14="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_new_farmer`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_new_farmer_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_new_farmer_status`= '1'";
									$sql_get_detail14=mysqli_query($conn,$update_14);

									// care_LS_continued_farmer_edit

									$update_15="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_continued_farmer`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_continued_farmer_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_continued_farmer_status`= '1'";
									$sql_get_detail15=mysqli_query($conn,$update_15);

									// care_LS_QP_extension_support_edit
									
									$update_16="UPDATE`care_master_MTF_livestock_TARINA_meo` INNER JOIN`care_master_MTF_livestock_TARINA` ON`care_master_MTF_livestock_TARINA`.`care_LS_slno` =`care_master_MTF_livestock_TARINA_meo`.`care_serial_id` AND`care_master_MTF_livestock_TARINA`.`care_LS_QP_extension_support`=`care_master_MTF_livestock_TARINA_meo`.`care_LS_QP_extension_support_edit`SET`care_master_MTF_livestock_TARINA_meo`.`care_LS_QP_extension_support_status`= '1'";
									$sql_get_detail16=mysqli_query($conn,$update_16);
								}else{	
									$msg->error('Some Error Please Try Again');
									header('Location:index.php');
									exit;
								}

							}else{
								$msg->error('Some Error Please Try Again');
								header('Location:index.php');
								exit;
							}
						}else{
							$msg->error('Some Error Please Try Again');
							header('Location:index.php');
							exit;
						}

					}


					for ($l=0; $l < count($care_QP_slno) ; $l++) { 
						$care_QP_slno_edit=$care_QP_slno[$l];
						$care_QP_item_name_edit=$care_QP_item_name[$l];
						$care_QP_quantity_edit=$care_QP_quantity[$l];
						$care_QP_type_edit-$care_QP_type[$l];

						$check_med=" SELECT * FROM `care_master_livestock_quantity_provided_meo` WHERE `care_med_serial`='$care_QP_slno_edit'";
						$sql_med_check=mysqli_query($conn,$check_med);
						$num_med=mysqli_num_rows($sql_med_check);
						if($num_med==0){
							$sql_qnty="INSERT INTO `care_master_livestock_quantity_provided_meo`( `care_med_serial`, `care_QP_hhid`, `live_stock_id`, `care_QP_livestock_slno`, `care_QP_item_name`, `care_QP_quantity`, `care_QP_type`, `care_QP_month`, `care_QP_date`, `care_QP_time`, `care_QP_status`, `care_QP_year`) SELECT * FROM `care_master_livestock_quantity_provided` WHERE `care_QP_slno`='$care_QP_slno_edit'";
							$sql_med_check_insert=mysqli_query($conn,$check_med);
							if($sql_med_check_insert){
								$query_update="UPDATE `care_master_livestock_quantity_provided_meo` SET `care_QP_item_name_edit`='$care_QP_item_name_edit',`care_QP_item_name_status`='2',`care_QP_quantity_edit`='$care_QP_quantity_edit',`care_QP_quantity_status`='2',`care_QP_type_edit`='$care_QP_type_edit',`care_QP_type_status`='2' WHERE `care_med_serial`='$care_QP_slno_edit'";
								$sql_med_check_insert=mysqli_query($conn,$check_med);


							}
						}


					}
					// care_QP_quantity_edit

					$update_17="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_item_name`=`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_item_name_status`= '1'";
					$sql_get_detail17=mysqli_query($conn,$update_17);

					// care_QP_quantity_edit

					$update_18="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_quantity`=`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_quantity_status`= '1'";
					$sql_get_detail18=mysqli_query($conn,$update_18);

					// care_QP_type_edit
					
					$update_19="UPDATE`care_master_livestock_quantity_provided_meo` INNER JOIN`care_master_livestock_quantity_provided` ON`care_master_livestock_quantity_provided`.`care_QP_slno` =`care_master_livestock_quantity_provided_meo`.`care_med_serial` AND`care_master_livestock_quantity_provided`.`care_QP_type`=`care_master_livestock_quantity_provided_meo`.`care_QP_type_edit`SET`care_master_livestock_quantity_provided_meo`.`care_QP_type_status`= '1'";
					$sql_get_detail16=mysqli_query($conn,$update_19);
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}
	// usha fill here
				$hhi=$_POST['care_hhi'];
					$Year=$_POST['Year'];
					$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
					$sql_get_detail=mysqli_query($conn,$get_details);

					$fetch_check=mysqli_fetch_assoc($sql_get_detail);
					$slno_md=$fetch_check['care_hhi_sl_no'];
					$get_userilaze_form1=unserialize($fetch_check['care_form3']); // serial mo
					$get_userilaze_form1_date=unserialize($fetch_check['care_MEO_date_form3']);//
					$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form3']);


					for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
						$get_userilaze_form1_q=$get_userilaze_form1[$i];
						$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
						if(in_array($get_userilaze_form1_q,$din)){
							if($care_MEO_status_form1[$i]==2){
								$array_date[]=$date;
								$array_form1[]=1;
								$array_form2[]=2;
							}else{
								$array_date[]=$get_userilaze_form1_date_single;
								$array_form1[]=1;
								$array_form2[]=2;
							}
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=$care_MEO_status_form1[$i];
							
						}
}
					// }
					// 	$date_mt=serialize($array_date);
					// 	$care_CBO_status_form1_new=serialize($array_form1);
					// 	$care_MEO_status_form1_new=serialize($array_form1);
					//  $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form3`='$care_MEO_status_form1_new',`care_MEO_date_form3`='$date_mt' WHERE`care_hhi_sl_no`='$slno_md'";
					// mysqli_query($conn,$update);
					$msg->success('SuccessFully Edited information on Post Harvest Loss of HHI '.$hhi);
					header('Location:index.php');
					exit;

				break;

			default:
				# code...
				break;
		}

	}else{
		echo "110";
		exit;
	header('Location:logout.php');
	    exit;
	}


}else{
echo "string";
	exit;
	header('Location:logout.php');
    exit; 
}