<?php $this->setLayoutVar('title','注文フォーム')?>

<form action="<?php echo $base_url;?>/conf" method="post">
	<input type="hidden" name="product_id" value="<?php echo $this->escape($product_id);?>" />
	<input type="hidden" name="number" value="<?php echo $this->escape($number);?>" />
<?php if(isset($errors) && count($errors)>0): ?>
	<?php echo $this->render('errors',array('errors'=> $errors));?>
<?php endif;?>	
名前
	<div>
		<input type="text" name="customer_name" value="<?php echo $this->escape($customer_name);?>">
	</div>
住所
	<div>	
		<input type="text" name="customer_address" value="<?php echo $this->escape($customer_address);?>" size="80">
	</div>
番地
	<div>	
		<input type="text" name="customer_street" value="<?php echo $this->escape($customer_street);?>" size="80">
	</div>
住所番号
	<div>	
		<input type="text" name="customer_zipcode" value="<?php echo $this->escape($customer_zipcode);?>" >
	</div>
電話番号
	<div>	
		<input type="text" name="customer_tel" value="<?php echo $this->escape($customer_tel);?>">
	</div>
email
	<div>	
		<input type="text" name="customer_email" value="<?php echo $this->escape($customer_email);?>">
	</div>

<input type="submit" value="注文確認画面へ" />
</form>
