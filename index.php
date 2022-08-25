<?php include('header.php'); ?>

    <div class="container">

        <div class="row main-content">

            <section <?php post_class('col-md-8'); ?> role="main">

                <header>
                    <?php hh_archive_title(); ?>
                </header>

                <?php $count = 0; if(have_posts()) : while(have_posts()) : the_post(); $count++; ?>

                    <article <?php post_class('article article-' . $count); ?> id="post-<?php the_ID(); ?>">

                        <?php //echo get_hh_thumb_html($post->ID, 'nugget-img', '', 'post image') ?>

                        <?php if(is_page()): ?>

                            <h1><?php the_title(); ?></h1>

                            <?php the_content(); ?>

                        <?php elseif(is_single()): ?>

                            <?php include('templates/blog/featured-image.php'); ?>

                            <h2><?php the_title(); ?></h2>

                            <?php include('templates/addthis.php'); ?>

                            <?php include('templates/blog/user-date.php'); ?>

                            <?php the_gallery('blog'); ?>

                            <?php the_content('..[read more]'); ?>

                            <?php include('templates/blog/post-meta.php'); ?>

                            <hr/>

                            <?php comments_template(); ?>

                        <?php else: ?>

                            <?php include('templates/blog/featured-image.php'); ?>

                            <?php if($count === 1 && is_home()): ?>

                                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

                                <?php include('templates/addthis.php'); ?>

                                <?php include('templates/blog/user-date.php'); ?>

                                <?php the_content('..[read more]'); ?>

                                <?php include('templates/blog/post-meta.php'); ?>

                            <?php else: ?>

                                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

                                <?php the_excerpt(); ?>

                                <?php include('templates/addthis.php'); ?>

                                <?php include('templates/blog/user-date.php'); ?>

                                <?php include('templates/blog/post-meta.php'); ?>

                                <hr/>

                                <a class="comment-count margin-top-reg" href="<?php echo get_comments_link(); ?>">Comments: <span> <?php echo get_comments_number(); ?></span></a>

                                <a class="secondary-more-link" href="<?php the_permalink(); ?>">Read More&nbsp;&raquo;</a>

                            <?php endif; ?>

                        <?php endif; ?>

                    </article>

                    <hr/>

                <?php endwhile; ?>

                    <footer>

                        <?php echo get_theme_pagination(); ?>

                    </footer>

                <?php else: ?>

                    <div class="inner">

                        <?php if(is_404()): ?>

                            <article id="post-0" class="post no-results not-found hentry">

                                <p>The page you have tried to visit does not exist.</p>

                                <p>To find the page your looking for, try <a href="<?php bloginfo('url'); ?>" title="Homepage">starting at the home page</a>.</p>

                            </article><!-- #post-0 -->

                        <?php else: ?>

                            <article id="post-0" class="post no-results not-found hentry">

                                <p>Apologies, but no results were found.</p>

                            </article><!-- #post-0 -->

                        <?php endif; ?>

                    </div><!-- inner -->

                <?php endif; ?>

            </section>

        <?php render_template('sidebar', array('colWidth' => '4')); ?>

        </div>

    </div>

<?php include('footer.php'); ?>
