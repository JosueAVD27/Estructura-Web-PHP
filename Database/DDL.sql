--
-- Creación de tablas
--
#*** ***
CREATE TABLE `st_estado` (
  `id_estado` int(2) NOT NULL,
  `nombre_estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fechaCreacion_estado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `st_rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fechaCreacion_rol` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `st_pais` (
  `id_pais` int(11) NOT NULL,
  `nombre_pais` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `abreviatura_pais` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `prefijo_pais` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `fechaCreacion_pais` datetime DEFAULT NULL,
  `fechaDesactivacion_pais` datetime DEFAULT NULL,
  `id_estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `st_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoPaterno_usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoMaterno_usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `correo_usuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password_usuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `sexo_usuario` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_usuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `dni_usuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `foto_usuario` longblob DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `fechaCreacion_usuario` datetime DEFAULT NULL,
  `fechaDesactivacion_usuario` datetime DEFAULT NULL,
  `id_estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `st_notificacion` (
  `id_notificacion` int(11) NOT NULL,
  `icon_notificacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `titulo_notificacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje_notificacion` text NOT NULL,
  `btnNombre_notificacion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `btnFuncion_notificacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `grupo_notificacion` NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_usuario_destino` NOT NULL,
  `id_usuario_exclusion` NOT NULL,
  `fechaCreacion_notificacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE `st_archivo_notificacion` (
  `id_notificacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_archivoNotificacion` datetime DEFAULT NULL
);


--
-- Índices para tablas volcadas
--
#*** ***
ALTER TABLE `st_estado`
  ADD PRIMARY KEY (`id_estado`);


ALTER TABLE `st_rol`
  ADD PRIMARY KEY (`id_rol`);


ALTER TABLE `st_pais`
  ADD PRIMARY KEY (`id_pais`),
  ADD KEY `pais_estado` (`id_estado`);


ALTER TABLE `st_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `usuario_rol` (`id_rol`),
  ADD KEY `usuario_pais` (`id_pais`),
  ADD KEY `usuario_estado` (`id_estado`);


ALTER TABLE `st_notificacion`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `notificacion_rol` (`grupo_notificacion`),
  ADD KEY `notificacion_usuario` (`id_usuario`),
  ADD KEY `notificacion_usuarioDestino` (`id_usuario_destino`),
  ADD KEY `notificacion_usuarioExclusion` (`id_usuario_exclusion`);


ALTER TABLE `st_archivo_notificacion`
  ADD KEY `archivoNotificacion_notificacion` (`id_notificacion`),
  ADD KEY `archivoNotificacion_usuario` (`id_usuario`);



--
-- AUTO_INCREMENT
--
#*** ***
ALTER TABLE `st_estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `st_rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `st_pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `bf_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `st_notificacion`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;


--
-- FOREIGN KEY
--
#*** ***
ALTER TABLE `st_pais`
  ADD CONSTRAINT `pais_estado` FOREIGN KEY (`id_estado`) REFERENCES `st_estado` (`id_estado`);


ALTER TABLE `st_usuario`
  ADD CONSTRAINT `usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `st_rol` (`id_rol`),
  ADD CONSTRAINT `usuario_pais` FOREIGN KEY (`id_pais`) REFERENCES `st_pais` (`id_pais`),
  ADD CONSTRAINT `usuario_estado` FOREIGN KEY (`id_estado`) REFERENCES `st_estado` (`id_estado`);


ALTER TABLE `st_notificacion`
  ADD CONSTRAINT `notificacion_rol` FOREIGN KEY (`grupo_notificacion`) REFERENCES `st_rol` (`id_rol`) ON DELETE CASCADE,
  ADD CONSTRAINT `notificacion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `st_usuario` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `notificacion_usuarioDestino` FOREIGN KEY (`id_usuario_destino`) REFERENCES `st_usuario` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `notificacion_usuarioExclusion` FOREIGN KEY (`id_usuario_exclusion`) REFERENCES `st_usuario` (`id_usuario`) ON DELETE CASCADE;


ALTER TABLE `st_archivo_notificacion`
  ADD CONSTRAINT `archivoNotificacion_notificacion` FOREIGN KEY (`id_notificacion`) REFERENCES `st_notificacion` (`id_notificacion`) ON DELETE CASCADE,
  ADD CONSTRAINT `archivoNotificacion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `st_usuario` (`id_usuario`) ON DELETE CASCADE;

