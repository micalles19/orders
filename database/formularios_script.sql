create table formularios_bancos_tipo_cuentas
(
    id                 int not null primary key auto_increment,
    nombre             varchar(250),
    estado             char(1)  default 'A',
    eliminado          char(1)  default 'N',
    fechaRegistro      datetime default current_timestamp,
    idUsuarioRegistra  int,
    idUsuarioActualiza int,
    fechaActualiza     datetime,
    fechaElimina       datetime,
    idUsuarioElimina   int,
    constraint FK_FORM_BANCOS_TCUEN_USU_REGISTRA_ID foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_FORM_BANCOS_TCUEN_ACTUALIZA_ID foreign key (idUsuarioActualiza) references general_usuarios (id),
    constraint FK_FORM_BANCOS_TCUEN_ELIMINA_ID foreign key (idUsuarioElimina) references general_usuarios (id)
);
insert into formularios_bancos_tipo_cuentas (nombre)
values ('Cuenta Corriente'),
       ('Cuenta de Ahorro')
create table formularios_bancos_cuentas
(
    id                 int not null primary key auto_increment,
    idBanco            int,
    numeroCuenta       varchar(250),
    idTipoCuenta       int,
    idEmpresa          int,
    estado             char(1)  default 'A',
    eliminado          char(1)  default 'N',
    fechaRegistro      datetime default current_timestamp,
    idUsuarioRegistra  int,
    idUsuarioActualiza int,
    fechaActualiza     datetime,
    fechaElimina       datetime,
    idUsuarioElimina   int,
    constraint FK_FORM_CONF_BANCOS_BANCO_ID foreign key (idBanco) references planilla_cat_bancos (id),
    constraint FK_FORM_CONF_BANCOS_EMPRESA_ID foreign key (idEmpresa) references general_datos_empresa (id),
    constraint FK_FORM_CONF_BANCOS_TCUEN_ID foreign key (idTipoCuenta) references formularios_bancos_tipo_cuentas (id),
    constraint FK_FORM_CONF_BANCOS_USU_REGISTRA_ID foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_FORM_CONF_BANCOS_USU_ACTUALIZA_ID foreign key (idUsuarioActualiza) references general_usuarios (id),
    constraint FK_FORM_CONF_BANCOS_USU_ELIMINA_ID foreign key (idUsuarioElimina) references general_usuarios (id)
);

create table formularios_bancos_conf_montos_aprobacion
(
    id                  int not null primary key auto_increment,
    idCuentaBanco       int,
    idUsuarioAutorizado int,
    montoDesde          decimal(11, 2),
    montoHasta          decimal(11, 2),
    estado              char(1)  default 'A',
    eliminado           char(1)  default 'N',
    fechaRegistro       datetime default current_timestamp,
    idUsuarioRegistra   int,
    idUsuarioActualiza  int,
    fechaActualiza      datetime,
    fechaElimina        datetime,
    idUsuarioElimina    int,
    constraint FK_FORM_CONF_MONTOS_CUENTA_ID foreign key (idCuentaBanco) references formularios_bancos_cuentas (id),
    constraint FK_FORM_CONF_MONTOS_USU_AUTORIZADO_ID foreign key (idUsuarioAutorizado) references general_usuarios (id),
    constraint FK_FORM_CONF_MONTOS_USU_REGISTRA_ID foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_FORM_CONF_MONTOS_USU_ACTUALIZA_ID foreign key (idUsuarioActualiza) references general_usuarios (id),
    constraint FK_FORM_CONF_MONTOS_USU_ELIMINA_ID foreign key (idUsuarioElimina) references general_usuarios (id)
);