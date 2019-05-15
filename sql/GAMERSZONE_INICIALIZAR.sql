DROP TABLE lineaVentas;
DROP TABLE ventas;
DROP TABLE lineaConsumibles;
DROP TABLE lineaPases;
DROP TABLE bonos;
DROP TABLE participantestorneos;
DROP TABLE torneos;
DROP TABLE donaciones;
DROP TABLE participacionesSorteos;
DROP TABLE almacenesConsumibles;
DROP TABLE almacenesPases;
DROP TABLE consumibles;
DROP TABLE pases;
DROP TABLE usuarios;

CREATE TABLE usuarios(
    dni varchar2(9)     not null,
    CONSTRAINT "dni_CHK1" CHECK (length(dni) = 9),
    CONSTRAINT "dni_CHK2" CHECK (REGEXP_LIKE(dni, '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][A-Z]')),
    nombre varchar2(50)     not null,
    CONSTRAINT "Nombre_CHK" CHECK (length(nombre) > 3),
    pass varchar2(20)   not null,
    CONSTRAINT "Pass_CHK" CHECK ((REGEXP_INSTR(pass, '[0-9]') > 0) AND (REGEXP_INSTR(pass, '[A-Z]') > 0)),
    CONSTRAINT "Pass_CHK2" CHECK (length(pass) >= 8),
    correo varchar2(50)     not null,
    fechaNacimiento date    not null,
    fechaInscripcion date DEFAULT sysdate,
    CONSTRAINT "Adulto_CHK" CHECK (((TO_NUMBER (TO_CHAR (fechaInscripcion, 'yyyy'))) - ((TO_NUMBER (TO_CHAR (fechaNacimiento, 'yyyy')))))>=16),
    tipoPago varchar2(7) CONSTRAINT "Pago_CHK1" CHECK (tipoPago IN('Tarjeta', 'Paypal')),
    activo varchar2(5) CONSTRAINT "Activo_CHK1" CHECK (activo IN('TRUE','FALSE')),
    UNIQUE (correo),
    PRIMARY KEY (dni)
);

CREATE TABLE pases(
    Pases_ID smallint not null,
    tipoMedio varchar2(20) CONSTRAINT "Medio_CHK1" CHECK (tipoMedio IN('PC', 'Consola generica', 'PS4', 'GameCube', 'Switch', 'XBOX One'))     not null,
    UNIQUE (tipoMedio),
    PRIMARY KEY (Pases_ID)
);

CREATE TABLE consumibles(   
    Consumibles_ID smallint  not null,
    nombreConsumible varchar2(20)   not null,
    tipoConsumible varchar2(20) CONSTRAINT "Consumible_CHK" CHECK (tipoConsumible IN('Bebida alcoholica', 'Bebida generica', 'Comida'))    not null,
    UNIQUE (nombreConsumible),
    PRIMARY KEY (Consumibles_ID)
);

CREATE TABLE almacenesPases(
    AlmacenesPases_ID smallint not null,
    dni varchar2(9)     not null,
    Pases_ID smallint not null,
    cantidadPase NUMBER(3,0)    not null,
    CONSTRAINT "CantidadPase_CHK" CHECK (cantidadPase>=0),
    PRIMARY KEY (AlmacenesPases_ID),
    UNIQUE (dni,Pases_ID),
    FOREIGN KEY (dni) REFERENCES usuarios,
    FOREIGN KEY (Pases_ID) REFERENCES pases
);

CREATE TABLE almacenesConsumibles(
    AlmacenesConsumibles_ID smallint not null,
    dni varchar2(9)     not null,
    Consumibles_ID smallint  not null,
    cantidadConsumible number(3,0)    not null,
    CONSTRAINT "CantidadConsumible_CHK" CHECK (cantidadConsumible>=0),
    PRIMARY KEY (AlmacenesConsumibles_ID),
    UNIQUE (dni, Consumibles_ID),
    FOREIGN KEY (dni) REFERENCES usuarios,
    FOREIGN KEY (Consumibles_ID) REFERENCES consumibles
);

