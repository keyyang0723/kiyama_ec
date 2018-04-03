<?php $this->setLayoutVar('title','ホーム')?>

<h2>ホーム</h2>

</form>
<h3>商品一覧</h3>
<div id="product">
	<?php foreach($products as $product):?>
	<div class="product_conten">
		name <?php echo $this->escape($product['name']);?>
		price <?php echo $this->escape($product['price']);?>
		stock <?php echo $this->escape($product['stock']);?>
	</div>
	<div>
		<?php echo $this->escape($product['description']);?>
	<?php endforeach; ?>
</div>
