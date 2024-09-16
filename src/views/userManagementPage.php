<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">

    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">

        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Gestión de usuarios</h1>

            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <li class="breadcrumb-item text-muted">Administración</li>

                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>

                <li class="breadcrumb-item text-muted">Usuarios</li>

                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>

                <li class="breadcrumb-item text-muted">Gestión</li>

            </ul>

        </div>

    </div>

</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="card">

            <div class="card-header border-0 pt-6">

                <div class="card-title">

                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid form-control-sm w-250px ps-13" placeholder="Buscar" />
                    </div>

                </div>

                <div class="card-toolbar">

                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                        <button type="button" class="btn btn-primary btn-sm" id="btnAddUser">
                            <i class="ki-duotone ki-plus"></i>Agregar usuario
                        </button>

                    </div>

                </div>

            </div>

            <div class="card-body py-4">

                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                #
                            </th>
                            <!-- <th class="min-w-155px">Foto</th> -->
                            <th class="min-w-155px">Usuario</th>
                            <th class="min-w-125px">Rol</th>
                            <th class="min-w-125px">Último acceso</th>
                            <th class="min-w-125px">Estado</th>
                            <th class="min-w-125px">Fecha de creación</th>
                            <th class="text-end min-w-100px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">

                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>

<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-dialog-centered mw-650px">

        <div class="modal-content">

            <div class="modal-header" id="kt_modal_add_user_header">

                <h2 class="fw-bold">Usuario</h2>

                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>

            </div>

            <div class="modal-body px-5 my-7">

                <form id="userForm" class="form needs-validation" novalidate>

                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                        <div class="fv-row mb-7">

                            <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>

                            <style>
                                .image-input-placeholder {
                                    background-image: url('src/assets/img/svg/files/blank-image.svg');
                                }

                                [data-bs-theme="dark"] .image-input-placeholder {
                                    background-image: url('src/assets/img/svg/files/blank-image-dark.svg');
                                }
                            </style>

                            <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">

                                <div id="mdlPhotoPreview" class="image-input-wrapper w-125px h-125px" style="background-image: url(src/assets/img/svg/files/blank-image.svg);"></div>

                            </div>

                        </div>

                        <div class="fv-row mb-7 mayusculas">

                            <label class="required fw-semibold fs-6 mb-2">Username</label>

                            <div class="input-group input-group-sm has-validation">

                                <input type="text" name="txtUsername" id="txtUsername" class="form-control form-control-solid form-control-sm mb-3 mb-lg-0" placeholder="Username" value="" required />
                                <button type="button" class="input-group-text" id="btnCheckUsernameAvailability">
                                    <i class="bi bi-check fs-2"></i>
                                </button>

                            </div>
                            <div class="invalid-feedback">
                                Este campo es requerido
                            </div>

                        </div>

                        <div class="fv-row mb-7 mayusculas">

                            <label class="required fw-semibold fs-6 mb-2">Nombres</label>

                            <input type="text" name="txtFirstname" id="txtFirstname" class="form-control form-control-solid form-control-sm mb-3 mb-lg-0" placeholder="Nombres" value="" required />
                            <div class="invalid-feedback">
                                Este campo es requerido
                            </div>

                        </div>

                        <div class="fv-row mb-7 mayusculas">

                            <label class="required fw-semibold fs-6 mb-2">Apellidos</label>

                            <input type="text" name="txtLastname" id="txtLastname" class="form-control form-control-solid form-control-sm mb-3 mb-lg-0" placeholder="Apellidos" value="" required />
                            <div class="invalid-feedback">
                                Este campo es requerido
                            </div>

                        </div>

                        <div class="fv-row mb-7">

                            <label class="required fw-semibold fs-6 mb-2">Email</label>

                            <input type="email" name="txtEmail" id="txtEmail" class="form-control form-control-solid form-control-sm mb-3 mb-lg-0" placeholder="example@domain.com" value="" required />

                            <div class="invalid-feedback">
                                Este campo es requerido
                            </div>
                        </div>

                        <div class="fv-row mb-7" id="passwordContainer">

                            <label class="required fw-semibold fs-6 mb-2">Contraseña</label>

                            <div class="input-group input-group-sm has-validation">
                                <input type="password" placeholder="Contraseña" name="txtPassword" id="txtPassword" autocomplete="off" class="form-control form-control-solid form-control-sm" required />
                                <span class="input-group-text changePasswordType">
                                    <i class="bi bi-eye fs-2"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-5">

                            <label class="required fw-semibold fs-6 mb-5">Rol</label>

                            <div class="d-flex fv-row">

                                <div class="form-check form-check-custom form-check-solid">

                                    <input class="form-check-input me-3" name="rbRole" type="radio" value="1" id="rbRole1" checked='checked' />

                                    <label class="form-check-label" for="rbRole1">
                                        <div class="fw-bold text-gray-800" id="lbRole1">Administrador</div>
                                        <div class="text-gray-600">Para control completo de la aplicación</div>
                                    </label>

                                </div>

                            </div>

                            <div class='separator separator-dashed my-5'></div>

                            <div class="d-flex fv-row">

                                <div class="form-check form-check-custom form-check-solid">

                                    <input class="form-check-input me-3" name="rbRole" type="radio" value="2" id="rbRole2" />

                                    <label class="form-check-label" for="rbRole2">
                                        <div class="fw-bold text-gray-800" id="lbRole2">Supervisor</div>
                                        <div class="text-gray-600">Para supervisión de inventarios, controles tiempo real y gestión de operaciones</div>
                                    </label>

                                </div>

                            </div>

                            <div class='separator separator-dashed my-5'></div>

                            <div class="d-flex fv-row">

                                <div class="form-check form-check-custom form-check-solid">

                                    <input class="form-check-input me-3" name="rbRole" type="radio" value="3" id="rbRole3" />

                                    <label class="form-check-label" for="rbRole3">
                                        <div class="fw-bold text-gray-800" id="lbRole3">Mesero / Cocinero</div>
                                        <div class="text-gray-600">Para gestión de mesas, pedidos, despacho, orden y seguimiento de atención hasta el punto de pago.</div>
                                    </label>

                                </div>

                            </div>

                            <div class='separator separator-dashed my-5'></div>

                            <div class="d-flex fv-row">

                                <div class="form-check form-check-custom form-check-solid">

                                    <input class="form-check-input me-3" name="rbRole" type="radio" value="4" id="rbRole4" />

                                    <label class="form-check-label" for="rbRole4">
                                        <div class="fw-bold text-gray-800" id="lbRole4">Cajero</div>
                                        <div class="text-gray-600">Para control financiero en tiempo real, cobros, descuentos y gestión de cuentas de caja</div>
                                    </label>

                                </div>

                            </div>

                            <div class='separator separator-dashed my-5'></div>

                            <div class="d-flex fv-row">

                                <div class="form-check form-check-custom form-check-solid">

                                    <input class="form-check-input me-3" name="rbRole" type="radio" value="5" id="rbRole5" />

                                    <label class="form-check-label" for="rbRole5">
                                        <div class="fw-bold text-gray-800" id="lbRole5">Delivery</div>
                                        <div class="text-gray-600">Control y seguimiento de pedidos</div>
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="text-center pt-10">
                        <button type="button" class="btn btn-sm btn-light me-3" data-kt-users-modal-action="cancel" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Guardar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$jsModules = [
    'userManagement'
];
