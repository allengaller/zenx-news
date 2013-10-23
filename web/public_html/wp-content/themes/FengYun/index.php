<?php if (get_option('swt_home') == 'BLOG') { ?>
<?php include('blog.php'); ?>
<?php } else { include(TEMPLATEPATH . '/cms.php'); } ?>