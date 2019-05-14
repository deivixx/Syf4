**ENLACES EN PLANTILLAS**

- Enlaces a URL
	
	  <a href="{{path('welcome')}}">Home</a>
      <a href="{{path('article_show',{'slug': article.slug})}}">
      <a href="{{url('welcome')}}">Home</a>  


-   Enlaces a assets
   
	    <img src="{{asset('images/logo.png')}}" alt="Symfony!"/>  
      
	    <link href="{{asset('css/blog.css')}}" rel="stylesheet"/>
