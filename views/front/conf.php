<?php $this->setLayoutVar('title','確認画面')?>
<form action="<?php echo $base_url;?>/conf/post" method="post">

	<input type = "hidden" name = "customer_name"    value = "<?php echo $this->escape($customer_name);?>"/> 
	<input type = "hidden" name = "customer_address" value = "<?php echo $this->escape($customer_address);?>" />
	<input type = "hidden" name = "customer_street"  value = "<?php echo $this->escape($customer_street);?>" />
	<input type = "hidden" name = "customer_zipcode" value = "<?php echo $this->escape($customer_zipcode);?>" />
	<input type = "hidden" name = "customer_tel"     value = "<?php echo $this->escape($customer_tel);?>" />
	<input type = "hidden" name = "customer_email"   value = "<?php echo $this->escape($customer_email);?>" />
	<input type = "hidden" name = "product_id"       value = "<?php echo $this->escape($product_id);?>" />
	<input type = "hidden" name = "number"           value = "<?php echo $this->escape($number);?>" />
	<input type = "hidden" name = "price"            value = "<?php echo $this->escape($price);?>" />
	<input type = "hidden" name = "tax_rate"         value = "<?php echo $this->escape($tax_rate);?>" />

	<h2>注文確認画面</h2>
	<div>お名前
		<?php echo $this->escape($customer_name);?>
	</div>
	<div>住所
		<?php echo $this->escape($customer_address);?>
	</div>
	<div>番地
		<?php echo $this->escape($customer_street);?>
	</div>
	<div>住所番号
		<?php echo $this->escape($customer_zipcode);?>
	</div>
	<div>電話番号
		<?php echo $this->escape($customer_tel);?>
	</div>
	<div>email
		<?php echo $this->escape($customer_email);?>
	</div>

	<ul>
		お品物
		<li>
			<?php if(isset($product['image_name'])):?>
				<img src =<?php echo '/image/'.$product['image_name'].'.jpg';?> >
				<?php endif;?>
		</li>
		<li>
			<?php echo $product['name'];?>
		</li>
		<li>
			点数　<?php echo $number;?>点
		</li>
	</ul>

	<ul>
		お値段
		<li>
		<?php echo $product['price'];?>×<?php echo $number;?>+TAX＝
		<?php echo number_format($price);?>
		</li>
	</ul>
	<input type = "submit" value = "注文確定"/>
</form>
<form action = "<?php echo $base_url;?>/form" method = "get">
	<input type = "submit" value = "修正する"/>
</form>

