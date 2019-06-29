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
        $type = $('#typeBourse option:selected'),
        $batiment = $('#batiment'),
        $chambre = $('#chambre'),
        $loger = $('#loger'),
        $erreur = $('#erreur'),
        $choixBourse = $('#choixBourse'),
        $envoi = $('#ajouter'),
        $age = $('#age'),
        $montant = $('#montant'),
        $champ = $('.champ');

    $erreur.css('display', 'none'); // on prend soin de cacher le message d'erreur
    $choixBourse.css('display', 'none'); // on prend soin de cacher le message d'erreur
    $age.css('display', 'none'); // on prend soin de cacher le message d'erreur
    $montant.css('display', 'none'); // on prend soin de cacher le message d'erreur

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
            //alert($(this).val());
            var maintenant = new Date();
            //alert(maintenant);
            var maDateNaissance = new Date($(this).val());
            //alert(maDateNaissance.getFulllYear());
            var age = maintenant.getFullYear() - maDateNaissance.getFullYear();
            //alert(age);
            if (age > 30 || age < 18) { // si la chaîne de caractères est inférieure à 5
                $age.css('display', 'block'); // on affiche le message d'erreur
                $(this).css({ // on rend le champ rouge
                    borderColor: 'red',
                    color: 'red'
                });
            } else {
                $age.css('display', 'none'); // on prend soin de cacher le message d'erreur
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
        verifier($dateNaiss);
        verifierChoix();
        if ($('input[type=radio][name=bourse]').is(':checked') === true) {
            if ($('input[type=radio][name=bourse]').val() == 'Boursier') {
                if ($type.val() == 0) {
                    //alert('ok');
                    $montant.css('display', 'block'); // on affiche le message d'erreur
                    $type.css({ // on rend le champ rouge
                        borderColor: 'red',
                        color: 'red'
                    });
                } else {
                    $montant.css('display', 'none'); // on prend soin de cacher le message d'erreur
                }
                if ($('input[type=checkbox][name=loger]').is(':checked') === true) {
                    if ($batiment.val() == 0) {
                        $(this).css({ // on rend le champ rouge
                            borderColor: 'red',
                            color: 'red'
                        });
                    }
                }
            } else {
                verifier($adresse);
            }
        }
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
        if ($('input[type=radio][name=bourse]').is(':checked') === false) { // si le champ est vide
            $choixBourse.css('display', 'block'); // on affiche le message d'erreur
            $(this).css({ // on rend le champ rouge
                borderColor: 'red',
                color: 'red'
            });
        } else {
            $choixBourse.css('display', 'none'); // on prend soin de cacher le message d'erreur
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