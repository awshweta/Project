<?php include("config.php");
 $error = array();

 if(isset( $_POST['action'])) {

        if ($_POST['action'] == "delete") {
            if(sizeof($error) == 0) {
                $id=$_POST['id'];
                //echo var_dump($id);
                $sqldelete = "DELETE FROM tags WHERE id = $id";

                if ($conn->query($sqldelete) === true) {
                   // echo "<div id='success'>User account deleted successfully</div>";
                } else {
                    $error[]=array('input'=>'form','msg'=>'Error deleting record: ' .$conn->error.'');
                }
            }
        }
        
            $tags ='<table id="tags">
            <tr class = "row" >
                <th>tag_Name</th>
                <th>Action</th>
            </tr>';
    
            $sql = "SELECT *  FROM tags";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tags .=' <tr class = "row">
                    <input type="hidden" name="id" value='.$row['id'].'>
                        <td>'.$row['name'].'</td>
                        <td><input data-uid='.$row['id'].' class="delete" type="button" name="delete" value="DELETE"></td>
                    </tr>';
                }
            }
            $tags .='</table>';
        

        $tags = array('tag' => $tags);
        echo json_encode($tags);
 }