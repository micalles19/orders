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
    case "clientes":
        var ecobalanceElement = document.querySelector("#clientes");
        ecobalanceElement.classList.remove("collapse");
        let eco = document.querySelectorAll("#clientes a")
        eco.forEach(function (link) {
            link.classList.remove('active');
            var parentCollapse = link.closest('.collapse');
            if (parentCollapse) {
                parentCollapse.classList.remove('show');
                var parentLink = parentCollapse.previousElementSibling;
                if (parentLink) {
                    parentLink.classList.remove('active');
                }
            }
        });

        // Luego, agrega la clase 'active' al enlace seleccionado y su elemento colapsable padre
        eco.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario === href) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    if (parentLink) {
                        parentLink.classList.add('active');
                    }
                    parentCollapse.classList.add('show');
                }
            }
        });
        break;
        case "general":
        var gene = document.querySelector("#generales");
            gene.classList.remove("collapse");
        let generales = document.querySelectorAll("#generales a")
            generales.forEach(function (link) {
            link.classList.remove('active');
            var parentCollapse = link.closest('.collapse');
            if (parentCollapse) {
                parentCollapse.classList.remove('show');
                var parentLink = parentCollapse.previousElementSibling;
                if (parentLink) {
                    parentLink.classList.remove('active');
                }
            }
        });

        // Luego, agrega la clase 'active' al enlace seleccionado y su elemento colapsable padre
            generales.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario === href) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    if (parentLink) {
                        parentLink.classList.add('active');
                    }
                    parentCollapse.classList.add('show');
                }
            }
        });
        break;

    case "catalogos":
        var catal = document.querySelector("#catalogos");
        catal.classList.remove("collapse");
        let cat = document.querySelectorAll("#catalogos a")
        // Primero, elimina la clase 'active' de todos los enlaces y elementos colapsables
        cat.forEach(function (link) {
            link.classList.remove('active');
            var parentCollapse = link.closest('.collapse');
            if (parentCollapse) {
                parentCollapse.classList.remove('show');
                var parentLink = parentCollapse.previousElementSibling;
                if (parentLink) {
                    parentLink.classList.remove('active');
                }
            }
        });

        // Luego, agrega la clase 'active' al enlace seleccionado y su elemento colapsable padre
        cat.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario === href) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    if (parentLink) {
                        parentLink.classList.add('active');
                    }
                    parentCollapse.classList.add('show');
                }
            }
        });
        break;
    case "marcas":
        var marcas = document.querySelector("#marcas");
        marcas.classList.remove("collapse");
        let marca = document.querySelectorAll("#marcas a")
        // Primero, elimina la clase 'active' de todos los enlaces y elementos colapsables
        marca.forEach(function (link) {
            link.classList.remove('active');
            var parentCollapse = link.closest('.collapse');
            if (parentCollapse) {
                parentCollapse.classList.remove('show');
                var parentLink = parentCollapse.previousElementSibling;
                if (parentLink) {
                    parentLink.classList.remove('active');
                }
            }
        });

        // Luego, agrega la clase 'active' al enlace seleccionado y su elemento colapsable padre
        marca.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario === href) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    if (parentLink) {
                        parentLink.classList.add('active');
                    }
                    parentCollapse.classList.add('show');
                }
            }
        });
        break;
    case "proveedores":
        var proveedores = document.querySelector("#proveedores");
        proveedores.classList.remove("collapse");
        let proveedor = document.querySelectorAll("#proveedores a")
        // Primero, elimina la clase 'active' de todos los enlaces y elementos colapsables
        proveedor.forEach(function (link) {
            link.classList.remove('active');
            var parentCollapse = link.closest('.collapse');
            if (parentCollapse) {
                parentCollapse.classList.remove('show');
                var parentLink = parentCollapse.previousElementSibling;
                if (parentLink) {
                    parentLink.classList.remove('active');
                }
            }
        });

        // Luego, agrega la clase 'active' al enlace seleccionado y su elemento colapsable padre
        proveedor.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario === href) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    if (parentLink) {
                        parentLink.classList.add('active');
                    }
                    parentCollapse.classList.add('show');
                }
            }
        });
        break;
    case "productos":
        var productos = document.querySelector("#productos");
        productos.classList.remove("collapse");
        let producto = document.querySelectorAll("#productos a")
        // Primero, elimina la clase 'active' de todos los enlaces y elementos colapsables
        producto.forEach(function (link) {
            link.classList.remove('active');
            var parentCollapse = link.closest('.collapse');
            if (parentCollapse) {
                parentCollapse.classList.remove('show');
                var parentLink = parentCollapse.previousElementSibling;
                if (parentLink) {
                    parentLink.classList.remove('active');
                }
            }
        });

        // Luego, agrega la clase 'active' al enlace seleccionado y su elemento colapsable padre
        producto.forEach(function (link) {
            var href = link.getAttribute('id');
            if (formulario === href) {
                link.classList.add('active');
                var parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    var parentLink = parentCollapse.previousElementSibling;
                    if (parentLink) {
                        parentLink.classList.add('active');
                    }
                    parentCollapse.classList.add('show');
                }
            }
        });
        break;

    case "planilla":
        var eduElemnet = document.querySelector("#planilla");
        eduElemnet.classList.remove("collapse");
        let edu = document.querySelectorAll("#planilla .nav-item a")
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
        var edu2 = document.querySelector("#planillaCatalogos");
        edu2.classList.remove("collapse");
        let edu2p = document.querySelectorAll("#planillaCatalogos a")
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
    case "formularios":
        var eduElemnet = document.querySelector("#formularios");
        eduElemnet.classList.remove("collapse");
        let formularios = document.querySelectorAll("#formularios .nav-item a")
        formularios.forEach(function (link) {
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
        var formulariosCatalogos = document.querySelector("#formulariosCatalogos");
        formulariosCatalogos.classList.remove("collapse");
        let formulariosCatalogos2 = document.querySelectorAll("#formulariosCatalogos a")
        formulariosCatalogos2.forEach(function (link) {
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
