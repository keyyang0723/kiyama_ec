<?php $this->setLayoutVar('title','ホーム')?>
<?php echo $this->render('back',array());?>
<!-- 後日削除 -->
<form action="<?php echo $base_url;?>/search" method="post">
<?php echo $this->render('search',array('categories'=>$categories,'category_id'=>''));?>
<h3>検索結果</h3>
<div id="product">
	<?php foreach($products as $product):?>
		<?php if($product['is_displayed']==0):?>
			<form action="<?php echo $base_url;?>/<?php echo $this->escape($product['id']);?>/detail" method="get">
				<div class="product_contents">
					<ul>
						<li><?php echo $this->escape($product['name']);?></li>
						
							<?php if(isset($product['image_name'])):?>
							<img src =<?php echo '/image/'.$product['image_name'].'.jpg';?> >
							<?php endif;?>
						
						<li>price <?php echo $this->escape($product['price']);?></li>
						<li>stock <?php echo $this->escape($product['stock']);?></li>
						<li><?php echo $this->escape($product['description']);?></li>
					</ul>
					<input type="hidden" name="id" value="<?php echo $this->escape($product['id']);?>" />
					<input type="submit" value="商品詳細"/>
				</div>
			</form>
		<?php endif;?>
	<?php endforeach; ?>
</div>
