# parzibyte-wordpress-theme
 Intento de tema para WP de mi blog

# Modo desarrollo
Asegúrate de estar en la raíz del tema, ejecuta:

`npx tailwindcss -i input.css -o style.css --watch`

Ahora, todo cambio que hagas en **input.css** se mostrará en **style.css**, solo debes refrescar la
página para que el nuevo CSS sea cargado

Cuando termines, ejecuta:

`npx tailwindcss -i input.css -o style.css --minify`