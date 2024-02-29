<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>comentarios</title>
    <!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link href="css/estilos.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>


    <link rel="stylesheet" href="..\assets\style\styles.css">
    <link rel="stylesheet" href="..\assets\style\style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="img/logotipo.jpg">
    <link rel="icon" type="image/png" sizes="32x32" href="img/logotipo.jpg">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logotipo.jpg">
    <link rel="manifest" href="\assets\img\site.webmanifest">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- INICIO Header -->
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <img src="assets/img/logotipo.jpg" alt="Logo" width="50" height="44"
                    class="d-inline-block align-text-top">
                <a href="img/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="home.html" class="nav-link px-2 link-secondary">home</a></li>
                    <li><a href="index.php" class="nav-link px-2 link-body-emphasis">tienda</a></li>
                    <li><a href="about.html" class="nav-link px-2 link-body-emphasis">Quienes somos</a></li>
                    <li><a href="politicas.html" class="nav-link px-2 link-body-emphasis">politicas de privacidad</a></li>
                    <li><a href="contacto.html" class="nav-link px-2 link-body-emphasis">contacto</a></li>  
                    <li><a href="comentarios.php" class="nav-link px-2 link-body-emphasis">comentarios</a></li>

                </ul>

            </div>
        </div>
    </header>
    <!-- FINHeader-->
