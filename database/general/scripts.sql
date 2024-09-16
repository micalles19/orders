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
    id               int not null auto_increment primary key,
    nombre           varchar(150),
    email            varchar(150),
    clave            varchar(250),
    eliminado        char(1)  default 'N',
    idRol            int,
    fechaCreacion    datetime default current_timestamp,
    idUsuarioCrea    int,
    fechaEliminado   datetime,
    idUsuarioElimina int,
    constraint FK_rol_usuario_id foreign key (idRol) references general_roles (id)
);
alter table general_usuarios   add claveTemporal varchar(250);
alter table general_usuarios  add reestablecioClave char(1) default 1;
alter table general_usuarios add idTipoDocumentoIdentidad int;
alter table general_usuarios add numeroDocumentoIdentidad varchar(150);
alter table general_usuarios add constraint FK_tipoDocId_id foreign key (idTipoDocumentoIdentidad) references mh_tipo_documento_identidad (id);

create table general_personeria
(
    id     int not null primary key auto_increment,
    nombre varchar(250)
);
insert into general_personeria (nombre)
values ('Natural'),
       ('Juridica');



drop table general_datos_empresa;
create table general_datos_empresa
(
    id                 int not null primary key auto_increment,
    idPersoneria       int,
    numeroIVA          varchar(12),
    nit                varchar(25),
    nombre             varchar(1500),
    nombreComercial    varchar(1500),
    nombreLogo         varchar(500),
    representanteLegal varchar(500),
    correo             varchar(150),
    telefono           varchar(12),
    fechaRegistro      datetime default current_timestamp,
    idUsuarioRegistra  int,
    eliminado          char(1)  default 'N',
    fechaElimina       datetime,
    idUsuarioElimina   int,
    constraint FK_empresa_personeria_id foreign key (idPersoneria) references general_personeria (id),
    constraint FK_empresa_usuario_id_registra foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_empresa_usuario_id_elimina foreign key (idUsuarioElimina) references general_usuarios (id)
);

drop table general_datos_empresa_actividades_economicas;
create table general_datos_empresa_actividades_economicas
(
    id                int not null primary key auto_increment,
    idEmpresa         int not null,
    idActividad       int,
    eliminado         char(1)  default 'N',
    idUsuarioRegistra int,
    fechaRegistro     datetime default current_timestamp,
    idUsuarioElimina  int,
    fechaElimina      datetime,
    constraint FK_actividades_empresa_empresa_id foreign key (idEmpresa) references general_datos_empresa (id),
    constraint FK_actividades_empresa_economicas_id foreign key (idActividad) references mh_actividad_economica (id),
    constraint FK_actividades_empresa_id_registra foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_actividades_empresa_id_elimina foreign key (idUsuarioElimina) references general_usuarios (id)
);



create table general_datos_empresa_sucursales
(
    id                    int not null primary key auto_increment,
    idEmpresa             int,
    idTipoEstablecimiento int,
    responsable           varchar(500),
    telefono              varchar(25),
    correo                varchar(500),
    idDepartamento        int,
    idMunicipio           int,
    direccion             varchar(5000),
    eliminado             char(1)  default 'N',
    idUsuarioRegistra     int,
    fechaRegistro         datetime default current_timestamp,
    idUsuarioElimina      int,
    fechaElimina          datetime,
    constraint FK_empresa_suc_empresadatos_id foreign key (idEmpresa) references general_datos_empresa (id),
    constraint FK_empresa_suc_establecimiento_id foreign key (idTipoEstablecimiento) references mh_tipo_establecimiento (id),
    constraint FK_empresa_suc_departamentos_id foreign key (idDepartamento) references mh_departamentos (id),
    constraint FK_empresa_suc_municipios_id foreign key (idMunicipio) references mh_municipios (id),
    constraint FK_empresa_suc_usuario_id_registra foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_empresa_suc_usuario_id_elimina foreign key (idUsuarioElimina) references general_usuarios (id)
);

create table general_datos_empresa_config_transmision_dte
(
    id                 int not null primary key auto_increment,
    idEmpresa          int,
    idTipoAmbiente     int,
    clavePublica       varchar(500),
    clavePrivada       varchar(500),
    passwordApi        varchar(500),
    urlFirmador        varchar(1000),
    idUsuarioRegistra  int,
    fechaRegistro      datetime default current_timestamp,
    idUsuarioActualiza int,
    fechaElimina       datetime,
    constraint FK_gen_config_trans_empresa_id foreign key (idEmpresa) references general_datos_empresa (id),
    constraint FK_gen_config_trans_ambiente_id foreign key (idTipoAmbiente) references mh_ambiente (id),
    constraint FK_gen_config_trans_usuario_registra_id foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_gen_config_trans_usuario_edita_id foreign key (idUsuarioActualiza) references general_usuarios (id)
);
create table logs_sistema
(
    id               bigint not null primary key auto_increment,
    archivo          varchar(1000),
    funcionActual    varchar(1000),
    consultaSql      text,
    idFactura        bigint,
    idUsuario        int,
    mensaje          text,
    excepcion        text,
    sistemaOperativo varchar(100),
    fechaRegistro    datetime default current_timestamp
);

create table genera_datos_empresa_puntos_venta
(
    id int not null primary key auto_increment,
    nombrePuntoVenta
);