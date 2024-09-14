"use strict";

import formFunctions from "../custom/formFunctions.js";
import sweet from "../custom/sweetMessages.js";

!(function () {
  // document.getElementById("loginFrm").addEventListener("submit", function (e) {
  //   e.preventDefault();
  //   loginConfig.auth();
  // });
})();

const loader = document.querySelector(".loader-container");

window.onload = () => {
  try {
    loader && loader.classList.add("d-none");
  } catch (err) {
    sweet.error(err);
  }
};

const loginConfig = {
  fields: {},
  form: "loginFrm",
  auth: async function () {
    try {
      if (!formFunctions.check({ id: this.form })) return;
    } catch (err) {
      sweet.error(err);
    }
  },
};
