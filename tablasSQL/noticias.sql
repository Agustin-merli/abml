-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2024 a las 23:14:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mi_base_de_datos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `fecha` datetime NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `descripcion`, `texto`, `fecha`, `imagen`, `id_usuario`, `id_categoria`) VALUES
(1, 'Alta adhesión en Chacabuco al paro en defensa a la Educación Pública', 'Hoy hay una marcha en Capital Federal.', 'Este miércoles se realiza una jornada de lucha en defensa de la Educación Pública y contra el veto presidencial a la Ley de Financiamiento Universitario. La convocatoria es en Capital Federal, pero los docentes de todos los niveles de todo el país realizan un paro por 24 horas.', '2024-10-02 09:47:55', 'uploads/Universidades-paro.jpg', 1, 2),
(2, 'Choque entre un camión y un automóvil', ' En la esquina del Acceso Elguea Román y Dr. Fernández.', 'Esta tarde, un  camión  Mercedes Benz chocó con un Volkswagen Polo conducido por una mujer. No se registraron heridos.', '2024-09-30 16:48:55', 'uploads/IMG-20230429-WA0004.jpg', 1, 4),
(3, 'Ley de financiamiento universitario', 'Cómo votará cada diputado en la sesión sobre el veto de Javier Milei.', '¿Tendrá Javier Milei esta vez \"los héroes\" suficientes? El gobierno libertario entró a una semana decisiva con la atención puesta en la sesión parlamentaria que el miércoles tratará el veto presidencial a la ley de financiamiento universitario. La prioridad es aglutinar, como ocurrió con la ley jubilatoria, un tercio de diputados que respalden la decisión oficial y derrumben definitivamente la norma impulsada por la oposición.', '2024-10-11 11:38:00', 'uploads/milei.jpg', 1, 2),
(4, 'River a semis tras una agónica definición por penales', 'Cuartos de final de la liguilla.', 'Esta tarde en cancha de 9 de Julio, River recibió a San Martín por el encuentro que habría las llaves de cuartos de final de la liguilla. Tras unos parejos 90 minutos, el encuentro finalizó igualado en 0.', '2024-10-11 17:09:00', 'uploads/IMG-20241011-WA0056.jpg', 2, 1),
(5, 'Grave accidente de tránsito', 'Pellegrini y Pueyrredón.', 'Pasado el mediodía se produjo un violento accidente de tránsito en la esquina de calles Pueyrredón y Pellegrini. Allí colisionaron una motocicleta 110cc conducida por un masculino y un automóvil marca Volkswagen. Una ambulancia del SAME trasladó al Hospital al conductor de la moto con heridas de consideración .', '2024-10-15 13:13:00', 'uploads/IMG-20241015-WA0034.jpg', 1, 4),
(6, 'Jornada contra los tarifazos nacionales frente al Municipio', 'Participó el intendente Darío Golía.', 'Este sábado, frente al Palacio Municipal, se llevó adelante la jornada “Sumate al Apagón Nacional”, organizada por el Foro Multisectorial contra los Tarifazos.\r\nLa jornada se realizó en simultáneo en todos los Municipios de la Provincia de Buenos Aires.\r\n', '2024-10-12 14:58:00', 'uploads/WhatsApp-Image-2024-10-12-at-14.44.21.jpeg', 1, 3),
(7, 'Lionel Messi volvió al Monumental, brilló con tres goles y dos asistencias', 'A los 37 años, el rosarino completó con un alto rendimiento otro partido con la camiseta albiceleste y anotó su gol 112 en el seleccionado.', 'Lionel Messi volvió a jugar con la selección argentina en el Monumental luego de un año y cuatro días. Fue titular al lado de Julián Álvarez y Lautaro Martínez, en un tridente inédito desde el inicio. Los tres anotaron, pero Leo se apuntó un hat-trick ante el seleccionado al que más goles le marcó en su carrera: 11 de los 112 que lleva con la camiseta albiceleste.', '2024-10-15 23:37:00', 'uploads/messi.jpg', 2, 1),
(8, 'Los emprendimientos argentinos de diseño que se expanden a nivel global', 'ODA Biovajilla, Somos Dacal y Caranday fueron las empresas ganadoras de la primera edición del programa Diseño Argentino Exponencial; sus claves para abrirse al mercado internacional', 'Según el informe “Perspectivas de la Economía Creativa 2024″, publicado por UNCTAD en 2022, las exportaciones mundiales de servicios creativos se dispararon hasta los US$1,4 billones, mientras que los bienes creativos sumaron US$713.000 millones, un 29% y un 19% más, respectivamente, que en 2017. Asimismo, el reporte precisó que las economías en desarrollo exportan principalmente bienes creativos, mientras que las desarrolladas se caracterizan por exportar servicios creativos.', '2024-10-16 11:39:00', 'uploads/oda-biovajilla-fabrica-vajilla-compostable-a-BLAON275JZHORFKZUHMHIJWTFE.jpg', 1, 3),
(9, 'River vs San Martín no será televisado', '“Es pura y exclusivamente por este partido”, señalaron desde la Comisión Directiva del Club River.', 'Desde la Comisión Directiva del Club River informaron a Mundo Informativo que tomaron la decisión de no dejar transmitir con imágenes dicho encuentro. Si bien no argumentaron los motivos de la determinación, aclararon que “Es pura y exclusivamente por este partido”, dejando en claro que en el caso de avanzar de ronda y los partidos de interligas, sí podrán ser transmitidos.', '2024-10-10 10:34:00', 'uploads/futbol-para-todos.jpg', 2, 1),
(10, 'Boca Juniors le ganó a Gimnasia por penales y está en semifinales de Copa Argentina', 'Luego de los incidentes y el 1-1 en los 90\', la tanda definió el pase. Brey atajó ¡cuatro disparos!', 'El segundo partido Fernando Gago al mando de Boca Juniors tuvo realmente de todo. El Xeneize se enfrentó a Gimnasia por los cuartos de final de la Copa Argentina, se puso 1-0 arriba por el gol de cabeza de Anselmino y el caos entre hinchas, con pelea e incidentes en la tribuna, retrasó el inicio del ST. Riquelme, presidente del Xeneize, tuvo que separar... Después empató el Lobo y el pase a semis se definió por penales. Ahí Brey, reemplazante de Chiquito, Romero, se convirtió en héroe: atajó cuatro y Boca ganó 2-1.', '2024-10-23 12:30:00', 'uploads/boca.jpg', 2, 1),
(11, 'Los motivos que explican la baja del riesgo país', 'La suba del valor de los bonos locales, las versiones sobre un posible financiamiento por $2700 millones de bancos privados, US$14.000 millones por el efecto blanqueo, los depósitos en efectivo crecieron 26%, el avance del diálogo con el FMI y los desembo', 'Cuando Javier Milei asumió la Presidencia, el riesgo país medido por JP Morgan marcaba 1920 puntos. Con el comienzo de las medidas de ajuste del gasto público y la consolidación del equilibrio fiscal, logró que el indicador cayera paulatinamente. De hecho, esta semana comenzó en el orden de los 1100 puntos y actualmente se encuentra debajo de la barrera de los 1000, con una reducción de más de 100 unidades en sólo cuatro días.', '2024-10-25 12:00:00', 'uploads/20241025233701milei2.jpg', 1, 3),
(12, '¿Trámites imposibles? Tras la disolución de la AFIP, se vienen más apagones, un paro y se aceleran jubilaciones', 'El lunes y martes se realizarán nuevos apagones informáticos desde las 10 hasta las 14; y el miércoles habrá un cese de actividades; se aceleran los procesos para retirarse de la ahora llamada ARCA.', 'La AFIP dejó hoy de existir. Con la intención de eficientizar el organismo, en su lugar el Gobierno creó ahora la Agencia de Recaudación y Control Aduanero (ARCA). Ante el anticipo oficial del achicamiento previsto de la estructura y la plantilla, los gremios anunciaron que la semana que viene sumarán “apagones informáticos” y realizarán un paro general el miércoles, el mismo día en que se llevará adelante un fuerte paro de transporte contra la política de Javier Milei.', '2024-10-25 17:51:00', 'uploads/20241025235012AFIP.jpg', 1, 2),
(13, 'Herido grave esta madrugada', 'Se encuentra en Terapia Intensiva.', 'Esta madrugada, un hombre de 35 años habría chocó contra un poste y sufrió heridas de gravedad. Lo curioso es que se fue a su domicilio sin esperar la asistencia médica. Posteriormente debió llamar a la ambulancia que lo trasladó al Hospital, donde lo intervinieron quirúrgicamente. Sufrió politraumatismos varios y un traumatismo cerrado de abdomen. Tras la cirugía quedó alojado en Terapia Intensiva con pronóstico reservado.', '2024-10-20 13:28:00', 'uploads/20241025235612AMBULANCIA-SAME-.jpg', 1, 4),
(14, 'Secuestraron dos motos que habían chocado entre sí', 'Larrea y Pasaje Martini.', 'Anoche, en la esquina de las calles Larrea y Pasaje Martini se produjo un choque entre dos motos. Una era conducida por un hombre mayor de edad y la otra por una mujer acompañada por un menor. Tras el impacto el menor fue trasladado al hospital por el SAME. Personal de tránsito secuestró ambos vehículos por circular sin documentación reglamentaria, sin casco, con falta de luces y de patente.', '2024-10-23 09:47:00', 'uploads/20241026000218accidente.jpg', 1, 4),
(15, 'Con tres goles de Messi, Inter Miami aplastó 6-2 a New England y rompió una marca histórica de la MLS', 'El conjunto de la Florida terminó la temporada regular como líder absoluto de la Conferencia Este con 74 puntos, algo que ningún equipo había podido lograr. El capitán argentino ingresó en el segundo tiempo y fue la gran figura.', 'El Inter Miami, con Lionel Messi que comenzó entre los suplentes e ingresó en el segundo tiempo, aplastó 6-2 este sábado a New England Revolution y rompió una marca histórica de la MLS. El capitán argentino brilló de manera colosal con tres goles en 11 minutos en un partido que se jugó en el Chase Stadium.', '2024-10-19 21:08:00', 'uploads/messi2.jpg', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
