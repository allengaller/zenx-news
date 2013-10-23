<?php if (get_option('swt_cumulus') == '关闭') { ?>
<?php { echo ''; } ?>
<?php } else { 
//彩色标签云
function colorCloud($text) {
$text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
return $text;
}
function colorCloudCallback($matches) {
$text = $matches[1];
$color = dechex(rand(0,16777215));
$pattern = '/style=(\'|\")(.*)(\'|\")/i';
$text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
return "<a $text>";
}

add_filter('wp_tag_cloud', 'colorCloud', 1);
 } ?>