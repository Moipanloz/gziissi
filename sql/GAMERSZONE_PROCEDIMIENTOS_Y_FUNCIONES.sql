SET SERVEROUTPUT ON;

CREATE OR REPLACE PROCEDURE NUEVO_PASE(
p_tipoMedio IN pases.tipoMedio%TYPE
)
IS
BEGIN
    INSERT INTO pases(tipoMedio) VALUES (p_tipoMedio);
END NUEVO_PASE;
/

CREATE OR REPLACE PROCEDURE NUEVO_CONSUMIBLE (
p_nombreConsumible IN consumibles.nombreConsumible%TYPE,
p_tipoConsumible IN consumibles.tipoConsumible%TYPE
)
IS
BEGIN
    INSERT INTO consumibles(nombreConsumible, tipoConsumible) VALUES (p_nombreConsumible, p_tipoConsumible);
END NUEVO_CONSUMIBLE;
/

CREATE OR REPLACE PROCEDURE NUEVO_TORNEO (
p_precioTorneo IN torneos.precioTorneo%TYPE,
p_videojuego IN torneos.videojuego%TYPE,
p_maxParticipantes IN torneos.maxParticipantes%TYPE,
p_nombreTorneo IN torneos.nombreTorneo%TYPE,
p_fechaTorneo IN torneos.fechaTorneo%TYPE
)
IS
BEGIN
    INSERT INTO torneos(precioTorneo, videojuego, maxParticipantes, nombreTorneo, fechaTorneo) 
    VALUES (p_precioTorneo, p_videojuego, p_maxParticipantes, p_nombreTorneo, p_fechaTorneo);
END NUEVO_TORNEO;
/

CREATE OR REPLACE PROCEDURE INSCRIPCION(
p_dni IN usuarios.dni%TYPE,
p_torneos_ID IN torneos.torneos_ID%TYPE
)
IS
BEGIN
    INSERT INTO participantestorneos(torneos_id,dni)
    VALUES (p_torneos_id,p_dni);
END INSCRIPCION;
/

CREATE OR REPLACE PROCEDURE NUEVO_BONO (
p_nombreBono IN bonos.nombreBono%TYPE,
p_precioBono IN bonos.precioBono%TYPE,
p_disponible IN bonos.disponible%TYPE
)
IS
BEGIN
    INSERT INTO bonos(nombreBono, precioBono,disponible) VALUES (p_nombreBono, p_precioBono,p_disponible);
END NUEVO_BONO;

/
CREATE OR REPLACE PROCEDURE NUEVA_VENTA (
p_dni IN usuarios.dni%TYPE
)
IS
BEGIN
    INSERT INTO ventas(dni) VALUES (p_dni);
END NUEVA_VENTA;
/
CREATE OR REPLACE PROCEDURE INTRODUCIR_CONSUMIBLE_EN_BONO (
p_consumibles_ID IN consumibles.consumibles_ID%TYPE,
p_bonos_ID IN bonos.bonos_ID%TYPE
)

IS

    numero smallint;

BEGIN

    SELECT COUNT (*) INTO numero FROM LINEACONSUMIBLES WHERE CONSUMIBLES_ID = p_consumibles_ID AND BONOS_ID = p_bonos_ID;

    IF (numero = 0) THEN

        INSERT INTO LINEACONSUMIBLES (CONSUMIBLES_ID, BONOS_ID, CANTIDADLC) VALUES (p_consumibles_ID, p_bonos_ID, 1) ;

    ELSE

        UPDATE LINEACONSUMIBLES SET CANTIDADLC = CANTIDADLC + 1 WHERE CONSUMIBLES_ID = p_consumibles_ID AND BONOS_ID = p_bonos_ID;

END IF;

END INTRODUCIR_CONSUMIBLE_EN_BONO;
/

CREATE OR REPLACE PROCEDURE BORRAR_CONSUMIBLE_DE_BONO (
    p_lineaconsumibles_id IN LINEACONSUMIBLES.LINEACONSUMIBLES_ID%TYPE
)

    IS

    numero smallint;

BEGIN

    SELECT CANTIDADLC INTO numero FROM LINEACONSUMIBLES WHERE LINEACONSUMIBLES_ID = p_lineaconsumibles_id;

    IF (numero = 1) THEN

        DELETE FROM LINEACONSUMIBLES WHERE LINEACONSUMIBLES_ID = p_lineaconsumibles_id;

    ELSE

        UPDATE LINEACONSUMIBLES SET CANTIDADLC = CANTIDADLC - 1 WHERE LINEACONSUMIBLES_ID = p_lineaconsumibles_id;

    END IF;

END BORRAR_CONSUMIBLE_DE_BONO;
/

CREATE OR REPLACE PROCEDURE INTRODUCIR_PASE_EN_BONO (
    p_pases_ID IN pases.PASES_ID%TYPE,
    p_bonos_ID IN bonos.bonos_ID%TYPE
)

    IS

    numero smallint;

