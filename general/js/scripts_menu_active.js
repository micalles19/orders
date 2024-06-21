const obtenerParametroUrl = (nombreParametro) => {
    nombreParametro = nombreParametro
        .replace(/[\[]/, "\\[")
        .replace(/[\]]/, "\\]");

    let regex = new RegExp("[\\?&]" + nombreParametro + "=([^&#]*)"),
        resultado = regex.exec(location.search);

    return resultado === null
        ? ""
        : decodeURIComponent(resultado[1].replace(/\+/g, " "));
};

var formulario = obtenerParametroUrl('page');
var modulo = obtenerParametroUrl('module');
switch (modulo) {
    case "ecobalance":
        var ecobalanceElement = document.querySelector("#ecobalance");
        ecobalanceElement.classList.remove("collapse");
        let eco = document.querySelectorAll("#ecobalance .nav-item a")
        eco.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario.indexOf(href) !== -1) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    parentLink.classList.add('active');
                    parentCollapse.classList.add('show');
                }
            }
        });
        var ecobalanceElement2 = document.querySelector("#ecobalance2");
        ecobalanceElement2.classList.remove("collapse");
        let eco2 = document.querySelectorAll("#ecobalance2 a")
        eco2.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario.indexOf(href) !== -1) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    parentLink.classList.add('active');
                    parentCollapse.classList.add('show');
                }
            }
        });
        break;

    case "educacion_ambiental":
        var eduElemnet = document.querySelector("#educacion_ambiental");
        eduElemnet.classList.remove("collapse");
        let edu = document.querySelectorAll("#educacion_ambiental .nav-item a")
        edu.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario.indexOf(href) !== -1) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    parentLink.classList.add('active');
                    parentCollapse.classList.add('show');
                }
            }
        });
        var edu2 = document.querySelector("#educacion_ambiental2");
        edu2.classList.remove("collapse");
        let edu2p = document.querySelectorAll("#educacion_ambiental2 a")
        edu2p.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario.indexOf(href) !== -1) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    parentLink.classList.add('active');
                    parentCollapse.classList.add('show');
                }
            }
        });
        break;
    case "hga":
        var element = document.querySelector("#hga");
        element.classList.remove("collapse");

        let hga = document.querySelectorAll("#hga a")
        hga.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario.indexOf(href) !== -1) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    parentLink.classList.add('active');
                    parentCollapse.classList.add('show');
                }
            }
        });
        break;

    case "transversalizacion":
        var trans = document.querySelector("#transversalizacion");
        trans.classList.remove("collapse");

        let tra = document.querySelectorAll("#transversalizacion a")
        tra.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario.indexOf(href) !== -1) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    parentLink.classList.add('active');
                    parentCollapse.classList.add('show');
                }
            }
        });

        var trans2 = document.querySelector("#transversalizacion2");
        trans2.classList.remove("collapse");
        let trans2p = document.querySelectorAll("#transversalizacion2 a")
        trans2p.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario.indexOf(href) !== -1) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    parentLink.classList.add('active');
                    parentCollapse.classList.add('show');
                }
            }
        });
        break;

    case "reporteria":
        var element = document.querySelector("#reporteria");
        element.classList.remove("collapse");

        let reporteria = document.querySelectorAll("#reporteria a")
        reporteria.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario.indexOf(href) !== -1) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    parentLink.classList.add('active');
                    parentCollapse.classList.add('show');
                }
            }
        });
        break;

}
