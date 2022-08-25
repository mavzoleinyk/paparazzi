<?php
extract(array(
    'colWidth' => '4'
), EXTR_SKIP);
?>
<section class="col-md-<?php echo $colWidth; ?> margin-top-reg">

    <div class="row">

        <?php

        if(is_page_template('page-cart.php')): ?>

            <?php the_cart_widgets(); ?>

        <?php elseif(is_page()):

            global $post;
            if($post->post_parent):
                $children = get_pages(array('child_of' => $post->post_parent, 'exclude' => $post->post_parent));
                $overviewlink = '<a href="'.get_permalink($post->post_parent).'">'.get_the_title($post->post_parent).'</a>';
                $currentpage = '';
            else:
                $children = get_pages(array('child_of' => $post->ID));
                $overviewlink = get_the_title($post->ID);
                $currentpage = 'active';
            endif;

            if($children):
                ?>

                <aside class="widget subnav">

                    <header>

                        <h4 class="<?php echo $currentpage; ?>"><?php echo $overviewlink; ?></h4>

                    </header>

                    <article>

                        <ul>

                            <?php foreach($children as $child): ?>
                                <li<?php echo ($child->ID != $post->ID) ? '' : ' class="active"' ; ?>><?php
                                    echo ($child->ID != $post->ID) ? '<a href="'.get_permalink($child->ID).'">' : '<span class="active">';
                                    echo get_the_title($child->ID);
                                    echo ($child->ID != $post->ID) ? '</a>' : '</span>'; ?>
                                </li>
                            <?php endforeach; ?>

                        </ul>

                    </article>

                    <footer>

                        <!--subnav footer-->

                    </footer>

                </aside>

            <?php endif; ?>


            <?php render_template('widgets/proposal'); ?>

            <?php

            $latest_news = new WP_Query(array(
                'posts_per_page' => 1
            ));

            if($latest_news->have_posts())
            {
                render_template('post-list', array(
                    'query' => $latest_news,
                    'title' => '<i class="fa fa-newspaper-o text-danger"></i> Blog',
                    'class' => 'latest-news'
                ));
            };

        elseif(is_single() || is_home() || is_archive()): ?>

            <?php render_template('widgets/proposal'); ?>

            <?php dynamic_sidebar( 'blog-sidebar-1' ); ?>

        <?php endif; ?>

    </div>


</section>
