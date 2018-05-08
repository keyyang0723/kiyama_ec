<?php $this->setLayoutVar('title','ホーム')?>

<h2>ホーム</h2>

<?php echo $this->render('back',array());?>

</form>
<h3>商品一覧</h3>
<div id="product">
	<?php foreach($products as $product):?>
		<form action="<?php echo $base_url;?>/admin/product/<?php echo $this->escape($product['name']);?>" method="post">
			<div class="product_conten">
				<ul>
					name <?php echo $this->escape($product['name']);?>
					
						<?php if(isset($product['image_name'])):?>
						<img src =<?php echo '/image/'.$product['image_name'].'.jpg';?> >
						<?php endif;?>
					<li>price <?php echo $this->escape($product['price']);?></li>
					<li>stock <?php echo $this->escape($product['stock']);?></li>
				<li><?php echo $this->escape($product['description']);?></li>
				<?php if($product['is_displayed']==1):?><li>非表示中！<?php endif;?></li>
			</ul>
			<input type="hidden" name="name" value="<?php echo $this->escape($product['name']);?>" />
						<input type="submit" value="詳細表示"/>
				
			</div>
		</form>
	<?php endforeach; ?>
</div>
