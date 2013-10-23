<form action="<?php echo get_option('swt_search_link'); ?>" id="cse-search-box">
	<div>
	<input type="hidden" name="cx" value="<?php echo get_option('swt_search_ID'); ?>" />
	<input type="hidden" name="cof" value="FORID:10" />
	<input type="text" placeholder="搜下不会怀孕..." onblur="if (this.value == '') {this.value = '';}" value="" name="q" id="q" class="swap_value" />
	<input type="submit" value="搜索" id="go" alt="Search" title="搜索" />
	</div>
</form>