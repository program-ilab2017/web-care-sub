<?php
session_start();
ob_start();
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Average number of participants (Total) in the training in the reported month";
  if(isset($_POST['form_type'])){
    $form_type=web_decryptIt(str_replace(" ", "+", $_POST['form_type']));
    if($form_type=='get_hhi_infomation'){
      
      $months=$_POST['month'];
      $Year=$_POST['Year'];
      $employee_id=$_POST['employee_id'];
    }else{
      $months="";
      $Year="";
      $employee_id="";
     
       header('Location:logout.php');
      exit;
    }
  }else{
     $months="";
      $Year="";
      $employee_id="";
      
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
       
        <small>Average number of participants (Total) in the training in the reported month</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">New Report </a></li>
        <li class="active">Report/Analysis 8</li>
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
                 <input type="hidden" name="form_type" id='form_type' value="<?=web_encryptIt('get_hhi_infomation')?>">
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
            <div id="home" class="tab-pane fade in active">
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
                          <th>Count Entry</th>
                          <th>Sum Male</th>
                          <th>Sum Female</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $x=0;
                          $total_count=0;
                          $total_male=0;
                          $total_female=0;
                          $get_village="SELECT * FROM `care_master_village_info` ";
                          $sql_get_village=mysqli_query($conn,$get_village);
                          while($result_village=mysqli_fetch_assoc($sql_get_village)){
                            $care_vlg_name1=$result_village['care_vlg_name'];
                            $get_datas="SELECT AVG(`care_EV_male_Participants`),AVG(`care_EV_female_Participants`),SUM(`care_EV_male_Participants`),Sum(`care_EV_female_Participants`),COUNT(*) FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_vlg_name`='$care_vlg_name1'";
                            $sql_get_datas=mysqli_query($conn,$get_datas);
                            $fetch_results=mysqli_fetch_row($sql_get_datas);
                                // print_r($fetch_results);
                                if(!empty($fetch_results[0])){
                                 
                                
                            $x++;
                            ?>
                            <tr>
                              <td><?=$x?>
                              <td><?=strtoupper($care_vlg_name=$result_village['care_vlg_name'])?></td>
                              <td>
                                <?php

                             echo  $fetch_results[4] ;
                              $total_count=$total_count+$fetch_results[4];
                        ?>
                          </td>
                          <td>
                                <?php
                                 echo $fetch_results[2];
                                  $total_male=$total_male+$fetch_results[2];
                            
                        ?>
                          </td>
                          <td> <?php
                                 echo $fetch_results[3];
                                  $total_female=$total_female+$fetch_results[3];
                            
                        ?></td>
                           </tr>

                      <?php   }
                    }
                        ?>
                        <tr>
                          <th colspan="2">Total</th>
                          <td>
                           <?php echo $total_count;?>
                          </td>
                           <td>
                            <?php echo $total_male ?>
                          </td>
                          <td>
                            <?php echo $total_female ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
               
                     <table class="table table-striped table-bordered" cellspacing="0" >
                      <!-- <thead>
                        <tr id="filters">                         
                          <th>Average duration Of Session</th>
                        </tr>
                      </thead> -->
                      <tbody>
                        <tr>
                          <th>Average number of participants (Total)</th>
                          <td>
                              <?php
                              $get_data="SELECT AVG(`care_EV_male_Participants`),AVG(`care_EV_female_Participants`),SUM(`care_EV_male_Participants`),Sum(`care_EV_female_Participants`),COUNT(*) FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' ";
                                $sql_get_data=mysqli_query($conn,$get_data);
                                $fetch_result=mysqli_fetch_row($sql_get_data);
                                // print_r($fetch_result);
                                if($fetch_result[0]!="" or $fetch_result[1]!=""){
                                  echo "(".$total_male."+".$total_female.")/".$total_count."=";
                                  echo $total=$fetch_result[0]+ $fetch_result[1];
                                }else{
                                  echo "0";
                                }
                                // echo mysqli_num_rows($sql_get_data);
                              ?>
                          </td>
                        </tr>
                            
                      
                      </tbody>
                    </table>
                <?php 
         

                  }
                ?>
              </div>
            </div>
            <div id="menu1" class="tab-pane fade">

                <script type="text/javascript">
                 google.charts.load('current', {'packages':['bar']});
                  google.charts.setOnLoadCallback(drawStuff);

                  function drawStuff() {

                      var data = google.visualization.arrayToDataTable([
                       ['village', 'Male', 'Female'],
                        <?php 
                        $get_data_sc="SELECT AVG(`care_EV_male_Participants`),AVG(`care_EV_female_Participants`),SUM(`care_EV_male_Participants`),Sum(`care_EV_female_Participants`),COUNT(*) FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' ";
                                $sql_get_data_sc=mysqli_query($conn,$get_data_sc);
                                $fetch_result_sc=mysqli_fetch_row($sql_get_data_sc);
                                // print_r($fetch_result);
                                if(!empty($fetch_result_sc[0])){
                                 
                                  $duration=$fetch_result_sc[0] . "  Hours";
                                }else{
                                 $duration =" 0 Hours";
                                }
                        $get_village_sc="SELECT * FROM `care_master_village_info` ";
                          $sql_get_village_sc=mysqli_query($conn,$get_village_sc);
                          while($result_village_sc=mysqli_fetch_assoc($sql_get_village_sc)){
                            $care_vlg_name1_sc=$result_village_sc['care_vlg_name'];
                            $get_datas_sc="SELECT AVG(`care_EV_male_Participants`),AVG(`care_EV_female_Participants`),SUM(`care_EV_male_Participants`),Sum(`care_EV_female_Participants`),COUNT(*)  FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_vlg_name`='$care_vlg_name1_sc'";
                            $sql_get_datas_sc=mysqli_query($conn,$get_datas_sc);
                            $fetch_results_sc=mysqli_fetch_row($sql_get_datas_sc);
                                // print_r($fetch_results);
                                if(!empty($fetch_results_sc[0])){
                                  echo "['".strtoupper($care_vlg_name=$result_village_sc[care_vlg_name])."',".$fetch_results_sc[2].",".$fetch_results_sc[3]."],";
                                }


                              }?>
                        // ['New York City, NY', 8175000],
                        // ['Los Angeles, CA', 3792000],
                        // ['Chicago, IL', 2695000],
                        // ['Houston, TX', 2099000],
                        // ['Philadelphia, PA', 1526000]
                      ]);
      //                 var options = {
      //   title: 'Population of Largest U.S. Cities',
      //   chartArea: {width: '50%'},
      //   isStacked: true,
      //   hAxis: {
      //     title: 'Total Population',
      //     minValue: 0,
      //   },
      //   vAxis: {
      //     title: 'City'
      //   }
      // };
                      var options = {
                        title: 'Average number of participants (Total) <?=$total?>',
                        chartArea: {width: '80%'},
                         isStacked: true,
                        hAxis: {
                          title: 'Total Present',
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