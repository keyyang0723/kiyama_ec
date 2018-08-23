<div id="nav">
 	<p class="link">
 		<a>ようこそ</a>
		<?php if($session->isAuthenticated()):?>
			<a>
				<?php echo $customer['customer_name'];?>
				様
			</a>
			<a href="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name'];?>">マイページ</a>
			<a href="<?php echo $base_url; ?>/customer/signout">ログアウト</a>
 		<?php else:?>
 			<a>ゲスト様</a>
 			<a href="<?php echo $base_url; ?>/customer/signin">ログインする</a>
 			<a href="<?php echo $base_url; ?>/customer/signup">アカウント登録</a>
 		<?php endif; ?>
 	</p>
 </div>		
