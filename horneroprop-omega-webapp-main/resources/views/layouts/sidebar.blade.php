<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
	<!-- BEGIN: Aside Menu -->
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
			<li class="m-menu__item  m-menu__item--active" aria-haspopup="true" data-menu-submenu-toggle="hover">
				<a href="/" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-line-graph"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Dashboard
							</span>
						</span>
					</span>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
							<span class="m-menu__link">
								<span class="m-menu__link-text">
									Dashboard
								</span>
							</span>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__section">
				<h4 class="m-menu__section-text">
					Menu
				</h4>
				<i class="m-menu__section-icon flaticon-more-v3"></i>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
				<a href="{{ route('personas.index') }}" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-users"></i>
					<span class="m-menu__link-text">
						Personas
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
							<span class="m-menu__link">
								<span class="m-menu__link-text">
									Personas
								</span>
							</span>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="{{ route('personas.index') }}" class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listado
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
				<a href="{{ route('eventos.index') }}" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-calendar"></i>
					<span class="m-menu__link-text">
						Agenda
						<!-- <span class="m-menu__link-badge">
							<span class="m-badge m-badge--danger">
								2
							</span>
						</span> -->
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
							<span class="m-menu__link">
								<span class="m-menu__link-text">
									Agenda
								</span>
							</span>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="{{ route('eventos.index') }}" class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Calendario
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
				<a href="{{ route('personas.index') }}" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon la la-home"></i>
					<span class="m-menu__link-text">
						Inmuebles
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
							<span class="m-menu__link">
								<span class="m-menu__link-text">
									Inmuebles
								</span>
							</span>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="{{ route('inmuebles.index') }}" class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listado
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
				<a href="{{ route('contratos.index') }}" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-file"></i>
					<span class="m-menu__link-text">
						Contratos
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
							<span class="m-menu__link">
								<span class="m-menu__link-text">
									Contratos
								</span>
							</span>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="{{ route('contratos.index') }}" class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listado
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
				<a href="#" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-coins"></i>
					<span class="m-menu__link-text">
						Gestiones
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
							<span class="m-menu__link">
								<span class="m-menu__link-text">
									Gestión
								</span>
							</span>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="{{ route('gestiones.index') }}" class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Cobros | Pagos
								</span>
							</a>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="{{ route('gastos.index') }}" class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Gastos | Impuestos
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
				<a href="#" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-folder-2"></i>
					<span class="m-menu__link-text">
						Administración
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
							<span class="m-menu__link">
								<span class="m-menu__link-text">
									Administración
								</span>
							</span>
						</li>
						<!-- <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="{{ route('movimientos.index') }}" class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Resumen de Movimientos
								</span>
							</a>
						</li> -->
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="{{ route('cheques.index') }}" class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Cheques
								</span>
							</a>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="{{ route('transferencias.index') }}" class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Transferencias
								</span>
							</a>
						</li>
						<li class="m-menu__item " aria-haspopup="true">
							<a href="#" class="m-menu__link m-menu__toggle">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									AFIP
								</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu ">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ route('credenciales.index') }}" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Credenciales
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ route('facturas.index') }}" class="m-menu__link">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Facturas
											</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__section">
				<h4 class="m-menu__section-text">
					Configuraciones
				</h4>
				<i class="m-menu__section-icon flaticon-more-v3"></i>
			</li>
			<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
				<a href="#" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-user-settings"></i>
					<span class="m-menu__link-text">
						Usuarios
					</span>
					<i class="m-menu__ver-arrow la la-angle-right"></i>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
							<span class="m-menu__link">
								<span class="m-menu__link-text">
									Usuarios
								</span>
							</span>
						</li>
						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
							<a href="{{ route('usuarios.index') }}" class="m-menu__link">
								<i class="m-menu__link-bullet m-menu__link-bullet--dot">
									<span></span>
								</i>
								<span class="m-menu__link-text">
									Listado
								</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="m-menu__item" aria-haspopup="true" data-menu-submenu-toggle="hover">
				<a href="{{ route('ajustes.index') }}" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-settings-1"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Ajustes
							</span>
						</span>
					</span>
				</a>
				<div class="m-menu__submenu ">
					<span class="m-menu__arrow"></span>
					<ul class="m-menu__subnav">
						<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
							<span class="m-menu__link">
								<span class="m-menu__link-text">
									Ajustes
								</span>
							</span>
						</li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
	<!-- END: Aside Menu -->
</div>