@if (Request::get('output') != 'layout')
  @include('layout.withlayout')
@else
   @include('layout.withoutlayout')
@endif