<!-- inicio de cuerpo de los comentarios-->

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>dejanos una reseña acerca de nuestros servicios online</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel-body">

                    <!--Inicio elementos contenedor-->

                    <div class="comment-form-container">
                        <form id="frm-comment">
                            <div class="input-row">
                                <input type="hidden" name="comentario_id" id="commentId" placeholder="Name" /> <input class="input-field" type="text" name="name" id="name" placeholder="Nombres" />
                            </div>
                            <div class="input-row">
                                <textarea class="input-field" type="text" name="comment" id="comment" placeholder="Agregar comentario">  </textarea>
                            </div>
                            <div>
                                <input type="button" class="btn-submit" id="submitButton" value="Publicar Ahora" />
                                <div id="comment-message">Comentario ha sido agregado exitosamente!</div>
                            </div>
                            <div style="clear:both"></div>
                        </form>
                    </div>
                    <div id="output"></div>
                    <script>
                        var totalLikes = 0;
                        var totalUnlikes = 0;

                        function postReply(commentId) {
                            $('#commentId').val(commentId);
                            $("#name").focus();
                        }

                        $("#submitButton").click(function() {
                            $("#comment-message").css('display', 'none');
                            var str = $("#frm-comment").serialize();

                            $.ajax({
                                url: "AgregarComentario.php",
                                data: str,
                                type: 'post',
                                success: function(response) {
                                    var result = eval('(' + response + ')');
                                    if (response) {
                                        $("#comment-message").css('display', 'inline-block');
                                        $("#name").val("");
                                        $("#comment").val("");
                                        $("#commentId").val("");
                                        listComment();
                                    } else {
                                        alert("Failed to add comments !");
                                        return false;
                                    }
                                }
                            });
                        });

                        $(document).ready(function() {
                            listComment();
                        });

                        function listComment() {
                            $.post("ListaDeComentarios.php",
                                function(data) {
                                    var data = JSON.parse(data);

                                    var comments = "";
                                    var replies = "";
                                    var item = "";
                                    var parent = -1;
                                    var results = new Array();

                                    var list = $("<ul class='outer-comment'>");
                                    var item = $("<li>").html(comments);

                                    for (var i = 0;
                                        (i < data.length); i++) {
                                        var commentId = data[i]['comentario_id'];
                                        parent = data[i]['parent_comentario_id'];

                                        var obj = getLikesUnlikes(commentId);

                                        if (parent == "0") {
                                            if (data[i]['like_unlike'] >= 1) {
                                                like_icon = "<img src='img/MeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                                                like_icon += "<img style='display:none;' src='img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";
                                            } else {
                                                like_icon = "<img style='display:none;' src='img/MeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                                                like_icon += "<img src='img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";

                                            }

                                            comments = "\
                                        <div class='comment-row'>\
                                            <div class='comment-info'>\
                                                <span class='commet-row-label'>De</span>\
                                                <span class='posted-by'>" + data[i]['comment_sender_name'] + "</span>\
                                                <span class='commet-row-label'>a las </span> \
                                                <span class='posted-at'>" + data[i]['date'] + "</span>\
                                            </div>\
                                            <div class='comment-text'>" + data[i]['comment'] + "</div>\
                                            <div>\
                                                <a class='btn-reply' onClick='postReply(" + commentId + ")'>Responder</a>\
                                            </div>\
                                            <div class='post-action'>\ " + like_icon + "&nbsp;\
                                                <span id='likes_" + commentId + "'> " + totalLikes + " Me Gusta </span>\
                                            </div>\
                                        </div>";

                                            var item = $("<li>").html(comments);
                                            list.append(item);
                                            var reply_list = $('<ul>');
                                            item.append(reply_list);
                                            listReplies(commentId, data, reply_list);
                                        }
                                    }
                                    $("#output").html(list);
                                });
                        }

                        function listReplies(commentId, data, list) {

                            for (var i = 0;
                                (i < data.length); i++) {

                                var obj = getLikesUnlikes(data[i].comentario_id);
                                if (commentId == data[i].parent_comentario_id) {
                                    if (data[i]['like_unlike'] >= 1) {
                                        like_icon = "<img src='img/MeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                                        like_icon += "<img style='display:none;' src='img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";

                                    } else {
                                        like_icon = "<img style='display:none;' src='img/MeGusta.png'  id='unlike_" + data[i]['comentario_id'] + "' class='like-unlike'  onClick='likeOrDislike(" + data[i]['comentario_id'] + ",-1)' />";
                                        like_icon += "<img src='img/NoMeGusta.png' id='like_" + data[i]['comentario_id'] + "' class='like-unlike' onClick='likeOrDislike(" + data[i]['comentario_id'] + ",1)' />";

                                    }
                                    var comments = "\
                                        <div class='comment-row'>\
                                            <div class='comment-info'>\
                                                <span class='commet-row-label'>De </span>\
                                                <span class='posted-by'>" + data[i]['comment_sender_name'] + "</span>\
                                                <span class='commet-row-label'>a las </span> \
                                                <span class='posted-at'>" + data[i]['date'] + "</span>\
                                            </div>\
                                            <div class='comment-text'>" + data[i]['comment'] + "</div>\
                                            <div>\
                                                <a class='btn-reply' onClick='postReply(" + data[i]['comentario_id'] + ")'>Responder</a>\
                                            </div>\
                                            <div class='post-action'> " + like_icon + "&nbsp;\
                                                <span id='likes_" + data[i]['comentario_id'] + "'> " + totalLikes + " Me Gusta </span>\
                                            </div>\
                                        </div>";

                                    var item = $("<li>").html(comments);
                                    var reply_list = $('<ul>');
                                    list.append(item);
                                    item.append(reply_list);
                                    listReplies(data[i].comentario_id, data, reply_list);
                                }
                            }
                        }

                        function getLikesUnlikes(commentId) {

                            $.ajax({
                                type: 'POST',
                                async: false,
                                url: 'Envio_MeGusta.php',
                                data: {
                                    comentario_id: commentId
                                },
                                success: function(data) {
                                    totalLikes = data;
                                }

                            });

                        }


                        function likeOrDislike(comentario_id, like_unlike) {

                            $.ajax({
                                url: 'MeGusta_NoMeGusta.php',
                                async: false,
                                type: 'post',
                                data: {
                                    comentario_id: comentario_id,
                                    like_unlike: like_unlike
                                },
                                dataType: 'json',
                                success: function(data) {

                                    $("#likes_" + comentario_id).text(data + " likes");

                                    if (like_unlike == 1) {
                                        $("#like_" + comentario_id).css("display", "none");
                                        $("#unlike_" + comentario_id).show();
                                    }

                                    if (like_unlike == -1) {
                                        $("#unlike_" + comentario_id).css("display", "none");
                                        $("#like_" + comentario_id).show();
                                    }

                                },
                                error: function(data) {
                                    alert("error : " + JSON.stringify(data));
                                }
                            });
                        }
                    </script>

                    <!--Fin elementos contenedor-->
                </div>
            </div>
        </div>
    </div>
<!-- fin de cuerpo de los comentarios-->



    <!-- Footer-->
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
        </ul>
        <p class="text-center text-body-secondary">&copy; 2023 Company, Inc</p>
    </footer>
    <!-- fin Footer-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
        <script src="\js\bootstrap.min.js"></script>
</body>

</html>