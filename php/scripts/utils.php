<?php
function write_output($name, $contents) {
    $path = "/usr/src/app/output/". $name;
	foreach ($contents as $element) {
		if (is_null($element)) {
			$element = "None";
		}
		if (is_bool($element)) {
			$element = $element ? "True" : "False";
		}
		file_put_contents($path, $element, FILE_APPEND);
	}
}
