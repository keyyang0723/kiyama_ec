<?php $this->setLayoutVar('title','ホーム')?>
<?php echo $this->render('front_bar',array('customer'=> $customer,));?>

<div id="front">

	<div class="sidebar">
		<form  action="<?php echo $base_url;?>/search" method="post">
			<?php echo $this->render('search',array('categories'=>$categories,'category_id'=>'','search_name'=>''));?>
		</form>
	</div>
		
	<div id="center">
		<h2>商品一覧</h2>

		<div class="pager">
			<?php if($prev_page>=1):?>
				<a href="<?php echo $base_url;?>/?page=<?php echo $prev_page; ?>"><?php echo ' < '; ?></a>
			<?php else:?>
				<?php echo ' < '; ?>
			<?php endif;?>
			<?php for($i=1;$i<=$last_page;$i++):?>
				<a href="<?php echo $base_url;?>/?page=<?php echo $i; ?>"><?php echo $i.' '; ?></a>
			<?php endfor;?>
			<?php if($next_page <= $last_page):?>
				<a href="<?php echo $base_url;?>/?page=<?php echo $next_page; ?>"><?php echo ' > '; ?></a>
			<?php else:?>
				<?php echo ' > '; ?>
			<?php endif;?>
		</div>
		<div class="product">
			<?php foreach($products as $product):?>
				<div class="product_contents">
					<?php if($product['is_displayed']==0):?>
						
							<div class="image">							
								<?php if(isset($product['image_name'])):?>
								<a href="<?php echo $base_url;?>/<?php echo $this->escape($product['id']);?>/detail"><img class="main" src =<?php echo '/image/'.$product['image_name'].'.jpg';?> ></a>
								<?php endif;?>
							</div>
							<ul class="product_contents">
							<a class="product_name" href="<?php echo $base_url;?>/<?php echo $this->escape($product['id']);?>/detail"><?php echo $this->escape($product['name']);?></a>
							<li>price <?php echo '¥'.$this->escape(number_format($product['price'])).'+TAX';?></li>
							<li><?php if($product['stock'] == 0):?>
								<a style = "color:red;"">SOLD OUT!!<br/></a>
								<?php else:?>
								stock <?php echo $this->escape($product['stock']);?>
								</li>
								<form action="<?php echo $base_url;?>/insertcart" method="post">
							<input type = "hidden" name="product_id" value = "<?php echo $this->escape($product['id']);?>" />
							<input type = "hidden" name = "path" value = "/"?>
							<input type = "hidden" name = "amount" value = "1"?>
							<i class="fas fa-cart-plus">
							<input type="submit" value="カートに入れる"/></i>
						</form>
						<?php endif;?>
								 
					<?php endif;?>
				</ul>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="pager">
			<?php if($prev_page>=1):?>
				<a href="<?php echo $base_url;?>/?page=<?php echo $prev_page; ?>"><?php echo ' < '; ?></a>
			<?php else:?>
				<?php echo ' < '; ?>
			<?php endif;?>
			<?php for($i=1;$i<=$last_page;$i++):?>
				<a href="<?php echo $base_url;?>/?page=<?php echo $i; ?>"><?php echo $i.' '; ?></a>
			<?php endfor;?>
			<?php if($next_page <= $last_page):?>
				<a href="<?php echo $base_url;?>/?page=<?php echo $next_page; ?>"><?php echo ' > '; ?></a>
			<?php else:?>
				<?php echo ' > '; ?>
			<?php endif;?>
		</div>
	</div>
</div>
	

