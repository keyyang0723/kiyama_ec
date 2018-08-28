<?php $this->setLayoutVar('title',$order['id'])?>
<?php echo $this->render('back',array());?>
<h3>注文詳細</h3>
<form action="<?php echo $base_url;?>/admin/order/<?php echo $this->escape($order['id']);?>/edit" method="get">
	<input type="hidden" name='id' value="<?php echo $this->escape($order['id']);?>"/>
	<ul>
		<li>
			注文番号
			<?php echo $this->escape($order['id']);?>
		</li>
		<li>
			顧客名
			<?php echo $this->escape($order['customer_name']);?>
		</li>
		<li>
			住所
			<?php echo $this->escape($order['customer_address']);?>
		</li>	
		<li>
			番地
			<?php echo $this->escape($order['customer_street']);?>
		</li>
		<li>
			住所番号
			<?php echo $this->escape($order['customer_zipcode']);?>
		</li>
		<li>
			電話番号
			<?php echo $this->escape($order['customer_tel']);?>
		</li>
		<li>
			メールアドレス
			<?php echo $this->escape($order['customer_email']);?>
		</li>
		<li>
			個数
			<?php echo $this->escape($order['number']);?>
		</li>
		<li>
			料金
			<?php echo $this->escape($order['price']);?>
		</li>
		<li>
			消費税率
			<?php echo $this->escape($order['tax_rate']);?>%
		</li>
		<li>
			注文日時
			<?php echo $this->escape($order['created_at']);?>
		</li>
		<li>
			編集日時
			<?php echo $this->escape($order['updated_at']);?>
		</li>
	</ul> 
<input type="submit" value="編集する"/>
</form>

<h3>注文商品</h3>
<div class="purchase_product">
	<?php foreach($orderd_detail_list as $orderd_detail):?>
		<?php foreach($orderd_detail as $product):?>
			<?php if($product['orders_id'] == $order['id']):?>
				<div class="orderd_product_contents">
					<?php if($product['is_displayed']==0):?>				
					<div class="orderd_image">							
						<?php if(isset($product['image_name'])):?>
						<a ><img class="sub" src =<?php echo '/image/'.$product['image_name'].'.jpg';?> ></a>
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