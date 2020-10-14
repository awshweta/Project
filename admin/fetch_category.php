<?php include("config.php");
 $error = array();

 if(isset( $_POST['action'])) {

        if ($_POST['action'] == "delete") {
            if(sizeof($error) == 0) {
                $id=$_POST['id'];
                //echo var_dump($id);
                $sqldelete = "DELETE FROM categories WHERE id = $id";

                if ($conn->query($sqldelete) === true) {
                   // echo "<div id='success'>User account deleted successfully</div>";
                } else {
                    $error[]=array('input'=>'form','msg'=>'Error deleting record: ' .$conn->error.'');
                }
            }
        }
        
            $categories ='<table id="category">
            <tr class = "row" >
                <th>Category_Name</th>
                <th>Action</th>
            </tr>';
    
            $sql = "SELECT *  FROM categories";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $categories .=' <tr class = "row">
                    <input type="hidden" name="id" value='.$row['id'].'>
                        <td>'.$row['name'].'</td>
                        <td><input data-uid='.$row['id'].' class="delete" type="button" name="delete" value="DELETE"></td>
                    </tr>';
                }
            }
            $categories .='</table>';
        

        $categories = array('category' => $categories);
        echo json_encode($categories);
 }