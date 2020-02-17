<?php
session_start ();
//เรียกใช้ไฟล์ connect db
require_once "conn.php"; 
require_once "function.php"; 

$sql = $conn->query("select * from orders  where Ord_ID = '$_REQUEST[id]'");
$i = 1;
$show = $sql->fetch_assoc();

if($show['Ord_Status']==0){$status =  '<span class=text-warning>ยังไม่ชำระเงิน</span>';}
else if($show['Ord_Status']==1){$status =  '<span class=text-info>ตรวจสอบชำระเงิน</span>';}
else if($show['Ord_Status']==2){$status =  '<span class=text-success>ชำระเงินเรียบร้อย</span>';}
else if($show['Ord_Status']==3){$status =  '<span class=text-primary>จัดส่งเรียบร้อย</span>';}
else if($show['Ord_Status']==4){$status =  '<span class=text-danger>ยกเลิกรายการ</span>';}
?>

<!DOCTYPE HTML>
<head>
<title><?php echo $title_web;?></title>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="<?php echo $author;?>" >
  <meta name="description" content="<?php echo $description;?>" >
  <meta name="keywords" content="<?php echo $keywords;?>" >
  <meta name="robots" content="<?php echo $robots;?>">

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<!--theme-style-->


</head>
<body>
<div style="padding:30px;">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header text-center">
          <?php echo $title_web;?>
          <p class="text-info"><b>ใบรับซ่อมสินค้า</b></p>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
      <strong>ติดตามสถานะการซ่อม</strong>
        <address>
        <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http%3A%2F%2F<?php echo $_REQUEST['status'];?>%2F&choe=UTF-8" title="Link to Google.com" />
        </address>
      </div>
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- /.col -->
      <div class="col-12">

        <div class="table-responsive">
          <table class="table table-bordered">
            <tr class="text-primary">
              <th>วันที่ทำรายการ: <?php echo $show['Ord_RepairDate'];?></th>
              <th>เบอร์โทรศัพท์: <?php echo $show['Ord_CustomerTel'];?></th>
            </tr>
            <tr class="text-primary">
              <th>ที่อยู่: <?php echo $show['Ord_CustomerAddress'];?>&emsp;จังหวัด <?php echo $show['Ord_CustomerProvince'];?></th>
            </tr>
            <tr class="text-primary">
              <th>อุปกรณ์: <?php echo $show['Ord_RepairModel'];?></th>
              <th>หมายเลขเครื่อง: <?php echo $show['Ord_RepairModelID'];?></th>
            </tr>
            <tr class="text-primary">
              <th>รายละเอียดการซ่อม/ปัญหา : <?php echo $show['Ord_RepairDescription'];?></th>
            </tr>
            <tr class="text-primary">
              <th>หมายเหตุการซ่อม : <?php echo $show['Ord_RepairRemark'];?></th>
            </tr>
            <tr class="text-primary">
              <th>ประเมิณราคา : <?php echo $show['Ord_RepairPrice'];?></th>
              <th>วันนัดรับ : <?php echo $show['Ord_RepairSuccess'];?></th>
            </tr>
            
          
          </table>
        </div>
<hr>
        <div class="clear"></div>

        <div align="center">
        <button class="btn btn-primary btd-grad" onClick="window.print();">Print</button>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
							 
</body>
</html>

