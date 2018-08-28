<?php echo $this->render('front_bar',array('customer'=> $customer,));?>


<div id="mypage">


	<div id="pruchase_center">
		<h2>購入確認</h2>
		<div class="purchase_product">
			<?php foreach($cart_items as $product):?>
				<div class="purchase_product_contents">
					<?php if($product['is_displayed']==0):?>				
						<div class="purchase_image">							
							<?php if(isset($product['image_name'])):?>
							<a href="<?php echo $base_url;?>/<?php echo $this->escape($product['id']);?>/detail"><img class="main" src =<?php echo '/image/'.$product['image_name'].'.jpg';?> ></a>
							<?php endif;?>
						</div>
						<div class="product_detail">
							<ul class="product_contents">
								<a class="product_name"><?php echo $this->escape($product['name']);?></a>

								<li><?php echo '¥'.$this->escape(number_format($product['price'])).'+TAX';?></li>

								<li>
									<div class="amount">
									個数
									<?php echo $this->escape($product['amount']);?>
								</li>
							</ul>
						</div>
					<?php endif;?>
				</div>
			<?php endforeach;?>
		</div>	
	</div>
	<div id="right_bar">
	</div>
		<h2>合計金額</h2>
		¥<?php echo number_format($sum_price);?>

		<form action="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name']?>/address_conf" method="get">
		<input type="submit" value="確定">
		</form>
	</div>
</div>