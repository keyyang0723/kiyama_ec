<?php echo $this->render('front_bar',array('customer'=> $customer,));?>


<div id="mypage">
	<div id="center">
		<div id="customer_info">
			<h2>配送先確認</h2>
			<div>お名前
				<?php echo $this->escape($customer['customer_name']);?>
			</div>
			<div>住所
				<?php echo $this->escape($customer['customer_address']);?>
			</div>
			<div>番地
				<?php echo $this->escape($customer['customer_street']);?>
			</div>
			<div>住所番号
				<?php echo $this->escape($customer['customer_zipcode']);?>
			</div>
			<div>電話番号
				<?php echo $this->escape($customer['customer_tel']);?>
			</div>
			<div>email
				<?php echo $this->escape($customer['customer_email']);?>
			</div>
			<form action="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name']?>/order_conf" method="get">
			<input type="submit" value="配送先確定">
			</form>
		</div>
	</div>
</div>