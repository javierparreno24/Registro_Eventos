<?php
/**
 * procesar_evento.php
 * Archivo para procesar el formulario de registro de eventos
 * Autor: Javier Parreño Garrido
 * Fecha: 16/11/2025
 */

// Verificar que el formulario se envió por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Array para almacenar errores de validación
    $errores = array();
    
    // ============================================
    // VALIDACIÓN Y SANITIZACIÓN DE DATOS
    // ============================================
    
    // 1. INFORMACIÓN PERSONAL
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio";
    } else {
        $nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    }
    
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    if (empty($email)) {
        $errores[] = "El correo electrónico es obligatorio";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El formato del correo electrónico no es válido";
    } else {
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    }
    
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    if (empty($telefono)) {
        $errores[] = "El teléfono es obligatorio";
    } elseif (!preg_match('/^[0-9]{9}$/', $telefono)) {
        $errores[] = "El teléfono debe tener 9 dígitos";
    }
    
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : '';
    if (empty($fecha_nacimiento)) {
        $errores[] = "La fecha de nacimiento es obligatoria";
    }
    
    $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
    if (empty($genero)) {
        $errores[] = "El género es obligatorio";
    } else {
        $genero = htmlspecialchars($genero, ENT_QUOTES, 'UTF-8');
    }
    
    // 2. INFORMACIÓN DEL EVENTO
    $fecha_evento = isset($_POST['fecha_evento']) ? $_POST['fecha_evento'] : '';
    if (empty($fecha_evento)) {
        $errores[] = "La fecha del evento es obligatoria";
    }
    
    $tipo_entrada = isset($_POST['tipo_entrada']) ? $_POST['tipo_entrada'] : '';
    if (empty($tipo_entrada)) {
        $errores[] = "El tipo de entrada es obligatorio";
    } else {
        $tipo_entrada = htmlspecialchars($tipo_entrada, ENT_QUOTES, 'UTF-8');
    }
    
    // Preferencias de comida (checkbox múltiple)
    $comida = isset($_POST['comida']) ? $_POST['comida'] : array();
    $comida_str = !empty($comida) ? implode(", ", array_map('htmlspecialchars', $comida)) : "Ninguna seleccionada";
    
    // 3. INFORMACIÓN DE ACCESO
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    if (empty($username)) {
        $errores[] = "El nombre de usuario es obligatorio";
    } else {
        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    }
    
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    
    if (empty($password)) {
        $errores[] = "La contraseña es obligatoria";
    } elseif (strlen($password) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres";
    } elseif ($password !== $confirm_password) {
        $errores[] = "Las contraseñas no coinciden";
    }
    
    // Por seguridad, no mostramos las contraseñas
    $password_mostrar = "********";
    
    // 4. PREFERENCIAS DE CONTACTO
    $notificaciones = isset($_POST['notificaciones']) ? "Sí" : "No";
    
    $terminos = isset($_POST['terminos']) ? $_POST['terminos'] : '';
    if (empty($terminos)) {
        $errores[] = "Debes aceptar los términos y condiciones";
    }
    
    // 5. ENCUESTA ADICIONAL
    $calificacion = isset($_POST['calificacion']) ? intval($_POST['calificacion']) : 5;
    if ($calificacion < 1 || $calificacion > 10) {
        $calificacion = 5; // Valor por defecto
    }
    
    $comentarios = isset($_POST['comentarios']) ? trim($_POST['comentarios']) : '';
    $comentarios = htmlspecialchars($comentarios, ENT_QUOTES, 'UTF-8');
    
    // 6. ARCHIVO ADJUNTO
    $archivo_info = "No se adjuntó ningún archivo";
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
        $archivo_nombre = htmlspecialchars($_FILES['archivo']['name'], ENT_QUOTES, 'UTF-8');
        $archivo_tamanio = $_FILES['archivo']['size'];
        $archivo_tipo = $_FILES['archivo']['type'];
        
        // Validar tamaño (máx 5MB)
        if ($archivo_tamanio > 5242880) {
            $errores[] = "El archivo no debe superar los 5MB";
        } else {
            $archivo_info = "Archivo: " . $archivo_nombre . " (" . round($archivo_tamanio/1024, 2) . " KB)";
        }
    }
    
} else {
    // Si no se envió por POST, redirigir al formulario
    header("Location: registro_eventos.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro - EventPro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .recibo-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
            margin: 20px auto;
            max-width: 800px;
        }
        .header-recibo {
            text-align: center;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header-recibo h1 {
            color: #764ba2;
            font-weight: bold;
        }
        .seccion-recibo {
            margin-bottom: 30px;
        }
        .seccion-titulo {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 15px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .dato-recibo {
            padding: 10px;
            border-left: 3px solid #667eea;
            margin-bottom: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .dato-label {
            font-weight: 600;
            color: #667eea;
        }
        .dato-valor {
            color: #333;
            margin-left: 10px;
        }
        .alert-error {
            border-left: 4px solid #dc3545;
        }
        .btn-volver {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 40px;
        }
        .success-icon {
            font-size: 80px;
            color: #28a745;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="recibo-container">
            
            <?php if (!empty($errores)): ?>
                <!-- Mostrar errores si los hay -->
                <div class="header-recibo">
                    <i class="fas fa-exclamation-triangle" style="font-size: 60px; color: #dc3545;"></i>
                    <h1>Error en el Registro</h1>
                    <p class="text-muted">Se encontraron los siguientes errores:</p>
                </div>
                
                <div class="alert alert-danger alert-error">
                    <h5><i class="fas fa-times-circle"></i> Errores de Validación:</h5>
                    <ul>
                        <?php foreach ($errores as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <div class="text-center mt-4">
                    <a href="registro_eventos.html" class="btn btn-danger">
                        <i class="fas fa-arrow-left"></i> Volver al Formulario
                    </a>
                </div>
                
            <?php else: ?>
                <!-- Mostrar recibo exitoso -->
                <div class="header-recibo">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h1>¡Registro Exitoso!</h1>
                    <p class="text-muted">Tu inscripción ha sido procesada correctamente</p>
                </div>
                
                <div class="alert alert-success">
                    <i class="fas fa-info-circle"></i> <strong>Confirmación:</strong> Recibirás un correo electrónico con los detalles de tu registro.
                </div>
                
                <!-- SECCIÓN 1: Información Personal -->
                <div class="seccion-recibo">
                    <div class="seccion-titulo">
                        <i class="fas fa-user"></i> Información Personal
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-user"></i> Nombre Completo:</span>
                        <span class="dato-valor"><?php echo $nombre; ?></span>
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-envelope"></i> Correo Electrónico:</span>
                        <span class="dato-valor"><?php echo $email; ?></span>
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-phone"></i> Teléfono:</span>
                        <span class="dato-valor"><?php echo $telefono; ?></span>
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-calendar"></i> Fecha de Nacimiento:</span>
                        <span class="dato-valor"><?php echo date("d/m/Y", strtotime($fecha_nacimiento)); ?></span>
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-venus-mars"></i> Género:</span>
                        <span class="dato-valor"><?php echo $genero; ?></span>
                    </div>
                </div>
                
                <!-- SECCIÓN 2: Información del Evento -->
                <div class="seccion-recibo">
                    <div class="seccion-titulo">
                        <i class="fas fa-ticket-alt"></i> Información del Evento
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-calendar-day"></i> Fecha del Evento:</span>
                        <span class="dato-valor"><?php echo date("d/m/Y", strtotime($fecha_evento)); ?></span>
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-star"></i> Tipo de Entrada:</span>
                        <span class="dato-valor">
                            <span class="badge bg-primary"><?php echo $tipo_entrada; ?></span>
                        </span>
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-utensils"></i> Preferencias de Comida:</span>
                        <span class="dato-valor"><?php echo $comida_str; ?></span>
                    </div>
                </div>
                
                <!-- SECCIÓN 3: Información de Acceso -->
                <div class="seccion-recibo">
                    <div class="seccion-titulo">
                        <i class="fas fa-lock"></i> Información de Acceso
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-user-circle"></i> Nombre de Usuario:</span>
                        <span class="dato-valor"><?php echo $username; ?></span>
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-key"></i> Contraseña:</span>
                        <span class="dato-valor"><?php echo $password_mostrar; ?></span>
                    </div>
                </div>
                
                <!-- SECCIÓN 4: Preferencias de Contacto -->
                <div class="seccion-recibo">
                    <div class="seccion-titulo">
                        <i class="fas fa-bell"></i> Preferencias de Contacto
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-envelope-open-text"></i> Notificaciones por Email:</span>
                        <span class="dato-valor">
                            <?php if ($notificaciones == "Sí"): ?>
                                <span class="badge bg-success">Activadas</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Desactivadas</span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-file-contract"></i> Términos y Condiciones:</span>
                        <span class="dato-valor">
                            <span class="badge bg-success"><i class="fas fa-check"></i> Aceptados</span>
                        </span>
                    </div>
                </div>
                
                <!-- SECCIÓN 5: Encuesta Adicional -->
                <div class="seccion-recibo">
                    <div class="seccion-titulo">
                        <i class="fas fa-poll"></i> Encuesta Adicional
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-star-half-alt"></i> Calificación de Eventos Anteriores:</span>
                        <span class="dato-valor">
                            <?php echo $calificacion; ?>/10
                            <?php 
                            // Mostrar estrellas según la calificación
                            $estrellas_llenas = floor($calificacion / 2);
                            for ($i = 0; $i < $estrellas_llenas; $i++) {
                                echo '<i class="fas fa-star" style="color: #ffc107;"></i>';
                            }
                            for ($i = $estrellas_llenas; $i < 5; $i++) {
                                echo '<i class="far fa-star" style="color: #ffc107;"></i>';
                            }
                            ?>
                        </span>
                    </div>
                    <?php if (!empty($comentarios)): ?>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-comment"></i> Comentarios:</span>
                        <div class="dato-valor mt-2">
                            <div class="alert alert-info mb-0">
                                <?php echo nl2br($comentarios); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- SECCIÓN 6: Archivo Adjunto -->
                <div class="seccion-recibo">
                    <div class="seccion-titulo">
                        <i class="fas fa-paperclip"></i> Documentación Adjunta
                    </div>
                    <div class="dato-recibo">
                        <span class="dato-label"><i class="fas fa-file"></i> Archivo:</span>
                        <span class="dato-valor"><?php echo $archivo_info; ?></span>
                    </div>
                </div>
                
                <!-- Información adicional -->
                <div class="alert alert-warning mt-4">
                    <h6><i class="fas fa-lightbulb"></i> Información Importante:</h6>
                    <ul class="mb-0">
                        <li>Guarda este número de confirmación: <strong>#<?php echo strtoupper(substr(md5($email . time()), 0, 8)); ?></strong></li>
                        <li>Presenta este recibo el día del evento</li>
                        <li>Revisa tu correo electrónico para más detalles</li>
                    </ul>
                </div>
                
                <!-- Botones de acción -->
                <div class="text-center mt-4">
                    <button onclick="window.print()" class="btn btn-success me-2">
                        <i class="fas fa-print"></i> Imprimir Recibo
                    </button>
                    <a href="registro_eventos.html" class="btn btn-primary btn-volver">
                        <i class="fas fa-home"></i> Volver al Inicio
                    </a>
                </div>
                
            <?php endif; ?>
            
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>