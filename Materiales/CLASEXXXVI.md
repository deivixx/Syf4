# CONFIGURACIÓN API REST

CONFIGURACIÓN Bá

A la hora de pedir elementos, puede ser útil poder filtrar sobre ellos utilizando ciertos campos de la base de datos, los campos por los que filtrar y el tipo de filtrado se puede establecer mediante anotaciones.

Para cada campo, podemos definir los tipos de filtrado: **exact, partial, start y end**

    use ApiPlatform\Core\Annotation\ApiFilter;
    use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
    
    * @ApiFilter(SearchFilter::class, properties={"id": "exact", "title": "partial"})

 
Para el ejemplo anterior en la entidad **Note**, podríamos filtrar de la siguiente forma:

**Nota con id igual a "1" (valor exacto)**
	      GET /api/notes?id=1
	      
**Nota que contenga el valor "hola" en campo title** 
GET /api/notes?title=hola


## Filtrado de fechas

Para el filtrado de fechas en un campo de la entidad, usaremos el tipo de filtro **DateFilter**  :

    use ApiPlatform\Core\Annotation\ApiFilter;
    use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
    
    * @ApiFilter(DateFilter::class, properties={"dueDate"})

Habiendo definido el filtro para el campo **dueDate** de la entidad **NoteItem**, las posibles llamadas serían:


- GET /api/note_items?dueDate[after]=2018-03-19
- GET /api/note_items?dueDate[before]=2018-03-19
- GET /api/note_items?dueDate[strictly_after]=2018-03-19
- GET /api/note_items?dueDate[strictly_before]=2018-03-19

 

## Filtrado rangos

Con el filtro RangeFilter, podemos hacer búsquedas para valores en un rango, mayores que un valor, menores que un valor etc.  

    use ApiPlatform\Core\Annotation\ApiFilter;
    use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;  
      
    * @ApiFilter(RangeFilter::class, properties={"id"})

  
Habiendo definido el filtro para el campo **id** de la entidad **Note**, las posibles llamadas serían:

- GET /api/note?id[gt]=1
- GET /api/note?id[lt]=2
- GET /api/note?id[gte]=2
- GET /api/note?id[lte]=2
- GET /api/note?id[between]=2..4

 
## Filtrando campos null

  
Con este filtrado, podemos obtener aquellos elementos que tengan un campo en concreto vacío o no vacío.


    use ApiPlatform\Core\Annotation\ApiFilter;
    use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
    
    * @ApiFilter(ExistsFilter::class, properties={"attachedFile"})

  
Habiendo definido el filtro para el campo **attachedFile** que puede ser null en la entidad **Note**, las posibles llamadas serían:

- GET /api/note?attachedFile[exists]=true
- GET /api/note?attachedFile[exists]=false



