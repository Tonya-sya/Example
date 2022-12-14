jQuery(document).ready(function($) {
    $('.tax-filter').click( function(event) {

        // Prevent default action - opening tag page
        if (event.preventDefault) {
            event.preventDefault();
        } else {
            event.returnValue = false;
        }

        // Get tag slug from title attirbute
        var selecetd_taxonomy = $(this).attr('title');
        $('.tax-filter').removeClass('active');
        $(this).addClass('active');
        // After user click on tag, fade out list of posts

taxonomy = selecetd_taxonomy;
        data = {
            action: 'filter_posts', // function to execute
            afp_nonce: afp_vars.afp_nonce, // wp_nonce
            taxonomy: selecetd_taxonomy, // selected tag
        };

        $.post( afp_vars.afp_ajax_url, data, function(response) {

            if( response ) {
                // Display posts on page
                $('.store__products').html( response );
                // Restore div visibility
                $('.store__products').fadeOut();

                current_page = 1;
                $('.store__products').fadeIn();
                $('#loadmore').show();
            };
        });

    });
    $('.blog-hero__tabs--tab').click( function(event) {
        // Prevent default action - opening tag page
        if (event.preventDefault) {
            event.preventDefault();
        } else {
            event.returnValue = false;
        }
        var selecetd_taxonomy = $(this).data('id');
        $('.blog-hero__tabs--tab').removeClass('active');
        $(this).addClass('active');
        $('.blog-hero__dark-items').fadeOut();
        $('.ajax-tax-container').fadeOut();
        $('.alm-container').fadeOut();
        taxonomy = selecetd_taxonomy;
        $.ajax( {
            url : aa_vars.aa_ajax_url,
            type: 'POST',
            data: {
                action: 'posts_tax_filter', // function to execute
                afp_nonce: afp_vars.afp_nonce, // wp_nonce
                taxonomy: selecetd_taxonomy, // selected tag
                dataType: 'json',
            },
            success: function( data ) {
                if( data ) {
                    let results = JSON.parse(data);
                    if (results.success) {
                        $('.blog-hero__dark-items').html(results.result.dark);
                        $('.ajax-tax-container').html(results.result.main);
                    }
                    $('#loadmore-btn').show();
                    current_page = 1;
                    $('.blog-hero__dark-items').fadeIn();
                    $('.ajax-tax-container').fadeIn();
                    $('.alm-container').fadeIn();
                }
            },
            fail: function( data ) {
                console.log( data.responseText );
                console.log( 'Request failed: ' + data.statusText );
            }
        } );
    });
    $('#loadmore-btn').click(function(event){
        jQuery(this).text('Loading...');
        var data = {
            'action': 'loadmore_blog',
            'page' : current_page,
            'taxonomy': taxonomy,
        };
        jQuery.ajax({
            url:'/wp-admin/admin-ajax.php',
            data:data,
            type:'POST',
            success:function(data){
                if(data) {
                    jQuery('#loadmore-btn').text('Load more');
                    jQuery('.alm-container').append(data);
                    current_page++;
                    if (current_page == max_pages) {
                        jQuery("#loadmore-btn").hide()
                    };
                } else {
                    jQuery('#loadmore-btn').hide();
                }
            }
        });
    });
});
