<ul class="error_list">
	 <?php foreach ($errors as $error): ?>
	 <li><?php echo $this->escape($error);?></li><br/>
	<?php endforeach; ?>
</ul>
	