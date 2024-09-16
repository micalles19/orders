create table clientes_datos_generales
(
    id                       int not null primary key auto_increment,
    codigoCliente            varchar(100) default null,
    idTipoDocumentoIdentidad varchar(12) default null,
    numeroDocumento varchar(250) default null,
    nit                      varchar(25) default null,
    iva              varchar(12) default null,
    idActividadEconomica     varchar(25) default null,
    nombreCliente            varchar(1500) default null,
    correo                   varchar(150) default null,
    telefono                 varchar(12) default null,
    idDepartamento           int default null,
    idMunicipio              int default null,
    direccion varchar(5000) default null,
    fechaRegistro            datetime default current_timestamp,
    idUsuarioRegistra        int,
    eliminado                char(1)  default 'N',
    fechaElimina             datetime,
    idUsuarioElimina         int,
    constraint fk_clientes_dpto_id foreign key (idDepartamento) references mh_departamentos (id),
    constraint fk_clientes_mncpo_id foreign key (idMunicipio) references mh_municipios (id),
    constraint FK_usuario_clientes_datos_id_registra foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_usuario_clientesdatos_id_elimina foreign key (idUsuarioElimina) references general_usuarios (id)
);
drop table clientes_datos_generales;


create table clientes_datos_sucursales
(
    id                    int not null primary key auto_increment,
    idCliente             int,
    idTipoEstablecimiento int,
    responsable           varchar(500),
    telefono              varchar(25),
    correo                varchar(500),
    idDepartamento        int,
    idMunicipio           int,
    direccion             varchar(5000),
    refenciasDireccion    varchar(5000),
    eliminado             char(1)  default 'N',
    idUsuarioRegistra     int,
    fechaRegistro         datetime default current_timestamp,
    idUsuarioElimina      int,
    fechaElimina          datetime,
    constraint FK_sucursales_cliente_datos_id foreign key (idCliente) references clientes_datos_generales (id),
    constraint FK_sucursales_establecimiento_id foreign key (idTipoEstablecimiento) references mh_tipo_establecimiento (id),
    constraint FK_sucursales_departamentos_id foreign key (idDepartamento) references mh_departamentos (id),
    constraint FK_sucursales_municipios_id foreign key (idMunicipio) references mh_municipios (id),
    constraint FK_sucursales_usuario_id_registra foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_sucursales_usuario_id_elimina foreign key (idUsuarioElimina) references general_usuarios (id)
);



