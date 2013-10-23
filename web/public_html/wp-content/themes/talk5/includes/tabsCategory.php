<div class="sidebarWidget tabsCategory" id="J_tabsCategory">
    <ul class="tabbtn" id="J_tabbtn">
        <li class="current"><s class="hot"></s></li>
        <li><s class="newest"></s></li>
        <li><s class="random"></s></li>
    </ul><!--tabbtn end-->
	
	<div id="J_tabcon">
		<div class="tabcon">
			<ul><?php some_posts( $orderby = 'comment_count' ); ?></ul>
		</div><!-- tabcon end -->
		<div class="tabcon" style="display:none;">
			<ul><?php some_posts( $orderby = 'date' ); ?></ul>
		</div><!-- tabcon end -->       
		<div class="tabcon" style="display:none;">
			<ul><?php some_posts( $orderby = 'rand' );  ?></ul> 
		</div><!-- tabcon end -->
	</div>		
</div><!--sidebarWidget end-->