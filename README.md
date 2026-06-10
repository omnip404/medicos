# Medicos — Directorio de Medicos

> Aplicacion web CRUD para registro y gestion de medicos.
> Construida con Laravel 12, desplegada en InfinityFree (MySQL) con alternativa en Render (PostgreSQL + Docker).

---

## Stack Tecnologico

| Componente | Tecnologia |
|------------|-----------|
| Framework | Laravel 12 |
| PHP | ^8.2 |
| Base de datos (produccion) | MySQL (InfinityFree) |
| Base de datos (alternativa) | PostgreSQL (Render / Railway) |
| Frontend | Blade + Tailwind CSS 4 |
| Build de assets | Vite 7 |
| Servidor local | `php artisan serve` |
| Servidor Docker | PHP 8.3-cli + `php artisan serve` |

---

## Funcionalidades

| Metodo | URI | Accion | Nombre de ruta |
|--------|-----|--------|----------------|
| GET | `/` | Redirige a `/medicos` | — |
| GET | `/medicos` | Lista todos los medicos | `medicos.index` |
| GET | `/medicos/create` | Muestra formulario de registro | `medicos.create` |
| POST | `/medicos` | Guarda un nuevo medico | `medicos.store` |
| GET | `/medicos/{id}` | Muestra detalle de un medico | `medicos.show` |
| DELETE | `/medicos/{id}` | Elimina un medico | `medicos.destroy` |

La aplicacion permite:
- **Listar** todos los medicos registrados en una tabla con foto y acciones
- **Ver detalle** completo de un medico (nombre, especialidad, fecha de nacimiento, anio de titulacion, celular, foto)
- **Crear** un nuevo medico mediante formulario
- **Eliminar** un medico existente

> **Nota:** No incluye autenticacion, edicion (update), busqueda, paginacion ni soft deletes.

---

## Requisitos

- PHP ^8.2
- Composer
- Node.js 18+ y npm
- MySQL o PostgreSQL

---

## Instalacion local

```bash
# 1. Clonar el repositorio
git clone <repo-url>
cd medicos

# 2. Instalar dependencias PHP
composer install

# 3. Instalar y compilar assets frontend
npm install
npm run build

# 4. Configurar entorno
cp .env.example .env
# Editar .env con las credenciales de tu base de datos

# 5. Generar APP_KEY
php artisan key:generate

# 6. Ejecutar migraciones y seeders
php artisan migrate --seed

# 7. Iniciar servidor de desarrollo
php artisan serve
```

La aplicacion estara disponible en `http://localhost:8000`.

Los seeders incluyen 3 medicos de ejemplo:
- Dra. Carolina Mendoza Lopez — Cardiologia
- Dr. Andres Felipe Ramirez Gil — Neurologia
- Dr. Ricardo Jose Torres Mejia — Pediatria

---

## Base de datos

### Tabla: `medicos`

| Columna | Tipo | Restricciones |
|---------|------|---------------|
| `id` | bigint unsigned | PRIMARY KEY, auto increment |
| `nombre` | varchar(100) | NOT NULL |
| `especialidad` | varchar(100) | NOT NULL |
| `fnac` | date | NOT NULL |
| `aniotituto` | integer | NOT NULL |
| `celular` | varchar(15) | UNIQUE, NOT NULL |
| `foto` | varchar(255) | NULLABLE |
| `created_at` | timestamp | NULLABLE |
| `updated_at` | timestamp | NULLABLE |

### Modelo Eloquent: `App\Models\Medicos`

```php
protected $fillable = ['nombre', 'especialidad', 'fnac', 'aniotituto', 'celular', 'foto'];
```

### Otras tablas

El proyecto incluye las tablas por defecto de Laravel: `users`, `password_reset_tokens`, `sessions`, `cache`, `cache_locks`, `jobs`, `job_batches`, `failed_jobs`.

---

## Pruebas

```bash
php artisan test
```

Actualmente incluye 3 tests funcionales en `tests/Feature/MedicosDeleteTest.php`:

| Test | Descripcion |
|------|-------------|
| `test_destroy_removes_medico_and_redirects` | Elimina un medico y redirige al index |
| `test_destroy_returns_404_for_nonexistent_id` | Retorna 404 para ID inexistente |
| `test_destroy_with_post_method` | Eliminacion via POST con `_method=DELETE` |

---

## Despliegue — Render

Render permite desplegar la aplicacion usando Docker + PostgreSQL.

### Arquitectura

```
Codigo → Dockerfile → Render Web Service
                         + PostgreSQL externa
                         + Variables de entorno
```

### Dockerfile de ejemplo

Crea un archivo `Dockerfile` (o usa `Dockerfile.example` como referencia) con el siguiente contenido:

