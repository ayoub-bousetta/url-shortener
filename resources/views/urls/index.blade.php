@extends('layouts.app')





@section('content')

<div class="our-head">
    
    <h1>Shrink That url</h1>
    <div class="our-head_list_info">
      
            <p>Small things are always great! i guess...</p>

</div>
</div>
    
<span class="head-bg">HTTPS</span>


@endsection

@section('form-input')

    


<form-index></form-index>

@endsection
@auth
@section('vue-component')
{{-- 
<example-component  :msg='{!! json_encode($name) !!}'></example-component> --}}

<div class="all_url_profile">

    <div class="urls">

        <urls-data action='{{route('index')}}' url={{URL::to('/')}}   :authid='{!! json_encode(Auth::user()) !!}'></urls-data>

    </div>
<div class="profile">


    <profile-data :authid='{!! json_encode(Auth::user()) !!}'></profile-data>
</div>
</div>


@endsection
@endauth


@section('errors')
 <errors></errors>   
@endsection