BEGIN

    SELECT COUNT (*) INTO numero FROM LINEAPASES WHERE PASES_ID = p_pases_ID AND BONOS_ID = p_bonos_ID;

    IF (numero = 0) THEN

        INSERT INTO LINEAPASES (PASES_ID, BONOS_ID, CANTIDADLP) VALUES (p_pases_ID, p_bonos_ID, 1) ;

    ELSE

        UPDATE LINEAPASES SET CANTIDADLP = CANTIDADLP + 1 WHERE PASES_ID = p_pases_ID AND BONOS_ID = p_bonos_ID;

    END IF;

END INTRODUCIR_PASE_EN_BONO;
/

CREATE OR REPLACE PROCEDURE BORRAR_PASE_DE_BONO (
    p_lineapases_id IN LINEAPASES.LINEAPASES_ID%TYPE
)

    IS

    numero smallint;

BEGIN

    SELECT CANTIDADLP INTO numero FROM LINEAPASES WHERE LINEAPASES_ID = p_lineapases_id;

    IF (numero = 1) THEN

        DELETE FROM LINEAPASES WHERE LINEAPASES_ID = p_lineapases_id;

    ELSE

        UPDATE LINEAPASES SET CANTIDADLP = CANTIDADLP - 1 WHERE LINEAPASES_ID = p_lineapases_id;

    END IF;

END BORRAR_PASE_DE_BONO;
/


CREATE OR REPLACE PROCEDURE ANADIR_CONSUMIBLE_A_USUARIO (
    p_consumibles_id IN CONSUMIBLES.CONSUMIBLES_ID%TYPE,
    p_dni in USUARIOS.DNI%TYPE
)

    IS

    numero smallint;

BEGIN

    SELECT COUNT (*) INTO numero FROM ALMACENESCONSUMIBLES WHERE DNI = p_dni AND CONSUMIBLES_ID = p_consumibles_id;

    IF (numero = 0) THEN

        INSERT INTO ALMACENESCONSUMIBLES (DNI, CONSUMIBLES_ID, CANTIDADCONSUMIBLE) VALUES (p_dni, p_consumibles_id, 1);

    ELSE

        UPDATE ALMACENESCONSUMIBLES SET CANTIDADCONSUMIBLE = CANTIDADCONSUMIBLE + 1 WHERE DNI = p_dni AND CONSUMIBLES_ID = p_consumibles_id;

    END IF;

END ANADIR_CONSUMIBLE_A_USUARIO;
/

CREATE OR REPLACE PROCEDURE ANADIR_PASE_A_USUARIO (
    p_pasess_id IN PASES.PASES_ID%TYPE,
    p_dni in USUARIOS.DNI%TYPE
)

    IS

    numero smallint;

BEGIN

    SELECT COUNT (*) INTO numero FROM ALMACENESPASES WHERE DNI = p_dni AND PASES_ID = p_pasess_id;

    IF (numero = 0) THEN

        INSERT INTO ALMACENESPASES (DNI, PASES_ID, CANTIDADPASE) VALUES (p_dni, p_pasess_id, 1);

    ELSE

        UPDATE ALMACENESPASES SET CANTIDADPASE = CANTIDADPASE + 1 WHERE DNI = p_dni AND PASES_ID = p_pasess_id;

    END IF;

END ANADIR_PASE_A_USUARIO;
/


CREATE OR REPLACE PROCEDURE BORRAR_CONSUMIBLE_DE_USUARIO (
    p_almacenconsumibles_id IN ALMACENESCONSUMIBLES.ALMACENESCONSUMIBLES_ID%TYPE
)

    IS

    numero smallint;

BEGIN

    SELECT CANTIDADCONSUMIBLE INTO numero FROM ALMACENESCONSUMIBLES WHERE ALMACENESCONSUMIBLES_ID = p_almacenconsumibles_id;

    IF (numero = 1) THEN

        DELETE FROM ALMACENESCONSUMIBLES WHERE ALMACENESCONSUMIBLES_ID = p_almacenconsumibles_id;

    ELSE

        UPDATE ALMACENESCONSUMIBLES SET CANTIDADCONSUMIBLE = CANTIDADCONSUMIBLE - 1 WHERE ALMACENESCONSUMIBLES_ID = p_almacenconsumibles_id;

    END IF;

END BORRAR_CONSUMIBLE_DE_USUARIO;
/

CREATE OR REPLACE PROCEDURE BORRAR_PASE_DE_USUARIO (
    p_almacenconsumibles_id IN ALMACENESCONSUMIBLES.ALMACENESCONSUMIBLES_ID%TYPE
)

    IS

    numero smallint;

BEGIN

    SELECT CANTIDADPASE INTO numero FROM ALMACENESPASES WHERE ALMACENESPASES_ID = p_almacenconsumibles_id;

    IF (numero = 1) THEN

        DELETE FROM ALMACENESPASES WHERE ALMACENESPASES_ID = p_almacenconsumibles_id;

    ELSE

        UPDATE ALMACENESPASES SET CANTIDADPASE = CANTIDADPASE - 1 WHERE ALMACENESPASES_ID = p_almacenconsumibles_id;

    END IF;

END BORRAR_PASE_DE_USUARIO;
/



