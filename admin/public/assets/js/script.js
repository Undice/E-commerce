let select = document.getElementById('dept');
// console.log('select',select)

function selectDept() {
    let idDept = $('#dept').val();
    if (idDept == '') {
        villesDept.innerHTML = "";
        let premiereOption = document.createElement('option');
        premiereOption.text = "Sélectionnez d'abord un département";
        villesDept.appendChild(premiereOption);
    } else {
        $.ajax({
            url: '../controler/ajax.php',
            method: 'GET',
            dataType: 'json',
            data: { idDepartement: idDept },
            success: function (reponse) {
                // console.log(reponse);
                // return;
                let villesDept = document.getElementById('villeDept');
                villesDept.innerHTML = "";
                let premiereOption = document.createElement('option');
                premiereOption.text = "Sélectionnez une ville";
                villesDept.appendChild(premiereOption);
                for (let i = 0; i < reponse.length; i++) {
                    let cp = reponse[i].code_postal;
                    // console.log(reponse[i].code_postal);
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

if (select != null) {
    select.addEventListener('change', selectDept);
}

if (select != null) {
    select.addEventListener('change', selectDept);
}




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