<?php echo $this->render('front_bar',array('customer'=> $customer,));?>

<div id="mypage">
	<div class="sidebar">
		<?php echo $this->render('mypage/mypage_sidebar',array('customer'=> $customer,));?>
	</div>
	<div id="center">
		<h2>カート内一覧</h2>
		<?php if(count($cart_items) == 0 ):?>
				<h2>・現在カートは空です</h2>
		<?php else:?>
		<div class="buy">
			<a href="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name']?>/purchase">購入画面へ</a>
		</div>

		<div class="product">

			<?php foreach($cart_items as $product):?>
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
								<div class="stock">
									個数
									<?php if($product['stock']==0):?>
										<a class="soldout">SOLD OUT!!<br/></a>
										<input type = "hidden" name="number" value = "0" />
									<?php else :?>
									<div class="select" style="width: 100%;">
										<form action="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name']?>/cart_change" method = "post"> 
											<input type="hidden" name="cart_id" value = "<?php echo $product['cart_id']?>">
											<select name = 'amount' onChange ="this.form.submit()">
												<?php for($i = 1;$i <= $product['stock']; $i++ ):?>
													　<option value = "<?php echo $i;?>" <?php if($i == $product['amount']){
														echo "selected";}?>/><?php echo $i;?></option>
												<?php endfor;?>					
											</select>
										</form>
									<?php endif?>
									</div>
								<?php endif;?></li>

							<form action="<?php echo $base_url;?>/deletecart" method="post">
								<input type = "hidden" name="cart_id" value = "<?php echo $this->escape($product['cart_id']);?>" />
								<input type="hidden" name="path" value = "/cart">
								<input type="submit" value="カートから削除"/>
							</form>
						</ul>
						
					<?php endif;?>
				</div>
			<?php endforeach;?>
		</div>
		<div class="buy">
			<a href="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name']?>/purchase">購入画面へ</a>
		</div>
	<?php endif?>
	</div>
</div>