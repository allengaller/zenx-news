<?php
/*
Template Name: Readerwalls(读者墙)
*/
?>
<?php get_header(); ?>
<div id="breadcrumbs"> 
<div id="brleft"><?php An_breadcrunbs(); ?></div>
<div id="brright">
<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<a class="bds_tsina"></a>
<a class="bds_qzone"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_t163"></a>
<a class="bds_fx"></a>
<a class="bds_tqf"></a>
<a class="bds_douban"></a>
<a class="bds_kaixin001"></a>
<a class="bds_bdhome"></a>
<a class="bds_tfh"></a>
<span class="bds_more"></span>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6628845" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
var bds_config={"snsKey":{'tsina':'2129764240','tqq':'801331529','t163':'wgkfYbMyuuCHOYaw','tsohu':'zwV2uxA9TKDy7wBc'}}
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->
</div>
</div>
    <div class="wrapindex clearfix">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            <div class="homeleft corner5px mb10 excerpt">
              <?php the_content('Read more...'); ?>
                <div class="post-content">
<h2 style="color:#f00">灌水先锋队</h2>
<?php
    $query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != '' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 36";
    $wall = $wpdb->get_results($query);
    $maxNum = $wall[0]->cnt;
    foreach ($wall as $comment)
    {
        $width = round(40 / ($maxNum / $comment->cnt),2);
        if( $comment->comment_author_url )
        $url = $comment->comment_author_url;
        else $url="#";
        $avatar = get_avatar( $comment->comment_author_email, $size = '36', $default = get_bloginfo('wpurl').'/avatar/default.jpg' );
        $tmp = "<li><a target=\"_blank\" href=\"".$comment->comment_author_url."\">".$avatar."<em>".$comment->comment_author."</em> <strong>+".$comment->cnt."</strong><br/>".$comment->comment_author_url."</a></li>";
        $output .= $tmp;
     }
    $output = "<ul class=\"readers-list\">".$output."</ul>";
    echo $output ;
?>
</div>
 <div class="comments">
<?php comments_template(); ?>
</div>
<?php endwhile; ?>
<?php endif; ?>
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>