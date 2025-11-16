# 🎫 Sistema de Registro de Eventos 

> Proyecto de formulario web completo con validación cliente-servidor para el módulo DWEC

[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat&logo=html5&logoColor=white)](https://developer.mozilla.org/es/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat&logo=css3&logoColor=white)](https://developer.mozilla.org/es/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat&logo=javascript&logoColor=black)](https://developer.mozilla.org/es/docs/Web/JavaScript)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=flat&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)

---

## 📋 Tabla de Contenidos

- [Descripción](#-descripción)
- [Características](#-características)
- [Tecnologías](#-tecnologías)
- [Instalación](#-instalación)
- [Uso](#-uso)
- [Estructura](#-estructura-del-proyecto)
- [Validaciones](#-validaciones)
- [Capturas](#-capturas-de-pantalla)
- [Autor](#-autor)

---

## 📖 Descripción

 **Registro** **de** **Asistentes** **al** **Evento** es un sistema de registro de asistentes a eventos desarrollado como proyecto académico para el módulo de **Desarrollo Web en Entorno Cliente (DWEC)** del ciclo de **Desarrollo de Aplicaciones Multiplataforma/Web**.

El proyecto implementa un formulario HTML completo con validación tanto en el cliente (JavaScript) como en el servidor (PHP), garantizando la integridad y seguridad de los datos recibidos.

### 🎯 Objetivos del Proyecto

- Crear formularios web interactivos
- Implementar validación de datos en cliente y servidor
- Utilizar Bootstrap para diseño responsivo
- Procesar datos con PHP y el método POST
- Aplicar buenas prácticas de seguridad web

---

## ✨ Características

### 📝 Formulario Completo

El formulario incluye **6 secciones** con múltiples tipos de campos:

#### 1️⃣ Información Personal
- ✅ Nombre completo (text input)
- ✅ Correo electrónico (email input)
- ✅ Número de teléfono (tel input con validación de 9 dígitos)
- ✅ Fecha de nacimiento (date input)
- ✅ Género (radio buttons)

#### 2️⃣ Información del Evento
- ✅ Fecha del evento (date input)
- ✅ Tipo de entrada (select: General, VIP, Estudiante)
- ✅ Preferencias de comida (checkboxes múltiples)

#### 3️⃣ Información de Acceso
- ✅ Nombre de usuario (text input)
- ✅ Contraseña (password con validación de longitud)
- ✅ Confirmación de contraseña (validación de coincidencia)

#### 4️⃣ Preferencias de Contacto
- ✅ Notificaciones por email (checkbox)
- ✅ Términos y condiciones (checkbox obligatorio)

#### 5️⃣ Encuesta Adicional
- ✅ Calificación (range slider 1-10)
- ✅ Comentarios (textarea)

#### 6️⃣ Documentación
- ✅ Adjuntar archivo (file input con validación)

### 🎨 Diseño Moderno

- **Degradado de fondo** morado-azul
- **Iconos de Font Awesome** en cada campo
- **Animaciones** y efectos hover
- **100% Responsivo** (móvil, tablet, desktop)
- **Tarjetas con sombras** y bordes redondeados
- **Feedback visual** en validación

### 🔒 Seguridad

- **Validación doble**: Cliente (JS) + Servidor (PHP)
- **Sanitización** con `htmlspecialchars()`
- **Protección XSS** en todos los inputs
- **Validación de email** con `filter_var()`
- **Expresiones regulares** para teléfono
- **Verificación de archivos** (tamaño y tipo)

---

## 🛠️ Tecnologías

| Tecnología | Versión | Propósito |
|------------|---------|-----------|
| **HTML5** | - | Estructura del formulario |
| **CSS3** | - | Estilos personalizados |
| **JavaScript** | ES6 | Validación en cliente |
| **Bootstrap** | 5.3.0 | Framework CSS responsivo |
| **Font Awesome** | 6.4.0 | Biblioteca de iconos |
| **PHP** | 7.4+ | Procesamiento en servidor |

---

## 🚀 Instalación

### Requisitos Previos

- **Servidor web** (Apache, Nginx, XAMPP, WAMP, etc.)
- **PHP** versión 7.4 o superior
- **Navegador web** moderno (Chrome, Firefox, Edge, Safari)

### Pasos de Instalación

1. **Clonar el repositorio**

```bash
git clone https://github.com/tu-usuario/eventpro-registro.git
cd eventpro-registro
```

2. **Opción A: Usar servidor PHP integrado**

```bash
php -S localhost:8000
```

3. **Opción B: Copiar a servidor web**

```bash
# Si usas XAMPP
cp -r * /opt/lampp/htdocs/eventpro/

# Si usas WAMP
cp -r * C:/wamp64/www/eventpro/
```

4. **Acceder a la aplicación**

Abrir en el navegador:
- Con PHP integrado: `http://localhost:8000/registro_eventos.html`
- Con XAMPP/WAMP: `http://localhost/eventpro/registro_eventos.html`

---

## 💻 Uso

### Flujo de Usuario

1. **Llenar el formulario** con todos los datos requeridos
2. **Aceptar términos y condiciones** (obligatorio)
3. **Enviar el formulario** haciendo clic en "Registrarse al Evento"
4. **Ver el recibo** con todos los datos procesados

### Casos de Uso

✅ **Registro exitoso**
```
Usuario completa todos los campos → 
Envía formulario → 
PHP valida datos → 
Muestra recibo de confirmación
```

❌ **Registro con errores**
```
Usuario deja campos vacíos o con errores → 
Envía formulario → 
PHP detecta errores → 
Muestra lista de errores y botón para volver
```

---

## 📂 Estructura del Proyecto

```
eventpro-registro/
│
├── 📄 registro_eventos.html    # Formulario principal
├── 📄 procesar_evento.php      # Procesamiento en servidor
├── 📄 README.md                # Documentación
│
└── 📁 screenshots/             # (Opcional)
    ├── formulario.png
    ├── recibo.png
    └── errores.png
```

### Descripción de Archivos

- **`registro_eventos.html`**: Contiene el formulario HTML con Bootstrap y validación JavaScript
- **`procesar_evento.php`**: Recibe datos POST, valida y muestra recibo o errores
- **`README.md`**: Este archivo de documentación

---

## ✅ Validaciones

### Validación en Cliente (JavaScript)

```javascript
✓ Campos requeridos no vacíos
✓ Formato de email válido
✓ Teléfono de 9 dígitos numéricos
✓ Contraseñas coincidentes
✓ Longitud mínima de contraseña (6 caracteres)
✓ Aceptación obligatoria de términos
✓ Feedback visual en tiempo real
```

### Validación en Servidor (PHP)

```php
✓ Verificación de método POST
✓ Sanitización con htmlspecialchars()
✓ Validación de email con filter_var()
✓ Expresión regular para teléfono (/^[0-9]{9}$/)
✓ Comparación de contraseñas
✓ Verificación de campos obligatorios
✓ Validación de tamaño de archivo (< 5MB)
✓ Array de errores para feedback
```

---

## 📸 Capturas de Pantalla

### Formulario Principal
*Diseño moderno con degradados y organización clara*

![Formulario](screenshots/formulario.png)

### Recibo de Confirmación
*Página de éxito con todos los datos validados*

![Recibo](screenshots/recibo.png)

### Manejo de Errores
*Lista clara de errores de validación*

![Errores](screenshots/errores.png)

---

## 🧪 Ejemplos de Validación

### ✅ Datos Válidos

```php
Nombre: "Juan Pérez García"
Email: "juan.perez@gmail.com"
Teléfono: "612345678"
Contraseña: "miPassword123"
```

### ❌ Datos Inválidos

```php
Nombre: ""                    → Error: Campo obligatorio
Email: "juangmail.com"        → Error: Formato inválido
Teléfono: "61234567"          → Error: Debe tener 9 dígitos
Contraseña: "123"             → Error: Mínimo 6 caracteres
```

---

## 🔧 Personalización

### Cambiar Colores del Degradado

```css
/* En registro_eventos.html - Sección <style> */
body {
    background: linear-gradient(135deg, #tu-color-1 0%, #tu-color-2 100%);
}
```

### Añadir Más Validaciones

```php
// En procesar_evento.php
if (strlen($nombre) < 3) {
    $errores[] = "El nombre debe tener al menos 3 caracteres";
}
```

---

## 📚 Conceptos Aplicados

### Programación Estructurada
- ✓ Sentencias condicionales (`if`, `else`, `elseif`)
- ✓ Bucles (`foreach`, `for`)
- ✓ Arrays (`$errores`, `$_POST`, `$_FILES`)
- ✓ Comentarios descriptivos

### Desarrollo Web
- ✓ Formularios HTML5
- ✓ Método POST para envío de datos
- ✓ Procesamiento de datos con PHP
- ✓ Validación cliente-servidor
- ✓ Manejo de archivos (`$_FILES`)
- ✓ Bootstrap para diseño responsivo

---

## 🐛 Solución de Problemas

### El formulario no envía datos

**Problema**: Al hacer clic en enviar no pasa nada
**Solución**: Verificar que el atributo `action` del form apunte a `procesar_evento.php`

### Los estilos no se cargan

**Problema**: El formulario se ve sin estilos
**Solución**: Verificar conexión a internet (Bootstrap se carga desde CDN)

### PHP no procesa el formulario

**Problema**: Aparece código PHP en lugar de la página procesada
**Solución**: Asegurarse de que el servidor PHP está corriendo

---

## 📝 Licencia

Este proyecto es de uso **académico** para el módulo DWEC del ciclo DAW.



---


## ⭐ Si te fue útil

Si este proyecto te ayudó o te gustó, ¡dale una estrella! ⭐

```bash
# Fork el proyecto
# Haz tus cambios
# Crea un Pull Request
```

---

[Volver arriba](#-sistema-de-registro-de-eventos---eventpro)

</div>
