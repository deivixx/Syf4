## PREPARACIÓN ENTORNO (SERVIDOR LOCAL)


**XAMPP**

1.  Descargamos XAMPP de su página oficial  
2.  Instalamos en   c:\
3.  Arrancamos **xampp_control.exe** e iniciamos los servicios de *apache y mysql*
    

**Nginx**

 1. Descargamos Nginx desde su [ página oficial](http://nginx.org/en/download.html) y descomprimimos en c:

Script inicio:

    @echo off
    start /b c:\xampp\php\php-cgi.exe -b 127.0.0.1:9123
    nginx.exe

Script parada:

  

    nginx.exe -s stop
