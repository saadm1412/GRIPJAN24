<!--This code written by the Mahamadsaad jatin Mujawar for the GRIP Web development virtual internship offeres by spark foundation (Jan 2024)-->

<!DOCTYPE html>
<html>
<head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="custstyle.css">
        <script src="https://kit.fontawesome.com/29d0d4479a.js" crossorigin="anonymous"></script> 
</head>
 
     <title>SparkPC | Transfer History</title>
 
 <body>
 <div class="container">
    <div class="main">
		<a href="index.html"><button>GOTO Home</button></a>	    
		<a href="customer.php"><button>View Customers</button></a>	
	</div>
    <div class="title">
        <h2>Transactions</h2>
    </div>
        <table>
        <tr>
        <th>Sender's id</th>
        <th>Sender</th>
        <th>Reciever</th>
        <th>Transaction Amount</th>
        </tr>
        <?php
         $server="sql310.infinityfree.com";
         $username="if0_35784559";
         $password="xSnWXvvuVUBdS";
         $db="if0_35784559_grip";
             
            $conn = mysqli_connect($server,$username,$password,$db);
    
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM if0_35784559_grip.transfers"  ;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
       
                    echo '<tr>';
                    echo '<td>'.$row['id'].'</td>';
                    echo '<td>'.$row['sender'].'</td>';
                    echo '<td>'.$row['receive'].'</td>';
                    echo '<td>'.$row['amount'].'</td>';
                    echo '<tr>';
        
                }
                echo "</table>";
            } else { echo "0 results"; }
            $conn->close();
        ?>
    </table>

</div>
 </body>
 </html>