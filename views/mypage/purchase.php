<?php echo $this->render('front_bar',array('customer'=> $customer,));?>


<div id="mypage">
	<div class="sidebar">
		<?php echo $this->render('mypage/mypage_sidebar',array('customer'=> $customer,));?>
	</div>

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

								<li>price <?php echo '¥'.$this->escape(number_format($product['price'])).'+TAX';?></li>

								<li>
									<div class="stock">
									個数を選択してください<br/>
									<?php if($product['stock']==0):?>
										<a class="soldout">SOLD OUT!!<br/></a>
										<input type = "hidden" name="number" value = "0" />
									<?php else :?>
									<div class="select" style="width: 100%;">
										<form name = "selbox">
											<select name = 'amount' onChange ="amountChanged()">
												<?php for($i = 0;$i <= $product['stock']; $i++ ):?>
													　<option value = "<?php echo $i;?>" <?php if($i == $product['amount']){
														echo "selected";}?>/><?php echo $i;?></option>
												<?php endfor;?>					
											</select>
										</form>
									<?php endif?>
									</div>
								</li>

								<form action="<?php echo $base_url;?>/deletecart" method="post">
									<input type = "hidden" name="cart_id" value = "<?php echo $this->escape($product['cart_id']);?>" />
									<input type="submit" value="削除"/>
								</form>
							</ul>
						</div>
					<?php endif;?>
				</div>
			<?php endforeach;?>
		</div>
	</div>

	<div id="right_bar">
		<form action="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name']?>/purchase_conf" method="get">
		<input type="submit" value="レジに進む">
		</form>
	</div>
</div>


<script>

	function amountChanged(){
 	var a = document.selbox.amount.selectedIndex;
 	alert(a);

	}
</script>