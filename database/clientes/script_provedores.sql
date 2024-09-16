create table proveedores_datos_generales
(
    id                       int not null primary key auto_increment,
    codigo            varchar(100) default null,
    idTipoDocumentoIdentidad varchar(12) default null,
    numeroDocumento varchar(250) default null,
    nit                      varchar(25) default null,
    iva              varchar(12) default null,
    idActividadEconomica     varchar(25) default null,
    nombre           varchar(1500) default null,
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
    constraint fk_proveedores_dpto_id foreign key (idDepartamento) references mh_departamentos (id),
    constraint fk_proveedores_mncpo_id foreign key (idMunicipio) references mh_municipios (id),
    constraint FK_proveedores_datos_id_registra foreign key (idUsuarioRegistra) references general_usuarios (id),
    constraint FK_proveedores_id_elimina foreign key (idUsuarioElimina) references general_usuarios (id)
);
drop table proveedores_datos_generales;




