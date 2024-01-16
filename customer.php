<!--This code written by the Mahamadsaad jatin Mujawar for the GRIP Web development virtual internship offeres by spark foundation (Jan 2024)-->

<!DOCTYPE html>
 <html>
 <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="custstyle.css">
        
        <script src="https://kit.fontawesome.com/29d0d4479a.js" crossorigin="anonymous"></script>
</head>
 
     <title>Spark Project </title>
 
 <body>
 <header>
 
 <div id="navbar">
 <nav>
      <div class="logo"><img src="banklogo.jpeg"></div>
         <input type="checkbox" id="click">
          <label for="click" class="menu-btn">
                 <i class="fas fa-bars"></i>
           </label>
         <ul>
            <li><a href="index.html">Home</a></li> 
         </ul>
     </div>
 </nav>
 </div>
 </header>
 
<div class="container-customer">
    <div class="title">
      <h2>Our Customers</h2>
    </div>
    <table>
        <tr>
        <th>Id</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Balance</th>
        <th> </th>
        </tr>
        <?php
        $servername="sql310.infinityfree.com";
        $username="if0_35784559";
        $password="xSnWXvvuVUBdS";
        $database="if0_35784559_grip";
            $conn = mysqli_connect($servername,$username,$password,$database);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM if0_35784559_grip.customers";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
       
                    echo '<tr>';
                    echo '<td>'.$row['id'].'</td>';
                    echo '<td>'.$row['name'].'</td>';
                    echo '<td>'.$row['email'].'</td>';
                    echo '<td>'.$row['balance'].'</td>';
                    echo '<td><a href="transfer.php?id='.$row['id'].'"><button type="button" class="btn btn-success">View Details & Transfer Money</button></a>';
                    echo '<tr>';
        
                }
                echo "</table>";
            } else { echo "0 results"; }
            $conn->close();
        ?>
    </table>
</div>
 <!--end Main-->
 </body>
 </html>