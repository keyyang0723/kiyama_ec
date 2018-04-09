<?php $this->setLayoutVar('title','注文フォーム')?>
<?php var_dump($product);?>
<form action="<?php echo $base_url;?>/front/<?php echo $this->escape($product['id']);?>" method="post">
	
	<input type="hidden" name="id" value="<?php echo $this->escape($product['id']);?>" >
	<input type="hidden" name="form" value="form" >

<?php if(isset($errors) && count($errors)>0): ?>
	<?php echo $this->render('errors',array('errors'=> $errors));?>
<?php endif;?>	
名前
	<div>
		<textarea name="customer_name" rows="1" cols="60"><?php echo $this->escape($customer_name);?></textarea>
	</div>
住所
	<div>	
		<textarea name="customer_address" rows="1" cols="60"><?php echo $this->escape($customer_address);?></textarea>
	</div>
番地
	<div>	
		<textarea name="customer_street" rows="1" cols="60"><?php echo $this->escape($customer_street);?></textarea>
	</div>
住所番号
	<div>	
		<textarea name="customer_zipcode" rows="1" cols="60"><?php echo $this->escape($customer_zipcode);?></textarea>
	</div>
電話番号
	<div>	
		<textarea name="customer_tel" rows="1" cols="60"><?php echo $this->escape($customer_tel);?></textarea>
	</div>
email
	<div>	
		<textarea name="customer_email" rows="1" cols="60"><?php echo $this->escape($customer_email);?></textarea>
	</div>

<input type="submit" value="注文確認画面へ" />
</form>
