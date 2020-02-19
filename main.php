<?php require_once "header.php";

$timeNow = date("Y-m-d");
$dateToStr = strval($timeNow);

$nowCase = $conn->query("select * from orders where Ord_RepairDate = '$dateToStr' ");
$row = $nowCase->num_rows;  


?>


    <!--  wrapper -->
    <div id="wrapper">

        <?php 
			  require_once "menu_left.php";
		?>

        <!--  page-wrapper -->
        <div id="page-wrapper">

         <div class="row">
                <!-- Page Header -->
                <br/>
                <div class="col-lg-12">
                    <div class="panel panel-body panel-primary alert-danger"><h3><font color="#333333">ยินดีต้อนรับสู่ <?php echo $title_web;?> , จำนวนการซ่อมทั้งหมดวันนี้ : <?php echo $row;?> เคส</font></h3></div>
                </div>
                <!--End Page Header -->
            </div>

            <!--ข้อมูลการซ่อม -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> ข้อมูลการแจ้งซ่อม
                            



                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                    <th class="small">เลขที่ใบรับ</th>
                                                    <th class="small">ชื่อสกุล</th>
                                                    <th class="small">โทรศัพท์</th>
                                                    <th class="small">อุปกรณ์</th>
                                                    <th class="small">วันที่รับซ่อม</th>
                                                    <th class="small">วันที่เสร็จสิ้น</th>
                                                    <th class="small">ชื่อช่างผู้รับผิดชอบ</th>
                                                    <th class="small">สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        
                                          
 <?php
 
//แสดงข้อมูลตามเงื่อนไข
$sql = $conn->query("select * from orders inner join repair_man on orders.Ord_RepairmanID = repair_man.Rep_ID order by Ord_ID desc");


  while ($show = $sql->fetch_assoc()) {
 

if($show['Ord_Status']==0){$status =  '<span class=text-info>แจ้งซ่อม</span>';}
else if($show['Ord_Status']==1){$status =  '<span class=text-info>กำลังดำเนินการ</span>';}
else if($show['Ord_Status']==2){$status =  '<span class=text-success>รออะไหล่</span>';}
else if($show['Ord_Status']==3){$status =  '<span class=text-info>ซ่อมสำเร็จ</span>';}
else if($show['Ord_Status']==4){$status =  '<span class=text-danger>ซ่อมไม่สำเร็จ</span>';}
else if($show['Ord_Status']==5){$status =  '<span class=text-danger>ยกเลิกการซ่อม</span>';}
else if($show['Ord_Status']==6){$status =  '<span class=text-success>ชำระเงิน</span>';}
else if($show['Ord_Status']==7){$status =  '<span class=text-primary>ส่งมอบให้ลูกค้าเรียบร้อยแล้ว</span>';}

?>
                  <tr>
                  <td class="small"><a href="../print_order.php?id=<?php echo $show['Ord_ID'];?>" target="_blank"><?php echo $show['Ord_Number'];?></a></td>
                  <td class="small"><?php echo $show['Ord_CustomerName'];?></td>
                  <td class="small"><?php echo $show['Ord_CustomerTel'];?></td>
                  <td class="small"><?php echo $show['Ord_RepairModel'];?></td>
                  <td class="small"><?php echo $show['Ord_RepairDate'];?></td>
                  <td class="small"><?php echo $show['Ord_RepairSuccess'];?></td>
                  <td class="small"><?php echo $show['Rep_Name'];?></td>
                  <td class="small"><?php echo $status;?></td>
                  
                                            </tr>
                                            <?php } ?>

                                            <tr><td colspan="10"><?php Chk_Row($sql);?></td></tr>

                                        </tbody>
                                    </table>
                                    </div>

                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--ข้อมูลการซ่อม -->

                    <!--กราฟจำนวนการซ่อมตามเดือน-->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> กราฟแสดงยอดการซ่อมในแต่ละเดือน
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                <?php



