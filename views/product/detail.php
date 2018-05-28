<?php $this->setLayoutVar('title',$product['name'])?>
<?php echo $this->render('back',array());?>
<div id="front">
	<div id="detail">
		<div class="detail_image">
			<?php if(isset($product['image_name'])):?>
			<img class="detail" src =<?php echo '/image/'.$product['image_name'].'.jpg';?> >
			<?php endif;?>
		</div>

		<div class="product_detail">
			<form action="<?php echo $base_url;?>/admin/product/<?php echo $this->escape($product['id']);?>/edit" method="post">
				<input type="hidden" name="name" value="<?php echo $this->escape($product['name']);?>" />
				<input type="hidden" name="id" value="<?php echo $this->escape($product['id']);?>" />
				<input type="hidden" name="price" value="<?php echo $this->escape($product['price']);?>" />
				<input type="hidden" name="stock" value="<?php echo $this->escape($product['stock']);?>" />
				<input type="hidden" name="description" value="<?php echo $this->escape($product['description']);?>" />
				<input type="hidden" name="category_id" value="<?php echo $this->escape($product['category_id']);?>" />
				<input type="hidden" name="image" value="<?php echo $this->escape($product['image']);?>" />
				<input type="hidden" name="description" value="<?php echo $this->escape($product['description']);?>" />
				<input type="hidden" name="image_name" value="<?php echo $this->escape($product['image_name']);?>" />
				<input type="hidden" name="is_displayed" value="<?php echo $this->escape($product['is_displayed']);?>" />

			<h2><?php echo $this->escape($product['name']);?></h2>
			<ul class="product_detail">
				<li>管理番号
					<?php echo $this->escape($product['id']);?></li>

				<li>price
					<?php echo '¥'.$this->escape(number_format($product['price']));?></li>
				<li>
					stock
					<?php echo $this->escape($product['stock']);?></li>
				<li>
					説明<br/>
					<a class="discription"><?php echo $this->escape($product['description']);?></a></li>
				</ul>
					<input type="submit" class="detail" value="詳細編集"/>
			</form>
			<a href="<?php echo $base_url;?>/admin">ホームに戻る</a>
		</div>
	</div>
</div>
