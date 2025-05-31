# InventoryAPP

Sistema de gestión de inventario y punto de venta (POS) basado en el trabajo original de parzibyte.

<img src="LOGO-InventoryApp.png" alt="Logo InventoryAPP" width="300" height="auto">

## Descripción

InventoryAPP es una aplicación web para la gestión de inventario, ventas, gastos y reportes. Este sistema está diseñado para pequeños y medianos negocios que necesitan llevar un control efectivo de su inventario y ventas diarias.

## Características

### Gestión de Inventario
- Alta, baja y edición de productos
- Control de existencias y stock mínimo
- Búsqueda de productos por código o nombre
- Alertas de productos con existencia mínima
- Valoración del inventario

### Punto de Venta (POS)
- Interfaz intuitiva para realizar ventas
- Generación de tickets de venta
- Control de caja (ingresos y egresos)
- Apertura y cierre de caja

### Reportes
- Reportes de inventario
- Reportes de ventas
- Reportes de caja
- Reportes de créditos
- Reportes de gastos
- Reportes de bajas de inventario

### Otras Funcionalidades
- Gestión de usuarios y permisos
- Configuración de datos de la empresa
- Gestión de créditos a clientes
- Control de gastos
- Impresión de tickets y facturas

## Requisitos del Sistema

- PHP 7.0 o superior
- MariaDB/MySQL
- Servidor web (Apache/Nginx)
- Navegador web moderno

## Instalación

1. Clone el repositorio en su servidor web:
   ```
   git clone https://github.com/su-usuario/InventoryAPP.git
   ```

2. Importe el esquema de la base de datos:
   ```
   mysql -u usuario -p nombre_base_datos < esquema.sql
   ```

3. Configure la conexión a la base de datos en el archivo `/modulos/db.php`

4. Acceda a la aplicación a través de su navegador web:
   ```
   http://localhost/InventoryAPP
   ```

5. Inicie sesión con las credenciales predeterminadas:
   ```
   Usuario: parzibyte
   ```

## Estructura del Proyecto

- `/css`: Archivos de estilo
- `/img`: Imágenes del sistema
- `/inc`: Componentes de la interfaz principal
- `/js`: Scripts de JavaScript
- `/lib`: Bibliotecas externas
- `/modulos`: Módulos funcionales del sistema
- `/public`: Archivos públicos

## Modificaciones Realizadas

Esta versión de InventoryAPP incluye las siguientes modificaciones respecto al proyecto original:

- Interfaz de usuario mejorada
- Correcciones de errores
- Nuevas funcionalidades para el control de inventario
- Mejoras en la generación de reportes

## Créditos

- Proyecto original: [parzibyte](https://parzibyte.me)
- Modificaciones: [EmilioRXD](https://github.com/EmilioRXD)

## Licencia

Este proyecto está bajo la Licencia incluida en el archivo LICENSE.

---

Para más información o soporte, contacte a: emil99.444.rodriguez@gmail.com