$result = $conn->query("SELECT count(Ord_RepairPrice) AS total, DATE_FORMAT(Ord_RepairSuccess, '%M') AS datesave 
FROM orders GROUP BY DATE_FORMAT(Ord_RepairSuccess, '%M%')");
$resultchart = $conn->query("SELECT count(Ord_RepairPrice) AS total, DATE_FORMAT(Ord_RepairSuccess, '%M') AS datesave FROM 
orders GROUP BY DATE_FORMAT(Ord_RepairSuccess, '%M%')");

 
 
 //for chart
$datesave = array();
$total = array();
 
while($rs = mysqli_fetch_array($resultchart)){ 
  $datesave[] = "\"".$rs['datesave']."\""; 
  $total[] = "\"".$rs['total']."\""; 
}
$datesave = implode(",", $datesave); 
$total = implode(",", $total); 
 
?>
 
<h3 align="center">กราฟแสดงยอดการซ่อมในแต่ละเดือน</h3>
<table width="200" border="1" cellpadding="0"  cellspacing="0" align="center">
  <thead>
  <tr>
    <th width="auto"><center>เดือน</center></th>
    <th width="auto"><center>ยอดซ่อม</center></th>
  </tr>
  </thead>
  
  <?php while($row = mysqli_fetch_array($result)) { ?>
    <tr>
      <td align="center"><?php echo $row['datesave'];?></td>
      <td align="center"><?php echo number_format($row['total']);?> เคส</td> 
    </tr>
    <?php } ?>
 
</table>

<hr>
<p align="center">
 

<canvas id="myChart1" width="400px" height="100px"></canvas>
<script>
var ctx = document.getElementById("myChart1").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo $datesave; ?> 
    
        ],
        datasets: [{
            label: 'รายงานแสดงยอดซ่อมแยกตามเดือน (เคส)',
            data: [<?php echo $total;?>
            ],
            backgroundColor: [
                'rgba(138, 43, 226, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(0,0,0,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 3
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>  


                                  

                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--กราฟจำนวนการซ่อมตามเดือน-->

                     <!--กราฟยอดขายรายวัน-->
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> กราฟแสดงยอดขายแยกตามวัน
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                <?php



$result = $conn->query("SELECT SUM(Ord_RepairPrice) AS total, DATE_FORMAT(Ord_RepairSuccess, '%D') AS datesave
FROM orders  
GROUP BY DATE_FORMAT(Ord_RepairSuccess, '%D%')");
$resultchart = $conn->query("SELECT SUM(Ord_RepairPrice) AS total, DATE_FORMAT(Ord_RepairSuccess, '%D') AS datesave
FROM orders  
GROUP BY DATE_FORMAT(Ord_RepairSuccess, '%D%')");

 
 
 //for chart
$datesave = array();
$total = array();
 
while($rs = mysqli_fetch_array($resultchart)){ 
  $datesave[] = "\"".$rs['datesave']."\""; 
  $total[] = "\"".$rs['total']."\""; 
}
$datesave = implode(",", $datesave); 
$total = implode(",", $total); 
 
?>
 
<h3 align="center">กราฟแสดงยอดขายแยกตามวัน</h3>
<table width="200" border="1" cellpadding="0"  cellspacing="0" align="center">
  <thead>
  <tr>
    <th width="auto"><center>วัน</center></th>
    <th width="auto"><center>ยอดขาย</center></th>
  </tr>
  </thead>
  
  <?php while($row = mysqli_fetch_array($result)) { ?>
    <tr>
      <td align="center"><?php echo $row['datesave'];?></td>
      <td align="center"><?php echo number_format($row['total'],2);?> บาท</td> 
    </tr>
    <?php } ?>
 
</table>

<hr>
<p align="center">
 

<canvas id="myChart2" width="400px" height="100px"></canvas>
<script>
var ctx = document.getElementById("myChart2").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo $datesave; ?> 
    
        ],
        datasets: [{
            label: 'รายงานแสดงยอดขายแยกตามวัน (บาท)',
            data: [<?php echo $total;?>
            ],
            backgroundColor: [
                'rgba(139, 0, 0, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(0,0,0,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 3
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>  


                                  

                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--กราฟยอดขายรายวัน-->

                     <!--กราฟยอดขายรายเดือน-->
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> กราฟแสดงยอดขายแยกตามเดือน
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                <?php



$result = $conn->query("SELECT SUM(Ord_RepairPrice) AS total, DATE_FORMAT(Ord_RepairSuccess, '%M') AS datesave
FROM orders  
GROUP BY DATE_FORMAT(Ord_RepairSuccess, '%M%')");
$resultchart = $conn->query("SELECT SUM(Ord_RepairPrice) AS total, DATE_FORMAT(Ord_RepairSuccess, '%M') AS datesave
FROM orders  
GROUP BY DATE_FORMAT(Ord_RepairSuccess, '%M%')");

 
 
 //for chart
$datesave = array();
$total = array();
 
while($rs = mysqli_fetch_array($resultchart)){ 
  $datesave[] = "\"".$rs['datesave']."\""; 
  $total[] = "\"".$rs['total']."\""; 
}
$datesave = implode(",", $datesave); 
$total = implode(",", $total); 
 
?>
 
<h3 align="center">กราฟแสดงยอดขายแยกตามเดือน</h3>
<table width="200" border="1" cellpadding="0"  cellspacing="0" align="center">
  <thead>
  <tr>
    <th width="auto"><center>เดือน</center></th>
    <th width="auto"><center>ยอดขาย</center></th>
  </tr>
  </thead>
  
  <?php while($row = mysqli_fetch_array($result)) { ?>
    <tr>
      <td align="center"><?php echo $row['datesave'];?></td>
      <td align="center"><?php echo number_format($row['total'],2);?> บาท</td> 
    </tr>
    <?php } ?>
 
</table>

<hr>
<p align="center">
 

<canvas id="myChart3" width="400px" height="100px"></canvas>
<script>
var ctx = document.getElementById("myChart3").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo $datesave; ?> 
    
        ],
        datasets: [{
            label: 'รายงานแสดงยอดขายแยกตามเดือน (บาท)',
            data: [<?php echo $total;?>
            ],
            backgroundColor: [
                'rgba(35, 203, 167, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(0,0,0,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 3
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>  


                                  

                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--กราฟยอดขายรายเดือน-->

                    </br>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

</body>

</html>
