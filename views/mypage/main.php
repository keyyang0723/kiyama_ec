<?php
//マイページの機能？　カート表示　ユーザー詳細　登録　表示 購入履歴

//カート　db から　配列で取得　foreachで列
?>

<?php echo $this->render('front_bar',array('customer'=> $customer,));?>


<div id="mypage">
	<div class="sidebar">
		<?php echo $this->render('mypage/mypage_sidebar',array('customer'=> $customer,));?>
	</div>
	<div id="center">
		<h2>会員情報</h2>

	<div>お名前
		<?php echo $this->escape($customer['customer_name']);?>
	</div>
	<div>パスワード
		＊＊＊＊＊＊＊
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
	<div>クレジットカード
		<?php echo $this->escape($customer['customer_creditcard_number']);?>
	</div>
	</div>
</div>