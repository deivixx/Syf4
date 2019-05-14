**BOOTSTRAP Y JQUERY**

***Bootstrap***

Para poder usar bootstrap en nuestro proyecto, lo añadimos con yarn:

    yarn add bootstrap --dev
  
Esto nos instalará bootstrap dentro del directorio **node_modules**

El siguiente paso es importar bootstrap en nuestro css:

    @import  "~bootstrap/dist/css/bootstrap.css";

Esto importa el fichero **node_modules/bootstrap/dist/css/bootstrap.scss**

 
Para utilizar el javascript de bootstrap, añadimos esto en nuestro js:

    require(‘bootstrap’)

Esto nos dará error porque no disponemos de *jquery* y *popper*, así que los instalamos:

    npm install --save jquery popper.js



***Jquery***

Ya hemos instalado jquery para bootstrap, por tanto, si queremos usarlo en un js tenemos que añadir la siguiente línea:

    require(‘jquery’)

  

Si intentamos usar una función de jquery de la forma **$('div');** no funcionará, ya que no encuentra la variable $, para que esto funcione o bien ponemos jQuery en lugar de $ : **jQuery('div');**  o agregamos jquery de esta forma: `const $ = require('jquery');`

Para evitar tener que añadir jquery en todos aquellos scripts que lo requieran, la mejor opción es descomentar la línea **.autoProvidejQuery()** en el fichero de configuración de webpack.

  
  
