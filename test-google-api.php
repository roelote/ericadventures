<?php
/**
 * Template Name: Test Google Maps API
 * 
 * Página de prueba para verificar que la API de Google Maps funciona correctamente
 */

// Cargar WordPress
require_once('../../../wp-load.php');

// Obtener la clave API
$api_key = defined('GOOGLE_MAPS_API_KEY') ? GOOGLE_MAPS_API_KEY : '';
$api_key_exists = !empty($api_key);
$api_key_masked = $api_key ? substr($api_key, 0, 10) . '...' . substr($api_key, -5) : 'NO DEFINIDA';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Google Maps API - Eric Adventures</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
        }
        .status {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .status.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info {
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .info strong {
            color: #004085;
        }
        #map {
            width: 100%;
            height: 500px;
            border-radius: 8px;
            border: 2px solid #ddd;
            margin-top: 20px;
        }
        .console-output {
            background: #1e1e1e;
            color: #d4d4d4;
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            max-height: 300px;
            overflow-y: auto;
        }
        .console-output .success { color: #4ec9b0; }
        .console-output .error { color: #f48771; }
        .console-output .info { color: #9cdcfe; }
        .instructions {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
        }
        .instructions h3 {
            color: #856404;
            margin-bottom: 10px;
        }
        .instructions ul {
            margin-left: 20px;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗺️ Test de Google Maps API</h1>
        
        <?php if ($api_key_exists): ?>
            <div class="status success">
                ✅ Clave API detectada: <code><?php echo esc_html($api_key_masked); ?></code>
            </div>
        <?php else: ?>
            <div class="status error">
                ❌ ERROR: No se encontró la clave API en wp-config.php
            </div>
        <?php endif; ?>

        <div class="info">
            <strong>📋 Información del test:</strong><br>
            • Sitio: Eric Adventures<br>
            • Fecha: <?php echo date('d/m/Y H:i:s'); ?><br>
            • Archivo: <?php echo __FILE__; ?><br>
            • API Key definida: <?php echo $api_key_exists ? 'Sí' : 'No'; ?>
        </div>

        <?php if ($api_key_exists): ?>
            <div id="map"></div>
            
            <div class="console-output" id="console">
                <div class="info">📊 Consola de diagnóstico:</div>
                <div id="log"></div>
            </div>

            <div class="instructions">
                <h3>✅ Qué verificar:</h3>
                <ul>
                    <li>El mapa debe mostrarse correctamente arriba (sin área gris)</li>
                    <li>Debe aparecer centrado en Cusco, Perú</li>
                    <li>Debes poder hacer zoom y moverte por el mapa</li>
                    <li>No deben aparecer mensajes de error en la consola de diagnóstico</li>
                    <li>Abre F12 y revisa la pestaña Console para errores adicionales</li>
                </ul>
            </div>
        <?php else: ?>
            <div class="instructions">
                <h3>⚠️ Cómo resolver:</h3>
                <ul>
                    <li>Abre el archivo: <code>c:\xampp\htdocs\eric\wp-config.php</code></li>
                    <li>Agrega esta línea ANTES de "That's all, stop editing!":</li>
                    <li><code>define('GOOGLE_MAPS_API_KEY', 'tu-clave-aqui');</code></li>
                    <li>Guarda el archivo y recarga esta página</li>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($api_key_exists): ?>
    <script>
        // Función para escribir en la consola de diagnóstico
        function log(message, type = 'info') {
            const logDiv = document.getElementById('log');
            const timestamp = new Date().toLocaleTimeString();
            logDiv.innerHTML += `<div class="${type}">[${timestamp}] ${message}</div>`;
            console.log(`[Google Maps Test] ${message}`);
        }

        // Verificar que la clave existe
        log('🔑 Clave API cargada desde wp-config.php', 'success');
        log('🌍 Iniciando carga de Google Maps API...', 'info');

        // Variable global para el mapa
        let map;

        // Función de callback que se ejecuta cuando se carga la API
        function initMap() {
            try {
                log('✅ Google Maps API cargada correctamente', 'success');
                
                // Coordenadas de Cusco, Perú (centro de operaciones de Eric Adventures)
                const cusco = { lat: -13.5320, lng: -71.9675 };
                
                log('📍 Creando mapa centrado en Cusco, Perú...', 'info');
                
                // Crear el mapa
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 13,
                    center: cusco,
                    mapTypeControl: true,
                    streetViewControl: true,
                    fullscreenControl: true
                });
                
                log('✅ Mapa creado exitosamente', 'success');
                
                // Agregar un marcador
                const marker = new google.maps.Marker({
                    position: cusco,
                    map: map,
                    title: 'Eric Adventures - Cusco Office',
                    animation: google.maps.Animation.DROP
                });
                
                log('📌 Marcador agregado en la ubicación', 'success');
                
                // InfoWindow con información
                const infoWindow = new google.maps.InfoWindow({
                    content: '<div style="padding:10px;"><strong>Eric Adventures</strong><br>Cusco, Perú<br><em>API funcionando correctamente ✅</em></div>'
                });
                
                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });
                
                log('🎉 TEST COMPLETADO: La API de Google Maps funciona perfectamente', 'success');
                log('💡 Puedes hacer zoom, moverte por el mapa y hacer clic en el marcador', 'info');
                
            } catch (error) {
                log('❌ ERROR al crear el mapa: ' + error.message, 'error');
                console.error('Error detallado:', error);
            }
        }

        // Manejar errores de carga de la API
        window.gm_authFailure = function() {
            log('❌ ERROR DE AUTENTICACIÓN: La clave API no es válida o tiene restricciones', 'error');
            log('🔧 Verifica que la clave tenga permisos para localhost', 'info');
        };

        // Detectar otros errores
        window.addEventListener('error', function(e) {
            if (e.message.includes('Google') || e.message.includes('maps')) {
                log('❌ Error detectado: ' + e.message, 'error');
            }
        });

    </script>
    
    <!-- Cargar Google Maps API con callback -->
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($api_key); ?>&callback=initMap" async defer></script>
    <?php endif; ?>
</body>
</html>
