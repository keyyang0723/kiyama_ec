	<div  class="product">
		<div class="product_name">
			<a href="<?php echo $base_url;?>/user/<?php echo $this->escape($product['name']);?>">
			<?php echo $this->escape($product['name']);?>
			</a>
			<?php echo $this->escape($product['description']);?>
		</div>
		<div>
			<a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($product['name']);
			?>/product/<?php echo $this->escape($product['name']);?>">
			<?php echo $this->escape($product['price']); ?>
			</a>
		</div>
	</div>