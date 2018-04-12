<?php $this->setLayoutVar('title',$product['name'])?>


<form action="<?php echo $base_url;?>/front/form" method="get">
	<input type="hidden" name="id" value="<?php echo $this->escape($product['id']);?>" />
		<div class="status_content">
			<h2><?php echo $this->escape($product['name']);?></h2>

			<div>
				画像
				<?php echo $this->escape($product['image']);?></div>
			</div>
			<ul>
				<li>price
					<?php echo $this->escape($product['price']);?>				
				</li>
				<li>stock
					<?php echo $this->escape($product['stock']);?>
					</li>
				<li>説明
					<?php echo $this->escape($product['description']);?>	
				</li>
			</ul>
			<div>
				個数を選択してください
				<select name='number'>
					<?php for($i=1;$i<=$product['stock'];$i++):?>
					<option value="<?php echo $i;?>"/><?php echo $i;?></option>
				<?php endfor;?>
				</select>
			</div>



<input type="submit" value="購入する"/>
</form>
