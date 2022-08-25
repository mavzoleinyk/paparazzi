<div class="row">
    <div class="col-xs-12">

        <nav class="navbar navbar-default">

            <div class="container-fluid">

                <div class="navbar-header navbar-header-xs-inline">

                    <button class="btn btn-default btn-sm btn-text-lg navbar-btn btn-xs-inline" type="button" data-toggle="collapse" data-target="#filter-<?php echo $taxonomy; ?>" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fa fa-filter"></i>
                    </button>

                    <span class="h3">&nbsp;Filter By <?php echo niceify($taxonomy); ?></span>

                </div>

            </div>

            <div id="filter-<?php echo $taxonomy; ?>" class="container-fluid collapse">

                <div class="navbar-extender">

                    <a class="btn btn-primary btn-sm navbar-btn" href="<?php echo $filterBase; ?>"><span>All</span></a>

                <?php if($terms = get_prepared_locations()): foreach($terms as $term): $link = $filterBase . '?filter=' . $taxonomy. '&term=' . $term->slug; ?>

                    <a class="btn btn-primary btn-sm navbar-btn" href="<?php echo $link; ?>"><span><?php echo $term->name; ?></span></a>

                <?php endforeach; endif; ?>

                </div>

            </div>
        </nav>

    </div>

</div>