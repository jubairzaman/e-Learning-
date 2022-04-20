<?php
define('TITLE','Sell Order') ;
define('PAGE','SellReport') ;
include('../dbConnection.php') ;
include('includes/header.php') ;
include('../dbConnection.php') ;
session_start() ;
if(isset($_SESSION['is_adminlogin'])){
    $aemail= $_SESSION['aEmail'];
}else{
    echo "<script>location.href='AdminLogin.php'</script>" ;
}
?>

<div class="col-sm-9 col-md-10 mt-5 text-center">
    <form action="" method="post" class="d-print-none">
        <div class="form-row">
            <div class="form-group col-md-2 ">
                <input type="date" class="form-control" id="startdate" name="startdate">
            </div> <span> to </span>
            <div class="form-group col-md-2 ">
                <input type="date" class="form-control" id="enddate" name="enddate">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-secondary" name="searchsubmit" value="Search">
            </div>
        </div>
    </form>
    <?php
    if(isset($_REQUEST['searchsubmit'])){
        $startdate = $_REQUEST['startdate'] ;
        $enddate = $_REQUEST['enddate'] ;
    $sql = "SELECT * FROM customer_tb WHERE cpdate BETWEEN '$startdate' AND '$enddate'" ;
    $result = $conn->query($sql) ;
    if($result->num_rows >0){
        echo '<p class="bg-dark text-white p-2 mt-4">Details</p>
        <table class="table">
        <thead>
        <tr>
        <th scope="col">Customer ID</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Customer Address</th>
        <th scope="col">Product Name</th>';
        echo'<th scope="col">Quantity</th>';
        echo'<th scope="col">Price Each</th>' ;       
        echo'<th scope="col">Total</th>';
        echo'<th scope="col">Date</th>';
        echo'</tr>';
        echo'</thead>';
        echo'<tbody>';
        while($row = $result->fetch_assoc()){
        echo'<tr>';
        echo'<td>'.$row['custid'].'</td>';
        echo '<td>'.$row['custname'].'</td>
        <td>'.$row['custadd'].'</td>
        <td>'.$row['cpname'].'</td>
        <td>'.$row['cpquantity'].'</td>
        <td>'.$row['cpeach'].'</td>
        <td>'.$row['cptotal'].'</td>
        <td>'.$row['cpdate'].'</td>
        </tr>';
        }
        echo '<tr>';
        echo '<td>' ;
        echo'<input type="submit" class="btn btn-danger d-print-none" value="Print" onClick="window.print()">
        </td>
        </tr>
        </tbody>
        </table>' ;
    }else{
        echo "<div class='alert alert-warning col-sm-6 ml-5 mt-2 role='alert'>No records Found!!</div>";
    }
    
    }
    ?>
</div>


<?php
include('includes/footer.php') ;
?>