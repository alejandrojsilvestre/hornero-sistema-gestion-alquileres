<div class="modal fade" id="_formInmueble" tabindex="-1" role="dialog" aria-labelledby="FormularioDeInmuebles">
	<div class="modal-dialog modal-xlg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formInmuebleTitle">
					Formulario de Inmuebles
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						×
					</span>
				</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['id' => 'formInmueble', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed']) !!}
					{!! Form::hidden('inmueble_id') !!}
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
						    <div class="col-lg-8">
								{!! Form::label('direccion', 'Dirección') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-home"></i>
									</span>
									{!! Form::text('direccion', null, ['class' => 'form-control m-input', 'placeholder' => 'Calle, nro, piso, depto.', 'autocomplete' => 'off', 'required']) !!}
								</div>
								<div class="form-control-feedback addressValidate hide text-danger">La ubicacion es incorrecta.</div>
							</div>
							<div class="col-lg-4">
								{!! Form::label('cod_postal', 'Cod. Postal') !!}
								<div class="m-input-icon m-input-icon--right">
									{!! Form::text('cod_postal', null, ['class' => 'form-control m-input', 'placeholder' => 'Codigo Postal','id'=>'inmuebleCodPostal']) !!}
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
								{!! Form::label('tipo_id', 'Tipo') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-tag"></i>
									</span>
									<div class="input-group m-input-group m-input-group--square">
									{!! Form::select('tipo_id', $tiposInmueble, ['class' => 'form-control m-input', 'placeholder' => 'Tipo de Inmueble','required' => 'required']) !!}
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								{!! Form::label('subtipo_id', 'Subtipo') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-tag"></i>
									</span>
									<div class="input-group m-input-group m-input-group--square">
									{!! Form::select('subtipo_id', $subtiposInmueble, ['class' => 'form-control m-input', 'placeholder' => 'Subtipo de Inmueble']) !!}
									</div>
								</div>
							</div>
						</div>

						<div class="form-group m-form__group row">
							<div class="col-lg-2">
								{!! Form::label('ambientes', 'Ambientes') !!}
								<div class="input-group">
									<span class="input-group-addon">
										<i class="la la-arrows"></i>
									</span>
									{!! Form::tel('ambientes', null, ['class' => 'form-control m-input', 'placeholder' => 'Cantidad', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>	
							</div>
							<div class="col-lg-2">
								{!! Form::label('dormitorios', 'Dormitorios') !!}
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-hotel"></i>
									</span>
									{!! Form::tel('dormitorios', null, ['class' => 'form-control m-input', 'placeholder' => 'Cantidad', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>	
							</div>
							<div class="col-lg-2">
								{!! Form::label('banos', 'Baños') !!}
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-bath"></i>
									</span>
									{!! Form::tel('banos', null, ['class' => 'form-control m-input', 'placeholder' => 'Cantidad', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>	
							</div>
							<div class="col-lg-2">
								{!! Form::label('cocheras', 'Cocheras') !!}
								<div class="input-group">
									<span class="input-group-addon">
										<i class="la la-car"></i>
									</span>
									{!! Form::tel('cocheras', null, ['class' => 'form-control m-input', 'placeholder' => 'Cantidad', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>	
							</div>
							<div class="col-lg-2">
								{!! Form::label('condicion_id', 'Condicion') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-question-circle"></i>
									</span>
									<div class="input-group m-input-group m-input-group--square">
									{!! Form::select('condicion_id', $tiposCondicion, ['class' => 'form-control m-input', 'placeholder' => 'Condicion']) !!}
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								{!! Form::label('orientacion_id', 'Orientacion') !!}
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										<i class="la la-windows"></i>
									</span>
									<div class="input-group m-input-group m-input-group--square">
									{!! Form::select('orientacion_id', $tiposOrientacion, ['class' => 'form-control m-input', 'placeholder' => 'Orientacion']) !!}
									</div>
								</div>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<div class="col-lg-12">
								{!! Form::label('superficies', 'Superficies') !!}
							</div>
							<div class="col-lg-2">
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										Terreno
									</span>
									{!! Form::text('sup_terreno', null, ['class' => 'form-control m-input', 'placeholder' => '', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>
							</div>
							<div class="col-lg-2">
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										Cubierta
									</span>
									{!! Form::text('sup_cubierta', null, ['class' => 'form-control m-input', 'placeholder' => '', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>
							</div>
							<div class="col-lg-3">
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										Descubierta
									</span>
									{!! Form::text('sup_descubierta', null, ['class' => 'form-control m-input', 'placeholder' => '', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>
							</div>
							<div class="col-lg-3">
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										Semi Cubierta
									</span>
									{!! Form::text('sup_semicubierta', null, ['class' => 'form-control m-input', 'placeholder' => '', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>
							</div>
							<div class="col-lg-2">
								<div class="input-group m-input-group m-input-group--square">
									<span class="input-group-addon">
										Total
									</span>
									{!! Form::text('sup_total', null, ['class' => 'form-control m-input', 'placeholder' => '', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.']) !!}
								</div>
							</div>
						</div>
					</div>
					<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-12 centered">
									{!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
									{!! Form::button('Cancelar',['class'=>'btn btn-secondary','data-dismiss' => 'modal']) !!}
								</div>
							</div>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>