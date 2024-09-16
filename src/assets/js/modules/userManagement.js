// "use strict";

import CustomDataTable from "../custom/CustomDataTable.js";
import formFunctions from "../custom/formFunctions.js";
import {
  constructDropdownMenuFTable,
  invertPasswordType,
  showToastifyNotification,
} from "../custom/general.js";
import sweet from "../custom/sweetMessages.js";
import User from "../models/UserModel.js";

const loader = document.querySelector(".loader-container");

!(function () {
  let changePasswordTypeSpns = document.querySelectorAll(".changePasswordType");

  changePasswordTypeSpns.forEach((element) => {
    element.addEventListener("click", function (e) {
      e.preventDefault();
      invertPasswordType(element);
    });
  });

  document.getElementById("btnAddUser").addEventListener("click", function (e) {
    userConfig.edit();
  });

  document
    .getElementById("btnCheckUsernameAvailability")
    .addEventListener("click", function () {
      userConfig.checkUsernameAvailability();
    });

  document.getElementById("userForm").addEventListener("submit", function (e) {
    e.preventDefault();

    userConfig.save();
  });

  document.addEventListener("click", (e) => {
    const target = e.target;

    if (target.classList.contains("edit-user"))
      userConfig.edit(target.dataset.id);

    if (target.classList.contains("delete-user"))
      userConfig.delete(target.dataset.id);

    if (target.classList.contains("lock-unlock-user"))
      userConfig.lockUnlock(target.dataset.id);

    if (target.classList.contains("create-temp-password"))
        userConfig.createTemporalPassword(target.dataset.id);
  });
})();

window.onload = async function () {
  try {
    await initTables();

    await userConfig.init();
    loader && loader.classList.add("d-none");
  } catch (err) {
    sweet.error(err);
  }
};

const initTables = async function () {
  try {
    userConfig.table = new CustomDataTable({
      id: "kt_table_users",
      aditionalOptions: {
        info: !1,
        order: [],
        pageLength: 10,
        lengthChange: !1,
        columnDefs: [
          { orderable: !1, targets: 0 },
          { orderable: !1, targets: 6, className: "text-start" },
          { className: "d-flex align-items-center", targets: 1 },
        ],
      },
      dbClickCallback: userConfig.preEdit.bind(userConfig),
    });

    document
      .querySelector('[data-kt-user-table-filter="search"]')
      .addEventListener("keyup", function (t) {
        userConfig.table.table.search(t.target.value).draw();
      });
  } catch (err) {
    throw err;
  }
};

