<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Update customer </title>
  </head>
  <body>

<?php
require 'connect.php';

$sql_select ="SELECT * from tbl_queue order by  qdate" ;
$stmt = $conn->prepare($sql_select);
$stmt->execute();
echo "qdate = ".$_GET['qdate'];

if (isset($_GET['qdate'])) {
    $sql_select_customer = 'SELECT * FROM tbl_queue WHERE qdate=?';
    $stmt = $conn->prepare($sql_select_customer);
    $stmt->execute([$_GET['qdate']]);
    echo "get = ".$_GET['qdate'];
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

    
<div class="container">
      <div class="row">
        <div class="col-md-4"> <br>
          <h3>ฟอร์มแก้ไขข้อมูลการจองคิว</h3>
          <form action="updateData.php" method="POST">
           <input type="hidden" name="qdate" value="<?= $result['qdate']; ?>">
            
                <label for="name" class="col-sm-3 col-form-label"> วันที่จองคิวเข้ารับการรักษา:  </label>
                <input type="text" name="qdate" class="form-control" required value="<?= $result['qdate']; ?>">            
                
                <label for="name" class="col-sm-4 col-form-label"> หมายเลขคิว :  </label>
                <input type="text" name="qnumber" class="form-control" required value="<?= $result['qnumber']; ?>">
          
                <label for="name" class="col-sm-4 col-form-label"> รหัสบัตรประชาชน :  </label>
                <input type="text" name="pid" class="form-control" required value="<?= $result['pid']; ?>">

                <label for="name" class="col-sm-4 col-form-label"> สถานะคิว :  </label>
                <br>
                <select name="qstatus" required value="<?= $result['qstatus']; ?>">
                        <option value="รอเข้ารับการรักษา">รอเข้ารับการรักษา</option>
                        <option value="รักษาเสร็จสิ้นแล้ว">รักษาเสร็จสิ้นแล้ว</option>
                </select>  
  <br>
            <br> <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>