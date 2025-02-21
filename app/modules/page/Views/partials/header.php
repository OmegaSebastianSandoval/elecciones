<div class="container h-100">

  <nav>
    <div class="nav-brand">
      <img src="/images/<?php echo $this->infopage->info_logo ?>" alt="">
    </div>
    <div class="steps-menu">
      <div class="step <?php echo $this->header_step == 1 ? 'active' : '' ?>">
        Ingreso de usuario
      </div>
      <div class="step <?php echo $this->header_step == 2 ? 'active' : '' ?>">
        Bienvenida
      </div>
      <div class="step <?php echo $this->header_step == 3 ? 'active' : '' ?>">
        Proceso
      </div>
      <div class="step <?php echo $this->header_step == 4 ? 'active' : '' ?>">
        Verificación
      </div>
      <div class="step <?php echo $this->header_step == 5 ? 'active' : '' ?>">
        Final del proceso
      </div>
    </div>
    <?php if (Session::getInstance()->get('user')) { ?>
      <div class="user-nav">
        <i class="fas fa-user"></i>
        <span class="small-text"><?php echo Session::getInstance()->get('user')->nombre; ?></span>

        <a href="/page/index/logout">
          <i class="fas fa-sign-out-alt" data-bs-toggle="tooltip" data-bs-title="Cerrar Sesión"></i>
        </a>
      </div>
    <?php } ?>
  </nav>
</div>