<?php if($_COOKIE["comment_author_" . COOKIEHASH]!=""): ?>
 <script type="text/javascript">
 document.title = "<?php printf(__('%s 欢迎回来 ! '), $_COOKIE["comment_author_" . COOKIEHASH]) ?>" + document.title
 </script>
 <?php endif; ?>