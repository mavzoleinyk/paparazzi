<?php
/*
Template Name: Home
*/
?>

<?php include('header.php'); ?>

    <div class="container">

        <div class="row main-content">

            <section class="col-md-8" role="main">

                <?php if (have_posts()) : while(have_posts()) : the_post(); ?>

                <article>

                    <h3><?php the_title(); ?></h3>

                    <p><?php the_date(); ?></p>

                    <?php the_content(); ?>

                </article>

                <?php endwhile; endif;?>

            </section>

            <?php render_template('sidebar'); ?>

        </div>

    </div>

<?php include('footer.php'); ?>