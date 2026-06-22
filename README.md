# RekkoPHP

Aplicación web desarrollada en PHP que implementa un sistema completo de autenticación de usuarios junto con una plataforma de recomendaciones de anime.

El proyecto está construido siguiendo una arquitectura MVC propia, utilizando JWT para la gestión de sesiones, OAuth2 con GitHub, control de roles y persistencia mediante MySQL.

---

## Características

### Autenticación

- Registro de usuarios.
- Inicio de sesión mediante usuario y contraseña.
- Autenticación basada en JWT.
- Refresh Tokens persistentes.
- Recuperación de contraseña por correo electrónico.
- Protección mediante Google reCAPTCHA.
- Inicio de sesión con GitHub OAuth2.

### Gestión de usuarios

- Perfil de usuario.
- Configuración de perfil.
- Imagen de usuario.
- Control de permisos mediante roles.
- Panel de administración de usuarios.

### Recomendaciones

- Creación de recomendaciones de anime.
- Gestión de recomendaciones por usuario.
- Visualización de contenido compartido.

### Catálogo de anime

- Almacenamiento de información de animes.
- Consulta de datos asociados a cada anime.

---

## Tecnologías utilizadas

- PHP 8+
- MySQL
- JavaScript (ES6)
- HTML5
- CSS3
- JWT
- OAuth2
- PHPMailer
- Composer
- PHPStan

---

## Dependencias

Instalar las dependencias mediante Composer:

```bash
composer install
```

Dependencias principales:

```json
{
  "vlucas/phpdotenv": "^5.6",
  "firebase/php-jwt": "^6.11",
  "phpmailer/phpmailer": "^7.0"
}
```

---

## Estructura del proyecto

```text
RekkoPHP/
│
├── public/
│   ├── assets/
│   ├── js/
│   ├── styles/
│   └── index.php
│
├── src/
│   ├── app/
│   │   ├── auth/
│   │   └── exceptions/
│   │
│   ├── controller/
│   │
│   ├── helpers/
│   │
│   └── infraestructure/
│       ├── config/
│       ├── database/
│       ├── middleware/
│       ├── persistence/
│       └── routes/
│
├── composer.json
├── phpstan.neon
└── README.md
```

---

## Base de datos

El proyecto incluye el esquema SQL necesario en:

```text
src/infraestructure/database/schema.sql
```

Por defecto se utiliza la base de datos:

```sql
mardb
```

Configuración por defecto:

```php
return [
    "DBHOST" => "localhost",
    "DBUSER" => "root",
    "DBPASSWORD" => "",
    "DBNAME" => "mardb"
];
```

### Tablas principales

- users
- roles
- recomendations
- refresh_tokens
- oauth_accounts
- animes

También se incluye:

```text
src/infraestructure/database/default-data.sql
```

para cargar datos iniciales.

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd RekkoPHP
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Crear la base de datos

Ejecutar:

```sql
src/infraestructure/database/schema.sql
```

### 4. Configurar la conexión

Modificar:

```text
src/infraestructure/config/dbconfig.php
```

con los datos de tu entorno.

### 5. Ejecutar el servidor

```bash
php -S localhost:8000 -t public
```

Acceder desde:

```text
http://localhost:8000
```

---

## Arquitectura

El proyecto sigue una estructura MVC:

### Controllers

Gestionan las peticiones HTTP y coordinan la aplicación.

Ejemplos:

- AuthController
- LoginController
- RegisterController
- ProfileController
- AnimeController
- RecomendationController
- AdminController

### Services

Contienen la lógica de negocio.

- AuthService
- UserService
- AnimeService
- RecomendationService
- OAuthGitHubService

### Persistence

Implementa el acceso a datos mediante PDO.

### Middleware

- AuthMiddleware
- RequireRole

Permiten proteger rutas y controlar permisos.

---

## Seguridad

El proyecto incorpora:

- JWT Access Tokens.
- Refresh Tokens almacenados en base de datos.
- Contraseñas cifradas.
- Protección mediante roles.
- OAuth2 GitHub.
- Google reCAPTCHA.
- Middleware de autenticación.

---

## Desarrollo

Análisis estático con PHPStan:

```bash
vendor/bin/phpstan analyse
```

---

## Licencia

Este proyecto se distribuye bajo la licencia incluida en el archivo `LICENSE`.

###### BY: **[Eriquito00](https://github.com/Eriquito00)** and **[Wysper](https://github.com/WysperOtaku)**
