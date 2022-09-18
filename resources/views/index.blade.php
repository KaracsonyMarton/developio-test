@extends('layouts.guest')
@section('content')
    <h1 class="text-center">Hibajegy létrehozása</h1>

    <div class='container mt-3 mb-5'>
        <form method="POST" action="{{route('ticket.store')}}">
            @csrf
            <div class='row mt-5'>
                <div class='col-sm-12'>
                    <div class='card'>
                        <div class='card-header d-flex align-items-center'>
                            Hibajegy
                        </div>
                        <div class='card-body'>
                            <div class='form-group'>
                                <label for='name'>Név</label>
                                <input class='form-control' id='name' type='text' name="name">
                            </div>
                            <div class='form-group mt-3'>
                                <label for='email'>E-mail cím</label>
                                <input class='form-control' id='email' type='email' name="email">
                            </div>
                            <div class='form-group mt-3'>
                                <label for='subject'>Tárgy</label>
                                <input class='form-control' id='subject' type='text' name="subject">
                            </div>
                            <div class='form-group mt-3'>
                                <label for='message'>Leírás</label>
                                <textarea class='form-control' id='message' rows='4' name="message"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='form-group d-flex justify-content-end mt-3'>
                <button class='btn d-flex align-items-center mr-3' type="reset">
                    Mégse
                </button>
                <button class='btn btn-primary d-flex align-items-center float-right' type="submit">
                    Mentés
                </button>
            </div>
        </form>
    </div>

@endsection
