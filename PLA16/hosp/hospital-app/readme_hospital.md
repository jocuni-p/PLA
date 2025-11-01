# Plataforma Hospital - Gestión de Pacientes

Aplicación web SPA (Single Page Application) desarrollada con Laravel para la gestión completa de pacientes de un hospital. Permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre la base de datos de pacientes de forma dinámica en una única página.

## 📋 Descripción del Proyecto

Esta plataforma permite gestionar el alta, consulta, modificación y baja de pacientes de un hospital. Todas las operaciones se realizan de manera dinámica mediante la carga de componentes, siguiendo el modelo de diseño SPA (Single Page Application).

### Funcionalidades Principales

- **Alta de Pacientes**: Registro de nuevos pacientes con validación de datos
- **Consulta de Pacientes**: Visualización de todos los pacientes con filtro por apellido
- **Detalle de Paciente**: Consulta detallada de la información de un paciente específico
- **Modificación de Pacientes**: Actualización de datos de pacientes existentes
- **Baja de Pacientes**: Eliminación de pacientes del sistema

## 🚀 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- **PHP** >= 8.0
- **Composer** (gestor de dependencias de PHP)
- **MySQL** o **MariaDB**
- **XAMPP** (opcional, recomendado para entorno local)
- **Git** (para clonar el repositorio)

## 📦 Instalación

### 1. Clonar el Repositorio

```bash
git clone <url-del-repositorio>
cd hospital
```

### 2. Instalar Dependencias

```bash
composer install
```

### 3. Configurar Variables de Entorno

Copia el archivo `.env.example` y renómbralo como `.env`:

```bash
cp .env.example .env
```

Edita el archivo `.env` y configura los siguientes parámetros de base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospital
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

