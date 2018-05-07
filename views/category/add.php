<?php $this->setLayoutVar('title','カテゴリ追加')?>
<?php echo $this->render('back',array());?>
<h2>カテゴリ追加</h2>
<form action="<?php echo $base_url;?>/admin/category/add/post" method="post">
	<!-- <input type="hidden" name="_token" value="<?php echo $this->escape($_token);?>" /> -->

	<?php if(isset($errors) && count($errors)>0): ?>
	<?php echo $this->render('errors',array('errors'=> $errors));?>
	<?php endif;?>

	<input type="text" name="name" value="<?php echo $this->escape($name);?>">

	<p>
		<input type="submit" value="追加"/>
	</p>

</form>

<a href="<?php echo $base_url;?>/admin/category">カテゴリ一覧</a>
<a href="<?php echo $base_url;?>/admin/category/delete">カテゴリ削除</a>