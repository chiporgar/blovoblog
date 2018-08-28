


  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <form method="POST" action="{{ route('admin.posts.store') }}">
      
      {{ csrf_field() }}

      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Agrega el título  de tu nueva publicación</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              
              <div class="form-group 
              {{ 

               $errors->has('title') ? 'has-error' :''

                 }}">
                
              {{--   <label>titulo de la publicación</label> --}}

                <input 
                type="text"  
                name="title" 
                class="form-control"
                placeholder="Ingresa Aquí el título de la publicación"
                value="{{ old('title') }}"
                required 
                >

              
                  {!! $errors->first('title',
                    '<span class="help-block">
                      :message
                    </span>'
                  ) !!}
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button  class="btn btn-primary">Crear Publicación</button>
          </div>
        </div>
      </div>

   </form>   
</div>
