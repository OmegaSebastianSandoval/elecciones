<ul>
<li class="nav-item <?php if ($this->botonpanel == 2) { ?> active <?php } ?> ">
    <a href="/administracion/configlogin">
      <i class="fas fa-gears"></i> Configuración Login
    </a>
  </li>
  <li class="nav-item <?php if ($this->botonpanel == 7) { ?> active <?php } ?> ">
    <a href="/administracion/configvotacion">
      <i class="fas fa-gears"></i> Configuración Elecciones
    </a>
  </li>

  <li class="nav-item <?php if ($this->botonpanel == 5) { ?> active <?php } ?> ">
    <a href="/administracion/usuarioselecciones/elecciones?page=1">
      <i class="fas fa-gears"></i> Usuarios Elecciones
    </a>
  </li>

  <li class="nav-item <?php if ($this->botonpanel == 10) { ?> active <?php } ?> ">
    <a href="/administracion/usuarioselecciones/eleccionesgenerar?page=1">
      <i class="fas fa-gears"></i> Generar claves
    </a>
  </li>

  <li class="nav-item <?php if ($this->botonpanel == 6) { ?> active <?php } ?> ">
    <a href="/administracion/candidatos/elecciones?page=1">
      <i class="fas fa-gears"></i> Candidatos
    </a>
  </li>

  <li class="nav-item <?php if ($this->botonpanel == 8) { ?> active <?php } ?> ">
    <a href="/administracion/zonas/elecciones?page=1">
      <i class="fas fa-location-dot"></i> Administrar Zonas
    </a>
  </li>

  <li class="nav-item <?php if ($this->botonpanel == 11) { ?> active <?php } ?> ">
    <a href="/administracion/resultados/elecciones">
      <i class="fas fa-square-poll-vertical"></i> Resultados
    </a>
  </li>

</ul>