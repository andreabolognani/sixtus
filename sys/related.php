<!-- Related --><div class="section">
<?php
	$prev = $p->prev();
	if ($prev) {
		echo ('<div class="inside"><p>');
		echo ($d->link($prev[0], $prev[1], $prev[2], $prev[3]));
		echo (' / <span class="em">Precedente</span>');
		echo ('</p></div>');
	}
?>
	<p style="text-align: center">
		/ <span class="em">
		<?=$d->link($sum, $search['canonical'])?>
		</span> /
	</p>
<?php
	$next = $p->next();
	if ($next) {
		echo('<div class="outside"><p class="reverse">');
		echo ('<span class="em">Successivo</span> / ');
		echo ($d->link($next[0], $next[1], $next[2], $next[3]));
		echo ('</p></div>');
	}
?>
</div><!-- /Related -->