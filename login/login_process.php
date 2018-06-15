<?php
session_start();
ini_set('display_errors',1);
require 'FlashMessages.php';
$msg = new \Preetish\FlashMessages\FlashMessages();
include 'config.php';
// print_r($_POST);
// exit;

//     [username] => rr
//     [user_password] => rr
//     [lat2] => 20.2988587
//     [lat] => 20.2988587
//     [long2] => 85.831076
//     [long] => 85.831076
$username=mysqli_real_escape_string($conn,$_POST['username']);
$user_password=($_POST['user_password']);
$lat2=$_POST['lat2'];
$lat=$_POST['lat'];
$long2=$_POST['long2'];
$long=$_POST['long'];
if(($lat2==$lat) && ($long2==$long)){
	$query_login="SELECT * FROM `care_master_admin_info` where `cama_email`='$username' and `cama_status`='1'";
    $sql_login=mysqli_query($conn,$query_login);   
     $login_num_row=mysqli_num_rows($sql_login);

    $query_login1="SELECT * FROM `care_master_system_user` where `employee_id`='$username' and `status`='1' and `assign_status`='1'";
    $sql_login1=mysqli_query($conn,$query_login1);   
    $login_num_row1=mysqli_num_rows($sql_login1);

    if(($login_num_row==1) && ($login_num_row1==0)){
        $res=mysqli_fetch_assoc($sql_login);
            $res_pass=$res['cama_password']; 
              
            $oldpassword_hash = md5($user_password); 
            if(($res['cama_email']==$username) && ($res_pass==$oldpassword_hash)){
            	 $user_level=$res['cama_role'];
                
                switch ($user_level) {
                    case '1':
                        $_SESSION['admin']=$res['cama_email'];
                        $_SESSION['admin_type']="Master user";
                        $_SESSION['user_name']=$res['cama_username'];
                        $_SESSION['slno']=$res['cama_slno'];
                        $msg->success('Welcome Admin Officer');
                        header('Location:../admin/index.php');
                        exit;
                        break;
                    case '2':
                        $_SESSION['mt_user']=$res['cama_email'];
                        $_SESSION['mt_user_type']="Master Training";
                        $_SESSION['user_name']=$res['cama_username'];
                        $_SESSION['slno']=$res['cama_slno'];
                        $_SESSION['form_type']=$res['form_type'];
                        $_SESSION['location_user']=$res['location_user'];
                        $msg->success('Welcome MT '.$res['cama_username']);
                        header('Location:../mt_user/index.php');
                        exit;
                        break;
                    case '3':
                        $_SESSION['cbo_user']=$res['cama_email'];
                        $_SESSION['cbo_user_type']="Master Training";
                        $_SESSION['user_name']=$res['cama_username'];
                        $_SESSION['slno']=$res['cama_slno'];
                        $_SESSION['form_type']=$res['form_type'];
                        $_SESSION['location_user']=$res['location_user'];
                        $msg->success('Welcome CBO '.$res['cama_username']);
                        header('Location:../CBO_user/index.php');
                        exit;
                        break;
                    case '4':
                        $_SESSION['meo_user']=$res['cama_email'];
                        $_SESSION['meo_user_type']="Master Training";
                        $_SESSION['user_name']=$res['cama_username'];
                        $_SESSION['slno']=$res['cama_slno'];
                        $_SESSION['form_type']=$res['form_type'];
                        $_SESSION['location_user']=$res['location_user'];
                        $msg->success('Welcome MEO '.$res['cama_username']);
                        header('Location:../MEO_user/index.php');
                        exit;
                        break;
                    case '5':
                        $_SESSION['report_user']=$res['cama_email'];
                        $_SESSION['report_user_type']="Master Training";
                        $_SESSION['user_name']=$res['cama_username'];
                        $_SESSION['slno']=$res['cama_slno'];
                        $_SESSION['form_type']=$res['form_type'];
                        $_SESSION['location_user']=$res['location_user'];
                        $msg->success('Welcome Report '.$res['cama_username']);
                        header('Location:../report_user/index.php');
                        exit;
                        break;
                    
                    default:
                        # code...
                        break;
                }
            	
                 //mt_user 
        	}else{
        		$msg->error('User Information Is not found');
    			header('Location:index.php');
    			exit; 
        	}
        }else if(($login_num_row==0) && ($login_num_row1==1)){
            $res=mysqli_fetch_assoc($sql_login1);
            $res_pass1=$res['password_hash'];      
            $oldpassword_hash = md5($user_password);      
        

        if(($res['employee_id']==$username) && ($res_pass1==$oldpassword_hash)){
            $user_level=$res['level'];
            switch ($user_level) {
                case '1':
                    $_SESSION['User_level']=$res['user_level'];
                    $_SESSION['crp_user']=$res['user_name'];
                    $_SESSION['employee_id']=$res['employee_id'];
                    $_SESSION['user_name']=$res['user_name'];
                        $msg->success('Welcome CRP  ' .$res['user_name']);
                        header('Location:../crp_user/index.php');
                    exit;
                    break;
                
                case '2':
                    $_SESSION['employee_id']=$username;
                    $_SESSION['admin_type']="Field Store User";
                    $_SESSION['user_name']=$res['user_name'];
                    // $msg->success('Welcome Field Store DashBoard');
                    // header('Location:admin/admin_zonal/zonal_dashboard.php');
                    exit;

                    break;
                
                default:
                    # code...
                    break;
            }

        }else{
           
            $msg->error('Invalid User');
            header('Location:index.php');
            exit;   
        }

        }else{
        	
        	$msg->error('Unable find User ');
    		header('Location:index.php');
    		exit; 
        }


   }else{
	
	$msg->error('Please Click on Allow Location To know Your Loaction');
    header('Location:index.php');
    exit; 
}

