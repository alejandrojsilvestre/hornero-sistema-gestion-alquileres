<div class="modal fade" id="_formPersona" tabindex="-1" role="dialog" aria-labelledby="FormularioDePersonas">
	<div class="modal-dialog modal-xlg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formPersonaTitle">
					Formulario de Personas
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						×
					</span>
				</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['id' => 'formPersona', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed']) !!}
					{!! Form::hidden('persona_id') !!}
					{!! Form::hidden('persona_type') !!}
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="col-lg-4">
								{!! Form::label('nombre', 'Nombre') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-user"></i>
									</span>
									{!! Form::text('nombre', null, ['class' => 'form-control m-input', 'placeholder' => 'Nombre','required','id'=>'personaNombre']) !!}
								</div>
							</div>
							<div class="col-lg-4">
								{!! Form::label('apellido', 'Apellido') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-user"></i>
									</span>
									{!! Form::text('apellido', null, ['class' => 'form-control m-input', 'placeholder' => 'Apellido','required','id'=>'personaApellido']) !!}
								</div>
							</div>
							<div class="col-lg-4">
								{!! Form::label('personaTipo', 'Tipo') !!}
								<div class="input-group m-input-group m-input-group--square">
								{!! Form::select('tipos[]', $tiposPersona, null, ['class' => 'form-control m-input', 'multiple', 'required','id'=>'personaTipo'])!!}
								</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-4">
								{!! Form::label('email', 'Email') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-at"></i>
									</span>
									{!! Form::email('email', null, ['class' => 'form-control m-input', 'placeholder' => 'E-mail','id'=>'personaEmail']) !!}
								</div>
							</div>
							<div class="col-lg-4">
								{!! Form::label('telefono', 'Telefono') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-phone"></i>
									</span>
									{!! Form::tel('telefono', null, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de Telefono', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.','id'=>'personaTelefono']) !!}
								</div>
							</div>
							<div class="col-lg-4">
								{!! Form::label('celular', 'Celular') !!}
								<div class="input-group m-input-group m-input-group--square">
									<!-- <span class="input-group-addon">
										<a class="m-tooltip" data-toggle="modal" data-target="#_celularPhone" data-skin="dark" data-placement="top" title="" data-original-title="Enviar Mensaje"><i class="la la-comments"></i></a>
									</span> -->
									<span class="input-group-addon">
										<a class="m-tooltip enviarWhatsApp" data-skin="dark" data-placement="top" title="" data-original-title="Enviar WhatsApp"><i class="la la-whatsapp"></i></a>
									</span>
									{!! Form::hidden('cod_pais', 54, ['id'=>'personaCodPais']) !!}
									{!! Form::tel('celular', null, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de Celular', 'style' => 'width:100%!important', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.','id'=>'personaCelular']) !!}
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
									{!! Form::text('direccion', null, ['class' => 'form-control m-input', 'placeholder' => 'Calle, nro, piso, depto.', 'autocomplete' => 'off', 'id' => 'peopleAddress']) !!}
								</div>
								<div class="form-control-feedback addressValidate hide text-danger">La ubicacion es incorrecta.</div>
							</div>
							<div class="col-lg-4">
								{!! Form::label('cod_postal', 'Cod. Postal') !!}
								<div class="m-input-icon m-input-icon--right">
									{!! Form::text('cod_postal', null, ['class' => 'form-control m-input', 'placeholder' => 'Codigo Postal','id'=>'personaCodPostal']) !!}
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
										{!! Form::select('tipo_documento_id', $tiposDocumento, null, ['class' => 'form-control m-input','id'=>'personaTipoDoc', 'modal'=>'_formPersona'])!!}
					                </div>
				                	{!! Form::tel('nro_documento', null, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de Documento', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.','id'=>'personaNroDoc']) !!}
				              	</div>
				            </div>
				            <div class="col-lg-4">
								{!! Form::label('tipo_iva_id', 'Condicion I.V.A.') !!}
				              	<div class="input-group mb-3">
					                <div class="input-group-prepend-select">
										{!! Form::select('tipo_iva_id', $tiposIva, null, ['class' => 'form-control m-input','id'=>'personaTipoIva'])!!} 
					                </div>
									{!! Form::tel('nro_cui', null, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de C.U.I.', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.','id'=>'personaNroCui']) !!}
				              	</div>
				            </div>
							<div class="col-lg-4">
								{!! Form::label('fecha_nacimiento', 'Fecha de Nacimiento') !!}
								<div class="input-group">
									{!! Form::text('fecha_nacimiento', null, ['class' => 'form-control m-input  m-birthdate', 'placeholder' => 'Fecha de Nacimiento','id'=>'personaFecNacimiento']) !!}
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
								<div class="col-lg-12 centered">
									{!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}
									{!! Form::button('Cancelar',['class'=>'btn btn-secondary','data-dismiss' => 'modal']) !!}
            						<a href="" target="_blank" class="btn btn-primary perfil-persona-link hide"> Perfil</a>
								</div>
							</div>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>