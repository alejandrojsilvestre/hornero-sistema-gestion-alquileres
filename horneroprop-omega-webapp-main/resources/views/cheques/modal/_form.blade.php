<div class="modal fade"  id="_formCheque" role="dialog" aria-labelledby="FormularioDeCheques">
	<div class="modal-dialog" role="document">
		<div class="modal-content" >
			<div class="modal-header">
				<h5 class="modal-title" id="formChequeTitle">
					Nuevo Cheque
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						×
					</span>
				</button>
			</div>
			<div class="modal-body" >
				{!! Form::open(['id' => 'formCheque' ,'autocomplete'=>'off','class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed']) !!}
					{!! Form::hidden('cheque_id') !!}
					<div class="m-portlet__body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									{!! Form::label('banco_id', 'Banco') !!}
									<div class="input-group m-input-group m-input-group--square">
									{!! Form::select('banco_id', $bancos, null, ['class' => 'form-control  m-select2 select2-hidden-accessible', 'required', 'id' => 'bancosCheques'])!!} 
									</div>
								</div>
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('nro_cuenta', 'Nro. de Cuenta') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::text('nro_cuenta', null, ['class' => 'form-control m-input', 'placeholder' => '','required']) !!}
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('nro_cheque', 'Nro. de Cheque') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::text('nro_cheque', null, ['class' => 'form-control m-input', 'placeholder' => '','required']) !!}
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									{!! Form::label('monto', 'Monto') !!}
						              <div class="input-group mb-3">
								        <span class="input-group-addon moneda">
								        </span>
						                {!! Form::text('monto', null, ['class' => 'form-control', 'placeholder' => 'Monto', 'required', 'id' => 'montoCheque']) !!}
						              </div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									{!! Form::label('fecha', 'Fecha') !!}
									<div class="input-group date">
	        							<span class="input-group-addon">
	        								<i class="la la-calendar"></i>
	        							</span>
	        							{!! Form::text('fecha', null, ['class' => 'form-control m-input', 'placeholder' => '','id'=>'fecha', 'required']) !!}
	        						</div>
        						</div>
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('notas', 'Notas') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::textarea('notas', null, ['class' => 'form-control textareaCheque', 'placeholder' => 'Notas']) !!}
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