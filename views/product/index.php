<?php $this->setLayoutVar('title','ホーム')?>

<?php echo $this->render('back',array());?>
<div id="front">

	<div id="sidebar">
		<form  action="<?php echo $base_url;?>/admin/search" method="post">
		<?php echo $this->render('search',array('categories'=>$categories,'category_id'=>'','search_name'=>''));?>
		</form>
	</div>

	<div id="center">
		<h3>商品一覧</h3>

		<div class="pager">
			<?php if($prev_page>=1):?>
				<a href="<?php echo $base_url;?>/admin?page=<?php echo $prev_page; ?>"><?php echo ' < '; ?></a>
			<?php else:?>
				<?php echo ' < '; ?>
			<?php endif;?>
			<?php for($i=1;$i<=$last_page;$i++):?>
				<a href="<?php echo $base_url;?>/admin?page=<?php echo $i; ?>"><?php echo $i.' '; ?></a>
			<?php endfor;?>
			<?php if($next_page <= $last_page):?>
				<a href="<?php echo $base_url;?>/admin?page=<?php echo $next_page; ?>"><?php echo ' > '; ?></a>
			<?php else:?>
				<?php echo ' > '; ?>
			<?php endif;?>
		</div>

		<div class="product">
			<?php foreach($products as $product):?>
				<ul class="product_contents">
					<form action="<?php echo $base_url;?>/admin/product/<?php echo $this->escape($product['id']);?>" method="get">
							<div class="hoge">
								<?php if(isset($product['image_name'])):?>
								<img class="main"src =<?php echo '/image/'.$product['image_name'].'.jpg';?> class="product_image">
								<?php endif;?>
							</div>
							<li><?php echo $this->escape($product['name']);?></li>
							<li>price <?php echo $this->escape($product['price']);?></li>
							<li>stock <?php echo $this->escape($product['stock']);?></li>
							<!-- <li><?php echo $this->escape($product['description']);?></li> -->
							<?php if($product['is_displayed']==1):?><li>非表示中！<?php endif;?></li>
						
						<input type="hidden" name="id" value="<?php echo $this->escape($product['id']);?>" />
						<input type="submit" value="詳細表示"/>					
					</form>
				</ul>
			<?php endforeach; ?>
		</div>
		<div class="pager">
			<?php if($prev_page>=1):?>
				<a href="<?php echo $base_url;?>/admin?page=<?php echo $prev_page; ?>"><?php echo ' < '; ?></a>
			<?php else:?>
				<?php echo ' < '; ?>
			<?php endif;?>
			<?php for($i=1;$i<=$last_page;$i++):?>
				<a href="<?php echo $base_url;?>/admin?page=<?php echo $i; ?>"><?php echo $i.' '; ?></a>
			<?php endfor;?>
			<?php if($next_page <= $last_page):?>
				<a href="<?php echo $base_url;?>/admin?page=<?php echo $next_page; ?>"><?php echo ' > '; ?></a>
			<?php else:?>
				<?php echo ' > '; ?>
			<?php endif;?>
		</div>
	</div>
</div>

