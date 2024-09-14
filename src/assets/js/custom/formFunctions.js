const formFunctions = {};

formFunctions.check = ({ id }) => {
  let form = document.querySelector(`#${id}`);

  if (!!form) {
    return $(`#${id}`)[0].checkValidity();
  }

  return false;
};

formFunctions.clear = ({ id }) => {
  return new Promise((resolve, reject) => {
    try {
      let form = document.querySelector(`#${id}`);
      form.reset();
      form.classList.remove("was-validated");

      [
        ...form.querySelectorAll(
          `select[data-special-selectpicker="true"]`
        ),
      ].forEach((select) => {
        $(`#${select.id}`).selectpicker("destroy");
        $(`#${select.id}`).selectpicker();
      });
      [
        ...form.querySelectorAll(`select[data-live-search="true"]`),
      ].forEach((select) => {
        $(`#${select.id}`).selectpicker("destroy");
        $(`#${select.id}`).selectpicker();
      });

      resolve();
    } catch (err) {
      reject(err);
    }
  });
};

export default formFunctions;
