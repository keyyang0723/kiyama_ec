<?php $this->setLayoutVar('title','ホーム')?>

<h2>ホーム</h2>

</form>
<h3>商品一覧</h3>
<div id="product">
	<?php foreach($products as $product):?>
	<form action="<?php echo $base_url;?>/product/<?php echo $this->escape($product['name']);?>" method="post">
	<div class="product_conten">
		name <?php echo $this->escape($product['name']);?>
		price <?php echo $this->escape($product['price']);?>
		stock <?php echo $this->escape($product['stock']);?>
	</div>
	<div>
		<?php echo $this->escape($product['description']);?>
		<input type="hidden" name="name" value="<?php echo $this->escape($product['name']);?>" />
		<input type="submit" value="詳細表示"/>
	</div>
	</form>
	<?php endforeach; ?>
</div>
