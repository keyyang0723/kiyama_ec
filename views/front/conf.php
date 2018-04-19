<?php $this->setLayoutVar('title','確認画面')?>
<form action="<?php echo $base_url;?>/conf" method="post">
	<h2>注文確認画面</h2>
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

	<ul>
		お品物
		<li>
			<?php echo $_SESSION['product']['image'] ;?>
		</li>
		<li>
			<?php echo $_SESSION['product']['name'] ;?>
		</li>
		<li>
			点数　<?php echo $_SESSION['number'];?>点
		</li>
	</ul>

	<ul>
		お値段
		<li>
		<?php echo $_SESSION['product']['price'];?>×<?php echo $_SESSION['number'];?>+TAX＝
		<?php $price = $_SESSION['product']['price']*$_SESSION['number']*$_SESSION['tax_rate'];echo $price;?>
		</li>
	</ul>
	<input type="submit" value="注文確定"/>
</form>
<form action="<?php echo $base_url;?>/form" method="get">
	<input type="hidden" name="id" value="<?php echo $this->escape($_SESSION['product']['id']);?>" />
	<input type="hidden" name="number" value="<?php echo $this->escape($_SESSION['number']);?>" />
	<input type="submit" value="修正する"/>
</form>

