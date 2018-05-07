<?php $this->setLayoutVar('title','アカウント')?>
<?php echo $this->render('back',array());?>
<h2>アカウント</h2>

<p>
	 ユーザID:
	 <?php var_dump($admin,$_SESSION);?>
	 <a href="<?php echo $base_url;?>/admin/<?php echo $this->escape($admin['user_
	 name']); ?>">
	 <strong><?php echo $this->escape($admin['user_name']);?></strong>
	</a>
</p>

<ul>
	<li>
		<a href="<?php echo $base_url; ?>/">ホーム</a>
	</li>
	<li>
		<a href="<?php echo $base_url; ?>/account/signout">ログアウト</a>
	</li>
</ul>
