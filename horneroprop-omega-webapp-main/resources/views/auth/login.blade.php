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
								<img src="{{url('images/logo-full.png')}}" style="width: 100%;" />
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Conectarse al sistema
								</h3>
							</div>
                            {!! Form::open(['route' => 'login', 'class' => 'm-login__form ']) !!}
                            <div class="form-group m-form__group @error('email') has-danger @enderror">
                                    {!! Form::email('email', null, ['class' => 'form-control m-input', 'placeholder' => 'Email','autocomplete'=>'off','autofocus','required']) !!}

                                    @error('email')
                                        <div id="email-error" class="form-control-feedback">{{ $message }}</div>
                                    @enderror
								</div>
								<div class="form-group m-form__group  @error('password') has-danger @enderror">
                                    {!! Form::password('password', ['class' => 'form-control m-input m-login__form-input--last','placeholder'=>'Contraseña','required']) !!}
                                    @error('password')
                                        <div id="password-error" class="form-control-feedback">{{ $message }}</div>
                                    @enderror
								</div>
								<div class="row m-login__form-sub">
									<div class="col m--align-left">
										<label class="m-checkbox m-checkbox--focus">
											<input type="checkbox" name="remember">
											Recordarme
											<span></span>
										</label>
									</div>
									<div class="col m--align-right">
										<a href="{{url('password/reset')}}" class="m-link">
                                            ¿Olvidaste tu contraseña?
										</a>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
										Ingresar
									</button>
								</div>
                            {!! Form::close() !!}
						</div>
				    </div>
				</div>
				<!-- <div class="m-stack__item m-stack__item--center">
					<div class="m-login__account">
						<span class="m-login__account-msg">
							Don't have an account yet ?
						</span>
						&nbsp;&nbsp;
						<a href="javascript:;" id="m_login_signup" class="m-link m-link--focus m-login__account-link">
							Sign Up
						</a>
					</div>
				</div> -->
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