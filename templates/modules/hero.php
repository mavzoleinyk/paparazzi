<div id="<?php echo $id; ?>" class="jumbotron jumbotron-viewport jumbotron-relative jumbotron-xs-<?php echo $bgAlign; ?>" style="background-image: url(<?php echo $image; ?>)">

    <div class="jumbotron-content">
        <div class="inner text-center">

            <h2><?php echo $title; ?></h2>

            <h1 class="text-uppercase"><?php echo $pageTitle; ?></h1>

            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="hidden-xs hidden-sm addthis_sharing_toolbox"></div>

        </div>

    </div>

</div>

<?php if(!empty($text)): ?>
<div class="container">
    <div class="col-xxs-12 col-xxs-offset-clear col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 text-center">
        <h3 class="lead weight-light"><?php echo $text; ?></h3>
    </div>
</div>
<?php endif; ?>