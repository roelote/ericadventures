/**
 * EJEMPLO DE CONFIGURACIÓN PARA wp-config.php
 * 
 * Este archivo muestra cómo agregar la clave de Google Maps API
 * a tu wp-config.php de forma segura.
 * 
 * NO SUBAS wp-config.php A GITHUB
 */

// ============================================
// AGREGA ESTO A TU wp-config.php
// ============================================

/**
 * Google Maps API Key
 * Reemplaza 'TU-NUEVA-CLAVE-API-AQUI' con tu clave real de Google Maps
 */
define('GOOGLE_MAPS_API_KEY', 'TU-NUEVA-CLAVE-API-AQUI');

// ============================================
// UBICACIÓN: 
// Agrega esta línea en wp-config.php ANTES de esta línea:
// /* That's all, stop editing! Happy publishing. */
// ============================================

/**
 * PASOS PARA CONFIGURAR:
 * 
 * 1. Ve a: https://console.cloud.google.com/
 * 2. Selecciona el proyecto: Maps Google Web (plucky-sight-472600-m9)
 * 3. Ve a: APIs & Services → Credentials
 * 4. REGENERA la clave comprometida (AIzaSyA5KknbUlhzpaF-IVWQQihy1aCQDrzvth0)
 * 5. Copia la nueva clave
 * 6. Reemplaza 'TU-NUEVA-CLAVE-API-AQUI' con tu nueva clave
 * 
 * IMPORTANTE:
 * - Agrega restricciones a la clave:
 *   * HTTP referrers: *.ericadventures.com/*, ericadventures.com/*
 *   * APIs: Maps JavaScript API, Geocoding API
 * 
 * - NO compartas esta clave públicamente
 * - NO la subas a GitHub
 * - Usa la misma configuración en tu servidor de producción
 */
