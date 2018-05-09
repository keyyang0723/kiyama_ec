<?php $this->setLayoutVar('title','検索結果')?>

<h2>検索結果</h2>

<?php echo $this->render('back',array());?>
<form action="<?php echo $base_url;?>/admin/search" method="post">
<?php echo $this->render('search',array('categories'=>$categories,'category_id'=>$category_id,'search_name'=>$search_name));?>
<?php if(isset($errors) && count($errors)>0): ?>
	<?php echo $this->render('errors',array('errors'=> $errors));?>
<?php else:?>
<h3>商品一覧</h3>
<div id="products">
	<?php foreach($products as $product):?>
		<form action="<?php echo $base_url;?>/admin/product/<?php echo $this->escape($product['id']);?>" method="post">
			<div class="product_contents">
				<ul>
					<li><?php echo $this->escape($product['name']);?></li>
					
						<?php if(isset($product['image_name'])):?>
						<img src =<?php echo '/image/'.$product['image_name'].'.jpg';?> class="product_image">
						<?php endif;?>
					<li>price <?php echo $this->escape($product['price']);?></li>
					<li>stock <?php echo $this->escape($product['stock']);?></li>
				<li><?php echo $this->escape($product['description']);?></li>
				<?php if($product['is_displayed']==1):?><li>非表示中！<?php endif;?></li>
			</ul>
			<input type="hidden" name="id" value="<?php echo $this->escape($product['id']);?>" />
						<input type="submit" value="詳細表示"/>
				
			</div>
		</form>
	<?php endforeach; ?>
</div>
<?php endif;?>	
