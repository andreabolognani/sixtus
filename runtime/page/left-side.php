<?php
	function display_left_side ($attr, $list)
	{
		$i = 0;
		foreach ($list as $e)
		{
			if ($i++) printf('%s', '<div class="spacer"></div>');
			require_once(docroot().$e);
		}
	}
	
	display_left_side ($attr, $leftside);
?>
