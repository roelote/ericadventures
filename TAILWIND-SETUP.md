# Eric Adventures - Tailwind CSS Setup

Este tema ahora utiliza Tailwind CSS CLI en lugar de Laravel Mix para compilar los estilos.

## Comandos disponibles

### Modo desarrollo (con watch)
```bash
npm run dev
```
Este comando compila el CSS y queda vigilando los cambios en tiempo real. Es equivalente a:
```bash
npx tailwindcss -i ./src/input.css -o ./src/output.css --watch
```

### Compilación para producción
```bash
npm run build
```
Este comando compila y minifica el CSS para producción. Es equivalente a:
```bash
npx tailwindcss -i ./src/input.css -o ./src/output.css --minify
```

## Estructura de archivos

- `src/input.css` - Archivo CSS de entrada con las directivas de Tailwind y estilos personalizados
- `src/output.css` - Archivo CSS compilado que se carga en el tema (generado automáticamente)
- `tailwind.config.js` - Configuración de Tailwind CSS

## Migración desde Laravel Mix

Este proyecto fue migrado de Laravel Mix a Tailwind CSS CLI. Los siguientes archivos fueron eliminados:
- `webpack.mix.js`
- `mix-manifest.json`
- Carpeta `resources/css/` (deprecada, pero puedes eliminarla manualmente si lo deseas)

## Notas

- El archivo `src/output.css` es generado automáticamente, **no lo edites manualmente**
- Todos los cambios de CSS deben realizarse en `src/input.css`
- El tema carga automáticamente `src/output.css` desde [functions.php](functions.php#L152)
