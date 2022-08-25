<?php if(!empty($imgHtml)): ?>

    <li data-action="blueimp" class="text-center">

        <a href="#" class="small text-uppercase">
            <small>Album</small>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-album.png" alt=""/>
        </a>

        <?php echo $imgHtml; ?>

    </li>

<?php endif; ?>