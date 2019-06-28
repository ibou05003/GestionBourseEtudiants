$(document).ready(function() {
    var chambres = {};
    $('#afficheChambre .input-group').each(function() {
        var select = $(this);
        chambres[select.attr('id')] = select;
        select.remove();
    });

    function cacheTout() {
        $('#afficheBoursier').hide();
        $('#afficheNonBoursier').hide();
        $('#afficheLoger').hide();
        $('#afficheBatiment').hide();
        $('#afficheChambre').hide();
    }
    cacheTout();

    $('input[type=radio][name=bourse]').change(function() {
        if (this.value == 'Boursier') {
            cacheTout();
            $('#afficheBoursier').show();
            $('#afficheLoger').show();
            $('input[type=checkbox][name=loger]').change(function() {
                if (this.checked) {
                    $('#afficheBatiment').show();

                    $('#batiment').change(function() {
                        var idBat = $(this).val();
                        if (idBat == 0) {
                            $('#afficheChambre').hide();
                        } else {
                            $('#afficheChambre').show();
                            $('#AChambre').empty().append(chambres['batiment-' + idBat]);
                            //$('#batiment-' + idBat).show().siblings().hide();
                            //$('#batiment-' + idBat).siblings().hide();
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
});