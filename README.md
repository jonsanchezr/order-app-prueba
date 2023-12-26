# Order App (Prueba)

Proyecto con Laravel 10.x

- Lenguaje [PHP 8.1.25](https://www.php.net/)
- Base de Datos [MySQL](https://www.mysql.com/)
- UX diseñado con [Bootstrapcdn 5.0.0](https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css/)
- Testing Backend con [Phpunit](https://phpunit.de/)

### Requisitos de Sistema
- Extensión SOAP `sudo apt-get install php-soap`
- Extensión SQLite `sudo apt-get install ext-sqlite3`
- Extensión XML `sudo apt-get install php-xml`

## Documentación
Toda la Documentación del Proyecto está en el archivo `docs.pdf`.

## Repositorio
Lo primero que se debe de hacer, es descargar el Repositorio en nuestra máquina local.

`cd ~/code`

`git clone  <repository>`

**Nota:** Será necesario configurar una clave SSH para poder clonar el Repositorio.

### Usuario Git
Se debe configurar el usuario del Repositorio local mediante:

`git config user.name "TuNombre"`

`git config user.email "TuEmail@example.com"`

### Ramas
Existen dos ramas principales:

- master: Dónde se encuentra el código de Producción
- develop: La rama que utilizamos para desarrollar en local. Se debe hacer pull de esta rama para mantenerse actualizado.

Para desarrollar nuevas funcionalidades:

- features: Una rama por cada feature, debe nombrarse como ‘ft/<nombre>’
- hotfixes: Una rama por cada bug, debe nombrarse como 'hf/<nombre>'

### Base de Datos
Por defecto el entorno debe instalado MySQL y creará tantas Base de Datos como se necesiten.

## Setup
Una vez descargado el Repositorio del proyecto, se deben ejecutar los siguientes comandos para realizar el setup:

### Dependencias
 
- Instalar dependencias Back con `composer install`

- (En caso de problemas) En Ubuntu, deberemos instalar `apt-get install libpng-dev -y --no-install-recommends`

### Configuración

- Generar la clave de la aplicación con:

 `php artisan key:generate`

### Variables de Entorno

Hay que copiar el archivo **.env.example** como **.env** en la misma ruta y modificar su contenido
según corresponda. Las variables más importantes a modificar son:

- APP_URL=order-app.test
- DB_DATABASE=order
- DB_USERNAME=order
- DB_PASSWORD=order

## Mailtrap
Es recomendable crear una cuenta en Mailtrap para el desarrollo local. Mailtrap será un buzón de correo ficticio a donde
se enviarán todos los emails de la Aplicación.

- MAIL_MAILER=smtp
- MAIL_HOST=smtp.mailtrap.io
- MAIL_PORT=2525
- MAIL_USERNAME=
- MAIL_PASSWORD=

## Setup de Base de Datos MySQL
La Base de Datos está definida mediante migraciones y seeders de Laravel. Para montarla, desde la máquina virtual:

`php artisan migrate`

Y para rellenar con datos de prueba:

`php artisan db:seed` 

También se pueden hacer ambas cosas a la vez con:

`php artisan migrate --seed`

Para reconstruirla

`php artisan migrate:fresh`

Para reconstruir y rellenar con datos:

`php artisan migrate:fresh --seed`

## Testing

>La BBDD del entorno de pruebas, por defecto hace uso de SQLite.
Por esta razón, será necesario crear un archivo **testing.sqlite** en el directorio **database**.
>
> `touch database/testing.sqlite`

Los test para el Back se encuentran en el directorio __tests__ y se ejecutan mediante **PhpUnit**, 
atendiendo al archivo de configuración **phpunit.xml**

Se puede ejecutar toda la suit de tests con:
 
 `vendor/bin/phpunit`
 
 Para filtrar por clases:
 
 `vendor/bin/phpunit --filter [CLASE]`

## Live App
App de Desarrollo: [No aplica](https://jonsanchezr.github.io/)

App de Producción: [No aplica](https://jonsanchezr.github.io/)

## Licencia
No definida

## Documentación
Existe más documentación en el archivo docs.pdf de este Repositorio.

## Autor
Jonathan Sanchez - jsanchez.dev1991@gmail.com

## Screenshot
[![screenshot-1](https://raw.githubusercontent.com/jonsanchezr/order-app-prueba/main/screenshot-1.jpeg "screenshot-1")](https://raw.githubusercontent.com/jonsanchezr/order-app-prueba/main/screenshot-1.jpeg "screenshot-1")

[![screenshot-2](https://raw.githubusercontent.com/jonsanchezr/order-app-prueba/main/screenshot-2.jpeg "screenshot-2")](https://raw.githubusercontent.com/jonsanchezr/order-app-prueba/main/screenshot-2.jpeg "screenshot-2")
