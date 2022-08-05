@extends('layouts.auth.app')
@section('content')
<div class="m-grid m-grid--hor m-grid--root m-page">
	<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
		<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
			<div class="m-stack m-stack--hor m-stack--desktop">
				<div class="m-stack__item m-stack__item--fluid">
					<div class="m-login__wrapper">
						<div class="m-login__logo">
							<a href="/">
								<img src="{{url('images/logo-full.png')}}" style="width:100%" />
							</a>
						</div>
						<div class="m-login__signin">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="m-login__head">
								<h3 class="m-login__title">
                                    ¿Olvidaste tu contraseña?
								</h3>
								<div class="m-login__desc">
									Ingresá tu email para resetear tu contraseña
								</div>
							</div>
                            <form class="m-login__form m-form" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}          
								<div class="form-group m-form__group @if ($errors->has('email'))  has-danger @endif">
									<input class="form-control m-input" type="email" required placeholder="Email" name="email" id="m_email" autocomplete="off">
                                    @if ($errors->has('email'))
                                        <div id="email-error" class="form-control-feedback">{{ $errors->first('email') }}</div>
                                    @endif
								</div>
								<div class="m-login__form-action">
									<button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
										Solictar reseteo
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="m-stack__item m-stack__item--center">
					<div class="m-login__account">
						<span class="m-login__account-msg">
                            ¿Recordaste tu contraseña?
						</span>
						&nbsp;&nbsp;
						<a href="{{url('/login')}}"  class="m-link m-link--focus m-login__account-link">
							Ingresar
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-image: url({{url('images/bg-4.jpg')}})">
			<div class="m-grid__item m-grid__item--middle">
				<h3 class="m-login__welcome">
                    Bienvenidos a Hornero
				</h3>
				<p class="m-login__msg">
					Administración de contratos inmobiliarios
				</p>
			</div>
		</div>
	</div>
</div>
@endsection