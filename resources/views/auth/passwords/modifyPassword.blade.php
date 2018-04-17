@extends('admin.base')

@section('content')

    <div class="container">
        <div class="card mt-2">
            <div class="card-header">Modifier mon mot de passe</div>
            <div class="card-body">
                <form action="{{route('password.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="text" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirmation du mot de passe</label>
                        <input type="text" class="form-control" name="confirm_password">
                    </div>

                    <i class="fa fa-exclamation-circle" style="color: red;"></i><small> Le mot de passe doit contenir au moins 6 caractères.</small>
                    <button type="submit" class="btn btn-primary float-right">Confirmer</button>
                </form>
            </div>
        </div>
    </div>

@endsection