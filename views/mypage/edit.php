<?php echo $this->render('front_bar',array('customer'=> $customer,));?>

<div id="mypage">
	<div class="sidebar">
			<?php echo $this->render('mypage/mypage_sidebar',array('customer'=> $customer,));?>
		</div>
	<div id="center">
		<div class="form">
			<form action="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name']?>/edit" method="post">
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
					<input type="text" name="customer_email" value="<?php echo $this->escape($customer_email);?>" size="80">
				</div>

				<input type="submit" value="編集する" />
			</form>
		</div>
	</div>
</div>