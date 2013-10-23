<?php if (get_option('swt_home') == 'CMS') { ?>
<?php include('cms.php'); ?>
<?php } else { include(TEMPLATEPATH . '/blog.php'); } ?>