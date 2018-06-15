<?php
session_start();
ob_start();
// ini_set('display_errors',1);
if($_SESSION['meo_user']){
  $location_user=$_SESSION['location_user'];
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Number of training conducted CRP wise in the reported month";
  if(isset($_POST['form_type'])){
    $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
    if($form_type=='get_hhi_infomation'){
      $village=$_POST['GP'];
      $months=$_POST['month'];
      $Year=$_POST['Year'];
      $employee_id=$_POST['employee_id'];
    }else{
      $months="";
      $Year="";
      $employee_id="";
      $village="";
      header('Location:logout.php');
      exit;
    }
  }else{
     $months="";
      $Year="";
      $employee_id="";
      $village="";
  }

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      
        <small>Number of training conducted CRP wise in the reported month</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">New Report </a></li>
        <li class="active">Report/Analysis 2</li>
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
                <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('get_hhi_infomation')?>">
                <div class="form-group">
                <label for="village">CRP :</label>
               
                  <select class="form-control" id="employee_id"  name="employee_id">
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


          ?>
          <div class="panel panel-default">
            <div class="panel-body text-center">
          <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#home">Report Tabular</a></li>
            <li class="active"><a data-toggle="tab" href="#menu1">Report Graphical</a></li>
           <!--  <li><a data-toggle="tab" href="#menu2">Menu 2</a></li> -->
          </ul>

          <div class="tab-content">
            <div id="home" class="tab-pane fade ">
              <h3>Report Tabular</h3>
              <div class="table-responsive">
                <table id="example" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Village Name</th>
                      <th>No Of Training</th>                        
                    </tr>
                  </thead>
                  <tbody>
                  

                <?php
               $get_village="SELECT * FROM `care_master_assigned_user_info` WHERE `care_assU_employee_id`='$employee_id' and `status`='1'";
                        $sql_exe=mysqli_query($conn,$get_village);
                        while ($res_village=mysqli_fetch_assoc($sql_exe)) {
                
                  $village_id=$res_village['care_assU_village_id'];
                  $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_name`='$village_id' and `care_vlg_district`='$location_user'";
                  $sql_get_village=mysqli_query($conn,$get_village);
                  $result_village=mysqli_fetch_assoc($sql_get_village);
                  // while($result_village=mysqli_fetch_assoc($sql_get_village)){
                    ?>
                    <tr>
                      <td><?=strtoupper($care_vlg_name=$result_village['care_vlg_name'])?></td>
                      <td>
                        <?php

                    $get_data="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_vlg_name`='$care_vlg_name' and `care_EV_employee_id`='$employee_id' and `care_EV_training_facilitator` LIKE '%CRP%' ";
                    $sql_get_data=mysqli_query($conn,$get_data);
                    echo mysqli_num_rows($sql_get_data);
                ?>
                  </td>
                   </tr>
              <?php   }
                ?>
             
            </tbody>
          </table>
        </div>
            </div>
            <div id="menu1" class="tab-pane fade in active">
             <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                  var data = google.visualization.arrayToDataTable([
                    ['Village', 'No Of Training'],
                    <?php
                      $get_village1="SELECT * FROM `care_master_assigned_user_info` WHERE `care_assU_employee_id`='$employee_id' and `status`='1'";
                        $sql_exe1=mysqli_query($conn,$get_village1);
                        while ($res_village1=mysqli_fetch_assoc($sql_exe1)) {
                        $village_id1=$res_village1['care_assU_village_id']; 
                      $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_name`='$village_id1' and `care_vlg_district`='$location_user'";
                      $sql_get_village=mysqli_query($conn,$get_village);
                      // while($result_village=mysqli_fetch_assoc($sql_get_village)){
                      $result_village=mysqli_fetch_assoc($sql_get_village);
                        $care_vlg_name=$result_village['care_vlg_name'];
                        $get_data="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_vlg_name`='$care_vlg_name' and `care_EV_employee_id`='$employee_id' and `care_EV_training_facilitator` LIKE '%CRP%'";
                        $sql_get_data=mysqli_query($conn,$get_data);
                    echo "['".strtoupper($care_vlg_name)."',".mysqli_num_rows($sql_get_data)."],";
                    }
                    ?>  
                    // ['Work',     11],
                    // ['Eat',      2],
                    // ['Commute',  2],
                    // ['Watch TV', 2],
                    // ['Sleep',    0]
                  ]);

                  var options = {
                    title: 'Training Report Village',
                    width: 600,
        
                  };

                  var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                  chart.draw(data, options);
                }
              </script>
               <div id="piechart" style="width: 900px; height: 500px;"></div>
            </div>
            <div id="menu2" class="tab-pane fade">
              <h3>Menu 2</h3>
              <p>Some content in menu 2.</p>
            </div>
          </div>
        </div>
      </div>
          <?php
        
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
  <script type="text/javascript">
    function get_village() {
      var form_type=$('#form_type').val();
    var employee_id=$('#employee_id').val();

    if(employee_id!=""){
      $.ajax({
        type:'POST',
        url:'report_get_information1.php',
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
  </script>