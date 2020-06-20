<div class="row">
    <div class="col-md-12">
        @if (session('success'))
           <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Sucesso!!! </strong> {{ session('success') }}
            </div>
        @endif
        @if (session('error_message'))
            
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Ops!!! </strong> {{ session('error_message') }}
            </div>
        
        @endif
        
    </div>
</div>