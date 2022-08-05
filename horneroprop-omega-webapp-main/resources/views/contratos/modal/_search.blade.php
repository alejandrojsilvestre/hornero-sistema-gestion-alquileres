<div class="modal fade" id="_buscarContrato" tabindex="-1" role="dialog" aria-labelledby="BuscadorDeContratos">
	<div class="modal-dialog modal-xlg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					Buscar Contratos
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						×
					</span>
				</button>
			</div>
			<div class="modal-body">
			<!--begin: Search Form -->
		    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
		      <div class="row align-items-center">
		        <div class="col-xl-8 order-2 order-xl-1">
		          <div class="form-group m-form__group row align-items-center">
		            <div class="col-md-4">
		              <div class="m-input-icon m-input-icon--left">
		                <input type="text" class="form-control m-input" placeholder="Buscar..." id="generalSearch">
		                <span class="m-input-icon__icon m-input-icon__icon--left">
		                  <span>
		                    <i class="la la-search"></i>
		                  </span>
		                </span>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		    <!--end: Search Form -->
		    <!--begin: Datatable -->
		    <table class="table table-bordered" id="contratos-table" action="search">
		        <thead>
		        </thead>
		    </table>
		    <!--end: Datatable -->
			</div>
		</div>
	</div>
</div>