$(document).ready(function () {
  $(".dropdown-link").on("click", function (e) {
    e.preventDefault();
    $(this).toggleClass("active");
    $(this).next().slideToggle();
    $(this).find(".dropdown-icon").toggleClass("rotate");
  });

  // Actualizar la etiqueta del archivo seleccionado
  $("#archivoCedula").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).next(".custom-file-label").html(fileName);
  });

  // Actualizar la etiqueta del archivo seleccionado
  $("#archivoDesprendible").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).next(".custom-file-label").html(fileName);
  });

  // Actualizar la etiqueta del archivo seleccionado
  $("#archivoPago").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).next(".custom-file-label").html(fileName);
  });

  $(".modalForm").on("submit", function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    console.log(formData);
    $.ajax({
      url: "/administracion/afiliacion/editarArchivos",
      type: "POST",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        $(".success-message").show();
      },
    });
  });
});
$(document).ready(function () {
  tinymce.init({
    selector: "textarea.tinyeditor", // change this value according to your HTML
    plugins: [
      "advlist",
      "autolink",
      "lists",
      "link",
      "image",
      "charmap",
      "preview",
      "anchor",
      "searchreplace",
      "visualblocks",
      "code",
      "fullscreen",
      "insertdatetime",
      "media",
      "table",
      "help",
      "wordcount",
      "code",
      "file-manager",
      "template",
    ],
    contextmenu: false,

    templates: [
      {
        title: "Blog - Sección 1",
        description: "Texto completo con imagen a la izquierda",
        content:
          '<div class="row align-items-center my-4">' +
          '<div class="col-12 col-md-12">' +
          "<h2>{{Título de la sección}}</h2>" +
          "<p>{{Contenido extenso para desarrollar el tema en detalle. Incluye más detalles para profundizar en el tema de esta sección.}}</p>" +
          "</div>" +
          '<div class="col-12 col-md-4">' +
          '<img src="https://placehold.co/300x200" alt="Imagen lateral" class="img-fluid ">' +
          "</div>" +
          '<div class="col-12 col-md-8">' +
          "<p>{{Contenido extenso para desarrollar el tema en detalle. Incluye más detalles para profundizar en el tema de esta sección.}}</p>" +
          "</div>" +
          '<div class="col-12 col-md-12">' +
          "<p>{{Contenido extenso para desarrollar el tema en detalle. Incluye más detalles para profundizar en el tema de esta sección.}}</p>" +
          "</div>" +
          '<div class="col-12 col-md-8">' +
          "<p>{{Contenido extenso para desarrollar el tema en detalle. Incluye más detalles para profundizar en el tema de esta sección.}}</p>" +
          "</div>" +
          '<div class="col-12 col-md-4">' +
          '<img src="https://placehold.co/300x200" alt="Imagen lateral" class="img-fluid ">' +
          "</div>" +
          '<div class="col-12">' +
          "</div>" +
          "</div>" +
          "-",
      },

      {
        title: "Blog - Sección 2",
        description: "Texto completo con imagen a la izquierda",
        content:
          '<div class="row align-items-center my-4">' +
          '<div class="col-12 col-md-12">' +
          "<h2>{{Título de la sección}}</h2>" +
          "<p>{{Contenido extenso para desarrollar el tema en detalle. Incluye más detalles para profundizar en el tema de esta sección.}}</p>" +
          "</div>" +
          '<div class="col-12 col-md-8">' +
          "<p>{{Contenido extenso para desarrollar el tema en detalle. Incluye más detalles para profundizar en el tema de esta sección.}}</p>" +
          "</div>" +
          '<div class="col-12 col-md-4">' +
          '<img src="https://placehold.co/300x200" alt="Imagen lateral" class="img-fluid ">' +
          "</div>" +
          '<div class="col-12 col-md-12">' +
          "<p>{{Contenido extenso para desarrollar el tema en detalle. Incluye más detalles para profundizar en el tema de esta sección.}}</p>" +
          "</div>" +
          '<div class="col-12 col-md-4">' +
          '<img src="https://placehold.co/300x200" alt="Imagen lateral" class="img-fluid ">' +
          "</div>" +
          '<div class="col-12 col-md-8">' +
          "<p>{{Contenido extenso para desarrollar el tema en detalle. Incluye más detalles para profundizar en el tema de esta sección.}}</p>" +
          "</div>" +
          '<div class="col-12">' +
          "</div>" +
          "</div>" +
          "-",
      },
      {
        title: "Dos columnas",
        description:
          "Dos columnas, y en celular se muestra una debajo de la otra",
        content:
          '<div class="row align-items-center my-4">' +
          '<div class="col-12 col-md-6">' +
          "<h2>{{Título de la sección}}</h2>" +
          '<img src="https://placehold.co/300x200" alt="Imagen lateral" class="img-fluid ">' +
          "</div>" +
          '<div class="col-12 col-md-6">' +
          "<h2>{{Título de la sección}}</h2>" +
          '<img src="https://placehold.co/300x200" alt="Imagen lateral" class="img-fluid ">' +
          "</div>" +
          "</div>" +
          "-",
      },
      {
        title: "Tres columnas",
        description:
          "Tres columnas, y en celular se muestra una debajo de la otra",
        content:
          '<div class="row align-items-center my-4">' +
          '<div class="col-12 col-md-4">' +
          '<img src="https://placehold.co/300x200" alt="Imagen lateral" class="img-fluid ">' +
          "</div>" +
          '<div class="col-12 col-md-4">' +
          '<img src="https://placehold.co/300x200" alt="Imagen lateral" class="img-fluid ">' +
          "</div>" +
          '<div class="col-12 col-md-4">' +
          '<img src="https://placehold.co/300x200" alt="Imagen lateral" class="img-fluid ">' +
          "</div>" +
          "</div>" +
          "-",
      },
    ],
    // Añadimos la configuración de tamaño de fuente en px
    font_size_formats:
      "1px 2px 3px 4px 5px 6px 7px 8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 31px 32px 33px 34px 35px 36px 37px 38px 39px 40px 41px 42px 43px 44px 45px 46px 47px 48px 49px 50px 51px 52px 53px 54px 55px 56px 57px 58px 59px 60px 61px 62px 63px 64px 65px 66px 67px 68px 69px 70px 71px 72px 73px 74px 75px 76px 77px 78px 79px 80px 81px 82px 83px 84px 85px 86px 87px 88px 89px 90px 91px 92px 93px 94px 95px 96px 97px 98px 99px 100px",

    toolbar:
      "undo redo | fontsize | blocks | template " +
      "bold italic backcolor | alignleft aligncenter " +
      "alignright alignjustify | bullist numlist outdent indent | " +
      "removeformat | Upload Flmngr ImgPen | code | help | temaClaro temaOscuro ",
    Flmngr: {
      urlFileManager: "/components/flmngr/flmngr.php",
      urlFiles: "/upload",
      acceptextensions: [
        "zip",
        "psd",
        "html",
        "doc",
        "xml",
        "pdf",
        "js",
        "txt",
      ],
    },
    image_advtab: true,
    a_plugin_option: true,
    language: "es",
    a_configuration_option: 400,
    browser_spellcheck: true,

    // content_css: "/skins/page/css/estilos.css",
    skin: "oxide-dark",
    // content_css: "tinymce-5-dark",

    setup: function (editor) {
      // Función para cambiar el tema
      function cambiarTema(cssPath) {
        const doc = editor.iframeElement.contentDocument || editor.getDoc();
        let linkElement = doc.getElementById("dynamic-theme");

        // Si ya existe un link, reemplázalo; si no, crea uno nuevo
        if (!linkElement) {
          linkElement = doc.createElement("link");
          linkElement.id = "dynamic-theme";
          linkElement.rel = "stylesheet";
          doc.head.appendChild(linkElement);
        }
        linkElement.href = cssPath;
      }

      // Botón para Tema Claro
      editor.ui.registry.addButton("temaClaro", {
        text: "Tema Claro",
        onAction: function () {
          cambiarTema("/skins/page/css/estilos.css");
        },
      });

      // Botón para Tema Oscuro
      editor.ui.registry.addButton("temaOscuro", {
        text: "Tema Oscuro",
        onAction: function () {
          cambiarTema("/skins/page/css/estilosdark.css");
        },
      });
    },
    content_css: "/skins/page/css/estilos.css", // Tema predeterminado
    content_style: "body { transition: background-color 0.3s, color 0.3s; }", // Transición suave
  });
  $(".file-image").fileinput({
    maxFileSize: 10000,
    previewFileType: "image",
    allowedFileExtensions: ["jpg", "jpeg", "gif", "png", "ico", "webp"],
    browseClass: "btn  btn-verde",
    showUpload: false,
    showRemove: false,
    browseIcon: '<i class="fas fa-image"></i> ',
    browseLabel: "Imagen",
    language: "es",
    dropZoneEnabled: false,
  });
  $(".file-document").fileinput({
    maxFileSize: 2048,
    previewFileType: "image",
    browseLabel: "Archivo",
    browseClass: "btn btn-guardar",
    allowedFileExtensions: ["pdf", "xlsx", "xls", "doc", "docx"],
    showUpload: false,
    showRemove: false,
    browseIcon: '<i class="fas fa-folder-open"></i> ',
    language: "es",
    dropZoneEnabled: false,
  });

  $(".file-robot").fileinput({
    maxFileSize: 2048,
    previewFileType: "image",
    allowedFileExtensions: ["txt", ".txt"],
    browseClass: "btn btn-success btn-file-robot me-2 p-1",
    showUpload: false,
    showRemove: false,
    browseLabel: "Robot",
    browseIcon: '<i class="fas fa-robot"></i> ',
    language: "es",
    dropZoneEnabled: false,
    showPreview: false,
  });

  $(".file-sitemap").fileinput({
    maxFileSize: 2048,
    previewFileType: "image",
    allowedFileExtensions: ["xml", ".xml"],
    browseClass: "btn btn-success btn-file-sitemap p-1",
    showUpload: false,
    showRemove: false,
    browseLabel: "SiteMap",
    browseIcon: '<i class="fas fa-sitemap"></i> ',
    language: "es",
    dropZoneEnabled: false,
    showPreview: false,
  });
  $('[data-toggle="tooltip"]').tooltip();
  $(".up_table,.down_table").click(function () {
    var row = $(this).parents("tr:first");
    var value = row.find("input").val();
    var content1 = row.find("input").attr("id");
    var content2 = 0;
    if ($(this).is(".up_table")) {
      if (row.prev().find("input").val() > 0) {
        row.find("input").val(row.prev().find("input").val());
        row.prev().find("input").val(value);
        content2 = row.prev().find("input").attr("id");
        row.insertBefore(row.prev());
      }
    } else {
      if (row.next().find("input").val() > 0) {
        row.find("input").val(row.next().find("input").val());
        row.next().find("input").val(value);
        content2 = row.next().find("input").attr("id");
        row.insertAfter(row.next());
      }
    }
    var route = $("#order-route").val();
    var csrf = $("#csrf").val();
    console.log(route);
    if (route != "") {
      $.post(route, { csrf: csrf, id1: content1, id2: content2 });
    }
  });

  $(".selectpagination").change(function () {
    var route = $("#page-route").val();
    var pages = $(this).val();
    $.post(route, { pages: pages }, function () {
      location.reload();
    });
  });

  $(".changetheme").on("change", function () {
    var color = "#FFFFFF";

    var contenedor = $(this).attr("data-campo-tiny");
    if ($(this).val() == 1) {
      color = "#333333";
    }
    var editor = window.tinyMCE.get(contenedor);
    editor.getWin().document.body.style.backgroundColor = color;
  });

  $(".switch-form").bootstrapToggle({
    on: "Si",
    off: "No",
    onstyle: "custom-on",
    offstyle: "custom-off",
  });

  $("#contenido_tipo").on("change", function () {
    var value = $(this).val();
    if (parseInt(value) == 1) {
      //Si es un banner
      $(".no-seccion").hide();
      $(".no-banner").hide();
      $(".no-contenido").hide();
      $(".si-banner").show();
    } else if (parseInt(value) == 2) {
      //Si es un Contenedor
      $(".no-seccion").hide();
      $(".no-banner").hide();
      $(".no-contenido").hide();
      $(".si-seccion").show();
    } else if (parseInt(value) == 3) {
      //Si es un contenido simple
      $(".no-seccion").hide();
      $(".no-banner").hide();
      $(".no-contenido").hide();
      $(".si-contenido").show();
    } else if (parseInt(value) == 5) {
      //Si es un contenido de Contenedor
      $(".no-acordion").hide();
      $(".no-carrousel").hide();
      $(".no-contenido2").hide();
      $(".si-contenido2").show();
    } else if (parseInt(value) == 6) {
      //Si es un contenido de Contenedor
      $(".no-contenido2").hide();
      $(".no-acordion").show();
      $(".no-carrousel").hide();
      $(".si-carrousel").show();
    } else if (parseInt(value) == 7) {
      //Si es un banner
      $(".no-acordion").hide();
      $(".no-contenido2").hide();
      $(".no-acordion").hide();
      $(".no-carrousel").hide();
      $(".si-acordion").show();
    }
  });
  $(".colorpicker")
    .colorpicker({
      onChange: function (e) {
        console.log("entro");
      },
    })
    .on("colorpickerChange colorpickerCreate", function (e) {
      console.log("entro");
      // console.log( e.colorpicker.picker.parents('.input-group'));
      //e.colorpicker.picker.parents('.input-group').find('input').css('background-color', e.value);
    })
    .on("create", function (e) {
      var val = $(this).val();
      $(this).css({ backgroundColor: $(this).val() });
    })
    .on("change", function (e) {
      var val = $(this).val();
      $(this).css({ backgroundColor: $(this).val() });
    });
  $(".colorpicker").colorpicker();
});

