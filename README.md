# 🛒 DibujitoStore

DibujitoStore es un proyecto de comercio electrónico desarrollado como uno de mis primeros proyectos de desarrollo web.

El objetivo principal del proyecto fue poner en práctica conceptos fundamentales como desarrollo frontend, programación backend, conexión con bases de datos, autenticación de usuarios y operaciones CRUD.

> ⚠️ **Estado del proyecto:** En desarrollo / proyecto académico.
> Al tratarse de uno de mis primeros proyectos, existen partes de la arquitectura y del código que actualmente podrían ser mejoradas o refactorizadas.

---

## 📖 Descripción

DibujitoStore es una tienda virtual que permite mostrar y administrar productos mediante una aplicación web conectada a una base de datos MySQL.

El proyecto comenzó siendo desarrollado principalmente con **PHP sin una arquitectura basada en frameworks**, utilizando HTML, CSS y JavaScript para la interfaz.

Posteriormente se empezó a incorporar **Laravel** con el objetivo de mejorar la organización del backend y aplicar una arquitectura más estructurada.

Este proyecto representa principalmente mi proceso de aprendizaje durante mis primeras experiencias desarrollando aplicaciones web completas.

---

## 🚀 Funcionalidades

Entre las principales funcionalidades desarrolladas se encuentran:

* Visualización de productos.
* Catálogo de productos.
* Búsqueda de productos.
* Gestión de categorías.
* Registro de usuarios.
* Inicio de sesión.
* Manejo de sesiones.
* Carrito de compras.
* Gestión de productos.
* Registro de ventas.
* Operaciones CRUD conectadas a MySQL.
* Administración de información almacenada en la base de datos.

Algunas funcionalidades todavía pueden encontrarse incompletas o pendientes de mejora.

---

## 🛠️ Tecnologías utilizadas

### Frontend

* HTML5
* CSS3
* JavaScript

### Backend

* PHP
* Laravel

### Base de datos

* MySQL

### Herramientas

* Git
* GitHub
* Composer
* XAMPP / servidor Apache
* phpMyAdmin

---

## 📂 Estructura general del proyecto

```text
DibujitoStore-web/
│
├── laravel_core/
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── tests/
│   ├── artisan
│   ├── composer.json
│   └── ...
│
├── public_html/
│   ├── css/
│   ├── iconos/
│   ├── imagenes/
│   ├── js/
│   ├── index.php
│   └── ...
│
└── u925143271_TiendaDibujito.sql
```

`public_html` contiene los archivos públicos utilizados por la aplicación web, mientras que `laravel_core` contiene la estructura correspondiente a Laravel.

El archivo `.sql` contiene la estructura y datos necesarios para reconstruir la base de datos utilizada por el proyecto.

---

## ⚙️ Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/Nilton-Clemente/DibujitoStore-web.git
```

Luego ingresar al proyecto:

```bash
cd DibujitoStore-web
```

---

### 2. Configurar la base de datos

Crear una base de datos MySQL e importar el archivo:

```text
u925143271_TiendaDibujito.sql
```

Puede utilizarse phpMyAdmin, MySQL Workbench o la terminal de MySQL.

---

### 3. Configurar Laravel

Ingresar a:

```bash
cd laravel_core
```

Instalar las dependencias:

```bash
composer install
```

Crear el archivo `.env` utilizando `.env.example`:

```bash
copy .env.example .env
```

En Linux/macOS:

```bash
cp .env.example .env
```

Generar la clave de Laravel:

```bash
php artisan key:generate
```

Finalmente, configurar las credenciales de MySQL dentro del archivo `.env`.

Ejemplo:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=root
DB_PASSWORD=
```

---

## 📚 Objetivos de aprendizaje

Este proyecto fue desarrollado principalmente para aprender y practicar:

* Desarrollo de aplicaciones web.
* Comunicación entre frontend y backend.
* Programación con PHP.
* JavaScript para interacción del usuario.
* Manejo de bases de datos relacionales.
* Consultas SQL.
* Operaciones CRUD.
* Autenticación y sesiones.
* Organización de proyectos web.
* Uso de Git y GitHub.
* Conceptos básicos de arquitectura web.
* Introducción posterior al uso de frameworks como Laravel.

---

## 🔧 Aspectos por mejorar

Debido a que fue uno de mis primeros proyectos, existen varios aspectos que podrían mejorarse en futuras versiones:

* Refactorización del código.
* Separación más clara entre frontend y backend.
* Mejor aplicación de patrones de arquitectura.
* Migración completa del backend a Laravel.
* Mejor organización de archivos y responsabilidades.
* Validaciones más robustas.
* Mejora de la seguridad.
* Mejor manejo de errores.
* Diseño responsive.
* Pruebas automatizadas.
* Documentación de endpoints y funcionalidades.

Estas limitaciones se mantienen en el repositorio también como referencia de mi progreso y aprendizaje como desarrollador.

---

## 📌 Estado

🟡 **En desarrollo**

El proyecto no se encuentra completamente terminado y puede contener funcionalidades experimentales o código pendiente de refactorización.

---

## 👨‍💻 Autor

**Nilton Clemente**

Proyecto desarrollado como parte de mi aprendizaje en desarrollo de software.

GitHub: [Nilton-Clemente](https://github.com/Nilton-Clemente)