CREATE TABLE participacionesSorteos(
    ParticipacionesSorteos_ID smallint not null,
    juegoMesa varchar2(50) not null,
    participacion number(5,0),
    CONSTRAINT "Participacion_CHK" CHECK (participacion>=0),
    UNIQUE (juegoMesa),
    PRIMARY KEY (ParticipacionesSorteos_ID)
);

CREATE TABLE donaciones(
    Donaciones_ID smallint    not null,
    dni varchar2(9)     not null,
    ParticipacionesSorteos_ID smallint not null,
    fechaDonacion date      DEFAULT sysdate,
    aportacion number(3)  not null,
    CONSTRAINT "Aportacion_CHK" CHECK (aportacion>=0),
    PRIMARY KEY (Donaciones_ID),
    FOREIGN KEY (dni) REFERENCES usuarios,
    FOREIGN KEY (ParticipacionesSorteos_ID) REFERENCES participacionesSorteos    
);

CREATE TABLE torneos(
    Torneos_ID smallint   not null,
    precioTorneo number(5,2),
    CONSTRAINT "PrecioTorneo_CHK" CHECK (precioTorneo>=0),
    videojuego varchar2(50)     not null,
    maxParticipantes number(4,0),
    CONSTRAINT "maxParticipantes_CHK" CHECK (maxParticipantes>=0),
    nombreTorneo varchar2(50)  not null,
    fechaTorneo date    not null,
    PRIMARY KEY (Torneos_ID)
);

CREATE TABLE participantesTorneos(
    ParticipantesTorneos_ID smallint not null,
    Torneos_ID  smallint       not null,
    dni   varchar2(9)    not null,
    UNIQUE (dni,torneos_ID),
    PRIMARY KEY(ParticipantesTorneos_ID),
    FOREIGN KEY (Torneos_ID) REFERENCES torneos,
    FOREIGN KEY (dni)  REFERENCES usuarios
);

CREATE TABLE bonos(
    Bonos_ID smallint    not null,
    precioBono number (4,2)  not null,
    CONSTRAINT "PrecioBono_CHK" CHECK (precioBono>=0),
    nombreBono varchar2(20)     not null,
    disponible varchar2(5) CONSTRAINT "Disponible_CHK1" CHECK (disponible IN('TRUE','FALSE')),
    UNIQUE (nombreBono),
    PRIMARY KEY (Bonos_ID)
);

CREATE TABLE lineaPases(
    LineaPases_ID smallint not null,
    Bonos_ID smallint    not null,
    Pases_ID smallint not null,
    cantidadLP number(2)  not null,
    CONSTRAINT "CantidadLP_CHK" CHECK (cantidadLP>=0),
    PRIMARY KEY (LineaPases_ID),
    FOREIGN KEY (Pases_ID) REFERENCES pases,
    FOREIGN KEY (Bonos_ID) REFERENCES bonos
);

CREATE TABLE lineaConsumibles(
    LineaConsumibles_ID smallint not null,
    Bonos_ID smallint    not null,
    Consumibles_ID smallint  not null,
    cantidadLC number(2)  not null,
    CONSTRAINT "CantidadLC_CHK" CHECK (cantidadLC>=0),
    PRIMARY KEY (LineaConsumibles_ID),
    FOREIGN KEY (Consumibles_ID) REFERENCES consumibles,
    FOREIGN KEY (Bonos_ID) REFERENCES bonos
);

CREATE TABLE ventas(
    Ventas_ID smallint   not null,
    dni varchar2(9)     not null,
    fechaVenta date     DEFAULT sysdate,
    PRIMARY KEY(Ventas_ID),
    FOREIGN KEY (dni) REFERENCES usuarios
);

CREATE TABLE lineaVentas(
    LineaVentas_ID smallint not null,
    Bonos_ID smallint    not null,
    Ventas_ID smallint   not null,
    cantidadLV number(3,0)  not null,
    CONSTRAINT "CantidadLV_CHK" CHECK (cantidadLV>=0),
    precioLV number(4,2)     not null,
    CONSTRAINT "PrecioLV_CHK" CHECK (precioLV>=0),
    descuento number(3,0),
    CONSTRAINT "Descuento_CHK" CHECK (descuento>=0 and descuento <=100),
    PRIMARY KEY(LineaVentas_ID),
    FOREIGN KEY (Bonos_ID) REFERENCES bonos,
    FOREIGN KEY (Ventas_ID) REFERENCES ventas
);

