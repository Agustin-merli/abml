-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2024 a las 22:23:26
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
(2, 'Choque entre un camión y un automóvil', ' En la esquina del Acceso Elguea Román y Dr. Fernández.', 'Esta tarde, un  camión  Mercedes Benz chocó con un Volkswagen Polo conducido por una mujer. No se registraron heridos.', '2024-09-30 16:48:55', 'uploads/IMG-20230429-WA0004.jpg', 2, 4),
(3, 'Ley de financiamiento universitario', 'Cómo votará cada diputado en la sesión sobre el veto de Javier Milei.', '¿Tendrá Javier Milei esta vez \"los héroes\" suficientes? El gobierno libertario entró a una semana decisiva con la atención puesta en la sesión parlamentaria que el miércoles tratará el veto presidencial a la ley de financiamiento universitario. La prioridad es aglutinar, como ocurrió con la ley jubilatoria, un tercio de diputados que respalden la decisión oficial y derrumben definitivamente la norma impulsada por la oposición.', '2024-10-11 11:38:00', 'uploads/milei.jpg', 2, 2),
(4, 'River a semis tras una agónica definición por penales', 'Cuartos de final de la liguilla.', 'Esta tarde en cancha de 9 de Julio, River recibió a San Martín por el encuentro que habría las llaves de cuartos de final de la liguilla. Tras unos parejos 90 minutos, el encuentro finalizó igualado en 0.', '2024-10-11 17:09:00', 'uploads/IMG-20241011-WA0056.jpg', 2, 1),
(5, 'Grave accidente de tránsito', 'Pellegrini y Pueyrredón.', 'Pasado el mediodía se produjo un violento accidente de tránsito en la esquina de calles Pueyrredón y Pellegrini. Allí colisionaron una motocicleta 110cc conducida por un masculino y un automóvil marca Volkswagen. Una ambulancia del SAME trasladó al Hospital al conductor de la moto con heridas de consideración .', '2024-10-15 13:13:00', 'uploads/IMG-20241015-WA0034.jpg', 1, 4),
(6, 'Jornada contra los tarifazos nacionales frente al Municipio', 'Participó el intendente Darío Golía.', 'Este sábado, frente al Palacio Municipal, se llevó adelante la jornada “Sumate al Apagón Nacional”, organizada por el Foro Multisectorial contra los Tarifazos.\r\nLa jornada se realizó en simultáneo en todos los Municipios de la Provincia de Buenos Aires.\r\n', '2024-10-12 14:58:00', 'uploads/WhatsApp-Image-2024-10-12-at-14.44.21.jpeg', 2, 3),
(7, 'Lionel Messi volvió al Monumental, brilló con tres goles y dos asistencias', 'A los 37 años, el rosarino completó con un alto rendimiento otro partido con la camiseta albiceleste y anotó su gol 112 en el seleccionado.', 'Lionel Messi volvió a jugar con la selección argentina en el Monumental luego de un año y cuatro días. Fue titular al lado de Julián Álvarez y Lautaro Martínez, en un tridente inédito desde el inicio. Los tres anotaron, pero Leo se apuntó un hat-trick ante el seleccionado al que más goles le marcó en su carrera: 11 de los 112 que lleva con la camiseta albiceleste.', '2024-10-15 23:37:00', 'uploads/messi.jpg', 1, 1),
(8, 'Los emprendimientos argentinos de diseño que se expanden a nivel global', 'ODA Biovajilla, Somos Dacal y Caranday fueron las empresas ganadoras de la primera edición del programa Diseño Argentino Exponencial; sus claves para abrirse al mercado internacional', 'Según el informe “Perspectivas de la Economía Creativa 2024″, publicado por UNCTAD en 2022, las exportaciones mundiales de servicios creativos se dispararon hasta los US$1,4 billones, mientras que los bienes creativos sumaron US$713.000 millones, un 29% y un 19% más, respectivamente, que en 2017. Asimismo, el reporte precisó que las economías en desarrollo exportan principalmente bienes creativos, mientras que las desarrolladas se caracterizan por exportar servicios creativos.', '2024-10-16 11:39:00', 'uploads/oda-biovajilla-fabrica-vajilla-compostable-a-BLAON275JZHORFKZUHMHIJWTFE.jpg', 2, 3),
(9, 'River vs San Martín no será televisado', '“Es pura y exclusivamente por este partido”, señalaron desde la Comisión Directiva del Club River.', 'Desde la Comisión Directiva del Club River informaron a Mundo Informativo que tomaron la decisión de no dejar transmitir con imágenes dicho encuentro. Si bien no argumentaron los motivos de la determinación, aclararon que “Es pura y exclusivamente por este partido”, dejando en claro que en el caso de avanzar de ronda y los partidos de interligas, sí podrán ser transmitidos.', '2024-10-10 10:34:00', 'uploads/futbol-para-todos.jpg', 1, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
