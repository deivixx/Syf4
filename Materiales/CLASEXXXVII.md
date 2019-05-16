# Autenticación vía JWT

La autenticación vía JWT, nos permite autenticarnos de forma segura para realizar peticiones del API que así lo requieran, este tipo de autenticación, consiste en obtener un TOKEN a partir de unas credenciales y usar dicho token en cada petición.

## Configuración

1. Instalamos bundle:

	    composer require lexik/jwt-authentication-bundle

2. Creamos directorio jwt dentro del proyecto para albergar claves:

	    $ mkdir -p config/jwt # For Symfony3+, no need of the -p option  

3. Generamos claves

	    $ openssl genrsa -out config/jwt/private.pem -aes256 4096  
	    $ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

4.  Modificamos parámetros de configuración en fichero .env:

	    JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
	    JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
	    JWT_PASSPHRASE=syf4

5. Ahora creamos un par de firewalls en security.yaml (login y api) delante de todos los demás:

	    login:  
	    	pattern: ^/api/login  
	    	stateless: true  
	    	anonymous: true  
	    	json_login:  
	    		check_path: /api/login_check  
	    		success_handler: lexik_jwt_authentication.handler.authentication_success  
	    		failure_handler: lexik_jwt_authentication.handler.authentication_failure  
	      
	    api:  
	    	pattern: ^/api  
	    	stateless: true  
	    	guard:  
	    		authenticators:  
		    		- lexik_jwt_authentication.jwt_token_authenticator

  
  
-   El primero de ellos (login), configura el modo de autenticación en /api/login , la url que recibe y valida las credenciales (/api/login_check)
   
-   El segundo firewall (api), define el mecanismo de autenticación vía JWT para aquellas URL que contengan la cadena /api 
    
6.  Añadimos sección **access_control**:

	     access_control:  
		    - { path: ^/api/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }  
		    - { path: ^/api, roles: IS_AUTHENTICATED_FULLY }

  
  7. Añadimos ruta en **config/routes.yaml**:
 
		    api_login_check:  
	    	    path: /api/login_check

8.  Obtenemos token accediendo a [http://localhost/api/login_check](http://localhost/api/login_check) pasando json con **{"username":"usuario123","password":"pass123"}**
 
	    {  
	    "token" : "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJleHAiOjE0MzQ3Mjc1MzYsInVzZXJuYW1lIjoia29ybGVvbiIsImlhdCI6IjE0MzQ2NDExMzYifQ.nh0L_wuJy6ZKIQWh6OrW5hdLkviTs1_bau2GqYdDCB0Yqy_RplkFghsuqMpsFls8zKEErdX5TYCOR7muX0aQvQxGQ4mpBkvMDhJ4-pE4ct2obeMTr_s4X8nC00rBYPofrOONUOR4utbzvbd4d2xT_tj4TdR_0tsr91Y7VskCRFnoXAnNT-qQb7ci7HIBTbutb9zVStOFejrb4aLbr7Fl4byeIEYgp2Gd7gY"  
	    }

 
9.  Una vez tenemos el token, hacemos petición enviando la cabecera **Authorization Bearer + token**





