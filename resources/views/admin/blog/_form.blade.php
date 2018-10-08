@if(!empty($id))
    <blogsform-component :id="{{$id}}"></blogsform-component>
@else
    <blogsform-component></blogsform-component>
@endif