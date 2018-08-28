
<?php echo $this->render('front_bar',array('customer'=> $customer,));?>


<div id="mypage">
	<div class="sidebar">
		<?php echo $this->render('mypage/mypage_sidebar',array('customer'=> $customer,));?>
	</div>
	<div id="center">
		<h2>会員情報</h2>

		<?php if(isset($errors) && count($errors)>0): ?>
			<?php echo $this->render('errors',array('errors'=> $errors));?>
		<?php endif;?>	

		<div>お名前
		<p>・<?php echo $this->escape($customer['customer_name']);?></p>
		</div>
		<div>パスワード
			<p>・＊＊＊＊＊＊＊</p>
		</div>
		<div>住所
			<p>・<?php echo $this->escape($customer['customer_address']);?></p>
		</div>
		<div>番地
			<p>・<?php echo $this->escape($customer['customer_street']);?></p>
		</div>
		<div>住所番号
			<p>・<?php echo $this->escape($customer['customer_zipcode']);?></p>
		</div>
		<div>電話番号
			<p>・<?php echo $this->escape($customer['customer_tel']);?></p>
		</div>
		<div>email
			<p>・<?php echo $this->escape($customer['customer_email']);?></p>
		</div>
		
		<a href="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name']?>/edit">編集する</a>
	</div>
</div>