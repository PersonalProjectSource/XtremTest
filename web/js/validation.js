$(document).ready(function () {
    console.log('entrer dans autocomplete');
    $('#postalCode').autocomplete({
        serviceUrl: Routing.generate('app_api_get_postalcodes', {version: "v1"})
    });

    $('form').on('submit', function (e) {
        e.preventDefault();

        var $this = $(this); // L'objet jQuery du formulaire

        $.ajax({
            url: Routing.generate('app_api_post_contact', {version: "v1"}),
            type: $this.attr('method'),
            data: {
                'gender': undefined === $("input[name=gender]:checked").val() ? '' : $("input[name=gender]:checked").val(),
                'name': $("input[name=name]").val(),
                'firstName': $("input[name=firstName]").val(),
                'postalCode':  $("input[name=postalCode]").val(),
                'mail':  $("input[name=mail]").val(),
                'phone':  $("input[name=phone]").val(),
                'actuality':  undefined === $("input[name=actuality]:checked").val() ? false : $("input[name=actuality]:checked").val(),
                'offer':  undefined === $("input[name=offer]:checked").val() ? false : $("input[name=offer]:checked").val()
            },
            dataType: 'json',
            success: function (json) {
                $(".erreur").html('');
                $(location).attr('href', Routing.generate('confirmation'))
            },
            error: function (json) {
                $.each(json.responseJSON.children, function (index, element) {
                    $(".erreur-" + index).html('');
                    if (element.errors) {
                        $(".erreur-" + index).html(element.errors[0]).show();
                    }
                });
            }
        });
    });
});