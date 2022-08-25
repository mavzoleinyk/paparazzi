<!-- Modal -->
<div class="modal fade" id="call-me-back-modal" tabindex="-1" role="dialog" aria-labelledby="call-me-back-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
	            <h1 class="modal-title text-uppercase display-inline" id="myModalLabel"><i class="fa fa-phone text-primary"></i> <?php echo $title ?></h1>
            </div>
            <div class="modal-body">

                <?php echo apply_filters('the_content', $wysiwyg); ?>

            </div>
        </div>
    </div>
</div>