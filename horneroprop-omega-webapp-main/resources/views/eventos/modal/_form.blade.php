<div class="modal fade"  id="_formEvento" tabindex="-1" role="dialog" aria-labelledby="FormularioDeEventos">
	<div class="modal-dialog" role="document">
		<div class="modal-content" >
			<div class="modal-header">
				<h5 class="modal-title" id="formEventoTitle">
					Nuevo Evento
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						×
					</span>
				</button>
			</div>
			<div class="modal-body" >
				{!! Form::open(['id' => 'formEvento' ,'autocomplete'=>'off','class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed']) !!}
					{!! Form::hidden('evento_id') !!}
					<div class="m-portlet__body">

						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('titulo', 'Titulo') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::text('titulo', null, ['class' => 'form-control m-input', 'placeholder' => 'Titulo', 'required']) !!}
							</div>
						</div>

						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('motivo_id', 'Motivo') !!}
							<div class="input-group m-input-group m-input-group--square">
							{!! Form::select('motivo_id', $motivosEventos, null, ['class' => 'form-control m-input', 'placeholder' => 'Motivo', 'required', 'modal' => '_formEvento']) !!}
							</div>
						</div>

						<div class="row">
							<div class="col-md-11">
								<div class="form-group row evento_inmueble">
									{!! Form::label('inmuebles', 'Seleccionar Inmueble') !!}
									<div class="input-group m-input-group m-input-group--square">
									<select modal="_formEvento" controller="inmuebles" multiple="" class="form-control select2-ajax m-select2" id="inmuebles" name="inmuebles[]">
										</select>
									</div>
								</div>
								<div class="form-group row evento_direccion">
									{!! Form::label('direccion', 'Dirección') !!}
									<div class="input-group m-input-group m-input-group--square">
										{!! Form::text('direccion', null, ['class' => 'form-control m-input', 'placeholder' => 'Dirección']) !!}
									</div>
								</div>
							</div>
							<div class="col-md-1">
								<button class="btn btnExcange btnAbsolute pull-right btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air" type="button">
					              <i class="fa fa-exchange"></i>
					            </button>
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('personas', 'Persona') !!}
							<div class="input-group m-input-group m-input-group--square">
								<select modal="_formEvento" controller="personas" multiple="" required="" class="form-control select2-ajax m-select2" id="personas" name="personas[]">
								</select>
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('users', 'Asignada a') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::select('users[]', $users, null, ['class' => 'form-control m-input', 'id' => 'users', 'multiple', 'required'])!!}
							</div>
						</div>
						<div class="row fechasEventos">
							<div class="form-group m-form__groupOnlyPadding row col-sm-6">
								{!! Form::label('inicio', 'Inicio') !!}
								<div class="input-group m-input-group m-input-group--square">
									{!! Form::text('inicio', null, ['class' => 'form-control m-input m_datetimepicker_1', 'placeholder' => 'Inicio','required']) !!}
								</div>
							</div>
							<div class="form-group m-form__groupOnlyPadding row col-sm-6">
								{!! Form::label('fin', 'Fin') !!}
								<div class="input-group m-input-group m-input-group--square">
									{!! Form::text('fin', null, ['class' => 'form-control m-input m_datetimepicker_1', 'placeholder' => 'Fin','required']) !!}
								</div>
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('notas', 'Notas') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::textarea('notas', null, ['class' => 'form-control textareaEvento', 'placeholder' => 'Notas', 'id' => 'formEventoNotas']) !!}
							</div>
						</div>
					</div>
					<div class="m-portlet__foot foot_btn m-portlet__no-border m-portlet__foot--fit">
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