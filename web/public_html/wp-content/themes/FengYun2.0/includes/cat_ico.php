<div class="cat_ico">
    <a href="<?php bloginfo('url'); ?>/category/<?php $catArray = get_the_category(); $cat=$catArray[array_rand($catArray,1)]; echo $cat->category_nicename;?>" title="<?php echo $cat->cat_name;?>">
    <img src="<?php bloginfo('template_url');?>/images/caticon/<?php echo $cat->category_nicename; ?>.gif" />
    </a>
</div>