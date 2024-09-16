import { SESSION_INDEX } from "../custom/constants.js";
import fetchFunctions from "../custom/fetchFunctions.js";
import sweet from "../custom/sweetMessages.js";

class User {
  constructor({
    id,
    username,
    email,
    firstname,
    lastname,
    userPhotoFilename,
    passwordExpirationDate,
    isFirstLogin,
    passwordChangeRequested,
    loginAttemptsRemaining,
    isLocked,
    firstLogin,
    lastLogin,
    createdAt,
    updatedAt,
    statusCode,
    roleId,
    roleName,
  }) {
    this.id = id;
    this.username = username;
    this.email = email;
    this.firstname = firstname;
    this.lastname = lastname;
    this.userPhotoFilename = userPhotoFilename;
    this.passwordExpirationDate = passwordExpirationDate;
    this.isFirstLogin = isFirstLogin;
    this.passwordChangeRequested = passwordChangeRequested;
    this.loginAttemptsRemaining = loginAttemptsRemaining;
    this.isLocked = isLocked;
    this.firstLogin = firstLogin;
    this.lastLogin = lastLogin;
    this.createdAt = createdAt;
    this.updatedAt = updatedAt;
    this.statusCode = statusCode;
    this.roleId = roleId;
    this.roleName = roleName;
  }

  async authenticate({ password }) {
    try {
      const response = fetchFunctions.post({
        fileName: "controllers/userController",
        data: {
          action: "authenticate",
          username: this.username,
          password: btoa(password),
        },
      });

      return response;
    } catch (err) {
      throw err;
    }
  }

  async changePassword({
    newPassword,
    currentPassword,
    requestScreen = "login",
    startSession = 0,
    recoveryRequestId = null,
  }) {
    try {
      const response = fetchFunctions.post({
        fileName: "controllers/userController",
        data: {
          action: "changePassword",
          username: this.username,
          newPassword: btoa(newPassword),
          currentPassword: btoa(currentPassword),
          requestScreen,
          startSession,
          recoveryRequestId,
          id: this.id ? btoa(this.id) : null,
        },
      });

      return response;
    } catch (err) {
      throw err;
    }
  }

  static async logout() {
    try {
      const response = await fetchFunctions.post({
        fileName: "controllers/userController",
        data: {
          action: "logout",
        },
      });

      switch (response.message) {
        case "success":
          let userId = localStorage.getItem(`${SESSION_INDEX}-UId`);

          localStorage.removeItem(`${SESSION_INDEX}-UId`);
          localStorage.removeItem(`${SESSION_INDEX}-${userId}-menu`);
          localStorage.removeItem(`${SESSION_INDEX}-${userId}-UName`);

          window.top.location.href = "./";
          break;
        default:
          sweet.error(response);
          break;
      }
    } catch (err) {
      throw err;
    }
  }

  static async getAll({ statusCode = 1 }) {
    try {
      const response = await fetchFunctions.get({
        fileName: "controllers/userController",
        params: {
          action: "getAll",
          statusCode,
        },
      });

      return response;
    } catch (err) {
      throw err;
    }
  }

  async save({ password }) {
    try {
      const response = await fetchFunctions.post({
        fileName: "controllers/userController",
        data: {
          action: "save",
          id: this.id,
          username: this.username,
          firstname: this.firstname,
          lastname: this.lastname,
          email: this.email,
          userPhotoFilename: this.userPhotoFilename,
          password: btoa(password),
          roleId: this.roleId,
          roleName: this.roleName,
        },
      });

      if (response.message == "success") {
        this.id == 0 && (this.createdAt = response.data.createdAt);
        this.id = atob(response.data.id);
      }

      return response;
    } catch (err) {
      throw err;
    }
  }

  static async checkUsernameAvailability({ username, id }) {
    try {
      const response = await fetchFunctions.get({
        fileName: "controllers/userController",
        params: {
          action: "checkUsernameAvailability",
          username,
          id: btoa(id),
        },
      });

      return response;
    } catch (err) {
      throw err;
    }
  }

  async delete() {
    try {
      const response = await fetchFunctions.post({
        fileName: "controllers/userController",
        data: {
          action: "delete",
          id: btoa(this.id),
        },
      });

      return response;
    } catch (err) {
      throw err;
    }
  }

  async lockUnlock(newStatus) {
    try {
      const response = await fetchFunctions.post({
        fileName: "controllers/userController",
        data: {
          action: "lockUnlock",
          id: btoa(this.id),
          newStatus,
        },
      });

      return response;
    } catch (err) {
      throw err;
    }
  }

  async createTemporalPassword() {
    try {
      const response = await fetchFunctions.post({
        fileName: "controllers/userController",
        data: {
          action: "createTemporalPassword",
          id: btoa(this.id),
          username: this.username,
          email: this.email,
        },
      });

      return response;
    } catch (err) {
      throw err;
    }
  }

  async updateEmail({ password }) {
    try {
      const response = await fetchFunctions.post({
        fileName: "controllers/userController",
        data: {
          action: "updateEmail",
          id: btoa(this.id),
          email: this.email,
          password: btoa(password),
        },
      });

      return response;
    } catch (err) {
      throw err;
    }
  }

  async updatePhoto({ userPhotoFile, userPhotoFilename }) {
    try {
      const data = new FormData();
      data.append("action", "updatePhoto");
      data.append("id", btoa(this.id));
      data.append("userPhotoFile", userPhotoFile);
      data.append("userPhotoFilename", userPhotoFilename);

      const response = await fetchFunctions.postWithFiles({
        fileName: "controllers/userController",
        data,
      });

      return response;
    } catch (err) {
      throw err;
    }
  }
}

export default User;