CREATE OR REPLACE PROCEDURE INTRODUCIR_LINEA_VENTA(
p_bonos_ID IN bonos.bonos_ID%TYPE,
p_ventas_ID IN ventas.ventas_ID%TYPE,
p_cantidadLV IN lineaVentas.cantidadLV%TYPE,
p_descuento IN lineaVentas.descuento%TYPE
)
IS p_precioLV lineaventas.preciolv%TYPE;
BEGIN
    SELECT precioBono*(1-(p_descuento/100)) INTO p_precioLV FROM bonos WHERE bonos.bonos_id=p_bonos_ID; 
    INSERT INTO lineaVentas(bonos_ID, ventas_ID, cantidadLV, precioLV, descuento) 
    VALUES (p_bonos_ID, p_ventas_ID, p_cantidadLV, p_precioLV, p_descuento);
END INTRODUCIR_LINEA_VENTA;
/

CREATE OR REPLACE PROCEDURE NUEVO_USUARIO (
p_dni IN usuarios.dni%TYPE,
p_nombre IN usuarios.nombre%TYPE,
p_pass IN usuarios.pass%TYPE,
p_correo IN usuarios.correo%TYPE,
p_fechaNacimiento IN usuarios.fechaNacimiento%TYPE,
p_tipoPago IN usuarios.tipoPago%TYPE)
IS
BEGIN
    INSERT INTO usuarios(dni,nombre,pass,correo,fechaNacimiento,fechaInscripcion,tipoPago,activo) VALUES (p_dni,p_nombre,p_pass,p_correo,p_fechaNacimiento,sysdate,p_tipoPago,'TRUE');
END NUEVO_USUARIO;
/

CREATE OR REPLACE PROCEDURE NUEVO_JUEGO_MESA(
p_juegoMesa IN participacionesSorteos.juegoMesa%TYPE
)
IS
BEGIN
    INSERT INTO participacionesSorteos(juegoMesa,participacion) VALUES (p_juegoMesa,0);
END NUEVO_JUEGO_MESA;
/

CREATE OR REPLACE PROCEDURE NUEVA_PARTICIPACION_SORTEO(
p_juegoMesa IN participacionesSorteos.juegoMesa%TYPE,
p_participacion IN participacionesSorteos.participacion%TYPE
)
IS
BEGIN
    INSERT INTO participacionesSorteos(juegoMesa,participacion) VALUES (p_juegoMesa,p_participacion);
END NUEVA_PARTICIPACION_SORTEO;
/

CREATE OR REPLACE PROCEDURE DONACION(
p_dni IN usuarios.dni%TYPE,
p_juegoMesa IN participacionesSorteos.juegoMesa%TYPE,
p_aportacion IN donaciones.aportacion%TYPE
)
IS some_local_variable smallint;
sorteo_ID participacionesSorteos.participacionesSorteos_ID%TYPE;
BEGIN
    SELECT COUNT (1) INTO some_local_variable FROM participacionessorteos  WHERE juegoMesa=p_juegoMesa;
    IF some_local_variable=1 THEN
    SELECT participacionesSorteos_ID INTO sorteo_ID FROM participacionesSorteos WHERE juegoMesa=p_juegoMesa;
    UPDATE participacionesSorteos SET participacion=participacion+p_aportacion/50 WHERE juegoMesa=p_juegoMesa;
    INSERT INTO donaciones(dni, participacionessorteos_id, fechaDonacion, aportacion) VALUES (p_dni, sorteo_ID, sysdate, p_aportacion);
      ELSE
      INSERT INTO participacionesSorteos(juegoMesa,participacion) VALUES (p_juegoMesa,p_aportacion/50);
      SELECT participacionesSorteos_ID INTO sorteo_ID FROM participacionesSorteos WHERE juegoMesa=p_juegoMesa;
      INSERT INTO donaciones(dni, participacionessorteos_id, fechaDonacion, aportacion) VALUES (p_dni, sorteo_ID, sysdate, p_aportacion);
      END IF;
END DONACION;
/

CREATE OR REPLACE PROCEDURE DONACION_CONOCIENDO_SORTEO_ID(
p_dni IN usuarios.dni%TYPE,
p_participacionesSorteos_ID IN participacionesSorteos.participacionesSorteos_ID%TYPE,
p_aportacion IN donaciones.aportacion%TYPE
)
IS
BEGIN
    INSERT INTO donaciones(dni, participacionessorteos_id, fechaDonacion, aportacion) VALUES (p_dni, p_participacionesSorteos_ID, sysdate, p_aportacion);
END DONACION_CONOCIENDO_SORTEO_ID;
/

CREATE OR REPLACE PROCEDURE ANADIR_ALMACEN_PASES(
p_dni IN usuarios.dni%TYPE,
p_pases_ID IN almacenesPases.pases_ID%TYPE,
p_cantidadPase IN almacenesPases.cantidadPase%TYPE
)
IS
BEGIN
   INSERT INTO almacenesPases(dni,pases_ID,cantidadPase) VALUES (p_dni,p_pases_ID,p_cantidadPase);
