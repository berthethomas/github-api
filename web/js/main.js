$(document).ready(function () {
    checkAuthentification();
});

$(document).on('click', '#tab-auteurs', function () {
    auteurs();
});

$(document).on('click', '#recherche-auteur', function () {
    auteur();
});

function authentification() {
    var login = "azertyuiop";

    $.ajax({
        method: "POST",
        url: "http://localhost:8000/graphql",
        contentType: "application/json",
        data: JSON.stringify({
            query: `mutation ($token: String!) {
                            authentification(token: $token)
                       }`,
            variables: {
                "token": login
            }
        }),
        success: function (data) {
            if (data.data.authentification !== null && data.data.authentification !== "") {
                $.cookie("token", data.data.authentification, {expires: 10});
            } else {
                console.log(data.errors);
            }
        }
    });
}

function checkAuthentification() {
    if ($.cookie("token")) {
        return true;
    }
    authentification();
}

function auteurs() {
    $.ajax({
        method: "POST",
        url: "http://localhost:8000/graphql",
        contentType: "application/json",
        headers: {
            token: $.cookie('token')
        },
        data: JSON.stringify({
            query: `query {
                        auteurs() { 
                            id,
                            nom,
                            prenom,
                            date_naissance,
                            livres {
                                titre
                            }
                        }
                    }`
        }),
        success: function (data) {
            var table = $('#table-auteurs').children('tbody');
            table.empty();

            if (data.length === 0) {
                table.append('<tr><td colspan="5">Aucuns résultats</td></tr>');
            } else {
                $.each(data.data.auteurs, function (key, value) {
                    if (value.livres.length === 0) {
                        var livres = "Aucuns livres";
                    } else {
                        var livres = "<ul>";

                        $.each(value.livres, function (key, livre) {
                            livres += "<li>" + livre.titre + "</li>";
                        });

                        livres += "</ul>";
                    }

                    table.append(
                            '<tr>' +
                            '<td>' +
                            value.id +
                            '</td>' +
                            '<td>' +
                            value.nom +
                            '</td>' +
                            '<td>' +
                            value.prenom +
                            '</td>' +
                            '<td>' +
                            $.format.date(value.date_naissance, "dd/MM/yyyy") +
                            '</td>' +
                            '<td>' +
                            livres +
                            '</td>' +
                            '</tr>');
                });
            }
        }
    });
}

function auteur() {
    var id = $('#auteur-id').val();

    if (id === null || id === "") {
        alert("Vous devez rensigner un ID !");
    } else {
        $.ajax({
            method: "POST",
            url: "http://localhost:8000/graphql",
            contentType: "application/json",
            headers: {
                token: $.cookie('token')
            },
            data: JSON.stringify({
                query: `query($id: Int!) {
                        auteur(id: $id) { 
                            id,
                            nom,
                            prenom,
                            date_naissance,
                            livres {
                                titre
                            }
                        }
                    }`,
                variables: {
                    "id": parseInt(id)
                }
            }),
            success: function (data) {
                var table = $('#table-auteurs').children('tbody');
                table.empty();

                if (data.length === 0 || data.data.auteur === null) {
                    table.append('<tr><td colspan="5">Aucuns résultats pour votre recherche</td></tr>');
                } else {
                    var auteur = data.data.auteur;
                    console.log(data.data);
                    if (auteur.livres.length === 0) {
                        var livres = "Aucuns livres";
                    } else {
                        var livres = "<ul>";

                        $.each(auteur.livres, function (key, livre) {
                            livres += "<li>" + livre.titre + "</li>";
                        });

                        livres += "</ul>";
                    }

                    table.append(
                            '<tr>' +
                            '<td>' +
                            auteur.id +
                            '</td>' +
                            '<td>' +
                            auteur.nom +
                            '</td>' +
                            '<td>' +
                            auteur.prenom +
                            '</td>' +
                            '<td>' +
                            $.format.date(auteur.date_naissance, "dd/MM/yyyy") +
                            '</td>' +
                            '<td>' +
                            livres +
                            '</td>' +
                            '</tr>');
                }
            }
        });
    }
}