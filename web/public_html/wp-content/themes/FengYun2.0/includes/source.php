<?php
$original = get_post_meta($post->ID, 'original', true);
if(!empty($original)){
echo '&#8260; '."<a href=".$reprinted.">本站原创</a>";
}
?>
<?php 
$reprinted = get_post_meta($post->ID, 'reprinted', true);
if(!empty($reprinted)){
echo '&#8260; 转载：'."<a href=".$reprinted.">原文链接</a>";
}
?>