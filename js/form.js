$(document).ready(function() {

    function cacheTout() {
        $('#afficheBoursier').hide();
        $('#afficheNonBoursier').hide();
        $('#afficheLoger').hide();
        $('#afficheBatiment').hide();
        $('#afficheChambre').hide();
    }
    cacheTout();
    // $(function() {
    //     if ($('input[type=radio][name=bourse]').value == 'Boursier') {

    //         cacheTout();
    //         $('#afficheBoursier').show();
    //         $('#afficheLoger').show();
    //         $('#afficheBatiment').show();
    //         $('#afficheChambre').show();
    //     }
    //     // } else {
    //     //     alert('test');
    //     // }
    // });
    // $(function() {
    //     if ($('input[type=radio][name=bourse]').is(':checked') === true) {
    //         if (this.value == 'Boursier') {
    //             //cacheTout();
    //             $('#afficheBoursier').show();
    //             $('#afficheLoger').show();
    //             $('#afficheBatiment').show();
    //             $('#afficheChambre').show();
    //         }
    //     } else {
    //         alert('test');
    //     }
    // });
    $('input[type=radio][name=bourse]').change(function() {
        if (this.value == 'Boursier') {
            cacheTout();
            $('#afficheBoursier').show();
            $('#afficheLoger').show();
            $('input[type=checkbox][name=loger]').change(function() {
                if (this.checked) {
                    $('#afficheBatiment').show();
                    $('#batiment').change(function() {
                        if (this.value != null) {
                            $('#afficheChambre').show();
                        }
                    });
                } else {
                    $('#afficheBatiment').hide();
                    $('#afficheChambre').hide();
                }
            });
        }
        if (this.value == 'NonBoursier') {
            cacheTout();
            $('#afficheNonBoursier').show();
        }
    });

});