jQuery(document).ready(function($) {
    jQuery('#product-filter-dropdown').change(function() {
        var filter = jQuery(this).val();

        jQuery.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'filter_products',
                filter: filter
            },
            success: function(response) {
                jQuery('#product-content').html(response);
            }
        });
    });
});
