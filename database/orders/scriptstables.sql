create database orders;
create table general_roles
(
    id     int not null primary key auto_increment,
    nombre varchar(250)
);
insert into general_roles (nombre)
values ('Adminsitrador'),
       ('Vendedor');
alter table general_roles
    add eliminado char(1) default 'N' not null;

create table general_usuarios
(
    id                int not null auto_increment primary key,
    nombre            varchar(150),
    email             varchar(150),
    usuario           varchar(250),
    clave             varchar(250),
    eliminado         char(1)  default 'N',
    idRol             int,
    claveTemporal     varchar(250),
    reestablecioClave char(1)  default 1,
    fechaCreacion     datetime default current_timestamp,
    idUsuarioCrea     int,
    fechaEliminado    datetime,
    idUsuarioElimina  int,
    constraint FK_rol_usuario_id foreign key (idRol) references general_roles (id)
);



create table catalogos
(
    id          int not null primary key auto_increment,
    codigo      varchar(150),
    nombre      varchar(200),
    descripcion varchar(1000),
    estado      char(1) default 'A',
    eliminado   char(1) default 'N'
);


create table categorias
(
    id          int not null primary key auto_increment,
    codigo      varchar(150),
    nombre      varchar(200),
    descripcion varchar(5000),
    estado      char(1) default 'A',
    eliminado   char(1) default 'N'
);
create table sub_categorias
(
    id          int not null primary key auto_increment,
    codigo      varchar(150),
    nombre      varchar(200),
    descripcion varchar(5000),
    estado      char(1) default 'A',
    eliminado   char(1) default 'N'
);
create table marcas
(
    id          int not null primary key auto_increment,
    codigo      varchar(150),
    nombre      varchar(200),
    descripcion varchar(5000),
    estado      char(1) default 'A',
    eliminado   char(1) default 'N'
);

drop table productos;
create table productos
(
    id                  bigint not null primary key auto_increment,
    codigo              varchar(100) default null,
    nombre              varchar(1000),
    idProveedor         int,
    idMarca             int,
    idCatalogo          int,
    idCategoria         int,
    idSubCategoria      int,
    descripcion         text,
    especificaciones    text,
    excento             char(1)      default 'N',
    precioFijo          char(1)      default 'S',
    precioCompraSinIva  decimal(11, 2),
    ivaCompra           decimal(11, 2),
    precioCompraConIva  decimal(11, 2),
    precioVentaSinIva   decimal(11, 2),
    ivaVenta            decimal(11, 2),
    precioVentaConIva   decimal(11, 2),
    porcentajeDescuento decimal(11, 2),
    imagen              varchar(5000),
    descuento char(1) default 'N',
    valorDescuento      decimal(11, 2),
    precioConsumidorFinal decimal(11,2),
    fechaRegistra       datetime     default current_timestamp(),
    idUsuarioRegistra   int,
    fechaEdicion        datetime,
    idUsuarioEdita      int,
    eliminado           char(1)      default 'N',
    idUsuarioElimina    int,
    fechaElimina        datetime,
    constraint fk_productos_proveedor_id foreign key (idProveedor) references proveedores_datos_generales (id),
    constraint fk_productos_marca_id foreign key (idMarca) references marcas (id),
    constraint fk_productos_catalogo_id foreign key (idCatalogo) references catalogos (id),
    constraint fk_productos_categoria_id foreign key (idCategoria) references categorias (id),
    constraint fk_productos_subCategoria_id foreign key (idSubCategoria) references sub_categorias (id),
    constraint fk_productos_usuario_idRegistra foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint fk_productos_usuario_idEdita foreign key (idUsuarioEdita) references general_usuarios (id),
    constraint fk_productos_usuario_idElimina foreign key (idUsuarioElimina) references general_usuarios (id)
);

select * from productos;

#
# create table productos_precio_rango_cantidad
# (
#     id          bigint not null primary key auto_increment,
#     idProducto  bigint,
#     desde       int,
#     hasta       int,
#     precioVenta decimal(11, 4),
#     comision    decimal(11, 2),
#     eliminado   char(1) default 'N',
#     constraint fk_prod_preci_cant_productos_id foreign key (idProducto) references productos (id)
# );
# create table productos_precio_rango_precio
# (
#     id         bigint not null primary key auto_increment,
#     idProducto bigint,
#     precioVents decimal(11,4),
#     comision decimal (11,4),
#     eliminado   char(1) default 'N',
#     constraint fk_prod_preci_rango_pre_productos_id foreign key (idProducto) references productos (id)
# );

create table cat_estado_ordenes
(
    id     int not null primary key auto_increment,
    nombre varchar(150)
);
insert into cat_estado_ordenes(nombre)
values ('Orden Realizada'),
       ('Orden Aceptada'),
       ('Orden Despachada'),
       ('Orden Entregada');
insert into cat_estado_ordenes (nombre) value ('Orden Rechazada');

create table ordenes
(
    id                bigint not null primary key auto_increment,
    idCliente         bigint,
    idEstadoProducto  int,

    subTotal          decimal(11, 4),
    iva               decimal(11, 4),
    total             decimal(11, 4),
    idUsuarioRealizo  int,
    fechaRealizada    datetime default current_timestamp(),
    idUsuarioAcepto   int,
    fechaAceptada     datetime,
    idUsuarioDespacho int,
    fechaDespacho     datetime,
    idUsuarioEntrego  int,
    fechaEntrego      datetime,
    idUsuarioRechazo  int,
    fechaRechazo      datetime,
    motivoRechazo     varchar(2500),
    eliminado         char(1)  default 'N',
    idUsuarioElimino  int,
    fechaElimino      datetime

);

