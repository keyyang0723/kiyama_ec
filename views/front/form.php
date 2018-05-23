<?php $this->setLayoutVar('title','注文フォーム')?>

<div class="form">
	<form action="<?php echo $base_url;?>/conf" method="post">
		<input type="hidden" name="product_id" value="<?php echo $this->escape($product_id);?>" />
		<input type="hidden" name="number" value="<?php echo $this->escape($number);?>" />
		<?php if(isset($errors) && count($errors)>0): ?>
			<?php echo $this->render('errors',array('errors'=> $errors));?>
		<?php endif;?>	
			
		<div>名前<br/>
			<input type="text" name="customer_name" value="<?php echo $this->escape($customer_name);?>">
		</div>	
		<div>住所<br/>
			<input type="text" name="customer_address" value="<?php echo $this->escape($customer_address);?>" size="80">
		</div>			
		<div>番地<br/>
			<input type="text" name="customer_street" value="<?php echo $this->escape($customer_street);?>" size="80">
		</div>			
		<div>住所番号<br/>
			<input type="text" name="customer_zipcode" value="<?php echo $this->escape($customer_zipcode);?>" >
		</div>			
		<div>電話番号	<br/>
			<input type="text" name="customer_tel" value="<?php echo $this->escape($customer_tel);?>">
		</div>			
		<div>email<br/>
			<input type="text" name="customer_email" value="<?php echo $this->escape($customer_email);?>">
		</div>

		<input type="submit" value="注文確認画面へ" />
	</form>
</div>

