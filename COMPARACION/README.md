# Tutor IA — Colegio Mayor del Cauca

Plataforma educativa refactorizada con arquitectura limpia, MariaDB, API REST y accesibilidad WCAG.

## Estructura de carpetas

```
EntregaIA/
├── api/                    # API REST (JSON)
├── app/
│   ├── Config/             # Conexión PDO (pool singleton)
│   ├── Controllers/        # Lógica HTTP
│   ├── Middleware/         # Autenticación por rol
│   ├── Models/             # Acceso a datos
│   ├── Services/           # Reglas de negocio
│   └── Utils/              # Env, validación, vistas, respuestas
├── css/main.css            # Sistema de diseño unificado
├── database/               # schema.sql, seed.sql, install.php
├── views/
│   ├── components/         # Header, nav, footer
│   ├── layouts/            # Plantillas main y admin
│   └── pages/              # Vistas por sección
├── inc/                    # Layout legacy para páginas estáticas
├── bootstrap.php           # Carga de app y sesión
└── .env.example            # Variables de entorno
```

## Instalación MariaDB

1. Copiar `.env.example` a `.env` y configurar credenciales.
2. Iniciar MariaDB en XAMPP.
3. Ejecutar:

```bash
php database/install.php
```

O manualmente:

```bash
mysql -u root -p < database/schema.sql
php database/install.php
```

### Credenciales por defecto (tras install)

| Rol      | Usuario | Contraseña |
|----------|---------|------------|
| Admin    | admin   | admin123   |
| Docente  | 123     | admin      |

## API REST

Base: `/api/index.php`

| Método | URL | Descripción |
|--------|-----|-------------|
| GET | `?resource=docentes&action=list&page=1&per_page=10` | Lista paginada (requiere sesión admin) |
| POST | `?resource=docentes&action=create` | Crear docente (JSON body) |
| DELETE | `?resource=docentes&action=delete&id=1` | Eliminar docente (soft delete) |

Ejemplo:

```bash
curl -X POST "http://localhost/EntregaIA/api/index.php?resource=docentes&action=create" \
  -H "Content-Type: application/json" \
  -d '{"login":"nuevo","nombre":"Docente Nuevo","clave":"secreto123"}'
```

## Seguridad

- Contraseñas con `password_hash` / `password_verify`
- Consultas preparadas (PDO)
- Sanitización y validación en servidor
- Cookies de sesión `httponly` y `samesite=Lax`
- No exponer contraseñas en panel de configuración
- Archivo `.env` fuera de control de versiones

## Panel docente

Todas las rutas en `/docente/` usan layout unificado, navegación corregida y sesión protegida.

| Página | Descripción |
|--------|-------------|
| `homeDocente.php` | Inicio, checklist de tutoriales (localStorage) |
| `perfil.php` | Datos desde MariaDB |
| `formacion.php` | Módulos con acordeón accesible |
| `curso1.php` / `curso2.php` | Contenido desde BD, `.txt` o plantilla por defecto |
| `generarPrompts.php` | Groq API vía `.env` |
| `generarVideo.php` | D-ID API vía `.env` + límite diario |

**Importante:** configura las claves en `.env`:

| Variable | Servicio | Dónde obtenerla |
|----------|----------|-----------------|
| `GROQ_API_KEY` | Prompts (Groq) | https://console.groq.com/keys — formato `gsk_...` |
| `DID_API_KEY` | Videos (D-ID) | https://studio.d-id.com/ — **no** es la clave Groq |

### Si no funcionan los generadores

1. Verifica que exista `.env` en la raíz del proyecto (junto a `bootstrap.php`).
2. Reinicia Apache en XAMPP después de editar `.env`.
3. Comprueba cURL: en `php.ini` debe estar `extension=curl` sin comentario.
4. Prueba Groq desde consola: `c:\xampp\php\php.exe database\test-apis.php`
5. El video puede tardar 1–2 minutos; `max_execution_time` en PHP debe ser ≥ 120.

## Barra de accesibilidad flotante

Botón ♿ fijo en la esquina inferior derecha (todas las páginas). Incluye:

- Aumentar / disminuir / restablecer tamaño de texto
- Tema claro, oscuro o según sistema
- Alto contraste, escala de grises, subrayar enlaces
- Fuente legible, espaciado, interlineado
- Reducir animaciones
- Restablecer todo (guardado en `localStorage`)

## Rendimiento

- Una conexión PDO reutilizada (singleton)
- CSS único sin duplicados
- Paginación en listado de docentes
- Sin dependencias Composer innecesarias
