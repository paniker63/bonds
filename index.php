
<!DOCTYPE html>
<html lang="ru">
<head>
<?php 
$website_title ='Ideas Burner';
require 'blocks/head.php'; 
?>   
</head>

<body>

    <?php require 'blocks/header.php'; ?>

   <main class="container mt-5">
                        <div class="row">
                             <div class="col-md-8 mb-3">

                                 <?php
                                 require_once 'mysql_connection.php';

                                 $sql = 'SELECT * FROM `articles` ORDER by `data` DESC';
                                 $query = $pdo->query($sql);
                                 while($row = $query->fetch(PDO::FETCH_OBJ)) {
                                     echo "<h2>$row->title</h2>
                                     <p>$row->intro</p>
                                     <p><b>Autor:</b><mark>$row->author</mark></p>
                                     <a href='news.php?id=$row->id' title='row->title'>
                                     <button class='btn btn-warning mb-5'> Read more</button>
                                     </a>"
                                     ;

                                 }
                                 ?>

                            </div>

    <?php require 'blocks/aside.php'; ?>
    

        </div>
    </main>

<?php require 'blocks/footer.php'; ?>

</body>
</html>