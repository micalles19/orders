"use strict";

import User from "../models/UserModel.js?v=1.0.3";
import sweet from "./sweetMessages.js";

!(async function () {
  document
    .getElementById("logout-lnk")
    .addEventListener("click", async function (e) {
      e.preventDefault();

      User.logout();
    });
  try {
  } catch (err) {
    sweet.error(err);
  }
})();
