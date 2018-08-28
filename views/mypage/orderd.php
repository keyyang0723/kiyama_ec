<?php echo $this->render('front_bar',array('customer'=> $customer,));?>


<div id="mypage">
	<div class="sidebar">
		<?php echo $this->render('mypage/mypage_sidebar',array('customer'=> $customer,));?>
	</div>
	<div id="center">
		<h2>購入履歴</h2>
		<div>
			<?php foreach($orderd_list as $order):?>
				<div class = "orderd">
					<div>
						<table style="width: 100%;">
							<tr>
								<th>購入日時</th>
								<th>購入金額</th>
								<th>お届け先</th>
							</tr>
							<tr >
								<td align="right">
								<?php $order['created_at'] = new DateTime(); echo  $order['created_at']->format('Y-m-d');?>
								</td>
								<td align="right">
								¥<?php echo number_format($order['price']);?>
								</td>
								<td align="center">
								<?php echo $order['customer_address'];?>
								<?php echo $order['customer_street'];?>
								<?php echo $order['customer_name'];?>
								</td>
							</tr>
						</table>
					</div>
					<div class="purchase_product">
						<?php foreach($orderd_detail_list as $orderd_detail):?>
							<?php foreach($orderd_detail as $product):?>
								<?php if($product['orders_id'] == $order['id']):?>
									<div class="orderd_product_contents">
										<?php if($product['is_displayed']==0):?>				
										<div class="orderd_image">							
											<?php if(isset($product['image_name'])):?>
											<a href="<?php echo $base_url;?>/<?php echo $this->escape($product['id']);?>/detail"><img class="sub" src =<?php echo '/image/'.$product['image_name'].'.jpg';?> ></a>
											<?php endif;?>
										</div>
										<div class="orderd_info">
											<ul class="product_contents">
												<a class="product_name"><?php echo $this->escape($product['name']);?></a>

												<li><?php echo '¥'.$this->escape(number_format($product['price'])).'+TAX';?></li>
												<li>
													<div class="amount">
													個数
													<?php echo $this->escape($product['amount']);?>
													</div>
												</li>
											</ul>
										</div>
										<?php endif;?>
									</div>
								<?php endif;?>
							<?php endforeach;?>
						<?php endforeach;?>
					</div>
				</div>
			<?php endforeach?>
		</div>
	</div>
</div>
</div>