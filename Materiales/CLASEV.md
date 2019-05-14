**DESPLIEGUE APLICACIÓN**
  
XAMPP:

1. Instalamos fichero **.htaccess**: 

    composer require symfony/apache-pack

2. Modificamos fichero **httpd.conf**:
  
		  <VirtualHost *:80>
		  ServerName domain.tld
		    ServerAlias www.domain.tld
		    DocumentRoot C:\xampp\htdocs\project\public
		    <Directory C:\xampp\htdocs\project\public>
		    AllowOverride None
		    Order Allow,Deny
		    Allow from All
		    FallbackResource /index.php
		    </Directory>
		    <Directory C:\xampp\htdocs\project\public\bundles>
		    FallbackResource disabled
		    </Directory>
		    </VirtualHost>

 
Servidor embebido:

**`php bin/console server:run`**

 - Esto nos permitirá acceder a la web en localhost:8000
 - Si queremos usar mysql debemos instalar el servidor y arrancarlo

  

Nginx:

1. Descargamos **nginx** para Windows, script para arrancar php-cgi y nginx.exe y configuración:

  
		server {

		listen 8088;

		root D:\Projects\symfonypr\public;
		location / {

		try_files $uri /index.php$is_args$args;

		}

  

		location ~ ^/index\.php(/|$) {

		fastcgi_pass 127.0.0.1:9123;

		fastcgi_split_path_info ^(.+\.php)(/.*)$;

		include fastcgi_params;

		  

		fastcgi_param SCRIPT_FILENAME 	$realpath_root$fastcgi_script_name;

		fastcgi_param DOCUMENT_ROOT $realpath_root;

		internal;

		}

  

		location ~ \.php$ {

		return 404;

		}

  

		#error_log /var/log/nginx/project_error.log;

		#access_log /var/log/nginx/project_access.log;

		}

  
  
  
  
  
  
  
  
  
  
  
  
  
  

VAGRANT:

1.  Instalamos homestead en nuestro proyecto:
**`composer require laravel/homestead --dev`**    
2.  Creamos fichero de configuración **homestead.yaml**: **`vendor\bin\homestead.bat make`**
3.  Ejecutamos **vagrant up** para arrancar la máquina de pruebas
4.  Una vez que haya arrancado, podemos acceder al proyecto en [http://homestead.test](http://homestead.test) , para esto debemos añadir entrada en el fichero hosts de windows (C:\Windows\System32\drivers\etc\hosts)
5.  Configuración fichero homestead.yaml:
    


  Configuración básica:


		ip: 192.168.10.10 # ip equipo

		memory: 2048 #ram

		cpus: 1 #nº cpus

		provider: virtualbox #proveedor

		name: symfonypr  #nombre vm

		hostname: symfonypr  #nombre host

  
 
Configuración del mapeo de directorios:

  

	folders:

	-
	  map: 'D:\Projects\symfonypr' #directorio Windows

	  to: /home/vagrant/code #directorio Homestead

  

	sites:

	-

		map: homestead.test

		to: /home/vagrant/code/public

  

	databases:

	- homestead
	mariadb: true

  
  
  

6.  Comandos útiles vagrant:
    
-   Para destruir la máquina ejecutar: **`vagrant destroy --force`**
    
-   Apagar la máquina: **`vagrant halt`**
    
-   Reiniciar la máquina:  **`vagrant reload`**








