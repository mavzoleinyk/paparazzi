
        <?php

            //Render the blueimp gallery controls just in case
            render_template('gallery/nav');

            // If its not a proposal load the footer
            if(!is_singular('proposal')) {
                render_template('navigation/footer');
            }

            // Wordpress footer function
            wp_footer();

        ?>

        <!-- Go to www.addthis.com/dashboard to customize your tools -->
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553a6394550eee79&async=1&domready=1"></script>

		<script type="text/javascript">
			/* <![CDATA[ */
			var woocommerce_addons_params = {"i18n_addon_total":"Options total:","i18n_grand_total":"Grand total:","i18n_remaining":"characters remaining","currency_format_num_decimals":"2","currency_format_symbol":"\u00a3","currency_format_decimal_sep":".","currency_format_thousand_sep":",","currency_format":"%s%v"};
			/* ]]> */
		</script>

	</body>

</html>