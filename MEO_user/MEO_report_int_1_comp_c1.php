<?php
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Welcome To Dashboard Of CRP";
  
$form_types=$_SESSION['form_type'];
$location_user=$_SESSION['location_user'];
?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        CRP LIST
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">Get List Of CRP</a></li>
        <!-- <li class="active">Blank page</li> -->
      </ol>
    </section>

    <section class="content">
      <div class="text-center">
        <?php $msg->display(); ?>
      </div>

       <div class="row">
        <div class="col-xs-12">
          <div class="panel panel-default">
            <div class="panel-body text-center">
              <form class="form-inline" action="" method="POST">
                <div class="form-group">
                  <label for="village">District :</label>
                 <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('get_hhi_infomation')?>">
                  <select class="form-control" id="employee_id" onchange="get_village()" name="employee_id">
                    <option value="">--Select CRP--</option>
                   <?php
                      if($form_types=='0'){
                        $get_employee="SELECT * FROM `care_master_system_user`  WHERE `level`='1' and `assign_status`='1' and `status`='1' ";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
                        }
                      }else{
                        $get_employee="SELECT DISTINCT `care_master_system_user`.`employee_id`,`care_master_system_user`.`user_name` FROM `care_master_system_user` INNER JOIN `care_master_assigned_user_info` ON `care_master_system_user`.`employee_id`=`care_master_assigned_user_info`.`care_assU_employee_id` AND `care_master_assigned_user_info`.`care_assU_district_id`='$location_user' and `care_master_assigned_user_info`.`status`='1' WHERE `care_master_system_user`.`status`='1' and `care_master_system_user`.`assign_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
                        }
                        }
                        ?>

                  </select>
                   <label for="village">Block :</label>
                 
                  <select class="form-control" id="employee_id" onchange="get_village()" name="employee_id">
                    <option value="">--Select CRP--</option>
                   <?php
                      if($form_types=='0'){
                        $get_employee="SELECT * FROM `care_master_system_user`  WHERE `level`='1' and `assign_status`='1' and `status`='1' ";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
                        }
                      }else{
                        $get_employee="SELECT DISTINCT `care_master_system_user`.`employee_id`,`care_master_system_user`.`user_name` FROM `care_master_system_user` INNER JOIN `care_master_assigned_user_info` ON `care_master_system_user`.`employee_id`=`care_master_assigned_user_info`.`care_assU_employee_id` AND `care_master_assigned_user_info`.`care_assU_district_id`='$location_user' and `care_master_assigned_user_info`.`status`='1' WHERE `care_master_system_user`.`status`='1' and `care_master_system_user`.`assign_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
                        }
                        }
                        ?>

                  </select>
                   <label for="village">GP Name :</label>
                 
                  <select class="form-control" id="employee_id" onchange="get_village()" name="employee_id">
                    <option value="">--Select CRP--</option>
                   <?php
                      if($form_types=='0'){
                        $get_employee="SELECT * FROM `care_master_system_user`  WHERE `level`='1' and `assign_status`='1' and `status`='1' ";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
                        }
                      }else{
                        $get_employee="SELECT DISTINCT `care_master_system_user`.`employee_id`,`care_master_system_user`.`user_name` FROM `care_master_system_user` INNER JOIN `care_master_assigned_user_info` ON `care_master_system_user`.`employee_id`=`care_master_assigned_user_info`.`care_assU_employee_id` AND `care_master_assigned_user_info`.`care_assU_district_id`='$location_user' and `care_master_assigned_user_info`.`status`='1' WHERE `care_master_system_user`.`status`='1' and `care_master_system_user`.`assign_status`='1'";
                        $sql_exe=mysqli_query($conn,$get_employee);
                        while ($result_employee=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$result_employee['employee_id']?>"<?php if($employee_id==$result_employee['employee_id']){ echo "selected";} ?> ><?=$result_employee['user_name']?></option>
                          <?php
                        }
                        }
                        ?>

                  </select>
                  
                 <label for="village">Village :</label>
                  <?php if($village==""){?>
                  <select class="form-control" id="village" name="village" required="">
                   <option value="">--Select Village--</option>
                  </select>
                  <?php }else{?>
                    <select class="form-control" id="village" name="village" required="">
                    <option value="">--Select Village--</option>
                   <?php $get_village="SELECT * FROM `care_master_assigned_user_info` WHERE `care_assU_employee_id`='$employee_id' and `status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                          ?>
                          <option value="<?=$res_village['care_assU_village_id']?>"<?php if($village==$res_village['care_assU_village_id']){ echo "selected";} ?> ><?=$res_village['care_assU_village_id']?>[<?=$res_village['care_assU_gp_id']?>]</option>
                          <?php
                        }?>
                  </select>
                 <?php }
                    ?>

                   <label for="village"> Month:</label>
                    <select class="form-control" id="month" name="month" required="">
                    <option value="">--Select Month--</option>
                    <?php
                          $monthArray = range(1, 12);
                          foreach ($monthArray as $month) {
                          // padding the month with extra zero
                            $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
                          // you can use whatever year you want
                          // you can use 'M' or 'F' as per your month formatting preference
                            $fdate = date("F", strtotime("2017-$monthPadding-01"));
                            ?>
                            <option value="<?=$monthPadding?>" <?php if($monthPadding==$months){ echo 'selected';}?>><?=$fdate?></option><?php 
                          }
                        ?>
                  </select>
                 <label for="village"> Year:</label>
                  <select class="form-control" id="datepicker" name="Year" required="">
                    <option value="">--Select Year--</option>
                    <?php 
                    $yearSpan = 4;
                    $currentYear = date("Y", strtotime('2017-01-01'));
                    for($i = 0; $i<=$yearSpan; $i++) {
                       $x=$currentYear+$i;
                       ?>
                       <option value="<?=$x?>" <?php if($x==$Year){echo "selected";}?>><?=$x?></option>
                       <?php
                     }

                     ?>
                </select>
                </div>
                <button type="submit" class="btn btn-default">Find</button>
              </form>
            </div>
          </div>

        </div>
      </div>
      <br>
      <br>
      <?php
        if(isset($_POST['form_type'])){
        if($form_type=='get_hhi_infomation'){

        if(!empty($village)){
          $get_detail="SELECT * FROM `care_master_hhi_month_year` WHERE `care_crp_id`='$employee_id' and`care_village_name`='$village' and `care_month`='$months' and `care_year`='$Year'";
          $sql_get_detail=mysqli_query($conn,$get_detail);

          // while ($sql_get_detail_fetch=mysqli_fetch_assoc($sql_get_detail)) {
          //   # code...
          // }
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="panel panel-default">
                <div class="panel-body text-center">
                  <div class="table-responsive">
                   <table id="example" class="display" cellspacing="0" width="100%" style="">
                    <thead>
                      <tr  >
                        <th><h4><b>slno</b></h4></th>
                        <th><h4><b>HHI</b></h4></th>
                        <th><h4><b>women farmer</b></h4></th>
                        <th><h4><b>Spouse Name</b></h4></th>
                        <th><h4><b>Input and output tracking</b></h4></th>
                        <th><h4><b>Post Harvest Loss</b></h4></th>
                        <th><h4><b>Goatery</b></h4></th>
                        <th><h4><b>Dairy</b></h4></th>
                        <th><h4><b>Poultry</b></h4></th>
                        <th><h4><b>Labour Saving Technologies</b></h4></th>
                        <th><h4><b>farmland</b></h4></th>
                        <th><h4><b>Kitchen Garden</b></h4></th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th><h4><b>slno</b></h4></th>
                        <th><h4><b>HHI</b></h4></th>
                        <th><h4><b>women farmer</b></h4></th>
                        <th><h4><b>Spouse Name</b></h4></th>
                        <th><h4><b>Input and output tracking</b></h4></th>
                        <th><h4><b>Post Harvest Loss</b></h4></th>
                        <th><h4><b>Goatery</b></h4></th>
                        <th><h4><b>Dairy</b></h4></th>
                        <th><h4><b>Poultry</b></h4></th>
                        <th><h4><b>Labour Saving Technologies</b></h4></th>
                        <th><h4><b>farmland</b></h4></th>
                        <th><h4><b>Kitchen Garden</b></h4></th>
                      </tr>
                    </tfoot>
                     <tbody>
                      <?php
                      $xi=0;
                      while ($sql_get_detail_fetch=mysqli_fetch_assoc($sql_get_detail)) {
                        $xi++;
                        // print_r($sql_get_detail_fetch);
                        ?>
                      <tr>

                        <td><?=$xi?></td>
                        <td><?=$care_hhi_id_info=$sql_get_detail_fetch['care_hhi_id_info'];
                           $query_detail="SELECT * FROM `care_master_hhi_infomation` WHERE `care_hhi_id`='$care_hhi_id_info'";
                          $sql_exe_details=mysqli_query($conn,$query_detail);
                          $details_fetch=mysqli_fetch_assoc($sql_exe_details);
                        ?></td>
                        <td><?=$details_fetch['care_women_farmer']?></td>
                        <td><?=$details_fetch['care_spouse_name']?></td>
                        <td><?php
                              $Input_out1=0;
                              $Input_out1_1=0;
                              $form1=unserialize($sql_get_detail_fetch['care_form1']);
                              $care_form1_date=unserialize($sql_get_detail_fetch['care_form1_date']);
                              $care_CBO_status_form1=unserialize($sql_get_detail_fetch['care_CBO_status_form1']);
                               $care_MEO_status_form1=unserialize($sql_get_detail_fetch['care_MEO_status_form1']);
                                 $x1=count($form1);
                                $x_detail1=array_count_values($care_MEO_status_form1);
                                  if(!empty($form1)){
                                    for ($i=0; $i <count($form1) ; $i++) {
                                      if($care_MEO_status_form1[$i]==2 ){
                                       $Input_out1++;$Input_out1_1=0;
                                      }else if($care_MEO_status_form1[$i]==0){
                                        $Input_out1--;
                                        $Input_out1=0;
                                      }else if($care_MEO_status_form1[$i]==1){
                                        if($x_detail1[1]==$x1){
                                        $Input_out1_1=1;
                                         $Input_out1=$x1;
                                      }
                                     }
                                    }
                                    // print_r($x_detail1);
                                    //  if(($Input_out1===$x1) && ($Input_out1_1===1)){}
                                    // echo $Input_out1."--".$Input_out1_1;
                                  // }
                                    if($Input_out1 <= 0){
                                      echo "CBO Comment Pending";
                                    }else if($Input_out1==$x1 && $Input_out1_1==1){?>
                                      <a class="btn btn-danger btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('12')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" ><del><b>click to View <?=$x1?></b></del></a>
                                      <?php
                                   }else if(($Input_out1 >0) && ($Input_out1_1==0)){
                                      ?>
                                      <a class="btn btn-success btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('12')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=1" ><b>click to edit <?=$x1?></b></a>
                                      <?php
                                    }
                                  }else{
                                    echo "N/A";
                                  }
                        ?></td>
                        <td><?php
                             
                              $form2=unserialize($sql_get_detail_fetch['care_form2']);
                              $care_form2_date=unserialize($sql_get_detail_fetch['care_form2_date']);
                              $care_CBO_status_form2=unserialize($sql_get_detail_fetch['care_CBO_status_form2']);
                              $care_MEO_status_form2=unserialize($sql_get_detail_fetch['care_MEO_status_form2']);
                              $Input_out2=0;
                              $Input_out1_2=0;
                              $x2=count($form2);
                                $x_detail2=array_count_values($care_MEO_status_form2);
                                  if(!empty($form2)){
                                    for ($i=0; $i <count($form2) ; $i++) {
                                      if($care_MEO_status_form2[$i]==2){
                                       $Input_out2++;$Input_out1_2=0;
                                      }else if($care_MEO_status_form2[$i]==0){
                                        $Input_out2--;$Input_out1_2=0;
                                      }else if($care_MEO_status_form2[$i]==1){
                                        if($x_detail2[1]==$x2){
                                        $Input_out1_2=1;
                                         $Input_out2=$x2;
                                      }
                                     }
                                    }

                                    if($Input_out2 < 0){
                                      echo "CBO Comment Pending";

                                    }else if($Input_out2==$x2 && $Input_out1_2==1){?>
                                     
                                       <a class="btn btn-danger btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('7')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" ><del><b>click to View <?=$x2?></b></del></a>
                                      <?php
                                    }else if(($Input_out2 >0)  && ($Input_out1_2==0)){
                                      ?>
                                        <a class="btn btn-success btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('7')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=1" ><b>click to edit <?=$x2?></b></a>
                                      <?php
                                    }

                                  }else{
                                    echo "N/A";
                                  }
                        ?></td>
                        <td><?php
                              // $Input_out2=1;
                              $form3=unserialize($sql_get_detail_fetch['care_form3']);
                              $care_form3_date=unserialize($sql_get_detail_fetch['care_form2_date']);
                              $care_CBO_status_form3=unserialize($sql_get_detail_fetch['care_CBO_status_form3']);
                              $care_MEO_status_form3=unserialize($sql_get_detail_fetch['care_MEO_status_form3']);
                              $Input_out3=0;
                              $Input_out1_3=0;
                              $x3=count($form3);
                                $x_detail3=array_count_values($care_MEO_status_form3);
                                  if(!empty($form3)){
                                    for ($i=0; $i <count($form3) ; $i++) {
                                      if($care_MEO_status_form3[$i]==2){
                                       $Input_out3++;
                                      }else if($care_MEO_status_form3[$i]==0){
                                        $Input_out3--;
                                      }else if($care_MEO_status_form3[$i]==1){
                                        if($x_detail3[1]==$x3){
                                        $Input_out1_3=1;
                                         $Input_out3=$x3;
                                      }
                                     }
                                    }
                                   
                                    if($Input_out3 <= 0){

                                      echo "CBO Comment Pending";
                                    
                                    }else if($Input_out3==$x3 && $Input_out1_3==1){?>
                                   
                                        <a class="btn btn-danger btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('9')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" ><del>click to View <?=$x3?></del></a>
                                     <?php
                                    }else if(($Input_out3 >0)  && ($Input_out1_3==0)){
                                      ?>
                                        <a class="btn btn-success btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('9')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=1" >click to edit <?=$x3?></a>
                                      <?php
                                    }
                                  }else{
                                    echo "N/A";
                                  }
                        ?></td>
                        <td><?php
                               // $Input_out3=1;
                               $form4=unserialize($sql_get_detail_fetch['care_form4']);
                               $care_form4_date=unserialize($sql_get_detail_fetch['care_form4_date']);
                               $care_CBO_status_form4=unserialize($sql_get_detail_fetch['care_CBO_status_form4']);
                               $care_MEO_status_form4=unserialize($sql_get_detail_fetch['care_MEO_status_form4']);
                              $Input_out4=0;
                              $Input_out1_4=0;
                              $x4=count($form4);
                                $x_detail4=array_count_values($care_MEO_status_form4);
                                  if(!empty($form4)){
                                    for ($i=0; $i <count($form4) ; $i++) {
                                      if($care_MEO_status_form4[$i]==2){
                                       $Input_out4++;
                                      }else if($care_MEO_status_form4[$i]==0){
                                        $Input_out4--;
                                      }else if($care_MEO_status_form4[$i]==1){
                                        if($x_detail4[1]==$x4){
                                          $Input_out1_4=1;
                                           $Input_out4=$x4;
                                        }
                                      }
                                    }
                                    if($Input_out4 <= 0){
                                      echo "CBO Comment Pending";
                                    }else if($Input_out4==$x4 && $Input_out1_4==1){?>
                                    <a class="btn btn-danger btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('10')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" ><del>click to View <?=$x4?></del></a>
                                 <?php }else if(($Input_out4 >0)  && ($Input_out1_4==0)){
                                     ?>
                                         <a class="btn btn-success btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('10')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=1" >click to edit<?=$x4?></a>
                                 <?php }
                                  }else{
                                    echo "N/A";
                                  }
                        ?></td>
                        <td><?php
                              // $Input_out4=1;
                              $form5=unserialize($sql_get_detail_fetch['care_form5']);
                              $care_form5_date=unserialize($sql_get_detail_fetch['care_form5_date']);
                              $care_CBO_status_form5=unserialize($sql_get_detail_fetch['care_CBO_status_form5']);
                              $care_MEO_status_form5=unserialize($sql_get_detail_fetch['care_MEO_status_form5']);
                              $Input_out5=0;
                              $Input_out1_5=0;
                              $x5=count($form5);
                                $x_detail5=array_count_values($care_MEO_status_form5);
                                  if(!empty($form5)){
                                    for ($i=0; $i <count($form5) ; $i++) {
                                      if($care_MEO_status_form5[$i]==2){
                                       $Input_out5++;
                                      }else if($care_MEO_status_form5[$i]==0){
                                        $Input_out5--;
                                      }else if($care_MEO_status_form5[$i]==1){
                                        if($x_detail5[1]==$x5){
                                          $Input_out1_5=1;
                                           $Input_out5=$x5;
                                        }
                                      }
                                    }
                                    if($Input_out5 <= 0){
                                    echo "CBO Comment Pending";
                                    }else if($Input_out5==$x5 && $Input_out1_5==1){?>
                                    
                                     <a class="btn btn-danger btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('11')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" ><del>click to View <?=$x5?></del></a>
                                    <?php
                                    }else if(($Input_out5 >0)  && ($Input_out1_5==0)){
                                       ?>
                                      <a class="btn btn-success btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('11')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=1" >click to edit<?=$x5?></a>
                                      <?php
                                    }
                                  }else{
                                    echo "N/A";
                                  }
                        ?></td>
                        <td><?php
                               // $Input_out5=1;
                               $form6=unserialize($sql_get_detail_fetch['care_form6']);
                               $care_form6_date=unserialize($sql_get_detail_fetch['care_form6_date']);
                               $care_CBO_status_form6=unserialize($sql_get_detail_fetch['care_CBO_status_form6']);
                               $care_MEO_status_form6=unserialize($sql_get_detail_fetch['care_MEO_status_form6']);
                               $Input_out6=0;
                               $Input_out1_6=0;
                               $x6=count($form6);
                               $x_detail6=array_count_values($care_MEO_status_form6);
                                  if(!empty($form6)){
                                    for ($i=0; $i <count($form6) ; $i++) {
                                      if($care_MEO_status_form6[$i]==2){
                                       $Input_out6++;
                                      }else if($care_MEO_status_form6[$i]==0){
                                        $Input_out6--;
                                      }else if($care_MEO_status_form6[$i]==1){
                                        if($x_detail6[1]==$x6){
                                          $Input_out1_6=1;
                                           $Input_out6=$x6;
                                        }
                                      }
                                    }
                                    if($Input_out6 <= 0){

                                      echo "CBO Comment Pending";
                                    
                                    }else if($Input_out6==$x6 && $Input_out1_6==1){?>
                                   
                                     <a class="btn btn-danger btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('8')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" ><del>click to View <?=$x6?></del></a>
                                    <?php
                                  }else if(($Input_out6 >0)  && ($Input_out1_6==0)){
                                     ?>
                                    <a class="btn btn-success btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('8')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=1" >click to edit <?=$x6?></a>
                                    <?php
                                  }
                                  }else{
                                    echo "N/A";
                                  }
                        ?></td>
                        <td><?php
                              // $Input_out6=1;
                              $form7=unserialize($sql_get_detail_fetch['care_form7']);
                              $care_form7_date=unserialize($sql_get_detail_fetch['care_form7_date']);
                              $care_MEO_status_form7=unserialize($sql_get_detail_fetch['care_MEO_status_form7']);
                              $Input_out7=0;
                              $Input_out1_7=0;
                              $x7=count($form7);
                                $x_detail7=array_count_values($care_MEO_status_form7);
                                  if(!empty($form7)){
                                    for ($i=0; $i <count($form7) ; $i++) {
                                      if($care_MEO_status_form7[$i]==2){
                                       $Input_out7++;
                                      }else if($care_MEO_status_form7[$i]==0){
                                        $Input_out7--;
                                      }else if($care_MEO_status_form7[$i]==1){
                                        if($x_detail7[1]==$x7){
                                          $Input_out1_7=1;
                                           $Input_out7=$x7;
                                        }
                                      }
                                    }
                                    
                                if($Input_out7 <= 0){

                                echo "CBO Comment Pending";
                                    
                                }else if($Input_out7==$x7 && $Input_out1_7==1){?>
                                  <a class="btn btn-danger btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('1')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" ><del>click to View <?=$x7?></del></a>

                                  <?php
                                }else if(($Input_out7 >0)  && ($Input_out1_7==0)){
                                  ?>
                                  <a class="btn btn-success btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('1')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=1" >click to edit <?=$x7?></a>
                                  <?php
                                }
                              }else{
                                echo "N/A";
                              }
                            ?>
                        </td>
                        <td><?php
                              // $Input_out7=0;
                              $form8=unserialize($sql_get_detail_fetch['care_form8']);
                              $care_form8_date=unserialize($sql_get_detail_fetch['care_form8_date']);
                              $care_MEO_status_form8=unserialize($sql_get_detail_fetch['care_MEO_status_form8']);
                              $Input_out8=0;
                              $Input_out1_8=0;
                              $x8=count($form8);
                                $x_detail8=array_count_values($care_MEO_status_form8);
                                  if(!empty($form8)){
                                    for ($i=0; $i <count($form8) ; $i++) {
                                      if($care_MEO_status_form8[$i]==2){
                                       $Input_out8++;
                                      }else if($care_MEO_status_form8[$i]==0){
                                        $Input_out8--;
                                      }else if($care_MEO_status_form8[$i]==1){
                                        if($x_detail8[1]==$x8){
                                          $Input_out1_8=1;
                                           $Input_out8=$x8;
                                        }
                                      }
                                    }
                                    if($Input_out8 <= 0){

                                      echo "CBO Comment Pending";
                                    
                                    }else if($Input_out8==$x8 && $Input_out1_8==1){?>
                                    <a class="btn btn-danger btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('4')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=2" ><del>click to View <?=$x8?></del></a>
                                    <?php
                                  }else if(($Input_out8 >0)  && ($Input_out1_8==0)){
                                     ?>
                                    <a class="btn btn-success btn-xs" href="MEO_go_form_go.php?form_type=<?=web_encryptIt('ilab')?>&form_id=<?=web_encryptIt('4')?>&care_hhi=<?=web_encryptIt($care_hhi_id_info)?>&target=<?=web_encryptIt($months)?>&year=<?=web_encryptIt($Year)?>&village=<?=web_encryptIt($village)?>&form_uses=1" >click to edit<?=$x8?></a>
                                    <?php
                                  }
                                  }else{
                                    echo "N/A";
                                  }
                        ?></td>
                      </tr>
                   <?php }?>
                  </tbody>
                 </tbody>
                </table>
               </div>
              </div>
             </div>
            </div>
           </div>
        <?php
      }
      }
        }
      ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
}else{
  header('Location:logout.php');
  exit;
}
  $contents = ob_get_contents();
  ob_clean();
  include 'template/template.php';
  ?>
 <!--  <script type="text/javascript">
    function get_village() {
      var form_type=$('#form_type').val();
    var employee_id=$('#employee_id').val();

    if(employee_id!=""){
      $.ajax({
        type:'POST',
        url:'MEO_get_information.php',
        data:'field_info_name='+employee_id+'&form_type='+form_type,
        success:function(html){
          $('#village').html(html);
        }
      });
    }else{
      $('#village').html('<option value="">-- Please Select CRP --</option>');
    }
    }
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    // get_village();

} );
  </script> -->