END ANADIR_ALMACEN_PASES;
/

CREATE OR REPLACE PROCEDURE ANADIR_ALMACEN_CONSUMIBLES(
p_dni IN usuarios.dni%TYPE,
p_consumibles_ID IN almacenesConsumibles.consumibles_ID%TYPE,
p_cantidadConsumible IN almacenesConsumibles.cantidadConsumible%TYPE
)
IS
BEGIN
    INSERT INTO almacenesConsumibles(dni,consumibles_ID,cantidadConsumible) VALUES (p_dni,p_consumibles_id,p_cantidadConsumible);
END ANADIR_ALMACEN_CONSUMIBLES;
/

CREATE OR REPLACE PROCEDURE VACIAR_BD IS
BEGIN

  
  DELETE FROM lineaVentas;
  DELETE FROM ventas;
  DELETE FROM lineaConsumibles;
  DELETE FROM lineaPases;
  DELETE FROM bonos;
  DELETE FROM participantestorneos;
  DELETE FROM torneos;
  DELETE FROM donaciones;
  DELETE FROM participacionesSorteos;
  DELETE FROM almacenesConsumibles;
  DELETE FROM almacenesPases;
  DELETE FROM consumibles;
  DELETE FROM pases;
  DELETE FROM usuarios;
  
END VACIAR_BD;  
/


CREATE OR REPLACE PROCEDURE CAMBIAR_EMAIL(
p_dni IN usuarios.dni%TYPE,
p_correo IN usuarios.correo%TYPE,
p_pass IN usuarios.pass%TYPE
)
IS Realpass usuarios.pass%TYPE;
BEGIN
    SELECT pass into Realpass FROM usuarios WHERE usuarios.dni=p_dni;
    IF p_pass != Realpass THEN 
    DBMS_OUTPUT.put_line ('La contraseña no es correcta');
    ELSE 
    UPDATE usuarios SET correo=p_correo WHERE usuarios.dni=p_dni;
    END IF;
END CAMBIAR_EMAIL;
/

CREATE OR REPLACE PROCEDURE DARSE_BAJA(
p_dni IN usuarios.dni%TYPE
)
IS 
BEGIN
    UPDATE usuarios SET activo='FALSE' WHERE usuarios.dni=p_dni;
END DARSE_BAJA;
/

CREATE OR REPLACE PROCEDURE DARSE_ALTA(
p_dni IN usuarios.dni%TYPE
)
IS 
BEGIN
    UPDATE usuarios SET activo='TRUE' WHERE usuarios.dni=p_dni;
END DARSE_ALTA;
/

CREATE OR REPLACE PROCEDURE BONO_NO_DISPONIBLE(
p_bonos_ID IN bonos.bonos_ID%TYPE
)
IS 
BEGIN
    UPDATE bonos SET disponible='FALSE' WHERE bonos.bonos_ID=p_bonos_ID;
END BONO_NO_DISPONIBLE;
/

CREATE OR REPLACE PROCEDURE BONO_DISPONIBLE(
p_bonos_ID IN bonos.bonos_ID%TYPE
)
IS 
BEGIN
    UPDATE bonos SET disponible='TRUE' WHERE bonos.bonos_ID=p_bonos_ID;
END BONO_DISPONIBLE;
/

CREATE OR REPLACE PROCEDURE USA_PASE(
p_dni IN usuarios.dni%TYPE,
p_tipoMedio IN pases.tipoMedio%TYPE
)
IS p_pases_ID pases.pases_ID%TYPE;
BEGIN
    SELECT pases_ID INTO p_pases_ID FROM pases WHERE pases.tipoMedio=p_tipoMedio; 
    UPDATE almacenespases SET cantidadpase=cantidadpase-1 WHERE almacenespases.dni=p_dni and almacenespases.pases_id=p_pases_ID;
END USA_PASE;
/

CREATE OR REPLACE PROCEDURE USA_CONSUMIBLE(
p_dni IN usuarios.dni%TYPE,
p_nombreConsumible IN consumibles.nombreConsumible%TYPE
)
IS p_consumibles_ID consumibles.consumibles_ID%TYPE;
BEGIN
    SELECT consumibles_ID INTO p_consumibles_ID FROM consumibles WHERE consumibles.nombreconsumible=p_nombreConsumible;
    UPDATE almacenesConsumibles SET cantidadConsumible=cantidadConsumible-1 WHERE almacenesConsumibles.dni=p_dni and almacenesConsumibles.consumibles_id=p_consumibles_ID;
END USA_CONSUMIBLE;
/

