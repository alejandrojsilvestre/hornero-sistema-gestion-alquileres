<div class="modal fade"  id="_formGasto" role="dialog" aria-labelledby="FormularioDeGastos">
	<div class="modal-dialog" role="document">
		<div class="modal-content" >
			<div class="modal-header">
				<h5 class="modal-title" id="formGastoTitle">
					Nuevo Gasto
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						×
					</span>
				</button>
			</div>
			<div class="modal-body" >
				{!! Form::open(['id' => 'formGasto' ,'autocomplete'=>'off', 'id'=>'formGasto','class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed']) !!}
					{!! Form::hidden('gasto_id') !!}
					<div class="m-portlet__body">
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('contrato', 'Contrato') !!}
							<div class="input-group m-input-group m-input-group--square">
								<span class="input-group-addon">
				                    <i class="la la-home"></i>
			                  	</span>
			                  	{!! Form::text('direccionContrato', null, ['class' => 'form-control m-input disabled direccionContrato', 'placeholder' => 'Direccion del Inmueble','disabled']) !!}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									{!! Form::label('monto', 'Monto') !!}
						              <div class="input-group mb-3">
						                <div class="input-group-prepend-select">
						                  {!! Form::select('moneda_id', $monedas, null, ['class' => 'form-control col-xs-2 m-select2', 'required'])!!}
						                </div>
						                {!! Form::text('monto', null, ['class' => 'form-control', 'placeholder' => 'Monto', 'required', 'id' => 'formGastoMonto']) !!}
						              </div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group row gasto_concepto">
									{!! Form::label('concepto_id', 'Concepto') !!}
									<div class="input-group m-input-group m-input-group--square">
									{!! Form::select('concepto_id', $tiposConcepto, null, ['class' => 'form-control m-input'])!!} 
									</div>
								</div>
								<div class="form-group row gasto_newConcepto">
									{!! Form::label('concepto', 'Nuevo Concepto') !!}
									<div class="input-group m-input-group m-input-group--square">
										{!! Form::text('concepto', null, ['class' => 'form-control m-input', 'placeholder' => 'Descripcion']) !!}
									</div>
								</div>
							</div>
							<div class="col-md-1">
								<button class="btn btnExcange m-top-27 pull-right btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill m-btn--air m-tooltip" data-skin="dark" data-placement="top" title="" data-original-title="Nuevo Concepto" type="button">
				              		<i class="fa fa-plus"></i>
				            	</button>
							</div>
						</div>
						<div class="row">
							<div class="form-group row col-sm-6">
								{!! Form::label('fecha', 'Fecha') !!}
								<div class="input-group">
									<span class="input-group-addon">
										<i class="la la-calendar"></i>
									</span>
									{!! Form::text('fecha', null, ['class' => 'form-control m-input date', 'placeholder' => 'Fecha de gasto']) !!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group row col-sm-6">
								{!! Form::label('cobro_id', 'Periodo') !!}
								<div class="input-group m-input-group m-input-group--square">
									@if (isset($periodos))	
									    {!! Form::select('cobro_id', $periodos, null, ['class' => 'form-control m-input periodos', 'required', 'id' => 'periodosGastos'])!!} 
									@else
									    {!! Form::select('cobro_id', [], null, ['class' => 'form-control m-input periodos', 'required', 'id' => 'periodosGastos'])!!} 
									@endif
								</div>
							</div>
							<div class="form-group row col-sm-4">
								<div class="input-group paddingCheck m-input-group m-input-group--square div-rota">
									{!! Form::label('rota', 'Rota') !!} <label class="m-checkbox checkMargin m-checkbox--solid  m-checkbox--success">
		                      			<input type="checkbox" id="rotaGasto" name="rota" value="1"><span></span>
		                    		</label>
								</div>
							</div>
						</div>
						<div class="row isRotativoGasto">
							<div class="form-group row col-sm-6">
								{!! Form::label('cada', 'Cada cantidad de Meses') !!}
								<div class="input-group m-input-group m-input-group--square">
									{!! Form::text('cada', null, ['class' => 'form-control', 'placeholder' => 'Meses', 'id' => 'formGastoCada']) !!}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group row col-sm-6">
								{!! Form::label('encargado', 'Encargado del gasto') !!}
								<div class="input-group m-input-group m-input-group--square">
				                  	{!! Form::select('encargado', $tiposPersonaGasto, null, ['class' => 'form-control col-xs-2 m-select2', 'required'])!!}
								</div>
							</div>
							<div class="form-group row col-sm-6">
								{!! Form::label('pagado_por', 'Pagado por') !!}
								<div class="input-group m-input-group m-input-group--square">
				                  	{!! Form::select('pagado_por', $tiposPersonaGasto, null, ['class' => 'form-control col-xs-2 m-select2', 'required'])!!}
								</div>
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('notas', 'Notas') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::textarea('notas', null, ['class' => 'form-control textareaGasto', 'placeholder' => 'Notas', 'id' => 'formGastoNotas']) !!}
							</div>
						</div>
					</div>
					<div class="m-portlet__foot foot_btn m-portlet__no-border m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions--solid">
							<div class="row">
								<div class="col-lg-12 centered form-actions">
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