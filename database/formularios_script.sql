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
       ('Cuenta de Ahorro');
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

create table formularios_banco_tipo_transferencia
(
    id     int not null primary key auto_increment,
    nombre varchar(250)
);
insert into formularios_banco_tipo_transferencia (nombre)
values ('Nacional'),
       ('Internacional');
create table formularios_bancos_cat_estados_transferencias
(
    id     int not null primary key auto_increment,
    nombre varchar(250)
);
insert into formularios_bancos_cat_estados_transferencias (nombre)
values ('Solicitado'),
       ('Autorizado'),
       ('Aplicado');

create table formularios_banco_solicitudes_transferencias
(
    id                       bigint not null primary key auto_increment,
    nombreAPagar             varchar(5000),
    concepto                 text,
    descripcion              text,
    montoAPagar              decimal(11, 2),
    idBancoDestino           int,
    numeroCuentaDestino      varchar(1500),
    idTipoCuentaBancoDestino int,
    idTipoTransferencia      int,
    tIntCuentaIntermediaria  varchar(1500),
    tIntSWITF                varchar(500),
    tIntBancoIntermediario   varchar(1500),
    tIntIntermediarioABA     varchar(1500),
    tIntSWITFintermediario   varchar(1500),
    tIntIntermediario        varchar(1500),
    tIntDetalles             text,
    idEstadoTransferencia    int,
    idUsuarioSolicita        int,
    fechaSolicita            datetime,
    idUsuarioAutoriza        int,
    fechaAutoriza            datetime,
    idUsuarioAplica          int,
    fechaAplica              datetime,
    idCuentaDebitar          int,
    documentoRespaldo        char(1)  default 'N',
    observaciones            text,
    eliminado                char(1)  default 'N',
    fechaRegistro            datetime default current_timestamp,
    fechaElimina             datetime,
    idUsuarioElimina         int,
    CONSTRAINT FK_FORM_BANCO_SOLI_TRANS_ID_BANCO_DEST FOREIGN KEY (idBancoDestino) REFERENCES planilla_cat_bancos (id),
    CONSTRAINT FK_FORM_BANCO_SOLI_TRANS_ID_TCUEN_DEST FOREIGN KEY (idTipoCuentaBancoDestino) references formularios_bancos_tipo_cuentas (id),
    CONSTRAINT FK_FORM_BANCO_SOLI_TRANS_ID_TIPO_TRANSF FOREIGN KEY (idTipoTransferencia) references formularios_banco_tipo_transferencia (id),
    CONSTRAINT FK_FORM_BANCO_SOLI_TRANS_ID_ESTADO_TRANSFE FOREIGN KEY (idEstadoTransferencia) references formularios_bancos_cat_estados_transferencias (id),
    CONSTRAINT FK_FORM_BANCO_SOLI_TRANS_ID_USR_SOLICITA FOREIGN KEY (idUsuarioSolicita) references general_usuarios (id),
    CONSTRAINT FK_FORM_BANCO_SOLI_TRANS_ID_USR_AUTORIZA FOREIGN KEY (idUsuarioAutoriza) references general_usuarios (id),
    CONSTRAINT FK_FORM_BANCO_SOLI_TRANS_ID_USR_APLICA FOREIGN KEY (idUsuarioAplica) references general_usuarios (id),
    CONSTRAINT FK_FORM_BANCO_SOLI_TRANS_ID_CUENTA_DEBITAR FOREIGN KEY (idCuentaDebitar) references formularios_bancos_cuentas (id),
    CONSTRAINT FK_FORM_BANCO_SOLI_TRANS_ID_USR_ELIMINA FOREIGN KEY (idUsuarioElimina) references general_usuarios (id)
)   ;