CREATE OR REPLACE PROCEDURE OBT_CONTENIDO_BONO (
p_bonos_ID bonos.bonos_ID%TYPE,
p_dni usuarios.dni%TYPE
)
IS 
cursor p_puntero2 is select pases_ID from lineaPases where bonos_ID = p_bonos_ID;
cursor p_puntero1 is select consumibles_ID from lineaConsumibles where bonos_ID = p_bonos_ID;
some_local_variable1 smallint;
some_local_variable2 smallint;
p_consumibles_ID consumibles.consumibles_ID%TYPE;
p_pases_ID pases.pases_ID%TYPE;
BEGIN
    open p_puntero1;
    loop
        fetch p_puntero1 into p_consumibles_ID;
        exit when p_puntero1%NOTFOUND;
        SELECT COUNT (1) INTO some_local_variable1 FROM almacenesconsumibles WHERE consumibles_ID=p_consumibles_ID and dni=p_dni;
        IF some_local_variable1=1 THEN
            UPDATE almacenesConsumibles SET cantidadConsumible=cantidadConsumible + 1 WHERE consumibles_ID=p_consumibles_ID and dni=p_dni;
            DBMS_OUTPUT.PUT_LINE('Le ha sido añadido un consumible');
        ELSE
            INSERT INTO almacenesConsumibles (dni, consumibles_ID,cantidadConsumible) VALUES (p_dni,p_consumibles_ID,1);
            DBMS_OUTPUT.PUT_LINE('Le ha sido añadido un consumible');
        END IF;
    END LOOP;
    open p_puntero2;
    loop
        fetch p_puntero2 into p_pases_ID;
        exit when p_puntero2%NOTFOUND;
            SELECT COUNT (1) INTO some_local_variable2 FROM almacenespases WHERE pases_ID=p_pases_ID and dni=p_dni;
            IF some_local_variable2=1 THEN
                UPDATE almacenesPases SET cantidadPase=cantidadPase+1 WHERE pases_ID=p_pases_ID and dni=p_dni;
                DBMS_OUTPUT.PUT_LINE('Le ha sido añadido un pase');
            ELSE
                INSERT INTO almacenesPases(dni, pases_ID,cantidadpase) VALUES (p_dni,p_pases_ID,1);
                DBMS_OUTPUT.PUT_LINE('Le ha sido añadido un pase');
            END IF;
        END LOOP;
END OBT_CONTENIDO_BONO;
/

CREATE OR REPLACE PROCEDURE FINALIZAR_VENTA (
p_ventas_ID IN ventas.ventas_ID%TYPE
)
IS cursor p_puntero is select bonos_ID, cantidadLV from lineaVentas where ventas_ID = p_ventas_ID;
p_bonos_ID bonos.bonos_id%TYPE;
p_cantidadLV lineaVentas.cantidadLV%TYPE;
p_dni usuarios.dni%TYPE;
BEGIN
    SELECT dni INTO p_dni FROM ventas WHERE ventas_ID=p_ventas_ID;
    open p_puntero;
    loop
        fetch p_puntero into p_bonos_ID, p_cantidadLV;
        exit when p_puntero%NOTFOUND;
        SELECT bonos_ID INTO p_bonos_ID from lineaventas WHERE ventas_ID=p_ventas_ID;
        LOOP
            OBT_CONTENIDO_BONO (p_bonos_ID,p_dni);
            p_cantidadLV := p_cantidadLV - 1;
            IF (p_cantidadLV = 0) THEN
                EXIT;
            END IF;
        END LOOP;
        END LOOP;
END FINALIZAR_VENTA;
/

CREATE OR REPLACE PROCEDURE CAMBIAR_CONTRASENA(
p_dni IN usuarios.dni%TYPE,
p_pass IN usuarios.pass%TYPE,
p_nuevaPass IN usuarios.pass%TYPE
)
IS realpass usuarios.pass%TYPE;
BEGIN
    SELECT pass into realpass FROM usuarios WHERE usuarios.dni=p_dni;
    IF p_pass != realpass THEN 
    DBMS_OUTPUT.put_line ('La contraseña no es correcta');
    ELSE 
    UPDATE usuarios SET pass=p_nuevaPass WHERE usuarios.dni=p_dni;
    END IF;
END CAMBIAR_CONTRASENA;
/

CREATE OR REPLACE PROCEDURE OBT_VENTAS_CLIENTE (p_dni in usuarios.dni%TYPE)
IS 
    cursor p_puntero is select ventas_id, fechaVenta from ventas where ventas.dni = p_dni;
    p_precioVenta NUMBER;
    p_ventas_ID ventas.ventas_ID%TYPE;
    p_fechaVenta ventas.fechaVenta%TYPE;
    f_puntero p_puntero%ROWTYPE;
BEGIN 
    open p_puntero;
    loop
        fetch p_puntero into p_ventas_ID, p_fechaVenta;
        exit when p_puntero%NOTFOUND;
             select sum(precioLV) INTO p_precioVenta from lineaVentas where lineaVentas.Ventas_ID = p_ventas_ID;
             DBMS_OUTPUT.PUT_LINE(' Venta realizada el dia ' || p_fechaVenta ||' por importe de: '||p_precioventa);
        end loop;
    CLOSE p_puntero;
END OBT_VENTAS_CLIENTE;
/