```dockerfile
FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN echo "APP_DEBUG=false" > .env && \
    echo "APP_KEY=" >> .env && \
    echo "DB_CONNECTION=pgsql" >> .env && \
    echo "DB_HOST=$DB_HOST" >> .env && \
    echo "DB_PORT=$DB_PORT" >> .env && \
    echo "DB_DATABASE=$DB_DATABASE" >> .env && \
    echo "DB_USERNAME=$DB_USERNAME" >> .env && \
    echo "DB_PASSWORD=$DB_PASSWORD" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    composer install --no-dev --optimize-autoloader && \
    php artisan key:generate --force && \
    chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

### Pre-deploy checklist

- [ ] `APP_KEY` generado (el Dockerfile lo hace automaticamente si esta vacio)
- [ ] `DB_CONNECTION=pgsql` en .env
- [ ] Variables de entorno configuradas en Render:
  - `DB_HOST` — host interno de la base de datos PostgreSQL en Render
  - `DB_PORT` — normalmente `5432`
  - `DB_DATABASE` — nombre de la base de datos
  - `DB_USERNAME` — usuario
  - `DB_PASSWORD` — contrasena
- [ ] `SESSION_DRIVER=file` con directorio `storage/framework/sessions` (el Dockerfile ya aplica `chmod -R 777 storage`)
- [ ] Permisos: `chmod -R 777 storage bootstrap/cache` (con espacio, no coma)
- [ ] Puerto dinamico: `CMD` con `--port=$PORT`
- [ ] Probar build local: `docker build -t medicos . && docker run -p 8000:8000 medicos`

### Errores conocidos y soluciones

| Error | Causa | Solucion |
|-------|-------|----------|
| `MissingAppKeyException` | `APP_KEY` vacio o ausente | El Dockerfile incluye `php artisan key:generate --force` |
| `419 Page Expired` en POST | `SESSION_DRIVER=cookie` sin Set-Cookie correcto | Usar `SESSION_DRIVER=file` |
| SQLSTATE conexion rechazada | Render no inyecta `DATABASE_URL` automaticamente en Docker | Escribir cada variable de entorno una por una en .env dentro del Dockerfile |
| Error 500 generico | `APP_DEBUG=false` oculta detalles | Temporal: cambiar a `APP_DEBUG=true` para diagnosticar |
| Build falla por permisos | `chmod` con coma entre rutas | Usar espacio: `chmod -R 777 storage bootstrap/cache` |

### Debug remoto

```bash
# Verificar que la app responde
curl -v https://<tu-app>.onrender.com/

# Probar creacion de medico via POST
curl -v -X POST https://<tu-app>.onrender.com/medicos \
  -d "nombre=Dr+Test&especialidad=General&fnac=1980-01-01&aniotituto=2005&celular=3001112233"

# Probar con cookies (para evitar 419)
curl -v -c cookies.txt -b cookies.txt https://<tu-app>.onrender.com/
```

---

## Despliegue — InfinityFree (produccion actual)

La aplicacion esta actualmente desplegada en InfinityFree con MySQL.

- **URL:** `https://choqueluis.infinityfreeapp.com`
- **Base de datos:** MySQL en `sql100.infinityfree.com`
- **Subida:** Manual via FTP / panel de control
- **Configuracion:** Las credenciales estan en `.env` (no versionado)

Para replicar:
1. Exportar la base de datos local
2. Subir archivos via FTP a InfinityFree
3. Importar la base de datos desde el panel
4. Configurar `.env` con las credenciales de InfinityFree

---

## Despliegue — Railway (alternativa)

Railway tambien esta configurado como alternativa mediante Nixpacks.

Archivo `railway.json`:
```json
{
    "build": {
        "builder": "NIXPACKS"
    },
    "deploy": {
        "startCommand": "php artisan serve --host=0.0.0.0 --port=$PORT",
        "restartPolicyType": "ON_FAILURE",
        "restartPolicyMaxRetries": 10
    }
}
```

---

## Seguridad

> **Importante:** El `Dockerfile` actual contiene credenciales de base de datos hardcodeadas.
> Este archivo esta incluido en `.gitignore` para evitar exposicion accidental en el repositorio.
>
> **En produccion cloud,** usa siempre variables de entorno en lugar de credenciales fijas en el codigo.
> Render, Railway y otras plataformas permiten configurar variables secretas desde el panel.

Archivos no versionados (en `.gitignore`):
- `.env` — entorno local
- `Dockerfile` — credenciales hardcodeadas
- `node_modules/`, `vendor/`, `public/build/`

Para referencia publica, usa `Dockerfile.example` (sin credenciales) y `.env.example`.

---

## Estructura del proyecto

```
medicos/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Controller.php
│   │       └── MedicosController.php
│   ├── Models/
│   │   ├── Medicos.php
│   │   └── User.php
│   └── Providers/
│       └── AppServiceProvider.php
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   │   └── MedicosFactory.php
│   ├── migrations/
│   │   └── 2026_05_31_002607_create_medicos_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── public/
│   └── build/                 # Assets compilados por Vite
├── resources/
│   └── views/
│       ├── index.blade.php    # Lista de medicos
│       ├── create.blade.php   # Formulario de registro
│       ├── show.blade.php     # Detalle de medico
│       └── welcome.blade.php  # Landing page
├── routes/
│   └── web.php                # Definicion de rutas
├── storage/
├── tests/
│   └── Feature/
│       └── MedicosDeleteTest.php
├── Dockerfile                  # Credenciales reales (ignorado por git)
├── Dockerfile.example          # Referencia publica sin credenciales
├── railway.json                # Config para Railway
├── composer.json
├── package.json
└── vite.config.js
```

---

## Licencia

MIT
