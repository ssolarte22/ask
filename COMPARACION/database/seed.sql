USE entrega_ia;

INSERT INTO configuracion (clave, valor) VALUES
  ('limite_videos_dia', '5'),
  ('duracion_maxima', '10')
ON DUPLICATE KEY UPDATE valor = VALUES(valor);

-- Admin: usuario admin / contraseña admin123
INSERT INTO usuarios (login, nombre, password_hash, rol, videos_generados) VALUES
  ('admin', 'Administrador', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 0)
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre);

-- Docentes de ejemplo (contraseñas: admin, 45, yy)
INSERT INTO usuarios (login, nombre, password_hash, rol, videos_generados) VALUES
  ('123', 'Lalo cota', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'docente', 0),
  ('ela', 'Elsa Pito', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'docente', 0),
  ('2343rbhg', 'gbhnhntyhty', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'docente', 0)
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre);

INSERT INTO cursos (slug, titulo, descripcion, contenido, orden) VALUES
  ('curso-1', 'Prompts efectivos', 'Aprende a escribir instrucciones claras para IA.', NULL, 1),
  ('curso-2', 'Videos con avatar', 'Crea videos educativos con avatares docentes.', NULL, 2)
ON DUPLICATE KEY UPDATE titulo = VALUES(titulo);

INSERT INTO herramientas_ia (nombre, descripcion, uso_educativo, precio, orden) VALUES
  ('Veo 3.2 (Google)', 'Genera videos a partir de texto o imágenes.', 'Explicaciones científicas y líneas de tiempo visuales.', 'Gratis en AI Studio (limitado)', 1),
  ('Runway ML', 'Edición de video con IA.', 'Clips educativos y efectos visuales.', 'Plan de pago', 2),
  ('HeyGen', 'Avatares parlantes con IA.', 'Clases con docente virtual.', 'Freemium', 3),
  ('Synthesia', 'Videos con presentadores IA.', 'Microlearning y cápsulas.', 'De pago', 4)
ON DUPLICATE KEY UPDATE descripcion = VALUES(descripcion);
