<?php if(!empty($imgHtml)): ?>

<aside data-action="blueimp" class="panel bg-info panel-square panel-gallery pull-right">

    <div class="panel-body">

        <h5>Gallery</h5>

        <?php $count = 0; foreach($images as $image): $count++; if($count < 10): ?>

        <figure class="pull-left">

            <img src="<?php echo $image['thumb']; ?>" alt="<?php echo $image['title']; ?>" />

        </figure>

    <?php endif; endforeach; ?>


    <?php echo $imgHtml; ?>

    </div>

</aside>

<?php endif; ?>