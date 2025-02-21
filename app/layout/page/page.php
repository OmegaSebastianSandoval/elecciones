<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title><?= $this->_titlepage ?></title>
  <?php $infopageModel = new Page_Model_DbTable_Informacion();
  $infopage = $infopageModel->getById(1);
  ?>

  <!-- Jquery -->
  <script src="/components/jquery/jquery-3.6.0.min.js"></script>
  <!-- Skins Carousel -->
  <link rel="stylesheet" type="text/css" href="/scripts/carousel/carousel.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/components/bootstrap-5.3/css/bootstrap.min.css">
  <!-- Slick CSS -->
  <!--   <link rel="stylesheet" href="/components/slick/slick.css">
  <link rel="stylesheet" href="/components/slick/slick-theme.css"> -->
  <!-- Global CSS -->
  <link rel="stylesheet" href="/skins/page/css/global.css">
  <link rel="stylesheet" href="/skins/page/css/responsive.css">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="/components/Font-Awesome/css/all.css">
  <link rel="shortcut icon" href="/images/<?= $infopage->info_pagina_favicon; ?>">

  <!-- metacolor -->
  <meta name="theme-color" content="#5475a1">

  <script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>
  <!-- Popper -->
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <!-- Bootstrap Js -->
  <script src="/components/bootstrap-5.3/js/bootstrap.min.js"></script>

  <!-- Carousel -->
  <script type="text/javascript" src="/scripts/carousel/carousel.js"></script>
  <!-- Slick -->
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <!-- <script src="/components/fullpage/slick/slick.min.js"></script> -->

  <!-- <script src="/components/jquery-knob/js/jquery.knob.js"></script> -->

  <!-- SweetAlert -->
  <!-- SweetAlert -->
  <script src="/components/sweetalert/sweetalert.js"></script>

  

  <!-- Recaptcha -->
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <meta name="description" content="<?= $this->_data['meta_description']; ?>" />
  <meta name=" keywords" content="<?= $this->_data['meta_keywords']; ?>" />
  <?php echo $this->_data['scripts'];  ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWYVxdF4VwIPfmB65X2kMt342GbUXApwQ&sensor=true"></script>
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
</head>

<body>
  <header>
    <?= $this->_data['header']; ?>
  </header>

  <main class="contenedor-general">
    <?= $this->_content ?>
  </main>


  <footer>
    <?= $this->_data['footer']; ?>
  </footer>


<!-- Main Js -->
  <script src="/skins/page/js/main.js?v=3.51"></script>

</body>

</html>