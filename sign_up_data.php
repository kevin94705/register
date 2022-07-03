<?php
date_default_timezone_set("Asia/Taipei");
if (empty($_POST)
){
    /* 轉接頁面 */
    header('Location: http://127.0.0.1/main.php');
    exit();
}
else{
    $acc = $_POST['acc'];
    $name = $_POST['name'];
    $nickname = $_POST['nickname'];
    $phone = $_POST['phone'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
}

if (!empty($acc) && !empty($name) && !empty($nickname) && !empty($phone)  && !empty($birthday) &&  !empty($email)){    
    include "__init__.php";
    /**** Check account ****/
    $sql_Query = "select * from user_data where account = '$acc'";
    $objQuery = mysqli_query($conn,$sql_Query);
    if(mysqli_fetch_array($objQuery))
    {
        $arr['Error'] = "帳號已存在";

        $result =  json_encode($arr, JSON_UNESCAPED_UNICODE);
        echo $arr['Error'];
        ?>
        <form action="main.php" method="get">
            <p><input type="submit" value="返回首頁"></p>
        </from>
        <?php
        exit();
    }
    else{
        /**** Check mail ****/
        $sql_Query = "select * from user_data where email = '$email'";
        $objQuery = mysqli_query($conn,$sql_Query);
        if(mysqli_fetch_array($objQuery))
        {
            $arr['Error'] = "E-mail已存在";
            $result =  json_encode($arr, JSON_UNESCAPED_UNICODE);
            echo $arr['Error'];
            ?>
            <form action="main.php" method="get">
                <p><input type="submit" value="返回首頁"></p>
            </from>
            <?php
            exit();
        }
        else{
            /* last_ID  */
            $sql_Query = "select max(id) as maxid from user_data";
            $objQuery = mysqli_query($conn,$sql_Query);
            while($row = mysqli_fetch_array($objQuery)){
                $data = array(
                    "maxid" => $row['maxid']
                );
            }
            $newid = $data['maxid']+1;
            $sign_up_data = date("Y-m-d H:i:s");
            /**** Insert ****/
            $sql_Query = "insert into user_data (id,account,name,nickname,birthday,phone,email,status,last_login_time) values ('$newid','$acc','$name','$nickname','$birthday','$phone','$sign_up_data',1,'$sign_up_data')";
            if(mysqli_query($conn,$sql_Query)){
                    $arr['Error'] = "創建帳號成功";

                    $result =  json_encode($arr, JSON_UNESCAPED_UNICODE);
                    echo $arr['Error'];
                    ?>
                    <form action="main.php" method="get">
                        <p><input type="submit" value="返回首頁"></p>
                    </from>
                    <?php

                    exit();
                    
            }
            else{
                $arr['Error'] = "請檢查連線狀態";

                $result =  json_encode($arr, JSON_UNESCAPED_UNICODE);
                echo $arr['Error'];
                ?>
                <form action="main.php" method="get">
                    <p><input type="submit" value="返回首頁"></p>
                </from>
                <?php
                exit();
            }
            mysqli_close($conn);
            }
        }      
}

?>