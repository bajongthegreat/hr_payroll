
@if (Session::has('message') )
    
    <div id="message" class="alert alert-info"> {{ Session::get('message') }}</div>

@endif

@if (count($errors) > 0) 

  <div id="errors" class="alert alert-danger">



    <ul class="list-unstyled">
    @if (is_object(($errors)))
      @foreach($errors->all() as $error)
        <li> <span class="glyphicon glyphicon-warning-sign" ></span>   {{ $error }}</li>
      @endforeach

    @elseif (is_array($errors))
       @foreach($errors as $error)
        <li> <span class="glyphicon glyphicon-warning-sign" ></span>    {{ $error }}</li>
      @endforeach

        </div>
    @endif
    </ul>
  </div>

 @endif


