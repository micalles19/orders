$(function () {
    $(".mayusculas input[type='text']").css("text-transform", "uppercase");
    $(".mayusculas input[type='text']").keyup(function () {
      this.value = this.value.toUpperCase();
    });
  
    $(".mayusculas input[type='password']").css("text-transform", "uppercase");
    $(".mayusculas input[type='password']").keyup(function () {
      this.value = this.value.toUpperCase();
    });
  
    $(".mayusculas textarea").css("text-transform", "uppercase");
    $(".mayusculas textarea").keyup(function () {
      this.value = this.value.toUpperCase();
    });
  
    // $('input[type="text"].dui').mask("00000000-0");
    // $('input[type="text"].nit').mask("0000-000000-000-0");
    // $('input[type="text"].telefono').mask("0000-0000");
  
    typeof selectpicker !== "undefined" &&
      $("select.selectpicker").selectpicker();
  
    if (typeof flatpickr !== "undefined") {
      let flatpickrFields = document.querySelectorAll("input.flatpickr");
  
      flatpickrFields.forEach((field) => {
        let aditionalOptions = {
          dateFormat: "d-m-Y",
          static: true,
          altInput: false,
          disableMobile: true,
        };
  
        if (
          $(field).attr("data-static") &&
          $(field).attr("data-static") == "false"
        )
          aditionalOptions.static = false;
  
        if (
          $(field).attr("data-datetime") &&
          $(field).attr("data-datetime") == "true"
        ) {
          aditionalOptions.enableTime = true;
          aditionalOptions.dateFormat = "d-m-Y h:i K";
          aditionalOptions.time_24hr = false;
        }
  
        if (
          $(field).attr("data-only-MY") &&
          $(field).attr("data-only-MY") == "true"
        ) {
          let pluginOptions = {};
  
          if (
            $(field).attr("data-altInput") &&
            $(field).attr("data-altInput") == "true"
          ) {
            aditionalOptions.altInput = true;
            let altFormat =
              $(field).attr("data-altFormat") || aditionalOptions.dateFormat;
            pluginOptions.altFormat = altFormat;
            pluginOptions.dateFormat = aditionalOptions.dateFormat;
          }
  
          aditionalOptions.plugins = [
            new monthSelectPlugin({
              shorthand: true,
              ...pluginOptions,
            }),
          ];
        }
  
        if (
          $(field).attr("data-only-adults") &&
          $(field).attr("data-only-adults") == "true"
        ) {
          aditionalOptions.maxDate = moment()
            .subtract(18, "years")
            .format("DD-MM-YYYY");
          aditionalOptions.minDate = moment()
            .subtract(100, "years")
            .format("DD-MM-YYYY");
        }
  
        if (
          $(field).attr("data-max-today") &&
          $(field).attr("data-max-today") == "true"
        ) {
          aditionalOptions.maxDate = moment().format("DD-MM-YYYY");
        }
  
        if (
          $(field).attr("data-min-today") &&
          $(field).attr("data-min-today") == "true"
        ) {
          aditionalOptions.minDate = moment().format("DD-MM-YYYY");
        }
  
        if ($(field).attr("custom-min-date")) {
          aditionalOptions.minDate = moment(
            $(field).attr("custom-min-date"),
            "YYYY-MM-DD"
          ).format("DD-MM-YYYY");
        }
  
        if ($(field).attr("data-min-month")) {
          aditionalOptions.minDate = moment()
            .subtract(1, "month")
            .format("DD-MM-YYYY");
        }
  
        $(field).flatpickr({
          locale: "es",
          ...aditionalOptions,
        });
  
        let invalidFeedbackContainer =
          aditionalOptions.static &&
          field.parentNode.parentNode.querySelector(".invalid-feedback");
  
        if (invalidFeedbackContainer)
          $(field).parent().append(invalidFeedbackContainer);
  
        let button = aditionalOptions.static
          ? field.parentNode.parentNode.querySelector("button")
          : field.parentNode.querySelector("button");
  
        if (aditionalOptions.static && button) {
          field.parentNode.classList.remove("flatpickr-wrapper");
          field.parentNode.classList.add("input-group");
          $(field).parent().append(button);
        }
  
        if (aditionalOptions.altInput) {
          let input = field.parentNode.querySelector("input.input");
          $(input).on("focus", ({ currentTarget }) => $(currentTarget).blur());
          $(input).prop("readonly", false);
          $(field).parent().parent().append(field);
        }
  
        if (!aditionalOptions.altInput) {
          $(field).on("focus", ({ currentTarget }) => $(currentTarget).blur());
          $(field).prop("readonly", false);
        }
  
        //Verificar si está en un input-group-sm para agregarle la clase
        if (field.parentNode.parentNode.classList.contains("input-group-sm")) {
          field.parentNode.classList.add("input-group-sm");
        }
      });
  
      const clearFlatpickrButtons = document.querySelectorAll(
        "button.btn-clear-flatpickr"
      );
  
      clearFlatpickrButtons.forEach((button) => {
        button.addEventListener("click", ({ currentTarget }) => {
          let input = currentTarget.parentNode.querySelector("input.flatpickr");
          input.value = "";
          input._flatpickr.clear();
        });
      });
    }
  
    let searchFields = document.querySelectorAll("input[type='search']");
  
    searchFields.forEach((field) => {
      let container = field.parentNode.parentNode.parentNode;
  
      if (container.classList.contains("form-control-sm")) {
        field.classList.add("form-control-sm");
      }
    });
  });
  