<?php
//文章归档
function archives_list_SHe() {
     global $wpdb,$month;
     $lastpost = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC LIMIT 1");
     $output = get_option('SHe_archives_'.$lastpost);
     if(empty($output)){
         $output = '';
         $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'SHe_archives_%'");
         $q = "SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts FROM $wpdb->posts p WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";
         $monthresults = $wpdb->get_results($q);
         if ($monthresults) {
             foreach ($monthresults as $monthresult) {
             $thismonth    = zeroise($monthresult->month, 2);
             $thisyear    = $monthresult->year;
             $q = "SELECT ID, post_date, post_title, comment_count FROM $wpdb->posts p WHERE post_date LIKE '$thisyear-$thismonth-%' AND post_date AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC";
             $postresults = $wpdb->get_results($q);
             if ($postresults) {
                 $text = sprintf('%s %d', $month[zeroise($monthresult->month,2)], $monthresult->year);
                 $postcount = count($postresults);
                 $output .= '<ul class="archives-list"><li><span class="archives-yearmonth">' . $text . ' &nbsp;(' . count($postresults) . '&nbsp;' . __('篇文章','freephp') . ')</span><ul class="archives-monthlisting">' . "\n";
             foreach ($postresults as $postresult) {
                 if ($postresult->post_date != '0000-00-00 00:00:00') {
                 $url = get_permalink($postresult->ID);
                 $arc_title    = $postresult->post_title;
                 if ($arc_title)
                     $text = wptexturize(strip_tags($arc_title));
                 else
                     $text = $postresult->ID;
                     $title_text = __('View this post','freephp') . ', &quot;' . wp_specialchars($text, 1) . '&quot;';
                     $output .= '<li>' . mysql2date('d日', $postresult->post_date) . ':&nbsp;' . "<a href='$url' title='$title_text'>$text</a>";
                     $output .= '&nbsp;(' . $postresult->comment_count . ')';
                     $output .= '</li>' . "\n";
                 }
                 }
             }
             $output .= '</ul></li></ul>' . "\n";
             }
         update_option('SHe_archives_'.$lastpost,$output);
         }else{
             $output = '<div class="errorbox">'. __('Sorry, no posts matched your criteria.','freephp') .'</div>' . "\n";
         }
     }
     echo $output;
 }
//随机文章
function s_random_lists($num_limit = 10 , $exclude = "" , $date_limit = "" , $echo = true , $list = true){
        $out = "";
        if ( $num_limit < 1 ) $num_limit = "-1";
        if ( !$date_limit_ts = strtotime($date_limit) ) $date_limit = false;
        if ( !$date_limit ){
            $posts = get_posts('offset=0&numberposts='.$num_limit.'&exclude='.$exclude.'&orderby=rand');
        } else {
            $posts = get_posts('offset=0&numberposts=-1&exclude='.$exclude.'&orderby=rand');
        }
        $postscount = count($posts);
        if ( $num_limit < 1 ) $num_limit = $postscount;
        if ( $postscount < $num_limit ) $num_limit = $postscount ;
        for ( $i = 0 ; $i < $num_limit ; $i++ ){
             if ( !$date_limit or $date_limit_ts < strtotime( $posts[$i]->post_date )){
                if ( $list ) $out.= '<li class="random-post-link">'."\n";
                  $out.= '<a href="'.get_permalink($posts[$i]->ID).'" title="'.$posts[$i]->post_title.'">'.cut_str($posts[$i]->post_title,45).'</a>'."\n";
                if ( $list ) $out.= '</li>'."\n";
            }else{
                if ( $postscount > $num_limit ) $num_limit++;
            }
        }
        if ( $list ) $out = '<ul class="random-post-link">'."\n".$out.'</ul>'."\n";
        if ( $echo ){
              echo $out;
        } else {
            return $out;
        }
    }

// 本月排行
function simple_get_most_viewed($posts_num=10, $days=40){
    global $wpdb;
    $sql = "SELECT ID , post_title , comment_count
           FROM $wpdb->posts
           WHERE post_type = 'post' AND post_status = 'publish' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days
           ORDER BY comment_count DESC LIMIT 0 , $posts_num ";
    $posts = $wpdb->get_results($sql);
    $output = "";
    foreach ($posts as $post){
        $output .= "\n<li><a href= \"".get_permalink($post->ID)."\" rel=\"bookmark\" title=\"".$post->post_title." (".$post->comment_count."条评论)\" >".cut_str($post->post_title,45)."</a></li>";
    }
    echo $output;
} 

// 季度排行
function simple_get_most_vieweds($posts_num=10, $days=360){
    global $wpdb;
    $sql = "SELECT ID , post_title , comment_count
           FROM $wpdb->posts
           WHERE post_type = 'post' AND post_status = 'publish' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days
           ORDER BY comment_count DESC LIMIT 0 , $posts_num ";
    $posts = $wpdb->get_results($sql);
    $output = "";
    foreach ($posts as $post){
        $output .= "\n<li><a href= \"".get_permalink($post->ID)."\" rel=\"bookmark\" title=\"".$post->post_title." (".$post->comment_count."条评论)\" >".cut_str($post->post_title,45)."</a></li>";
    }
    echo $output;
} 
?>