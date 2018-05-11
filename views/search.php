<div class="sidebar">探す
	
	<ul>
		<li>商品名で検索</li>
	
			<input type="text" name="search_name" value="<?php echo $this->escape($search_name)?>" />

		<li>カテゴリから検索</li>
		<div id="categories">
				<?php foreach($categories as $category):?>
					<div class="cate">
					<input type="radio" <?php if($category['id'] == $category_id ){echo 'checked';}?> name="category_id" value="<?php echo $this->escape($category['id']);?>">
						<?php echo $this->escape($category['name']);?>
					</div>
				<?php endforeach; ?>
			</div>
		<p>
			<input type="submit" value="調べる" />
		</p>
	</ul>
	</form>
</div>


