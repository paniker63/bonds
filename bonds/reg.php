
<!DOCTYPE html>
<html lang="ru">
<head>
<?php 
	$website_title = "Registrtation";
	require 'blocks/head.php'; 
?>
	
</head>

<body>

    <?php require 'blocks/header.php'; ?>

   <main class="container mt-5">
                        <div class="row">
                             <div class="col-md-8">
                                	<h4>Registration</h4>
	                            <form action="" method="post">
	                                <label for="username">Name</label>
	                                <input type="text" name="username" id="username" class="form-control">

	                                <label for="email">Email</label>
	                                <input type="email" name="email" id="email" class="form-control">

	                                <label for="login">Login</label>
	                                <input type="text" name="login" id="login" class="form-control">

	                                <label for="pass">Pass</label>
	                                <input type="password" name="pass" id="pass" class="form-control">

	                                <div class="alert alert-danger mt-2" id="errorBlock"></div>

	                                <button type="button" id="reg_user" class="btn btn-success mt-5">
	                                	Make it done
	                                </button>
								</form>
                            </div>

    
<?php require 'blocks/aside.php'; ?>
        </div>
    </main>

<?php require 'blocks/footer.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script>
	$('#reg_user').click(function() {
		var name = $('#username').val();
		var email = $('#email').val();
		var login = $('#login').val();
		var pass = $('#pass').val();
	
		$.ajax({
			url: 'ajax/reg.php',
			type: 'POST',
			cache: false,
			data: {'username': name, 'email': email, 'login': login, 'pass': pass},
			datatype: 'html',
			success: function(data){
				if(data == 'Ready'){
					$('#reg_user').text('Vse gotovo');
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
