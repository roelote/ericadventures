# Eric Adventures WordPress Theme

Tema de WordPress personalizado para Eric Adventures, desarrollado con Tailwind CSS y optimizado para tours, alquiler de vehículos y aventuras en Perú.

## 🚀 Tecnologías

- **WordPress** - CMS principal
- **Tailwind CSS 3.3** - Framework CSS utility-first
- **PHP** - Backend y templates
- **JavaScript** - Interactividad (FancyBox, Google Maps)

## 📋 Requisitos

- PHP 7.4 o superior
- WordPress 5.0 o superior
- Node.js 14 o superior
- npm o yarn

## 🔧 Instalación

1. Clona este repositorio en tu carpeta de temas de WordPress:
```bash
cd wp-content/themes/
git clone [URL_DEL_REPO] ericadventures
```

2. Instala las dependencias:
```bash
cd ericadventures
npm install
```

3. Compila los estilos:
```bash
npm run build
```

4. Activa el tema desde el panel de WordPress

## 💻 Comandos de Desarrollo

### Modo desarrollo con watch
```bash
npm run dev
```
Compila el CSS y observa cambios en tiempo real. Perfecto para desarrollo.

### Compilación para producción
```bash
npm run build
```
Compila y minifica el CSS para producción.

## 📁 Estructura del Proyecto

```
ericadventures/
├── src/
│   ├── input.css          # Estilos fuente con Tailwind
│   └── output.css         # CSS compilado (generado automáticamente)
├── inc/                   # Funciones e includes PHP
├── template-parts/        # Partes reutilizables de templates
├── js/                    # JavaScript personalizado
├── img/                   # Imágenes del tema
├── functions.php          # Funciones principales del tema
├── tailwind.config.js     # Configuración de Tailwind
├── package.json           # Dependencias y scripts
├── header.php             # Header del sitio
├── footer.php             # Footer del sitio
├── front-page.php         # Página de inicio
├── page-*.php             # Templates de páginas específicas
└── single.php             # Template de entrada individual
```

## 🎨 Configuración de Tailwind

El tema incluye configuración personalizada de Tailwind en `tailwind.config.js`:

- **Colores personalizados:** `eric`, `eric2`, `eric-moto`
- **Fuente:** Nunito
- **Container:** Máximo 1200px centrado
- **Alturas personalizadas:** Para diseños específicos

### Contenido escaneado
Tailwind escanea los siguientes archivos para clases:
- `./template-parts/**/*.php`
- `./*.php`
- `./js/*.js`

## 🔌 Plugins Requeridos

- **Advanced Custom Fields (ACF)** - Para campos personalizados
- **Contact Form 7** - Para formularios de contacto
- **UberMenu** - Para el menú de navegación (opcional)
- **Yoast SEO** - Para SEO (recomendado)

## 🌟 Características

- ✅ Diseño responsive con Tailwind CSS
- ✅ Templates personalizados para:
  - Tours (`page-tour.php`)
  - Ciudades (`page-city.php`)
  - Hoteles (`page-hotel.php`, `page-hotel2.php`)
  - Alquiler de autos (`page-rental-car.php`)
  - Alquiler de motos (`page-rental-moto.php`)
  - Testimonios (`page-testimonials.php`)
- ✅ Integración con Google Maps
- ✅ Galería de imágenes con FancyBox
- ✅ Breadcrumbs personalizados
- ✅ Optimizado para SEO

## 📝 Notas de Desarrollo

- **No editar** `src/output.css` - es generado automáticamente
- Todos los estilos personalizados van en `src/input.css`
- Usar clases de Tailwind cuando sea posible
- Para estilos muy específicos, usar `@apply` en componentes

## 🔄 Migración desde Laravel Mix

Este tema fue migrado de Laravel Mix a Tailwind CSS CLI para simplificar el proceso de compilación. Ver [TAILWIND-SETUP.md](TAILWIND-SETUP.md) para más detalles.

## 📄 Licencia

GPL-2.0-or-later

## 👥 Autor

Desarrollado para Eric Adventures
