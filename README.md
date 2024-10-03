
## Instrucciones para Ejecutar la Aplicación

Requisitos
 -  PHP 8.1 o superior
 -  Composer
 - MySQL o cualquier otra base de datos compatible
 - Laravel 11.x

## Pasos para Configuración

1. Clonar el repositorio:
   ```bash
   git clone <URL-del-repositorio>
   cd <nombre-del-proyecto>
2. Instalar las dependencias
   ```bash
   composer install
3. Crear una copia del archivo de entorno .env:
   ```bash
   cp .env.example .env
4. Configurar las variables de entorno en el archivo .env (como la conexión a la base de datos).
5. Generar la clave de la aplicación:
   ```bash
   composer install
6. Ejecutar las migraciones de la base de datos:
   ```bash
   php artisan migrate


## Base de datos Manualmente

```javascript
CREATE DATABASE product_bd
```


```javascript
CREATE TABLE `products` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `price` DECIMAL(10, 2) NOT NULL,
  `stock` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

Si prefieres importar manualmente el script de la base de datos, lo encontrarás en la carpeta database/scripts con el nombre product_bd.sql.


## Probar la API

Para interactuar con la API, puedes usar herramientas como Postman. La URL base de la API es:

```javascript
http://127.0.0.1:8000/api
```

- Obtener la lista de productos:

```javascript
GET http://127.0.0.1:8000/api/products
```

- Crear un nuevo producto:

```javascript
POST http://127.0.0.1:8000/api/products
```


- Actualizar un producto:
```javascript
PATCH http://127.0.0.1:8000/api/products/{id}
```

- Eliminar un producto:
```javascript
DELETE http://127.0.0.1:8000/api/products/{id}
```

## Decisiones Tomadas Durante el Desarrollo

1. Estructura Simple con Laravel 11: Se decidió mantener la aplicación lo más simple posible para facilitar el manejo y asegurar que las operaciones CRUD de los productos funcionen correctamente. Laravel 11 fue elegido por sus mejoras en la gestión de APIs y su simplicidad.

2. Uso de Validaciones: Las validaciones de los productos se manejaron directamente dentro del controlador utilizando Validator::make. Esta decisión se tomó para no sobrecargar el proyecto con FormRequests dado que el objetivo es un desarrollo simple y funcional.

3. Respuestas JSON: Toda la interacción con la API devuelve respuestas en formato JSON para facilitar su consumo por parte de cualquier frontend o cliente que quiera consumir los datos. Se manejan tanto los errores como las respuestas de éxito con mensajes personalizados.

4. Exclusión de Pagos y Autenticación: No se implementaron sistemas de autenticación ni pagos ya que la prueba solo requiere el manejo básico de productos y no se considera necesario añadir capas de complejidad innecesarias.