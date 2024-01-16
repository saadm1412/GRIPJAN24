<!--This code written by the Mahamadsaad jatin Mujawar for the GRIP Web development virtual internship offeres by spark foundation (Jan 2024)-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" type="text/css" href="custstyle.css">
    <link rel="stylesheet" type="text/css" href="transstyle.css">

    <script src="https://kit.fontawesome.com/29d0d4479a.js" crossorigin="anonymous"></script>
</head>

<title>Spark | Transfer Money</title>

<body>
    <header>

        <div id="navbar">
            <nav>
                <div class="logo"><img src="images/logo.png"></div>
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

    <div class="title-transfer">
        <h2>Customer Details</h2>
    </div>

    <?php

    $server = "sql310.infinityfree.com";
    $username = "if0_35784559";
    $password = "xSnWXvvuVUBdS";
    $db = "if0_35784559_grip";

    $conn = mysqli_connect($server, $username, $password, $db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['submit'])) {
        $from = $_GET['id'];
        $to = $_POST['to'];
        $amount = $_POST['amount'];

        $sql1 = mysqli_query($conn, "SELECT * FROM customers WHERE id=$from");
        $row1 = mysqli_fetch_array($sql1);

        $sql2 = mysqli_query($conn, "SELECT * FROM customers WHERE id=$to");
        $row2 = mysqli_fetch_array($sql2);

        if ($amount > $row1['balance']) {
            echo '<script type="text/javascript">';
            echo ' alert("Insufficient Balance")'; // alert box
            echo '</script>';
        } else {
            $newbalance1 = $row1['balance'] - $amount;
            $sql = "UPDATE customers SET balance=$newbalance1 WHERE id=$from";
            mysqli_query($conn, $sql);

            $newbalance2 = $row2['balance'] + $amount;
            $sql = "UPDATE customers SET balance=$newbalance2 WHERE id=$to";
            mysqli_query($conn, $sql);

            $sender = $row1['name'];
            $receiver = $row2['name'];
            $sql = "INSERT INTO transfers VALUES ('$from','$sender', '$receiver', '$amount')";
            mysqli_query($conn, $sql);

            echo "<script> alert('Money Transferred Successfully'); window.location='index.html'; </script>";
        }
    }

    $sid = $_GET['id'];
    $sql = "SELECT * FROM customers WHERE id=$sid";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    ?>
    <form method="post" name="tcredit" class="tabletext"><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr>
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br>
        <div class="title">
            <h3>Transfer Money</h3>
        </div>
        <div class=container-transfer>
            <div class="transferto">
                <label>Transfer To:</label>
                <select name="to" class="form-control" required>
                    <option value="" disabled selected>Select Receiver ..</option>
                    <?php

                    $sql = "SELECT * FROM customers WHERE id!=$sid";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        echo "Error " . $sql . "<br>" . mysqli_error($conn);
                    }
                    while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                        <option class="table" value="<?php echo $rows['id']; ?>">
                            <?php echo $rows['name']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="amount">
                <label>Amount:</label>
                <input type="number" value="Enter Amount" class="form-control" name="amount" required>
                <br><br>
                <button class="btn btn-primary" name="submit" type="submit" id="btn">Transfer</button>
            </div>
        </div>
    </form>
    

</body>

</html>
