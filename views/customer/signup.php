<?php
$this->setLayoutVar('title','ユーザー登録')?>
<?php echo $this->render('front_bar',array('customer'=> $customer,));?>
<div id ="front">
	<div  id= "center">
		<h2>ユーザー登録</h2>

		<form action="<?php echo $base_url;?>/customer/register" method="post">
			<input type="hidden" name="_token" value="<?php echo $this->escape($_token);?>"/>
			<?php if(isset($errors) && count($errors)>0): ?>
			<?php echo $this->render('errors',array('errors'=> $errors));?>
			<?php endif;?>	
			<table>
				<tbody>
					<tr>
						<th>名前</th>
						<td>
							<input type="text" name="customer_name" 
							value="<?php echo $this->escape($customer_name);?>" />
						</td>
					</tr>
					<tr>
						<th>パスワード</th>
						<td>
							<input type="password" name="password" 
							value="<?php echo $this->escape($password);?>" />
						</td>
					</tr>
				</tbody>
			</table>

			<p>
				<input type="submit" value="登録" />
			</p>

			<p>
			 <a href="<?php echo $base_url;?>/customer/signin">ログインする</a>
			</p>
			<p>
				<a href = "<?php echo $base_url;?>/">ホームへ</a>
			</p>
		</form>
	</div>
</div>