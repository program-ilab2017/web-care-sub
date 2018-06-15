<?php
session_start();
ob_start();
// ini_set('display_errors',1);
if($_SESSION['report_user']){
  include  '../config_file/config.php';
  require 'FlashMessages.php';
 $msg = new \Preetish\FlashMessages\FlashMessages();
 $title="Average size of influenced farmer land size";
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
      
        <small>Average size of influenced farmer land size</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">New Report </a></li>
        <li class="active">Report/Analysis 17</li>
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
              <h1 style="color: red">Wait For Information Need To Be Clear Before Generating Report</h1>
              
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
                  $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_gp`='$village'";
                  $sql_get_village=mysqli_query($conn,$get_village);
                  while($result_village=mysqli_fetch_assoc($sql_get_village)){
                    ?>
                    <tr>
                      <td><?=strtoupper($care_vlg_name=$result_village['care_vlg_name'])?></td>
                      <td>
                        <?php

                    $get_data="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_vlg_name`='$care_vlg_name'";
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

                      $get_village="SELECT * FROM `care_master_village_info` WHERE `care_vlg_gp`='$village'";
                      $sql_get_village=mysqli_query($conn,$get_village);
                      while($result_village=mysqli_fetch_assoc($sql_get_village)){
                        $care_vlg_name=$result_village['care_vlg_name'];
                        $get_data="SELECT * FROM `care_master_mrf_exposure_visit_tarina` WHERE`care_EV_month`='$months' AND `care_EV_year`='$Year' and `care_EV_vlg_name`='$care_vlg_name'";
                        $sql_get_data=mysqli_query($conn,$get_data);
                    echo "['".strtoupper($care_vlg_name)."',".mysqli_num_rows($sql_get_data)."],";
                    }
                    ?>  
                   
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