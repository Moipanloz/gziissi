SET SERVEROUTPUT ON;

DROP SEQUENCE seq_pruebas;
/


CREATE SEQUENCE seq_pruebas INCREMENT BY 1 START WITH 1;
/

DECLARE

cod_usuario varchar2 (9);
cod_usuario2 varchar2 (9);
cod_pase smallint;
cod_consumible smallint;
cod_almacenpases smallint;
cod_almacenconsumibles smallint;
cod_participacionsorteos smallint;
cod_donacion smallint;
cod_torneo smallint;
cod_participantetorneo smallint;
cod_bono smallint;
cod_lineapases smallint;
cod_lineaconsumibles smallint;
cod_venta smallint;
cod_lineaventa smallint;



BEGIN




--PRUEBAS USUARIO


PRUEBAS_USUARIOS.INICIALIZAR;

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creación de usuario','12345678A', 'Pepito', 'Passdepepito1', 'correodepepito@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', true);

cod_usuario:= '12345678A';

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': DNI sin letra final','123456789', 'Pepito', 'Passdepepito1', 'B@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': DNI demasiado largo','12345678910A', 'Pepito', 'Passdepepito1', 'C@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': DNI demasiado corto','123456A', 'Pepito', 'Passdepepito1', 'D@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': DNI con estructura errónea','1234A5678', 'Pepito', 'Passdepepito1', 'D@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': DNI con elementos no alfanumericos','1234567A!', 'Pepito', 'Passdepepito1', 'D@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Correo sin contener "@"','12345678B', 'Pepito', 'Passdepepito1', 'Eyahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Correo sin contener "." al final','12345678C', 'Pepito', 'Passdepepito1', 'F@yahoocom', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Fecha de nacimiento posterior a la fecha actual','12345678D', 'Pepito', 'Passdepepito1', 'G@yahoo.com', TO_DATE ('5000/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Edad menor a 16 años','12345678E', 'Pepito', 'Passdepepito1', 'H@yahoo.com', TO_DATE ('2018/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Nombre menor a tres caracteres','12345678F', 'Pe', 'Passdepepito1', 'I@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Contraseña mayor de 20 caracteres','12345678G', 'Pepito', 'ContraseñaDemasiadaLargaPorLoQueSobrepasaElLimite1', 'J@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Contraseña menor de 8 caracteres','12345678G', 'Pepito', 'PS', 'K@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Contraseña no alfanumerica','12345678G', 'Pepito', 'Pass!.-+`ç', 'K@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Nombre mayor de 50 caracteres','12345678H', 'Pepito Romualdo Hermenegildo Maximiliano Juan Carlos Tercero de España y Quinto de Francia', 'Passdepepito1', 'L@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': TipoPago ni Paypal ni Tarjeta','12345678I', 'Pepito', 'passdepepito', 'M@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Efectivo', false);

PRUEBAS_USUARIOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Correo repetido','12345678J', 'Pepito', 'Passdepepito1', 'correodepepito@yahoo.com', TO_DATE ('1940/06/25','yyyy/mm/dd'), 'Tarjeta', false);

PRUEBAS_USUARIOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualización correcta', cod_usuario, 'NuevoNombre', 'NuevaContraseña1', 'nuevocorreo@gmail.com',TO_DATE ('1999/06/29', 'yyyy/mm/dd'), 'Paypal', true);

PRUEBAS_USUARIOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualización a nombre demasiado corto', cod_usuario, 'New', 'NuevaContraseña1', 'nuevocorreo@gmail.com',TO_DATE ('1999/06/29', 'yyyy/mm/dd'), 'Paypal', false);

PRUEBAS_USUARIOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualización a nombre demasiado largo', cod_usuario, 'NombreMuyLargoTanLargoQueSobrepasaElLimiteDeLongitudDelNombrePorLoQueNoPermiteSuCreacion', 'NuevaContraseña1', 'nuevocorreo@gmail.com',TO_DATE ('1999/06/29', 'yyyy/mm/dd'), 'Paypal', false);

PRUEBAS_USUARIOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualización a contraseña demasiado corta', cod_usuario, 'NuevoNombre', 'Ps', 'nuevocorreo@gmail.com',TO_DATE ('1999/06/29', 'yyyy/mm/dd'), 'Paypal', false);

PRUEBAS_USUARIOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualización a contraseña demasiado larga', cod_usuario, 'NuevoNombre', 'PasswordDemasiadoLargaParaElAtributoPorLoTantoNoPermiteSuCreacion1', 'nuevocorreo@gmail.com',TO_DATE ('1999/06/29', 'yyyy/mm/dd'), 'Paypal', false);

PRUEBAS_USUARIOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualización a correo sin contener "@"', cod_usuario, 'NuevoNombre', 'NuevaContraseña1', 'nuevocorreogmail.com',TO_DATE ('1999/06/29', 'yyyy/mm/dd'), 'Paypal', false);

PRUEBAS_USUARIOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualización a correo sin contener "," al final', cod_usuario, 'NuevoNombre', 'NuevaContraseña1', 'nuevocorreo@gmailcom',TO_DATE ('1999/06/29', 'yyyy/mm/dd'), 'Paypal', false);

PRUEBAS_USUARIOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualización a fecha de nacimiento posterior a la fecha actual', cod_usuario, 'NuevoNombre', 'NuevaContraseña1', 'nuevocorreo@gmail.com',TO_DATE ('3000/06/29', 'yyyy/mm/dd'), 'Paypal', false);

PRUEBAS_USUARIOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualización a edad menor de 16 años', cod_usuario, 'NuevoNombre', 'NuevaContraseña1', 'nuevocorreo@gmail.com',TO_DATE ('2016/06/29', 'yyyy/mm/dd'), 'Paypal', false);

PRUEBAS_USUARIOS.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Borrado de un usuario', cod_usuario, true);


--PRUEBAS PASES

PRUEBAS_PASES.INICIALIZAR;

PRUEBAS_PASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de pase', 'PC', true);

cod_pase:= SEQ_PASES.currval;

PRUEBAS_PASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de pase erroneo', 'WII', false);

PRUEBAS_PASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de pase ya existente', 'PC', false);

PRUEBAS_PASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar pase', cod_pase, 'Switch', true);

PRUEBAS_PASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar pase inexistente', 9000,'Consola generica', false);

PRUEBAS_PASES.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Eliminar pase correctamente', cod_pase,true);


--PRUEBAS CONSUMIBLES

PRUEBAS_CONSUMIBLES.INICIALIZAR;

PRUEBAS_CONSUMIBLES.INSERTAR('Prueba '||seq_pruebas.nextval||': Creacion de consumible', 'CocaCola', 'Bebida generica', true);

cod_consumible:=SEQ_CONSUMIBLES.currval;

PRUEBAS_CONSUMIBLES.INSERTAR('Prueba '||seq_pruebas.nextval||': Creacion de consumible', 'Fanta', 'Bebida generica', true);

PRUEBAS_CONSUMIBLES.INSERTAR('Prueba '||seq_pruebas.nextval||': Creacion de consumible de tipo erróneo', 'McFlurry', 'Helado', false);

PRUEBAS_CONSUMIBLES.INSERTAR('Prueba '||seq_pruebas.nextval||': Creacion de consumible repetido', 'CocaCola', 'Bebida generica', false);

PRUEBAS_CONSUMIBLES.ACTUALIZAR('Prueba '||seq_pruebas.nextval||': Actualizar consumible', cod_consumible, 'Cerveza', 'Bebida alcoholica', true);

PRUEBAS_CONSUMIBLES.ACTUALIZAR('Prueba '||seq_pruebas.nextval||': Actualizar consumible inexistente', 99999, 'Cerveza', 'Bebida alcoholica', false);

PRUEBAS_CONSUMIBLES.ACTUALIZAR('Prueba '||seq_pruebas.nextval||': Actualizar consumible a tipo inexistente', cod_consumible, 'Cafe', 'Infusion', false);

PRUEBAS_CONSUMIBLES.ACTUALIZAR('Prueba '||seq_pruebas.nextval||': Actualizar consumible a otro existente', cod_consumible, 'Fanta', 'Bebida generica', false);

PRUEBAS_CONSUMIBLES.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Eliminar consumible', cod_consumible, true);



--PRUEBAS ALMACENESPASES

PRUEBAS_ALMACENESPASES.INICIALIZAR;

cod_usuario:= '12345678A';
cod_usuario:= '12345678B';
cod_pase:=SEQ_PASES.currval;

PRUEBAS_ALMACENESPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion almacen pases', cod_usuario, cod_pase, 5, true);

cod_almacenpases:=SEQ_ALMACENESPASES.currval;

PRUEBAS_ALMACENESPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion almacen de pases idéntico', cod_usuario, cod_pase, 10, false);

PRUEBAS_ALMACENESPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion almacen de pases de cantidad negativa', cod_usuario, cod_pase, -10, false);

PRUEBAS_ALMACENESPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion almacen de pases cuyo usuario no existe', '99999999Z', cod_pase, 5, false);

PRUEBAS_ALMACENESPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion almacen de pases cuyo pase no existe', cod_usuario, 999, 5, false);

PRUEBAS_ALMACENESPASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar la cantidad de almacen pases', cod_almacenpases,  cod_usuario, cod_pase, 10, true);

PRUEBAS_ALMACENESPASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar el usuario de almacen pases (no permitido)', cod_almacenpases,  cod_usuario2, cod_pase, 5, false);

PRUEBAS_ALMACENESPASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar el pase de almacen pases (no permitido)', cod_almacenpases,  cod_usuario, cod_pase+1, 5, false);

PRUEBAS_ALMACENESPASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar a pase inexistente el almacen pases', cod_almacenpases,  cod_usuario, 999, 5, false);

PRUEBAS_ALMACENESPASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar a usuario inexistente el almacen pases', cod_almacenpases,  '99999999Z', cod_pase, 5, false);

PRUEBAS_ALMACENESPASES.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Eliminar almacen de pases', cod_almacenpases, true);



--PRUEBAS ALMACENES CONSUMIBLES

PRUEBAS_ALMACENESCONSUMIBLES.INICIALIZAR;

cod_usuario:= '12345678A';
cod_usuario2:= '12345678B';
cod_consumible:=SEQ_CONSUMIBLES.currval;

PRUEBAS_ALMACENESCONSUMIBLES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion almacen consumibles', cod_usuario, cod_consumible, 5, true);

cod_almacenconsumibles:=SEQ_ALMACENESCONSUMIBLES.currval;

PRUEBAS_ALMACENESCONSUMIBLES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion almacen consumibles idéntico', cod_usuario, cod_consumible, 10, false);

PRUEBAS_ALMACENESPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion almacen de consumibles de cantidad negativa', cod_usuario, cod_consumible, -10, false);

PRUEBAS_ALMACENESCONSUMIBLES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion almacen consumibles cuyo usuario no existe', '99999999Z', cod_consumible, 5, false);

PRUEBAS_ALMACENESCONSUMIBLES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion almacen consumibles cuyo pase no existe', cod_usuario, 999, 5, false);

PRUEBAS_ALMACENESCONSUMIBLES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar la cantidad de almacen consumibles', cod_almacenconsumibles,  cod_usuario, cod_consumible, 10, true);

PRUEBAS_ALMACENESCONSUMIBLES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar el consumible de almacen consumibles (no permitido)', cod_almacenconsumibles,  cod_usuario, cod_consumible+1, 5, false);

PRUEBAS_ALMACENESCONSUMIBLES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar a consumible inexistente el almacen consumibles', cod_almacenconsumibles,  cod_usuario, 999, 5, false);

PRUEBAS_ALMACENESCONSUMIBLES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar a usuario inexistente el almacen consumibles', cod_almacenconsumibles,  '99999999Z', cod_consumible, 5, false);

PRUEBAS_ALMACENESCONSUMIBLES.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Eliminar almacen de consumibles', cod_almacenconsumibles, true);


--PRUEBA PARTICIPACIONES SORTEOS

PRUEBAS_PARTICIPACIONESSORTEOS.INICIALIZAR;

PRUEBAS_PARTICIPACIONESSORTEOS.INSERTAR('Prueba '||seq_pruebas.nextval||': Crear participacion de sorteo', 'Jungle', '2', true);

cod_participacionsorteos:=SEQ_PARTICIPACIONESSORTEOS.currval;

PRUEBAS_PARTICIPACIONESSORTEOS.INSERTAR('Prueba '||seq_pruebas.nextval||': Crear participacion de sorteo existente (no permitido)', 'Jungle', '2', false);

PRUEBAS_PARTICIPACIONESSORTEOS.INSERTAR('Prueba '||seq_pruebas.nextval||': Crear participacion de sorteo de cantidad negativa', 'Bang!', '-5', false);

PRUEBAS_PARTICIPACIONESSORTEOS.ACTUALIZAR('Prueba '||seq_pruebas.nextval||': Actualizar participacion de sorteo', cod_participacionsorteos, 'Dados Zombies', 5, true);

PRUEBAS_PARTICIPACIONESSORTEOS.ACTUALIZAR('Prueba '||seq_pruebas.nextval||': Actualizar participacion de sorteo a cantidad negativa', cod_participacionsorteos, 'Jungle', -5, false);

PRUEBAS_PARTICIPACIONESSORTEOS.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Eliminar participacion de sorteo', cod_participacionsorteos, true);

--PRUEBAS DONACIONES



PRUEBAS_DONACIONES.INICIALIZAR;

cod_usuario:= '12345678A';
cod_usuario2:= '12345678B';
cod_participacionsorteos:=SEQ_PARTICIPACIONESSORTEOS.currval;

PRUEBAS_DONACIONES.INSERTAR('Prueba '||seq_pruebas.nextval||': Añadir donacion', cod_usuario, cod_participacionsorteos, 100, true);

cod_donacion:=SEQ_DONACIONES.currval;

PRUEBAS_DONACIONES.INSERTAR('Prueba '||seq_pruebas.nextval||': Añadir donacion negativa', cod_usuario, cod_participacionsorteos, -20, false);

PRUEBAS_DONACIONES.INSERTAR('Prueba '||seq_pruebas.nextval||': Añadir donacion con demasiados decimales', cod_usuario, cod_participacionsorteos, 3.5203, false);

PRUEBAS_DONACIONES.INSERTAR('Prueba '||seq_pruebas.nextval||': Añadir donacion cuyo usuario no existe', '99999999Z', cod_participacionsorteos, 200, false);

PRUEBAS_DONACIONES.INSERTAR('Prueba '||seq_pruebas.nextval||': Añadir donacion cuya participacion no existe', cod_usuario, 999, 200, false);

PRUEBAS_DONACIONES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar donacion', cod_donacion, cod_usuario2, cod_participacionsorteos+1, 300, false);

PRUEBAS_DONACIONES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar donacion a cantidad negativa', cod_donacion, cod_usuario2, cod_participacionsorteos+1, -300, false);

PRUEBAS_DONACIONES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar donacion a usuario inexistente', cod_donacion, '99999999Z', cod_participacionsorteos, 300, false);

PRUEBAS_DONACIONES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar donacion a participacion sorteo inexistente', cod_donacion, cod_usuario, 999, 300, false);

PRUEBAS_DONACIONES.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Eliminar donacion', cod_donacion, true);



--PRUEBAS TORNEOS

PRUEBAS_TORNEOS.INICIALIZAR;

PRUEBAS_TORNEOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear torneo', 15, 'Smash Ultimate', 30, 'El mejor torneo de la historia de Smash', TO_DATE ('2020/06/23','yyyy/mm/dd'), true);

cod_torneo:=SEQ_TORNEOS.currval;

PRUEBAS_TORNEOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear torneo de participantes negativos', 15, 'Smash Ultimate', -30, 'El mejor torneo de la historia de Smash', TO_DATE ('2020/06/23','yyyy/mm/dd'), false);

PRUEBAS_TORNEOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear torneo de participantes decimales', 15, 'Smash Ultimate', 30.5, 'El mejor torneo de la historia de Smash', TO_DATE ('2020/06/23','yyyy/mm/dd'), false);

PRUEBAS_TORNEOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear torneo de precio negativo', -15, 'Smash Ultimate', 30, 'El mejor torneo de la historia de Smash', TO_DATE ('2020/06/23','yyyy/mm/dd'), false);

PRUEBAS_TORNEOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear torneo de precio con demasiados decimales', 15.5029, 'Smash Ultimate', 30, 'El mejor torneo de la historia de Smash', TO_DATE ('2020/06/23','yyyy/mm/dd'), false);

PRUEBAS_TORNEOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar torneo', cod_torneo, 20, 'Smash Meele', 10, 'El segundo mejor torneo de la historia de Smash', TO_DATE ('2021/06/23','yyyy/mm/dd'),true);

PRUEBAS_TORNEOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar torneo a precio de entrada negativo', cod_torneo, -20, 'Smash Meele', 10, 'El segundo mejor torneo de la historia de Smash', TO_DATE ('2021/06/23','yyyy/mm/dd'),false);

PRUEBAS_TORNEOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar torneo a precio de entrada con demasiados decimales', cod_torneo, 20.3029, 'Smash Meele', 10, 'El segundo mejor torneo de la historia de Smash', TO_DATE ('2021/06/23','yyyy/mm/dd'),false);

PRUEBAS_TORNEOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar torneo a participantes negativos', cod_torneo, 20, 'Smash Meele', -10, 'El segundo mejor torneo de la historia de Smash', TO_DATE ('2021/06/23','yyyy/mm/dd'),false);

PRUEBAS_TORNEOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar torneo a participantes decimales', cod_torneo, 20, 'Smash Meele', 10.5, 'El segundo mejor torneo de la historia de Smash', TO_DATE ('2021/06/23','yyyy/mm/dd'),false);

PRUEBAS_TORNEOS.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Eliminar torneo', cod_torneo, true);





--PRUEBAS PARTICIPANTES TORNEOS

PRUEBAS_PARTICIPANTESTORNEOS.INICIALIZAR;

cod_usuario:='12345678A';
cod_usuario2:='12345678B';
cod_torneo:=SEQ_TORNEOS.currval;

PRUEBAS_PARTICIPANTESTORNEOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear participante de torneo', cod_torneo, cod_usuario, true);

cod_participantetorneo:=SEQ_PARTICIPANTESTORNEOS.currval;

PRUEBAS_PARTICIPANTESTORNEOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear participante de torneo repetido', cod_torneo,cod_usuario,  false);

PRUEBAS_PARTICIPANTESTORNEOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear participante de torneo con usuario inexistente', cod_torneo, '99999999Z', false);

PRUEBAS_PARTICIPANTESTORNEOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear participante de torneo con torneo inexistente', 999, cod_usuario, false);

PRUEBAS_PARTICIPANTESTORNEOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar participante de torneo', cod_participantetorneo, cod_torneo+1,cod_usuario2,  false);

PRUEBAS_PARTICIPANTESTORNEOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar participante de torneo con usuario inexistente', cod_participantetorneo, cod_torneo,'99999999Z',  false);

PRUEBAS_PARTICIPANTESTORNEOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar participante de torneo con torneo inexistente', cod_participantetorneo, 999, cod_usuario, false);

PRUEBAS_PARTICIPANTESTORNEOS.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Eliminar participante de torneo', cod_participantetorneo, true);



--PRUEBAS BONOS

PRUEBAS_BONOS.INICIALIZAR;

PRUEBAS_BONOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear bono', 15, 'Bono generico', 'TRUE', true);

cod_bono:=SEQ_BONOS.currval;

PRUEBAS_BONOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear bono repetido', 15, 'Bono generico', 'TRUE', false);

PRUEBAS_BONOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear bono de precio negativo', -15, 'Bono generico2', 'TRUE', false);

PRUEBAS_BONOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear bono de precio con demasiados decimales', 15.5234, 'Bono generico2', 'TRUE', false);

PRUEBAS_BONOS.INSERTAR ('Prueba '||seq_pruebas.nextval||': Crear bono con valor de disponibilidad erroneo (Ni TRUE ni FALSE)', 15, 'Bono generico2', 'MAYBE', false);

PRUEBAS_BONOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar bono', cod_bono, 7, 'Bono Monster', 'FALSE', true);

PRUEBAS_BONOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar bono a precio negativo', cod_bono, -7, 'Bono Monster', 'FALSE', false);

PRUEBAS_BONOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar bono a precio con demasiados decimales', cod_bono, 7.321, 'Bono Monster', 'FALSE', false);

PRUEBAS_BONOS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar bono a valor de disponibilidad erroneo (Ni TRUE ni FALSE)', cod_bono, 7, 'Bono Monster', 'MAYBE', false);

PRUEBAS_BONOS.ELIMINAR('Prueba '||seq_pruebas.nextval||': Eliminar bono', cod_bono, true);



--PRUEBAS LINEAPASES

PRUEBAS_LINEAPASES.INICIALIZAR;

cod_bono:=SEQ_BONOS.currval;
cod_pase:=SEQ_PASES.currval;

PRUEBAS_LINEAPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de pases cuyo bono está inactivo', cod_bono, cod_pase, 10, true);

cod_lineapases:=SEQ_LINEAPASES.currval;

PRUEBAS_LINEAPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de pases cuyo bono está activo', cod_bono-2, cod_pase-1, 30, false);

PRUEBAS_LINEAPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de pases cuyo bono no existe', 999, cod_pase, 30, false);

PRUEBAS_LINEAPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de pases cuyo pase no existe', cod_bono, 999, 30, false);

PRUEBAS_LINEAPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de pases con cantidad negativa', cod_bono, cod_pase, -30, false);

PRUEBAS_LINEAPASES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de pases cuya cantidad tiene decimales', cod_bono, cod_pase, 30.1, false);

PRUEBAS_LINEAPASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar linea de pases', cod_lineapases, cod_bono-1, cod_pase-1, 40, true);

PRUEBAS_LINEAPASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar linea de pases a un bono inexistente', cod_lineapases, 999, cod_pase-1, 40, false);

PRUEBAS_LINEAPASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar linea de pases a un pase inexistente', cod_lineapases, cod_bono-1, 999, 40, false);

PRUEBAS_LINEAPASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar linea de pases a una cantidad negativa', cod_lineapases, cod_bono-1, cod_pase-1, -40, false);

PRUEBAS_LINEAPASES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar linea de pases a una cantidad con decimales', cod_lineapases, cod_bono-1, cod_pase-1, 40.4, false);

PRUEBAS_LINEAPASES.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Eliminar  linea de pases', cod_lineapases, true);



--PRUEBAS LINEACONSUMIBLES

PRUEBAS_LINEACONSUMIBLES.INICIALIZAR;

cod_bono:=SEQ_BONOS.currval;
cod_consumible:=SEQ_CONSUMIBLES.currval;

PRUEBAS_LINEACONSUMIBLES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de consumibles cuyo bono está inactivo', cod_bono, cod_consumible, 10, true);

cod_lineaconsumibles:=SEQ_LINEACONSUMIBLES.currval;

PRUEBAS_LINEACONSUMIBLES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de consumibles cuyo bono está activo', cod_bono-2, cod_consumible-1, 30, false);

PRUEBAS_LINEACONSUMIBLES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de consumibles cuyo bono no existe', 999, cod_consumible, 30, false);

PRUEBAS_LINEACONSUMIBLES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de consumibles cuyo consumible no existe', cod_bono, 999, 30, false);

PRUEBAS_LINEACONSUMIBLES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de consumibles con cantidad negativa', cod_bono, cod_consumible, -30, false);

PRUEBAS_LINEACONSUMIBLES.INSERTAR ('Prueba '||seq_pruebas.nextval||': Creacion de linea de consumibles cuya cantidad tiene decimales', cod_bono, cod_consumible, 30.1, false);

PRUEBAS_LINEACONSUMIBLES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar linea de consumibles', cod_lineaconsumibles, cod_bono-1, cod_consumible-1, 40, true);

PRUEBAS_LINEACONSUMIBLES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar linea de consumibles a un bono inexistente', cod_lineaconsumibles, 999, cod_consumible-1, 40, false);

PRUEBAS_LINEACONSUMIBLES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar linea de consumibles a un consumible inexistente', cod_lineaconsumibles, cod_bono-1, 999, 40, false);

PRUEBAS_LINEACONSUMIBLES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar linea de consumibles a una cantidad negativa', cod_lineaconsumibles, cod_bono-1, cod_consumible-1, -40, false);

PRUEBAS_LINEACONSUMIBLES.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar linea de consumibles a una cantidad con decimales', cod_lineaconsumibles, cod_bono-1, cod_consumible-1, 40.4, false);

PRUEBAS_LINEACONSUMIBLES.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Eliminar  linea de consumibles', cod_lineaconsumibles, true);



--PRUEBAS VENTAS

PRUEBAS_VENTAS.INICIALIZAR;

cod_usuario:='12345678A';
cod_usuario2:='12345678B';

PRUEBAS_VENTAS.INSERTAR('Prueba '||seq_pruebas.nextval||': Crear venta', cod_usuario, true);

cod_venta:= SEQ_VENTAS.currval;

PRUEBAS_VENTAS.INSERTAR('Prueba '||seq_pruebas.nextval||': Crear segunda venta al mismo usuario', cod_usuario, true);

PRUEBAS_VENTAS.INSERTAR('Prueba '||seq_pruebas.nextval||': Crear venta cuyo usuario no existe', '99999999Z', false);

PRUEBAS_VENTAS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar venta', cod_venta, cod_usuario2, true);

PRUEBAS_VENTAS.ACTUALIZAR ('Prueba '||seq_pruebas.nextval||': Actualizar venta a usuario que no existe', cod_venta, '99999999Z', false);

PRUEBAS_VENTAS.ELIMINAR ('Prueba '||seq_pruebas.nextval||': Eliminar venta', cod_venta, true);

END;
/