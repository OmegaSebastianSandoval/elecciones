<?php if ($_SESSION['ingreso_temporal'] == "") { ?>
	<div class="infousuario">

		<div class="welcome-text-bx">
			<span>
				<i class="fas fa-user"></i> Bienvenido Usuario: <strong><?= $_SESSION['kt_login_name'] ?></strong>
			</span>
		</div>
		<!-- <span><i class="fas fa-user-tie" aria-hidden="true"></i> Bienvenido(a): <?php echo $_SESSION['kt_login_name']; ?></span> -->
		<a href="/administracion/loginuser/logout" class="enlace-salir">Salir <i class="fas fa-sign-out-alt"></i></a></i>
	</div>
<?php } ?>