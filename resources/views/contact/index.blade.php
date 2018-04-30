@extends('base')
@section('content')
    <div class="header">
        <h1>Contact</h1>
    </div>

    <div class="container">
        <a href="#" class="header_logo">
            S<span class="primary">.</span>
        </a>

        <form action="{{route('SendMail')}}" method="post">
            {{Form::token()}}
            <div class="row">
                <div class="col-sm-4">
                    <label for="fullname">Nom complet *</label>
                    <input type="text" id="fullname" name="fullname" class="form-control" required>
                </div>
                <div class="col-sm-4">
                    <label for="email">E-mail *</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="col-sm-4">
                    <label for="phone">Téléphone</label>
                    <input type="text" id="phone" name="phone" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="message">Message *</label>
                    <textarea name="message" id="message" cols="30" rows="10"
                              class="form-control" required></textarea>
                </div>
            </div>
            <button type="submit" class="btn bg-primary-softease mt-2 float-right">Envoyer</button>
            <div class="g-recaptcha float-right"
                 data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
            </div>
        </form>
    </div>

@endsection()

@section('scripts')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection