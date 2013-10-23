<div id="roll_n">
	<div id="roll">
		<?php query_posts('showposts='.get_option('swt_roll_n').'&cat='.get_option('swt_roll'));?><?php while (have_posts()) : the_post(); ?>
		<ul>
			<li><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读<?php the_title(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 42, '');?></a></li>
		</ul>
		<?php endwhile; ?>
 	</div>
 </div>
<script type="text/javascript">
function up(x){
var Mar = document.getElementById(x); 
var child_div=Mar.getElementsByTagName("ul") 
var picH = 26;//移动高度 
var scrollstep=2;//移动步幅,越大越快 
var scrolltime=20;//移动频度(毫秒)越大越慢 
var stoptime=3000;//间断时间(毫秒) 
var tmpH = 0; 
Mar.innerHTML += Mar.innerHTML; 
function start(){ 
if(tmpH < picH){ 
tmpH += scrollstep; 
if(tmpH > picH )tmpH = picH ; 
Mar.scrollTop = tmpH; 
setTimeout(start,scrolltime); 
}else{ 
tmpH = 0; 
Mar.appendChild(child_div[0]); 
Mar.scrollTop = 0; 
setTimeout(start,stoptime); 
} 
} 
setTimeout(start,stoptime); 
}
up("roll")
</script>