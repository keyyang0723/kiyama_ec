<?php $this->setLayoutVar('title','ホーム')?>

<?php echo $this->render('back',array());?>
<div id="front">

	<div id="sidebar">
		<form  action="<?php echo $base_url;?>/admin/search" method="post">
		<?php echo $this->render('search',array('categories'=>$categories,'category_id'=>$category_id,'search_name'=>$search_name));?>
		</form>
	</div>

	<div id="center">
		<h2>商品一覧</h2>

		<div class="pager">
			<?php if($prev_page>=1):?>
				<a href="<?php echo $base_url;?>/admin?page=<?php echo $prev_page; ?>"><?php echo ' < '; ?></a>
			<?php else:?>
				<?php echo ' < '; ?>
			<?php endif;?>
			<?php for($i=1;$i<=$last_page;$i++):?>
				<?php if($i == $now_page):?>
					<a><?php echo $i.' '; ?></a>
				<?php else:?>
					<a href="<?php echo $base_url;?>/admin?page=<?php echo $i; ?>"><?php echo $i.' '; ?></a>
				<?php endif?>
			<?php endfor;?>
			<?php if($next_page <= $last_page):?>
				<a href="<?php echo $base_url;?>/admin?page=<?php echo $next_page; ?>"><?php echo ' > '; ?></a>
			<?php else:?>
				<?php echo ' > '; ?>
			<?php endif;?>
		</div>

		<div class="product">
			<?php foreach($products as $product):?>
				<div class="product_contents">
					<div class="image">
						<?php if(isset($product['image_name'])):?>
						<a href="<?php echo $base_url;?>/admin/product/<?php echo $this->escape($product['id']);?>"><img class="main" src =<?php echo '/image/'.$product['image_name'].'.jpg';?> class="product_image"></a>
						<?php endif;?>
					</div>
					<ul class="product_contents">
							<a class="product_name"><?php echo $this->escape($product['name']);?></a>
							<li>price <?php echo '¥'.$this->escape(number_format($product['price']));?></li>
							<li>stock <?php echo $this->escape($product['stock']);?></li>
							<!-- <li><?php echo $this->escape($product['description']);?></li> -->
							<?php if($product['is_displayed']==1):?><li style="color:red;">非表示中！<?php endif;?></li>
						
						<form action="<?php echo $base_url;?>/admin/product/<?php echo $this->escape($product['id']);?>" method="post">
							<input type="submit" value="詳細表示" />					
						</form>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="pager">
			<?php if($prev_page>=1):?>
				<a href="<?php echo $base_url;?>/admin?page=<?php echo $prev_page; ?>"><?php echo ' < '; ?></a>
			<?php else:?>
				<?php echo ' < '; ?>
			<?php endif;?>
			<?php for($i=1;$i<=$last_page;$i++):?>
				<?php if($i == $now_page):?>
					<a><?php echo $i.' '; ?></a>
				<?php else:?>
					<a href="<?php echo $base_url;?>/admin?page=<?php echo $i; ?>"><?php echo $i.' '; ?></a>
				<?php endif?>
			<?php endfor;?>
			<?php if($next_page <= $last_page):?>
				<a href="<?php echo $base_url;?>/admin?page=<?php echo $next_page; ?>"><?php echo ' > '; ?></a>
			<?php else:?>
				<?php echo ' > '; ?>
			<?php endif;?>
		</div>
	</div>
</div>

