<div id="nav">
 	<p>
		<?php if($session->isAuthenticated()):?>
			<a href="<?php echo $base_url;?>/admin">ホーム</a>
			<a href="<?php echo $base_url;?>/admin/product/regist">商品登録</a>
			<a href="<?php echo $base_url;?>/admin/category">カテゴリ編集</a>
			<a href="<?php echo $base_url;?>/admin/order">注文確認</a>
			<a href="<?php echo $base_url; ?>/account/signout">ログアウト</a>
			<a href="<?php echo $base_url; ?>/">フロントページ</a>
 		<?php else:?>
 			<a href="<?php echo $base_url; ?>/account/signin">ログイン</a>
 			<a href="<?php echo $base_url; ?>/account/signup">アカウント登録</a>
 		<?php endif; ?>
 	</p>
 </div>		