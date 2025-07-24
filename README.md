# Fullstack Product Management App (Laravel + Vue.js)


## Requisitos

- PHP 8.0+
- Composer
- Node.js 16+
- MySQL 5.7+
- Git

## Endpoints


- php artisan serve --port=8000 // servidor backend
- API: http://localhost:8000

- npm run dev // servidor frontend
- Frontend: http://localhost:3000


## Método	Endpoint	Descripción
- GET	/api/products	Obtener todos los productos
- POST	/api/products	Crear nuevo producto
- GET	/api/products/{id}	Obtener producto específico
- PUT	/api/products/{id}	Actualizar producto
- DELETE	/api/products/{id}	Eliminar producto


- Ejemplo de petición POST:
- curl -X POST http://localhost:8000/api/products \
  -H "Content-Type: application/json" \
  -d '{"name":"Teclado","price":59.99,"stock":50}'

