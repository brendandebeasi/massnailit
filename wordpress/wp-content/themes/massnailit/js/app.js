//MNI Application
//I handle all the API functions that are used on the MNI site. I return product listings, course dates, etc
$(document).ready(function() {
    var jPM = $.jPanelMenu();


    $(document).foundation();
    var integration_server_address = 'http://i.dev.mni.neueway.com/' //TODO: Make this dynamic at some point
    var api_key = 'Callie123';
    var add_to_cart_base = '/checkout/?';

    function makeAPIRequest(method, data) {
        if(typeof(data) == 'undefined') var data = {};
        data.action = method;
        data.api_key = api_key;

        $.ajax({
            dataType: "json",
            url: integration_server_address,
            data: data,
            success: function(json) {
                console.log( "JSON Data: " + json);
            }
        });


    }
    function updateShortFormButton(form) {
        var fName,lName,email,courseId,finalURL;
        courseId = form.find('.product-id').val();
        fName = form.find('.fName').val();
        lName = form.find('.lName').val();
        email = form.find('.email').val();
        finalURL = add_to_cart_base + courseId + '&fName=' + fName + '&lName=' + lName + '&email=' + email;

        form.find('.button').attr('href',finalURL);
    }

    $('.short-form input').keyup(function() {
        var mainForm = $(this).parent().parent();
        updateShortFormButton(mainForm);
    });
    $('.short-form select').change(function() {
        $(this).parent().find('input').trigger('keyup');
    });

    $('.short-form input').trigger('keyup');

    //Handle the ULs on the site that show upcoming class data
    if($('.mni-upcoming-classes').length > 0) {
//        var upcomingClasses = makeAPIRequest('mni-get-products',{})

    }
    $('.price-table.online').html($('.price-table-original.online').html());
});