const userConfig = {
  table: null,
  id: 0,
  cnt: 0,
  data: {},
  form: "userForm",
  init: async function () {
    try {
      const { data: users = [] } = await User.getAll({ statusCode: 1 });

      users.forEach((u) => {
        this.cnt++;
        this.data[this.cnt] = new User(u);

        const row = this.prepareRowToTable({
          data: this.data[this.cnt],
          id: this.cnt,
        });

        this.table.addRow({
          data: row,
          rowId: `trUser${this.cnt}`,
        });
      });

      this.table.redraw();

      KTMenu.init();
    } catch (err) {
      throw err;
    }
  },
  modal: {
    id: "kt_modal_add_user",
    show: () => $(`#${userConfig.modal.id}`).modal("show"),
    hide: () => $(`#${userConfig.modal.id}`).modal("hide"),
  },
  fields: {
    username: document.getElementById("txtUsername"),
    firstname: document.getElementById("txtFirstname"),
    lastname: document.getElementById("txtLastname"),
    email: document.getElementById("txtEmail"),
    password: document.getElementById("txtPassword"),
    role: document.getElementById("selStatus"),
    photoPreview: document.getElementById("mdlPhotoPreview"),
  },
  preEdit: function (rowId) {
    let id = rowId.replace("trUser", "");
    this.edit(id);
  },
  edit: async function (id = 0) {
    try {
      await formFunctions.clear({ id: this.form });

      this.id = id;

      document.getElementById("rbRole1").checked = true;
      this.fields.photoPreview.style.backgroundImage = `url(src/assets/img/avatars/default.png)`;
      this.fields.password.required = id == 0;

      document.getElementById("passwordContainer").classList.remove("d-none");

      if (this.id > 0) {
        let user = this.data[this.id];

        this.fields.username.value = user.username;
        this.fields.firstname.value = user.firstname;
        this.fields.lastname.value = user.lastname;
        this.fields.email.value = user.email;

        document.getElementById(`rbRole${user.roleId}`).checked = true;
        this.fields.photoPreview.style.backgroundImage = `url(src/assets/img/avatars/${user.userPhotoFilename})`;
        document.getElementById("passwordContainer").classList.add("d-none");
      }

      this.modal.show();
    } catch (err) {
      sweet.error(err);
    }
  },
  save: async function () {
    try {
      if (!formFunctions.check({ id: this.form })) return;

      let roleId = document.querySelector('input[name="rbRole"]:checked').value,
        roleName = document.getElementById(`lbRole${roleId}`).innerText;

      let user = new User({
        id: btoa(this.data[this.id]?.id) || 0,
        username: this.fields.username.value,
        firstname: this.fields.firstname.value,
        lastname: this.fields.lastname.value,
        email: this.fields.email.value,
        userPhotoFilename: this.fields.photoPreview.style.backgroundImage
          .split("/")
          .pop()
          .replace('")', ""),
        roleId,
        roleName,
        createdAt: this.data[this.id]?.createdAt || null,
        lastLogin: this.data[this.id]?.lastLogin || null,
      });

      let password = this.fields.password.value;

      const response = await user.save({ password });

      switch (response.message) {
        case "success":
          let row = this.prepareRowToTable({
            data: user,
            id: this.id > 0 ? this.id : this.cnt + 1,
          });

          if (this.id == 0) {
            this.cnt++;
            this.id = this.cnt;

            this.table.addRow({
              data: row,
              rowId: `trUser${this.id}`,
            });
          } else {
            this.table.updateRow({
              rowId: `trUser${this.id}`,
              data: row,
            });
          }

          KTMenu.init();
          this.data[this.id] = user;

          this.modal.hide();
          break;
        case "usernameNotAvailable":
          sweet.warning({
            message: "El username ya está en uso, por favor elige otro.",
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
  prepareRowToTable: function ({ data = new User(), id }) {
    let firstChar = data.firstname.charAt(0).toUpperCase(),
      photoContainer = `<div class="symbol-label">
                    <img src="src/assets/img/avatars/${data.userPhotoFilename}" alt="Juan Perez" class="w-100" />
                </div>`;
    let statusColor = "success",
      statusText = "Activo";

    if (data.isLocked == 1) {
      statusColor = "danger";
      statusText = "Bloqueado";
    }

    if (data.userPhotoFilename == "default.png") {
      photoContainer = `<div class="symbol-label fs-3 bg-light-danger text-danger">${firstChar}</div>`;
    }

    return {
      0: id,
      1: `<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                ${photoContainer}
            </div>

            <div class="d-flex flex-column">
                <span class="text-gray-800 mb-1">${data.firstname} ${data.lastname}</span>
                <span>${data.email}</span>
            </div>`,
      2: data.roleName,
      3:
        data.lastLogin !== null
          ? moment(data.lastLogin, "YYYY-MM-DD HH:mm:ss").format(
              "DD/MM/YYYY hh:mm A"
            )
          : "Sin registros",
      4: `<div class="badge badge-light-${statusColor} fw-bold">${statusText}</div>`,
      5: moment(data.createdAt, "YYYY-MM-DD HH:mm:ss").format(
        "DD/MM/YYYY hh:mm A"
      ),
      6: constructDropdownMenuFTable({
        text: "Acciones",
        items: [
          {
            text: "Editar",
            classSelector: "edit-user",
            idSelector: id,
          },
          {
            text: "Contraseña temporal",
            classSelector: "create-temp-password",
            idSelector: id,
          },
          {
            text: data.isLocked == 0 ? "Bloquear" : "Desbloquear",
            classSelector: "lock-unlock-user",
            idSelector: id,
          },
          {
            text: "Eliminar",
            classSelector: "delete-user",
            idSelector: id,
          },
        ],
      }),
    };
  },
  checkUsernameAvailability: async function () {
    try {
      let username = this.fields.username.value;

      if (!username) {
        sweet.warning({ message: "Debes ingresar un username" });
        return;
      }

      let id = this.data[this.id]?.id || 0;

      const response = await User.checkUsernameAvailability({ username, id });

      switch (response.message) {
        case "success":
          showToastifyNotification({
            type: "info",
            message: "El username está disponible",
          });
          break;
        case "usernameNotAvailable":
          showToastifyNotification({
            type: "warning",
            message: "El username ya está en uso, por favor elige otro",
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
  delete: async function (id) {
    try {
      let user = this.data[id];

      const userConfirmation = await sweet.confirm({
        message: `¿Estás seguro de eliminar a ${user.firstname} ${user.lastname}?`,
      });

      if (!userConfirmation) return;

      const response = await user.delete();

      switch (response.message) {
        case "success":
          this.table.deleteRow({ rowId: `trUser${id}` });
          delete this.data[id];

          showToastifyNotification({
            type: "info",
            message: "Usuario eliminado correctamente",
          });
          break;
        default:
          sweet.error(response);
          break;
      }
    } catch (err) {
      if (!!err) sweet.error(err);
    }
  },
  lockUnlock: async function (id) {
    try {
      const user = this.data[id];

      let newStatus = user.isLocked == 0 ? 1 : 0;

      const userConfirmation = await sweet.confirm({
        message: `Se ${
          newStatus == 1 ? "bloqueará" : "desbloqueará"
        } el usuario <b>${user.firstname} ${user.lastname}</b>`,
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar",
      });

      if (!userConfirmation) return;

      const response = await user.lockUnlock(newStatus);

      switch (response.message) {
        case "success":
          user.isLocked = newStatus;
          let row = this.prepareRowToTable({
            data: user,
            id: id,
          });

          this.table.updateRow({ data: row, rowId: `trUser${id}` });

          showToastifyNotification({
            type: "info",
            message: `El usuario se ha ${
              newStatus == 1 ? "bloqueado" : "desbloqueado"
            } correctamente`,
          });

          KTMenu.init();
          break;
        default:
          sweet.error(response);
          break;
      }
    } catch (err) {
      if (!!err) sweet.error(err);
    }
  },
  createTemporalPassword: async function (id = 0) {
    try {
      const user = this.data[id];

      const userConfirmation = await sweet.confirm({
        message: `Se creará una contraseña temporal para el usuario <b>${user.firstname} ${user.lastname}</b>, adicionalmente se le enviará un correo electrónico con la nueva contraseña. <br />Esta contraseña será válida sólo este día.`,
        confirmButtonText: "Continuar",
        cancelButtonText: "Cancelar",
      });

      if (!userConfirmation) return;

      const response = await user.createTemporalPassword();

      switch (response.message) {
        case "success":
          sweet.info({
            message: `La contraseña temporal es <strong>${response.data.password}</strong>`,
            allowOutsideClick: false,
            showCancelButton: false,
            showCloseButton: false,
          });
          break;
        default:
          sweet.error(response);
          break;
      }
    } catch (err) {
      if (!!err) sweet.error(err);
    }
  }
};
