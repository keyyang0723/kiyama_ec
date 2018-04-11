<?php $this->setLayoutVar('title','確認画面')?>
<?php var_dump($_SESSION);?>

<h2>注文確認画面</h2>
<div>お名前
<?php echo $_SESSION['customer_name'];?>
</div>
<div>
住所
<?php echo $_SESSION['customer_address'];?>
</div>
<div>
番地
<?php echo $_SESSION['customer_street'];?>
</div>
<div>
住所番号
<?php echo $_SESSION['customer_zipcode'];?>
</div>
<div>
電話番号
<?php echo $_SESSION['customer_tel'];?>
</div>
<div>
email
<?php echo $_SESSION['customer_email'];?>
</div>
<ul>
お品物
<li>
	<?php echo $_SESSION['product']['image'] ;?>
</li>
<li>
<?php echo $_SESSION['product']['name'] ;?>
</li>

</ul>>
