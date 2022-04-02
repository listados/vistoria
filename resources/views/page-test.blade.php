@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Página de teste</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    <div class="col-md-12 ">
        <div class="">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group" id="list-group">
                        <li class="list-group-item" value="01"><i class="fa fa-arrows-alt"></i> Sala</li>
                        <li class="list-group-item" value="02"><i class="fa fa-arrows-alt"></i> Cozinha</li>
                        <li class="list-group-item" value="03"><i class="fa fa-arrows-alt"></i> Wc Social</li>
                        <li class="list-group-item" value="04"><i class="fa fa-arrows-alt"></i> Garagem</li>
                        <li class="list-group-item" value="05"><i class="fa fa-arrows-alt"></i> Hall de entrada</li>
                      </ul>
                </div>
                
            </div>
        </div>
    </div>
    <example-component></example-component>
@stop

@section('css')
    <style>
        .list-group-item{
            cursor: pointer;
            cursor: -webkit-grabbing;
        }
    </style>
@stop

@section('js')
  {{Html::script('js/plugins/sortable.min.js')}}
  {{Html::script('js/plugins/jquery.binding.js')}}
<script>
    var el = document.getElementById('list-group');
    item = "";
    var sortable = Sortable.create(el,{
       
        animation:450,
      
        onUpdate: function (evt/**Event*/){
            item = evt.item; // the current dragged HTMLElement
            console.log("item = "+item.value);            
        },
        onStart: function (/**Event*/evt) {
            start = evt.oldIndex;
          console.log("Posição  = " + evt.oldIndex);  // element index within parent
        },
        onEnd: function (/**Event*/evt) {
		var itemEl = evt.item;  // dragged HTMLElement
		evt.to;    // target list
		evt.from;  // previous list
		evt.oldIndex;  // element's old index within old parent
		evt.newIndex;  // element's new index within new parent
        console.log('itenE1 = ' + itemEl.oldIndex);
	}

       
    });

</script>
<script src="/js/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="/js/app.js"></script>
@stop