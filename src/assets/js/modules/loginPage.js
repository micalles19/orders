"use strict";

import { SESSION_INDEX } from "../custom/constants.js";
import formFunctions from "../custom/formFunctions.js";
import { invertPasswordType, validatePassword } from "../custom/general.js";
import sweet from "../custom/sweetMessages.js";
import User from "../models/UserModel.js";

!(function () {
  let changePasswordTypeSpns = document.querySelectorAll(".changePasswordType");

  changePasswordTypeSpns.forEach((element) => {
    element.addEventListener("click", function (e) {
      e.preventDefault();
      invertPasswordType(element);
    });
  });

  document.getElementById("txtNewPassword").addEventListener("keyup", (e) => {
    validatePassword(e.target);
  });

  document
    .getElementById("loginForm")
    .addEventListener("submit", async function (e) {
      e.preventDefault();

      loginConfig.auth();
    });

  document
    .getElementById("passwordChangeForm")
    .addEventListener("submit", async function (e) {
      e.preventDefault();

      loginConfig.changePassword();
    });
})();

const loader = document.querySelector(".loader-container");

window.onload = async function () {
  try {
    // await initTables();
    loader && loader.classList.add("d-none");
    // Swal.fire({
    //     title: 'Hello World!',
    //     text: 'This is a sweet alert',
    //     icon: 'success',
    //     confirmButtonText: 'Cool'
    // });
  } catch (err) {
    sweet.error(err);
  }
};

const loginConfig = {
  form: "loginForm",
  fields: {
    username: document.getElementById("txtUsername"),
    password: document.getElementById("txtPassword"),
    passwordChangeUsername: document.getElementById(
      "txtPasswordChangeUsername"
    ),
    newPassword: document.getElementById("txtNewPassword"),
    confirmPassword: document.getElementById("txtConfirmPassword"),
  },
  auth: async function () {
    try {
      if (!formFunctions.check({ id: this.form })) return;

      const password = this.fields.password.value;

      const user = new User({
        username: this.fields.username.value,
      });

      this.evaluateResponse(await user.authenticate({ password }));
    } catch (err) {
      sweet.error(err);
    }
  },
  evaluateResponse: async function (response) {
    try {
      switch (response.message) {
        case "success":
          let userId = btoa(response.data.id);
          localStorage.setItem(`${SESSION_INDEX}-UId`, userId);
          localStorage.setItem(
            `${SESSION_INDEX}-${userId}-UName`,
            response.data.name || "Usuario genérico"
          );
          window.top.location.href = "./";
          break;
        case "firstLogin":
        case "passwordChangeRequested":
          let titleMessage =
              response.message == "firstLogin"
                ? "Bienvenido"
                : "Cambio de contraseña solicitado",
            bodyMessage =
              response.message == "firstLogin"
                ? "Es tu primer inicio de sesión, por favor cambia tu contraseña"
                : "Se ha solicitado un cambio de contraseña, por favor cambia tu contraseña";
          sweet.success({
            title: titleMessage,
            message: bodyMessage,
            callback: () =>
              loginConfig.showPasswordChangeForm({
                username: this.fields.username.value,
              }),
          });
          break;
        case "notFound":
          sweet.warning({
            message: "Usuario no encontrado",
          });
          break;
        case "wrongCredentials":
          sweet.warning({
            message: `Contraseña incorrecta, le quedan <strong>${response.remainingAttempts}</strong> intentos`,
          });
          break;
        default:
          sweet.error(response);
          break;
      }
    } catch (err) {
      sweet.error(err);
    }
  },
  showPasswordChangeForm: function ({ username }) {
    try {
      document.getElementById("loginForm-container").classList.add("d-none");
      document
        .getElementById("passwordChangeForm-container")
        .classList.remove("d-none");

      this.fields.passwordChangeUsername.value = username;
    } catch (err) {
      sweet.error(err);
    }
  },
  changePassword: async function () {
    try {
      if (!formFunctions.check({ id: "passwordChangeForm" })) return;
      let newPassword = this.fields.newPassword.value,
        confirmPassword = this.fields.confirmPassword.value;

      if (!validatePassword(this.fields.newPassword)) {
        sweet.warning({
          message: "La contraseña no cumple con los requisitos mínimos",
        });
        return;
      }

      if (newPassword !== confirmPassword) {
        sweet.warning({
          message: "Las contraseñas no coinciden",
        });
        return;
      }

      let user = new User({
        username: this.fields.passwordChangeUsername.value,
      });

      this.evaluateResponse(
        await user.changePassword({
          newPassword,
          currentPassword: this.fields.password.value,
          startSession: 1,
        })
      );
    } catch (err) {
      if (!!err) sweet.error(err);
    }
  },
};
