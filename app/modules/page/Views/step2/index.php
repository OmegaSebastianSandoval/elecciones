<div class="general-container login-container email-container">
  <div class="container">
    <div class="row">
      <div class="col-md-6  order-2 order-md-1">
        <div class="row">
          <div class="col-12">
            <h3 class="title-one">Bienvenido(a)</h3>
          </div>
          <div class="col-12">
            <span class="title-two">
              <strong>Por favor actualice</strong>
              <br>
              su correo electrónico
            </span>
          </div>
          <div class="col-12">
            <form action="/page/step2/updateemail" class="row login-form" method="post" id="emailForm">
              <div class="col-12">
                <small class="green-text small-text input-small">
                  Identificación
                </small>
                <div class="form-group mt-2">
                  <img src="/skins/page/images/login-user.png" alt="">
                  <input type="text" placeholder="Identificación" name="user" value="<?php echo $this->user_info->cedula ?>" readonly>
                </div>
              </div>
              <div class="col-12">
                <small class="green-text small-text input-small">
                  Nombre de usuario
                </small>
                <div class="form-group mt-2">
                  <img src="/skins/page/images/login-user.png" alt="">
                  <input type="text" placeholder="Nombre de usuario" name="name" value="<?php echo $this->user_info->nombre ?>" readonly>
                </div>
              </div>
              <div class="col-12">
                <small class="green-text small-text input-small">
                  Correo electrónico
                </small>
                <div class="form-group mt-2">
                  <img src="/skins/page/images/login-email.png" alt="">
                  <input type="email" placeholder="Correo" name="email" value="<?php echo $this->user_info->correo ?>">
                </div>
              </div>
              <?php if ($this->votacion->votacion_pedir_telefono == 1) { ?>
                <div class="col-md-12">
                  <div class="form-group mb-0">
                    <img src="/skins/page/images/login-email.png" alt="">
                    <input type="nomber" placeholder="Teléfono" name="celular" value="<?php echo $this->user_info->celular ?>">
                  </div>
                  <small class="green-text small-text input-small">
                    Teléfono
                  </small>
                </div>
              <?php } ?>
              <div class="col-12">
                <div class="d-flex justify-content-center justify-content-md-end">
                  <button class="button">
                    <div class="text">
                      Actualizar
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6  order-1 order-md-2">
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
                Ingresar o confirmar el correo electrónico
              </span>
            </div>
          </div>
          <div class="col-12">
            <div class="d-flex justify-content-center justify-content-md-end">
              <img src="/skins/page/images/num02.png" alt="" class="step-number">
            </div>
          </div>
          <div class="col-12 d-none">
            <div class="d-flex justify-content-center justify-content-md-end">
              <span class="cian-text foot-text">
                Elección de delegados <br>
                2025 - 2027
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>