<?php
require('connect.php');


$sql = "DELETE from tbl_queue where qdate = :qdate AND qnumber = :qnumber ";
$stml = $conn->prepare($sql);
$stml->bindParam(':qdate',$_GET['qdate']);
$stml->bindParam(':qnumber',$_GET['qnumber']);

if($stml->execute()){
     
if($stml->execute()){
   // $message = "Successfully delete customer".$_GET['CustomerID'].".";
           echo '
        <script type="text/javascript">        
                        $(document).ready(function(){
                    
                            swal({
                                title: "Success!",
                                text: "Successfuly delete that menu",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }, function(){
                                    window.location.href = "index.php";
                            });
                        });                    
                        </script>
        ';



                    }
}else{
    $message = "Fail to delete foodmenu information.";
}
echo $message;
$conn = null;
header("location:index.php");




?>


