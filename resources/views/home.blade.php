@extends('layout',["title"=>"home"])

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="row ">
            <div class="col-12">
                <img width="400" height="400" src="{{asset('image/home.png')}}" alt="">
                <form action="{{route("store")}}" method="post">
                    @csrf
                    <div class="row g-3 align-items-center">
                       
                        <div class="col-auto">
                          <input name="url" type="text" class="form-control" placeholder="url">
                         @error('url')
                            <strong class="text-danger">{{ $message }} must using http:// or https://</strong>
                        @enderror
                        </div>
                        <div class="col-auto">
                          <input required name="prefix" type="text" class="form-control" placeholder="prefix">
                          @error('prefix')
                          <br>
                          <strong class="text-danger">{{ $message }} </strong>
                      @enderror
                        </div>
                       
                      </div>
                    <br>
                    <button style="width:100%" class="btn btn-primary" type="submit">done</button>
                </form>
                <br>
                @if ($message = Session::get('url'))
                    <p>{{$message}}</p>
                @endif
                <button onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" style="width:100%" class="btn btn-outline-danger" type="submit">logout</button>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            
        </div>

    </div>

    <div class="container">
        <div class="col-12 mt-5 ">
                <table class="table">
                    <thead>
                      <tr>
  
                        <th scope="col">url</th>
                        <th scope="col">prefix</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $data)
                      <tr>
                        <td>{{$data["url"]}}</td>
                        <td>{{$data["prefix"]}}</td>
                      </tr>
                     
                      @endforeach
                    </tbody>
                  </table>
            </div>
    </div>
@endsection