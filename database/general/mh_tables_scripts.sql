create table mh_actividad_economica
(
    id int not null primary key auto_increment,
    codigoActividad varchar(24),
    nombreActividad varchar(500),
    activo          char(1) default 'S'
);


create table mh_departamentos
(
    id     int not null primary key auto_increment,
    codigo varchar(5),
    nombre varchar(250)
);

create table mh_municipios
(
    id             int not null primary key auto_increment,
    idDepartamento int,
    codigo         varchar(5),
    nombre         varchar(250)
);

create table mh_tipo_documento_identidad
(
    id     int not null primary key auto_increment,
    codigo varchar(5),
    nombre varchar(150)
);

create table mh_tipo_documento_fiscal
(
    id     int not null primary key auto_increment,
    codigo varchar(5),
    nombre varchar(150)
);

create table mh_tipo_facturacion
(
    id     int not null primary key,
    nombre varchar(150)
);
insert into mh_tipo_facturacion(id, nombre)
values (1, 'Modelo Facturación previo'),
       (2, 'Modelo Facturación diferido');

create table mh_tipo_transmision
(
    id     varchar(4) not null primary key,
    nombre varchar(250)
);
insert into mh_tipo_transmision
values (1, 'Transmisión normal'),
       (2, 'Transmisión por contingencia');

create table mh_tipo_contigencia
(
    id     varchar(5) not null primary key,
    nombre varchar(150)
);

insert into mh_tipo_contigencia
values (1, 'No disponibilidad de sistema del MH'),
       (2, 'No disponibilidad de sistema del emisor'),
       (3, 'Falla en el suministro de servicio de Internet del Emisor'),
       (4, 'Falla en el suministro de servicio de energía eléctrica del emisor que impida la transmisión de los DTE'),
       (5, 'Otro (deberá digitar un máximo de 500 caracteres explicando el motivo)');


create table mh_tipo_establecimiento
(
    id int not null primary key auto_increment,
    codigo     varchar(5),
    nombre varchar(150)
);
insert into mh_tipo_establecimiento (codigo, nombre)
values (01, 'Sucursal / Agencia'),
       (02, 'Casa matriz'),
       (03, 'Bodega'),
       (07, 'Predio y/o patio'),
       (20, 'Otro');

create table mh_condicion_venta
(
    id int not null primary key auto_increment,
    codigo     varchar(5),
    nombre varchar(150)
);

insert into mh_condicion_venta (codigo,nombre)
values  (01, 'Contado'),
       (2, 'Credito'),
       (3, 'Otro');

# create table mh_condicion_operacion(
#     id varchar(5) not null primary key ,
#     nombre varchar(150),
#     realizaMetodo char(1) default 'N'
# );

create table mh_ambiente(
    id int not null primary key auto_increment,
    codigo char(2),
    nombre varchar(150)
);
insert into mh_ambiente (codigo, nombre) VALUES ('00', 'Desarrollo'),('01', 'Producción')

drop table mh_paises;
create table  mh_paises(
    id int not null primary key auto_increment,
    codigo varchar(10),
    nombre varchar(500),
    eliminado char(1) default 'N'
);
update mh_paises set eliminado = 'S'

create table mh_unidad_medida(
    id int not null primary key auto_increment,
    codigo varchar(10),
    nombre varchar(500),
    eliminado char(1)
)