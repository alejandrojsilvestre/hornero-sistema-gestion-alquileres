<div class="modal fade"  id="_afipCredentialForm" role="dialog" aria-labelledby="CredentialsForm">
	<div class="modal-dialog" role="document">
		<div class="modal-content" >
			<div class="modal-header">
				<h5 class="modal-title" id="afipCredentialFormTitle">
					Nueva Credencial
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						×
					</span>
				</button>
			</div>
			<div class="modal-body" >
				{!! Form::open(['id' => 'afipCredentialForm' ,'autocomplete'=>'off','class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed']) !!}
					{!! Form::hidden('credential_id') !!}
					<div class="m-portlet__body">
						<div class="form-group m-form__group row">
							<div class="m-alert m-alert--icon m-alert--outline alert alert-accent alert-dismissible fade show" role="alert">
							<div class="m-alert__icon">
								<i class="la la-warning"></i>
							</div>
							<div class="m-alert__text">
								<strong>
								Info:
								</strong>
								Los datos de la factura electrónica se visualizarán de la forma en que son cargados en este formulario.
							</div>
							<div class="m-alert__close">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
							</div>
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('business_name', 'Razón Social') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::text('business_name', null, ['class' => 'form-control m-input', 'placeholder' => '','required']) !!}
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('address', 'Dirección') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::text('address', null, ['class' => 'form-control m-input', 'placeholder' => '','required']) !!}
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('email', 'E-mail') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::email('email', null, ['class' => 'form-control m-input', 'placeholder' => '','required']) !!}
							</div>
						</div>
						<div class="row pt-2">
							<div class="col-md-6">
								<div class="form-group row">
									{!! Form::label('responsable_type_id', 'Tipo de Responsable') !!}
						              <div class="input-group mb-3">
										{!! Form::select('responsable_type_id', $tiposIva, null, ['class' => 'form-control m-input', 'required'])!!} 
						              </div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									{!! Form::label('responsable_number', 'C.U.I.T.') !!}
									<div class="input-group">
										{!! Form::text('responsable_number', null, ['class' => 'form-control m-input', 'placeholder' => 'Nro. de C.U.I.', 'pattern' => '\d*', 'title'=>'Este campo permite solo caracteres numéricos.', 'required']) !!}
	        						</div>
        						</div>
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('ib', 'Ingresos Brutos') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::text('ib', null, ['class' => 'form-control m-input', 'placeholder' => '','required']) !!}
							</div>
						</div>
						<div class="row pt-2">
							<div class="col-md-6">
								<div class="form-group row">
									{!! Form::label('sales_point', 'Punto de Venta') !!}
						              <div class="input-group mb-3">
						                {!! Form::tel('sales_point', null, ['class' => 'form-control', 'required']) !!}
						              </div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									{!! Form::label('activity_started_at', 'Inicio de Actividades') !!}
									<div class="input-group date">
	        							<span class="input-group-addon">
	        								<i class="la la-calendar"></i>
	        							</span>
	        							{!! Form::text('activity_started_at', null, ['class' => 'form-control m-input', 'placeholder' => '', 'required']) !!}
	        						</div>
        						</div>
							</div>
						</div>
						<div class="row pt-2">
							<div class="col-md-6">
								<div class="form-group row">
									{!! Form::label('crt', 'CRT') !!}
						              <div class="input-group mb-3">
						                {!! Form::file('crt',  ['class' => 'form-control', 'required']) !!}
						              </div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									{!! Form::label('key', 'Key') !!}
									<div class="input-group mb-3">
	        							{!! Form::file('key', ['class' => 'form-control', 'placeholder' => '',  'required']) !!}
	        						</div>
        						</div>
							</div>
						</div>
						<div class="form-group m-form__groupOnlyPadding row">
							{!! Form::label('users', 'Usuarios Habilitados') !!}
							<div class="input-group m-input-group m-input-group--square">
								{!! Form::select('users[]', $users, null, ['class' => 'form-control m-input', 'id' => 'afipCredentialFormUsers', 'multiple', 'required'])!!}
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