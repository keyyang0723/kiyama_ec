<?php $this->setLayoutVar('title','カテゴリ一覧')?>
<h2>カテゴリ削除</h2>
<form action="<?php echo $base_url;?>/category/delete/post" method="post">
<div id="categories">
	<?php foreach($categories as $category):?>
	<div class="cate">
	<input type="radio" name="id" value="<?php echo $this->escape($category['id']);?>">
		<?php echo $this->escape($category['id']);?>
		<?php echo $this->escape($category['name']);?>
	</div>
	<?php endforeach; ?>
</div>
<input type="submit" value="削除"/>
</form>
<a href="<?php echo $base_url;?>/category">カテゴリ一覧</a>
<a href="<?php echo $base_url;?>/category/add">カテゴリ追加</a>