CREATE OR REPLACE PROCEDURE OBT_DONACIONES_CLIENTE (p_dni in usuarios.dni%TYPE)IS 
cursor p_puntero is select PARTICIPACIONESSORTEOS_ID ,FECHADONACION ,APORTACION  from donaciones where donaciones.dni = p_dni;
f_puntero p_puntero%ROWTYPE;
p_participacionessorteos_ID donaciones.participacionessorteos_id%TYPE;
p_fechaDonacion donaciones.fechadonacion%TYPE;
p_aportacion donaciones.aportacion%TYPE;
p_juegoMesa participacionesSorteos.juegomesa%TYPE;
BEGIN 
    open p_puntero;
    loop
        fetch p_puntero into p_participacionessorteos_id,p_fechaDonacion, p_aportacion;
        exit when p_puntero%NOTFOUND;
        SELECT juegoMesa INTO p_juegoMesa FROM participacionessorteos WHERE participacionessorteos_id=p_participacionessorteos_id;
        DBMS_OUTPUT.PUT_LINE('Donacion realizada el dia de ' || p_fechaDonacion ||' con el importe: '||p_aportacion || ' al juego de mesa ' || p_juegoMesa);
        end loop;
    CLOSE p_puntero;
END OBT_DONACIONES_CLIENTE;
/

CREATE OR REPLACE PROCEDURE OBT_TORNEOS_CLIENTE (p_dni in usuarios.dni%TYPE)IS 
cursor p_puntero is select VIDEOJUEGO, NOMBRETORNEO, FECHATORNEO from torneos join participantesTorneos on participantesTorneos.torneos_id = torneos.torneos_id WHERE participantesTorneos.dni=p_dni;
p_videojuego torneos.videojuego%TYPE;
p_nombreTorneo torneos.nombreTorneo%TYPE;
p_fechaTorneo torneos.fechaTorneo%TYPE;
BEGIN 
    open p_puntero;
    loop
        fetch p_puntero into p_videojuego, p_nombreTorneo, p_fechaTorneo;
        exit when p_puntero%NOTFOUND;
        DBMS_OUTPUT.PUT_LINE(' Participa en el torneo de nombre: ' || p_nombreTorneo ||', en la fecha: '|| p_fechaTorneo || ' (Videojuego: ' || p_videojuego || ')');
        end loop;
    CLOSE p_puntero;
END OBT_TORNEOS_CLIENTE;
/  

CREATE OR REPLACE PROCEDURE PARTICIPANTES_TORNEOS (p_Torneos_ID in torneos.Torneos_ID%TYPE) IS
cursor p_puntero is select nombre, usuarios.dni, correo from usuarios join participantesTorneos on usuarios.dni = participantesTorneos.dni where participantesTorneos.Torneos_ID = p_Torneos_ID;
p_dni usuarios.dni%TYPE;
p_nombre usuarios.nombre%TYPE;
p_correo usuarios.correo%TYPE;
BEGIN 
    open p_puntero;
    loop
        fetch p_puntero into p_nombre, p_dni, p_correo;
        exit when p_puntero%NOTFOUND;
        DBMS_OUTPUT.PUT_LINE(' Usuario con nombre: ' || p_nombre ||', correo: '|| p_correo || ' y con dni: ' || p_dni || ' participa en el torneo');
        end loop;
END PARTICIPANTES_TORNEOS;
/   

CREATE OR REPLACE PROCEDURE OBT_LINEAS_VENTA (p_ventas_ID in ventas.ventas_ID%TYPE)IS 
cursor p_puntero is select BONOS_ID, CANTIDADLV, PRECIOLV, DESCUENTO from lineaVentas WHERE lineaVentas.Ventas_ID = p_ventas_ID;
p_bonos_ID bonos.bonos_ID%TYPE;
p_cantidadLV lineaVentas.cantidadLV%TYPE;
p_precioLV lineaVentas.precioLV%TYPE;
p_descuento lineaVentas.descuento%TYPE;
p_fechaVenta ventas.fechaVenta%TYPE;
p_nombreBono bonos.nombrebono%TYPE;
p_precioBono bonos.precioBono%TYPE;
precioFinal NUMBER;
acumLineaVenta smallint := 0;
BEGIN 
    SELECT fechaVenta INTO p_fechaVenta FROM ventas WHERE ventas_ID=p_ventas_ID;
    DBMS_OUTPUT.PUT_LINE(' Contenido venta ' || p_ventas_id ||' realizada a fecha '|| p_fechaVenta );
    open p_puntero;
    loop
        fetch p_puntero into p_bonos_ID, p_cantidadLV, p_precioLV, p_descuento;
        exit when p_puntero%NOTFOUND;
        acumLineaVenta := acumLineaVenta+1;
        precioFinal := p_cantidadLV * p_preciolv;
        SELECT nombreBono INTO p_nombreBono FROM bonos WHERE bonos_ID=p_bonos_ID;
        SELECT precioBono INTO p_precioBono FROM bonos WHERE bonos_ID=p_bonos_ID;
        DBMS_OUTPUT.PUT_LINE( acumLineaVenta || ' : Producto: ' || p_nombreBono || ', Precio de venta: '|| p_precioBono ||', Precio de venta con descuento: '|| p_cantidadLV || ', Descuento: ' || p_descuento || ', Numero de productos: '||p_cantidadLV||', PrecioFinal: ' || precioFinal);
        end loop;
    CLOSE p_puntero;
