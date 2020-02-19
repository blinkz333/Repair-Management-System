<?php require_once "header.php";?>

<?php


$sql = $conn->query("select * from repair_man where Rep_ID = '$_REQUEST[id]'")or die (mysqli_error());
$displayName = $sql->fetch_assoc ();

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
                    <div class="panel panel-body panel-primary alert-danger"><h3><font color="#333333">ยินดีต้อนรับสู่ระบบจัดการ <?php echo $title_web;?></font></h3></div>
                </div>
                <!--End Page Header -->
            </div>
							<!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> ตารางแสดงข้อมูลการทำงานของ : <?php echo $displayName['Rep_Name'];?>



                        </div>
						<div class="col-lg-4 form-group panel-body panel-primary sidebar-search">

						<form autocomplete="off" class="input-group custom-search-form">



</form>

</div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">

									
                                        <table class="table table-striped table-bordered table-hover" id="table_example2">
                                            <thead>
                                                <tr>
                                                <th width="5%"><div align="center">ลำดับที่</div></th>
                                                    <th width="auto"><div align="center">เลขที่ใบรับ</div></th>
                                                    <th width="auto"><div align="center">ชื่อ สกุล</div></th>
                                                    <th width="auto"><div align="center">อุปกรณ์</div></th>
                                                    <th width="auto"><div align="center">อาการ</div></th>
                                                    <th width="auto"><div align="center">วันที่รับซ่อม</div></th>
                                                    <th width="auto"><div align="center">วันนัดรับ</div></th>
                                                    <th width="auto"><div align="center">สถานะการซ่อม</div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
				<?php
				

			//โค๊ดแบ่งหน้า
			$perpage = 10;
			if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
			$start = ($page - 1) * $perpage;

//แสดงข้อมูลตามเงื่อนไข และ มีการแบ่งหน้ารายการ
$sql = $conn->query("select * from repair_man inner join orders on repair_man.Rep_ID = orders.Ord_RepairmanID where repair_man.Rep_ID = '$_REQUEST[id]' order by Rep_ID DESC limit $start,$perpage")or die (mysqli_error());

//หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกแสดงเพื่อจะเอาไปทำการแบ่งหน้า
$sql2 = $conn->query("select * from repair_man inner join orders on repair_man.Rep_ID = orders.Ord_RepairmanID where  repair_man.Rep_ID = '$_REQUEST[id]' order by Rep_ID DESC")or die (mysqli_error());
$total_record = $sql2->num_rows;
$total_page = ceil($total_record / $perpage);

  $i = 1;

  while ($show= $sql->fetch_assoc()) {
      

if($show['Ord_RepairStatus']==0){$status =  '<span class=text-info>แจ้งซ่อม</span>';}
else if($show['Ord_RepairStatus']==1){$status =  '<span class=text-info>กำลังดำเนินการ</span>';}
else if($show['Ord_RepairStatus']==2){$status =  '<span class=text-info>รออะไหล่</span>';}
else if($show['Ord_RepairStatus']==3){$status =  '<span class=text-success>ซ่อมสำเร็จ</span>';}
else if($show['Ord_RepairStatus']==4){$status =  '<span class=text-danger>ซ่อมไม่สำเร็จ</span>';}
else if($show['Ord_RepairStatus']==5){$status =  '<span class=text-danger>ยกเลิกการซ่อม</span>';}
else if($show['Ord_RepairStatus']==6){$status =  '<span class=text-success>ชำระเงิน</span>';}
else if($show['Ord_RepairStatus']==7){$status =  '<span class=text-success>ส่งมอบให้ลูกค้าเรียบร้อยแล้ว</span>';}


?>
                  <tr>
                  <td><div align="center"><?php echo $i++;?></div></td>
                  <td><div align="center"><?php echo $show['Ord_Number'];?></div></td>
                  <td><div align="center"><?php echo $show['Ord_CustomerName'];?></div></td>
                  <td><div align="center">ชนิด: <?php echo $show['Ord_RepairModel'];?> รุ่น/รหัส : <?php echo $show['Ord_RepairModelID'];?></div></td>
                  <td><div align="center"><?php echo $show['Ord_RepairDescription'];?></div></td>
                  <td><div align="center"><?php echo $show['Ord_RepairDate'];?></div></td>
                  <td><div align="center"><?php echo $show['Ord_RepairSuccess'];?></div></td>
                  <td><div align="center"><?php echo $status;?></div></td>
                  </tr>

                    <!-- Modal -->
                    <div id="order<?php echo $show['Rep_ID'];?>" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="alert alert-success" id="exampleModalLabel" data-toggle="modal">ปรับปรุงสถานะการรับงานของช่าง</h2>
                                </div>
                                <div class="modal-body">
                                <form id="myform1" method="post" action="?admin=status&id=<?php echo $show['Rep_ID'];?>">
                                <?php 
                                $sql2 = $conn->query("select * from repair_man where Rep_ID = '$show[Rep_ID]'");
                                $show2 = $sql2->fetch_assoc();
                                ?>
                                 <div class="form-group">
                                    <lable>สถานะช่าง:<lable>
                                    <select name="modalStatus" class="form-control">
                                    <option value="0"<?php if($show2['Rep_Status']==0){echo 'selected';}?>>ว่างงาน</option>
                                    <option value="1"<?php if($show2['Rep_Status']==1){echo 'selected';}?>>ไม่ว่างงาน</option>
                                    </select>
                                </div>
                             
                                <div class="clear"></div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- endModal -->

                    <?php }?>

                  <!-- ส่วนของการแสดงเลขแบ่งหน้า ถ้าไม่พบข้อมูลเลยจะขึ้นว่า Data Not Found แต่ถ้ามีข้อมูลจะขึ้นเลขแบ่งหน้า-->
                  <tr>
                    <td colspan="12"><div align="center"><?php if($sql->num_rows==0){Chk_Row($sql);}else {?><nav>
 <ul class="pagination">
 <li>
 <a href="?page=1" aria-label="Previous">
 <span aria-hidden="true">&laquo;</span> </a> </li>
 <?php for($i=1;$i<=$total_page;$i++){ ?>
 <li><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
 <?php } ?>
 <li>
 <a href="?page=<?php echo $total_page;?>" aria-label="Next">
 <span aria-hidden="true">&raquo;</span> </a> </li>
 </ul>
 
 </nav><?php } ?></div></td>
                    </tr>
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



                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!--End simple table example -->

                </div>

            </div>

                    </div>
                    <!--End Chat Panel Example-->
                </div>
            </div>

        </div>
        <!-- end page-wrapper -->

    </div></div>
    <!-- end wrapper -->

</body>

</html>
