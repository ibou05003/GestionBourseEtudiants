// Fonction de désactivation de l'affichage des "controle"
function desactiverControles() {
    var controles = document.querySelectorAll('.controle');
    var controlesTaille = controles.length;
    for (var i = 0; i < controlesTaille; i++) {
        controles[i].style.display = 'none';
    }
}

// La fonction ci-dessous permet de récupérer la "controle" qui correspond à notre input
function getControle(element) {
    while (elements = elements.nextSibling) {
        if (elements.className === 'controle') {
            return elements;
        }
    }

    return false;
}
// Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok

var check = {}; // On met toutes nos fonctions dans un objet littéral

check['nom'] = function(id) {
    var nom = document.getElementById(id);
    controleStyle = getControle(nom).style;
    if (nom.nodeValue.length >= 2) {
        nom.className = 'correct';
        controleStyle.display = 'none';
        return true;
    } else {
        nom.className = 'incorrect';
        controleStyle.display = 'inline-block';
        return false;
    }
}
check['prenom'] = check['nom'];

check['login'] = function() {

    var login = document.getElementById('login'),
        controleStyle = getControle(login).style;

    if (login.value.length >= 4) {
        login.className = 'correct';
        controleStyle.display = 'none';
        return true;
    } else {
        login.className = 'incorrect';
        controleStyle.display = 'inline-block';
        return false;
    }

};

check['password'] = function() {

    var pwd1 = document.getElementById('password'),
        controleStyle = getControle(pwd1).style;

    if (pwd1.value.length >= 6) {
        pwd1.className = 'correct';
        controleStyle.display = 'none';
        return true;
    } else {
        pwd1.className = 'incorrect';
        controleStyle.display = 'inline-block';
        return false;
    }

};

check['pwd2'] = function() {

    var pwd1 = document.getElementById('pwd1'),
        pwd2 = document.getElementById('pwd2'),
        tooltipStyle = getTooltip(pwd2).style;

    if (pwd1.value == pwd2.value && pwd2.value != '') {
        pwd2.className = 'correct';
        tooltipStyle.display = 'none';
        return true;
    } else {
        pwd2.className = 'incorrect';
        tooltipStyle.display = 'inline-block';
        return false;
    }

};

// Mise en place des événements

(function() { // Utilisation d'une IIFE pour éviter les variables globales.

    var formulaire = document.getElementById('formulaire'),
        inputs = document.querySelectorAll('input[type=text], input[type=password]'),
        inputsLength = inputs.length;

    for (var i = 0; i < inputsLength; i++) {
        inputs[i].addEventListener('keyup', function(e) {
            check[e.target.id](e.target.id); // "e.target" représente l'input actuellement modifié
        });
    }

    formulaire.addEventListener('submit', function(e) {

        var result = true;

        for (var i in check) {
            result = check[i](i) && result;
        }

        if (result) {
            alert('Le formulaire est bien rempli.');
        }

        e.preventDefault();

    });

    formulaire.addEventListener('reset', function() {

        for (var i = 0; i < inputsLength; i++) {
            inputs[i].className = '';
        }

        deactivateTooltips();

    });

})();

desactiverControles();