END OBT_LINEAS_VENTA;
/ 

CREATE OR REPLACE PROCEDURE OBT_CONSUMIBLES_CLIENTE (p_dni in usuarios.dni%TYPE) IS
cursor p_puntero is select CONSUMIBLES_ID,CANTIDADCONSUMIBLE  from almacenesConsumibles where almacenesConsumibles.dni = p_dni;
p_consumibles_ID consumibles.consumibles_ID%TYPE;
p_cantidadConsumible almacenesConsumibles.cantidadConsumible%TYPE;
p_nombreConsumible consumibles.nombreConsumible%TYPE;
BEGIN 
    open p_puntero;
    loop
        fetch p_puntero into p_consumibles_ID, p_cantidadConsumible;
        exit when p_puntero%NOTFOUND;
            SELECT nombreConsumible INTO p_nombreConsumible FROM consumibles WHERE consumibles_ID=p_consumibles_ID;
            DBMS_OUTPUT.PUT_LINE(' El usuario tiene ' || p_cantidadConsumible ||' '|| p_nombreConsumible || ' en su almacen' );
        end loop;
    CLOSE p_puntero;
END OBT_CONSUMIBLES_CLIENTE;
/

CREATE OR REPLACE PROCEDURE OBT_PASES_CLIENTE (p_dni in usuarios.dni%TYPE) IS
cursor p_puntero is select PASES_ID,CANTIDADPASE from almacenesPases where almacenesPases.dni = p_dni;
p_pases_ID pases.pases_ID%TYPE;
p_cantidadPase almacenesPases.cantidadPase%TYPE;
p_tipoMedio pases.tipoMedio%TYPE;
BEGIN 
    open p_puntero;
    loop
        fetch p_puntero into p_pases_ID, p_cantidadPase;
        exit when p_puntero%NOTFOUND;
            SELECT tipoMedio INTO p_tipoMedio FROM pases WHERE pases_ID=p_pases_ID;
            DBMS_OUTPUT.PUT_LINE(' El usuario tiene ' || p_cantidadPase ||' '|| p_tipoMedio || ' en su almacen' );
        end loop;
    CLOSE p_puntero;
END OBT_PASES_CLIENTE;
/

CREATE OR REPLACE PROCEDURE VACIAR_PART_SORTEOS IS
BEGIN
    UPDATE participacionesSorteos SET participacion=0;
END;
/

CREATE OR REPLACE FUNCTION OBT_NUM_PART_TORNEO (p_torneo_ID smallint) RETURN NUMBER IS
    totalParticipantes NUMBER;
BEGIN
    SELECT COUNT (*) INTO totalParticipantes FROM participantestorneos WHERE torneos_id=p_torneo_id;
    RETURN totalParticipantes;
END OBT_NUM_PART_TORNEO;
/

CREATE OR REPLACE FUNCTION OBT_NUM_VENTAS_DESDE (fecha DATE) RETURN NUMBER IS
    totalVentas NUMBER;
BEGIN
    SELECT COUNT (*) INTO totalVentas FROM ventas WHERE ((TO_NUMBER (TO_CHAR (fechaVenta, 'yyyymmdd'))) - ((TO_NUMBER (TO_CHAR (fecha, 'yyyymmdd'))))<=0);
    RETURN totalVentas;
END OBT_NUM_VENTAS_DESDE;
/

CREATE OR REPLACE FUNCTION OBT_NUM_USUARIOS_INAC RETURN NUMBER IS
    totalUsuarios NUMBER;
BEGIN
    SELECT COUNT (*) INTO totalUsuarios FROM usuarios WHERE activo='FALSE';
    RETURN totalUsuarios;
END OBT_NUM_USUARIOS_INAC;
/

CREATE OR REPLACE FUNCTION OBT_NUM_USUARIOS_ACT RETURN NUMBER IS
    totalUsuarios NUMBER;
BEGIN
    SELECT COUNT (*) INTO totalUsuarios FROM usuarios WHERE activo='TRUE';
    RETURN totalUsuarios;
END OBT_NUM_USUARIOS_ACT;
/

CREATE OR REPLACE FUNCTION OBT_NUM_VENTAS_CLIENTE (p_dni varchar2) RETURN NUMBER IS
    totalVentas NUMBER;
BEGIN
    SELECT COUNT(*) INTO totalVentas FROM ventas WHERE dni=p_dni; 
  RETURN totalVentas;
END OBT_NUM_VENTAS_CLIENTE;
/

CREATE OR REPLACE FUNCTION OBT_DINERO_DONADO_CLIENTE (p_dni varchar2) RETURN NUMBER IS
    aportacionTotal NUMBER;
BEGIN
    SELECT SUM(aportacion) INTO aportacionTotal FROM donaciones WHERE dni=p_dni;
    RETURN aportacionTotal;
END OBT_DINERO_DONADO_CLIENTE;
/

