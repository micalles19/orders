"use strict";

import { SESSION_INDEX } from "../custom/constants.js";
import formFunctions from "../custom/formFunctions.js";
import {
  showToastifyNotification,
  validatePassword,
} from "../custom/general.js";
import sweet from "../custom/sweetMessages.js";
import User from "../models/UserModel.js";

!(function () {
  document
    .getElementById("btnChangeEmail")
    .addEventListener("click", function (e) {
      e.preventDefault();
      profileConfig.toggleEmail();
    });

  document
    .getElementById("kt_signin_cancel")
    .addEventListener("click", function (e) {
      e.preventDefault();
      profileConfig.toggleEmail();
    });

  document
    .getElementById("kt_signin_change_email")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      profileConfig.updateEmail();
    });

  document
    .getElementById("btnChangePassword")
    .addEventListener("click", function (e) {
      e.preventDefault();
      profileConfig.togglePassword();
    });

  document
    .getElementById("kt_password_cancel")
    .addEventListener("click", function (e) {
      e.preventDefault();
      profileConfig.togglePassword();
    });

  document
    .getElementById("kt_signin_change_password")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      profileConfig.updatePassword();
    });

  document.getElementById("txtNewPassword").addEventListener("keyup", (e) => {
    validatePassword(e.target);
  });

  document
    .getElementById("btnUpdatePhoto")
    .addEventListener("click", function (e) {
      e.preventDefault();
      profileConfig.updateUserPhoto();
    });
})();

const loader = document.querySelector(".loader-container");

window.onload = async function () {
  try {
    loader && loader.classList.add("d-none");
  } catch (err) {
    sweet.error(err);
  }
};

const profileConfig = {
  toggleEmail: function () {
    const currentEmailContainer = document.querySelector("#kt_signin_email"),
      newEmailContainer = document.querySelector("#kt_signin_email_edit");

    currentEmailContainer.classList.toggle("d-none");
    newEmailContainer.classList.toggle("d-none");
    document
      .getElementById("kt_signin_email_button")
      .classList.toggle("d-none");
  },
  fields: {
    newEmail: document.getElementById("txtNewEmail"),
    emailPasswordConfirm: document.getElementById("txtEmailPasswordConfirm"),
    currentPassword: document.getElementById("txtCurrentPassword"),
    newPassword: document.getElementById("txtNewPassword"),
    confirmPassword: document.getElementById("txtConfirmPassword"),
    avatarFile: document.getElementById("imgAvatar"),
  },
  form: "kt_signin_change_email",
  updateEmail: async function () {
    try {
      if (!formFunctions.check({ id: this.form })) return;

      const email = this.fields.newEmail.value,
        password = this.fields.emailPasswordConfirm.value,
        currentUserId = localStorage.getItem(`${SESSION_INDEX}-UId`);

      let user = new User({
        id: atob(currentUserId),
        email,
      });

      const response = await user.updateEmail({ password });

      switch (response.message) {
        case "success":
          document.getElementById("lbEmail").innerText = email;

          this.toggleEmail();

          showToastifyNotification({
            type: "info",
            message: "Email actualizado correctamente.",
          });
          break;
        case "wrongPassword":
          showToastifyNotification({
            type: "error",
            message: "La contraseña es incorrecta.",
          });
          break;
        default:
          sweet.error(response);
          break;
      }
    } catch (err) {}
  },
  togglePassword: function () {
    const currentPasswordContainer = document.querySelector(
        "#kt_signin_password"
      ),
      newPasswordContainer = document.querySelector("#kt_signin_password_edit");

    currentPasswordContainer.classList.toggle("d-none");
    newPasswordContainer.classList.toggle("d-none");
    document
      .getElementById("kt_signin_password_button")
      .classList.toggle("d-none");
  },
  updatePassword: async function () {
    try {
      if (!formFunctions.check({ id: "kt_signin_change_password" })) return;

      const currentPassword = this.fields.currentPassword.value,
        newPassword = this.fields.newPassword.value,
        confirmPassword = this.fields.confirmPassword.value,
        currentUserId = localStorage.getItem(`${SESSION_INDEX}-UId`);

      if (!validatePassword(this.fields.newPassword)) {
        showToastifyNotification({
          type: "error",
          message: "La contraseña no cumple con los requisitos mínimos.",
        });
        return;
      }

      if (newPassword !== confirmPassword) {
        showToastifyNotification({
          type: "error",
          message: "La nueva contraseña no coincide con la confirmación",
        });
        return;
      }

      if (currentPassword === newPassword) {
        showToastifyNotification({
          type: "error",
          message: "La nueva contraseña no puede ser igual a la actual.",
        });
        return;
      }

      let user = new User({
        id: atob(currentUserId),
      });

      const response = await user.changePassword({
        newPassword,
        currentPassword,
        startSession: 0,
        requestScreen: "profile",
      });

      switch (response.message) {
        case "success":
          this.togglePassword();
          showToastifyNotification({
            type: "info",
            message: "Contraseña actualizada correctamente.",
          });
          break;
        case "wrongCurrentPassword":
          showToastifyNotification({
            type: "error",
            message: "La contraseña actual es incorrecta.",
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
  updateUserPhoto: async function () {
    try {
      let userPhotoFile = this.fields.avatarFile.files[0],
        userPhotoFilename = document
          .getElementById("userPhotoPreview")
          .style.backgroundImage.split("/")
          .pop()
          .replace('")', "");

      userPhotoFilename = userPhotoFilename.split("?")[0];

      if (userPhotoFilename == "none") userPhotoFilename = "default.png";

      if (userPhotoFile) {
        userPhotoFilename = userPhotoFile.name;
      }

      let currentUserId = localStorage.getItem(`${SESSION_INDEX}-UId`);

      let user = new User({
        id: atob(currentUserId),
      });

      let response = await user.updatePhoto({
        userPhotoFile,
        userPhotoFilename,
      });

      switch (response.message) {
        case "success":
          sweet.success({
            message: "Foto de perfil actualizada correctamente.",
            callback: () => {
              window.location.reload();
            },
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
};
