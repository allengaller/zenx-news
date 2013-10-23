<?php 
/* Override default Searchform code */

$search_text = get_search_query();
if ( empty($search_text) ) $search_text = __( 'Search this site', 'mibook' );
?>	
<div class="searchbox">
    <form role="search" method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
        <input type="text" value="<?php echo $search_text ?>" name="s" id="s" onblur="if (this.value == '')  
        {this.value = '<?php echo $search_text ?>';}"  
        onfocus="if (this.value == '<?php echo $search_text ?>')  
        {this.value = '';}" />
        <input type="submit" id="searchsubmit" value="" />
    </form>
</div>