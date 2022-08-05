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
								<img src="{{url('images/logo-full.png')}}" />
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
                                    Resetear contraseña
								</h3>
								<div class="m-login__desc">
									Ingresá tu nueva contraseña
								</div>
							</div>
                            <form class="m-login__form m-form" method="POST" action="{{ route('password.update') }}">
                                {{ csrf_field() }}          
                    			<input type="hidden" name="token" value="{{ $token }}">
								<div class="form-group m-form__group @if ($errors->has('email'))  has-danger @endif">
                                    <input id="email" type="email" placeholder="Email" class="form-control  m-input" name="email" value="{{ $email }}" required autofocus />
                                    @if ($errors->has('email'))
                                        <div id="email-error" class="form-control-feedback">{{ $errors->first('email') }}</div>
                                    @endif
								</div>     
								<div class="form-group m-form__group @if ($errors->has('password'))  has-danger @endif">
                                    <input id="password" type="password" placeholder="Contraseña" class="form-control m-input" name="password" required />
                                    @if ($errors->has('password'))
                                        <div id="email-error" class="form-control-feedback">{{ $errors->first('password') }}</div>
                                    @endif
								</div>

								<div class="form-group m-form__group @if ($errors->has('password_confirmation'))  has-danger @endif">
                                    <input id="password-confirm"  placeholder="Confirmar contraseña" type="password" class="form-control m-input m-login__form-input--last" name="password_confirmation" required />
                                    @if ($errors->has('password_confirmation'))
                                        <div id="email-error" class="form-control-feedback">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
								</div>

								<div class="m-login__form-action">
									<button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
										Resetear contraseña
									</button>
								</div>
							</form>
						</div>
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