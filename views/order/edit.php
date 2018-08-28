<?php $this->setLayoutVar('title',$order['id'])?>
<?php echo $this->render('back',array());?>
<form action="<?php echo $base_url;?>/admin/order/<?php echo $this->escape($order['id']);?>/edit" method="post">
	<input type="hidden" name='id' value="<?php echo $this->escape($order['id']);?>"/>
	<?php if(isset($errors) && count($errors)>0): ?>
		<?php echo $this->render('errors',array('errors'=> $errors));?>
	<?php endif;?>
	<ul class="edit">
		<li>
			注文番号
			<?php echo $this->escape($order['id']);?>
		</li>
		<li>
			顧客名
			<input type="text" name="customer_name" value="<?php echo $this->escape($customer_name);?>">
		</li>
		<li>
			住所
			<input type="text" name="customer_address" value="<?php echo $this->escape($customer_address);?>" size="80">
		</li>	
		<li>
			番地
		<input type="text" name="customer_street" value="<?php echo $this->escape($customer_street);?>" size="80">
		</li>
		<li>
			住所番号
		<input type="text" name="customer_zipcode" value="<?php echo $this->escape($customer_zipcode);?>" >
		</li>
		<li>
			電話番号
		<input type="text" name="customer_tel" value="<?php echo $this->escape($customer_tel);?>">
		</li>
		<li>
			メールアドレス
		<input type="text" name="customer_email" value="<?php echo $this->escape($customer_email);?>">
		</li>
		<li>
			個数
			<input type="text" name="number" value="<?php echo $this->escape($number);?>">
		</li>
		<li>
			料金
			<input type="text" name="price" value="<?php echo $this->escape($price);?>">
		</li>
		<li>
			消費税率
			<input type="text" name="tax_rate" value="<?php echo $this->escape($tax_rate);?>">%
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