function eliminarImagen(campo, ruta) {
  var csrf = $("#csrf").val();
  var csrf_section = $("#csrf_section").val();
  var id = $("#id").val();
  if (confirm("¿Esta seguro de borrar esta imagen?") == true) {
    $.post(
      ruta,
      { id: id, csrf: csrf, csrf_section: csrf_section, campo: campo },
      function (data) {
        if (parseInt(data.elimino) == 1) {
          $("#imagen_" + campo).hide();
        }
      }
    );
  }
  return false;
}

function puntitos(donde) {
  var caracter = donde.value.charAt(donde.value.length - 1);
  var pat = /[\*,\+,\(,\),\?,\,$,\[,\],\^]/;
  var valor = donde.value;
  var largo = valor.length;
  var crtr = true;

  if (isNaN(caracter) || pat.test(caracter) == true) {
    if (pat.test(caracter) == true) {
      //caracter = '\' + caracter;
    }
    carcter = new RegExp(caracter, "g");
    valor = valor.replace(carcter, "");
    donde.value = valor;
    crtr = false;
  } else {
    var nums = new Array();
    cont = 0;
    for (m = 0; m < largo; m++) {
      if (valor.charAt(m) == "." || valor.charAt(m) == " ") {
        continue;
      } else {
        nums[cont] = valor.charAt(m);
        cont++;
      }
    }
  }

  var cad1 = "",
    cad2 = "",
    tres = 0;
  if (largo > 3 && crtr == true) {
    for (k = nums.length - 1; k >= 0; k--) {
      cad1 = nums[k];
      cad2 = cad1 + cad2;
      tres++;
      if (tres % 3 == 0) {
        if (k != 0) {
          cad2 = "." + cad2;
        }
      }
    }
    donde.value = cad2;
  }
  if (donde.value == "") {
    //donde.value=0;
  }
}

