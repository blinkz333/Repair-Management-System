<?php 

require_once "conn.php";
$sql = $conn->query("select * from orders where Ord_ID = '$_REQUEST[id]'")or die (mysqli_error());
$show = $sql->fetch_assoc ();

if($show['Ord_RepairStatus']==0){$status =  '<span class=text-info>แจ้งซ่อม</span>';}
else if($show['Ord_RepairStatus']==1){$status =  '<span class=text-info>กำลังดำเนินการ</span>';}
else if($show['Ord_RepairStatus']==2){$status =  '<span class=text-info>รออะไหล่</span>';}
else if($show['Ord_RepairStatus']==3){$status =  '<span class=text-success>ซ่อมสำเร็จ</span>';}
else if($show['Ord_RepairStatus']==4){$status =  '<span class=text-danger>ซ่อมไม่สำเร็จ</span>';}
else if($show['Ord_RepairStatus']==5){$status =  '<span class=text-danger>ยกเลิกการซ่อม</span>';}
else if($show['Ord_RepairStatus']==6){$status =  '<span class=text-success>ชำระเงิน</span>';}
else if($show['Ord_RepairStatus']==7){$status =  '<span class=text-success>ส่งมอบให้ลูกค้าเรียบร้อยแล้ว</span>';}

?>
<!DOCTYPE html>
<html>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title_web;?></title>

			<!-- Bootstrap core CSS -->
<link href=css/BackEnd/assets/plugins/bootstrap/bootstrap.css rel=stylesheet />
<link href=css/BackEnd/assets/font-awesome/css/font-awesome.css rel=stylesheet />
<link href=css/BackEnd/assets/css/style.css rel=stylesheet />
<link href=css/BackEnd/assets/css/main-style.css rel=stylesheet />
<link href=css/BackEnd/assets/plugins/morris/morris-0.4.3.min.css rel=stylesheet />

<!-- datepicker -->
<link rel="stylesheet" media="all" type="text/css" href="plugins/jquerydatepicker/jquery-ui.css" />
<link rel="stylesheet" media="all" type="text/css" href="plugins/jquerydatepicker/jquery-ui-timepicker-addon.css">

<!--javascript ของระบบ-->
<script src=css/BackEnd/assets/plugins/jquery-1.10.2.js></script>
<script src=css/BackEnd/assets/plugins/bootstrap/bootstrap.min.js></script>
<script src=css/BackEnd/assets/plugins/metisMenu/jquery.metisMenu.js></script>
<script src=css/BackEnd/assets/scripts/siminta.js></script>
<!--javascript เขียนเอง-->
<script src=js/function_javascript.js></script>

<!--plugins ckeditor-->
<script src=plugins/ckeditor/ckeditor.js></script>
<!-- datepicker -->
<script type="text/javascript" src="plugins/jquerydatepicker/jquery-ui.min.js"></script>
<script type="text/javascript" src="plugins/jquerydatepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="plugins/jquerydatepicker/jquery-ui-sliderAccess.js"></script>

<!-- datepicker-->
<script type="text/javascript">
    
     $(function(){
    $("#dateinput1").datepicker({dateFormat: 'dd-mm-yy',minDate:0,});
    $("#dateinput2").datepicker({dateFormat: 'dd-mm-yy',minDate:0,});
    $("#dateinput3").datepicker({dateFormat: 'dd-mm-yy',minDate:0,});
});


</script>

</head>
<body>
<div class="row">
                <div class="col-lg-12">

                    <!--Simple table example -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-file fa-fw"></i> รายละเอียดการซ่อม

                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form name="form1" id="myform1" action="?admin=insert" method="post" enctype="multipart/form-data" onsubmit="return chk_error();">

                                    <div class="form-group col-lg-12">
                                            <label><font size="20"><u>รายละเอียดของลูกค้า</u></font></label>
                                    </div>

									<div class="form-group col-lg-12 ">
                                            <label class="fontLabel"><i class="fa fa-user fa-fw"></i> ชื่อและนามสกุล : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_CustomerName']?></label>
                                    </div>
                                    
                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-location-arrow fa-fw"></i> ที่อยู่ : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_CustomerAddress']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-phone fa-fw"></i> โทรศัพท์ : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_CustomerTel']?></label>
                                    </div>

                                    <br/>

                                    <div class="form-group col-lg-12">
                                            <label><font size="20"><u>รายละเอียดการซ่อม</u></font></label>
                                    </div>
                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-file fa-fw"></i> อุปกรณ์ : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairModel']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-laptop fa-fw"></i> หมายเลขเครื่อง/เลขทะเบียน : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairModelID']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-calendar fa-fw"></i> วันที่รับซ่อม : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairDate']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-calendar fa-fw"></i> วันนัดรับ : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairSuccess']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-money fa-fw"></i> ประเมินราคา : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairPrice']?>&nbsp;บาท</label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-wrench fa-fw"></i> รายละเอียดการซ่อม/ปัญหา  : </label>&emsp;<label class="fontValue"><?php echo $show['Ord_RepairDescription']?></label>
                                    </div>

                                    <div class="form-group col-lg-12 ">
                                        <label class="fontLabel"><i class="fa fa-dashboard fa-fw"></i> สถานะปัจจุบัน  : </label>&emsp;<label class="fontValue"><?php echo $status; ?></label>
                                    </div>
                                  
                                    
                                    <div class="clearfix"></div>
                                    <hr>

									
									</div>

									</form>

                                </div>

                            </div>
</body>