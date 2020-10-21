<?php 
 include("config.php");
 if (isset($_POST['action'])) {
        $order ='<table id="orders">
        <tr class = "row" >
        <th>ORDER ID</th>
        <th>DATETIME</th>
        <th>TOTAL Price</th>
        <th>STATUS</th>
        </tr> ';
        $sql = "SELECT *  FROM orders";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $order .='
                <tr class = "row">
                    <input type="hidden" name="id" value='.$row['orderid'].'>
                    <td>'.$row['orderid'].'</td>
                    <td>'.$row['datetime'].'</td>
                    <td>'.$row['carttotal'].'</td>
                    <td>'.$row['status'].'</td>
                </tr>';
                }
            }
        $order .='</table>';
        $orderdata = array('order' => $order);
        echo json_encode($orderdata);
 }?>