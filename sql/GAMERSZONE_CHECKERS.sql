CREATE OR REPLACE TRIGGER ALMACEN_PASE_VACIO
AFTER UPDATE ON ALMACENESPASES
FOR EACH ROW
BEGIN
    IF :NEW.cantidadPase=0 THEN
    DELETE FROM almacenespases WHERE almacenespases_id=:NEW.almacenesPases_ID;
    END IF;
END;
/

CREATE OR REPLACE TRIGGER ALMACEN_CONSUMIBLE_VACIO
AFTER UPDATE ON ALMACENESCONSUMIBLES
FOR EACH ROW
BEGIN
    IF :NEW.cantidadConsumible=0 THEN
    DELETE FROM almacenesConsumibles WHERE almacenesConsumibles_id=:NEW.almacenesConsumibles_ID;
    END IF;
END;
/

CREATE OR REPLACE TRIGGER COMPROBAR_BONO_DISPONIBLE_LV
BEFORE INSERT ON LINEAVENTAS
FOR EACH ROW
DECLARE 
    checker varchar2(50);
BEGIN
    SELECT disponible INTO checker FROM bonos WHERE bonos_ID=:NEW.bonos_ID;
    IF checker = 'FALSE' THEN
        raise_application_error(-20601,:NEW.bonos_ID || ' El bono que se intenta comprar no esta disponible actualmente');
    END IF;
END;
/

CREATE OR REPLACE TRIGGER COMPROBAR_BONO_INACTIVO_LC
BEFORE INSERT ON LINEACONSUMIBLES
FOR EACH ROW
DECLARE 
    checker varchar2(50);
BEGIN
    SELECT disponible INTO checker FROM bonos WHERE bonos_ID=:NEW.bonos_ID;
    IF checker = 'TRUE' THEN
        raise_application_error(-20602,:NEW.bonos_ID || ' No se puede añadir consumibles a un bono que esta activo');
    END IF;
END;
/

CREATE OR REPLACE TRIGGER COMPROBAR_BONO_INACTIVO_LP
BEFORE INSERT ON LINEAPASES
FOR EACH ROW
DECLARE 
    checker varchar2(50);
BEGIN
    SELECT disponible INTO checker FROM bonos WHERE bonos_ID=:NEW.bonos_ID;
    IF checker = 'TRUE' THEN
        raise_application_error(-20603,:NEW.bonos_ID || ' No se puede añadir pases a un bono que esta activo');
    END IF;
END;
/ 

CREATE OR REPLACE TRIGGER COMPROBAR_USUARIO_ACTIVO_VENTA
BEFORE INSERT ON VENTAS
FOR EACH ROW
DECLARE 
    checker varchar2(50);
BEGIN
    SELECT activo INTO checker FROM usuarios WHERE dni=:NEW.dni;
    IF checker = 'FALSE' THEN
        raise_application_error(-20604,:NEW.dni || ' El usuario no es activo, por favor activelo antes de intentar realizar una compra');
    END IF;
END;
/

CREATE OR REPLACE TRIGGER COMPROBAR_USUARIO_ACT_TORNEO
BEFORE INSERT ON PARTICIPANTESTORNEOS
FOR EACH ROW
DECLARE 
    checker varchar2(50);
BEGIN
    SELECT activo INTO checker FROM usuarios WHERE dni=:NEW.dni;
    IF checker = 'FALSE' THEN
        raise_application_error(-20605,:NEW.dni || ' El usuario no es activo, por favor activelo antes de intentar realizar una compra');
    END IF;
END;
/

CREATE OR REPLACE TRIGGER COMPROBAR_NUM_PARTICIPANTES
BEFORE INSERT ON PARTICIPANTESTORNEOS
FOR EACH ROW
DECLARE 
    numParticipantes number(4,0);
    maxParticipantesTorneo number(4,0);
BEGIN
    SELECT COUNT (*) INTO numParticipantes FROM participantesTorneos WHERE torneos_ID=:NEW.torneos_ID;
    SELECT maxParticipantes INTO maxParticipantesTorneo FROM torneos WHERE torneos_ID=:NEW.torneos_ID;
    IF numParticipantes = maxParticipantesTorneo THEN
        raise_application_error(-20606,:NEW.torneos_ID || ' El torneo esta completo');
    END IF;
END;
/

CREATE OR REPLACE TRIGGER COMPROBAR_EMAIL_CORRECTO
BEFORE INSERT OR UPDATE ON USUARIOS
FOR EACH ROW
DECLARE
	p_correo VARCHAR2(50) := :NEW.correo;
BEGIN
    IF p_correo not like '%@%.com'
    THEN
        raise_application_error(-20607,:NEW.correo || ' El correo no es valido');
    END IF;
END;
/

CREATE OR REPLACE TRIGGER COMPROBAR_MAYOR_EDAD
BEFORE INSERT ON LINEAVENTAS
FOR EACH ROW
DECLARE
    p_dni VARCHAR(9);
    p_bonos_ID smallint;
BEGIN
    p_bonos_ID := :NEW.bonos_ID;
    SELECT dni INTO p_dni FROM ventas WHERE ventas_id=:NEW.ventas_ID;
    IF ES_BEBIDA_ALCOHOLICA(p_bonos_ID) and OBT_EDAD(p_dni)<18 THEN
        raise_application_error(-20608,:NEW.bonos_ID || ' El bono que se intenta comprar no es apto para personas menores de edad');
    END IF;
END;
/
