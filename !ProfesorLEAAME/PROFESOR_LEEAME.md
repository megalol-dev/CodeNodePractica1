# Sistema de Registro y Login

## Registro de usuario

El sistema de registro funciona de la siguiente manera:

1. El usuario introduce un nombre y una contraseña.
2. Se valida que ambos campos estén rellenados.
3. La contraseña se encripta utilizando `password_hash()` antes de almacenarse.
4. Se intenta insertar el usuario en la base de datos SQLite.
5. El campo `nombre` está definido como `UNIQUE`, por lo que no pueden existir dos usuarios con el mismo nombre.
6. Si el nombre ya existe, se muestra un mensaje informativo.
7. Si todo es correcto, el usuario se crea correctamente.

Esto garantiza:
- No hay nombres duplicados.
- Las contraseñas no se guardan en texto plano.
- Existe validación básica de datos.

---

## Inicio de sesión

El login funciona así:

1. El usuario introduce nombre y contraseña.
2. Se validan los campos.
3. Se busca el usuario en la base de datos.
4. Se verifica la contraseña con `password_verify()`.
5. Si es correcta, se crea una sesión y se redirige a la zona privada.
6. Si no, se muestra el mensaje correspondiente.

La zona privada está protegida mediante comprobación de sesión.

---

## Enfoque del proyecto

Entré a la reunión de Discord aproximadamente 5 minutos tarde, pero según entendí, la idea es continuar el proyecto y hacerlo escalable.

Me gustaría, si es posible y tengo el visto bueno para las prácticas, ir desarrollando un pequeño juego web tipo RPG muy simple. La idea sería integrar progresivamente los conceptos que se vayan viendo en clase dentro del propio juego.

Si este enfoque no es adecuado para las prácticas, no habría ningún problema en adaptarme exactamente a lo que se pida.

Gracias.

