<ul>
  <li class="nav-item dropdown <?php echo $this->botonActivoConfiguracion ? 'active show' : '' ?>">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fas fa-gears"></i> Configuración
    </a>
    <ul class="dropdown-menu dropdown-menu-dark">
      <li class="nav-item <?php if ($this->botonpanel == 2) { ?> active <?php } ?> ">
        <a href="/administracion/configlogin">
          <i class="fa-solid fa-lock"></i> Configuración Login
        </a>
      </li>
      <li class="nav-item <?php if ($this->botonpanel == 7) { ?> active <?php } ?> ">
        <a href="/administracion/configvotacion">
          <i class="fa-solid fa-check-to-slot"></i> Configuración Elecciones
        </a>
      </li>

      <li class="nav-item <?php if ($this->botonpanel == 5) { ?> active <?php } ?> ">
        <a href="/administracion/usuarioselecciones/elecciones?page=1">
          <i class="fa-solid fa-users"></i> Usuarios Elecciones
        </a>
      </li>

      <li class="nav-item <?php if ($this->botonpanel == 10) { ?> active <?php } ?> ">
        <a href="/administracion/usuarioselecciones/eleccionesgenerar?page=1">
          <i class="fa-solid fa-lock-open"></i>Generar claves
        </a>
      </li>

      <li class="nav-item <?php if ($this->botonpanel == 6) { ?> active <?php } ?> ">
        <a href="/administracion/candidatos/elecciones?page=1">
          <i class="fa-solid fa-users-rectangle"></i> Candidatos
        </a>
      </li>

      <li class="nav-item <?php if ($this->botonpanel == 8) { ?> active <?php } ?> ">
        <a href="/administracion/zonas/elecciones?page=1">
          <i class="fa-solid fa-location-dot"></i> Administrar Zonas
        </a>
      </li>
    </ul>
  </li>


  <li class="nav-item dropdown <?php if ($this->botonpanel == 11) { ?> active <?php } ?> ">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fas fa-square-poll-vertical"></i> Resultados
    </a>
    <ul class="dropdown-menu dropdown-menu-dark">
      <?php foreach ($this->listadoElecciones as $eleccion): ?>

        <li class="nav-item <?php if ($this->votacionActiva ==  $eleccion->id) { ?> active <?php } ?>">
          <a href="/administracion/resultados?votacion=<?= $eleccion->id ?>&page=1">
            <i class="fa-solid fa-square-poll-horizontal"></i> <?= $eleccion->votacion_titulo ?>
          </a>
        </li>
      <?php endforeach; ?>

    </ul>
  </li>
</ul>