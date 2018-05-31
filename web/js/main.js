$(document).ready(function () {
    checkAuthentification();
    livres();
    auteurs();
});

$(document).on('click', '#reset-livre', function () {
    $('#livre-id').val("");
    livres();
});

$(document).on('click', '#reset-auteur', function () {
    $('#auteur-id').val("");
    auteurs();
});

$(document).on('click', '#recherche-auteur', function () {
    auteur();
});

$(document).on('click', '#recherche-livre', function () {
    livre();
});

$(document).on('click', '.btn-add-commentaire', function () {
    var livreId = $(this).data('livre-id');
    $('#livre-id-commentaire').val(livreId);
});

$(document).on('click', '#add-commentaire-validation', function () {
    addCommentaire();
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
                        auteurs { 
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

function livres() {
    $.ajax({
        method: "POST",
        url: "http://localhost:8000/graphql",
        contentType: "application/json",
        headers: {
            token: $.cookie('token')
        },
        data: JSON.stringify({
            query: `query {
                        livres {
                            id,
                            titre,
                            genre,
                            date_parution,
                            prix,
                            auteur {
                              nom,
                              prenom
                            },
                            commentaires {
                              texte,
                              note
                            }
                        }
                    }`
        }),
        success: function (data) {
            var table = $('#table-livres').children('tbody');
            table.empty();

            if (data.length === 0) {
                table.append('<tr><td colspan="7">Aucuns résultats</td></tr>');
            } else {
                $.each(data.data.livres, function (key, value) {
                    if (value.commentaires.length === 0) {
                        var commentaires = "Aucuns Commentaires";
                    } else {
                        var commentaires = "<ul>";

                        $.each(value.commentaires, function (key, commentaire) {
                            commentaires += "<li>" + commentaire.texte + " (" + commentaire.note + ")</li>";
                        });

                        commentaires += "</ul>";
                    }

                    table.append(
                            '<tr>' +
                            '<td>' +
                            value.id +
                            '</td>' +
                            '<td>' +
                            value.titre +
                            '</td>' +
                            '<td>' +
                            value.genre +
                            '</td>' +
                            '<td>' +
                            $.format.date(value.date_parution, "dd/MM/yyyy") +
                            '</td>' +
                            '<td>' +
                            value.prix +
                            '</td>' +
                            '<td>' +
                            value.auteur.prenom + " " + value.auteur.nom +
                            '</td>' +
                            '<td>' +
                            commentaires +
                            '</td>' +
                            '<td>' +
                            '<a href="#add-commentaire" data-toggle="modal" data-target="#add-commentaire" class="btn btn-sm btn-success btn-add-commentaire" data-livre-id="' + value.id + '"><i class="glyphicon glyphicon-plus"></i> Ajouter un commentaire</a>' +
                            '</td>' +
                            '</tr>');
                });
            }
        }
    });
}

function addCommentaire() {
    var livreId = $('#livre-id-commentaire').val();
    var texte = $('#texte-commentaire').val();
    var note = $('#note-commentaire').val();

    if (livreId !== null && livreId !== "" && texte !== null && texte !== "" && note !== null && note !== "") {

        $.ajax({
            method: "POST",
            url: "http://localhost:8000/graphql",
            contentType: "application/json",
            headers: {
                token: $.cookie('token')
            },
            data: JSON.stringify({
                query: `mutation ($texte: String!, $note: Float!, $livre_id: ID!) {
                            addCommentaire(texte: $texte, note: $note, livre_id: $livre_id)
                       }`,
                variables: {
                    "texte": texte,
                    "note": parseFloat(note),
                    "livre_id": parseInt(livreId)
                }
            }),
            success: function (data) {
                if (data.data.livre !== null && data.data.livre !== "") {
                    livres();
                    $('#add-commentaire').modal('hide');
                } else {
                    console.log(data.errors);
                }
            }
        });
    } else {
        alert("Veuillez remplir le formulaire !");
    }
}

function livre() {
    var id = $('#livre-id').val();

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
                        livre(id: $id) { 
                            id,
                            titre,
                            genre,
                            date_parution,
                            prix,
                            auteur {
                              nom,
                              prenom
                            },
                            commentaires {
                              texte,
                              note
                            }
                        }
                    }`,
                variables: {
                    "id": parseInt(id)
                }
            }),
            success: function (data) {
                var table = $('#table-livres').children('tbody');
                table.empty();

                if (data.length === 0 || data.data.livre === null) {
                    table.append('<tr><td colspan="7">Aucuns résultats pour votre recherche</td></tr>');
                } else {
                    var livre = data.data.livre;

                    if (livre.commentaires.length === 0) {
                        var commentaires = "Aucuns Commentaires";
                    } else {
                        var commentaires = "<ul>";

                        $.each(livre.commentaires, function (key, commentaire) {
                            commentaires += "<li>" + commentaire.texte + " (" + commentaire.note + ")</li>";
                        });

                        commentaires += "</ul>";
                    }

                    table.append(
                            '<tr>' +
                            '<td>' +
                            livre.id +
                            '</td>' +
                            '<td>' +
                            livre.titre +
                            '</td>' +
                            '<td>' +
                            livre.genre +
                            '</td>' +
                            '<td>' +
                            $.format.date(livre.date_parution, "dd/MM/yyyy") +
                            '</td>' +
                            '<td>' +
                            livre.prix +
                            '</td>' +
                            '<td>' +
                            livre.auteur.prenom + " " + livre.auteur.nom +
                            '</td>' +
                            '<td>' +
                            commentaires +
                            '</td>' +
                            '<td>' +
                            '<a href="#add-commentaire" data-toggle="modal" data-target="#add-commentaire" class="btn btn-sm btn-success btn-add-commentaire" data-livre-id="' + livre.id + '"><i class="glyphicon glyphicon-plus"></i> Ajouter un commentaire</a>' +
                            '</td>' +
                            '</tr>');
                }
            }
        });
    }
}