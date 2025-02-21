<div class="general-container login-container">
  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-6  order-2 order-md-1">
        <div class="row login-form shadow ">
          <div class="col-12">
            <h3 class="title-one">Bienvenido(a)</h3>
          </div>
          <div class="col-12 mb-4">
            <span class="title-two">
              Elección<strong> <span> Delegados</span></strong>
            </span>
            <h3 class="mt-4 text-center text-blue">Inicio de sesión</h3>
          </div>
          <div class="col-12">
            <form action="/page/index/login" class="row" method="post" id="loginForm" autocomplete="off">
              <div class="col-12">
                <div class="form-group">
                  <i class="fas fa-user"></i>
                  <input type="text" value="" placeholder="Identificación" autocomplete="off" name="user" id="user" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <i class="fas fa-lock"></i>
                  <input type="password" value="" placeholder="Contraseña" autocomplete="off" name="pass" id="pass" />
                </div>
              </div>
              <div class="col-md-12 d-none">
                <a href="" class="pass-retrieve-link">¿Olvidaste tu contraseña?</a>
              </div>
              <div class="col-12">
                <div class="d-flex justify-content-center">


                  <button class="button">

                    <div class="text">
                      Ingresar
                    </div>

                  </button>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-5 order-1 order-md-2">
        <div class="row">
          <div class="col-12">
            <div class="d-flex justify-content-center justify-content-md-end">
              <img src="/images/<?php echo $this->infopage->info_logo_grande ?>" alt="" class="logo-omega">
            </div>
          </div>
          <div class="col-12">
            <div class="d-flex justify-content-center justify-content-md-end align-items-center">
              <img src="/skins/page/images/check.png" alt="">
              <span class="check-text">
                Ingresar identificación y contraseña
              </span>
            </div>
          </div>
          <div class="col-12">
            <div class="d-flex justify-content-center justify-content-md-end">
              <img src="/skins/page/images/numeberblue.png" alt="" class="step-number">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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