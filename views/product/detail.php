<?php $this->setLayoutVar('title',$product['name'])?>


<form action="<?php echo $base_url;?>/product/<?php echo $this->escape($product['name']);?>/edit" method="post">
	<input type="hidden" name="name" value="<?php echo $this->escape($product['name']);?>" />
	<input type="hidden" name="id" value="<?php echo $this->escape($product['id']);?>" />
	<input type="hidden" name="price" value="<?php echo $this->escape($product['price']);?>" />
	<input type="hidden" name="stock" value="<?php echo $this->escape($product['stock']);?>" />
	<input type="hidden" name="description" value="<?php echo $this->escape($product['description']);?>" />
	<input type="hidden" name="category_id" value="<?php echo $this->escape($product['category_id']);?>" />
	<input type="hidden" name="image" value="<?php echo $this->escape($product['image']);?>" />
	<input type="hidden" name="description" value="<?php echo $this->escape($product['description']);?>" />
	<input type="hidden" name="is_displayed" value="<?php echo $this->escape($product['is_displayed']);?>" />
		<div class="status_content">
			<h2><?php echo $this->escape($product['name']);?></h2>
			<div>price
				<?php echo $this->escape($product['price']);?></div>
			<div>
				stock
				<?php echo $this->escape($product['stock']);?></div>
			<div>
				説明
				<?php echo $this->escape($product['description']);?></div>
			<div>
				画像
				<?php echo $this->escape($product['image']);?></div>
		</div>
<input type="submit" value="詳細編集"/>
</form>
