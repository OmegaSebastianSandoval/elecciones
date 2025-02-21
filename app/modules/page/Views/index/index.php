<div class="bx-general bx-login">
  <div class="row mx-0">
    <div class="col-md-6 login-bg">
      <img src="/images/<?= $this->login->config_login_imagen?>" alt="Imagen Home">
    </div>
    <div class="col-md-6">
      <div class="row w-100 text-center justify-content-center h-100 mx-auto">
        <div class="col-lg-9 col-md-10 col-12 d-flex justify-content-center align-items-center">
          <div class="row">
            <div class="col-12">
              <img src="/images/<?= $this->infopage->info_logo_grande?>" alt="logo" class="logo">
            </div>
            <div class="col-12">
              <h3 class="login-title"><?= $this->login->config_login_titulo?></h3>
            </div>
            <div class="col-lg-10 col-md-12 mx-auto">
            <?= $this->login->config_login_subtitulo	?>
            </div>

            <div class="col-xxl-6 col-lg-8 col-9 mt-2 mx-auto">
              <?php if($this->votacion){?>
              <form action="/page/index/login" class="row" method="post" id="loginForm">
                <label for="user" class="text-start p-0">Identificación</label>
                <input type="text" class="form-control mb-3" id="user" name="user" placeholder="Ej 9100000" onkeypress="return soloNumerosYGuion(event)" required>
                <label for="pass" class="text-start p-0">Contraseña</label>
                <input type="password" class="form-control mb-3" id="pass" name="pass" placeholder="*****"   required>
        
                <button class="button mx-auto" type="submit">INGRESAR</button>
              </form>
              <?php }else{?>
                <div class="alert alert-danger text-center">
                  <strong>Sin votaciones activas.</strong>
                </div>
              <?php }?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<style>
  header {
    display: none;
  }

  .contenedor-general {
    height: calc(100dvh - 60px);
  }
</style>
<script>
  function soloNumerosYGuion(event) {
    const charCode = event.keyCode ? event.keyCode : event.which;

    // Permitir números (0-9) y el guion (-)
    if (
      charCode !== 45 && // Código ASCII del guion "-"
      (charCode < 48 || charCode > 57) // Números (0-9)
    ) {
      event.preventDefault();
      return false;
    }

    return true;
  }
</script>

<?php if ($this->error == '1') { ?>
  <script>
    $(document).ready(function() {
      Swal.fire({
        icon: 'info',
        text: 'Señor asociado, usted ya ha dado su voto.',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#ec008c'
      })
    })
  </script>
<?php } ?>

<?php if ($this->error == '2') { ?>
  <script>
    $(document).ready(function() {
      Swal.fire({
        icon: 'info',
        text: 'Señor asociado, las votaciones han finalizado.',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#ec008c'
      })
    })
  </script>
<?php } ?>
<style>
  nav .nav-brand {

    width: 30%;
  }

  body.swal2-height-auto {
    height: 100dvh !important;
  }
</style>