function invalidInput(x) {
  let value = x.id;
  console.log(value);
  $("label[for='" + value + "']").css("color", "#dc3545");
}
/* 
$(document).ready(function() {
  $('form').on('submit', function(event) {
      var isValid = true;
      var firstInvalidField = null;

      // Recorrer todos los campos requeridos
      $(this).find('input[required], select[required], textarea[required]').each(function() {
          var fieldType = $(this).attr('type');

          if (fieldType === 'checkbox') {
              // Validar checkbox
              if (!$(this).is(':checked')) {
                  isValid = false;
                  if (firstInvalidField === null) {
                      firstInvalidField = $(this);
                  }
                  $(this).addClass('is-invalid'); // Agregar clase de error de Bootstrap
              } else {
                  $(this).removeClass('is-invalid');
              }
          } else {
              // Validar otros tipos de input y select
              if (!$(this).val().trim()) {
                  isValid = false;
                  if (firstInvalidField === null) {
                      firstInvalidField = $(this);
                  }
                  $(this).addClass('is-invalid'); // Agregar clase de error de Bootstrap
              } else {
                  $(this).removeClass('is-invalid');
              }
          }
      });

      if (!isValid) {
          event.preventDefault(); // Evitar el envío del formulario
          $('html, body').animate({
              scrollTop: firstInvalidField.offset().top - 250 // Ajusta el desplazamiento según sea necesario
          }, 500);
          firstInvalidField.focus(); // Enfocar el primer campo inválido
      }
  });
}); */
