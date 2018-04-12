<?php $this->setLayoutVar('title','ホーム')?>

<h2>ホーム</h2>

</form>
<h3>商品一覧</h3>
<div id="product">
	<?php foreach($products as $product):?>
		<?php if($product['is_displayed']==0):?>
			<form action="<?php echo $base_url;?>/front/<?php echo $this->escape($product['name']);?>/detail" method="get">
				<div class="product_conten">
					name <?php echo $this->escape($product['name']);?>
					price <?php echo $this->escape($product['price']);?>
					stock <?php echo $this->escape($product['stock']);?>
				</div>
				<div>
					<?php echo $this->escape($product['description']);?>
					<input type="hidden" name="id" value="<?php echo $this->escape($product['id']);?>" />
					<input type="submit" value="商品詳細"/>
				</div>
			</form>
		<?php endif;?>
	<?php endforeach; ?>
</div>
