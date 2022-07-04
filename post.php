<?php 
date_default_timezone_set("Asia/Taipei");

include '__init__.php';
if (!empty($_POST["login_acc"])){
    $poster = $_POST["login_acc"];
    $sql = "SELECT nickname FROM user_data where account='$poster'";
    $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
            $data_array = array(
                "nickname" => $row['nickname']
            );
        }
    }
else if (!empty($_POST["post_acc"]) && !empty($_POST["post_nickname"]) && !empty($_POST["post_content"])){
    $posted_acc = $_POST["post_acc"] ;
    $posted_nickname = $_POST["post_nickname"] ;
    $posted_content = $_POST["post_content"] ;

    $sql_Query = "SELECT max(post_id) as maxid from post_table";
    $objQuery = mysqli_query($conn,$sql_Query);
    while($row = mysqli_fetch_array($objQuery)){
        $data = array(
            "maxid" => $row['maxid']
        );
    }
    $newid = $data['maxid']+1;
    $post_time = date("Y-m-d H:i:s");
    $sql = "INSERT into post_table (post_id,post_acc,nickname,text,post_time) values ('$newid','$posted_acc','$posted_nickname','$posted_content','$post_time')";
    $result = mysqli_query($conn,$sql);
    echo '發布成功';
    echo '<form action="index.php" method="post">';
    echo '<input type="hidden" id="login_acc" name="acc" value="<?php echo $posted_acc; ?>">';
    echo '<p><input type="submit"  value="返回"></p>';
    echo '</form>';

}
else{
    header('Location: http://127.0.0.1/test/main.php');
}
?>

<form action="post.php" method="post">
    <p>帳號: <input type="text" name="post_acc"  readonly  unselectable="on" value="<?php echo $poster ;?>"></p>
    <p>小名: <input name="post_nickname" type="text" readonly  unselectable="on" value="<?php echo $data_array["nickname"] ;?>"></p>
    <p>內容: <input name="post_content" type="text" value="不是我啦"></p>

    <p><input type="submit"  value="送出資料"></p>

</form>

