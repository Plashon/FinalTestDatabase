<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="./css/style.css">
	<title>User Registration</title>
</head>
<body>


<?php
require 'connect.php';

$sql_select = 'SELECT * from tbl_patient order by pid';
$stmt_s = $conn->prepare($sql_select);
$stmt_s->execute();

if (isset($_POST['submit'])) {
    
    if (!empty($_POST['qdate']) && !empty($_POST['qnumber'])) {
        echo '<br>' . $_POST['qdate'];
        require 'connect.php';
       

        $sql = "INSERT into tbl_queue values (:qdate, :qnumber ,:pid,:qstatus )";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':qdate', $_POST['qdate']);
        $stmt->bindParam(':qnumber', $_POST['qnumber']);
        $stmt->bindParam(':pid', $_POST['pid']);
         $stmt->bindParam(':qstatus', $_POST['qstatus']);


        try {
            if ($stmt->execute()):
                $message = 'Successfully add new food';
            else:
                $message = 'Fail to add new food';
            endif;
            echo $message;
        } catch (PDOException $e) {
            echo 'Fail! ' . $e;
        }

        $conn = null;
    }

    header("Location:index.php");
}
?>
    <div class="container">
      <div class="row">
        <div class="col-md-4"> <br>
            <h3>ฟอร์มเพิ่มข้อมูลคิว</h3>
            <form  action="addData.php" method="POST" enctype="multipart/form-data">
            <br>
            <input type="date"  name="qdate"> 
            <br> <br>
            <input type="text" placeholder="หมายเลขคิว" name="qnumber">
            <br> <br>
            <input type="text" placeholder="รหัสบัตรประชาชน" name="pid">
            <br> <br>   
            <input type="text" placeholder="สถานะปัจจุบัน" name="qstatus">
            <br> <br>
            <input class="input" type="submit" value="Submit" name="submit" />
            </form>
            </div>
        </div>
    </div>
</body>
</html>