# ⚠️ ACCIÓN REQUERIDA - Seguridad Google Maps API

## 🔴 Problema Detectado

Google ha detectado que tu clave de API de Google Maps estaba expuesta públicamente en GitHub:
- **Clave comprometida:** `AIzaSyA5KknbUlhzpaF-IVWQQihy1aCQDrzvth0`
- **Ubicación:** https://github.com/roelote/ericadventures
- **Proyecto:** Maps Google Web (id: plucky-sight-472600-m9)

## ✅ Cambios Realizados

### 1. Seguridad del Código
- ✅ Eliminada la clave hardcodeada de `functions.php`
- ✅ Actualizado código para leer desde constante `GOOGLE_MAPS_API_KEY`
- ✅ `.gitignore` verificado (ya incluye `wp-config.php`)

### 2. Archivos Creados
- 📄 `CONFIG-EXAMPLE.md` - Guía completa de configuración
- 📄 `wp-config-example.php` - Ejemplo de configuración para wp-config.php

## 🚨 PASOS OBLIGATORIOS - DEBES HACERLOS AHORA

### Paso 1: Regenerar la Clave de API (CRÍTICO)

1. Ve a **Google Cloud Console**: https://console.cloud.google.com/
2. Selecciona el proyecto: **Maps Google Web** (plucky-sight-472600-m9)
3. Ve a: **APIs & Services → Credentials**
4. Busca la clave: `AIzaSyA5KknbUlhzpaF-IVWQQihy1aCQDrzvth0`
5. **ELIMÍNALA** o **REGENERALA**:
   - Opción A: Click en editar → "Regenerate Key"
   - Opción B: Eliminarla y crear una nueva

6. **Agrega restricciones** a la nueva clave:
   
   **Application restrictions:**
   - Selecciona: "HTTP referrers (websites)"
   - Agrega:
     ```
     *.ericadventures.com/*
     ericadventures.com/*
     http://localhost/*
     ```
   
   **API restrictions:**
   - Selecciona: "Restrict key"
   - Marca:
     * Maps JavaScript API
     * Geocoding API (si la usas)

7. **Guarda** y copia la nueva clave

### Paso 2: Configurar en tu entorno LOCAL

1. Abre tu archivo: `c:\xampp\htdocs\eric\wp-config.php`

2. Busca esta línea:
   ```php
   /* That's all, stop editing! Happy publishing. */
   ```

3. ANTES de esa línea, agrega:
   ```php
   // Google Maps API Key
   define('GOOGLE_MAPS_API_KEY', 'TU-NUEVA-CLAVE-AQUI');
   ```

4. Reemplaza `TU-NUEVA-CLAVE-AQUI` con la clave que regeneraste

5. Guarda el archivo

### Paso 3: Configurar en tu SERVIDOR (Hosting)

**Opción A: Editar wp-config.php en el servidor**
1. Conéctate a tu hosting por FTP o panel de control
2. Edita el archivo `wp-config.php` en la raíz de WordPress
3. Agrega la misma línea:
   ```php
   define('GOOGLE_MAPS_API_KEY', 'TU-NUEVA-CLAVE-AQUI');
   ```

**Opción B: Variables de entorno (si tu hosting lo soporta)**
1. Ve al panel de control de tu hosting
2. Busca "Variables de entorno" o "Environment Variables"
3. Agrega: `GOOGLE_MAPS_API_KEY` = `tu-nueva-clave`

### Paso 4: Commit y Push de los cambios

```bash
cd c:\xampp\htdocs\eric\wp-content\themes\ericadventures
git add .
git commit -m "Security: Remove hardcoded Google Maps API key and use environment variable"
git push origin main
```

Esto subirá los cambios a GitHub y el **GitHub Action desplegará automáticamente** en tu hosting.

### Paso 5: Verificación

**En Local:**
1. Ve a una página que use Google Maps
2. Abre las herramientas de desarrollador (F12)
3. Verifica que no haya errores en la consola
4. El mapa debería cargarse correctamente

**En Producción:**
1. Espera a que GitHub Action termine el despliegue
2. Verifica el sitio en vivo: https://ericadventures.com
3. Prueba páginas con mapas
4. Revisa la consola del navegador (F12)

## 📊 Resumen de Archivos Modificados

```
ericadventures/
├── functions.php                  (✏️ Modificado - eliminada clave hardcodeada)
├── CONFIG-EXAMPLE.md              (✨ Nuevo - documentación completa)
├── wp-config-example.php          (✨ Nuevo - ejemplo de configuración)
└── SECURITY-ALERT-README.md       (✨ Este archivo)
```

## ❓ Preguntas Frecuentes

### ¿Por qué no puedo dejar la clave en el código?
Porque GitHub es público y cualquiera puede ver tu clave y usarla, generando costos en tu cuenta de Google Cloud.

### ¿El GitHub Action necesita la clave?
No. El workflow solo hace deploy por FTP. La clave debe estar en el `wp-config.php` del servidor.

### ¿Qué pasa si no regenero la clave?
Google ya marcó la clave como comprometida. Cualquiera puede usarla. DEBES regenerarla.

### ¿Funcionará mi sitio durante el cambio?
- **Local:** No funcionará hasta que agregues la clave en `wp-config.php`
- **Producción:** Seguirá usando la clave vieja hasta que la regeneres y actualices

### ¿Debo hacer backup?
Sí, antes de editar `wp-config.php` en producción, haz una copia del archivo por si acaso.

## 📞 Soporte

Si tienes problemas:

1. Lee [CONFIG-EXAMPLE.md](CONFIG-EXAMPLE.md) para instrucciones detalladas
2. Revisa la consola del navegador (F12) para ver el error específico
3. Verifica que la API está habilitada en Google Cloud Console
4. Asegúrate de que los referrers están bien configurados

## ✨ Después de resolver esto

Considera usar estos consejos para el futuro:

1. **Nunca** hardcodees credenciales en el código
2. Usa siempre variables de entorno o constantes en `wp-config.php`
3. Revisa `.gitignore` antes de hacer commit de archivos sensibles
4. Configura alertas en Google Cloud para detectar uso anómalo de APIs

---

**Estado:** ⚠️ PENDIENTE - Requiere acción manual  
**Prioridad:** 🔴 CRÍTICA  
**Fecha:** 6 de febrero de 2026
