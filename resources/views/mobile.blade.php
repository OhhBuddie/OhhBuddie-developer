@extends('layouts.mobile_marque')

    @section('content')
            {{-- @include('layouts.popup') --}}

        @include('layouts.newcat')

            @include('layouts.tranding')

                 @include('layouts.slider')

                  @include('layouts.banner1') 

                        @include('layouts.wastern')
                        @include('layouts.kurti')
                        {{-- @include('layouts.showtopper') --}}
                        {{-- @include('layouts.men')  --}}
                        @include('layouts.footwear') 
                        @include('layouts.brand')
                        @include('layouts.sharee')
                        @include('layouts.kids')  

    @endsection