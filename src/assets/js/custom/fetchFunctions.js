import { getURLParam } from "../generalResources.js";

const fetchFunctions = {};

fetchFunctions.get = function ({
  fileName,
  module,
  showLoader = true,
  params = {},
}) {
  return new Promise(async (resolve, reject) => {
    try {
      const htmlLoader = document.querySelector(".loader");

      showLoader && htmlLoader && htmlLoader.classList.remove("d-none");

      const arrParams = [],
        moduleContainer = !!module ? `${module}/` : "",
        screenId = getURLParam("aid");

      for (let key in params) {
        arrParams.push(`${key}=${encodeURIComponent(params[key])}`);
      }

      arrParams.push(`aid=${screenId}`);

      const init = {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      };

      let response = await fetch(
        `src/${moduleContainer}code/${fileName}.php?${arrParams.join("&")}`,
        init
      );

      if (response.ok) {
        showLoader && htmlLoader && htmlLoader.classList.add("d-none");
        let data = await response.json();
        resolve(data);
      } else {
        let HTTPCode = response.status,
          message =
            HTTPCode == 404
              ? {
                  status: HTTPCode,
                  message: `No se encontró el archivo <strong>${fileName}</strong>`,
                }
              : await response.json();

        reject(message);
      }
    } catch (err) {
      reject(err);
    }
  });
};

fetchFunctions.post = function ({
  fileName,
  module,
  showLoader = true,
  data = {},
}) {
  return new Promise(async (resolve, reject) => {
    try {
      const htmlLoader = document.querySelector(".loader");

      showLoader && htmlLoader && htmlLoader.classList.remove("d-none");

      const moduleContainer = !!module ? `${module}/` : "",
        screenId = getURLParam("aid");

      data.aid = screenId;

      const init = {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      };

      let response = await fetch(
        `src/${moduleContainer}code/${fileName}.php`,
        init
      );

      if (response.ok) {
        showLoader && htmlLoader && htmlLoader.classList.add("d-none");
        let data = await response.json();
        resolve(data);
      } else {
        let HTTPCode = response.status,
          message =
            HTTPCode == 404
              ? {
                  status: HTTPCode,
                  message: `No se encontró el archivo <strong>${fileName}</strong>`,
                }
              : await response.json();

        reject(message);
      }
    } catch (err) {
      reject(err);
    }
  });
};

fetchFunctions.postWithFiles = function ({
  fileName,
  module,
  showLoader = true,
  data = new FormData(),
}) {
  return new Promise(async (resolve, reject) => {
    try {
      const htmlLoader = document.querySelector(".loader");

      showLoader && htmlLoader && htmlLoader.classList.remove("d-none");

      const moduleContainer = !!module ? `${module}/` : "",
        screenId = getURLParam("aid");

      data.append("aid", screenId);

      const init = {
        method: "POST",
        body: data,
      };

      let response = await fetch(
        `src/${moduleContainer}code/${fileName}.php`,
        init
      );

      if (response.ok) {
        showLoader && htmlLoader && htmlLoader.classList.add("d-none");
        let data = await response.json();
        resolve(data);
      } else {
        let HTTPCode = response.status,
          message =
            HTTPCode == 404
              ? {
                  status: HTTPCode,
                  message: `No se encontró el archivo <strong>${fileName}</strong>`,
                }
              : await response.json();

        reject(message);
      }
    } catch (err) {
      reject(err);
    }
  });
};

export default fetchFunctions;
