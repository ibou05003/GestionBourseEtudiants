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
        $bat = $('#bat'),
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
    $bat.css('display', 'none'); // on prend soin de cacher le message d'erreur

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
        var valid = true;

        // puis on lance la fonction de vérification sur tous les champs :
        valid = verifier($nom);
        valid = verifier($prenom);
        valid = verifier($mail);
        valid = verifier($tel);
        valid = verifier($dateNaiss);
        valid = verifierChoix();
        if ($('input[type=radio][name=bourse]').is(':checked') === true) {
            if ($('input[type=radio][name=bourse] :checked').val() == 'Boursier') {
                if ($type.val() == 0) {
                    //alert('ok');
                    valid = false;
                    $montant.css('display', 'block'); // on affiche le message d'erreur
                    // $type.css({ // on rend le champ rouge
                    //     borderColor: 'red',
                    //     color: 'red'
                    // });
                    // $type.change(function() {
                    //     alert('ok');
                    //     if ($type.val() != 0) {
                    //         alert('ok');
                    //         $montant.css('display', 'none'); // on prend soin de cacher le message d'erreur
                    //     }
                    // });
                } else {
                    //alert('ok');
                    $montant.css('display', 'none'); // on prend soin de cacher le message d'erreur
                }
                if ($('input[type=checkbox][name=loger]').is(':checked') === true) {
                    if ($batiment.val() == 0) {
                        valid = false;
                        $bat.css('display', 'block'); // on affiche le message d'erreur
                        // $(this).css({ // on rend le champ rouge
                        //     borderColor: 'red',
                        //     color: 'red'
                        // });
                    } else {
                        $bat.css('display', 'none'); // on prend soin de cacher le message d'erreur
                    }
                }
            } else {
                valid = verifier($adresse);
            }
        }
        return valid;
    });

    function verifier(champ) {
        if (champ.val() == "") { // si le champ est vide
            $erreur.css('display', 'block'); // on affiche le message d'erreur
            champ.css({ // on rend le champ rouge
                borderColor: 'red',
                color: 'red'
            });
            return false;
        }
        return true;
    }

    function verifierChoix() {
        if ($('input[type=radio][name=bourse]').is(':checked') === false) { // si le champ est vide
            $choixBourse.css('display', 'block'); // on affiche le message d'erreur
            $(this).css({ // on rend le champ rouge
                borderColor: 'red',
                color: 'red'
            });
            return false;
        } else {
            $choixBourse.css('display', 'none'); // on prend soin de cacher le message d'erreur
            return true;
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