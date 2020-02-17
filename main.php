<?php require_once "header.php";

$timeNow = date("Y-m-d");

$nowCase = $conn->query("SELECT COUNT(*) FROM orders WHERE orders.Ord_RepairDate = $timeNow");
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

            <!--Simple table example -->
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
$sql = $conn->query("select * from orders o order by o.Ord_ID desc");


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
                  <td class="small"><?php echo $show['Ord_RepairPerson'];?></td>
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
                    <!--End simple table example -->
                     
                   
                    </br>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

</body>

</html>
