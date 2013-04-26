//MNI Application
//I handle all the API functions that are used on the MNI site. I return product listings, course dates, etc
$('document').ready(function() {
    $(document).foundation();
    var integration_server_address = 'http://i.dev.mni.neueway.com/' //TODO: Make this dynamic at some point
    var api_key = 'Callie123';

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
    //Handle the ULs on the site that show upcoming class data
    if($('.mni-upcoming-classes').length > 0) {
//        var upcomingClasses = makeAPIRequest('mni-get-products',{})

    }
});