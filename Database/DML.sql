# Estado
INSERT INTO `st_estado` (`id_estado`, `nombre_estado`, `fechaCreacion_estado`) VALUES
(1, 'Activo',     '2023-08-13 22:00:00'),
(2, 'Inactivo',   '2023-08-13 22:00:00');


# Rol
INSERT INTO `st_rol` (`id_rol`, `nombre_rol`, `fechaCreacion_rol`) VALUES
(1, 'Usuario',       '2023-08-13 22:00:00'),
(2, 'Administrador', '2023-08-13 22:00:00');


# Pais
INSERT INTO `st_pais` (`id_pais`, `nombre_pais`, `abreviatura_pais`, `prefijo_pais`, `fechaCreacion_pais`, `id_estado`) VALUES
(1, 'Ninguno', 	      '-',   '+0',   '2023-08-13 22:00:00', 1),
(2, 'Ecuador',        'EC',  '+593', '2023-08-13 22:00:00', 1);


# Usuario
INSERT INTO `st_usuario` (`id_usuario`, `nombre_usuario`, `apellidoPaterno_usuario`, `apellidoMaterno_usuario`, `correo_usuario`, `password_usuario`, `sexo_usuario`, `telefono_usuario`, `dni_usuario`, `id_pais`, `fechaCreacion_usuario`, `id_rol`, `id_estado`) VALUES
(1, 'Invitado', 'Sistema', 'Plataforma', 'Ninguno', '', '', 'Ninguno', 'Ninguno', 1, '2023-08-13 22:00:00', 1, 1),
(2, 'Admin', 'Sistema', 'Plataforma', 'admin@admin.com', '$2y$10$LAWmdUDeGaq9OUlqFPdF2.BX5IPV3SNueMrraQheJXbXON3wuvlHC', '', '+593900000000', '2222222222', 2, '2023-08-13 22:00:00', 2, 1);
