Elite Barber - Sistema de Gestión de Barbería
Sistema web desarrollado en Laravel para la gestión de una barbería, incluyendo administración de usuarios, roles, citas y estadísticas.

Descripción
Elite Barber es una aplicación web completa que permite gestionar una barbería con las siguientes funcionalidades:

Autenticación de usuarios con registro y login
Gestión de roles (admin, staff, client)
Gestión de usuarios con CRUD completo
Gestión de citas con sistema completo de reservas
Panel de administración con estadísticas y reportes
Interfaz pública para que los clientes agenden citas

Características Principales
Autenticación
Registro de nuevos usuarios
Login con validación
Logout seguro
Redirección automática según rol
Gestión de Roles
Admin: Acceso completo al sistema
Staff: Gestión de citas y servicios
Client: Agendamiento de citas y visualización de información personal

Gestión de Usuarios
Listado paginado de usuarios
Crear nuevos usuarios con asignación de rol
Editar información de usuarios
Activar/Desactivar usuarios (soft delete)

Gestión de Citas
Crear, editar, eliminar citas
Asignar barberos a citas
Estados: pendiente, confirmada, cancelada, completada
Servicios: corte, barba, combo
Requisitos
PHP >= 8.2
Composer
MySQL o PostgreSQL
Node.js y NPM (para assets)
Instalación
Clonar el repositorio
git clone https://github.com/tu-usuario/lionsbarber.git
cd lionsbarber
Instalar dependencias
composer install
npm install
Configurar el archivo .env
cp .env.example .env
php artisan key:generate
Editar el archivo .env con tus credenciales de base de datos:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=barber_db
DB_USERNAME=root
DB_PASSWORD=

Ejecutar migraciones y seeders
php artisan migrate --seed

Compilar assets (opcional)
npm run build

Iniciar el servidor
php artisan serve
La aplicación estará disponible en http://localhost:8000

Usuarios de Prueba
Después de ejecutar los seeders, puedes usar las siguientes credenciales:

Administrador
Email: admin@demo.com
Contraseña: password
Staff
Email: staff@demo.com
Contraseña: password
Cliente
Email: client@demo.com
Contraseña: password

Estructura del Proyecto
LionsBarber/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── CitaController.php
│   │   │   └── ProfileController.php
│   │   └── Middleware/
│   │       └── IsAdmin.php
│   └── Models/
│       ├── User.php
│       ├── Role.php
│       └── Cita.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── RoleSeeder.php
│       └── RolesAndUsersSeeder.php
├── resources/
│   └── views/
│       ├── admin/
│       ├── citas.blade.php
│       └── layouts/
└── routes/
    └── web.php
Tecnologías Utilizadas
Laravel 11: Framework PHP
Laravel Jetstream StarterKit: Autenticación
Tailwind CSS: Estilos
Alpine.js: Interactividad
Chart.js: Gráficas y estadísticas
SweetAlert2: Notificaciones
Funcionalidades Técnicas
Migraciones para todas las tablas
Seeders para datos iniciales (roles y usuarios de prueba)
Soft deletes para usuarios
Middleware de autenticación y autorización
Rutas organizadas con grupos y prefijos
Controladores tipo resource
Vistas Blade organizadas
Validación de formularios
Paginación en listados
Rutas Principales
Públicas
/ - Página de inicio
/citas - Agendar citas
/barberos - Ver barberos
/login - Iniciar sesión
/register - Registrarse
Administración (requiere autenticación y rol admin)
/admin/dashboard - Panel principal
/admin/users - Gestión de usuarios
/admin/citas - Gestión de citas
/admin/estadisticas - Estadísticas y reportes
Contribuir
Las contribuciones son bienvenidas. Por favor:

Fork el proyecto
Crea una rama para tu feature (git checkout -b feature/AmazingFeature)
Commit tus cambios (git commit -m 'Add some AmazingFeature')
Push a la rama (git push origin feature/AmazingFeature)
Abre un Pull Request