CREATE OR REPLACE FUNCTION OBT_JUEGO_MAS_VOTADO RETURN VARCHAR2 IS
p_juego_mas_votado participacionesSorteos.juegoMesa%TYPE;
    BEGIN
    select juegoMesa into p_juego_mas_votado from participacionesSorteos join (select max(participacion)as p_participacion
    from participacionesSorteos) b ON b.p_participacion = p_participacion where rownum < 2;
  RETURN p_juego_mas_votado;
END OBT_JUEGO_MAS_VOTADO;
/
CREATE OR REPLACE FUNCTION OBT_N_CLIENTES_AD_BONO (p_Bonos_ID in bonos.Bonos_ID%TYPE) RETURN NUMBER IS
    p_num_clientes_ad_bono number;
    BEGIN
    select count(Bonos_ID) into p_num_clientes_ad_bono from bonos where bonos.Bonos_ID = p_Bonos_ID;
    RETURN p_num_clientes_ad_bono;
END;
/
CREATE OR REPLACE FUNCTION OBT_PRECIO_VENTA (p_Ventas_ID in Ventas.Ventas_ID%TYPE) RETURN NUMBER IS
    p_pv number;
    BEGIN
    select sum(precioLV*cantidadLV) INTO p_pv from lineaVentas where lineaVentas.Ventas_ID = p_Ventas_ID;
    RETURN p_pv;
END;
/
CREATE OR REPLACE FUNCTION OBT_DONACION_TOTAL (p_fecha date) RETURN NUMBER IS
    p_dt NUMBER;
    BEGIN
    select sum(aportacion) into p_dt from donaciones where TO_CHAR(fechaDonacion, 'mm') = TO_CHAR(p_fecha, 'mm') AND TO_CHAR(fechaDonacion, 'yyyy') = TO_CHAR(p_fecha, 'yyyy');
    RETURN p_dt;
END;
/

CREATE OR REPLACE FUNCTION OBT_GANADOR_SORTEO RETURN STRING IS
    CURSOR C IS 
        SELECT juegoMesa,participacion FROM participacionesSorteos;
    p_participantes C%ROWTYPE;
    totalParticipaciones NUMBER;
    numGanadorSorteo NUMBER;
    acumGanador NUMBER;
    p_juegoMesa participacionesSorteos.juegoMesa%TYPE;
    p_participacion participacionessorteos.participacion%TYPE;
    ganadorSorteo VARCHAR2(50);
BEGIN
    SELECT SUM (participacion) INTO totalParticipaciones FROM participacionesSorteos;
        BEGIN 
            SELECT dbms_random.value(1,totalParticipaciones) INTO numGanadorSorteo FROM dual;
        END;
    OPEN C;
    FETCH C INTO p_juegoMesa, p_participacion;
    WHILE acumGanador < numGanadorSorteo LOOP
        SELECT p_participacion + acumGanador INTO acumGanador FROM participacionesSorteos;
        END LOOP;
    SELECT p_juegoMesa INTO ganadorSorteo FROM participacionesSorteos where
  rownum < 2;
    CLOSE C;
    RETURN ganadorSorteo;
END OBT_GANADOR_SORTEO;
/

CREATE OR REPLACE FUNCTION BOOLEAN_TO_CHAR(STATUS IN BOOLEAN)
RETURN VARCHAR2 IS
BEGIN
  RETURN
   CASE STATUS
     WHEN TRUE THEN 'TRUE'
     WHEN FALSE THEN 'FALSE'
     ELSE 'NULL'
   END;
END;
/

CREATE OR REPLACE FUNCTION ES_BEBIDA_ALCOHOLICA (p_bonos_id varchar2) RETURN BOOLEAN IS
    p_consumibles_ID smallint;
    p_tipoConsumible VARCHAR2(50);
    BEGIN
        SELECT Consumibles_ID INTO p_consumibles_ID FROM lineaconsumibles WHERE bonos_id=p_bonos_ID;
        SELECT TipoConsumible INTO p_tipoConsumible FROM consumibles WHERE consumibles_ID=p_consumibles_ID;
        IF p_tipoConsumible='Bebica alcoholica' THEN
            RETURN TRUE;
        ELSE 
            RETURN FALSE;
        END IF;
END;
/

CREATE OR REPLACE FUNCTION OBT_EDAD (p_dni varchar2) RETURN NUMBER IS
    p_fechaNacimiento DATE;
    p_fechaInscripcion DATE;
    BEGIN
    SELECT fechaNacimiento INTO p_fechaNacimiento FROM usuarios WHERE dni=p_dni;
    SELECT fechaInscripcion INTO p_fechaInscripcion FROM usuarios WHERE dni=p_dni;
    RETURN TO_NUMBER (TO_CHAR (p_fechaInscripcion, 'yyyy')) - TO_NUMBER (TO_CHAR (p_fechaNacimiento, 'yyyy')); 
END;
/

CREATE OR REPLACE FUNCTION ASSERT_EQUALS (salida BOOLEAN, salidaEsperada BOOLEAN) RETURN VARCHAR2 AS
BEGIN
  IF (salida=salidaEsperada) THEN
  RETURN 'EXITO';
  ELSE
  RETURN 'FALLO';
  END IF;
END ASSERT_EQUALS;
/
