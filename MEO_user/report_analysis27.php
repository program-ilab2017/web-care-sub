<?php
session_start();
ob_start();
if($_SESSION['meo_user']){
  $location_user=$_SESSION['location_user'];
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Number of poultry received vaccination per village per crp";
  if(isset($_POST['form_type'])){
    $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
    if($form_type=='get_hhi_infomation'){
      $village=$_POST['village'];
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
$form_types=$_SESSION['form_type'];
$location_user=$_SESSION['location_user'];
?>
<!-- =============================================== -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
      </script> -->
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});     
      </script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       
        <small>Number of poultry received vaccination per village per crp</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">New Report </a></li>
        <li class="active">Report/Analysis 27</li>
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
                  <label for="village">CRP :</label>
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
            <li ><a data-toggle="tab" href="#home">Report Tabular</a></li>
            <li class="active"><a data-toggle="tab" href="#menu1">Report Graphical</a></li>
          </ul>
           <div class="tab-content">
            <div id="home" class="tab-pane fade ">
              <h3>Report Tabular</h3>
              <div class="table-responsive">
                <?php
                  if(!empty($months)){                      
                    ?>
                     <table class="table table-striped table-bordered" cellspacing="0" >
                      <thead>
                        <tr>
                          <th>Slno</th>                         
                          <th>Village Name</th>
                          
                          <th>Number of poultry received vaccination  </th>

                          
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $x=0;
                          $total_count=0;
                          $total_area=0;
                          $total_female=0;
                          $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_district`='$location_user' ";
                          $sql_get_village=mysqli_query($conn,$get_village);
                          while($result_village=mysqli_fetch_assoc($sql_get_village)){
                            $care_vlg_name1=$result_village['care_vlg_name'];
                           $get_datas="SELECT AVG(`care_LS_VN_no_of_animal`), Sum(`care_LS_VN_no_of_animal`),count(*) FROM `care_master_mtf_livestock_tarina` WHERE `livestock`='3' AND `care_LS_month`='$months' AND `care_LS_year`='$Year' AND`care_LS_IP_vaccination` ='1' AND`care_LS_vlg_name`='$care_vlg_name1' and `care_LS_employee_id`='$employee_id'   ";
                            $sql_get_datas=mysqli_query($conn,$get_datas);
                                 $fetch_result=mysqli_fetch_row($sql_get_datas);
                                if($fetch_result[1]!=""){
                               
                                  $total_count=$fetch_result[2]+$total_count;
                                  $total_area=$fetch_result[1]+$total_area;
                            $x++;
                            ?>
                            <tr>
                              <td><?=$x?></td>
                              <td><?=strtoupper($care_vlg_name=$result_village['care_vlg_name'])?></td>
                             
                              <td><?=$fetch_result[1]?></td>

                            </tr>
                          <?php }
                        }
                          ?>
                          
                            
                      </tbody>
                    </table>
                    
                <?php 
         

                  }
                ?>
              </div>
            </div>

             <div id="menu1" class="tab-pane fade in active">

                <script type="text/javascript">
                 google.charts.load('current', {'packages':['bar']});
                  google.charts.setOnLoadCallback(drawStuff);

                  function drawStuff() {

                      var data = google.visualization.arrayToDataTable([
                       ['village',  'Total vaccination '],
                        <?php 
                        
                        $get_village_sc="SELECT * FROM `care_master_village_info` WHERE `care_vlg_district`='$location_user' ";
                          $sql_get_village_sc=mysqli_query($conn,$get_village_sc);
                          while($result_village_sc=mysqli_fetch_assoc($sql_get_village_sc)){
                            $care_vlg_name1_sc=$result_village_sc['care_vlg_name'];
                            $get_datas_sc="SELECT AVG(`care_LS_VN_no_of_animal`), Sum(`care_LS_VN_no_of_animal`),count(*) FROM `care_master_mtf_livestock_tarina` WHERE `livestock`='3' AND `care_LS_month`='$months' AND `care_LS_year`='$Year' AND`care_LS_IP_vaccination` ='1' AND`care_LS_vlg_name`='$care_vlg_name1_sc' and `care_LS_employee_id`='$employee_id'   ";
                            $sql_get_datas_sc=mysqli_query($conn,$get_datas_sc);
                                $fetch_results_sc=mysqli_fetch_row($sql_get_datas_sc);
                                if($fetch_results_sc[1]!=""){
                                
                                  echo "['".strtoupper($care_vlg_name=$result_village_sc[care_vlg_name])."',".$fetch_results_sc[1]."],";
                                }


                              }?>
                        
                      ]);
                
                      var options = {
                        title: ' Number of poultry received vaccination ',
                        chartArea: {width: '80%'},
                         isStacked: true,
                        hAxis: {
                          title: 'vaccination ',
                          minValue: 0
                        },
                        vAxis: {
                          title: 'Village'
                        }
                      };

                      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

                      chart.draw(data, options);
                    }
              </script>
                  <div class="row">
                    <div class="col-xs-12">
                     
                      <div class="col-sm-2"><div id="chart_div" style="width: 900px; height: 500px;"></div></div>
                      
                    </div>
                  </div>

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
  <script type="text/javascript">
    $(document).ready(function(){ 
     var a=$('#datatable-buttons').DataTable({
       "sScrollX": "100%",
        "aLengthMenu": [[5, 15], [5, 15]],
        "iDisplayLength": 5,          
      responsive: true,
      ordering: false,
      
      initComplete: function () {
          this.api().columns().every(function () {
              var column = this;

              var select = $('<select><option value=""></option></select>')
                  .appendTo($("#filters").find("th").eq(column.index()))
                  .on('change', function () {
                  var val = $.fn.dataTable.util.escapeRegex(
                  $(this).val());                                     

                  column.search(val ? '^' + val + '$' : '', true, false)
                      .draw();
              });

              console.log(select);

              column.data().unique().sort().each(function (d, j) {
                  $(select).append('<option value="' + d + '">' + d + '</option>')
              });
          });
      },
      // lengthChange:!1,buttons:["copy","excel","pdf","colvis"]
  });
     // a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
});
</script>