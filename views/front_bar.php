<div id="nav">
 	<p class="link">
		<?php if($session->isAuthenticated()):?>
			<div class="left">
				<a>ようこそ</a>
				<a>
					<?php echo $customer['customer_name'];?>
					様
				</a>
				<a href="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name']?>/purchase"><i class="fas fa-shopping-cart"></i>カートを見る</a>
			</div>
			<div class = "right">
				<a  href="<?php echo $base_url;?>/mypage/<?php echo $customer['customer_name'];?>">マイページ</a>
				<a  href="<?php echo $base_url; ?>/customer/signout">ログアウト</a>
			</div>
 		<?php else:?>
 			<div class="left">
 				<a>ようこそ</a>
 				<a>ゲスト様</a>
 			</div>
 			<div class = "right">
	 			<a class ="right" href="<?php echo $base_url; ?>/customer/signin">ログインする</a>
	 			<a class ="right" href="<?php echo $base_url; ?>/customer/signup">アカウント登録</a>
	 		</div>
 		<?php endif; ?>
 	</p>
 </div>		
