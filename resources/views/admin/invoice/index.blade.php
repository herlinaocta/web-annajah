@extends('layouts.Admin.layout')

@section('sidebar')
@include('layouts.Admin.sidebar')
@endsection


@section('content')

<!--begin::Post-->
<div class="content flex-row-fluid" id="kt_content">
    <!--begin::Index-->
    <div class="card card-page">
        <!--begin::Card body-->
        <div class="card-body">

            <!--begin::Table Widget 1-->
									<div class="card mb-5 mb-xl-10">
										<!--begin::Header-->
										<div class="card-header border-0 pt-5 pb-3">
											<!--begin::Card title-->
											<h3 class="card-title fw-bolder text-gray-800 fs-2">Our Product</h3>
											<!--end::Card title-->

											<div class="card-toolbar">
                                                <a href="/add" class="btn btn-primary">Add Product</a>
                                            </div>


										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body py-0">
											<!--begin::Table-->
											<div class="table-responsive">
												<table class="table align-middle table-row-bordered table-row-dashed gy-5" id="kt_table_widget_1">
													<!--begin::Table body-->
													<tbody>
														<!--begin::Table row-->
														<tr class="text-start text-gray-400 fw-boldest fs-7 text-uppercase">
															<th class="min-w-200px px-0">Product</th>
															<th class="min-w-125px">Desription</th>
															<th class="min-w-125px">Stock</th>
                                                            <th class="min-w-125px">Pricing</th>
															<th class="text-end pe-2 min-w-70px">Action</th>
														</tr>
														<!--end::Table row-->


														<!--begin::Table row-->
														<tr>
															<!--begin::Author=-->
															<td class="p-0">
																<div class="d-flex align-items-center">
																	<!--begin::Logo-->
																	<div class="symbol symbol-50px me-2">
																		<span class="symbol-label">
																			<img alt="" class="w-40px" src="assets/images/produk-7.jpg" />
																		</span>
																	</div>
																	<!--end::Logo-->
																	<div class="ps-3">
																		<a href="/view-invoice" class="text-gray-800 fw-boldest fs-5 text-hover-primary mb-1">Leonora Creme</a>
																	</div>
																</div>
															</td>
															<!--end::Author=-->

															<!--begin::Progress=-->
															<td>
																<div class="ps-3">
                                                                    <span class="text-gray-400 fw-bold d-block">Leonora Creme Top adalah koleksi atasan HijabChic dengan warna creme yang versatile.</span>
                                                                </div>
															</td>
															<!--end::Company=-->

															<!--begin::Progress=-->
															<td>
																<div class="d-flex flex-column w-100 me-2 mt-2">
																	<span class="text-gray-400 me-2 fw-boldest mb-2">20</span>
																</div>
															</td>
															<!--end::Company=-->

                                                            <!--begin::Progress=-->
															<td>
																<div class="d-flex flex-column w-100 me-2 mt-2">
																	<span class="text-gray-400 me-2 fw-boldest mb-2">Rp299.000</span>
																</div>
															</td>
															<!--end::Company=-->

															<!--begin::Action=-->
															<td class="pe-0 text-end">
																<a href="#" class="btn btn-sm btn-icon btn-color-gray-500 btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-overflow="true" data-kt-menu-placement="bottom-start">
																	<!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
																	<span class="svg-icon svg-icon-2x">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black" />
																			<rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
																			<rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
																			<rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</a>

																<!--begin::Menu 3-->
																<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
																	<!--begin::Menu item-->
																	<div class="menu-item px-3">
																		<a href="/view-invoice" class="menu-link px-3">View Invoice</a>
																	</div>
																	<!--end::Menu item-->
                                                                    
																</div>
																<!--end::Menu 3-->
                                                                
															</td>
															<!--end::Action=-->
														</tr>
														<!--end::Table row-->

													</tbody>
													<!--end::Table body-->
												</table>
											</div>
											<!--end::Table-->
										</div>
										<!--end::Body-->
									</div>
									<!--end::Table Widget 1-->

            
            <!--end::Modals-->

            
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Index-->
</div>
<!--end::Post-->

@endsection