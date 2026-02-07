# Configuración de Google Maps API

## Configuración Local (localhost/development)

Para que Google Maps funcione correctamente, necesitas agregar la siguiente línea a tu archivo `wp-config.php` (ubicado en la raíz de WordPress):

```php
define('GOOGLE_MAPS_API_KEY', 'TU-NUEVA-CLAVE-API-AQUI');
```

**Ubicación del archivo:** `c:\xampp\htdocs\eric\wp-config.php`

**Importante:** 
- Coloca esta línea ANTES de `/* That's all, stop editing! Happy publishing. */`
- NUNCA subas el archivo `wp-config.php` a GitHub
- Este archivo ya está excluido en `.gitignore`

## Configuración en Hosting (producción)

### Opción 1: wp-config.php del servidor
Edita el `wp-config.php` en el servidor y agrega la misma línea:
```php
define('GOOGLE_MAPS_API_KEY', 'TU-NUEVA-CLAVE-API-AQUI');
```

### Opción 2: Variables de entorno (si tu hosting lo soporta)
Si tu hosting soporta variables de entorno, puedes:
1. Ir al panel de control de tu hosting
2. Buscar la sección de variables de entorno
3. Agregar: `GOOGLE_MAPS_API_KEY` = `TU-NUEVA-CLAVE-API-AQUI`

## GitHub Actions

Si usas GitHub Actions para desplegar:

1. Ve a tu repositorio en GitHub
2. Settings → Secrets and variables → Actions
3. Crea un nuevo secret llamado `GOOGLE_MAPS_API_KEY`
4. Pega tu nueva clave de API

Luego en tu workflow (archivo `.github/workflows/*.yml`), puedes usar:
```yaml
- name: Deploy to hosting
  env:
    GOOGLE_MAPS_API_KEY: ${{ secrets.GOOGLE_MAPS_API_KEY }}
  # ... resto de tu script de despliegue
```

## Pasos OBLIGATORIOS después de este cambio

### ⚠️ IMPORTANTE - REGENERAR LA CLAVE DE API

1. **Ve a Google Cloud Console:**
   https://console.cloud.google.com/

2. **Selecciona tu proyecto:**
   "Maps Google Web" (id: plucky-sight-472600-m9)

3. **Ve a APIs & Services → Credentials**

4. **Busca la clave comprometida:**
   `AIzaSyA5KknbUlhzpaF-IVWQQihy1aCQDrzvth0`

5. **Elimínala o regenerala:**
   - Clic en el icono de edición
   - Clic en "Regenerate Key" o eliminarla y crear una nueva

6. **Agrega restricciones a la nueva clave:**
   - **HTTP referrers (websites):** 
     * `*.ericadventures.com/*`
     * `ericadventures.com/*`
     * `http://localhost/*` (solo para desarrollo)
   
   - **API restrictions:**
     * Maps JavaScript API
     * Geocoding API (si la usas)

7. **Copia la nueva clave** y agrégala en:
   - Tu `wp-config.php` local
   - Tu `wp-config.php` del servidor
   - GitHub Secrets (si usas Actions)

### Limpieza del repositorio

Después de regenerar la clave:

```bash
# Desde la carpeta del tema
git add .
git commit -m "Security: Remove hardcoded Google Maps API key"
git push origin main
```

**Nota:** La clave vieja ya está expuesta en el historial de GitHub. Google ya la tiene marcada como comprometida, por eso es CRÍTICO regenerarla.

## Verificación

Para verificar que todo funciona:

1. Ve a una página que use Google Maps
2. Abre las herramientas de desarrollador (F12)
3. Revisa la consola - no deberían haber errores de API
4. El mapa debería cargarse correctamente

## Troubleshooting

Si el mapa no carga:

- Verifica que agregaste la constante en `wp-config.php`
- Verifica que la clave tiene permisos para tu dominio
- Revisa la consola del navegador (F12) para ver errores específicos
- Asegúrate que la API de Maps JavaScript está habilitada en Google Cloud
