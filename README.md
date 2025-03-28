# 1. Archivos Blade (vistas)

## 1.1. `create.blade.php`
- Formulario para crear nuevos animales.

## 1.2. `index.blade.php`
- Lista principal de animales.

## 1.3. `login.blade.php`
- Vista de inicio de sesión.

## 1.4. `banner.blade.php`
- Parte superior (header o banner) de la aplicación para incluir enlaces de acceso rápido (login, logout, registro, etc.) y para mostrar mensajes de bienvenida o notificaciones.

## 1.5. `app.blade.php`
- Estructura principal del layout, incluyendo secciones para scripts, estilos y zonas dinámicas de contenido.  
- Tuve que resolver temas de compatibilidad para que todo funcionara correctamente en distintas páginas.

---

# 2. Rutas

## 2.1. `web.php`
- Aquí defino las rutas de la aplicación, de login, registro, recuperación de contraseña y CRUD de animales.

---

# 3. Controladores

## 3.1. `LoginControllers.php`
- Ahí guardo la lógica del recaptcha. Número de intentos de inicio de sesión, key privada, key pública.

## 3.2. `AnimalController.php`
- Gestiono las operaciones CRUD (crear, listar, actualizar, eliminar) y hago las validaciones.  
- Tuve que adaptar el formulario y la lógica de validación para evitar errores en la base de datos ya que algunos métodos (`store` y `update`) colisionaban al no seguir la convención de Laravel.

## 3.3. `RegisterController.php`
- Registro de nuevos usuarios.

## 3.4. `ResetPasswordController.php`
- Lógica de restablecimiento de contraseñas. Ajusté la generación y validación de tokens.  
- A veces el correo no se mandaba correctamente y tuve que revisar la configuración SMTP.

## 3.5. `GithubAuthController.php`
- Autenticación con GitHub. Añadí la redirección a la API de GitHub y el callback que crea o inicia sesión a un usuario en la aplicación.

## 3.6. `LogoutController.php`
- Cerrar sesión de manera explícita.

## 3.7. `ForgotPasswordController.php`
- Lógica para cuando un usuario olvida su contraseña y necesita que se le envíe un enlace para restablecerla.

## 3.8. `LoginController.php`
- Control principal de la autenticación en la aplicación.  
- **Problemas encontrados**: Conflictos con `LoginControllers.php`. Tuve que revisar qué parte del código quedaba en uno u otro archivo y, finalmente, concentrar toda la lógica aquí para evitar duplicados.

## 3.9. `LoginRequest.php`
- Validación de la solicitud de inicio de sesión. Agrega reglas específicas (por ejemplo, email obligatorio, contraseña obligatoria y con un formato mínimo de caracteres).

---

# 4. Archivo `.env`
- He modificado el archivo `.env` para ajustar las:
  - Variables de entorno para la configuración de la base de datos (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc.).
  - Credenciales de correo (`MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, etc.) para asegurar que el envío de correos (recuperación de contraseña, notificaciones) funcione correctamente.
  - Credenciales de OAuth (`GITHUB_CLIENT_ID`, `GITHUB_CLIENT_SECRET`, `GITHUB_REDIRECT_URL`) para permitir la autenticación vía GitHub.

---

# 5. http/config

## 5.1. `app.php`
- En el archivo `app.php` se encuentran diversas configuraciones. En él he cambiado el idioma.

## 5.2. `auth.php`
- En este archivo se encuentran las diferentes formas de validación de usuarios, tokens, sesiones y contraseñas.

## 5.3. `database.php`
- Es donde se configura la base de datos que utiliza Laravel.

## 5.4. `mail.php`
- Donde se configura el email.

## 5.5. `services.php`
- Para configurar GitHub.

---

# 6. Migraciones
- Lugar donde se configuran las diferentes tablas de las base de datos, los nuevos campos a añadir, modificaciones, etc.

---

# 7. Carpeta `public` (es pública para el navegador)
- Contiene las carpetas:
  - **css**
  - **js** (contiene el archivo `Ajax.js`)
  - **images** (donde se guardan las imágenes)
  - **.htaccess** (configuración por defecto)

---

# 8. Resources
- **Views**: Contiene las diferentes vistas, detalladas al inicio del documento.
