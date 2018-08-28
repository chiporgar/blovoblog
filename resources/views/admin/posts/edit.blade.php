@extends('admin.layout')


@section('header')
  <h1>
 	Post
    <small>Crear Publicación</small>
  </h1>

  <ol class="breadcrumb">
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Inicio</a></li>


      <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> crear</a></li>


    <li class="active">Posts</li>
  </ol>
@stop

@section('content')
	
	<div class="row">	
	   <form method="POST" action="{{ route('admin.posts.update',$post) }}">
			
			{{ csrf_field() }}

			{{ method_field('PUT') }}

			<div class="col-md-8">
				
				<div class="box box-primary">

				

						<div class="box-body">

							<div class="form-group 
							{{ 

							 $errors->has('title') ? 'has-error' :''

						     }}">
								
								<label>titulo de la publicación</label>

								<input 
								type="text"  
								name="title" 
								class="form-control"
								placeholder="Ingresa Aquí el título de la publicación"
								value="{{ old('title',$post->title) }}"
								>

							
									{!! $errors->first('title',
										'<span class="help-block">
											:message
										</span>'
									) !!}
							
							</div>

						  

							 <div class="form-group  {{ 

							 $errors->has('body') ? 'has-error' :''

						     }}">
								
								<label>Contenido de la publicación</label>
								
								<textarea

									id="editor1" 
									rows="10" 
									name="body" 
									class="form-control"
									placeholder="Ingresa el contendio completo de la publicación">
									{{ old('body',$post->body)}}
								</textarea>

									{!! $errors->first('body',
										'<span class="help-block">
											:message
										</span>'
									) !!}


							</div>
							
						

						


						
						</div>
				</div>
			</div>


			<div class="col-md-4">
				<div class="box box-primary">
					
					<div class="box-body">

					   <div class="form-group">
			                <label>Fecha Publicación</label>

			                <div class="input-group date">
			                  <div class="input-group-addon">
			                    <i class="fa fa-calendar"></i>
			                  </div>

			                  <input 
			                  	  value="{{ 
			                  	  	old('published_at',
			                  	  	$post->published_at 
			                  	  	? $post->published_at->format('m/d/Y')
			                  	  	: null
			                  	  ) 
			                  	  }}"
								  name="published_at"
				                  type="text" 
				                  class="form-control pull-right" 
				                  id="datepicker">
			                </div>
			                <!-- /.input group -->
			             </div>

						 <div class="form-group {{ 

							 $errors->has('category') ? 'has-error' :''

						     }}">

						 	<label> Categorias </label>

						     <select 
						     name="category_id" 
						     class="form-control select2">
						     	<option value=""> Selecciona Categoria</option>

						     	@foreach($categories as $cat)
									<option value="{{$cat->id}}" 

										{{ old('cat',$post->category_id) == ($cat->id) ?'selected' 
										: '' }}

										>{{$cat->name}} </option>
						     	@endforeach

						     </select>

						     	{!! $errors->first('category_id',
										'<span class="help-block">
											:message
										</span>'
									) !!}

						 </div>

						 <div class="form-group">
						 	<label> Etiquetas</label>
							 <select 

							     name="tags[]"
								 class="form-control select2" 
								 multiple="multiple" 
								 data-placeholder="Etiquetas"
					             tyle="width: 100%;">
								@foreach($tags as $tag)

									<option 
									  {{ collect(old('tags',$post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}
									  value="{{$tag->id}}">
										{{$tag->name}}
									</option>	
								@endforeach
				                  
			                </select>

						 </div>


					     <div class="form-group {{ 

							 $errors->has('excerpt') ? 'has-error' :''

						     }}">
							
							<label>Extracto</label>
							
							<textarea 
								name="excerpt" 
								class="form-control"
								placeholder="Ingresa un Extracto de la publicación">{{ old('excerpt',$post->excerpt)}}
							</textarea>
								   	{!! $errors->first('excerpt',
										'<span class="help-block">
											:message
										</span>'
									) !!}
							
						</div>
						
						<div class="form-group">
							<div class="dropzone">
								

							</div>
						</div>



						<div class="form-group">
							
							<button 
							    class="btn btn-primary btn-block"
							    type="submit">

								 Guardar Publicación
							</button>
						</div>



					</div>
				</div>
			</div>
		</form>

 @if($post->photos->count()) 

		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body">
					<div class="row">

						@foreach($post->photos as $photo)

						   <form  method="POST" 
						   action="{{ route('admin.photos.destroy',$photo)}}">

						   		{{ method_field('DELETE') }}
						   		{{ csrf_field() }}

							 <div class="col-md-2">
									
									<button class="btn btn-danger btn-xs" style="position: absolute;">
										<i class="fa fa-remove">
											
										</i>
									</button>

									<img src="{{ url($photo->url) }}" class="img-responsive">

								</div>
							 </form>	
						   @endforeach

					  </div>
				 </div>
			</div>
		 </div>

    @endif		 




	</div>

@stop


@push('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css">
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">


   <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">

@endpush

@push('scripts')

	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
	
	<script src="/adminlte/bower_components/ckeditor/ckeditor.js"></script>

	<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

	<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	
	<script type="text/javascript">

		
	  	//Date picker
	    $('#datepicker').datepicker({
	      autoclose: true
	    })

	    //Ck Editor Enriquecido.

		 CKEDITOR.replace('editor1')
		 CKEDITOR.config.height=310;

		 //Selector Inicializador
		  $('.select2').select2({

		  	 tags:true
		  })
		 
		//nueva Instancía de DropZone

		var myDropZone = new Dropzone('.dropzone',{

			url: '/admin/posts/{{$post->url}}/photos',
			paramName:'photo', // es el nomnbre que le damos para  acceder al objeto foto
			acceptedFiles:'image/*', //para que solo se suban  fotos
			maxFilesSize: 2,
			maxFiles: 10,//para permitir la maxima cantidad de fotos que podemos subir
			dictDefaultMessage:'Arrastra las fotos aqui para subirlas',
			headers:{
				'X-CSRF-TOKEN':'{{ csrf_token()}}'
			}
		});		
		///esta parte es para dar mejores  mensajes al usuario respecto a los errores que peuda provocar el servidor
		 //dos parametros archvo, Y respuesta del servidor
		myDropZone.on('error',function(file,res){

			var msg = res.errors.photo[0];
			$('.dz-error-message:last > span').text(msg);

		});
		//es necesario hacer esto. Para que no autoInicialize el DropZone
		Dropzone.autoDiscover = false;	 


	</script>
@endpush








