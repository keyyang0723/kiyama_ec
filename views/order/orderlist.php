<?php $this->setLayoutVar('title','注文一覧')?>
<?php echo $this->render('back',array());?>
	<h2>注文一覧</h2>
<div id="order">
	<table class="order">
		<thead>
			<tr>
				<th>注文番号</th><th>顧客名</th><th>料金</th><th>注文日時</th><th>編集日時</th><th></th>
			</tr>
		</thead>

		<?php foreach($orders as $order):?>
			<tbody>
				<tr>
					<form action="<?php echo $base_url;?>/admin/order/<?php echo $this->escape($order['id']);?>" method="post">
								<input type="hidden" name='id' value="<?php echo $this->escape($order['id']);?>"/>
						
							<td><?php echo $this->escape($order['id']);?></td>
							<td><?php echo $this->escape($order['customer_name']);?></td>
							<td><?php echo $this->escape($order['price']);?></td>
							<td><?php echo $this->escape($order['created_at']);?></td>
							<td><?php echo $this->escape($order['updated_at']);?></td>
						
							<td>
								<input type="submit" value="詳細"/>	
							</td>
					</form>
				</tr>
			</tbody>
		<?php endforeach; ?>
	</table>
</div>

