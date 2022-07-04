<?php

date_default_timezone_set("Asia/Taipei");

if (empty($_POST)){
    /* 轉接頁面 */
    header('Location: http://127.0.0.1/main.php');
    exit();
}else{
    $acc = $_POST['acc'];
}

include '__init__.php';

$sql = "SELECT * FROM user_data where account='$acc'";
$result = mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result);

if ($rowcount==1) {
    $login_date_data = date("Y-m-d H:i:s");
    $sql = "UPDATE user_data SET last_login_time='$login_date_data' where account='$acc'";
    $update_time = mysqli_query($conn,$sql);
    if ($update_time){
        while($row = mysqli_fetch_array($result)){
            $data_array[] = array(
                "id" => $row['id'],
                "name"=>$row['name'],
                "nickname" => $row['nickname'],
                "birthday" => $row['birthday'],
                "phone" =>$row['phone'],
                "email" => $row['email'],
                "last_login_time" => $row['last_login_time']
            );
        }
        #$data_array =  json_encode($data_array, JSON_UNESCAPED_UNICODE);
        $data_array = array_values($data_array);
        $data_array = $data_array[0];

        echo "編號: ". $data_array['id']."<p>";
        echo "名子: ". $data_array['name']."<p>";
        echo "小名: ". $data_array['nickname']."<p>";
        echo "生日: ". $data_array['birthday']."<p>";
        echo "電話: ". $data_array['phone']."<p>";
        echo "email: ". $data_array['email']."<p>";
        echo "最後登入時間: ". $data_array['last_login_time']."<p>";
        ?>


        <form action="index.php" method="post" name="next_page">
            <input type="hidden" id='login_acc' name="acc" value="<?php echo $acc; ?>">
            <p><input type="submit" value="查看公佈欄"></p>
        </from>

        <?php
    }
}
else{
    echo "失敗";
    ?>
    <form action="main.php" method="get">
        <input type="submit" value="返回首頁">
    </from>

    <?php
}
mysqli_close($conn);
?>
