-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-06-2020 a las 18:51:17
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_nutricion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Aminoacidos'),
(2, 'Articulaciones'),
(3, 'Grasas'),
(4, 'Hidratos'),
(5, 'Proteinas'),
(6, 'Quemadores'),
(7, 'Vitaminas'),
(15, 'Creatina'),
(19, 'Ofertas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedidos`
--

DROP TABLE IF EXISTS `lineas_pedidos`;
CREATE TABLE IF NOT EXISTS `lineas_pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL,
  `unidades` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_linea_pedido` (`pedido_id`),
  KEY `fk_linea_producto` (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lineas_pedidos`
--

INSERT INTO `lineas_pedidos` (`id`, `pedido_id`, `producto_id`, `unidades`) VALUES
(101, 215, 164, 10),
(102, 215, 82, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(255) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `coste` float(100,2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedido_usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `provincia`, `localidad`, `direccion`, `coste`, `estado`, `fecha`, `hora`) VALUES
(215, 292, 'Huelva', 'Huelva', 'Calle ColÃ³n nÂº 23', 384.10, 'ready', '2020-06-16', '20:23:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` float(6,2) NOT NULL,
  `stock` int(255) NOT NULL,
  `oferta` varchar(2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `oferta`, `fecha`, `imagen`) VALUES
(55, 7, 'MULTI VITAMININS', 'Multi Vitaminas de MM Supplements es un complemento alimenticio que provee un amplio espectro de vitaminas y minerales, seleccionados especialmente para apoyar un estilo de vida muy activo.', 3.60, 10, NULL, '2020-05-16', 'vita-one.jpg'),
(56, 7, 'VITAMINA C', 'Vitamina C Smart Supplements es un suplemento nutricional que ofrece Vitamina C (Ã¡cido ascÃ³rbico) de gran pureza y calidad. Mejora la salud y el rendimiento deportivo. Promueve un mejor trabajo muscular, mejora la absorciÃ³n de oxÃ­geno, previene el daÃ±o producido por los radicales libres generados por el ejercicio intenso y las infecciones relacionadas con el entrenamiento pesado.', 5.46, 10, NULL, '2020-05-16', 'vitamina-c1000.jpg'),
(57, 6, 'ANIMAL CUTS', 'Animal Cuts de Animal Nutrition es un compuesto de suplementos naturales de alta efectividad y gran rapidez. Contiene 9 fÃ³rmulas de alta eficacia y potencia en la quema de grasas. Sin efectos secundarios de insomnio o hiperactividad.', 38.70, 10, NULL, '2020-05-16', 'animal-cuts.jpg'),
(58, 6, 'THERMO ADDICT', 'Thermo Addict de Iron Addict Labs es un potente termogenico que ayuda a acelerar el proceso metabÃ³lico aumentando la temperatura corporal con el fin de quemar mÃ¡s calorÃ­as y grasas en el dÃ­a, es un suplemento que debe ser utilizado por individuos que deseen perder peso.', 14.50, 10, NULL, '2020-05-16', 'thermo-addict.jpg'),
(59, 6, 'CLA 1000', 'CLA 1000 de MM Supplements es un complemento alimenticio que provee Ã¡cido linoleico conjugado, un Ã¡cido graso esencial que el cuerpo no puede sintetizar por sÃ­ mismo.', 8.90, 10, NULL, '2020-05-16', 'cla.jpg'),
(60, 6, 'LIPO 6 BLACK', 'Lipo 6 Black es un suplemento de Nutrex de alta potencia y concentraciÃ³n que sirve como un excelente apoyo para bajar de peso muy rÃ¡pidamente y con efectos satisfactorios desde el primer momento. Este producto tiene una excelente capacidad de mejorar tu metabolismo y aumentar el calor corporal, especialmente para que utilices mÃ¡s calorÃ­as en el dÃ­a y logres adelgazar.', 24.30, 10, NULL, '2020-05-16', 'lipo-6-black.jpg'),
(61, 6, 'CAFEINA 200MG', 'CafeÃ­na de Smart Supplements es un complemento nutricional que te proveerÃ¡ de cafeÃ­na, un alcaloide del grupo de las xantinas, de uso comÃºn en productos deportivos destinados al incremento del rendimiento fÃ­sico.', 4.00, 10, NULL, '2020-05-16', 'cafeina.jpg'),
(62, 6, 'CHITOSAN 400MG', 'El Chitosan diseÃ±ado por MM Essence es un moderno producto. El Chitosan de MM Essence es un complemento alimenticio que estÃ¡ desarrollado totalmente con ingredientes naturales. Esta desarrollado a base de ingredientes biodegradables y no presenta efectos secundarios.', 4.60, 10, NULL, '2020-05-16', 'chitosan.jpg'),
(63, 6, 'GPLC GLICINA', 'GPLC (Glycine Propionyl L-Carnitine) de AmixPRO es un suplemento nutricional de efecto vasodilatador que aumenta el flujo sanguÃ­neo, las bombas musculares y mejora la salud de Ã³xido nÃ­trico. Estimula el crecimiento muscular, ayuda a reducir las grasas, reduce el daÃ±o oxidativo, mejora el rendimiento fÃ­sico, la composiciÃ³n corporal y la circulaciÃ³n sanguÃ­nea.\r\n', 28.90, 10, NULL, '2020-05-16', 'gplc-gliycina-propionil-l-carnitina.jpg'),
(64, 6, 'RESVERATROL', 'Resveratrol de Smart Supplements es un increÃ­ble producto formulado para optimizar de manera extraordinaria la protecciÃ³n de las cÃ©lulas contra el deterioro oxidativo. Es un potente antioxidante que detiene la degradaciÃ³n celular partiendo del daÃ±o que ocasionan los radicales libres, ayudÃ¡ndote a combatir el envejecimiento de las cÃ©lulas.', 6.80, 10, NULL, '2020-05-16', 'resveratrol.jpg'),
(65, 6, 'L-CARNITINA', 'L-Carnitina de MM Essence es el complemento dietÃ©tico ideal.', 4.50, 10, NULL, '2020-05-16', 'l-carnitina.jpg'),
(66, 6, 'L-CARNITINA CARNIPURE', 'L-Carnitina Carnipure de MM Supplements es un complemento alimenticio que te proveerÃ¡ carnitina CarnipureÂ®, la de mayor calidad y biodisponibilidad que ofrece el mercado.', 5.60, 10, NULL, '2020-05-16', 'l-carnitina (3).jpg'),
(67, 6, 'PICOLINATO DE CROMO', 'Picolinato de Cromo de Smart Supplements es un complemento alimenticio que te proveerÃ¡ de una fuente cromo concentrada en cÃ¡psulas de fÃ¡cil asimilaciÃ³n en el organismo.', 4.40, 10, NULL, '2020-05-16', 'picolinato-de-cromo.jpg'),
(68, 6, 'L-CARNITINA 2000mg', 'L - Carnitina 2000 mg de Marnys se trata de un compuesto natural que se puede sintetizar en el cuerpo por medio de los aminoÃ¡cidos esenciales llamados lisina y metionina, o tambiÃ©n ingerirse a travÃ©s de la dieta al encontrarse en pequeÃ±as cantidades de alimentos. Este es un compuesto totalmente beneficioso para ejercitarse.', 23.50, 9, NULL, '2020-05-16', 'l-carnitina (2).jpg'),
(69, 5, '100% WHEY  STANDARD', 'Whey Gold Optimum es un suplemento constructor de mÃºsculo que mejora la recuperaciÃ³n y potencia el desarrollo de masa muscular de calidad.\r\n\r\nApoya el desarrollo de la masa muscular, mejora la recuperaciÃ³n, protege la musculatura, ayuda a bajar de peso, cuida la salud.\r\n', 80.60, 10, NULL, '2020-05-16', '100-whey-gold-standard.jpg'),
(70, 5, 'ADDICT WHEY', 'Addict Whey de Iron Addict Labs es un suplemento nutricional que proporciona proteÃ­na de suero de leche de alta calidad con Ã³ptimas proporciones de BCAAs y Glutamina. Estudios recientes han constatado que la combinaciÃ³n de BCAAs y Glutamina es la mezcla mÃ¡s eficiente para estimular la recuperaciÃ³n post entrenamiento y potenciar el desarrollo de mÃºsculo magro.', 35.70, 10, NULL, '2020-05-16', 'addict-whey.jpg'),
(71, 5, 'NITRO TECH ', 'Nitro Tech PF Muscletech es un suplemento nutricional para potenciar la construcciÃ³n de mÃºsculo magro, mejorado con creatina y aminoÃ¡cidos. Permite construir mÃºsculo un 70% mÃ¡s delgado que el suero comÃºn, mejora la resistencia, el rendimiento y la recuperaciÃ³n. Aumenta la fuerza en un 174%. La FÃ³rmula superior de proteÃ­na de suero. ', 45.60, 10, NULL, '2020-05-16', 'nitro-tech-performance.jpg'),
(72, 5, 'ISO WHEY ZERO', 'ISO Whey Zero de BioTech USA es un suplemento deportivo que aporta a tu organismo aislado de proteÃ­na de suero de leche de alta calidad, y que ha sido enriquecido con aminoÃ¡cidos de cadena ramificada o BCAA\'s, y glutamina. IncorpÃ³ralo a tus rutinas para obtener mÃ¡s masa muscular, y para proteger a tus mÃºsculos de los efectos del paso del tiempo.', 67.80, 10, NULL, '2020-05-16', 'iso-whey-zero.jpg'),
(73, 5, 'ELITE WHEY', 'Elite Whey Dymatize es un suplemento nutricional que estimula la sÃ­ntesis proteica, promueve el desarrollo muscular, ayuda a perder peso y mejora la recuperaciÃ³n. Proporciona Ã³ptimas proporciones de proteÃ­nas: ProteÃ­na de suero concentrado y ProteÃ­na de suero aislado, una perfecta combinaciÃ³n que permite un producto con menos grasa y carbohidratos, con resultados garantizados.', 56.60, 10, NULL, '2020-05-16', 'elite-whey-protein.jpg'),
(74, 5, 'ISOPRIME CFM', 'IsoPrime CFM de Amix Nutrition es un suplemento alimenticio a base de aislado de suero de leche con 90% de pureza, micro filtrado por mÃ©todos de flujo cruzado (CFM) que asegura un alto valor biolÃ³gico por cada servicio y una rÃ¡pida absorciÃ³n por el organismo. Es rico en proteinas y libre de grasas.', 96.50, 10, NULL, '2020-05-16', 'isoprime-cfm.jpg'),
(75, 5, '100% WHEY PROTEIN', '100% Whey Protein  de Scitec Nutrition es el producto ideal para ti estÃ¡ hecho con la mejor combinaciÃ³n de aminoÃ¡cidos esenciales para ayudar el crecimiento de tu tejido muscular, ofreciendote ademÃ¡s las proteÃ­nas necesarias para alcanzar ese cuerpo de verano por el que tanto te esfuerzas a diario en tus entrenamientos.', 65.60, 10, NULL, '2020-05-16', 'whey-protein.jpg'),
(76, 5, '100% WHEY PROFESSIONAL', '100% Whey Protein Professional de Scitec Nutrition es el suplemento proteÃ­co mÃ¡s completo que puedes incorporar a tu dieta. Ha sido elaborado con concentrado de suero, una matriz amplia de aminoÃ¡cidos, aislado de proteÃ­na de suero de leche y con enzimas digestivas que mejoran su asimilaciÃ³n. Excelente para ganar masa muscular, proteger los huesos y aumentar la definiciÃ³n.', 60.60, 10, NULL, '2020-05-16', '100-whey-protein-professional.jpg'),
(77, 5, 'ISO WHEY', 'ISO Whey de Quamtrax promueve el desarrollo de masa muscular y mejora la recuperaciÃ³n deportiva gracias a una fÃ³rmula de proteÃ­na de alta pureza y calidad que proporciona un mÃ­nimo aporte en grasas y carbohidratos.', 44.60, 10, NULL, '2020-05-16', 'iso-whey.jpg'),
(78, 5, 'ISO ZERO NATIVE', 'Iso Zero Native de Iogenix es un suplemento elaborado con aislado de proteÃ­na de suero de leche de alta calidad ideal para cubrir todos tus requerimientos en aminoÃ¡cidos. Asegura una increÃ­ble ganancia de masa muscular, una recuperaciÃ³n rÃ¡pida y mÃ¡s energÃ­as para entrenar con este polvo delicioso. Puedes disfrutarlo con confianza ya que su sabor proviene de endulzantes dietÃ©ticos.', 69.60, 10, NULL, '2020-05-16', 'iso-zero-native.jpg'),
(79, 5, 'CREATESTON', 'Createston Professional de Peak es un complemento alimenticio que contiene todo lo que necesitas para potenciar tu capacidad fÃ­sica durante tu entrenamiento. Su fÃ³rmula contiene hidrolizado de proteÃ­na de suero, aislado de proteÃ­na de suero, aminoÃ¡cidos esenciales y de cadena ramificada, creatina, vitaminas, minerales, antioxidantes, adaptÃ³genos, y carbohidratos de 5 etapas para proveer energÃ­as a corto y largo plazo.', 46.60, 10, NULL, '2020-05-16', 'createston-professional.jpg'),
(80, 5, 'WHEY PHARMA', 'Whey Pharma de Natural Health es una fÃ³rmula a base de proteÃ­na de suero de leche ideal para personas intolerantes al gluten, logrando asÃ­ generar una ganancia muscular magra ideal para personas celÃ­acas que busquen mejorar su potencia y rendimiento muscular aumentando su volumen y definiciÃ³n.', 56.00, 10, NULL, '2020-05-16', 'whey-pharma.jpg'),
(81, 5, 'GHOST 100% WHEY', 'Ghos 100% Whey Protein de Ghost es una proteÃ­na con la mayor pureza y concentraciÃ³n de calidad premium que incluye enzimas naturales, con sabores fuera de lo comÃºn. Asegura tu mayor desarrollo fÃ­sico y un rendimiento inigualable con este suplemento que puedes usar de forma versÃ¡til en tu dieta y que te darÃ¡ un asombroso poder de regeneraciÃ³n muscular.', 55.70, 10, NULL, '2020-05-16', 'ghost-whey-protein.jpg'),
(82, 5, 'ISOZYME', 'Isozyme de MTX Elite Nutrition es un eficiente y un poderoso suplemento, cuya fÃ³rmula estÃ¡ compuesta en un 92% de pura proteÃ­na de alta calidad. Considerada como uno de los mejores suplementos proteicos del mercado en la actualidad, este producto es ideal para las personas que buscan aumentar la ingesta de proteÃ­nas necesarias en sus comidas sin la ingesta de grasas o calorÃ­as.', 99.70, 7, NULL, '2020-05-16', 'isozyme.jpg'),
(83, 5, '100% ISOLATE', '100% Isolate de Galvanize Chrome es una proteÃ­na de alto valor, ideal para aquellos que buscan incrementar la masa muscular libre de grasa, ademÃ¡s es mucho mÃ¡s pura, ya que estÃ¡ sometida a un proceso de micro-filtraciÃ³n de flujo cruzado, ayudando a mantener bajos niveles de grasa muscular y al mismo tiempo colaborando con la construcciÃ³n de mÃºsculos fuertes. ', 69.60, 9, NULL, '2020-05-16', '100-isolate.jpg'),
(84, 4, 'CICLODEXTRIN', 'Ciclodextrin de Iogenix es la dextrina cÃ­clica por excelencia que te ofrece los beneficios necesarios para un Ã³ptimo rendimiento fÃ­sico, ya que se asimila rÃ¡pidamente, aportando energÃ­a de manera inmediata, ademÃ¡s estÃ¡ sostenida en el tiempo y no aumenta los niveles de azÃºcar en el cuerpo, puedes tomarlo en cualquier momento, sobre todo en esos dÃ­as de fuerte entrenamiento.\r\n', 45.00, 10, NULL, '2020-05-16', 'ciclodextrin.jpg'),
(86, 4, 'VITARGO ELECTROLITES', 'Vitargo Electrolites de Vitargo es un complemento nutricional compuesto principalmente de carbohidrato y reforzado con minerales esenciales que ayudan a dar un toque de energÃ­a extra durante las sesiones de entrenamientos; es ideal para deportistas y/o atletas de Ã©lite, cuya demanda fÃ­sica es extrema y requiere necesariamente mayor esfuerzo para desarrollar correctamente cada movimiento', 33.30, 10, NULL, '2020-05-16', 'vitargo-electrolites.jpg'),
(87, 4, 'AMILOPECTINA', 'Amilopectina de Vitobest es un suplemento de alta pureza y calidad con Amilopectina, el carbohidrato de alta performance. Promueve el crecimiento de masa muscular, aumenta la energÃ­a, mejora el rendimiento. Previene el sÃ­ndrome de sobre entrenamiento. Contiene un 100% de Amilopectina pura, el carbohidrato de alto nivel, ', 34.60, 10, NULL, '2020-05-16', 'amilopectina.jpg'),
(88, 4, 'VITARGO CRX', 'Vitargo CRX 2.0 Scitec es un suplemento nutricional que mejora el rendimiento de alta intensidad. Promueve el metabolismo energÃ©tico, reduce la fatiga. Apoya la salud del sistema nervioso e inmunitario. Nueva fÃ³rmula de â€œCarbohydrate Plus Creatineâ€ con creatina y VitargoÂ®, reconocido como el mejor carbohidrato del mundo.', 32.50, 10, NULL, '2020-05-16', 'vitargo-crx.jpg'),
(89, 4, 'CLUSTER DEXTRIN', 'Cluster Dextrin de Vitobest es un nuevo y esplÃ©ndido producto, el cual ha sido elaborado especialmente para los deportistas o atletas, el cual es capaz de mejorar su rendimiento fÃ­sico durante esos afamados entrenamientos de intensidades altas, lo que les ayuda a mejorar cada dÃ­a debido a su formula especializada', 45.70, 10, NULL, '2020-05-16', 'cluster-dextrin.jpg'),
(90, 4, 'CARBO MIX XXL', 'Carbo Mix XXL de Vitobest es una mezcla bastante avanzada que incluye entre sus componentes 5 tipos de carbohidratos de Ãºltima generaciÃ³n, que proponen diferentes Ã­ndices glucÃ©micos, tiempos de correcta asimilaciÃ³n y tambiÃ©n excelentes aportes en cada ingesta de energÃ©ticos de multifase. Es un complemento indicado para restaurar los niveles de glucÃ³geno muscular.', 34.60, 10, NULL, '2020-05-16', 'carbo-mix-xxl.jpg'),
(91, 4, 'CICLO AMINO DEXTRIN', 'Ciclo Amino Dextrin desarrollado por Big es un complemento alimenticio de tipo hidrato de carbono que aporta energÃ­a al organismo. ', 46.70, 10, NULL, '2020-05-16', 'ciclo-amino-dextrin.jpg'),
(92, 4, 'AMILOPECTINA ELECTRO', 'Amilopectina con Electrolitos de Vitobest es un suplemento nutricional que repone el glucÃ³geno de forma rÃ¡pida y efectiva. Mejora la hidrataciÃ³n. Contiene electrolitos para ayudar mantener el equilibrio de minerales en el organismo. Aumenta la energÃ­a, la fuerza y la resistencia. Reconocido como el mejor carbohidrato del mundo por su eficacia en la reposiciÃ³n de glucÃ³geno muscular y hepÃ¡tico.', 24.50, 10, NULL, '2020-05-16', 'amilopectina-con-electrolitos.jpg'),
(93, 4, 'WAXYGO', 'El producto WaxyGo! de Amix es un carbohidrato modificado enzimÃ¡ticamente para obtener una respuesta energÃ©tica sumamente efectiva. Derivado del almidÃ³n de maÃ­z. No contiene azÃºcares. Ideado para deportistas con un alto desgaste de calorÃ­as. RÃ¡pida absorciÃ³n en el sistema intestinal. Inmediata reposiciÃ³n de glucÃ³geno. Su alto Ã­ndice molecular impide la generaciÃ³n de lÃ­pidos.', 34.60, 10, NULL, '2020-05-16', 'waxygo.jpg'),
(94, 4, 'RELOAD AMIL0PECTINA', 'Reload de Big es el suplemento deportivo elaborado a base de amilopectina, ideal para recargar tus musculos', 31.50, 10, NULL, '2020-05-16', 'reload-amilopectina.jpg'),
(95, 4, 'CLUSTER DEXTRIN PURE', 'Cluster Dextrin Pure de Big es un suplemento realizado en base a ciclodextrinas, que son el mejor tipo de hidratos de carbono necesarios para proveer una fuente efectiva de energÃ­a. Favorece el desarrollo de los mÃºsculos, reduce el cansancio, y mejora profundamente el entrenamiento. Producto de rÃ¡pida asimilaciÃ³n y de resultados efectivos.', 56.70, 10, NULL, '2020-05-16', 'cluster-dextrin-pure.jpg'),
(96, 4, '100% AMILOPECTINA', '100% Amilopectina de Quamtrax, es un suplemento elaborado a Ãºnicamente con almidÃ³n de maiz 100% sin grasa ni azÃºcar aÃ±adido.', 56.80, 10, NULL, '2020-05-16', '100-amilopectina.jpg'),
(97, 4, 'WINGS', 'Wings (Amilopectina) de Soul Project, es un suplemento nutricional que ha sido elaborado principalmente con amilopectina, un almidÃ³n de maÃ­z modificado que nuestro organismo asimila rÃ¡pidamente, el cual es rÃ¡pidamente asimilado por nuestro cuerpo y que ademÃ¡s usan muchos deportistas de elite, mejora la respuesta por parte de nuestro cuerpo y de este modo el consumo energÃ©tico, entre otros.', 30.00, 10, NULL, '2020-05-16', 'wings.jpg'),
(98, 4, 'MALTODEXTRINA', 'Aumenta tu masa muscular con Maltodextrina, si quieres ganar tamaÃ±o y verte mÃ¡s grande y fuerte no hay mejor suplemento energÃ©tico para eso, deja atrÃ¡s los mÃºsculos pequeÃ±os y flÃ¡cidos y accede al cuerpo que siempre quisiste tener', 5.70, 9, NULL, '2020-05-16', 'maltodextrina.jpg'),
(99, 3, 'ACEITE DE ONAGRA', 'El Aceite de Onagra es un producto que fabrica MM Essence con una formulaciÃ³n totalmente natural.', 4.70, 10, NULL, '2020-05-16', 'aceite-de-onagra.jpg'),
(100, 3, 'SUPER OMEGA', 'Super Omega 3  de Vitobest Es un producto cien por ciento hecho a base de Omega 3 de alta pureza, procesado con mÃ©todos de purificaciÃ³n molecular.  Fomenta la salud del sistema cardiovascular. Mejora la circulaciÃ³n sanguÃ­nea. Refuerza las funciones mentales, mejora la visiÃ³n, protege el sistema nervioso. Contiene aceite Omega 3 de pescado elaborado por PhosphoTech.', 17.60, 10, NULL, '2020-05-16', 'super-omega.jpg'),
(101, 3, 'OMEGA 3', 'Omega 3 Iron Addict Labs es un suplemento alimenticio que proporciona aceite de pescado de calidad Premium, con Ã¡cidos grasos concentrados EPA y DHA, en perlas suaves. Los Ã¡cidos grasos esenciales Omega 3 EPA (Ã¡cido eicosapentaenoico) y DHA (Ã¡cido docosahexaenoico) tienen efecto antinflamatorio, ayudan a regenerar los tejidos y promueven la salud del sistema cardiovascular y nervioso.', 5.80, 10, NULL, '2020-05-16', 'omega (2).jpg'),
(102, 3, 'OMEGA 3 1000MG', 'Omega 3 de Haya Labs es un suplemento alimenticio que se encarga de reforzar las funciones cardÃ­acas y del organismo, reducciÃ³n del colesterol y una mejora en el funcionamiento cerebral. Mantener tu cuerpo sano es el propÃ³sito de estas cÃ¡psulas de gel antiflamatorio', 17.70, 10, NULL, '2020-05-16', 'omega (3).jpg'),
(103, 3, 'OMEGA 3 1400MG', 'El Omega 3 de Bets Protein es un suplemento alimenticio que te brindarÃ¡ todos los beneficios naturales del omega 3. Protege las articulaciones, reduce la fatiga, rinde en cada evento deportivo como si fuera el primero del dÃ­a.', 15.60, 10, NULL, '2020-05-16', 'omega (4).jpg'),
(104, 3, 'ANIMAL OMEGA', 'Animal Omega Universal es un suplemento fundacional anabÃ³lico que promueve la salud cardiovascular. Ayuda a eliminar la grasa corporal. Promueve el equilibrio hormonal. Apoya la salud del sistema cardiovascular. Aumenta la retenciÃ³n de nitrÃ³geno, la producciÃ³n de testosterona y de la hormona de crecimiento.', 27.90, 10, NULL, '2020-05-16', 'animal-omega.jpg'),
(105, 3, 'OMEGA 3 Y 6', 'El omega 3 presente en este producto tiene un importante en la regulaciÃ³n de los sistemas cardiovascular, inmunolÃ³gico, digestivo y reproductivo, ademÃ¡s de tener efectos antinflamatorios. Los Ã¡cidos grasos omega 6 son indicados para reducir el riesgo de enfermedades del corazÃ³n, para reducir los niveles del colesterol.', 17.85, 10, NULL, '2020-05-16', 'omega.jpg'),
(106, 3, 'DHA', 'DHA de Now Foods es un complemento alimenticio que apoya la salud del cerebro, su base fundamental es omega 3, un Ã¡cido graso esencial que debe incluirse al cuerpo externamente. Puede ser consumido por mujeres y hombres que requieran de este importante nutriente para mejorar la salud en esta Ã¡rea.', 37.80, 10, NULL, '2020-05-16', 'dha.jpg'),
(107, 3, 'OMEGA VEGETAL', 'Omega Vegetal Mezcla de Semillas Bio de Granero es una combinaciÃ³n de varios tipos de semillas muy sustanciosas que te otorgarÃ¡n una nutriciÃ³n mejorada y un estilo de vida muy saludable. Disfruta de las virtudes del lino dorado, de las semillas de calabaza, del sÃ©samo y de las semillas de girasol, que contribuirÃ¡n con fibra y numerosas grasas saludables a tu organismo', 3.60, 10, NULL, '2020-05-16', 'omega-vegetal-mezcla-de-semillas-bio.jpg'),
(108, 3, 'EPA/GLA FORTE', 'EPA/GLA Forte de Douglas es un complemento alimenticio antioxidante, elaborado a base de aceite de pescado y aceite de borraja una excelente combinaciÃ³n que proporciona Ã¡cidos grasos Omega 3 y 6. Ãštil para quienes necesitan controlar procesos inflamatorios crÃ³nicos, quienes padecen problemas asociadas con la respuesta inmune y para controlar los niveles de colesterol y triglicÃ©ridos en sangre.', 4.60, 10, NULL, '2020-05-16', 'epa-gla-forte.jpg'),
(109, 3, 'ANDROLISTICA', 'Androlistica de Holistica es un complemento alimenticio diseÃ±ado para mejorar la salud del hombre maduro. Su fÃ³rmula incluye diferentes ingredientes y compuestos que mejoran la salud de la prÃ³stata y garantizan una mejor funciÃ³n urinaria. Es un complemento altamente nutritivo, con un gran aporte de omega 3, vitamina e y vitamina A. \r\n', 47.70, 10, NULL, '2020-05-16', 'androlistica.jpg'),
(110, 3, 'OMEPUR', 'Omepur de Drasanvi es un suplemento alimenticio en versiÃ³n de perlas, fÃ¡ciles de tomar y digerir. Ahora prevenir enfermedades del hÃ­gado graso, cardÃ­acas, apariciÃ³n de coÃ¡gulos en arterias, serÃ¡ muy fÃ¡cÃ­l, ya que con incluir este suplemento en tu dieta, estarÃ¡s aportando a tu cuerpo salud y vitalidad. Es 100% natural, mejora tu visiÃ³n, niveles de colesterol y triglicÃ©ridos.', 15.70, 10, NULL, '2020-05-16', 'omepur.jpg'),
(111, 3, 'ONAGRA PERLAS', 'Gracias a las mÃºltiples propiedades del aceite de Onagra, Prisma Natural ha decidido poner a tu disposiciÃ³n un producto de la mÃ¡s alta calidad, en su presentaciÃ³n de perlas. Este es ideal para combatir muchas dolencias; para proteger tu sistema nervioso, hormonal y en los procesos de coagulaciÃ³n, lo que es importante para las mujeres especialmente.', 26.70, 10, NULL, '2020-05-16', 'onagra.jpg'),
(112, 3, 'OPTI-EPA', 'Opti-EPA de Douglas Laboratories es un complemento alimenticio que provee una concentraciÃ³n de EPA (Ã¡cido ecosapentaenoico), un Ã¡cido graso que forma parte de los Omega 3. Ofrece un apoyo al sistema cardÃ­aco, el desarrollo visual y al funcionamiento del cerebro.', 35.70, 10, NULL, '2020-05-16', 'opti-epa.jpg'),
(113, 3, 'OMEGA 3 PLUS', 'Omega 3 Plus de Mundo Natural es un extraordinario complemento alimenticio elaborado a partir de aceites de pescado de excelente calidad, con un aporte considerable de omega 3 (EPA y DHA). Omega 3 Plus de Mundo Natural es un producto que ayudarÃ¡ a mejorar la salud a travÃ©s de las propiedades del omega 3, especialmente la salud cardiovascular y cerebral.\r\n', 31.50, 10, NULL, '2020-05-16', 'omega.jpg'),
(114, 2, 'COLAGENO CON MAGNESIO', 'ColÃ¡geno con Magnesio de MM Essence es un excelente complemento nutricional que cubre los requerimientos de dos minerales esenciales para cubrir la salud del organismo.', 3.60, 10, NULL, '2020-05-16', 'colageno-con-magnesio.jpg'),
(115, 2, 'BEAUTY COLLAGEN', 'Beauty Collagen de Weider es un producto constituÃ­do por pequeÃ±Ã­simas partÃ­culas (polvo) cuyos ingredientes estÃ¡n formulados para el cuidado, protecciÃ³n y belleza de la piel. EstÃ¡ elaborado con colÃ¡geno de pescado y componentes antioxidantes eficaces para mantener una piel joven y saludable. Es un gran aliado para detener los efectos de la edad sobre la piel.', 34.60, 10, NULL, '2020-05-16', 'beauty-collagen.jpg'),
(116, 2, 'COLLMAR ORIGINAL', 'ColÃ¡geno con Magnesio de MM Supplements es un complemento alimenticio compuesto por colÃ¡geno y magnesio, dos componentes vitales de tendones, cartÃ­lagos, ligamentos y huesos. \r\n', 24.60, 10, NULL, '2020-05-16', 'collmar-original.jpg'),
(117, 2, 'COLAGENO Y MAGNESIO', 'ColÃ¡geno y Magnesio de Smart Supplements es un complemento alimenticio que contiene dos nutrientes muy importantes para apoyar la salud.', 3.60, 10, NULL, '2020-05-16', 'colageno-magnesio.jpg'),
(118, 2, 'COLAGENO Y MAGNESIO', 'Este ColÃ¡geno con Magnesio de Ana MarÃ­a Lajusticia es un complemento nutricional que se compone esencialmente con colÃ¡geno enriquecido con magnesio. Con este producto podrÃ¡s estimular la formaciÃ³n de proteÃ­nas colÃ¡genas en tus tejidos articulares y conectivos, asÃ­ que disfrutarÃ¡s un mayor estado saludable de estos.', 23.60, 10, NULL, '2020-05-16', 'colageno-con-magnesio2.jpg'),
(119, 2, 'ANIMAL FLEX', 'Animal Flex En Polvo de Animal es un suplemento multivitamÃ­nico que tiene la gran capacidad de proteger y cuidar de las articulaciones. Se ha elaborado con importantes ingredientes, apoya al tejido conectivo, se disuelve con facilidad, tiene un buen sabor y es efectivo. \r\n', 47.80, 10, NULL, '2020-05-16', 'animal-flex.jpg'),
(120, 2, 'COLLMAR COMPRIMIDOS', 'Collmar Comprimidos de Drasanvi es tu mejor aliado en la lucha contra la vejez. Este producto es un potente antioxidante y regenerador de articulaciones, huesos y tejidos de la piel, por lo que al incluirlo en tus dietas diarias podrÃ¡s olvidarte de las futuras apariciones de arrugas o flacidez en tu piel\r\n', 34.60, 10, NULL, '2020-05-16', 'collmar-comprimidos.jpg'),
(121, 2, 'RAW COLAGENO', 'Raw ColÃ¡geno de Raw Physique es un suplemento nutricional a base de colÃ¡geno. Contiene una Ã³ptima dosis de 1000 mg proteÃ­na hidrolizada de carne. Apoya la salud de los huesos y de la piel', 12.70, 10, NULL, '2020-05-16', 'raw-colageno.jpg'),
(122, 2, 'COLLAREGEN', 'Collaregen de Olimp Sport, es un suplemento alimenticio elaborado a base de colÃ¡geno de alta calidad, ideal para fortalecer las articulaciones, cartÃ­lagos y huesos. Su excelente fÃ³rmula contiene Vitamina C con tecnologÃ­a PureWayCÂ® que ayuda notablemente a la formaciÃ³n normal del colÃ¡geno; y ademÃ¡s contiene mineral de cobre y maganeso  que favorecen la funciÃ³n y formaciÃ³n del tejido conectivo.', 23.50, 10, NULL, '2020-05-16', 'collaregen.jpg'),
(123, 2, 'PROACTIVE HYA', 'ProActive HYA es un protector y rejuvenecedor celular por excelencia, elaborado por los laboratorios Hypertrophy, el cual, cuenta con una estupenda formulaciÃ³n con colÃ¡geno marino, vitamina C y B6, mÃ¡s Ã¡cido hialurÃ³nico y coenzima Q10, que protege tus cÃ©lulas del daÃ±o oxidativo, regenera fantÃ¡sticamente la piel, mantiene tus articulaciones sanas, ademÃ¡s, previene las lÃ­neas de expresiÃ³n. ', 23.60, 10, NULL, '2020-05-16', 'proactive-hya.jpg'),
(124, 2, 'COLAGENO', 'ColÃ¡geno de Iogenix es el complemento ideal para la salud de tus huesos y articulaciones, especialmente en el Ã¡mbito deportivo y la salud en general ya que posee propiedades regenerativas que contribuyen al  mantenimiento de los tejidos y la prevenciÃ³n y recuperaciÃ³n de lesiones tÃ­picas del entrenamiento, manteniendo la piel sana e hidratada.\r\n', 15.80, 10, NULL, '2020-05-16', 'colageno.jpg'),
(125, 2, 'COLAGENO FORTIGEL', 'Este ColÃ¡geno Fortigel de IOGenix es un complemento alimenticio que estÃ¡ clÃ­nicamente probado para ayudar a los propios mecanismos fisiolÃ³gicos que se encargan de mantener las articulaciones sanas y que aseguran su correcta movilidad. AdemÃ¡s, gracias a su elevado contenido en proteÃ­nas (90%), lo convierten en una fantÃ¡stica fuente de proteÃ­nas, que contribuyen, ademÃ¡s de al mantenimiento y al aumento de la masa muscular, al mantenimiento de los huesos en condiciones normales.', 22.60, 10, NULL, '2020-05-16', 'colageno-fortigel.jpg'),
(126, 1, 'BCAA 2:1:1', 'BCAA 2:1:1 de MM Supplements es un complemento alimenticio que contiene aminoÃ¡cidos de cadena ramificada o BCAA. Provee Leucina, Valina e Isoleucina en proporciones 2:1:1 (el doble de leucina por cada parte de valina e isoleucina)\r\n', 15.00, 10, NULL, '2020-05-16', 'bcaa.jpg'),
(127, 1, 'L-GLUTAMINA KYOWA', 'L-Glutamina Kyowa de MM Supplements es un complemento alimenticio que te proporcionarÃ¡ la mejor glutamina del mercado. Es apta para apoyar la actividad deportiva intensa en hombres y mujeres.\r\n', 12.50, 10, NULL, '2020-05-16', 'glutamina.jpg'),
(128, 1, 'ANTICATABOL', 'Anticatabol de Bull Sport Nutrition es un complemento alimenticio creado en base a BCAA\'s (aminoÃ¡cidos de cadena ramificada) en proporciÃ³n 2:1:1 (por cada parte de valina e isoleucina tiene el doble de leucina), glutamina y vitamina B6. Se ha endulzado con edulcorantes dietÃ©ticos.\r\n', 19.99, 10, NULL, '2020-05-16', 'anticatabol2.jpg'),
(129, 1, 'BCAA + GLUTAMINA', 'El BCAA + Glutamina desarrollado por Iron Addict Labs contiene una fÃ³rmula con ingredientes de acciÃ³n anticatabÃ³lica. El BCAA + Glutamina de iron labs contiene una combinaciÃ³n de sustancias que mejoran el crecimiento, el rendimiento y la recuperaciÃ³n de los mÃºsculos despuÃ©s de realizar la actividad fÃ­sica. Este producto detiene el desgaste de los mÃºsculos.', 14.50, 10, NULL, '2020-05-16', 'bcaa-glutamina.jpg'),
(130, 1, 'ANTICATABOL 1000G', 'Anticatabol de Bull Sport Nutrition es un complemento alimenticio creado en base a BCAA\'s (aminoÃ¡cidos de cadena ramificada) en proporciÃ³n 2:1:1 (por cada parte de valina e isoleucina tiene el doble de leucina), glutamina y vitamina B6. Se ha endulzado con edulcorantes dietÃ©ticos.', 37.00, 10, NULL, '2020-05-16', 'anticatabol.jpg'),
(131, 1, 'BCAA-RELOAD', 'BCAA Reload de Bull Sport Nutrition es un complemento alimenticio que te proveerÃ¡ de aminoÃ¡cidos de cadena ramificada en relaciÃ³n 2:1:1 (el doble de leucina por cada parte de valina e isoleucina). TambiÃ©n contribuye con glutamina.\r\n', 35.80, 10, NULL, '2020-05-16', 'bcaa-reload.jpg'),
(132, 1, 'ADDICT BCAA', 'Addict BCAA 8:1:1 Iron Addict Labs es un nuevo suplemento que proporciona los aminoÃ¡cidos ramificados con ultra dosis de leucina para un poderoso estÃ­mulo anabÃ³lico. L-Leucina es el aminoÃ¡cido mÃ¡s anabÃ³lico que acelera la recuperaciÃ³n y mejora el rendimiento fÃ­sico. Incrementa las concentraciones de BCAAs, reduce el cansancio, aumenta la potencia y estimula la construcciÃ³n de mÃºsculo magro.\r\n', 6.80, 10, NULL, '2020-05-16', 'addict-aminoacidos.jpg'),
(133, 1, 'ESSENTIAL AMINO ENERGY', 'Essential Amino Energy es un suplemento dietario creado por Optimum Nutrition, a base de una avanzada formula que permite reducir la grasa en el cuerpo. Esta fÃ³rmula contiene aminoÃ¡cidos libres de rÃ¡pida absorciÃ³n que permiten ademÃ¡s el desarrollo del tejido de los mÃºsculos. Essential Amino Energy de Optimum Nutrition tambiÃ©n estimula el bombeo del flujo sanguÃ­neo.', 37.00, 10, NULL, '2020-05-16', 'essential.jpg'),
(134, 1, 'GLUTAMINA POLVO', 'Glutamina Polvo de Smart Supplements es un complemento alimenticio que provee glutamina en polvo de rÃ¡pida asimilaciÃ³n.', 22.60, 10, NULL, '2020-05-16', 'glutamina-polvo.jpg'),
(135, 1, 'MG AMINO MUSCLE', 'MG Amino Muscle Grow de MM Supplements es un complemento alimenticio que te proveerÃ¡ aminoÃ¡cidos esenciales, aminoÃ¡cidos de cadena ramificada, citrulina malato y glutamina.\r\n', 25.50, 10, NULL, '2020-05-16', 'muscle-grow-amino.jpg'),
(136, 1, 'ANIMAL NITRO', 'Animal Nitro de de Universal es un suplemento nutricional que estimula el crecimiento muscular en base a la aceleraciÃ³n del transporte de aminoÃ¡cidos. Optimiza la distribuciÃ³n de nutrientes a los mÃºsculos. Potencia el desarrollo muscular. Combate la fatiga. Aumenta la fuerza. Acelera la recuperaciÃ³n.', 44.50, 10, NULL, '2020-05-16', 'animal.jpg'),
(137, 1, 'TAURINA', 'Taurina de Scitec Nutrition es un suplemento nutricional que proporciona el aminoÃ¡cido taurina en forma libre en megacÃ¡psulas. Aumenta el volumen, apoya la construcciÃ³n muscular. De efecto imitador de la insulina natural. Aumenta la energÃ­a y la fuerza. Reduce el daÃ±o oxidativo. Apoya la funciÃ³n muscular y la salud cardiovascular.', 3.70, 10, NULL, '2020-05-16', 'taurina.jpg'),
(138, 1, 'L-GLUTAMINA', 'L-Glutamina de Scitec Nutrition es un suplemento nutricional que proporciona pura glutamina de grado farmacÃ©utico. Estimula el crecimiento de la masa muscular. Evita el catabolismo. Mejora la recuperaciÃ³n post entrenamiento. Reduce la fatiga. Mejora el rendimiento. Fortalece el sistema inmunitario.', 25.50, 10, NULL, '2020-05-16', 'l-glutamina.jpg'),
(139, 1, 'ARGININA LIQUIDA', 'Arginina LÃ­quida es un suplemento precursor de Ã³xido nÃ­trico, muy cÃ³modo y fÃ¡cil de tomar, que estimula el crecimiento de la masa muscular y mejora la composiciÃ³n corporal. Aumenta la energÃ­a, la fuerza, la resistencia y el crecimiento muscular. Apoya el metabolismo de las grasas para lograr un aumento de masa sin grasa y mejorar la definiciÃ³n.', 16.40, 10, NULL, '2020-05-16', 'arginina-liquida.jpg'),
(140, 1, 'BETA ALANINA', 'Beta Alanina de Smart Supplements es un complemento alimenticio que concentra las propiedades nutricionales de la beta alanina.', 17.40, 10, NULL, '2020-05-16', 'betalanine.jpg'),
(142, 7, 'BIOTIN', 'La biotina es un miembro de la familia de vitaminas de  clase B, que juega un papel clave en el metabolismo de proteÃ­nas, de las grasas y de los carbohidratos.', 9.99, 10, NULL, '2020-05-23', 'biotin.jpg'),
(143, 7, 'VITOMIN', 'Vitomin de Vitobest es un increÃ­ble suplemento que te proveerÃ¡ de todas las vitaminas y minerales fundamentales para reforzar tus requerimientos diarios. Posee vitamina C, A, B1, B2, B3, B5, B6, B9, B12, E, D3, biotina, selenio, cobre, manganeso, hierro, y zinc. Fortifica tus niveles de energÃ­a, necesarios para entrenar o para llevar a delante tus actividades diarias.', 13.90, 10, NULL, '2020-05-23', 'vitomin.jpg'),
(144, 7, 'ANTIOX-FORMULA AVANCED', 'Antiox FÃ³rmula Avanzada de Vitobest es un extraordinario suplemento antioxidante, cargado de increÃ­bles componentes con principios activos naturales, enriquecida con vitaminas de la mÃ¡s alta calidad que ofrece la tecnologÃ­a patentada DSM TM , CoQ10 de excelentes propiedades de tecnologÃ­a Kaneka Q10TM y minerales como el zinc, el calcio y el selenio para una mejor y mayor sÃ­ntesis de antioxidantes.\r\n', 8.60, 10, NULL, '2020-05-23', 'antiox-formula-avanzada.jpg'),
(145, 7, 'MULTI-VITS', 'Es un complemento alimenticio que incorpora en su fÃ³rmula una amplia variedad de vitaminas y minerales, destinadas al mejoramiento de la salud y de las funciones que realiza nuestro organismo. Entre los beneficios de Multi-Vits de Bigman estÃ¡ su alto poder antioxidante, su apoyo al sistema inmune, sistema cardiovascular y nervioso, aumento de la energÃ­a.', 5.50, 10, NULL, '2020-05-23', 'Multi_vits.jpg'),
(146, 7, 'METHYL-B-COMPLEX', 'Methyl B complex es un eficaz y completo suplemento alimenticio compuesto por el complejo de vitaminas B ideal para mejorar la circulaciÃ³n, prevenir enfermedades nerviosas y favorecer el mantenimiento de la piel. Esta es una de las mejores opciones para cuidar el cuerpo de una manera fÃ¡cil y rÃ¡pida.', 14.50, 10, NULL, '2020-05-23', 'methyl-b-complex.jpg'),
(147, 7, 'MG-500', 'Mg 500 Citrato de Magnesio de Granero es un suplemento que te provee una de las fuentes mÃ¡s concentradas y efectivas de magnesio, un mineral muy importante. Asegura en tu organismo mayor fortaleza, ademÃ¡s de huesos, mÃºsculos y articulaciones mÃ¡s fuertes. BenefÃ­ciate con sus propiedades que previenen y disminuyen la incidencia de lesiones al entrenar.', 13.80, 10, NULL, '2020-05-23', 'mg-500-citrato-de-magnesio.jpg'),
(148, 7, 'Mag-Masst Magnesio Mastic', 'Mag-Masst de MariaLajusticia es un suplemento alimenticio masticable que proporciona alto contenido en magnesio para la salud. Reduce el cansancio y la fatiga. Apoya el equilibrio electrolÃ­tico. Ayuda a mantener los huesos, los dientes. Apoya la salud muscular y nerviosa. Ayuda a perder peso. Mejora la salud intestinal. Mejora la calidad del sueÃ±o.', 8.45, 10, NULL, '2020-05-23', 'mag-mas-magnesio-masticable.jpg'),
(149, 7, 'ACTIVA-WOMAN', 'Activa Woman de Be Essential, es un suplemento elaborado especialmente para la mujer actual ya que aporta las vitaminas y minerales que su cuerpo requiere con el objetivo de aportar los principales micronutrientes para nuestra vida diaria, otorga un extra de vitaminas D, K, Ã¡cido fÃ³lico y hierro, nos aporta un extra de energÃ­a para conservar en el nivel adecuado las necesidades biolÃ³gicas', 17.50, 10, NULL, '2020-05-23', 'activa-woman.jpg'),
(150, 7, 'ESPIRULINA VITAL', 'La Espirulina Vital de OikosVital, es un maravilloso complemento alimenticio compuesto por una base de algas, rico en fibra, aminoÃ¡cidos esenciales, betacarotenos, calcio, vitamina B, magnesio, clorofila, antioxidantes y enzimas.', 12.40, 10, NULL, '2020-05-23', 'espirulina-vital.jpg'),
(151, 7, 'POLIVITAMINICO', 'Mega PolivitamÃ­nico 100% de SFY Nutrition es un suplemento alimenticio formulado con una gran variedad de vitaminas que abarcan la vitamina E, B, D, K y C; destinadas a mejorar notablemente el funcionamiento fisiolÃ³gico, siendo una excelente fuente polivitamÃ­nica. AdemÃ¡s de esto, es un producto ideal para atletas que buscan un desarrollo muscular Ã³ptimo con bajos niveles de calorÃ­as.', 15.80, 10, NULL, '2020-05-23', 'polivitaminico.jpg'),
(152, 15, 'ADDICT', 'Addict Creatina de Iron Addict Labs es una fÃ³rmula sÃºper micronizada de creatina de calidad Premium que aumenta el rendimiento muscular, reduce la fatiga y mejora la recuperaciÃ³n tras los entrenamientos de alta intensidad. Promueve el crecimiento muscular, previene la pÃ©rdida de mÃºsculo. Aumenta la energÃ­a, la fuerza y el rendimiento en el entrenamiento.', 14.60, 10, NULL, '2020-05-23', 'addict-creatina.jpg'),
(153, 15, 'CELL-TECH-HYPER', 'Cell-Techâ„¢ Hyper-Build de Muscletech es una innovadora fÃ³rmula 5 en 1 para post-entrenamiento, desarrollado especÃ­ficamente para maximizar la saturaciÃ³n de la creatina. Incorpora la creatina mÃ¡s potente de post entrenamiento con dosis Ã³ptimas de aminoÃ¡cidos BCAAs para aumentar la fuerza, el crecimiento muscular y la recuperaciÃ³n.', 29.80, 10, NULL, '2020-05-23', 'cell-tech-hyper-build.jpg'),
(154, 15, 'CELL-TECH-PERFORMANCE', 'Cell Tech PF de Muscletech es un suplemento nutricional que ayuda a desarrollar volumen muscular y a mantener la ganancia. FÃ³rmula de alto poder voluminizador con creatina. Promueve el desarrollo de la masa muscular y ayuda a mantener la ganancia a largo plazo. Aumenta la fuerza y la energÃ­a, acelera la recuperaciÃ³n, mejora el rendimiento fÃ­sico, fortalece el sistema inmune y la salud en general.', 34.80, 10, NULL, '2020-05-23', 'cell-tech-performance-series.jpg'),
(155, 15, 'CREABIG', 'CreaBig de Big, es un suplemento deportivo que ha sido creado con creatina monohidrato calidad CreapureÂ®, lo que nos garantiza una creatina libre de impurezas, y una velocidad de asimilaciÃ³n y una capacidad de absorciÃ³n superior al 90%, nos ayuda a retrasar la apariciÃ³n de la fatiga o cansancio, aumenta el metabolismo energÃ©tico en las cÃ©lulas musculares.', 25.70, 10, NULL, '2020-05-23', 'creabig.jpg'),
(156, 15, 'CREACTOR', 'Creactor de Muscletech es un suplemento dietÃ©tico a base de creatina cientÃ­ficamente avanzada que ofrece micro dosis de creatina, que aumenta la fuerza del mÃºsculo, el tamaÃ±o muscular y el rendimiento.', 29.90, 10, NULL, '2020-06-05', 'creactor.jpg'),
(157, 15, 'CREATINA CREAPURE', 'Creatina Creapure de MM Supplements es un complemento alimenticio que te proveerÃ¡ de la forma mÃ¡s pura de monohidrato de creatina. Se ha obtenido mediante un microfiltrado de Ãºltima generaciÃ³n, que le confiera la mÃ¡xima asimilaciÃ³n.', 15.80, 10, NULL, '2020-06-05', 'creatina-creapure.jpg'),
(158, 15, 'VITOBEST', 'Creatina en Polvo Vitobest es un suplemento nutricional que contiene la creatina de mayor calidad y pureza. La creatina genera la energÃ­a muscular necesaria para el entrenamiento de alta intensidad, estimula la sÃ­ntesis de proteÃ­nas y el crecimiento muscular evitando el catabolismo y la grasa corporal.', 13.40, 10, NULL, '2020-06-05', 'creatina-en-polvo.jpg'),
(159, 15, 'CREATINA MONOHIDRATO', 'Creatina Monohidrato de Scitec Nutrition es un suplemento que proporciona creatina de alta calidad y pureza. Con 100% monohidrato de creatina de alta calidad. Aumenta la energÃ­a, la fuerza, la resistencia. Promueve la voluminizaciÃ³n, estimula el crecimiento muscular. Previene las agujetas.', 29.95, 10, NULL, '2020-06-05', 'creatina-monohidrato.jpg'),
(160, 15, 'CREATINA POWDER', 'Creatine Powder Optimum es un suplemento de alto poder, con creatina de alta calidad en sabor neutro, para combinar con otras fÃ³rmulas nutricionales. Promueve el aumento de la masa muscular. Apoya la contracciÃ³n muscular, la movilidad y la capacidad de carga de los mÃºsculos. Incrementa la fuerza y la potencia. Mejora el rendimiento. Proporciona un 99,9% de Monohidrato de Creatina.', 21.50, 10, NULL, '2020-06-05', 'creatina-powder.jpg'),
(161, 15, 'CREATINA OLIMP', 'Ceatina Creapure de Olimp Sport, es un producto a base de creatina monhidrato en polvo de alta pureza, calidad y eficiencia; que ademÃ¡s de ser libre de impurezas, posee la garantÃ­a que ofrece Creapure, la mejor creatina del mercado mundial de la mÃ¡s alta tecnologÃ­a. Este producto le ayudarÃ¡ a aumentar notablemente su fuerza y masa muscular entre otros beneficios.', 16.60, 10, NULL, '2020-06-05', 'creatine-olimp.jpg'),
(162, 15, 'CREATINA MICRONIZADA', 'Creatina Micronizada de Universal Nutrition es un complemento alimenticio que hace uso de la mejor creatina disponible del mercado, con la mayor absorciÃ³n y biodisponibilidad; se trata de la creatina monohidrato pura micronizada, de tecnologÃ­a CreapureÂ®, que mejora el aporte de energÃ­a directo a los mÃºsculos para el mejor rendimiento fÃ­sico, resistencia a la fatiga y desarrollo muscular.', 23.40, 10, NULL, '2020-06-05', 'creatine-micro.jpg'),
(163, 15, 'MEGA CREATINA', 'El Mega Creatina Alkaline, es una moderna y novedosa fÃ³rmula deportiva desarrollada por los expertos de 4Pro Nutrition que contiene la mejor creatina alcalina, la cual es 100% favorecedora para todos los deportistas. Por lo general, una de las mÃ¡s notables propiedades de este excelente producto es poder alcanzar las cÃ©lulas musculares, sin convertirse en creatinina.', 23.40, 10, NULL, '2020-06-05', 'mega-creatina-alkaline.jpg'),
(164, 4, 'CARBONIZER', 'Carbonizer XR de Olimp Sport es un suplemento en polvo con una increÃ­ble fÃ³rmula compuesta de varios carbohidratos combinados, elaborada especialmente para atletas y personas fÃ­sicamente activas, ya que te proporciona un aporte continuo de nutrientes que te darÃ¡ un mayor rendimiento a la hora de entrenar, proporcionÃ¡ndote la energÃ­a que tanto necesitas.', 8.50, 10, NULL, '2020-06-05', 'carbonizer-xr.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `imagen` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=293 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `fecha`, `imagen`) VALUES
(118, 'admin', 'admin', 'admin@admin.es', '$2y$04$3lkCy80wtBYhwYpUZsFAku9ZmT1a.SXyKqsf/cY/qH94A57wlFpe2', 'admin', '2020-05-08', NULL),
(292, 'Manuel', 'Rodriguez', 'manuel@manuel.es', '$2y$04$5ZBwWDm4lJWWnvZA7D3x/.WycFOj0gr36XGOBq3opzXOIunQeWBse', 'user', '2020-06-16', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD CONSTRAINT `fk_linea_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_linea_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
