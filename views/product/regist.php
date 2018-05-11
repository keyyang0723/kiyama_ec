<?php $this->setLayoutVar('title','商品登録')?>
<?php echo $this->render('back',array());?>

<form action="<?php echo $base_url;?>/admin/product/regist/post" method="post" enctype="multipart/form-data">


	<?php if(isset($errors) && count($errors)>0): ?>
	<?php echo $this->render('errors',array('errors'=> $errors));?>
	<?php endif;?>	
	<h3>商品名</h3>
		<div>	
			<input type="text" name="name" value="<?php echo $this->escape($name);?>">
		</div>
	<h3>説明</h3>
		<div>
			<textarea name="description" rows="5" cols="60"><?php echo $this->escape($description);?></textarea>
		</div>
	<h3>値段</h3>
		<div>
			<input type="text" name="price" value="<?php echo $this->escape($price);?>">
		</div>
	<h3>カテゴリ</h3>
		<div id="categories">
			<?php foreach($categories as $category):?>
				<div class="cate">
				<input type="radio" <?php if($category['id'] == $category_id ){echo 'checked';}?> name="category_id" value="<?php echo $this->escape($category['id']);?>">
					<?php echo $this->escape($category['id']);?>
					<?php echo $this->escape($category['name']);?>
				</div>
			<?php endforeach; ?>
		</div>
	<h3>個数</h3>
		<div>
			<input type="text" name="stock" value="<?php echo $this->escape($stock);?>">
		</div>
	<h3>画像</h3>
		<?php echo $this->render('upload',array());?>
	<p>
		<input type="submit" value="登録する"/>
	</p>
</form>

