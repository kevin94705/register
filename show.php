<?php
include '__init__.php';


$sql = "SELECT * FROM `user_data`";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $data_array[] = array(
        "id" => $row['id'],            
        "nickname" => $row['nickname'],
        "birthday" => $row['birthday'],
        "phone" =>$row['phone'],
        "email" => $row['email']
    );
}
echo json_encode($data_array);
mysqli_close($conn);
?>
