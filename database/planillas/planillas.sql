create table planilla_cat_tipo_empleado
(
    id                int not null primary key auto_increment,
    nombre            varchar(250),
    descripcion       text,
    eliminado         char(1)  default 'N',
    fechaRegistro     datetime default current_timestamp,
    idUsuarioRegistra int,
    fechaElimnia      datetime,
    idUsuarioElimina  int,
    constraint FK_CAT_EMPLEADOS_USUARIO_REGISTRA_ID foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_CAT_EMPLEADOS_USUARIO_ELIMINA_ID foreign key (idUsuarioElimina) references general_usuarios (id)
);


create table planilla_cat_cargos
(
    id                int not null primary key auto_increment,
    nombre            varchar(250),
    decripcion        text,
    descripcion       text,
    eliminado         char(1)  default 'N',
    fechaRegistro     datetime default current_timestamp,
    idUsuarioRegistra int,
    fechaElimnia      datetime,
    idUsuarioElimina  int,
    constraint FK_CAT_CARGO_REGISTRA_ID foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_CAT_CARGO_USUARIO_ELIMINA_ID foreign key (idUsuarioElimina) references general_usuarios (id)
);


create table planilla_cat_bancos
(
    id                int not null primary key auto_increment,
    nombre            varchar(500),
    descripcion       text,
    eliminado         char(1)  default 'N',
    fechaRegistro     datetime default current_timestamp,
    idUsuarioRegistra int,
    fechaElimnia      datetime,
    idUsuarioElimina  int,
    constraint FK_CAT_BANCO_USUARIO_REGISTRA_ID foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_CAT_BANCO_USUARIO_ELIMINA_ID foreign key (idUsuarioElimina) references general_usuarios (id)
);

create table planilla_cat_afp
(
    id                   int not null primary key auto_increment,
    nombre               varchar(500),
    porcentajePatronal   decimal(11, 2),
    porcentajeTrabajador decimal(11, 2),
    techoMaximo          decimal(11, 2),
    eliminado            char(1)  default 'N',
    fechaRegistro        datetime default current_timestamp,
    idUsuarioRegistra    int,
    fechaElimnia         datetime,
    idUsuarioElimina     int,
    constraint FK_CAT_AFP_USUARIO_REGISTRA_ID foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_CAT_AFP_USUARIO_ELIMINA_ID foreign key (idUsuarioElimina) references general_usuarios (id)
);
alter table planilla_cat_afp  add column descripcion text after  techoMaximo;

create table planilla_cat_seguro
(
    id                   int not null primary key auto_increment,
    nombre               varchar(250),
    porcentajePatronal   decimal(11, 2),
    porcentajeTrabajador decimal(11, 2),
    techoMaximo          decimal(11, 2),
    eliminado            char(1)  default 'N',
    fechaRegistro        datetime default current_timestamp,
    idUsuarioRegistra    int,
    fechaElimnia         datetime,
    idUsuarioElimina     int,
    constraint FK_CAT_SEGURO_USUARIO_REGISTRA_ID foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_CAT_SEGURO_USUARIO_ELIMINA_ID foreign key (idUsuarioElimina) references general_usuarios (id)
);


create table planilla_empleado
(
    id                  int not null primary key,
    dui                 varchar(20),
    nombres             varchar(500),
    apellidos           varchar(500),
    idBanco             int,
    idTipoEmpleado      int,
    numeroCuentaBanco   varchar(500),
    salarioBruto        decimal(11, 2),
    fechaIngresoLaboral datetime,
    idEmpresaPertenece  int,
    idAfp               int,
    idSeguro            int,
    numeroAfiliacion varchar(250),
    idUsuarioRegistra   int,
    fechaRegistro       datetime default current_timestamp,
    eliminado           char(1)  default 'N',
    idUsuarioElimina    int,
    fechaElimina        datetime,
    constraint FK_EMPLEADO_BANCO_ID foreign key (idBanco) references planilla_cat_bancos (id),
    constraint FK_EMPLEADO_TIPO_EMPLEADO_ID foreign key (idTipoEmpleado) references planilla_cat_tipo_empleado (id),
    constraint FK_EMPLEADO_AFP_ID foreign key (idAfp) references planilla_cat_afp (id),
    constraint FK_EMPLEADO_SEGURO_ID foreign key (idSeguro) references planilla_cat_seguro (id),
    constraint FK_EMPLEADO_EMPRESA_ID foreign key (idEmpresaPertenece) references general_datos_empresa (id),
    constraint FK_EMPLEADO_USUARIO_REGISTRA_ID foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_EMPLEADO_USUARIO_ELIMINA_ID foreign key (idUsuarioElimina) references general_usuarios (id)
);
SELECT * FROM planilla_cat_tipo_empleado