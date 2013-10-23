<?php if ( is_search() ) { ?>
    <div id="category">
		<h2>搜索到的所有属于<?php printf( ('&#8216;%1$s&#8217;'), wp_specialchars($s, 1) ); ?>的文章</h2>
    </div><!--category end-->
<?php } ?>

<?php if ( is_category() ) { ?>
     <div id="category">
         <h2>所有属于“<?php single_cat_title(); ?>”的文章</h2>
         <p><?php echo category_description(); ?></p>
     </div><!--category end-->
<?php } ?>

<?php if ( is_day() ) { ?>
    <div id="category">
        <h2>发表于“<?php the_time('Y年m月d日'); ?>”的文章</h2>
    </div><!--category end-->
<?php } ?>

<?php if ( is_month() ) { ?>
    <div id="category">
        <h2>发表于“<?php the_time('Y年m月'); ?>”的文章</h2>
    </div><!--category end-->
<?php } ?>

<?php if ( is_year() ) { ?>
    <div id="category">
        <h2>发表于“<?php the_time('Y年'); ?>”的文章</h2>
    </div><!--category end-->
<?php } ?>

<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?>
    <div id="category">
        <h2>属于标签“<?php  single_tag_title("", true); ?>”的文章</h2>
    </div><!--category end-->
<?php } }?>

<?php if ( is_author() ) {?>
    <div id="category">
        <h2>作者“<?php wp_title('');?>”发表的所有文章</h2>
    </div><!--category end-->
<?php }?>