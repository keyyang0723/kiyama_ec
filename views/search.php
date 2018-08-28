<ul class="search">
	<a>商品を探す</a>
	<li>商品名で検索</li>	
		<input type="text" name="search_name" value="<?php echo $this->escape($search_name)?>" />

	<li>カテゴリから検索</li>
		<div id="categories">
			<?php foreach($categories as $category):?>
				<div class="cate">
				<input type="radio" name="category_id" value="<?php echo $this->escape($category['id']);?>"
				<?php if($category['id'] == $category_id):?>checked="checked"<?php endif;?>>
				
					<?php echo $this->escape($category['name']);?>
				</div>
			<?php endforeach; ?>
				<div class="cate">
					<input type="radio"  name="category_id" value=>
					<?php echo '全て';?>
				</div>
		</div>

</ul>
<input style="width: 50%;"type="submit" value="調べる" />
