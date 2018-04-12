<?php $this->setLayoutVar('title',$order['id'])?>
<form action="<?php echo $base_url;?>/order/<?php echo $this->escape($order['id']);?>/edit" method="get">
	<input type="hidden" name='id' value="<?php echo $this->escape($order['id']);?>"/>
	<ul>
		<li>
			注文番号
			<?php echo $this->escape($order['id']);?>
		</li>
		<li>
			注文商品
			<?php echo $this->escape($order['product_id']);?>		
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