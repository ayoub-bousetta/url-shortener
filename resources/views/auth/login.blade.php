@extends('layouts.login')

@section('content')





                    <form method="POST" action="{{ route('login') }}">

                        <span  class="title">Log me in </span>
                        

                        @csrf

                        <div class="f-input">
                           
                                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                       
                        </div>

                        <div class="f-input">
                          
                                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
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

                              
                           
                       
                    </form>

                </div>
                <div class="test">
                    <span><b>Testing Info</b></span>
                <span><b>Username</b> :aubbusta@gmail.com</span>
                <span><b>Password</b> :123456789</span>
                </div>

                  
                
@endsection