APP_LOCALE=es
SESSION_DRIVER=file
```

### 4. Generar Clave de Aplicación

```bash
php artisan key:generate
```

### 5. Crear y Configurar la Base de Datos

#### Opción A: Usando XAMPP

1. Inicia **XAMPP** y activa los servicios de **Apache** y **MySQL**
2. Accede a **phpMyAdmin** (http://localhost/phpmyadmin)
3. Crea una nueva base de datos llamada `hospital`
4. Importa el archivo SQL proporcionado `bbdd/hospital.sql`

#### Opción B: Usando MySQL desde terminal

```bash
mysql -u root -p
CREATE DATABASE hospital;
USE hospital;
SOURCE ruta/al/archivo/hospital.sql;
EXIT;
```

### 6. Verificar la Tabla Paciente

La base de datos debe contener la tabla `paciente` con la siguiente estructura:

- `idpaciente` (INT, Primary Key, Auto Increment)
- `nif` (VARCHAR, Unique)
- `nombre` (VARCHAR)
- `apellidos` (VARCHAR)
- `fechaingreso` (DATE)
- `fechaalta` (DATE, Nullable)

## ▶️ Ejecutar la Aplicación

Para iniciar el servidor de desarrollo de Laravel, ejecuta:

```bash
php artisan serve
```

La aplicación estará disponible en: **http://localhost:8000**

### Usando XAMPP

Alternativamente, puedes usar XAMPP:

1. Copia la carpeta del proyecto en `C:\xampp\htdocs\`
2. Inicia Apache y MySQL desde el panel de control de XAMPP
3. Accede a la aplicación desde: **http://localhost/hospital/public**

## 🏗️ Estructura del Proyecto

```
hospital/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── PacienteController.php    # Operaciones CRUD
│   │       └── VistasController.php      # Carga de vistas
│   └── Models/
│       └── Paciente.php                  # Modelo Eloquent
├── resources/
│   ├── views/
│   │   ├── layout.blade.php             # Plantilla base
│   │   ├── home.blade.php               # Vista de inicio
│   │   ├── alta.blade.php               # Formulario de alta
│   │   ├── consulta.blade.php           # Tabla de consulta
│   │   └── mantenimiento.blade.php      # Formulario de mantenimiento
│   └── lang/
│       └── es/
│           └── validation.php           # Mensajes en español
├── routes/
│   └── web.php                          # Definición de rutas
├── public/
│   └── assets/
│       ├── css/                         # Hojas de estilo
│       └── img/                         # Imágenes
└── .env                                 # Variables de entorno
```

## 🛣️ Rutas Principales

| Método | Ruta | Acción | Descripción |
|--------|------|--------|-------------|
| GET | `/` | home | Vista inicial |
| GET | `/alta` | alta | Formulario de alta |
| GET | `/consulta` | consulta | Tabla de pacientes |
| GET | `/mantenimiento` | mantenimiento | Formulario de mantenimiento |
| GET | `/pacientes` | consultapacientes | Consulta todos los pacientes |
| GET | `/pacientes/{id}` | consultapaciente | Consulta un paciente |
| POST | `/pacientes` | alta | Alta de paciente |
| PUT | `/pacientes/{id}` | modificacion | Modificar paciente |
| DELETE | `/pacientes/{id}` | baja | Baja de paciente |

## 🎯 Validaciones Implementadas

### Alta y Modificación

- **NIF**: Obligatorio y único en la base de datos
- **Nombre**: Obligatorio
- **Apellidos**: Obligatorio
- **Fecha de Ingreso**: Obligatoria
- **Fecha de Alta Médica**: Opcional

### Mensajes de Error

- Los mensajes de validación están personalizados en español
- Se muestran todos los errores de validación simultáneamente
- Se mantienen los datos del formulario en caso de error

## 🔧 Características Técnicas

### Framework y Herramientas

- **Laravel** (framework PHP)
- **Eloquent ORM** (para acceso a base de datos)
- **Blade** (motor de plantillas)
- **Bootstrap 5** (estilos CSS)
- **Validator** (validación de formularios)

### Patrón de Diseño

- **MVC** (Modelo-Vista-Controlador)
- **SPA** (Single Page Application)
- **RESTful** (nomenclatura REST para operaciones CRUD)

### Seguridad

- Protección **CSRF** en todos los formularios
- Validación de datos en servidor
- Sanitización de entradas de usuario
- Validación de unicidad para NIF

## 🔍 Funcionalidades Detalladas

### Alta de Pacientes

- Formulario completo con validación en tiempo real
- Mensaje de confirmación al completar el alta
- Los datos del paciente se mantienen en el formulario tras el alta exitosa

### Consulta de Pacientes

- Tabla con todos los pacientes ordenados por nombre y apellidos
- Filtro de búsqueda por apellido en tiempo real
- Botón "Detalle Paciente" para acceder a información completa
- Mensaje informativo si no hay datos

### Mantenimiento de Pacientes

- Consulta detallada de paciente seleccionado
- Modificación de datos con validación
- Detección de cambios (no permite guardar sin modificaciones)
- Eliminación de pacientes con confirmación
- Redirección automática tras baja exitosa

## ⚠️ Notas Importantes

- La tabla `paciente` no sigue las convenciones de Laravel, por lo que se especifica manualmente en el modelo
- El campo `idpaciente` es la clave primaria (no `id`)
- Los timestamps están desactivados en el modelo
- La validación de NIF único excluye el registro actual en modificaciones

## 🔮 Mejoras Futuras (No Implementadas)

- [ ] Paginación de resultados en consulta
- [ ] Exportación de datos a PDF/Excel
- [ ] Sistema de autenticación de usuarios
- [ ] Historial de cambios de pacientes
- [ ] Búsqueda avanzada con múltiples criterios

## 👨‍💻 Desarrollo

Este proyecto fue desarrollado como parte de la actividad académica "Aplicación SPA con Laravel" del curso de Desarrollo Web BackEnd.

## 📄 Licencia

Este proyecto es de uso educativo.

---

**Nota**: Asegúrate de tener configurado correctamente el archivo `.env` antes de ejecutar la aplicación. Si encuentras problemas, verifica que los servicios de MySQL/MariaDB estén activos y que las credenciales de acceso sean correctas.