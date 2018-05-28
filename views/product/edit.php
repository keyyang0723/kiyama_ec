<?php $this->setLayoutVar('title','詳細編集')?>
<?php echo $this->render('back',array());?>
<div class="form">
	<form action="<?php echo $base_url;?>/admin/product/edit" method="post" enctype="multipart/form-data">

	<?php if(isset($errors) && count($errors)>0): ?>
		<?php echo $this->render('errors',array('errors'=> $errors));?>
	<?php endif;?>
	<?php if(isset($id)):?>
		<input type="hidden" name="id" value="<?php echo $this->escape($id);?>" /> 
	<?php endif;?>
		<div>
			<h3>商品名</h3>
			<input type="text" name="name" value="<?php echo $this->escape($name);?>">
		</div>
	
		<div>
			<h3>説明</h3>
			<textarea name="description" rows="5" cols="60"><?php echo $this->escape($description);?></textarea>
		</div>
	
		<div>
			<h3>値段</h3>
			<input type="text" name="price" value="<?php echo $this->escape($price);?>">
		</div>
	
		<div id="categories">
			<h3>カテゴリ</h3>
			<?php foreach($categories as $category):?>
				<div class="cate">
				<input type="radio" <?php if($category['id'] == $category_id ){echo 'checked';}?> name="category_id" value="<?php echo $this->escape($category['id']);?>">
					<?php echo $this->escape($category['id']);?>
					<?php echo $this->escape($category['name']);?>
				</div>
			<?php endforeach; ?>
		</div>
	
		<div >
			<h3>個数</h3>
			<input type="text" name="stock" value="<?php echo $this->escape($stock);?>">
		</div>
		<div >
			<h3>画像</h3>

				<?php if(strlen($image_name)!=0):?>
					<div class="main">
						<img class="edit" src =<?php echo '/image/'.$image_name.'.jpg';?> >
					</div>
				<?php endif?>
			<input type="hidden" name="image_name" value="<?php echo $this->escape($image_name);?>" />
			<?php echo $this->render('upload',array());?>
		</div>
	
		<div>
			<h3>表示</h3>
			<select name="is_displayed">
				<option value="0" <?php if($is_displayed == '0' ):?>selected<?php endif;?>>表示する</option>
				<option value="1" <?php if($is_displayed == '1' ):?>selected<?php endif;?>>表示しない</option>
			</select>
		</div>
	<p>
		<?php if(isset($id)):?>
			<input type="submit" value="編集する"/>
			<input type="submit" name="delite" value="削除する"/>
		<?php else:?>
			<input type="submit" value="登録する"/>
		<?php endif;?>
	</p>
</form>
</div>
