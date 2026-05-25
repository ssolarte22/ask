-- Datos iniciales para el proyecto principal

INSERT INTO tv_cursos (slug, titulo, descripcion, contenido, orden) VALUES
  (
    'curso-1',
    'Curso Docente 1: Introducción a la enseñanza de prompts',
    'Aprende a enseñar la creación de prompts desde cero, manteniendo una estructura clara y pedagógica.',
    'Contenido base para el curso 1.',
    1
  ),
  (
    'curso-2',
    'Curso Docente 2: Enseñanza avanzada de prompts',
    'Profundiza en la optimización de prompts y la evaluación crítica de resultados.',
    'Contenido base para el curso 2.',
    2
  )
ON DUPLICATE KEY UPDATE
  titulo = VALUES(titulo),
  descripcion = VALUES(descripcion),
  contenido = VALUES(contenido),
  orden = VALUES(orden);

INSERT INTO tv_herramientas_ia (nombre, descripcion, uso_educativo, precio, orden) VALUES
  ('Groq', 'Motor de texto para generar guiones y prompts.', 'Redacción de guiones educativos.', 'Plan gratuito / pago', 1),
  ('D-ID', 'Generación de videos con avatares parlantes.', 'Producción de videos explicativos.', 'Pago por uso', 2),
  ('ChatGPT', 'Asistente conversacional para ideas y contenido.', 'Apoyo a la escritura y planeación.', 'Gratis / Plus', 3)
ON DUPLICATE KEY UPDATE
  descripcion = VALUES(descripcion),
  uso_educativo = VALUES(uso_educativo),
  precio = VALUES(precio),
  orden = VALUES(orden);
