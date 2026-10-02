# Library PHP v4 - Sistema de Control Bibliotecario (Modernizado 2026)

**Library 2** es una solución moderna para la administración de bibliotecas públicas, escolares y privadas. Permite gestionar el acervo bibliográfico (libros, autores, editoriales, categorías temáticas), ejemplares físicos numerados, lectores/socios de biblioteca, préstamos con control de vencimiento y devoluciones oportunas.

---

## 🛠️ Stack Tecnológico Moderno

- **PHP 8.2+**: Modelos con sentencias preparadas PDO y propiedades declaradas (cero avisos de depreciación).
- **Arquitectura MVC Limpia**: Separación estricta entre Modelos, Servicios, Controladores y Vistas.
- **Ruteo**: FastRoute (`core/app/routes.php`) con URLs semánticas limpias.
- **Motor de Plantillas**: Twig 3 con herencia modular y filtros avanzados.
- **Frontend**: Bootstrap 5, Bootstrap Icons, SweetAlert2 y estilos optimizados con tablas condensadas (`table-sm`) y botones chicos (`btn-xs`).

---

## 🚀 Requisitos e Instalación

1. **Requisitos**: Servidor Apache con `mod_rewrite` habilitado, PHP 8.0+ y MySQL / MariaDB.
2. **Base de Datos**:
   - Crear la base de datos `library2`.
   - Importar el archivo `schema.sql`:
     ```sql
     mysql -u root -p library2 < schema.sql
     ```
3. **Credenciales por Defecto**:
   - **Usuario**: `admin`
   - **Contraseña**: `admin`

---

## 🗺️ Mapa de Rutas Principales

| Método | Ruta | Descripción |
|---|---|---|
| `GET` | `/` ó `/home` | Dashboard con métricas y préstamos en curso |
| `GET` | `/books` | Catálogo general de libros |
| `GET` | `/books/new` | Registro de nuevo libro |
| `GET` | `/books/{id}/items` | Gestión de copias/ejemplares físicos |
| `GET` | `/loans` | Listado general de préstamos y devoluciones |
| `GET` | `/loans/new` | Registro de nuevo préstamo de ejemplar |
| `GET` | `/loans/return/{id}` | Devolución de libro prestado |
| `GET` | `/clients` | Directorio de lectores y socios |
| `GET` | `/authors` | Catálogo de autores |
| `GET` | `/editorials` | Catálogo de editoriales |
| `GET` | `/categories` | Catálogo de géneros y categorías temáticas |
| `GET` | `/users` | Gestión de bibliotecarios y administradores |
| `GET` | `/login` / `/logout` | Autenticación de sesiones |