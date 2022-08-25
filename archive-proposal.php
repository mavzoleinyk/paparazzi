<?php include('header.php'); ?>

<?php $extra = ''; if(isset($_REQUEST['filter'])) $term = get_term_by('slug', $_REQUEST['term'], $_REQUEST['filter'] ); if(!empty($term)) $extra = ' in ' . $term->name;?>

	<div class="container">

		<div class="row main-content">

			<section <?php post_class('col-md-9'); ?> role="main">

                <header>

                    <h1><?php hh_archive_title($extra); ?></h1>

                </header>

			</section>

		</div>

        <?php $filterBase = get_bloginfo('url') . '/proposals/'; ?>

        <?php render_template('filter', array('taxonomy' => 'location', 'filterBase' => $filterBase)); ?>


        <div class="row margin-top-reg" data-equal="height">
            <?php
            $args = array(
                'limit' => 24, //Limit posts per page
                'pages' => true, //Should we show pagination
                'featured' => false
            );

            if(!empty($term))
            {
                $args['term'] = $term;
            }

            ?>

            <?php the_proposals($args); ?>

		</div>

	</div>

<?php include('footer.php'); ?>