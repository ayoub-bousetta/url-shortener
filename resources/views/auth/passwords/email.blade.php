@extends('layouts.login')

@section('content')

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">

                            <span class="title">Give me back my PW </span>
                        @csrf

                        <div class="f-input">

                          
                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group-btn">
                           
                                <button type="submit" class="btn btn-primary">
                                        <i class="material-icons">
                                                call_made
                                                </i>
                                </button>
                       
                        </div>
                    </form>
        
@endsection
