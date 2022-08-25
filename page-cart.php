<?php
/*
Template Name: Cart
*/
?>

<?php include('header.php'); ?>

    <div class="container">

        <div class="row main-content">

            <section <?php post_class('col-md-9'); ?> role="main">

            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

                <header>

                    <h1><?php the_title(); ?></h1>

                </header>

                <article id="post-<?php the_ID(); ?>">

                    <?php the_content(); ?>

                </article>

            <?php endwhile; endif; ?>

            </section>

            <?php $colWidth = 3; include_once('templates/sidebar.php'); ?>

        </div>

    </div>

<?php include('footer.php'); ?>