## CONFIGURACIÓN BASE DE DATOS


**VAGRANT**  

La configuración del sistema gestor de base de datos, está relacionado, en este caso, con Vagrant, ya que, accederemos a una base de datos ubicada dentro de la máquina virtual.

La configuración de la máquina virtual se hará a través del fichero **Homestead.yaml**.

Vamos a comentar cada aspecto de la configuración:

- Dirección IP de la máquina virtual, memoria RAM y Nº de cpu's
			  
	  ip: 192.168.10.10
	  memory: 2048
	  cpus: 1
	  
- Mapeo de directorios, es decir, el directorio local donde se encuentra nuestra aplicación y el directorio correspondiente en la máquina virtual. Lo cambios que hagamos en local, se reflejarán en la máquina virtual de forma automática:
			  
	  folders:
	    -
        map: 'D:\project'
        to: /home/vagrant/code

- Establecemos los sitios web que serán accesibles en la máquina virtual y el directorio asociado en la VM:
			  
	  sites:
	    -
        map: project.test
        to: /home/vagrant/code/public

Para que podamos acceder al sitio web desde la máquina física, añadimos el sitio en el fichero hosts ubicado en *c:\windows\system32\drivers\etc* :

    192.168.10.10 project.test

- Definimos el nombre de las bases de datos que necesitemos, si quremos usar MariaDB en lugar de MySQL ponemos **mariadb** a **true** , las credenciales serán (homestead/secret). Si tenemos un phpMyAdmin instalado en local, podemos acceder a una bbdd de vagrant en *127.0.0.1:33060*:
			  
	  databases:
		    - notes
	  mariadb: true



Una vez configurada la máquina, nos situamos desde consola en el directorio de nuestro proyecto y ejecutamos:
	

    vagrant up


**SYMFONY**  
  
Una vez configurada nuestra base de datos, tenemos que indicar a Symfony cómo acceder a ella, para esto usaremos el fichero **.env**

    DATABASE_URL=mysql://homestead:secret@192.168.10.10:3306/notes

  

