<?php
$keywords = array("cat", "dog", "bird", "hamster", "fish", "snake", "turtle", "rat", "rabbit", "guinea pig");
natcasesort($keywords);
foreach ($keywords as $keyword) {
	echo $keyword."<br>";
}
