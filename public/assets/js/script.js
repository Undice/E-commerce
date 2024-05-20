// Afficher des input pour changer le mot de passe de l'utilisateur sur son profil

let mdpChange = document.getElementById("mdpChange");
let mdpHide = document.getElementById("mdpHide");

if (mdpChange != null) {
    mdpChange.addEventListener('click', function () {
        if (mdpHide.classList.contains('d-none')) {
            mdpHide.classList.replace('d-none', 'd-block');
        }
        else {
            mdpHide.classList.replace('d-block', 'd-none');
        }
    });
}

// Récupérer l'id du département de l'input pour afficher toutes les villes qui correspondent au département choisis

let select = document.getElementById('dept');

if (select != null) {
    select.addEventListener('change', selectDept);
}

function selectDept() {
    let idDept = $('#dept').val();
    if (idDept == '') {
        villesDept.innerHTML = "";
        let premiereOption = document.createElement('option');
        premiereOption.text = "Sélectionnez d'abord un département";
        villesDept.appendChild(premiereOption);
    } else {
        $.ajax({
            url: '../controler/ajax.php?recup=departement',
            method: 'POST',
            dataType: 'json',
            data: { idDepartement: idDept },
            success: function (reponse) {
                let villesDept = document.getElementById('villeDept');
                villesDept.innerHTML = "";
                let premiereOption = document.createElement('option');
                premiereOption.text = "Sélectionnez une ville";
                villesDept.appendChild(premiereOption);
                for (let i = 0; i < reponse.length; i++) {
                    let cp = reponse[i].code_postal;
                    let tabCps = cp.split('-');
                    for (let j = 0; j < tabCps.length; j++) {
                        let option = document.createElement('option');
                        option.value = reponse[i].id_ville + '-' + tabCps[j];
                        option.text = reponse[i].nom_ville + ' (' + tabCps[j] + ')';
                        villesDept.appendChild(option);
                    }
                }
            }
        })
    }
}

// Montrer l'input mot de passe

let eye = document.getElementById('eye');

if (eye != null) {
    eye.addEventListener('click', function () {
        togglePassword();
        eye.classList.toggle('bi-eye-slash-fill')
    });
}

function togglePassword() {
    let mdp = document.getElementById('mdp');
    let mdpConfirm = document.getElementById('mdpConfirm');

    if (mdp.type === "password") {
        mdp.type = "text";
        if (mdpConfirm) {
            mdpConfirm.type = "text";
        }

    } else {
        mdp.type = "password";
        if (mdpConfirm) {
            mdpConfirm.type = "password";
        }
    }
};



// Récupérer tous les éléments html dont l'id commence par 'btn-'
let btnsModifsQte = document.querySelectorAll('[id^="btn-"]');
// console.log(btnsModifsQte);
//faire une boucle et casser avec - pour récupérer l'action et l'id

let nbBtns = btnsModifsQte.length;

for (let i = 0; i < nbBtns; i++) {
    btnsModifsQte[i].addEventListener('click', function () {
        // console.log(this);
        //récupère l'id de l'élément qui a été cliqué grâce au this.id (ex:'btn-moins-7')
        let id = this.id;
        // console.log(id);
        let tabBtn = id.split('-');
        //prend l'id et le sépare à chaque -, l'indice 0 correspond à btn, 1 correspond à l'action (plus ou moins) et 2 correspond à l'id du produit
        let action = tabBtn[1];
        let idProduit = tabBtn[2];
        // console.log('action :',action);
        // console.log('id produit :',idProduit); 

        let qteCom = 'qteCom';


        modifQteProd(qteCom, action, idProduit);
    })
}

function modifQteProd(qteCom, action, idProduit) {
    //bcjhcdddbd

    $.ajax({
        url: '../controler/ajax.php',
        method: 'GET',
        dataType: 'json',
        data: { recup: qteCom, action: action, idProd: idProduit },
        success: function (reponse) {
            // console.log(reponse);
            let quantity = document.getElementById("quantity-" + idProduit);
            let quantityValue = parseInt(quantity.value);
            let button = document.getElementById("btn-" + action + "-" + idProduit);
            // console.log(quantity);
            // return;

            console.log(button);
           

            let idBtnMoins = 'btn-moins-' + idProduit;
            let btnMoins = document.getElementById(idBtnMoins);

            let idBtnPlus = 'btn-plus-' + idProduit;
            let btnPlus = document.getElementById(idBtnPlus);

            if (action == 'plus') {

                let quantityStock = parseInt(quantity.getAttribute('max'));

                if (quantityValue < quantityStock) {
                    quantityValue = quantityValue + 1;
                } else {
                    button.setAttribute('disabled', '');
                }

            }

            // console.log(quantityValue);

            if (action == 'moins') {

                let min = 1;

                if (min < quantityValue) {
                    quantityValue = quantityValue - 1;
                } else {
                    button.setAttribute('disabled', '');
                }
            }

            quantity.value = quantityValue;

            montantTotal = document.getElementById('montant');
            montantTotal.innerText = reponse + ' €';

            montantTTC = document.getElementById('montantTTC');
            montantTTC.innerText = reponse + ' €';
            // Ajouter les frais de livraison et bons de réduction
        }
    })
}













// Augmenter la quantité pour ajouter un article au panier

let plus = document.getElementById('plus');

if (plus != null) {
    plus.addEventListener('click', addQuantity);
}

function addQuantity() {

    let stock = $('#quantity').attr('max');

    let quantity = $('#quantity').val();

    if (stock > quantity) {
        quantity = parseInt(quantity) + 1;
    }

    $('#quantity').val(quantity);
    //sinon message stock insuffisant
}

// Baisser la quantité pour ajouter un article au panier

let moins = document.getElementById('moins');

if (moins != null) {
    moins.addEventListener('click', removeQuantity);
}

function removeQuantity() {

    let min = $('#quantity').attr('min');

    let quantity = $('#quantity').val();

    if (min < quantity) {
        quantity = parseInt(quantity) - 1;
    }

    $('#quantity').val(quantity);
}

// Changer l'affichage de la boutique grâce à un système de tri
// Ici récupère quel tri a été choisi

let selectTri = document.getElementById('selectTri');
if (selectTri !== null) {
    selectTri.addEventListener('change', function () {
        let tri = selectTri.value;
        window.location.href = '../controler/traitement_tri.php?tri=' + tri;
    })
}

// Aficher ou cacher les filtres dans la page Boutique

let filterButton = document.getElementById("filterButton");
let filterHide = document.getElementById("filterHide");
let chevron = document.getElementById('chevron');

if (filterButton != null) {
    filterButton.addEventListener('click', function () {
        if (filterHide.classList.contains('d-none')) {
            filterHide.classList.replace('d-none', 'd-block');
            chevron.classList.remove('fa-chevron-down');
            chevron.classList.add('fa-chevron-up');
        }
        else {
            filterHide.classList.replace('d-block', 'd-none');
            chevron.classList.remove('fa-chevron-up');
            chevron.classList.add('fa-chevron-down');
        }
    });
}