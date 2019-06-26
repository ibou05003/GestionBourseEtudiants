$(document).ready(function() {

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