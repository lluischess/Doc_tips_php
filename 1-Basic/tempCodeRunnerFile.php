<?php
$x = 1;
$y = 2;
$text = <<<TEXT
Line $x
Line $y
Line 3
<p> <strong>H</strong>ello </p>
TEXT;

echo nl2br($text);