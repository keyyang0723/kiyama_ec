<?php $this->setLayoutVar('title',$product['name'])?>
<?php echo $this->render('front_bar',array('customer'=> $customer,));?>
<div id = "front">
	<div id = "detail">	
		<div class = "detail_image">
			<?php if(isset($product['image_name'])):?>
			<img class = "detail" src =<?php echo '/image/'.$product['image_name'].'.jpg';?> >
			<?php endif;?>
		</div>

		<div class = "product_detail">
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
				<form action="<?php echo $base_url;?>/insertcart" method="post">
					<div class="stock">
						個数を選択してください<br/>
						<?php if($product['stock']==0):?>
							<a class="soldout">SOLD OUT!!<br/></a>
						<?php else :?>
							<div class="select" style="width: 100%;">
								<select name = 'amount' >
										<?php for($i = 1;$i <= $product['stock']; $i++ ):?>
										　<option value = "<?php echo $i;?>"/><?php echo $i;?></option>
										<?php endfor;?>					
								</select>
							</div>
						
								<input type = "hidden" name="product_id" value = "<?php echo $this->escape($product['id']);?>" />
								<input type = "hidden" name ="path" value = "<?php echo $path_info;?>">
								<i class="fas fa-cart-plus"></i>
								<input type="submit" value="カートに入れる"/>
						<?php endif?>
					</div>
				</form>
						
				<a href = "<?php echo $base_url;?>/">ホームへ戻る</a>
		</div>	
	</div>
</div>
