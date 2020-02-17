<?php require_once "header.php";?>

<?php


//delete data
if($_REQUEST['admin']=='delete'){
//ลบข้อมูลใน table ที่กำหนด ตาม id ของรายการนั้น
$sql = $conn->query("delete from member where Mem_ID = '$_REQUEST[id]'")or die (mysqli_error());

//function delete ข้อมูล จะมี alert ขึ้นมา ตามเงื่อนไข
Chk_Delete($sql,'ลบข้อมูลเรียบร้อย');
}

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
                            <i class="fa fa-bar-chart-o fa-fw"></i> ตารางแสดงข้อมูลผู้ดูแลระบบ



                        </div>
						<div class="col-lg-4 form-group panel-body panel-primary sidebar-search">

						<form autocomplete="off" class="input-group custom-search-form">

	<input name="txt_search" type="text" id="course" size="50" class="form-control" placeholder="ค้นหาข้อมูลกรุณากรอกชื่อผู้ใช้" required="required" /><span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>

</form>

</div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">

									<div class="panel"><a href="manage_admin_add.php"><input name="" type="button" class="btn btn-success" value="เพิ่มข้อมูลผู้ดูแลระบบ"></a></div>

                                        <table class="table table-striped table-bordered table-hover" id="table_example2">
                                            <thead>
                                                <tr>
                                                    <th width="5%"><div align="center">ลำดับที่</div></th>
                                                    <th width="auto"><div align="center">ชื่อผู้ใช้</div></th>
                                                    <th width="auto"><div align="center">ชื่อ-นามสกุล</div></th>
                                                    <th width="auto"><div align="center">อีเมลล์</div></th>
                                                    <th width="auto"><div align="center">เบอร์โทรศัพท์</div></th>
                                                    <th width="auto"><div align="center">ที่อยู่</div></th>
													<th width="auto"><div align="center">วันที่สร้าง</div></th>
                                                    <th width="auto"><div align="center">สิทธิ์การใช้งาน</div></th>
                                                    <th width="auto"><div align="center">จัดการ</div></th>
                                                </tr>
                                            </thead>
                                            <tbody>
				<?php
				if(!$_REQUEST['txt_search']){

			//โค๊ดแบ่งหน้า
			$perpage = 10;
			if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
			$start = ($page - 1) * $perpage;

//แสดงข้อมูลตามเงื่อนไข และ มีการแบ่งหน้ารายการ
$sql = $conn->query("select * from member order by Mem_ID DESC limit $start,$perpage")or die (mysqli_error());

//หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกแสดงเพื่อจะเอาไปทำการแบ่งหน้า
$sql2 = $conn->query("select * from member order by Mem_ID DESC")or die (mysqli_error());
$total_record = $sql2->num_rows;
$total_page = ceil($total_record / $perpage);


		}
		else {

		//โค๊ดแบ่งหน้า
			$perpage = 10;
			if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
			$start = ($page - 1) * $perpage;

//ค้นหาข้อมูลตามเงื่อนไข และ มีการแบ่งหน้ารายการ
$sql = $conn->query("select * from member  where Mem_User like '%$_REQUEST[txt_search]%' order by Ord_ID desc limit $start,$perpage")or die (mysqli_error());

//หาจำนวน row ทั้งหมด ของ ข้อมูลที่ถูกค้นหาเพื่อจะเอาไปทำการแบ่งหน้า
$sql2 = $conn->query("select * from  member  where Mem_User like '%$_REQUEST[txt_search]%' order by Ord_ID desc")or die (mysqli_error());
$total_record = $sql2->num_rows;
$total_page = ceil($total_record / $perpage);
		}

  $i = 1;

  while ($show= $sql->fetch_assoc()) {
      

     if($show['Mem_Permission']==0){$status =  '<span class=text-info>ยกเลิก</span>';}
else if($show['Mem_Permission']==1){$status =  '<span class=text-info>ใช้งาน</span>';}
?>
                  <tr>
                  <td><div align="center"><?php echo $i++;?></div></td>
                  <td><div align="center"><?php echo $show['Mem_User'];?></div></td>
                  <td><div align="center"><?php echo $show['Mem_Name'];?></div></td>
                  <td><div align="center"><?php echo $show['Mem_Email'];?></div></td>
                  <td><div align="center"><?php echo $show['Mem_Tel'];?></div></td>
                  <td><div align="center"><?php echo $show['Mem_Address'];?></div></td>
                  <td><div align="center"><?php echo $show['Mem_Date'];?></div></td>
                  <td><div align="center"><?php echo $status;?></div></td>
                  
                  <td><div align="center">
                  <a href="manage_admin_edit.php?id=<?php echo $show['Mem_ID'];?>"><input name="" type="button" class="btn btn-primary" value="แก้ไขข้อมูลผู้ดูแลระบบ"></a>&nbsp;
                  <a href="?admin=delete&id=<?php echo $show['Mem_ID'];?>"><input name="" type="button" class="btn btn-danger" value="ลบข้อมูลผู้ดูแลระบบ"></a>
                  </div></td>
                  </tr>
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
