<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# Medical Appointment App
A basic Laravel application designed to manage medical appointments, streamline scheduling, and organize doctor-patient interactions efficiently.

### Key Features:
* **Patient Management:** Easily register and maintain patient records.
* **Appointment Scheduling:** Book, track, and manage medical consultations.
* **Doctor Directory:** Manage medical staff, specialties, and availability.

---

## ✅ Hitos Implementados

Se han completado las fases iniciales de configuración y estructuración del sistema:

### Issue 1 — Configuración Inicial del Proyecto
Se ajustaron los parámetros base del entorno para alinearlos con el mercado local y asegurar la persistencia de datos.
* **Idioma:** Se estableció el lenguaje por defecto en español (`es`) en `config/app.php`.
* **Zona Horaria:** Configurada correctamente (ej. `America/Merida`).
* **Base de Datos:** Conexión MySQL establecida mediante el archivo `.env`.
* **Migraciones:** Se ejecutó `php artisan migrate` con éxito, preparando la estructura inicial de tablas.

### Issue 2 — Rutas y Vista de Administración
Se habilitó el área de gestión para el perfil de administrador.
* **Rutas:** Creación y verificación de la ruta `/admin`.
* **Controladores:** Implementación del `AdminController` para centralizar la lógica de administración.
* **Interfaz:** Generación de la vista básica administrativa, confirmando su acceso y renderizado correcto.

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
