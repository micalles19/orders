"use strict";

import sweet from "../sweetMessages.js";

!(function () {})();

const loader = document.querySelector(".loader");

window.onload = () => {
  try {
    loader && loader.classList.add("d-none");
  } catch (err) {
    sweet.error(err);
  }
};

const loginConfig = {
  fields: {},
  auth:async function(){}
};
