SET SERVEROUTPUT ON;

CREATE OR REPLACE PACKAGE PRUEBAS_USUARIOS AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_dni VARCHAR2, w_nombre VARCHAR2, w_pass VARCHAR2, w_correo VARCHAR2, w_fechaNacimiento date, w_tipoPago VARCHAR2, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_dni VARCHAR2, w_nombre VARCHAR2, w_pass VARCHAR2, w_correo VARCHAR2, w_fechaNacimiento date, w_tipoPago VARCHAR2, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_dni VARCHAR2, salidaEsperada BOOLEAN);

END PRUEBAS_USUARIOS;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_USUARIOS AS

PROCEDURE INICIALIZAR AS
BEGIN
VACIAR_BD;
END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, w_dni VARCHAR2, w_nombre VARCHAR2, w_pass VARCHAR2, w_correo VARCHAR2, w_fechaNacimiento date, w_tipoPago VARCHAR2, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
usuario usuarios%ROWTYPE;

BEGIN
    NUEVO_USUARIO(w_dni, w_nombre, w_pass, w_correo, w_fechaNacimiento, w_tipoPago);
    
SELECT * INTO usuario FROM usuarios WHERE dni = w_dni;
IF ((usuario.nombre<>w_nombre) OR (usuario.pass<>w_pass) OR (usuario.correo<>w_correo) OR (usuario.fechaNacimiento<>w_fechaNacimiento) OR (usuario.tipoPago<>w_tipoPago)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_dni VARCHAR2, w_nombre VARCHAR2, w_pass VARCHAR2, w_correo VARCHAR2, w_fechaNacimiento date, w_tipoPago VARCHAR2, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
usuario usuarios%ROWTYPE;
BEGIN

UPDATE usuarios SET nombre=w_nombre, pass = w_pass, correo=w_correo, fechaNacimiento=w_fechaNacimiento, tipoPago=w_tipoPago WHERE dni=w_dni;

SELECT * INTO usuario FROM usuarios WHERE dni=w_dni;

IF ((usuario.nombre<>w_nombre) OR (usuario.pass<>w_pass) OR (usuario.correo<>w_correo) OR (usuario.fechaNacimiento<>w_fechaNacimiento) OR (usuario.tipoPago <>w_tipoPago)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_dni VARCHAR2, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_usuarios INTEGER;

BEGIN

DELETE FROM usuarios WHERE dni=w_dni;

SELECT COUNT(*) INTO n_usuarios FROM usuarios WHERE dni=w_dni;
IF (n_usuarios <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_USUARIOS;
/




CREATE OR REPLACE PACKAGE PRUEBAS_PASES AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_tipoMedio VARCHAR2, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_Pases_ID smallint, w_tipoMedio VARCHAR2, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_Pases_ID smallint, salidaEsperada BOOLEAN);

END PRUEBAS_PASES;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_PASES AS

PROCEDURE INICIALIZAR AS
BEGIN
VACIAR_BD;
END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, w_tipoMedio VARCHAR2, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
pase pases%ROWTYPE;
w_Pases_ID smallint;

BEGIN
    NUEVO_PASE(w_tipoMedio);
    
    SELECT SEQ_PASES.currval into w_Pases_ID from dual;
    
SELECT * INTO pase FROM pases WHERE Pases_ID = w_Pases_ID;
IF (pase.tipoMedio <> w_tipoMedio) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;


PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_Pases_ID smallint, w_tipoMedio VARCHAR2, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
pase pases%ROWTYPE;
BEGIN

UPDATE pases SET tipoMedio=w_tipoMedio WHERE Pases_ID=w_Pases_ID;

SELECT * INTO pase FROM pases WHERE Pases_ID=w_Pases_ID;

IF (pase.tipoMedio <> w_tipoMedio) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;



PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_Pases_ID smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_pases INTEGER;

BEGIN

DELETE FROM pases WHERE Pases_ID=w_Pases_ID;

SELECT COUNT(*) INTO n_pases FROM pases WHERE Pases_ID=w_Pases_ID;
IF (n_pases <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_PASES;
/




--PRUEBAS CONSUMIBLES
CREATE OR REPLACE PACKAGE PRUEBAS_CONSUMIBLES AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_nombreConsumible varchar2, w_tipoConsumible varchar2, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_consumibles_id smallint, w_nombreConsumible varchar2, w_tipoConsumible varchar2, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_consumibles_id smallint, salidaEsperada BOOLEAN);

END PRUEBAS_CONSUMIBLES;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_CONSUMIBLES AS

PROCEDURE INICIALIZAR AS
BEGIN

VACIAR_BD;
END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, w_nombreConsumible varchar2, w_tipoConsumible varchar2, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
consumible consumibles%ROWTYPE;
w_consumibles_id smallint;
BEGIN
    NUEVO_CONSUMIBLE(w_nombreConsumible, w_tipoConsumible);
    
    SELECT SEQ_CONSUMIBlES.CURRVAL INTO w_Consumibles_id FROM dual;
    
SELECT * INTO consumible FROM consumibles WHERE Consumibles_id = w_consumibles_id;
IF ((consumible.nombreConsumible <> w_nombreConsumible)OR(consumible.tipoConsumible<>w_tipoConsumible)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_consumibles_id smallint, w_nombreConsumible varchar2, w_tipoConsumible varchar2, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
consumible consumibles%ROWTYPE;
BEGIN

UPDATE consumibles SET nombreConsumible=w_nombreConsumible, tipoConsumible=w_tipoConsumible WHERE Consumibles_id=w_consumibles_id;

SELECT * INTO consumible FROM consumibles WHERE Consumibles_id=w_consumibles_id;

IF ((consumible.nombreConsumible <> w_nombreConsumible)OR(consumible.tipoConsumible<>w_tipoConsumible)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_consumibles_id smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_consumibles INTEGER;

BEGIN

DELETE FROM consumibles WHERE Consumibles_id=w_consumibles_id;

SELECT COUNT(*) INTO n_consumibles FROM consumibles WHERE Consumibles_id=w_consumibles_id;
IF (n_consumibles <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_CONSUMIBLES;
/




--PRUEBAS ALMACENESPASES
CREATE OR REPLACE PACKAGE PRUEBAS_ALMACENESPASES AS
PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_dni varchar2, w_pases_ID varchar2, w_cantidadPase NUMBER, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_AlmacenesPases_ID smallint, w_dni varchar2, w_pases_ID varchar2, w_cantidadPase NUMBER, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_AlmacenesPases_ID smallint, salidaEsperada BOOLEAN);

END PRUEBAS_ALMACENESPASES;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_ALMACENESPASES AS

PROCEDURE INICIALIZAR AS
BEGIN

VACIAR_BD;

/*
    DELETE FROM almacenesPases;
    DELETE FROM usuarios;
    DELETE FROM pases;
    */
    
    NUEVO_USUARIO ('12345678A', 'Nombre De Usuario1', 'Contraseña1', 'correo1@domain.com', TO_DATE('1987/05/03', 'yyyy/mm/dd'), 'Paypal');
    NUEVO_USUARIO ('12345678B', 'Nombre De Usuario2', 'Contraseña2', 'correo2@domain.com', TO_DATE('1987/05/03', 'yyyy/mm/dd'), 'Paypal');
    NUEVO_PASE ('PC');
    NUEVO_PASE ('PS4');

    
    COMMIT WORK;

    
END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, w_dni varchar2, w_pases_ID varchar2, w_cantidadPase NUMBER, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;

almacenPases almacenesPases%ROWTYPE;

w_AlmacenesPases_ID smallint;

BEGIN

    ANADIR_ALMACEN_PASES (w_dni, w_pases_ID, w_cantidadPase);
    
    SELECT SEQ_ALMACENESPASES.currval INTO w_almacenesPases_ID FROM dual;
    
SELECT * INTO almacenPases FROM almacenesPases WHERE almacenesPases_ID=w_almacenesPases_ID;
IF ((almacenPases.cantidadPase<>w_cantidadPase)OR(almacenPases.dni <> w_dni)OR(almacenPases.pases_ID<>w_pases_ID)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_almacenesPases_ID smallint, w_dni varchar2, w_pases_ID varchar2, w_cantidadPase NUMBER, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
almacenPases almacenesPases%ROWTYPE;
BEGIN

UPDATE almacenesPases SET cantidadPase=w_cantidadPase, dni=w_dni, pases_ID=w_pases_ID WHERE almacenesPases_ID=w_almacenesPases_ID;

SELECT * INTO almacenPases FROM almacenesPases WHERE almacenesPases_ID=w_almacenesPases_ID;

IF ((almacenPases.cantidadPase<>w_cantidadPase)OR(almacenPases.dni <> w_dni)OR(almacenPases.pases_ID<>w_pases_ID)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_almacenesPases_ID smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_almacenPases INTEGER;

BEGIN

DELETE FROM almacenesPases WHERE almacenesPases_ID=w_almacenesPases_ID;

SELECT COUNT(*) INTO n_almacenPases FROM almacenesPases WHERE almacenesPases_ID=w_almacenesPases_ID;
IF (n_almacenPases <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_ALMACENESPASES;
/




--PRUEBAS ALMACENESCONSUMIBLES
CREATE OR REPLACE PACKAGE PRUEBAS_ALMACENESCONSUMIBLES AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_dni varchar2, w_Consumibles_id smallint, w_cantidadConsumible number, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_AlmacenesConsumibles_ID smallint, w_dni varchar2, w_Consumibles_id smallint, w_cantidadConsumible number, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_AlmacenesConsumibles_ID smallint, salidaEsperada BOOLEAN);

END PRUEBAS_ALMACENESCONSUMIBLES;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_ALMACENESCONSUMIBLES AS

PROCEDURE INICIALIZAR AS
BEGIN

    VACIAR_BD;
/*
    DELETE FROM almacenesConsumibles;
    DELETE FROM consumibles;
    DELETE FROM usuarios;
    */
    
    NUEVO_USUARIO ('12345678A', 'Nombre De Usuario1', 'Contraseña1', 'correo1@domain.com', TO_DATE('1987/05/03', 'yyyy/mm/dd'), 'Paypal');
        NUEVO_USUARIO ('12345678B', 'Nombre De Usuario2', 'Contraseña2', 'correo2@domain.com', TO_DATE('1987/05/03', 'yyyy/mm/dd'), 'Paypal');
    NUEVO_CONSUMIBLE ('CocaCola', 'Bebida generica');
        NUEVO_CONSUMIBLE ('Fanta', 'Bebida generica');

    
    COMMIT WORK;

END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2,  w_dni varchar2, w_Consumibles_id smallint, w_cantidadConsumible number, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
almacenConsumibles almacenesConsumibles%ROWTYPE;
w_AlmacenesConsumibles_ID smallint;

BEGIN

    ANADIR_ALMACEN_CONSUMIBLES (w_dni, w_consumibles_id, w_cantidadConsumible);
    
    SELECT SEQ_ALMACENESCONSUMIBLES.currval INTO w_almacenesConsumibles_ID FROM dual;
    
SELECT * INTO almacenConsumibles FROM almacenesConsumibles WHERE almacenesConsumibles_ID = w_almacenesConsumibles_ID;
IF ((almacenConsumibles.cantidadConsumible<>w_cantidadConsumible)OR(almacenConsumibles.dni<>w_dni)OR(almacenConsumibles.consumibles_id<>w_consumibles_id)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_AlmacenesConsumibles_ID smallint,w_dni varchar2, w_Consumibles_id smallint, w_cantidadConsumible number, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
almacenConsumibles almacenesConsumibles%ROWTYPE;
BEGIN

UPDATE almacenesConsumibles SET cantidadConsumible=w_cantidadConsumible, dni=w_dni, consumibles_id=w_consumibles_id WHERE AlmacenesConsumibles_ID=w_AlmacenesConsumibles_ID;

SELECT * INTO almacenConsumibles FROM almacenesConsumibles WHERE AlmacenesConsumibles_ID=w_AlmacenesConsumibles_ID;

IF ((almacenConsumibles.cantidadConsumible<>w_cantidadConsumible)OR(almacenConsumibles.dni<>w_dni)OR(almacenConsumibles.consumibles_id<>w_consumibles_id)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_AlmacenesConsumibles_ID smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_almacenesconsumibles INTEGER;

BEGIN

DELETE FROM almacenesConsumibles WHERE AlmacenesConsumibles_ID=w_AlmacenesConsumibles_ID;

SELECT COUNT(*) INTO n_almacenesconsumibles FROM almacenesConsumibles WHERE AlmacenesConsumibles_ID=w_AlmacenesConsumibles_ID;
IF (n_almacenesconsumibles <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_ALMACENESCONSUMIBLES;
/





--PRUEBAS PARTICIPACIONESSORTEOS
CREATE OR REPLACE PACKAGE PRUEBAS_PARTICIPACIONESSORTEOS AS
PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_juegoMesa varchar2, w_participacion number, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_ParticipacionesSorteos_ID smallint, w_juegoMesa varchar2, w_participacion number, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_ParticipacionesSorteos_ID smallint, salidaEsperada BOOLEAN);

END PRUEBAS_PARTICIPACIONESSORTEOS;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_PARTICIPACIONESSORTEOS AS

PROCEDURE INICIALIZAR AS
BEGIN

VACIAR_BD;
END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, w_juegoMesa varchar2, w_participacion number, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
w_ParticipacionesSorteos_ID smallint;

participacionSorteo participacionesSorteos%ROWTYPE;

BEGIN
    NUEVA_PARTICIPACION_SORTEO (w_juegoMesa, w_participacion);
    
    SELECT seq_participacionesSorteos.currval INTO w_ParticipacionesSorteos_ID FROM dual;
    
SELECT * INTO participacionSorteo FROM participacionesSorteos WHERE ParticipacionesSorteos_ID=w_ParticipacionesSorteos_ID;
IF ((participacionSorteo.participacion <> w_participacion) OR (participacionSorteo.juegoMesa <> w_juegoMesa)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_ParticipacionesSorteos_ID smallint, w_juegoMesa varchar2, w_participacion number, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
participacionSorteo participacionesSorteos%ROWTYPE;
BEGIN

UPDATE participacionesSorteos SET participacion=w_participacion, juegoMesa=w_juegoMesa WHERE ParticipacionesSorteos_ID=w_ParticipacionesSorteos_ID;

SELECT * INTO participacionSorteo FROM participacionesSorteos WHERE ParticipacionesSorteos_ID=w_ParticipacionesSorteos_ID;

IF ((participacionSorteo.participacion <> w_participacion) OR (participacionSorteo.juegoMesa <> w_juegoMesa)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;


PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_ParticipacionesSorteos_ID smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_participacionessorteo INTEGER;

BEGIN

DELETE FROM participacionesSorteos WHERE ParticipacionesSorteos_ID=w_ParticipacionesSorteos_ID;

SELECT COUNT(*) INTO n_participacionessorteo FROM participacionesSorteos WHERE ParticipacionesSorteos_ID=w_ParticipacionesSorteos_ID;
IF (n_participacionessorteo <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;


END PRUEBAS_PARTICIPACIONESSORTEOS;
/



--PRUEBAS DONACIONES
CREATE OR REPLACE PACKAGE PRUEBAS_DONACIONES AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_dni varchar2, w_ParticipacionesSorteos_ID smallint, w_aportacion number, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_Donaciones_ID smallint, w_dni varchar2, w_ParticipacionesSorteos_ID smallint, w_aportacion number, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_Donaciones_ID smallint, salidaEsperada BOOLEAN);

END PRUEBAS_DONACIONES;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_DONACIONES AS

PROCEDURE INICIALIZAR AS
BEGIN
VACIAR_BD;

/*
    DELETE FROM consumibles;
    DELETE FROM participacionesSorteos;*/
    NUEVO_USUARIO ('12345678A', 'Nombre De Usuario1', 'Contraseña1', 'correo1@domain.com', TO_DATE('1987/05/03', 'yyyy/mm/dd'), 'Paypal');
    NUEVA_PARTICIPACION_SORTEO ('Jungle', 5);
    
    COMMIT WORK;
    
END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, w_dni varchar2, w_ParticipacionesSorteos_ID smallint, w_aportacion number, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
donacion donaciones%ROWTYPE;
w_Donaciones_ID smallint;
BEGIN

    DONACION_CONOCIENDO_SORTEO_ID (w_dni, w_ParticipacionesSorteos_ID, w_aportacion);
    
    SELECT SEQ_DONACIONES.CURRVAL INTO W_Donaciones_ID FROM dual;
    
SELECT * INTO donacion FROM donaciones WHERE Donaciones_ID = w_Donaciones_ID;
IF ((donacion.dni <> w_dni)OR(donacion.ParticipacionesSorteos_ID<>w_ParticipacionesSorteos_ID)OR(donacion.aportacion<>w_aportacion)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_Donaciones_ID smallint, w_dni varchar2, w_ParticipacionesSorteos_ID smallint, w_aportacion number, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
donacion donaciones%ROWTYPE;
BEGIN

UPDATE donaciones SET dni=w_dni, Donaciones_ID=w_Donaciones_ID, aportacion=w_aportacion WHERE Donaciones_ID=w_Donaciones_ID;

SELECT * INTO donacion FROM donaciones WHERE Donaciones_ID=w_Donaciones_ID;

IF ((donacion.dni <> w_dni)OR(donacion.ParticipacionesSorteos_ID<>w_ParticipacionesSorteos_ID)OR(donacion.aportacion<>w_aportacion)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_Donaciones_ID smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_donaciones INTEGER;

BEGIN

DELETE FROM donaciones WHERE Donaciones_ID=w_Donaciones_ID;

SELECT COUNT(*) INTO n_donaciones FROM donaciones WHERE Donaciones_ID=w_Donaciones_ID;
IF (n_donaciones <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_DONACIONES;
/



--PRUEBAS TORNEOS
CREATE OR REPLACE PACKAGE PRUEBAS_TORNEOS AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_precioTorneo number, w_videojuego varchar2, w_maxParticipantes number, w_nombreTorneo varchar2, w_fechaTorneo date, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_Torneos_ID smallint, w_precioTorneo number, w_videojuego varchar2, w_maxParticipantes number, w_nombreTorneo varchar2, w_fechaTorneo date, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_Torneos_ID smallint, salidaEsperada BOOLEAN);

END PRUEBAS_TORNEOS;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_TORNEOS AS

PROCEDURE INICIALIZAR AS
BEGIN
    VACIAR_BD;

END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, w_precioTorneo number, w_videojuego varchar2, w_maxParticipantes number, w_nombreTorneo varchar2, w_fechaTorneo date, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
torneo torneos%ROWTYPE;
w_Torneos_ID smallint;
BEGIN

    NUEVO_TORNEO (w_precioTorneo, w_videojuego, w_maxParticipantes, w_nombreTorneo, w_fechaTorneo);
    
    SELECT SEQ_TORNEOS.CURRVAL INTO W_Torneos_ID FROM dual;
    
SELECT * INTO torneo FROM torneos WHERE Torneos_ID = w_Torneos_ID;
IF ((torneo.precioTorneo <> w_precioTorneo)OR(torneo.videojuego<>w_videojuego)OR(torneo.maxParticipantes<>w_maxParticipantes)OR(torneo.nombreTorneo<>w_nombreTorneo)OR(torneo.fechaTorneo<>w_fechaTorneo)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_Torneos_ID smallint, w_precioTorneo number, w_videojuego varchar2, w_maxParticipantes number, w_nombreTorneo varchar2, w_fechaTorneo date, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
torneo torneos%ROWTYPE;
BEGIN

UPDATE torneos SET precioTorneo=w_precioTorneo, videojuego=w_videojuego, maxParticipantes=w_maxParticipantes, nombreTorneo=w_nombreTorneo, fechaTorneo=w_fechaTorneo WHERE Torneos_ID=w_Torneos_ID;

SELECT * INTO torneo FROM torneos WHERE Torneos_ID=w_Torneos_ID;

IF ((torneo.precioTorneo <> w_precioTorneo)OR(torneo.videojuego<>w_videojuego)OR(torneo.maxParticipantes<>w_maxParticipantes)OR(torneo.nombreTorneo<>w_nombreTorneo)OR(torneo.fechaTorneo<>w_fechaTorneo)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_Torneos_ID smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_torneos INTEGER;

BEGIN

DELETE FROM torneos WHERE Torneos_ID=w_Torneos_ID;

SELECT COUNT(*) INTO n_torneos FROM torneos WHERE Torneos_ID=w_Torneos_ID;
IF (n_torneos <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_TORNEOS;
/




--PRUEBAS PARTICIPANTESTORNEOS
CREATE OR REPLACE PACKAGE PRUEBAS_PARTICIPANTESTORNEOS AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_Torneos_ID smallint, w_dni varchar2, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_ParticipantesTorneos_ID smallint, w_Torneos_ID smallint, w_dni varchar2, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_ParticipantesTorneos_ID smallint, salidaEsperada BOOLEAN);

END PRUEBAS_PARTICIPANTESTORNEOS;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_PARTICIPANTESTORNEOS AS

PROCEDURE INICIALIZAR AS
BEGIN
VACIAR_BD;
/*
    DELETE FROM participantesTorneos;
    DELETE FROM torneos;
    DELETE FROM usuarios;*/
    
    NUEVO_USUARIO ('12345678A', 'Nombre De Usuario1', 'Contraseña1', 'correo1@domain.com', TO_DATE('1987/05/03', 'yyyy/mm/dd'), 'Paypal');
        NUEVO_USUARIO ('12345678B', 'Nombre De Usuario2', 'Contraseña2', 'correo2@domain.com', TO_DATE('1987/05/03', 'yyyy/mm/dd'), 'Paypal');

    NUEVO_TORNEO (12.5, 'Super Smash Bros Meele', 20, 'Torneo Smash1', TO_DATE ('2018/05/24','yyyy/mm/dd'));
        NUEVO_TORNEO (12.5, 'Super Smash Bros Meele', 20, 'Torneo Smash2', TO_DATE ('2018/05/24','yyyy/mm/dd'));


    
END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, w_Torneos_ID smallint, w_dni varchar2, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
participantetorneos participantestorneos%ROWTYPE;
w_participantestorneos_id smallint;
BEGIN

    INSCRIPCION(w_dni, w_Torneos_ID);
    
    SELECT SEQ_PARTICIPANTESTORNEOS.CURRVAL INTO w_ParticipantesTorneos_ID FROM dual;
    
SELECT * INTO participantetorneos FROM participantestorneos WHERE Participantestorneos_id = w_participantestorneos_id;
IF ((participantetorneos.dni <> w_dni)OR(participantetorneos.Torneos_ID<>w_Torneos_ID)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_ParticipantesTorneos_ID smallint, w_Torneos_ID smallint, w_dni varchar2, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
participantetorneos participantestorneos%ROWTYPE;
BEGIN

UPDATE participantestorneos SET Torneos_ID=w_Torneos_ID, dni=w_dni WHERE Participantestorneos_id=w_participantestorneos_id;

SELECT * INTO participantetorneos FROM participantestorneos WHERE Participantestorneos_id=w_participantestorneos_id;

IF ((participantetorneos.dni <> w_dni)OR(participantetorneos.Torneos_ID<>w_Torneos_ID)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_ParticipantesTorneos_ID smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_participantestorneos INTEGER;

BEGIN

DELETE FROM participantesTorneos WHERE ParticipantesTorneos_ID=w_ParticipantesTorneos_ID;

SELECT COUNT(*) INTO n_participantestorneos FROM participantesTorneos WHERE ParticipantesTorneos_ID=w_ParticipantesTorneos_ID;
IF (n_participantestorneos <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_PARTICIPANTESTORNEOS;
/





--PRUEBAS BONOS
CREATE OR REPLACE PACKAGE PRUEBAS_BONOS AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_precioBono number, w_nombreBono varchar2, w_disponible varchar2, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_Bonos_ID smallint, w_precioBono number, w_nombreBono varchar2, w_disponible varchar2, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_bonos_id smallint, salidaEsperada BOOLEAN);

END PRUEBAS_BONOS;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_BONOS AS

PROCEDURE INICIALIZAR AS
BEGIN
VACIAR_BD;

END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, w_precioBono number, w_nombreBono varchar2, w_disponible varchar2, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
bono bonos%ROWTYPE;
w_bonos_id smallint;
BEGIN
    NUEVO_BONO(w_nombreBono, w_precioBono, w_disponible);
    
    SELECT SEQ_BONOS.CURRVAL INTO w_bonos_id FROM dual;
    
SELECT * INTO bono FROM bonos WHERE Bonos_id = w_bonos_id;
IF ((bono.nombreBono <> w_nombreBono)OR(bono.precioBono<>w_precioBono)OR(bono.disponible<>w_disponible)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_Bonos_ID smallint, w_precioBono number, w_nombreBono varchar2, w_disponible varchar2, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
bono bonos%ROWTYPE;
BEGIN

UPDATE bonos SET precioBono=w_precioBono, nombreBono=w_nombreBono, disponible=w_disponible WHERE Bonos_id=w_bonos_id;

SELECT * INTO bono FROM bonos WHERE Bonos_id=w_bonos_id;

IF ((bono.nombreBono <> w_nombreBono)OR(bono.precioBono<>w_precioBono)OR(bono.disponible<>w_disponible)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_Bonos_ID smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_bonos INTEGER;

BEGIN

DELETE FROM bonos WHERE Bonos_id=w_bonos_id;

SELECT COUNT(*) INTO n_bonos FROM bonos WHERE Bonos_id=w_bonos_id;
IF (n_bonos <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_BONOS;
/





--PRUEBAS LINEAPASES
CREATE OR REPLACE PACKAGE PRUEBAS_LINEAPASES AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, W_Bonos_ID smallint, W_Pases_ID smallint, w_cantidadLP number, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_LINEAPASES_ID smallint, W_Bonos_ID smallint, W_Pases_ID smallint, w_cantidadLP number, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_LINEAPASES_ID smallint, salidaEsperada BOOLEAN);

END PRUEBAS_LINEAPASES;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_LINEAPASES AS

PROCEDURE INICIALIZAR AS
BEGIN
VACIAR_BD;

    /*DELETE FROM lineapases;
    DELETE FROM BONOS;
    DELETE FROM PASES;*/
    
    NUEVO_BONO ('Bono Estándar1', 5, 'TRUE');
        NUEVO_BONO ('Bono Estándar2', 5, 'FALSE');
                NUEVO_BONO ('Bono Estándar3', 5, 'FALSE');


    NUEVO_PASE ('PC');
        NUEVO_PASE ('PS4');

    
END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, W_Bonos_ID smallint, W_Pases_ID smallint, w_cantidadLP number, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
lineapase lineapases%ROWTYPE;
w_lineapases_id smallint;
BEGIN

    INTRODUCIR_PASE_EN_BONO(W_Pases_ID, W_Bonos_ID, w_cantidadLP);
    
    SELECT SEQ_LINEAPASES.CURRVAL INTO w_lineapases_id FROM dual;
    
SELECT * INTO lineapase FROM lineapases WHERE LineaPases_ID = w_lineapases_id;
IF ((lineapase.Pases_ID <> W_Pases_ID)OR(lineapase.Bonos_ID<>W_Bonos_ID)OR(lineapase.cantidadLP<>w_cantidadLP)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_LINEAPASES_ID smallint, W_Bonos_ID smallint, W_Pases_ID smallint, w_cantidadLP number, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
lineapase lineapases%ROWTYPE;
BEGIN

UPDATE lineapases SET Bonos_ID=W_Bonos_ID, Pases_ID=W_Pases_ID, cantidadLP=w_cantidadLP WHERE LineaPases_ID=w_lineapases_id;

SELECT * INTO lineapase FROM lineapases WHERE LineaPases_ID=w_lineapases_id;

IF ((lineapase.Pases_ID <> W_Pases_ID)OR(lineapase.Bonos_ID<>W_Bonos_ID)OR(lineapase.cantidadLP<>w_cantidadLP)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_LINEAPASES_ID smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_lineapases INTEGER;

BEGIN

DELETE FROM lineapases WHERE LineaPases_ID=w_lineapases_id;

SELECT COUNT(*) INTO n_lineapases FROM lineapases WHERE LineaPases_ID=w_lineapases_id;
IF (n_lineapases <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_LINEAPASES;
/




--PRUEBAS LINEACONSUMIBLES
CREATE OR REPLACE PACKAGE PRUEBAS_LINEACONSUMIBLES AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, W_Bonos_ID smallint, w_Consumibles_ID smallint, w_cantidadLC number, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_LineaConsumibles_ID smallint, w_Bonos_ID smallint, w_Consumibles_ID smallint, w_cantidadLC number, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_LineaConsumibles_ID smallint, salidaEsperada BOOLEAN);

END PRUEBAS_LINEACONSUMIBLES;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_LINEACONSUMIBLES AS

PROCEDURE INICIALIZAR AS
BEGIN
VACIAR_BD;
/*
    DELETE FROM lineaconsumibles;
    DELETE FROM BONOS;
    DELETE FROM CONSUMIBLES;*/
    
    NUEVO_BONO ('Bono Estándar1', 5, 'TRUE');
        NUEVO_BONO ('Bono Estándar2', 5, 'FALSE');
                NUEVO_BONO ('Bono Estándar3', 5, 'FALSE');


    NUEVO_CONSUMIBLE ('Cocacola', 'Bebida generica');
        NUEVO_CONSUMIBLE ('Fanta', 'Bebida generica');

    
END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, W_Bonos_ID smallint, w_Consumibles_ID smallint, w_cantidadLC number, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
lineaconsumible lineaconsumibles%ROWTYPE;
w_lineaconsumibles_id smallint;
BEGIN

    INTRODUCIR_CONSUMIBLE_EN_BONO(w_Consumibles_ID, W_Bonos_ID, w_cantidadLC);
    
    SELECT SEQ_LINEACONSUMIBLES.CURRVAL INTO w_lineaconsumibles_id FROM dual;
    
SELECT * INTO lineaconsumible FROM lineaconsumibles WHERE LineaCONSUMIBLES_ID = w_lineaconsumibles_id;
IF ((lineaconsumible.Consumibles_ID <> w_Consumibles_ID)OR(lineaconsumible.Bonos_ID<>W_Bonos_ID)OR(lineaconsumible.cantidadLC<>w_cantidadLC)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_LineaConsumibles_ID smallint, w_Bonos_ID smallint, w_Consumibles_ID smallint, w_cantidadLC number, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
lineaconsumible lineaconsumibles%ROWTYPE;
BEGIN

UPDATE lineaconsumibles SET Bonos_ID=W_Bonos_ID, Consumibles_ID=w_Consumibles_ID, cantidadLC=w_cantidadLC WHERE LineaCONSUMIBLES_ID=w_lineaconsumibles_id;

SELECT * INTO lineaconsumible FROM lineaconsumibles WHERE LineaCONSUMIBLES_ID=w_lineaconsumibles_id;

IF ((lineaconsumible.Consumibles_ID <> w_Consumibles_ID)OR(lineaconsumible.Bonos_ID<>W_Bonos_ID)OR(lineaconsumible.cantidadLC<>w_cantidadLC)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_LineaConsumibles_ID smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_lineaCONSUMIBLES INTEGER;

BEGIN

DELETE FROM lineaconsumibles WHERE LineaCONSUMIBLES_ID=w_lineaconsumibles_id;

SELECT COUNT(*) INTO n_lineaCONSUMIBLES FROM lineaconsumibles WHERE LineaCONSUMIBLES_ID=w_lineaconsumibles_id;
IF (n_lineaCONSUMIBLES <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_LINEACONSUMIBLES;
/




--PRUEBAS VENTAS
CREATE OR REPLACE PACKAGE PRUEBAS_VENTAS AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_dni varchar2, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, w_Ventas_ID smallint, w_dni varchar2, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, w_Ventas_ID smallint, salidaEsperada BOOLEAN);

END PRUEBAS_VENTAS;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_VENTAS AS

PROCEDURE INICIALIZAR AS
BEGIN
VACIAR_BD;
/*
    DELETE FROM ventas;
    DELETE FROM usuarios;*/
    
    NUEVO_USUARIO ('12345678A', 'Nombre De Usuario1', 'Contraseña1', 'correo1@domain.com', TO_DATE('1987/05/03', 'yyyy/mm/dd'), 'Paypal');
        NUEVO_USUARIO ('12345678B', 'Nombre De Usuario2', 'Contraseña2', 'correo2@domain.com', TO_DATE('1987/05/03', 'yyyy/mm/dd'), 'Paypal');

    COMMIT WORK;
    
END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, w_dni varchar2, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
venta ventas%ROWTYPE;
w_ventas_id smallint;
BEGIN

    NUEVA_VENTA(w_dni);
    
    SELECT SEQ_VENTAS.CURRVAL INTO w_ventas_id FROM dual;
    
SELECT * INTO venta FROM ventas WHERE ventas_id = w_ventas_id;
IF (venta.dni <> w_dni) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, w_Ventas_ID smallint, w_dni varchar2, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
venta ventas%ROWTYPE;
BEGIN

UPDATE ventas SET dni=w_dni WHERE ventas_id=w_ventas_id;

SELECT * INTO venta FROM ventas WHERE ventas_id=w_ventas_id;

IF (venta.dni <> w_dni) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, w_ventas_id smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_ventas INTEGER;

BEGIN

DELETE FROM ventas WHERE ventas_id=w_ventas_id;

SELECT COUNT(*) INTO n_ventas FROM ventas WHERE ventas_id=w_ventas_id;
IF (n_ventas <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_VENTAS;
/





--PRUEBAS LINEAVENTAS
CREATE OR REPLACE PACKAGE PRUEBAS_LINEAVENTAS AS

PROCEDURE INICIALIZAR;
PROCEDURE INSERTAR
            (nombre_prueba VARCHAR2, w_Bonos_ID smallint, w_Ventas_ID smallint, w_precioLV number, w_descuento number, salidaEsperada BOOLEAN);
PROCEDURE ACTUALIZAR
            (nombre_prueba VARCHAR2, W_LineaVentas_ID smallint, w_Bonos_ID smallint, w_Ventas_ID smallint, w_precioLV number, w_descuento number, salidaEsperada BOOLEAN);
PROCEDURE ELIMINAR
            (nombre_prueba VARCHAR2, W_LineaVentas_ID smallint, salidaEsperada BOOLEAN);

END PRUEBAS_LINEAVENTAS;
/

CREATE OR REPLACE PACKAGE BODY PRUEBAS_LINEAVENTAS AS

PROCEDURE INICIALIZAR AS
BEGIN
VACIAR_BD;
    
    NUEVO_BONO ('Bono Estándar1', 5, 'FALSE');
        NUEVO_BONO ('Bono Monster', 7, 'TRUE');
                NUEVO_BONO ('Bono Monster 2', 7, 'TRUE');
    NUEVO_USUARIO ('12345678A', 'Nombre De Usuario1', 'Contraseña1', 'correo1@domain.com', TO_DATE('1987/05/03', 'yyyy/mm/dd'), 'Paypal');
        NUEVO_USUARIO ('12345678B', 'Nombre De Usuario2', 'Contraseña2', 'correo2@domain.com', TO_DATE('1987/05/03', 'yyyy/mm/dd'), 'Paypal');
    NUEVA_VENTA ('12345678B');
        NUEVA_VENTA ('12345678A');
    NUEVO_CONSUMIBLE ('Cocacola', 'Bebida generica');
        NUEVO_CONSUMIBLE ('Fanta', 'Bebida generica');
    NUEVO_PASE ('PC');
        NUEVO_PASE ('PS4');
    INTRODUCIR_CONSUMIBLE_EN_BONO(1,1,5);
        INTRODUCIR_CONSUMIBLE_EN_BONO(2,2,5);
    INTRODUCIR_PASE_EN_BONO(1,1,5);
        INTRODUCIR_PASE_EN_BONO(2,2,5);
    
END INICIALIZAR;


PROCEDURE INSERTAR (nombre_prueba VARCHAR2, w_Bonos_ID smallint, w_Ventas_ID smallint, w_precioLV number, w_descuento number, salidaEsperada BOOLEAN) AS
salida BOOLEAN := TRUE;
lineaventa lineaventas%ROWTYPE;
w_LINEAVENTAS_ID smallint;
BEGIN

    INTRODUCIR_LINEA_VENTA(w_Ventas_ID, W_Bonos_ID, w_precioLV, w_descuento);
    
    SELECT SEQ_LINEAVENTAS.CURRVAL INTO w_LINEAVENTAS_ID FROM dual;
    
SELECT * INTO lineaventa FROM lineaventas WHERE LineaVentas_ID = w_LINEAVENTAS_ID;
IF ((lineaventa.VENTAS_ID <> w_Ventas_ID)OR(lineaventa.Bonos_ID<>W_Bonos_ID)OR(lineaventa.precioLV<>w_precioLV)OR(lineaventa.descuento<>w_descuento)) THEN
salida := false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
    ROLLBACK;
END INSERTAR;



PROCEDURE ACTUALIZAR (nombre_prueba VARCHAR2, W_LineaVentas_ID smallint, w_Bonos_ID smallint, w_Ventas_ID smallint, w_precioLV number, w_descuento number, salidaEsperada BOOLEAN) AS
salida BOOLEAN:= true;
lineaventa lineaventas%ROWTYPE;
BEGIN

UPDATE lineaventas SET Bonos_ID=W_Bonos_ID, VENTAS_ID=w_Ventas_ID, precioLV=w_precioLV, descuento=w_descuento WHERE LineaVentas_ID=w_LINEAVENTAS_ID;

SELECT * INTO lineaventa FROM lineaventas WHERE LineaVentas_ID=w_LINEAVENTAS_ID;

IF ((lineaventa.VENTAS_ID <> w_Ventas_ID)OR(lineaventa.Bonos_ID<>W_Bonos_ID)OR(lineaventa.precioLV<>w_precioLV)OR(lineaventa.descuento<>w_descuento)) THEN
  salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba||':'||ASSERT_EQUALS (false, salidaEsperada));
    ROLLBACK;
END ACTUALIZAR;

PROCEDURE ELIMINAR (nombre_prueba VARCHAR2, W_LineaVentas_ID smallint, salidaEsperada BOOLEAN) AS
salida BOOLEAN := true;
n_lineapases INTEGER;

BEGIN

DELETE FROM lineaventas WHERE LineaVentas_ID=w_LINEAVENTAS_ID;

SELECT COUNT(*) INTO n_lineapases FROM lineaventas WHERE LineaVentas_ID=w_LINEAVENTAS_ID;
IF (n_lineapases <>0) THEN
salida:= false;
END IF;
COMMIT WORK;

DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(salida, salidaEsperada));

EXCEPTION
WHEN OTHERS THEN
  DBMS_OUTPUT.put_line (nombre_prueba||':'||ASSERT_EQUALS(false, salidaEsperada));
  ROLLBACK;
END ELIMINAR;

END PRUEBAS_LINEAVENTAS;
/