<header class="m-grid__item    m-header "  data-minimize-offset="200" data-minimize-mobile-offset="200" >
	<div class="m-container m-container--fluid m-container--full-height">
		<div class="m-stack m-stack--ver m-stack--desktop">
			<!-- BEGIN: Brand -->
			<div class="m-stack__item m-brand  m-brand--skin-dark">
				<div class="m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-stack__item--middle m-brand__logo p-1 w-75">
						<a href="/" class="m-brand__logo-wrapper">
							<img alt="" src="{{ asset('images/logo-full-white.png') }}"/>
						</a>
					</div>
					<div class="m-stack__item m-stack__item--middle m-brand__tools">
						<!-- BEGIN: Left Aside Minimize Toggle -->
						<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
							<span></span>
						</a>
						<!-- END -->
						<!-- BEGIN: Responsive Aside Left Menu Toggler -->
						<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
							<span></span>
						</a>
						<!-- END -->
						<!-- BEGIN: Responsive Header Menu Toggler 
						<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
							<span></span>
						</a>
						 END -->
						<!-- BEGIN: Topbar Toggler -->
						<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
							<i class="flaticon-more"></i>
						</a>
						<!-- BEGIN: Topbar Toggler -->
					</div>
				</div>
			</div>
			<!-- END: Brand -->
			<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
				<!-- BEGIN: Horizontal Menu -->
				<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
					<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
						<!-- <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" data-redirect="true" aria-haspopup="true">
							<a  href="#" class="m-menu__link m-menu__toggle">
								<i class="m-menu__link-icon flaticon-add"></i>
								<span class="m-menu__link-text">
									Acciones
								</span>
								<i class="m-menu__hor-arrow la la-angle-down"></i>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
								<span class="m-menu__arrow m-menu__arrow--adjust"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item "  aria-haspopup="true">
										<a  href="header/actions.html" class="m-menu__link ">
											<i class="m-menu__link-icon flaticon-file"></i>
											<span class="m-menu__link-text">
												Nuevo Registro
											</span>
										</a>
									</li>
									@yield('acciones')
								</ul>
							</div>
						</li> -->
						<li class="m-menu__item m-menu__item--submenu m-menu__item--rel m-menu__item--open-dropdown" id="introReports" data-menu-submenu-toggle="click" data-redirect="true" aria-haspopup="true">
							<a href="#" class="m-menu__link m-menu__toggle">
								<i class="m-menu__link-icon flaticon-line-graph"></i>
								<span class="m-menu__link-text">
									Reportes
								</span>
								<i class="m-menu__hor-arrow la la-angle-down"></i>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:1000px">
								<span class="m-menu__arrow m-menu__arrow--adjust" style="left: 73.5px;"></span>
								<div class="m-menu__subnav">
									<ul class="m-menu__content">
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													Contratos
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item " data-redirect="true" aria-haspopup="true">
													<a href="{{url('reportes/contratos_vigentes')}}" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Listado de contratos vigentes
														</span>
													</a>
												</li>
												<li class="m-menu__item " data-redirect="true" aria-haspopup="true">
													<a href="{{url('reportes/contratos_inactivos')}}" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Listado de contratos inactivos
														</span>
													</a>
												</li>	
											</ul>
										</li>
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													Gestión
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item " data-redirect="true" aria-haspopup="true">
													<a href="{{ url('reportes/inquilinos_cobrar' )}}" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Inquilinos a cobrar
														</span>
													</a>
												</li>
												<li class="m-menu__item " data-redirect="true" aria-haspopup="true">
													<a href="{{url('reportes/propietarios_pagar')}}" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Propietarios a pagar
														</span>
													</a>
												</li>
											</ul>
										</li>
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													Agenda
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item " data-redirect="true" aria-haspopup="true">
													<a href="{{ url('reportes/inquilinos_cobrar' )}}" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Tareas para hoy
														</span>
													</a>
												</li>
												<li class="m-menu__item " data-redirect="true" aria-haspopup="true">
													<a href="{{url('reportes/propietarios_pagar')}}" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Tareas para la semana
														</span>
													</a>
												</li>
											</ul>
										</li>
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													Caja
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item " data-redirect="true" aria-haspopup="true">
													<a href="{{url('reportes/caja_diaria')}}" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Caja diaria
														</span>
													</a>
												</li>
												<li class="m-menu__item " data-redirect="true" aria-haspopup="true">
													<a href="{{url('reportes/movimientos_mes')}}" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--dot">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															Movimientos del mes
														</span>
													</a>
												</li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-topbar__nav-wrapper">
						<ul class="m-topbar__nav m-nav m-nav--inline">
							<!-- <li class="
