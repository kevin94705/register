<?php
 include '__init__.php';
 $login_acc = $_POST['acc'];
 echo $login_acc ."您好";
?>
 
 <form action="post.php" method="post">
    <input type="hidden" name="login_acc" value="<?php echo  $login_acc;?>">
 <input type="submit" value="發布">
</form>
<?php

 $sql  = "SELECT * from post_table";
 $result = mysqli_query($conn,$sql);
 while ($row = $result ->fetch_assoc()){
?>

  <div class="card">
    <div class="card__avatar"></div>
    <div class="card__body">
        <div class="card__info">
          <span class="card__author"><?php echo $row['nickname']; ?></span>
          <span class="card__time"><?php echo $row['post_time']; ?></span>
        </div>
        <p class="card__content"><?php echo $row['text']; ?></p>
    </div>
  </div>
  <div class="board__hr"></div>

<?php
 }


?>