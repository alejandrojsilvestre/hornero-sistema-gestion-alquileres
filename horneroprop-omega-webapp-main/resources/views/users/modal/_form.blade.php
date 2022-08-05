<div class="modal fade" id="_formUsuario" role="dialog" aria-labelledby="FormularioDeUsuarios">
	<div class="modal-dialog modal-xlg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formUsuarioTitle">
					Formulario de Usuarios
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						×
					</span>
				</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['id' => 'formUsuario', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'autocomplete' => 'off']) !!}
					{!! Form::hidden('user_id') !!}
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="col-lg-6">
								{!! Form::label('email', 'Email') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-at"></i>
									</span>
									{!! Form::email('email', null, ['class' => 'form-control m-input', 'placeholder' => 'E-mail', 'autocomplete' => 'off', 'required']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								{!! Form::label('password', 'Contraseña') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon newUserFormPassword">
										<i class="la la-key"></i>
									</span>
									{!! Form::password('password', ['class' => 'form-control m-input userFormPassword','required','placeholder' => '*************', 'autocomplete' => 'off']) !!}
									<span class="input-group-addon m-tooltip changeUserFormPassword" style="display: none;" data-skin="dark" data-placement="top" title="" data-original-title="Cambiar contraseña">
										<i class="la la-lock"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg">
								{!! Form::label('nombre', 'Nombre') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-user"></i>
									</span>
									{!! Form::text('nombre', null, ['class' => 'form-control m-input', 'placeholder' => 'Nombre','required', 'autocomplete' => 'off']) !!}
								</div>
							</div>
							<div class="col-lg">
								{!! Form::label('apellido', 'Apellido') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-user"></i>
									</span>
									{!! Form::text('apellido', null, ['class' => 'form-control m-input', 'placeholder' => 'Apellido','required', 'autocomplete' => 'off']) !!}
								</div>
							</div>
						
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg">
								{!! Form::label('telefono', 'Telefono') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-phone"></i>
									</span>
									{!! Form::tel('telefono', null, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de Telefono', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.', 'autocomplete' => 'off']) !!}
								</div>
							</div>
							<div class="col-lg">
								{!! Form::label('cod_pais', 'Celular') !!}
								<div class="input-group m-input-group m-input-group--square">
								<span class="input-group-addon">
									<i class="la la-mobile-phone"></i>
								</span>
								{!! Form::hidden('cod_pais', null, ['id'=>'cod_pais']) !!}
								{!! Form::tel('celular', null, ['class' => 'form-control m-input', 'style' => 'width:100%!important', 'autocomplete' => 'off', 'placeholder' => 'Nro. de Celular', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numericos.']) !!}
								</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-8">
								{!! Form::label('direccion', 'Dirección') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-home"></i>
									</span>
									{!! Form::text('direccion', null, ['class' => 'form-control m-input', 'placeholder' => 'Calle, nro, piso, depto.', 'autocomplete' => 'off', 'id' => 'userAddress']) !!}
								</div>
								<div class="form-control-feedback addressValidate hide text-danger">La ubicacion es incorrecta.</div>
							</div>
							<div class="col-lg-4">
								{!! Form::label('cod_postal', 'Cod. Postal') !!}
								<div class="m-input-icon m-input-icon--right">
									{!! Form::text('cod_postal', null, ['class' => 'form-control m-input', 'placeholder' => 'Codigo Postal', 'autocomplete' => 'off']) !!}
									<span class="m-input-icon__icon m-input-icon__icon--right">
										<span>
											<i class="la la-bookmark-o"></i>
										</span>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-4">
								{!! Form::label('tipo_documento_id', 'Documento') !!}
				              	<div class="input-group mb-3">
					                <div class="input-group-prepend-select">
										{!! Form::select('tipo_documento_id', $tiposDocumento, null, ['class' => 'form-control m-input', 'autocomplete' => 'off'])!!}
					                </div>
				                	{!! Form::tel('nro_documento', null, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de Documento', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.', 'autocomplete' => 'off']) !!}
				              	</div>
				            </div>
				            <div class="col-lg-4">
								{!! Form::label('tipo_iva_id', 'Condicion I.V.A.') !!}
				              	<div class="input-group mb-3">
					                <div class="input-group-prepend-select">
										{!! Form::select('tipo_iva_id', $tiposIva, null, ['class' => 'form-control m-input', 'autocomplete' => 'off'])!!} 
					                </div>
									{!! Form::tel('nro_cui', null, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de C.U.I.', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.', 'autocomplete' => 'off']) !!}
				              	</div>
				            </div>
							<div class="col-lg-4">
								{!! Form::label('fecha_nacimiento', 'Fecha de Nacimiento') !!}
								<div class="input-group date">
									{!! Form::text('fecha_nacimiento', null, ['class' => 'form-control m-input  m-birthdate', 'placeholder' => 'Fecha de Nacimiento', 'autocomplete' => 'off']) !!}
									<span class="input-group-addon">
										<i class="la la-calendar"></i>
									</span>
								</div>	
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-4"></div>
								<div class="col-lg-8">
									{!! Form::submit('Guardar',['class'=>'btn btn-primary', 'autocomplete' => 'off']) !!}
									{!! Form::button('Cancelar',['class'=>'btn btn-secondary','data-dismiss' => 'modal', 'autocomplete' => 'off']) !!}
								</div>
							</div>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>