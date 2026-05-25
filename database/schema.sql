-- Esquema inicial para el proyecto principal
-- Ejecutar junto con database/install.php

CREATE DATABASE IF NOT EXISTS ask_tutor
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE ask_tutor;

CREATE TABLE IF NOT EXISTS tv_usuarios (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  login VARCHAR(50) NOT NULL UNIQUE,
  nombre VARCHAR(120) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  rol ENUM('docente', 'admin') NOT NULL DEFAULT 'docente',
  videos_generados INT UNSIGNED NOT NULL DEFAULT 0,
  activo TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_tv_usuarios_rol (rol),
  INDEX idx_tv_usuarios_activo (activo)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tv_configuracion (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  clave VARCHAR(80) NOT NULL UNIQUE,
  valor VARCHAR(255) NOT NULL,
  updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tv_cursos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(60) NOT NULL UNIQUE,
  titulo VARCHAR(150) NOT NULL,
  descripcion TEXT NOT NULL,
  contenido LONGTEXT NULL,
  orden TINYINT UNSIGNED NOT NULL DEFAULT 1,
  activo TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_tv_cursos_activo (activo)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tv_herramientas_ia (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(80) NOT NULL,
  descripcion TEXT NOT NULL,
  uso_educativo TEXT NOT NULL,
  precio VARCHAR(120) NOT NULL,
  orden TINYINT UNSIGNED NOT NULL DEFAULT 1,
  activo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tv_docente_cursos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  docente_id INT UNSIGNED NOT NULL,
  nombre VARCHAR(120) NOT NULL,
  descripcion VARCHAR(255) NOT NULL DEFAULT '',
  activo TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_tv_docente_cursos_usuario FOREIGN KEY (docente_id) REFERENCES tv_usuarios(id) ON DELETE CASCADE,
  INDEX idx_tv_docente_cursos_docente (docente_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tv_docente_alumnos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  docente_id INT UNSIGNED NOT NULL,
  nombre VARCHAR(120) NOT NULL,
  cedula VARCHAR(40) NOT NULL,
  activo TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_tv_docente_alumnos_usuario FOREIGN KEY (docente_id) REFERENCES tv_usuarios(id) ON DELETE CASCADE,
  UNIQUE KEY uq_tv_docente_alumno_cedula (docente_id, cedula),
  INDEX idx_tv_docente_alumnos_docente (docente_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tv_docente_curso_alumnos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  docente_id INT UNSIGNED NOT NULL,
  curso_id INT UNSIGNED NOT NULL,
  alumno_id INT UNSIGNED NOT NULL,
  activo TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_tv_docente_curso_alumnos_usuario FOREIGN KEY (docente_id) REFERENCES tv_usuarios(id) ON DELETE CASCADE,
  CONSTRAINT fk_tv_docente_curso_alumnos_curso FOREIGN KEY (curso_id) REFERENCES tv_docente_cursos(id) ON DELETE CASCADE,
  CONSTRAINT fk_tv_docente_curso_alumnos_alumno FOREIGN KEY (alumno_id) REFERENCES tv_docente_alumnos(id) ON DELETE CASCADE,
  UNIQUE KEY uq_tv_docente_curso_alumno (docente_id, curso_id, alumno_id),
  INDEX idx_tv_docente_curso_alumnos_docente (docente_id),
  INDEX idx_tv_docente_curso_alumnos_curso (curso_id),
  INDEX idx_tv_docente_curso_alumnos_alumno (alumno_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tv_docente_temas (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  docente_id INT UNSIGNED NOT NULL,
  curso_id INT UNSIGNED NOT NULL,
  nombre VARCHAR(120) NOT NULL,
  descripcion VARCHAR(255) NOT NULL DEFAULT '',
  orden TINYINT UNSIGNED NOT NULL DEFAULT 1,
  activo TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_tv_docente_temas_usuario FOREIGN KEY (docente_id) REFERENCES tv_usuarios(id) ON DELETE CASCADE,
  CONSTRAINT fk_tv_docente_temas_curso FOREIGN KEY (curso_id) REFERENCES tv_docente_cursos(id) ON DELETE CASCADE,
  UNIQUE KEY uq_tv_docente_tema (docente_id, curso_id, nombre),
  INDEX idx_tv_docente_temas_docente (docente_id),
  INDEX idx_tv_docente_temas_curso (curso_id)
) ENGINE=InnoDB;

CREATE OR REPLACE VIEW vw_tv_docente_curso_alumnos_detalle AS
SELECT
  rel.id,
  rel.docente_id,
  u.nombre AS docente_nombre,
  u.login AS docente_login,
  rel.curso_id,
  c.nombre AS curso_nombre,
  rel.alumno_id,
  a.nombre AS alumno_nombre,
  a.cedula AS alumno_cedula,
  rel.activo,
  rel.created_at,
  rel.updated_at
FROM tv_docente_curso_alumnos rel
INNER JOIN tv_usuarios u ON u.id = rel.docente_id
INNER JOIN tv_docente_cursos c ON c.id = rel.curso_id
INNER JOIN tv_docente_alumnos a ON a.id = rel.alumno_id;
