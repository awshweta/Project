<?php 
 include("config.php");
 $error = array();
 $total = 0;
 $r= false;
 if (isset($_POST['action'])) {
        if($_POST['action'] == "edit") {
            if(sizeof($error) == 0) {
                $id= $_POST['id'];
                $qty = $_POST['quantity'];
                $sqledit = "UPDATE products SET `quantity` = '$qty'  WHERE id=$id ";
                if ($conn->query($sqledit) === true) {
                 //   echo "<div id='success'>quantity updated successfully</div>";
                } else {
                $error[] = array('input'=>'form','msg'=>'Error deleting record: ' .$conn->error.'');
                }
            }
        }

        if ($_POST['action'] == "delete") {
            if (sizeof($error) == 0) {
                $id= $_POST['id'];
                // echo var_dump($id);
                $sqldelete = "DELETE FROM products WHERE id = $id";
                if ($conn->query($sqldelete) === true) {
                   // echo "<div id='success'>Product deleted successfully</div>";
                } else {
                    $error[]=array('input'=>'form','msg'=>'Error deleting record: ' .$conn->error.'');
                }   
            }
        }
        
     
            $cartitem ='<table id="display"> 
            <thead>
                <tr  class="cart">
                    <th>Item</th>
                    <th>Name</th>
                    <th>price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Description</th>
                    <th>ACTION</th>
                </tr>
                </thead> ';
    
            $sql = "SELECT *  FROM products";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $cartitem .='<tr id="cart-'.$row['id'].'" class="cart">
             <input type="hidden" name="id" value='.$row['id'].'>
             <td><img src="images/'.$row['image'].'"></td>
             <td><h3 class="title"><a href="#">'.$row['name'].'</a></h3></td>
             <td>Price :$'.$row['price'].'</td>
             <td>Quantity :<input class="quantity'.$row['id'].'" name="quantity" value='.$row['quantity'].' type="text"></td>
             <td>Total Price :$'.($row['price']*$row['quantity']).'</td>
             <td>'.$row['description'].'</td>
             <td><input data-productid ='.$row['id'].' class="remove" name="remove"  type="submit" value="DELETE"></td>
             <td><input  data-pid ='.$row['id'].'  data-qty='. $row['quantity'].'  class="edit" name="edit"  type="submit" value="UPDATE"></td>
         </tr>';
                }
            }
            $cartitem .='</table>';

            $sql = "SELECT *  FROM products";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $total += $row['price']*$row['quantity'];
                }
            }
            $conn->close();
        

        $cartdata = array('product' => $cartitem, 'total_price'=> $total);
        echo json_encode($cartdata);
 }