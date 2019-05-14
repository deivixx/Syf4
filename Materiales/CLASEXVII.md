**WEBPACK ENCORE**

Es un módulo que permite gestionar los assets *js y css* , facilitando el uso modular de los mismos, así como la creación de versiones reducidas para producción.

**Instalación:**

1. Instalamos *node.js* y *yarn*
2. `composer require encore`
3. `yarn install`
4. La configuración de webpack se lleva a cabo a través del fichero `webpack.config.js` :


		.setOutputPath('public/build/')
		.setPublicPath('/build')

		.addEntry('app', './assets/js/app.js')
		.addEntry('home', './assets/js/home.js')
		.addEntry('notes', './assets/js/notes.js')

		.autoProvidejQuery()

- Para cada fichero de js, creamos una entrada en el fichero de configuración
- Por ejemplo, la entrada **app**, hace referencia al fichero *assets/js/app.js* y al ejecutar webpack, creará un fichero **app.js** en el directorio ***public/build***
- Para publicar los ficheros js ejecutamos:	  

	  yarn encore dev
