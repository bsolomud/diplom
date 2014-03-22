<!-- Left column -->
<div class="column-wrapper">
	<ul id="nav-bar">
		<?php foreach($navigation as $line) : ?>
		<li><a href="<?php echo $line["href"]; ?>"><?php echo $line["text"]; ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>