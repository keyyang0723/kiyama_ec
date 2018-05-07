<?php echo $this->render('back',array());?>
画像を登録する
<form action="image" method="post" enctype="multipart/form-data">
  <input type="file" name="fname">
  <input type="submit" value="アップロード">
</form>
