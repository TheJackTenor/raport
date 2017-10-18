@extends('template.headquarter')
@section('content')
<div class="container">
@if(Auth::check())
	<strong>Berhasil Login Kamu Admin </strong> <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
@else
<strong>PENYUSUP !</strong>
</div>

@endif
@endsection