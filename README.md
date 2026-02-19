# CodeNode Practica 1

## Descripción general

Este proyecto implementa un sistema básico de autenticación utilizando **PHP + SQLite**, con estructura preparada para escalar hacia un pequeño juego web tipo RPG.

El sistema incluye:

- Registro de usuario
- Inicio de sesión
- Control de sesión
- Protección de zona privada
- Estructura organizada (`public / app / data`)

---

## Funcionamiento del formulario de registro

El formulario de registro permite crear nuevos usuarios siguiendo este flujo:

1. El usuario introduce un nombre y una contraseña.
2. El servidor valida que los campos no estén vacíos.
3. La contraseña se encripta utilizando `password_hash()`.
4. Se intenta insertar el usuario en la base de datos SQLite.
5. El campo `nombre` está definido como `UNIQUE`, lo que impide que existan nombres duplicados.
6. Si el nombre ya existe, se muestra un mensaje de error.
7. Si el registro es correcto, se muestra un mensaje de confirmación.

Esto garantiza:
- No se permiten usuarios duplicados.
- Las contraseñas no se almacenan en texto plano.
- Existe validación básica en servidor.

---

## Funcionamiento del formulario de login

El inicio de sesión funciona de la siguiente manera:

1. El usuario introduce su nombre y contraseña.
2. Se comprueba que los campos estén rellenados.
3. Se busca el usuario en la base de datos.
4. Se verifica la contraseña con `password_verify()`.
5. Si las credenciales son correctas:
   - Se crea una sesión con `$_SESSION`.
   - Se redirige al usuario a la zona privada (`juego.php`).
6. Si las credenciales son incorrectas, se muestra el mensaje correspondiente.

---

## Protección de la zona privada

La página `juego.php` comprueba si existe una sesión activa:

- Si el usuario está autenticado, puede acceder.
- Si no hay sesión, es redirigido automáticamente a `index.php`.

Además, existe un sistema de cierre de sesión que destruye la sesión y devuelve al usuario a la pantalla de login.

---

## Estructura del proyecto

public/ → Archivos accesibles desde el navegador
app/ → Lógica del servidor (conexión a BD)
data/ → Base de datos SQLite


La base de datos no se sube al repositorio (protegida mediante `.gitignore`).

---

## Objetivo del proyecto

Este sistema de autenticación servirá como base para escalar el proyecto hacia un pequeño juego web tipo RPG, integrando progresivamente nuevas funcionalidades vistas en clase.
