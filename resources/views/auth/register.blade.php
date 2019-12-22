@extends('layouts.login')


@section('content')

                    <form method="POST" action="{{ route('register') }}">
                            <span class="title">Register me in </span>
                        @csrf

                        <div class="f-input">
                       

                            
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="f-input">
                           

                        
                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        
                        </div>

                        <div class="f-input">
                           

                      
                                <input id="password" type="password"  placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                         
                        </div>

                        <div class="f-input">
                           
                           
                                <input id="password-confirm" type="password" placeholder="Password confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password">
                         
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
