<form role="search" class="form" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<div class="input-group">
		<label class="sr-only" for="s"><?php _e('Search for:', 'four7'); ?></label>
		<input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" id="s" class="form-control" placeholder="<?php _e('Search', 'four7'); ?> <?php bloginfo('name'); ?>">
		<span class="input-group-btn">
			<button type="submit" id="searchsubmit" class="btn btn-default"><i class="fa fa-search"></i></button>
		</span>
	</div>
</form>