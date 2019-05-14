**OPCIONES RENDERIZADO FORMULARIOS**

A la hora de renderizar un formulario desde twig, disponemos de distintos niveles de detalle, pudiendo renderizar un formulario completamente con una sola sentencia o ir dibujando campo a campo:

- Forma básica:

	  {{  form(form)  }}


- Campo a campo

		{{  form_start(form)  }}  
			<div  class="my-custom-class-for-errors">  
				{{  form_errors(form)  }}  
			</div>  
			<div  class="row">  
				<div  class="col">  
					{{  form_row(form.task)  }}  
				</div>  
				<div  class="col"  id="some-custom-id">  
					{{  form_row(form.dueDate)  }}  
				</div>  
			</div>  
		{{  form_end(form)  }}

- Cada campo se puede desglosar renderizando el widget que lo representa, etiqueta, texto de ayuda y error:

		<div class="form-control">
		    <i class="fa fa-calendar"></i> {{ form_label(form.dueDate) }}
		    {{ form_widget(form.dueDate) }}

		    <small>{{ form_help(form.dueDate) }}</small>

		    <div class="form-error">
		        {{ form_errors(form.dueDate) }}
		    </div>
		</div>