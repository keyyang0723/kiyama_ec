<?php $this->setLayoutVar('title','カテゴリ一覧')?>
<?php echo $this->render('back',array());?>
<h2>カテゴリ一覧</h2>

<div id="categories">
	<?php foreach($categories as $category):?>
	<div class="cate">
	
		<?php echo $this->escape($category['id']);?>
		<?php echo $this->escape($category['name']);?>
	</div>
	<?php endforeach; ?>
</div>
</form>
<a href="<?php echo $base_url;?>/admin/category/add">カテゴリ追加</a>
<a href="<?php echo $base_url;?>/admin/category/delete">カテゴリ削除</a>