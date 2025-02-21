<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>
    <?= $this->_titlepage ?>
  </title>
    <!-- Jquery -->
    <script src="/components/jquery/jquery-3.6.0.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWYVxdF4VwIPfmB65X2kMt342GbUXApwQ&sensor=true">
  </script>
  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="/components/bootstrap-5.3/css/bootstrap.min.css">

  <link href='https://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css2?family=Euphoria+Script&family=Homemade+Apple&family=Miss+Fajardose&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css">
  <link rel="stylesheet" href="/components/bootstrap-fileinput/css/fileinput.css">
  <!-- SweetAlert -->
  <script src="/components/sweetalert/sweetalert.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/components/Font-Awesome/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link href="/components/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
  <link href="/components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet">
  <link rel="stylesheet" href="/skins/administracion/css/global.css?v=1.054">
  <script type="text/javascript">
    var map;
    var longitude = 0;
    var latitude = 0;
    var icon = '/skins/administracion/images/ubicacion.png';
    var point = false;
    var zoom = 10;

    function setValuesMap(longitud, latitud, punto, zoomm, icono) {
      longitude = longitud;
      latitude = latitud;
      if (punto) {
        point = punto;
      }
      if (zoomm) {
        zoom = zoomm;
      }
      if (icono) {
        icon = icono
      }
    }

    function initializeMap() {
      var mapOptions = {
        zoom: parseInt(zoom),
        center: new google.maps.LatLng(longitude, longitude),
      };
      // Place a draggable marker on the map
      map = new google.maps.Map(document.getElementById('map'), mapOptions);
      if (point == true) {
        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(longitude, latitude),
          map: map,
          icon: icon
        });
      }
      map.setCenter(new google.maps.LatLng(longitude, latitude));
    }
  </script>


  <!-- Jquery -->
  <script src="/components/jquery/jquery-3.6.0.min.js"></script>
  <script src="/scripts/popper.min.js"></script>
  <!-- Bootstrap Js -->
  <script src="/components/bootstrap-5.3/js/bootstrap.min.js"></script>

  <script src="/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="/components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"></script>
  <script src="/components/bootstrap-validator/dist/validator.min.js"></script>
  <script src="/components/bootstrap-fileinput/js/fileinput.min.js"></script>
  <script src="/components/bootstrap-fileinput/js/locales/es.js"></script>
  <!-- Tiny -->
  <script src="/components/tinymce/tinymce.min.js"></script>
  <script src="/components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="/components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
  <script src="/skins/administracion/js/main.js?v=1.0"></script>
</head>

<body>
  <header>
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-4">
          <?php if ($_SESSION['ingreso_temporal'] == "") { ?>
            <button type="button" class="btn d-flex align-items-center text-white" onclick="$('#panel-botones').toggle(300);"> <span class="navbar-toggler"><i class="fas fa-bars "></i></span> MENÚ</button>
            <img src="/corte/logowhy.png" class="logo-blanco d-none">
          <?php } ?>
        </div>
        <div class="col-8">
          <?= $this->_data['panel_header']; ?>
        </div>
      </div>
    </div>
  </header>
  <div class="container-fluid">
    <div class="row p-0" style="padding-right: 3px; padding-left: 3px;">
      <nav id="panel-botones">
        <?= $this->_data['panel_botones']; ?>
      </nav>
      <article id="contenido_panel" class="col-12">
        <section id="contenido_general">
          <?= $this->_content ?>
        </section>
      </article>
    </div>
  </div>
  <footer class="panel-derechos col-md-12">&copy; <?php echo date('Y') ?> Todos los derechos reservados | Diseñado por <a href="https://omegasolucionesweb.com/" target="_blank">OMEGA SOLUCIONES WEB</a>
  </footer>

</body>

</html>