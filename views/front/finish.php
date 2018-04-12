<?php $this->setLayoutVar('title','注文完了')?>

<h2>以下の内容で注文いたしました</h2>

<div>お名前
	<?php echo $this->escape($_SESSION['customer_name']);?>
</div>
<div>住所
	<?php echo $this->escape($_SESSION['customer_address']);?>
</div>
<div>番地
	<?php echo $this->escape($_SESSION['customer_street']);?>
</div>
<div>住所番号
	<?php echo $this->escape($_SESSION['customer_zipcode']);?>
</div>
<div>電話番号
	<?php echo $this->escape($_SESSION['customer_tel']);?>
</div>
<div>email
	<?php echo $this->escape($_SESSION['customer_email']);?>
</div>
<div>お品物
	<ul>
		<li>
			<?php echo $_SESSION['product']['image'] ;?>
		</li>
		<li>
			<?php echo $_SESSION['product']['name'] ;?>
		</li>
		<li>
			点数　<?php echo $_SESSION['number'];?>点
		</li>
	お値段
		<li>
			<?php echo $_SESSION['product']['price'];?>×<?php echo $_SESSION['number'];?>+TAX＝
			<?php $price = $_SESSION['product']['price']*$_SESSION['number']*$_SESSION['tax_rate'];echo $price;?>
		</li>

<h3>またのご利用お待ちしております</h3>