DROP SEQUENCE seq_lineaVentas;
DROP SEQUENCE seq_ventas;
DROP SEQUENCE seq_lineaConsumibles;
DROP SEQUENCE seq_lineaPases;
DROP SEQUENCE seq_bonos;
DROP SEQUENCE seq_participantestorneos;
DROP SEQUENCE seq_torneos;
DROP SEQUENCE seq_donaciones;
DROP SEQUENCE seq_participacionesSorteos;
DROP SEQUENCE seq_almacenesConsumibles;
DROP SEQUENCE seq_almacenesPases;
DROP SEQUENCE seq_consumibles;
DROP SEQUENCE seq_pases;

CREATE SEQUENCE seq_pases INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_consumibles INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_almacenesPases INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_almacenesConsumibles INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_participacionesSorteos INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_donaciones INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_torneos INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_participantestorneos INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_bonos INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_lineaPases INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_lineaConsumibles INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_ventas INCREMENT BY 1 START WITH 1;
CREATE SEQUENCE seq_lineaVentas INCREMENT BY 1 START WITH 1;

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_CONSUMIBLES 
BEFORE INSERT ON CONSUMIBLES 
FOR EACH ROW
BEGIN
  SELECT seq_consumibles.nextval into :new.Consumibles_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_TORNEOS 
BEFORE INSERT ON TORNEOS
FOR EACH ROW
BEGIN
  SELECT seq_torneos.nextval into :new.Torneos_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_BONOS 
BEFORE INSERT ON BONOS 
FOR EACH ROW
BEGIN
  SELECT seq_bonos.nextval into :new.Bonos_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_VENTAS 
BEFORE INSERT ON VENTAS 
FOR EACH ROW
BEGIN
  SELECT seq_ventas.nextval into :new.Ventas_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_PASES 
BEFORE INSERT ON PASES 
FOR EACH ROW
BEGIN
  SELECT seq_pases.nextval into :new.Pases_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_ALMPASES
BEFORE INSERT ON ALMACENESPASES 
FOR EACH ROW
BEGIN
  SELECT seq_almacenesPases.nextval into :new.AlmacenesPases_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_ALMCONSUMIBLES 
BEFORE INSERT ON ALMACENESCONSUMIBLES 
FOR EACH ROW
BEGIN
  SELECT seq_almacenesConsumibles.nextval into :new.AlmacenesConsumibles_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_PARTICIONSORTEOS 
BEFORE INSERT ON PARTICIPACIONESSORTEOS 
FOR EACH ROW
BEGIN
  SELECT seq_participacionesSorteos.nextval into :new.ParticipacionesSorteos_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_DONACIONES
BEFORE INSERT ON DONACIONES 
FOR EACH ROW
BEGIN
  SELECT seq_donaciones.nextval into :new.Donaciones_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_PARTICANTESTORNEOS
BEFORE INSERT ON PARTICIPANTESTORNEOS 
FOR EACH ROW
BEGIN
  SELECT seq_participantestorneos.nextval into :new.ParticipantesTorneos_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_LINEAPASES
BEFORE INSERT ON LINEAPASES 
FOR EACH ROW
BEGIN
  SELECT seq_lineaPases.nextval into :new.LineaPases_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_LINEACONSUMIBLES
BEFORE INSERT ON LINEACONSUMIBLES 
FOR EACH ROW
BEGIN
  SELECT seq_lineaConsumibles.nextval into :new.LineaConsumibles_ID from dual;
END;
/

CREATE OR REPLACE TRIGGER TRIGGER_SEQ_LINEAVENTAS
BEFORE INSERT ON LINEAVENTAS 
FOR EACH ROW
BEGIN
  SELECT seq_lineaVentas.nextval into :new.LineaVentas_ID from dual;
END;
/