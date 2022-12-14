<?php

/**
 * BuddyPress - Users Blogs
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="row">
    <div class="col-xs-12">

        <div class="item-list-tabs" id="subnav" role="navigation">
            <ul class="nav nav-pills">

                <?php b4_bp_get_options_nav(); ?>

                <li id="blogs-order-select" class="last filter">

                    <label for="blogs-order-by"><?php _e( 'Order By:', 'buddypress' ); ?></label>
                    <select id="blogs-order-by">
                        <option value="active"><?php _e( 'Last Active', 'buddypress' ); ?></option>
                        <option value="newest"><?php _e( 'Newest', 'buddypress' ); ?></option>
                        <option value="alphabetical"><?php _e( 'Alphabetical', 'buddypress' ); ?></option>

                        <?php do_action( 'bp_member_blog_order_options' ); ?>

                    </select>
                </li>
            </ul>
        </div><!-- .item-list-tabs -->

    </div>
</div>


<?php
switch ( bp_current_action() ) :

	// Home/My Blogs
	case 'my-sites' :
		do_action( 'bp_before_member_blogs_content' ); ?>

		<div class="blogs myblogs" role="main">

			<?php bp_get_template_part( 'blogs/blogs-loop' ) ?>

		</div><!-- .blogs.myblogs -->

		<?php do_action( 'bp_after_member_blogs_content' );
		break;

	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;