# INTERNACIONALIZACIÓN


El sistema de traducción de Symfony, utiliza la variable **default_locale** para conocer el idioma por defecto, además de poder definir los fallback, a los cuales se acudirá si no encuentra traducción para un idioma en concreto:

  

**config/packages/translation.yaml**

    framework:
    	default_locale:  'en'
    	translator:
    		fallbacks:  ['en']

Un vez realizada la configuración, podemos proceder a traducir en controlador o en plantilla.


## **Traducción en controlador**

    $translated  =  $translator->trans('Symfony is great');

Con este método, traducimos el texto que se pasa por parámetro al locale que se esté usando en ese momento, si por ejemplo queremos traducir al francés, crearíamos un fichero .yaml dentro de **translations** de la siguiente forma:

**translations/messages.fr.yaml**

    Symfony is great: J'aime Symfony

 
Es decir, si el locale en el momento de realizar la traducción es **fr_FR**, buscará un fichero **messages.fr.yaml** dentro de **translations** que contenga el texto que se pasa por parámetro con su traducción asociada.

También podemos usar claves en lugar del texto real:

**translations/messages.fr.yaml**

    symfony.is.great: J'aime Symfony

Usamos la clave en el controlador:  

    use  Symfony\Contracts\Translation\TranslatorInterface;
    
    public  function  index(TranslatorInterface  $translator)
    
    {
    
	    $translated  =  $translator->trans('symfony.is.great');

  
 

## **URL’s y cambio de idioma**

Para pasar de un lenguaje a otro, la mejor opción es incluir el locale en la URL, la manera más sencilla de configurar esto sin tener que contemplar rutas para cada idioma es modificar el fichero **annotations.yaml** de la siguiente forma:

    controllers:
    	resource: ../../src/Controller/
    	type: annotation
    	prefix:
    		es: '' # don't prefix URLs for Spanish, the default locale
    		en: '/en'

  
De esta manera, definimos el idioma español sin ningún tipo de prefijo y el prefijo **/en** para el idioma inglés.


Para el cambio de idioma, podemos añadir un par de enlaces en la barra superior que vayan a una URL en concreto con el **_locale** correspondiente:

    <a href="{{ path('note_index',{'_locale': 'es'})}}">(ES</a>
    
    <a href="{{ path('note_index',{'_locale': 'en'})}}">EN)</a>

Cuando añadimos el prefijo, el **locale** cambia y a  partir de ese momento, toda la navegación se hará usando ese prefijo.

 

## Traducción en plantillas

En las plantillas podemos traducir texto con:

    {%  trans  %}Symfony is great{%  endtrans  %}

También podemos traducir las etiquetas:

    {%  trans  %}symfony.is.great{%  endtrans  %}