m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" 
data-dropdown-toggle="click" data-dropdown-persistent="true" id="m_quicksearch" data-search-type="dropdown">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-nav__link-icon">
										<i class="flaticon-search-1"></i>
									</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
									<div class="m-dropdown__inner ">
										<div class="m-dropdown__header">
											<form  class="m-list-search__form">
												<div class="m-list-search__form-wrapper">
													<span class="m-list-search__form-input-wrapper">
														<input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Buscar...">
													</span>
													<span class="m-list-search__form-icon-close" id="m_quicksearch_close">
														<i class="la la-remove"></i>
													</span>
												</div>
											</form>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-max-height="300" data-mobile-max-height="200">
												<div class="m-dropdown__content"></div>
											</div>
										</div>
									</div>
								</div>
							</li> -->
							<!-- <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true">
								<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
									<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
									<span class="m-nav__link-icon">
										<i class="flaticon-music-2"></i>
									</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center" style="background: url({{ asset('images/notification_bg.jpg') }}); background-size: cover;">
											<span class="m-dropdown__header-title">
												@yield('newNotif') Actualizaciones
											</span>
											<span class="m-dropdown__header-subtitle">
												Ultimas actualizaciones
											</span>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
													<li class="nav-item m-tabs__item">
														<a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
															Notificaciones
														</a>
													</li>
													<li class="nav-item m-tabs__item">
														<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">
															Eventos
														</a>
													</li>
													<li class="nav-item m-tabs__item">
														<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_logs" role="tab">
															Logs
														</a>
													</li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
														<div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
															<div class="m-list-timeline m-list-timeline--skin-light">
																<div class="m-list-timeline__items">
																	@if($notificaciones->count()>0)
													                  @foreach ($notificaciones as $notificacion)
																		<div class="m-list-timeline__item">
																			<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																			<a href="{{$notificacion->enlace}}" class="m-list-timeline__text">
																				{{$notificacion->texto}}
																			</a>
																			<span class="m-list-timeline__time">
																				{{$notificacion->created_at}}
																			</span>
																		</div>
													                  @endforeach
													                @else
													                	<div class="m-list-timeline__item">
																			<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																			<a href="/eventos" class="m-list-timeline__text">
																				No hay notificaciones nuevas
																			</a>
																			<span class="m-list-timeline__time">
																			</span>
																		</div>
													                @endif
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
														<div class="m-scrollable" m-scrollabledata-scrollable="true" data-max-height="250" data-mobile-max-height="200">
															<div class="m-list-timeline m-list-timeline--skin-light">
																<div class="m-list-timeline__items">
																	<div class="m-list-timeline__item">
																		@if($eventos->count()>0)
														                  @foreach ($eventos as $evento)
																			<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																				<a href="/eventos" class="m-list-timeline__text">
																					{{$evento->titulo}}
																				</a>
																				<span class="m-list-timeline__time">
																					{{$evento->inicio}}
																				</span>
																			</div>
														                  @endforeach
														                @else
														                	<div class="m-list-timeline__item">
																				<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																				<a href="/eventos" class="m-list-timeline__text">
																					No hay eventos proximos
																				</a>
																				<span class="m-list-timeline__time">
																				</span>
																			</div>
														                @endif
														            </div>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
														<div class="m-scrollable" m-scrollabledata-scrollable="true" data-max-height="250" data-mobile-max-height="200">
															<div class="m-list-timeline m-list-timeline--skin-light">
																<div class="m-list-timeline__items">
												                @if($logs->count()>0)
													                  @foreach ($logs as $log)
																		<div class="m-list-timeline__item">
																			<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																			<a href="#" class="m-list-timeline__text">
																				{{$log->auditable_type}}
																			</a>
																			<span class="m-list-timeline__time">
																				{{$log->created_at}}
																			</span>
																		</div>
													                  @endforeach
													                @else
													                	<div class="m-list-timeline__item">
																			<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
																			<a href="/eventos" class="m-list-timeline__text">
																				No hay logs nuevos
																			</a>
																			<span class="m-list-timeline__time">
																			</span>
																		</div>
													                @endif
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li> -->
							<li id="introShortcuts" class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"  data-dropdown-toggle="click">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
									<span class="m-nav__link-icon">
										<i class="flaticon-share"></i>
									</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center" style="background: url({{ asset('images/user-profile-bg.jpg') }}); background-size: cover;">
											<span class="m-dropdown__header-title">
												Accesos Directos
											</span>
											<span class="m-dropdown__header-subtitle">
												Atajos
											</span>
										</div>
										<div class="m-dropdown__body m-dropdown__body--paddingless">
											<div class="m-dropdown__content">
												<div class="m-scrollable" data-scrollable="false" data-max-height="380" data-mobile-max-height="200">
													<div class="m-nav-grid m-nav-grid--skin-light">
														<div class="m-nav-grid__row">
															<a href="#" class="m-nav-grid__item nuevaPersona" data-toggle="modal" data-target="#_formPersona">
																<i class="m-nav-grid__icon flaticon-user-add"></i>
																<span class="m-nav-grid__text">
																	Nueva Persona
																</span>
															</a>
															<a href="{{ route('usuarios.index') }}" class="m-nav-grid__item">
																<i class="m-nav-grid__icon flaticon-user-settings"></i>
																<span class="m-nav-grid__text">
																	Nuevo Usuario
																</span>
															</a>
														</div>
														<div class="m-nav-grid__row">
															<a href="{{ route('contratos.create') }}" class="m-nav-grid__item">
																<i class="m-nav-grid__icon flaticon-file"></i>
																<span class="m-nav-grid__text">
																	Nuevo Contrato
																</span>
															</a>
															<a href="{{ route('gestiones.create') }}" class="m-nav-grid__item">
																<i class="m-nav-grid__icon flaticon-coins"></i>
																<span class="m-nav-grid__text">
																	Nueva Gestión
																</span>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li id="introProfile" class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-topbar__userpic">
										@if(Auth::user()->foto())
											<img src="{{ Auth::user()->foto() }}" class="m--img-rounded m--marginless m--img-centered" alt=""/>
										@endif
									</span>
									<span class="m-topbar__username">
									{{ Auth::user()->getFullName() }}
									</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center" style="background: url({{ asset('images/user-profile-bg.jpg') }}); background-size: cover;">
											<div class="m-card-user m-card-user--skin-dark">
												<div class="m-card-user__pic">
													<img src="" class="m--img-rounded m--marginless" alt=""/>
												</div>
												<div class="m-card-user__details">
													<span class="m-card-user__name m--font-weight-500">
														{{ Auth::user()->nombre.' '.Auth::user()->apellido }}
													</span>
													<a href="" class="m-card-user__email m--font-weight-300 m-link">
														{{ Auth::user()->mail }}
													</a>
												</div>
											</div>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="m-nav m-nav--skin-light">
													<li class="m-nav__section m--hide">
														<span class="m-nav__section-text">
															Section
														</span>
													</li>
													<li class="m-nav__item">
														<a href="{{route('usuarios.edit',Auth::user()->id)}}" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-profile-1"></i>
															<span class="m-nav__link-title">
																<span class="m-nav__link-wrap">
																	<span class="m-nav__link-text">
																		Mi Perfil
																	</span>
																	<!-- <span class="m-nav__link-badge">
																		<span class="m-badge m-badge--success">
																			2
																		</span>
																	</span> -->
																</span>
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit"></li>
													<li class="m-nav__item">
														<a href="mailto:fgandolfo@horneroprop.com?subject=Soporte #{{Auth::user()->id}}&body=" targe="_blank" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-lifebuoy"></i>
															<span class="m-nav__link-text">
																Soporte
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit"></li>
													<li class="m-nav__item">
														<a href="{{ route('logout') }}" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
															Salir
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</li><!-- 
							<li id="m_quick_sidebar_toggle" class="m-nav__item">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-nav__link-icon">
										<i class="flaticon-grid-menu"></i>
									</span>
								</a>
							</li> -->
						</ul>
					</div>
				</div>
				<!-- END: Topbar -->
			</div>
		</div>
	</div>
</header>