const sweet = {};

const loader = document.querySelector(".loader-container");

sweet.error = ({
  status = 500,
  message = "Ocurrió un error inesperado",
  title = "Error",
  autoClose = false,
  allowOutsideClick = false,
  type = "error",
}) => {
  loader && loader.classList.add("d-none");

  console.error(status, message);

  switch (status) {
    case 403:
      console.log("falta");
      break;
    default:
      Swal.fire({
        title,
        html: message,
        icon: type,
        confirmButtonText: "Aceptar",
        allowOutsideClick,
        timer: autoClose ? 5000 : null,
      });
      break;
  }
};

sweet.warning = ({
  title = "Advertencia",
  message = "¡Cuidado!",
  autoClose = false,
  allowOutsideClick = false,
  type = "warning",
}) => {
  loader && loader.classList.add("d-none");

  Swal.fire({
    title,
    html: message,
    icon: type,
    confirmButtonText: "Aceptar",
    allowOutsideClick,
    timer: autoClose ? 5000 : null,
  });
};

sweet.success = ({
  title = "Éxito",
  message = "¡Bien hecho!",
  autoClose = false,
  allowOutsideClick = false,
  type = "success",
  callback = null,
}) => {
  loader && loader.classList.add("d-none");

  Swal.fire({
    title,
    html: message,
    icon: type,
    confirmButtonText: "Aceptar",
    allowOutsideClick,
    timer: autoClose ? 5000 : null,
  }).then((result) => {
    if (callback) {
      callback(result);
    }
  });
};

sweet.confirm = async function ({
  message = "",
  title = "¿Estás seguro?",
  confirmButtonText = "Aceptar",
  cancelButtonText = "Cancelar",
  icon = "question",
  allowOutsideClick = false,
  allowEscapeKey = false,
}) {
  return new Promise((resolve) => {
    Swal.fire({
      title,
      html: message,
      icon,
      showCancelButton: true,
      confirmButtonText,
      cancelButtonText,
      allowOutsideClick,
      allowEscapeKey,
      allowEnterKey: false,
      stopKeydownPropagation: false,
    }).then((result) => {
      resolve(result.isConfirmed);
    });
  });
};

sweet.info = function ({
    message = "Proceso realizado exitosamente",
    title = "¡Éxito!",
    autoClose = false,
    allowOutsideClick = true,
    type = "info",
    showCancelButton = false,
    showCloseButton = false,
  }) {
    sweet.success({
      message,
      title,
      autoClose,
      allowOutsideClick,
      type,
      showCancelButton,
      showCloseButton,
    });
  };

export default sweet;
