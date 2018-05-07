<?php $this->setLayoutVar('title','注文一覧')?>
<?php echo $this->render('back',array());?>
<h2>注文一覧</h2>

<div id="product">
	<?php foreach($orders as $order):?>
		<form action="<?php echo $base_url;?>/admin/order/<?php echo $this->escape($order['id']);?>" method="post">
			<input type="hidden" name='id' value="<?php echo $this->escape($order['id']);?>"/>
			<div class="product_conten">
				注文番号　<?php echo $this->escape($order['id']);?>
				顧客名 <?php echo $this->escape($order['customer_name']);?>
				料金 <?php echo $this->escape($order['price']);?>
				注文日時 <?php echo $this->escape($order['created_at']);?>
				編集日時 <?php echo $this->escape($order['updated_at']);?>
			</div>
			<div>
				<input type="submit" value="詳細確認"/>
			</div>
		</form>
	<?php endforeach; ?>
</div>

