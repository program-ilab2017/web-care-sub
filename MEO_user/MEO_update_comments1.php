<?php
// print_r($_POST);
// exit;
// ini_set('display_errors',1);
// 
// Array ( [form_type_new] => K5DLW3eQCcZOuVAzVnsoh0As0Twi4eE6Vnp0QG/yK74= [form_type_id] => ULWBMP8PCuPzD98MItazIJUNdP/orU8IeYI25v34epY= [form_type_user] => x8mFQV7/zmcrGyAQTUyVK6Lw1B5dCohIIxLgJHQYWGk= [lat2] => 20.2960587 [lat] => 20.2960587 [long2] => 85.8245398 [long] => 85.8245398 [care_hhi] => 102020200743 [care_hhi_slno] => [district] => kalahandi [GP_name] => bankapalas [hhi] => 102020200743 [Block] => bankapalas [Village] => bankapalas [Year] => 2017 [women] => nilendri majhi [Spouse] => makardhwajmajhi [form_type_id_div] => Array ( [0] => McpVnUGL5N9WobEWZw5s/J595rY2GlILDCVexdmyKxA= [1] => ewlfZ2bScrNEkX+AD65pxooQmdHVMGf+OrhO2YM60BU= [2] => ips6ishuRiBWZN0HacSnCm6cvgn+054kVd4AYLgJD8w= [3] => VV1GWkD+4p/CsFXgzFQId+n9HmJzLLx9oNgDZ6HyOY8= [4] => gN5VwkXtiSWkx1UxyyOzdGNzS97Vf8ofMueH0nVhbeI= [5] => McpVnUGL5N9WobEWZw5s/J595rY2GlILDCVexdmyKxA= [6] => ewlfZ2bScrNEkX+AD65pxooQmdHVMGf+OrhO2YM60BU= [7] => ips6ishuRiBWZN0HacSnCm6cvgn+054kVd4AYLgJD8w= [8] => VV1GWkD+4p/CsFXgzFQId+n9HmJzLLx9oNgDZ6HyOY8= [9] => gN5VwkXtiSWkx1UxyyOzdGNzS97Vf8ofMueH0nVhbeI= ) [datepicker] => Array ( [0] => 11/24/2017 [1] => 11/22/2017 [2] => 11/30/2017 [3] => 11/25/2017 [4] => 11/28/2017 ) [Activity] => Array ( [0] => Training on PHM [1] => Training on LST [2] => Training on LST [3] => Training on PHM [4] => Training on PHM ) [Support] => Array ( [0] => Training and Hermative bags [1] => Training [2] => Training [3] => Training [4] => Training ) [Production] => Array ( [0] => 34 [1] => 17 [2] => 45 [3] => 15 [4] => 23 ) [Consumption] => Array ( [0] => 3488 [1] => 17 [2] => 4588 [3] => 15 [4] => 2388 ) [Sale] => 0 [Remarks] => Array ( [0] => Ok [1] => ok [2] => ok [3] => ok [4] => ok ) [Signature] => Array ( [0] => ush8a [1] => us88 [2] => usha roy88 [3] => usha roy [4] => usha roy ) [rows_id] => 5 [save] => save )
session_start();
ob_start();
if($_SESSION['meo_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
  $msg = new \Preetish\FlashMessages\FlashMessages();


	$form_type_new=web_decryptIt(str_replace(" ", "+", $_POST['form_type_new']));
	$form_type_id=web_decryptIt(str_replace(" ", "+", $_POST['form_type_id'])); //to acess switcjh value
	// $slno=web_decryptIt(str_replace(" ", "+", $_POST['form_type_id_div'])); // serilano tobe impact
	$months=web_decryptIt(str_replace(" ", "+", $_POST['form_type_user']));// month
	$comments_mt=$_POST['comments_mt'];
	$slno=$_POST['form_type_id_div'];//
	$date=date('Y-m-d');
	$time=date('H:i:s');
	$mt_user=$_SESSION['meo_user'];
	if($form_type_new=='CBO_comment'){

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
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form1']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_CBO_date_form1']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form1']);

				$datepicker=$_POST['datepicker'];
				$Activity=$_POST['Activity'];
				$Support=$_POST['Support'];
				$Production=$_POST['Production'];
				$Consumption=$_POST['Consumption'];
				$Remarks=$_POST['Remarks'];
				$Signature=$_POST['Signature'];
				$Sale=$_POST['Sale'];
				$filteredarray = array_values( array_filter($Activity));
				if(!empty($filteredarray)){
					if(count($Activity)==count($slno)){
						for ($j=0; $j < count($slno); $j++) { 
							$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$j]));
							$get_info="INSERT INTO `care_master_Input_output_tracking_TARINA_meo`(`care_crp_slno_entry`, `care_TARINA_year`, `care_TARINA_month`, `care_TARINA_district_name`, `care_TARINA_block_name`, `care_TARINA_gp_name`, `care_TARINA_vlg_name`, `care_TARINA_hhi`, `care_TARINA_hhi_slno`, `care_TARINA_w_farmer_name`, `care_TARINA_spouse_name`, `care_TARINA_event_date`, `care_TARINA_activity_name`, `care_TARINA_support_provide`, `care_TARINA_production`, `care_TARINA_consumption`, `care_TARINA_sale`, `care_TARINA_remarks`, `care_TARINA_participant_sign`, `care_TARINA_shg_name`, `care_TARINA_social_caste`, `care_TARINA_status`, `care_TARINA_entry_date`, `care_TARINA_entry_time`, `care_TARINA_long_id`, `care_TARINA_lat_id`, `care_TARINA_employee_id`, `care_IP_OP_mt_comment_empty`, `care_IP_OP_mt_comment_date`, `care_IP_OP_mt_comment_time`, `care_IP_OP_mt_id`, `care_IP_OP_mt_status`, `care_IP_OP_CBO_comment_empty`, `care_IP_OP_CBO_comment_date`, `care_IP_OP_CBO_comment_time`, `care_IP_OP_CBO_comment_status`, `care_IP_OP_CBO_id`, `care_IP_OP_MEO_status`, `care_IP_OP_MEO_date`, `care_IP_OP_MEO_time`, `care_IP_OP_MEO_id`) SELECT * FROM `care_master_Input_output_tracking_TARINA` WHERE `care_master_Input_output_tracking_TARINA`.`care_TARINA_slno`= '$slno_single'";
							$sql_get_detail=mysqli_query($conn,$get_info);

						}
						for ($i=0; $i <count($slno) ; $i++) {
							$slno_singles=web_decryptIt(str_replace(" ", "+", $slno[$i]));
							$datepicker_single=date('Y-m-d',strtotime(trim($datepicker[$i])));
							$Activity_single=$Activity[$i];
							$Support_single=$Support[$i];
							$Production_single=$Production[$i];
							$Consumption_single=$Consumption[$i];
							$Remarks_single=$Remarks[$i];
							$Signature_single=$Signature[$i];
							$Sale_s=$Sale[$i];
							$update="UPDATE `care_master_Input_output_tracking_TARINA_meo` SET `care_TARINA_event_date_edit`='$datepicker_single',`care_TARINA_event_date_status`='2',`care_TARINA_activity_name_edit`='$Activity_single',`care_TARINA_activity_name_status`='2',`care_TARINA_support_provider_edit`='$Support_single',`care_TARINA_support_provider_status`='2',`care_TARINA_production_edit`='$Production_single',`care_TARINA_production_status`='2',`care_TARINA_consumption_edit`='$Consumption_single',`care_TARINA_consumption_status`='2',`care_TARINA_sale_edit`='$Sale_s',`care_TARINA_sale_status`='2',`care_TARINA_remarks_edit`='$Remarks_single',`care_TARINA_remarks_status`='2',`care_TARINA_participant_sign_edit`='$Signature_single',`care_TARINA_participant_sign_status`='2',`care_TARINA_entry_date_edit`='$date',`care_TARINA_entry_time_edit`='$time' WHERE `care_crp_slno_entry`='$slno_singles'";
							$sql_get_detail=mysqli_query($conn,$update);


						}
					}
				}else{
					$msg->error('No Information is found');
					header('Location:index.php');
					exit;
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							$array_form2[]=2;
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form2[]=0;
					}

				}
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form1`='$care_MEO_status_form1_new',`care_CBO_date_form1`='$date_mt',`care_CBO_status_form1`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Input & Output of HHI '.$hhi);
				header('Location:index.php');
				exit;

				
				break;
			case 'form2':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form2']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form2']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_CBO_date_form2']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form2']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_Post_Harvest_Loss` WHERE `care_PHL_slno`='$slno_single' and `care_PHL_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						 $uspdate="UPDATE `care_master_Post_Harvest_Loss` SET `care_PHL_CBO_comment_empty`='$singel_comments_mt',`care_PHL_CBO_comment_time`='$time',`care_PHL_CBO_comment_date`='$date',`care_PHL_mt_id`='$mt_user',`care_PHL_CBO_comment_status`='1' where`care_PHL_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							$array_form2[]=2;
						}else{
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							$array_form2[]=2;
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form2[]=0;
					}

				}
					$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);

			
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form2`='$care_MEO_status_form1_new',`care_CBO_date_form2`='$date_mt',`care_CBO_status_form2`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				 mysqli_query($conn,$update);
				$msg->success('SuccessFully comments Submited to Post Harvest Loss of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form3':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form3']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form3']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form3']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form3']);


				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_MTF_livestock_TARINA` WHERE `care_LS_slno`='$slno_single' and`care_LS_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_MTF_livestock_TARINA` SET `care_LS_CBO_comment_empty`='$singel_comments_mt',`care_LS_CBO_comment_time`='$time',`care_LS_CBO_comment_date`='$date',`care_LS_CBO_id`='$mt_user',`care_LS_CBO_comment_status`='1' where `care_LS_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==0){
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==1){
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form1[]=0;
					}

				}

				$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form3`='$care_MEO_status_form1_new',`care_CBO_date_form3`='$date_mt',`care_CBO_status_form3`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Goatery of HHI '.$hhi);
				header('Location:index.php');
				exit;

				
				break;

			case 'form4':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form4']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form4']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form4']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form4']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_MTF_livestock_TARINA` WHERE `care_LS_slno`='$slno_single' and`care_LS_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_MTF_livestock_TARINA` SET `care_LS_CBO_comment_empty`='$singel_comments_mt',`care_LS_CBO_comment_time`='$time',`care_LS_CBO_comment_date`='$date',`care_LS_CBO_id`='$mt_user',`care_LS_CBO_comment_status`='1' where `care_LS_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==0){
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==1){
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form1[]=0;
					}

				}

				$date_mt=serialize($array_date);
					$care_CBO_status_form1_new=serialize($array_form1);
					$care_MEO_status_form1_new=serialize($array_form2);
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form4`='$care_MEO_status_form1_new',`care_CBO_date_form4`='$date_mt',`care_CBO_status_form4`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Dairy of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;

			case 'form5':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form5']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form5']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form5']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form5']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_MTF_livestock_TARINA` WHERE `care_LS_slno`='$slno_single' and`care_LS_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_MTF_livestock_TARINA` SET `care_LS_CBO_comment_empty`='$singel_comments_mt',`care_LS_CBO_comment_time`='$time',`care_LS_CBO_comment_date`='$date',`care_LS_CBO_id`='$mt_user',`care_LS_CBO_comment_status`='1' where `care_LS_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				
				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==0){
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==1){
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form1[]=0;
					}

				}

				$date_mt=serialize($array_date);
				$care_CBO_status_form1_new=serialize($array_form1);
				$care_MEO_status_form1_new=serialize($array_form2);

				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form5`='$care_MEO_status_form1_new',`care_CBO_date_form5`='$date_mt',`care_CBO_status_form5`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Poultry of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form6':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form6']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form6']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form6']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form6']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_MTF_livestock_TARINA` WHERE `care_MTF_slno`='$slno_single' and`care_MTF_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_MTF_livestock_TARINA` SET `care_MTF_CBO_comment_empty`='$singel_comments_mt',`care_MTF_CBO_comment_time`='$time',`care_MTF_CBO_comment_date`='$date',`care_MTF_CBO_id`='$mt_user',`care_MTF_CBO_comment_status`='1' where `care_MTF_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				
				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==0){
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==1){
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form1[]=0;
					}

				}

				$date_mt=serialize($array_date);
				$care_CBO_status_form1_new=serialize($array_form1);
				$care_MEO_status_form1_new=serialize($array_form2);
				
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form6`='$care_MEO_status_form1_new',`care_CBO_date_form6`='$date_mt',`care_CBO_status_form6`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Labour Saving Technologies of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form7':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form7']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form7']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form7']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form7']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_slno`='$slno_single' and`care_crop_div_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_crop_diversification_crp` SET `care_crop_div_CBO_comment_empty`='$singel_comments_mt',`care_crop_div_CBO_comment_time`='$time',`care_crop_div_CBO_comment_date`='$date',`care_crop_div_CBO_id`='$mt_user',`care_crop_div_CBO_comment_status`='1' where `care_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==0){
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==1){
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form1[]=0;
					}

				}

				$date_mt=serialize($array_date);
				$care_CBO_status_form1_new=serialize($array_form1);
				$care_MEO_status_form1_new=serialize($array_form2);
				
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form7`='$care_MEO_status_form1_new',`care_CBO_date_form7`='$date_mt',`care_CBO_status_form7`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to farmland of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form8':
				$hhi=$_POST['care_hhi'];
				$Year=$_POST['Year'];
				$get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				$sql_get_detail=mysqli_query($conn,$get_details);

				$fetch_check=mysqli_fetch_assoc($sql_get_detail);
				 $slno_md=$fetch_check['care_hhi_sl_no'];
				$get_userilaze_form1=unserialize($fetch_check['care_form8']); // serial mo
				if(count($get_userilaze_form1)==count($slno)){

				}
				// $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				$care_CBO_status_form1=unserialize($fetch_check['care_CBO_status_form8']);
				$get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form8']);//
				$care_MEO_status_form1=unserialize($fetch_check['care_MEO_status_form8']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_crop_diversification_crp` WHERE `care_slno`='$slno_single' and`care_crop_div_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_crop_diversification_crp` SET `care_crop_div_CBO_comment_empty`='$singel_comments_mt',`care_crop_div_CBO_comment_time`='$time',`care_crop_div_CBO_comment_date`='$date',`care_crop_div_CBO_id`='$mt_user',`care_crop_div_CBO_comment_status`='1' where `care_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
					$get_userilaze_form1_q=$get_userilaze_form1[$i];
					$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
					if(in_array($get_userilaze_form1_q,$din)){
						if($care_CBO_status_form1[$i]==2){
							$array_date[]=$date;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==0){
							$array_date[]=$get_userilaze_form1_date_single;
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}else if($care_CBO_status_form1[$i]==1){
							$array_form1[]=1;
							if($care_MEO_status_form1[$i]!=0){
								$array_form2[]=2;
							}else{
								$array_form2[]=$care_MEO_status_form1[$i];
							}
						}
					}else{
						$array_date[]='0000-00-00';
						$array_form1[]=0;
						$array_form1[]=0;
					}

				}

				$date_mt=serialize($array_date);
				$care_CBO_status_form1_new=serialize($array_form1);
				$care_MEO_status_form1_new=serialize($array_form2);
				
				 $update="UPDATE `care_master_hhi_month_year` SET `care_MEO_status_form8`='$care_MEO_status_form1_new',`care_CBO_date_form8`='$date_mt',`care_CBO_status_form8`='$care_CBO_status_form1_new'  WHERE`care_hhi_sl_no`='$slno_md'";
				mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Kitchen Garden of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form9':
				// $hhi=$_POST['care_hhi'];
				// $Year=$_POST['Year'];
				// $get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				// $sql_get_detail=mysqli_query($conn,$get_details);

				// $fetch_check=mysqli_fetch_assoc($sql_get_detail);
				//  $slno_md=$fetch_check['care_hhi_sl_no'];
				// $get_userilaze_form1=unserialize($fetch_check['care_form8']); // serial mo
				// if(count($get_userilaze_form1)==count($slno)){

				// }
				// // $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				// $get_userilaze_form1_status=unserialize($fetch_check['care_mt_status_form8']);
				// $get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form8']);//
				// $get_userilaze_cbo_status=unserialize($fetch_check['care_CBO_status_form8']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_MRF_exposure_visit_TARINA` WHERE `care_EV_slno`='$slno_single' and`care_EV_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_MRF_exposure_visit_TARINA` SET `care_EV_CBO_comment_empty`='$singel_comments_mt',`care_EV_CBO_comment_time`='$time',`care_EV_CBO_comment_date`='$date',`care_EV_CBO_id`='$mt_user',`care_EV_CBO_comment_status`='1' where `care_EV_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				// for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
				// 	$get_userilaze_form1_q=$get_userilaze_form1[$i];
				// 	$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
				// 	if(in_array($get_userilaze_form1_q,$din)){
				// 		if($get_userilaze_form1_status[$i]==0){
				// 			$array_date[]=$date;
				// 			$array_form1[]=1;
				// 		}else{
				// 			$array_date[]=$get_userilaze_form1_date_single;
				// 			$array_form1[]=1;
				// 		}
				// 	}else{
				// 		$array_date[]='0000-00-00';
				// 		$array_form1[]=0;
				// 	}

				// }
				// $care_mt_date_form1=serialize($array_date);
				// $care_mt_status_form1=serialize($array_form1);
				//  $update="UPDATE `care_master_hhi_month_year` SET `care_mt_date_form8`='$care_mt_date_form1' , `care_mt_status_form8`='$care_mt_status_form1'  WHERE`care_hhi_sl_no`='$slno_md'";
				// mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to Training of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			case 'form10': //shg
				// $hhi=$_POST['care_hhi'];
				// $Year=$_POST['Year'];
				// $get_details="SELECT * FROM `care_master_hhi_month_year` WHERE `care_hhi_id_info`='$hhi' and `care_month`='$months' and `care_year`='$Year'";
				// $sql_get_detail=mysqli_query($conn,$get_details);

				// $fetch_check=mysqli_fetch_assoc($sql_get_detail);
				//  $slno_md=$fetch_check['care_hhi_sl_no'];
				// $get_userilaze_form1=unserialize($fetch_check['care_form8']); // serial mo
				// if(count($get_userilaze_form1)==count($slno)){

				// }
				// // $get_userilaze_form1_date=unserialize($fetch_check['care_form1_date']);//
				// $get_userilaze_form1_status=unserialize($fetch_check['care_mt_status_form8']);
				// $get_userilaze_form1_date=unserialize($fetch_check['care_mt_date_form8']);//
				// $get_userilaze_cbo_status=unserialize($fetch_check['care_CBO_status_form8']);

				for ($i=0; $i <count($slno) ; $i++) {
					$singel_comments_mt=$comments_mt[$i];
					$din[]=$slno_single=web_decryptIt(str_replace(" ", "+", $slno[$i]));
					$get_info="SELECT * FROM `care_master_MRF_SHG_tracking_under_TARINA` WHERE `care_SHG_slno`='$slno_single' and`care_SHG_CBO_comment_status`='1'";
					$sql_get_detail=mysqli_query($conn,$get_info);
					$num_row=mysqli_num_rows($sql_get_detail);
					if($num_row==0){
						$uspdate="UPDATE `care_master_MRF_SHG_tracking_under_TARINA` SET `care_SHG_CBO_comment_empty`='$singel_comments_mt',`care_SHG_CBO_comment_time`='$time',`care_SHG_CBO_comment_date`='$date',`care_SHG_CBO_id`='$mt_user',`care_SHG_CBO_comment_status`='1' where `care_SHG_slno`='$slno_single'";
						mysqli_query($conn,$uspdate);
					}
				}

				// for ($i=0; $i <count($get_userilaze_form1) ; $i++) {
				// 	$get_userilaze_form1_q=$get_userilaze_form1[$i];
				// 	$get_userilaze_form1_date_single=$get_userilaze_form1_date[$i];
				// 	if(in_array($get_userilaze_form1_q,$din)){
				// 		if($get_userilaze_form1_status[$i]==0){
				// 			$array_date[]=$date;
				// 			$array_form1[]=1;
				// 		}else{
				// 			$array_date[]=$get_userilaze_form1_date_single;
				// 			$array_form1[]=1;
				// 		}
				// 	}else{
				// 		$array_date[]='0000-00-00';
				// 		$array_form1[]=0;
				// 	}

				// }
				// $care_mt_date_form1=serialize($array_date);
				// $care_mt_status_form1=serialize($array_form1);
				//  $update="UPDATE `care_master_hhi_month_year` SET `care_mt_date_form8`='$care_mt_date_form1' , `care_mt_status_form8`='$care_mt_status_form1'  WHERE`care_hhi_sl_no`='$slno_md'";
				// mysqli_query($conn,$update);

				$msg->success('SuccessFully comments Submited to SHG of HHI '.$hhi);
				header('Location:index.php');
				exit;

				break;
			default:
				# code...
				break;
		}

	}else{
	header('Location:logout.php');
	    exit;
	}


}else{
	header('Location:logout.php');
    exit; 
}