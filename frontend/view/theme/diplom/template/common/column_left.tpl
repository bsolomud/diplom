<!-- Left column -->
<div class="column-wrapper">
	<a id="column-switcher"class="column-switcher" href="javascript: void(0);" title="<?php echo $full_mode; ?>"></a>
	<ul>
		<?php foreach($navigation as $line) : ?>
		<li><a class="<?php echo $line["class"]; ?>" href="<?php echo $line["href"]; ?>"><span><?php echo $line["text"]; ?></span></a></li>
		<?php endforeach; ?>
	</ul>
</div>