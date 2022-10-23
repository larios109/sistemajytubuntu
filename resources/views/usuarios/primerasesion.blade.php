<link rel="icon" href="{{ asset('images/apple-icon-57x57.png') }}">

<x-guest-layout>
    <h2 class="text-center">Actualizar Nombre y Contraseña<hr></h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('primerasesion.store')}}" method="POST" class="needs-validation" novalidate>
                @csrf 

                <div class="row mb-3">
                    <div class="form-group mt-3">
                        <label for="name">Nombre de Usuario</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" 
                        minlength = "10" maxlength="30" onkeyup="this.value=this.value.toUpperCase();" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>    
               <div class="row mb-3">

                <div class="form-group mt-3">
                    <label for="password_actual">Contraseña Actual</label>
                    <input type="password" name="password_actual" class="form-control @error('password_actual') is-invalid @enderror" required data-toggle="password">
                        @error('password_actual')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group mt-3">
                        <label for="new_password ">Nueva Contraseña</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required data-toggle="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group mt-3">
                        <label for="confirm_password">Confirmar nueva Contraseña</label>
                        <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"required data-toggle="password">
                        @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row text-center mb-4 mt-5">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="formSubmit">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</x-guest-layout>


<!--Show/Hide password-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>