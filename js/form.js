$(document).ready(function() {
    var chambres = {};
    $('#AChambre .input-group').each(function() {
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
    var $nom = $('#nom'),
        $prenom = $('#prenom'),
        $mail = $('#mail'),
        $tel = $('#tel'),
        $dateNaiss = $('#dateNaiss'),
        $boursier = $('#boursier'),
        $nonboursier = $('#nonboursier'),
        $adresse = $('#adresse'),
        $type = $('#typeBourse'),
        $batiment = $('#batiment'),
        $chambre = $('#chambre'),
        $loger = $('#loger'),
        $erreur = $('#erreur'),
        $choixBourse = $('#choixBourse'),
        $envoi = $('#ajouter'),
        $champ = $('.champ');

    $erreur.css('display', 'none'); // on prend soin de cacher le message d'erreur
    $choixBourse.css('display', 'none'); // on prend soin de cacher le message d'erreur

    $champ.keyup(function() {
        if ($(this).val().length < 2) { // si la chaîne de caractères est inférieure à 5
            $(this).css({ // on rend le champ rouge
                borderColor: 'red',
                color: 'red'
            });
        } else {
            $(this).css({ // si tout est bon, on le rend vert
                borderColor: 'green',
                color: 'green'
            });
        }
    });

    $mail.keyup(function() {
        if (!$(this).val().match(/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/)) { // verif mail
            $(this).css({ // on rend le champ rouge
                borderColor: 'red',
                color: 'red'
            });
        } else {
            $(this).css({ // si tout est bon, on le rend vert
                borderColor: 'green',
                color: 'green'
            });
        }
    });

    $tel.keyup(function() {
        if ($(this).val().length < 9) { // si la confirmation est différente du mot de passe
            $(this).css({ // on rend le champ rouge
                borderColor: 'red',
                color: 'red'
            });
        } else {
            $(this).css({ // si tout est bon, on le rend vert
                borderColor: 'green',
                color: 'green'
            });
        }
    });

    $dateNaiss.keyup(function() {
        if ($(this).val().length < 10) { // si la chaîne de caractères est inférieure à 5
            $(this).css({ // on rend le champ rouge
                borderColor: 'red',
                color: 'red'
            });
        } else {
            if ($(this).val().length < 8) { // si la chaîne de caractères est inférieure à 5
                $(this).css({ // on rend le champ rouge
                    borderColor: 'red',
                    color: 'red'
                });
            } else {
                $(this).css({ // si tout est bon, on le rend vert
                    borderColor: 'green',
                    color: 'green'
                });
            }

        }
    });

    $envoi.click(function(e) {
        e.preventDefault(); // on annule la fonction par défaut du bouton d'envoi

        // puis on lance la fonction de vérification sur tous les champs :
        verifier($nom);
        verifier($prenom);
        verifier($mail);
        verifier($tel);
        //verifier($dateNaiss);
        verifierChoix();
    });

    function verifier(champ) {
        if (champ.val() == "") { // si le champ est vide
            $erreur.css('display', 'block'); // on affiche le message d'erreur
            champ.css({ // on rend le champ rouge
                borderColor: 'red',
                color: 'red'
            });
        }
    }

    function verifierChoix() {
        if ($boursier.val() == "" && $nonboursier.val() == "") { // si le champ est vide
            $choixBourse.css('display', 'block'); // on affiche le message d'erreur
            champ.css({ // on rend le champ rouge
                borderColor: 'red',
                color: 'red'
            });
        }
    }

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