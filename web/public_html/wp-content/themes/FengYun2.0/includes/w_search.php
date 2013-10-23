<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<input type="text" placeholder="搜下不会怀孕..." onblur="if (this.value == '') {this.value = '';}" value="" name="s" id="s" class="swap_value" />
	<input type="submit" value="搜索" id="go" alt="Search" title="搜索" />
</form>