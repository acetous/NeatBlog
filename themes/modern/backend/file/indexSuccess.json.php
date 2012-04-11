{ "files": [<?php
	foreach ($files as $i => $file) {
		echo ($i > 0 ? ', ' : '') . '"'.$file.'"';
	}
?>],
"globalFiles": [<?php
	foreach ($globalFiles as $i => $file) {
		echo ($i > 0 ? ', ' : '') . '"'.$file.'"';
	}
?>] }