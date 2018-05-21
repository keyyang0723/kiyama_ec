<?php $this->setLayoutVar('title','ホーム')?>
<div id="front">
	<div id="sidebar">
		<form action="<?php echo $base_url;?>/search" method="post">
		<?php echo $this->render('search',array('categories'=>$categories,'category_id'=>$category_id,'search_name'=>$search_name));?>
		</form>
	</div>
	<div id="center">
		<h3>検索結果</h3>

		<div class="pager">
			<?php if($prev_page>=1):?>
				<a href="<?php echo $base_url;?>/admin/search?page=<?php echo $prev_page; ?>"><?php echo ' < '; ?></a>
			<?php else:?>
				<?php echo ' < '; ?>
			<?php endif;?>
			<?php for($i=1;$i<=$last_page;$i++):?>
				<a href="<?php echo $base_url;?>/admin/search?page=<?php echo $i; ?>"><?php echo $i.' '; ?></a>
			<?php endfor;?>
			<?php if($next_page <= $last_page):?>
				<a href="<?php echo $base_url;?>/admin/search?page=<?php echo $next_page; ?>"><?php echo ' > '; ?></a>
			<?php else:?>
				<?php echo ' > '; ?>
			<?php endif;?>
		</div>

		<div id="product">
			<?php if(isset($errors) && count($errors)>0): ?>
				<?php echo $this->render('errors',array('errors'=> $errors));?>
			<?php else:?>
				<?php foreach($products as $product):?>
					<ul class="product_contents">
						<?php if($product['is_displayed']==0):?>
							<form action="<?php echo $base_url;?>/<?php echo $this->escape($product['id']);?>/detail" method="get">	
								<div class="hoge">
									<?php if(isset($product['image_name'])):?>
									<img class="main" src =<?php echo '/image/'.$product['image_name'].'.jpg';?> class="product_image">
									<?php endif;?>
								</div>
								<li><?php echo $this->escape($product['name']);?></li>						
								<li>price <?php echo $this->escape($product['price']);?></li>
								<li>stock <?php echo $this->escape($product['stock']);?></li>
								<li><?php echo $this->escape($product['description']);?></li>
								<input type="hidden" name="product_id" value="<?php echo $this->escape($product['id']);?>" />
								<input type="submit" value="商品詳細"/>
							</form>
						<?php endif;?>
					</ul>
				<?php endforeach; ?>
			<?php endif;?>
		</div>
		<div class="pager">
			<?php if($prev_page>=1):?>
				<a href="<?php echo $base_url;?>/admin/search?page=<?php echo $prev_page; ?>"><?php echo ' < '; ?></a>
			<?php else:?>
				<?php echo ' < '; ?>
			<?php endif;?>
			<?php for($i=1;$i<=$last_page;$i++):?>
				<a href="<?php echo $base_url;?>/admin/search?page=<?php echo $i; ?>"><?php echo $i.' '; ?></a>
			<?php endfor;?>
			<?php if($next_page <= $last_page):?>
				<a href="<?php echo $base_url;?>/admin/search?page=<?php echo $next_page; ?>"><?php echo ' > '; ?></a>
			<?php else:?>
				<?php echo ' > '; ?>
			<?php endif;?>
		</div>
	</div>
</div>

