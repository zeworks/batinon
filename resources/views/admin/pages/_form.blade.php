@if(!empty($id))
    <pagesform-component :id="{{$id}}"></pagesform-component>
@else
    <pagesform-component></pagesform-component>
@endif