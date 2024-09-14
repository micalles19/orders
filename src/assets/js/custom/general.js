const getURLParam = (parameterName) => {
  parameterName = parameterName.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");

  let regex = new RegExp("[\\?&]" + parameterName + "=([^&#]*)"),
    result = regex.exec(location.search);

  return result === null
    ? ""
    : decodeURIComponent(result[1].replace(/\+/g, " "));
};

const validatePassword = (passwordField) => {
  let password = passwordField.value;
  const lengthAlert = document.querySelector(".password-rules-icon-length"),
    numberAlert = document.querySelector(".password-rules-icon-number"),
    uppercaseAlert = document.querySelector(".password-rules-icon-uppercase"),
    lowercaseAlert = document.querySelector(".password-rules-icon-lowercase");

  let isValidPassword = true;

  lengthAlert.querySelector("i").classList.remove("fa-check");
  lengthAlert.querySelector("i").classList.add("fa-times");
  numberAlert.querySelector("i").classList.remove("fa-check");
  numberAlert.querySelector("i").classList.add("fa-times");
  uppercaseAlert.querySelector("i").classList.remove("fa-check");
  uppercaseAlert.querySelector("i").classList.add("fa-times");
  lowercaseAlert.querySelector("i").classList.remove("fa-check");
  lowercaseAlert.querySelector("i").classList.add("fa-times");

  if (password.length >= 6) {
    lengthAlert.querySelector("i").classList.remove("fa-times");
    lengthAlert.querySelector("i").classList.add("fa-check");
  } else {
    isValidPassword = false;
  }

  if (password.match(/\d/g)) {
    numberAlert.querySelector("i").classList.remove("fa-times");
    numberAlert.querySelector("i").classList.add("fa-check");
  } else {
    isValidPassword = false;
  }

  if (password.match(/[A-Z]/g)) {
    uppercaseAlert.querySelector("i").classList.remove("fa-times");
    uppercaseAlert.querySelector("i").classList.add("fa-check");
  } else {
    isValidPassword = false;
  }

  if (password.match(/[a-z]/g)) {
    lowercaseAlert.querySelector("i").classList.remove("fa-times");
    lowercaseAlert.querySelector("i").classList.add("fa-check");
  } else {
    isValidPassword = false;
  }

  return isValidPassword;
};

const invertPasswordType = (element) => {
  const input = element.parentNode.querySelector("input"),
    type = input.getAttribute("type"),
    icon = element.querySelector("i");

  if (type === "password") {
    input.setAttribute("type", "text");
    icon.classList.remove("bi-eye");
    icon.classList.add("bi-eye-slash");
  } else {
    input.setAttribute("type", "password");
    icon.classList.remove("bi-eye-slash");
    icon.classList.add("bi-eye");
  }
};

const constructDropdownMenuFTable = ({ text = "Acciones", items = [] }) => {
  let buttons = items.map((it) => {
    let buttonText = it.text || "Información",
      classSelector = it.classSelector || "n",
      idSelector = it.idSelector || "0";

    return `<div class="menu-item px-3">
                    <span class="menu-link px-3 ${classSelector}" data-id="${idSelector}">${buttonText}</span>
                </div>`;
  });
  return `<span class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">${text}
            <i class="ki-duotone ki-down fs-5 ms-1"></i></span>
            
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
            ${buttons.join("")}
            </div>`;
};

const showToastifyNotification = function ({
  message = "",
  type = "success",
  time = 3000,
}) {
  let color = "#2ecc71";
  switch (type) {
    case "success":
      color = "#2ecc71";
      break;
    case "error":
      color = "#e74c3c";
      break;
    case "warning":
      color = "#f1c40f";
      break;
    case "info":
      color = "#3498db";
      break;
    default:
      color = "#2ecc71";
      break;
  }

  Toastify({
    text: message,
    duration: time,
    close: true,
    gravity: "top",
    position: "right",
    stopOnFocus: true,
    style: {
      background: color,
    },
  }).showToast();
};

export {
  getURLParam,
  validatePassword,
  invertPasswordType,
  constructDropdownMenuFTable,
  showToastifyNotification,
};
