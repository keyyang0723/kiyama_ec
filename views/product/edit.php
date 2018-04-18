<?php $this->setLayoutVar('title','詳細編集')?>
<?php var_dump($is_displayed);?>
<form action="<?php echo $base_url;?>/product/<?php echo $this->escape($name);?>/edit" method="post">

	<?php if(isset($errors) && count($errors)>0): ?>
		<?php echo $this->render('errors',array('errors'=> $errors));?>
	<?php endif;?>

	<input type="hidden" name="id" value="<?php echo $this->escape($id);?>" />
	<h3>商品名</h3>
		<div>	
			<textarea name="name" rows="1" cols="60"><?php echo $this->escape($name);?></textarea>
		</div>
	<h3>説明</h3>
		<div>
			<textarea name="description" rows="5" cols="60"><?php echo $this->escape($description);?></textarea>
		</div>
	<h3>値段</h3>
		<div>
			<textarea name="price" rows="1" cols="60"><?php echo $this->escape($price);?></textarea>
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
			<textarea name="stock" rows="1" cols="60"><?php echo $this->escape($stock);?></textarea>
		</div>
	<h3>画像</h3>
		<div>
			<select name="image">
				<option value="サンプル1">サンプル1</option>
				<option value="サンプル2">サンプル2</option>
				<option value="サンプル3">サンプル3</option>
			</select>

		</div>

	<h3>表示</h3>
		<div>
			<select name="is_displayed">
				<option value="0" <?php if($is_displayed == '0' ):?>selected<?php endif;?>>表示する</option>
				<option value="1" <?php if($is_displayed == '1' ):?>selected<?php endif;?>>表示しない</option>
			</select>
		</div>
	<p>
		<input type="submit" value="編集する"/>
		<input type="submit" name="delite" value="削除する"/>
	</p>
</form>