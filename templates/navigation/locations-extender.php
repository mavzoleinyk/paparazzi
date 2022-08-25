<div id="locations-extender" class="hidden-xs collapse">

	<div class="navbar-extender">

		<?php if($id === 'nav-locations'): ?>

<!--			<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">-->
				<a class="btn btn-primary navbar-btn" href="<?php echo bloginfo('url') . '/proposals/'; ?>"><span>All Locations</span></a>
<!--			</div>-->

		<?php endif; ?>

		<?php foreach($locations as $location): $link = get_term_link($location, 'location'); ?>

<!--			<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">-->
				<a class="btn btn-primary navbar-btn" href="<?php echo $link; ?>"><span><?php echo $location->name; ?></span></a>
<!--			</div>-->

		<?php endforeach; ?>

	</div>

</div>