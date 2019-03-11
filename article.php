<?php

if($_COOKIE['log'] == '') {
    header('Location: /reg.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php
    $website_title = "Adding article";
    require 'blocks/head.php';
    ?>

</head>

<body>

<?php require 'blocks/header.php'; ?>

<main class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h4>Adding article</h4>
            <form action="" method="post">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control">

                <label for="intro">Intro</label>
                <textarea name="intro" id="intro" class="form-control"></textarea>

                <label for="text">Text</label>
                <textarea name="text" id="text" class="form-control"></textarea>


                <div class="alert alert-danger mt-2" id="errorBlock"></div>

                <button type="button" id="article_send" class="btn btn-success mt-5">
                    Add article
                </button>
            </form>
        </div>


        <?php require 'blocks/aside.php';?>
    </div>
</main>

<?php require 'blocks/footer.php';?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $('#article_send').click(function () {
        var title = $('#title').val();
        var intro = $('#intro').val();
        var text = $('#text').val();

        $.ajax({
            url: 'ajax/add_article.php',
            type: 'POST',
            cache: false,
            data: {'title': title, 'intro': intro, 'text': text},
            datatype: 'html',
            success: function(data) {
                if(data == 'Ready') {
                    $('#article_send').text('Vse gotovo');
                    $('#errorBlock').hide();
                }
                else {
                    $('#errorBlock').show();
                    $('#errorBlock').text(data);
                }
            }
        });
    });
</script>

</body>
</html>
