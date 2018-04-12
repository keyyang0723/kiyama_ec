<?php $this->setLayoutVar('title',$order['id'])?>
<form action="<?php echo $base_url;?>/order/<?php echo $this->escape($order['id']);?>/edit" method="post">
	<input type="hidden" name='id' value="<?php echo $this->escape($order['id']);?>"/>
	<ul>
		<li>
			注文番号
			<?php echo $this->escape($order['id']);?>
		</li>
		<li>
			注文商品
			<textarea name="product_id" rows="1" cols="60"><?php echo $this->escape($product_id);?></textarea>	
		</li>
		<li>
			顧客名
			<textarea name="customer_name" rows="1" cols="60"><?php echo $this->escape($customer_name);?></textarea>	
		</li>
		<li>
			住所
			<textarea name="customer_address" rows="1" cols="60"><?php echo $this->escape($customer_address);?></textarea>
		</li>	
		<li>
			番地
			<textarea name="customer_street" rows="1" cols="60"><?php echo $this->escape($customer_street);?></textarea>
		</li>
		<li>
			住所番号
			<textarea name="customer_zipcode" rows="1" cols="60"><?php echo $this->escape($customer_zipcode);?></textarea>
		</li>
		<li>
			電話番号
			<textarea name="customer_tel" rows="1" cols="60"><?php echo $this->escape($customer_tel);?></textarea>
		</li>
		<li>
			メールアドレス
			<textarea name="customer_email" rows="1" cols="60"><?php echo $this->escape($customer_email);?></textarea>
		</li>
		<li>
			料金
			<textarea name="price" rows="1" cols="60"><?php echo $this->escape($price);?></textarea>
		</li>
		<li>
			消費税率
			<textarea name="tax_rate" rows="1" cols="60"><?php echo $this->escape($tax_rate);?></textarea>%
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
<input type="submit" name="delite" value="削除する"/>
</form>