<?php $this->setLayoutVar('title','ホーム')?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4">
			<form action="<?php echo $base_url;?>/search" method="post">
			<?php echo $this->render('search',array('categories'=>$categories,'category_id'=>'','search_name'=>''));?>
			</form>
		</div>
		<div class="col-sm-8 hidden-sm">
		<h3>商品一覧</h3>
			<div id="product">
				<?php foreach($products as $product):?>
					<?php if($product['is_displayed']==0):?>
						<form action="<?php echo $base_url;?>/<?php echo $this->escape($product['id']);?>/detail" method="post">
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
								<input type="hidden" name="product_id" value="<?php echo $this->escape($product['id']);?>" />
								<input type="submit" value="商品詳細"/>
							</div>
						</form>
					<?php endif;?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
