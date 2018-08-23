<?php $this->setLayoutVar('title',$product['name'])?>

<?php echo $this->render('back',array());?>
<div id = "front">
	<div id = "detail">	
		<div class = "detail_image">
			<?php if(isset($product['image_name'])):?>
			<img class = "detail" src =<?php echo '/image/'.$product['image_name'].'.jpg';?> >
			<?php endif;?>
		</div>

		<div class = "product_detail">
				<form action = "<?php echo $base_url;?>/form"  method = "post">
					<input type = "hidden" name="product_id" value = "<?php echo $this->escape($product_id);?>" />
		
				<ul class="product_detail">
					<h2><?php echo $this->escape($product['name']);?></h2>
					<li>price
						<?php echo '¥'.$this->escape(number_format($product['price'])).'+TAX';?>				
					</li>
					<li>stock
						<?php echo $this->escape($product['stock']);?>
						</li>
					<li>説明<br/>
						<a class="discription"><?php echo $this->escape($product['description']);?></a>
					</li>
				</ul>
					<div class="stock">
						個数を選択してください<br/>
						<?php if($product['stock']==0):?>
							<a class="soldout">SOLD OUT!!<br/></a>
						<?php else :?>
							<div class="select" style="width: 100%;">
								<select name = 'number' >
										<?php for($i = 1;$i <= $product['stock']; $i++ ):?>
										　<option value = "<?php echo $i;?>"/><?php echo $i;?></option>
										<?php endfor;?>					
								</select>
							</div>
					</div>
				<input class="detail" type = "submit" value = "購入する"/><br/>
				<?php endif?>
				<a href = "<?php echo $base_url;?>/">ホームへ戻る</a>
			</form>
			
		</div>
		
	</div>
</div>
