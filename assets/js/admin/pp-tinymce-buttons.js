/**
 * Add the shortcode to the wysiwyg
 */

(function($) {

    $(document).on('click', '[data-button-type-submit]', function(e){

        e.preventDefault();

        var self = $(this),
            form = self.parents('form'),
            type = form.find('[data-button-type]'),
            typeTitle = form.find('[data-button-type-title]'),
            typeDescription = form.find('[data-button-type-description]'),
            typeButtontext = form.find('[data-button-type-buttontext]');

        if(type.length > 0)
        {
            var typeVal = type.val();

            if(typeVal.length > 0)
            {
                var titleVal = 'Get in touch',
                    descriptionVal = 'Let one of our proposal experts plan your proposal',
                    buttontextVal = 'Go';

                if(typeTitle.val().length > 0)
                {
                    titleVal = typeTitle.val();
                }

                if(typeDescription.val().length > 0)
                {
                    descriptionVal = typeDescription.val();
                }

                if(typeButtontext.val().length > 0)
                {
                    buttontextVal = typeButtontext.val();
                }

                var shortcode = '[pp-tinymce-button type="' + typeVal + '" title="' + titleVal + '" description="' + descriptionVal + '"  buttontext="' + buttontextVal + '"]';

                window.send_to_editor(shortcode);

                tb_remove();
            }
        }

    });

})(jQuery);