<?php echo $this->render('front_bar',array('customer'=> $customer,));?>


<div id="mypage">

	<div id="pruchase_center">
		<h2>購入確認</h2>
		以下の内容で購入を確定します
		<div id="customer_info">
			<h3>お届け先</h3>
			<div>お名前
				<?php echo $this->escape($customer['customer_name']);?>
			</div>
			<div>住所
				<?php echo $this->escape($customer['customer_address']);?>
			</div>
			<div>番地
				<?php echo $this->escape($customer['customer_street']);?>
			</div>
			<div>住所番号
				<?php echo $this->escape($customer['customer_zipcode']);?>
			</div>
			<div>電話番号
				<?php echo $this->escape($customer['customer_tel']);?>
			</div>
			<div>email
				<?php echo $this->escape($customer['customer_email']);?>
			</div>
		</div>

		<div class="purchase_product">
			<h3>お品物</h3>
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
	<div class="right_bar">
		<h2>合計金額</h2>
		¥<?php echo number_format($sum_price);?>
		+¥<?php echo number_format($tax_price);?>
		= ¥<?php echo number_format($in_tax_Price);?>
		</form>

		<form action="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name']?>/order_conf" method="post">
		<input type="submit" value="購入確定">
		</form>
	</div>
</div>