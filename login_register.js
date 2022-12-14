jQuery( document ).ready( function( ) {
    const profile_form = document.getElementById('loginform');
    const profile_form_header = document.getElementById('loginform-header');
    const profile_form_header_mob = document.getElementById('loginform-header-mob');


    function login_form_handler(profile_form) {
        if (typeof profile_form !== "undefined" && profile_form !== null) {

            const submit_button = profile_form.querySelector('input[type="submit"]');
            profile_form.addEventListener('submit', async function (event) {
                event.preventDefault();
                const errors = profile_form.querySelectorAll('.error-input');
                if (typeof errors !== 'undefined' && errors !== null) {
                    errors.forEach(error_item => error_item.classList.remove('error-input'))

                }
                const form_data = new FormData(profile_form);
                const action = form_data.get('action')
                submit_button.setAttribute('disabled', 'true');
                const response = await fetch(login_data.root_url, {
                    method: 'POST', body: form_data
                });
                if (response.ok) {
                    response.json().then(response => {
                        if (Object.keys(response).length) {
                            let error = profile_form.querySelectorAll('.' + response.code);
                            console.log(response);
                            profile_form.querySelector('.error-container').innerHTML = response.message;
                            error.forEach(function (item, index, array) {
                                item.classList.add('error-input');
                            });
                        } else {
                            profile_form.reset();
                            const params = new Proxy(new URLSearchParams(window.location.search), {
                                get: (searchParams, prop) => searchParams.get(prop),
                            });
                            window.location.href = "/my-account";
                        }
                    })

                } else {
                    console.log(response)
                    document.querySelectorAll("input").classList.add('error-input');
                    // noinspection ExceptionCaughtLocallyJS
                    throw new Error(response.status + ' - ' + response.statusText);
                }
                submit_button.removeAttribute('disabled');
            })


            submit_button.addEventListener('click', function (e) {
                const errors = profile_form.querySelectorAll('.error-input');
                if (typeof errors !== 'undefined' && errors !== null) {
                    errors.forEach(error_item => error_item.classList.remove('error-input'))
                }
            });
        }
    }
    login_form_handler(profile_form);
    login_form_handler(profile_form_header);
    login_form_handler(profile_form_header_mob);
});
jQuery(document).ready(function () {
    jQuery('#register-user').on('click',function(e){
        const register_user = document.getElementById('register_users');
        const errors = register_user.querySelectorAll('.error-input');
        if (typeof errors !== 'undefined' && errors !== null) {
            errors.forEach(error_item => error_item.classList.remove('error-input'));

        }

        const form_elements = register_user.querySelectorAll('input, textarea, select');
        form_elements.forEach(element => {
            if (!element.checkValidity()) {
                e.preventDefault();
                element.classList.add('error-input');
            }
        })
    });
    jQuery('#register_users').on('submit',function(e){
        e.preventDefault();

        var new_user_name = jQuery('#new_user_name').val();
        var new_user_email = jQuery('#new_user_email').val();
        var user_password = jQuery('#user_password').val();

        jQuery.ajax({
            url: '/wp-admin/admin-ajax.php',
            type:"POST",
            data: {
                action: "register_user_front_end",
                new_user_name : new_user_name,
                new_user_email : new_user_email,
                user_password : user_password,
            },
            success: function(results){
                window.location.href = "/my-account";
            },
            error: function(results) {
                console.log('error');
            }
        });
    });
    jQuery('#register_redirect').on('click',function(e){
        window.location.href = "/login?tab=register";
    });

});
