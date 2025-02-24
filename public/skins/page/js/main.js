$(document).ready(function () {
  $("#saveSelectionMultiple").on("submit", function (e) {
    // Deshabilitar el botón de submit al enviar el formulario
    $("#btn-select").prop("disabled", true);
  });

  /*   $("#selectCandidateMultiple").on("submit", function (e) {
    e.preventDefault();
    let candidates = $('input[name="candidate"]:checked')
      .map(function () {
        return $(this).val();
      })
      .get();

    console.log(candidates);

    if (candidates.length === 0) {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Selecciona al menos un candidato",
      });
      return false;
    } else {
      // Aquí puedes utilizar los candidatos seleccionados, por ejemplo, enviándolos como parámetros en la URL.
      window.location.href = "/page/step4?cs=" + candidates.join(",");
    }
  }); */

  const formularios = document.querySelectorAll(".formulario-eleccion");
  formularios.forEach(function (formulario) {
    formulario.addEventListener("submit", function (event) {
      let checkboxes = formulario.querySelectorAll(".checkbox");
      let radios = formulario.querySelectorAll(".radio");
      const maxVotes = parseInt(
        document.getElementById("cantidad-maxima").value
      );
      const cantidadCandidatos = parseInt(
        document.getElementById("cantidad-candidatos").value
      );
      let isChecked = false;

      let checkboxes_select = formulario.querySelectorAll(".checkbox:checked");

      let totalSeleccionados = checkboxes_select.length; // Contamos los seleccionados
      console.log(totalSeleccionados);
      if (totalSeleccionados > maxVotes) {
        Swal.fire({
          icon: "warning",
          title: "Límite de selección superado",
          text: "No puedes seleccionar más de " + maxVotes + " candidatos.",
        });
        event.preventDefault(); // Evita que el formulario se envíe
      }

      checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
          isChecked = true;
        }
      });

      radios.forEach(function (radio) {
        if (radio.checked) {
          isChecked = true;
        }
      });

      if (!isChecked && cantidadCandidatos >= 1) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Seleccione al menos un candidato",
          confirmButtonColor: "#af1c30",
          confirmButtonText: "Volver",
        });
        event.preventDefault(); // Evita que el formulario se envíe
      }
    });
  });

  $("#loginForm").on("submit", function (e) {
    event.preventDefault();
    let data = $(this).serialize();

    $.ajax({
      url: $(this).attr("action"),
      type: $(this).attr("method"),
      data: data,
      dataType: "json",
      success: function (data) {
        console.log(data);
        if (data.status == "success" && !data.voto) {
          // Verificar si las votaciones están abiertas
          if (data.votacion == "open") {
            Swal.fire({
              icon: "success",
              title: "Bienvenido",
              text: "Sesión iniciada correctamente",
              confirmButtonColor: "#af1c30",
              confirmButtonText: "Continuar",
            }).then((result) => {
              window.location.href = "/page/step3";
              // Si solicitan acutalizar datos
              // window.location.href = "/page/step2";
            });
          } else {
            // Votaciones cerradas
            Swal.fire({
              icon: "info",
              title: "Error",
              text: "Las votaciones están cerradas",
              confirmButtonColor: "#af1c30",
              confirmButtonText: "Volver",
            });
          }
        } else if (data.status == "inactive_user") {
          Swal.fire({
            icon: "info",
            title: "Error",
            text: "Señor asociado, no se encuentra activo.",
            confirmButtonColor: "#af1c30",
            confirmButtonText: "Volver",
          });
        } else if (data.status == "success" && data.voto) {
          Swal.fire({
            icon: "info",
            title: "Error",
            text: "Señor asociado, usted ya ha dado su voto.",
            confirmButtonColor: "#af1c30",
            confirmButtonText: "Volver",
          });
        } else if (data.status == "password_error") {
          Swal.fire({
            icon: "error",
            title: "Error",
            confirmButtonColor: "#af1c30",
            text: "Contraseña incorrecta",
            confirmButtonText: "Volver",
          });
        } else if (data.status == "user_not_found") {
          Swal.fire({
            icon: "error",
            title: "Error",
            confirmButtonColor: "#af1c30",
            confirmButtonText: "Volver",

            text: "Usuario no encontrado",
          });
        }
      },
    });
  });
});

var videos = [];
$(document).ready(function () {
  $(".dropdown-toggle").dropdown();
  $(".carouselsection").carousel({
    quantity: 4,
    sizes: {
      900: 3,
      500: 1,
    },
  });

  $(".banner-video-youtube").each(function () {
    // console.log($(this).attr('data-video'));
    const datavideo = $(this).attr("data-video");
    const idvideo = $(this).attr("id");
    const playerDefaults = {
      autoplay: 0,
      autohide: 1,
      modestbranding: 0,
      rel: 0,
      showinfo: 0,
      controls: 0,
      disablekb: 1,
      enablejsapi: 0,
      iv_load_policy: 3,
    };
    const video = {
      videoId: datavideo,
      suggestedQuality: "hd1080",
    };
    videos[videos.length] = new YT.Player(idvideo, {
      videoId: datavideo,
      playerVars: playerDefaults,
      events: {
        onReady: onAutoPlay,
        onStateChange: onFinish,
      },
    });
  });

  function onAutoPlay(event) {
    event.target.playVideo();
    event.target.mute();
  }

  function onFinish(event) {
    if (event.data === 0) {
      event.target.playVideo();
    }
  }

  // Inicialización de tooltips
  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
  );
  // Obtener todos los checkboxes del formulario
  const checkboxes = document.querySelectorAll(
    '.form-multiple input[type="checkbox"]'
  );

  // Contador para mantener el número de checkboxes seleccionados
  let contador = 0;
  const cantMax = document.getElementById("cantidad-maxima")?.value;

  // Referencia al checkbox de "VOTO EN BLANCO", si existe
  const votoEnBlancoCheckbox = document.querySelector(
    '[data-name="VOTO EN BLANCO"]'
  );

  // Función para manejar los cambios en los checkboxes
  function handleCheckboxChange(event) {
    // Verificar si el checkbox seleccionado es "VOTO EN BLANCO"
    if (votoEnBlancoCheckbox && event.target === votoEnBlancoCheckbox) {
      // Desmarcar otros checkboxes si se selecciona "VOTO EN BLANCO"
      checkboxes.forEach(function (checkbox) {
        if (checkbox !== event.target) {
          checkbox.checked = false;
        }
      });

      // Ajustar el contador según la selección de "VOTO EN BLANCO"
      contador = event.target.checked ? 1 : 0;
    } else {
      // Si el checkbox de "VOTO EN BLANCO" existe y está marcado, desmarcarlo
      if (votoEnBlancoCheckbox && votoEnBlancoCheckbox.checked) {
        votoEnBlancoCheckbox.checked = false;
        contador--;
      }

      // Incrementar o decrementar el contador según la selección del checkbox normal
      event.target.checked ? contador++ : contador--;

      // Verificar si se supera el límite de checkboxes seleccionados
      if (contador > cantMax) {
        // Desmarcar el checkbox si se supera el límite
        event.target.checked = false;
        contador--;
        Swal.fire({
          icon: "info",
          title: "Error",
          text: `Debe seleccionar máximo ${cantMax} candidatos `,
          confirmButtonColor: "#fe6960",
          confirmButtonText: "Continuar",
        });
      }
    }
  }

  // Agregar un evento change a cada checkbox
  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", handleCheckboxChange);

    // Incrementar el contador si el checkbox está marcado inicialmente
    if (checkbox.checked) {
      contador++;
    }
  });
});
