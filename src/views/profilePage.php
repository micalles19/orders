<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">

    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">

        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Mi perfil</h1>

        </div>

    </div>

</div>

<div id="kt_app_content" class="app-content flex-column-fluid">

    <div id="kt_app_content_container" class="app-container container-xxl">

        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">

                <div class="d-flex flex-wrap flex-sm-nowrap">

                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img src="src/assets/img/avatars/<?= $userPhoto; ?>?v=<?= date("dMYHi"); ?>" alt="image" />
                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                        </div>
                    </div>

                    <div class="flex-grow-1">

                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">

                            <div class="d-flex flex-column">

                                <div class="d-flex align-items-center mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"><?= $userName; ?></a>
                                    <a href="#">
                                        <i class="ki-duotone ki-verify fs-1 text-primary">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                </div>

                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                        <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i><?= $rolename; ?></a>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="card mb-5 mb-xl-10">

            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">

                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Datos de perfil</h3>
                </div>

            </div>

            <div id="kt_account_settings_profile_details" class="collapse show">

                <form id="kt_account_profile_details_form" class="form" action="javascript:void(0);">

                    <div class="card-body border-top p-9">

                        <div class="row mb-6">

                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>

                            <div class="col-lg-8">

                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('src/assets/img/svg/avatars/blank.svg')">

                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url(src/assets/img/avatars/<?= $userPhoto; ?>?v=<?= date("dMYHi"); ?>)" id="userPhotoPreview"></div>

                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar avatar">
                                        <i class="ki-duotone ki-pencil fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>

                                        <input type="file" name="avatar" id="imgAvatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />

                                    </label>

                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancelar cambio">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>

                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Quitar avatar">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>

                                </div>

                                <div class="form-text">Formatos permitidos: png, jpg, jpeg.</div>

                                <button type="button" class="btn btn-sm btn-light btn-active-light-primary mt-2" id="btnUpdatePhoto">Actualizar foto</button>

                            </div>

                        </div>

                        <div class="row mb-6">

                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Nombre completo</label>

                            <div class="col-lg-8">

                                <input type="text" name="fname" class="form-control form-control-sm form-control-solid mb-3 mb-lg-0" placeholder="Nombre" value="<?= $userName; ?>" readonly />

                            </div>

                        </div>

                        <div class="row mb-6">

                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Rol</label>

                            <div class="col-lg-8">

                                <input type="text" name="fname" class="form-control form-control-sm form-control-solid mb-3 mb-lg-0" placeholder="Rol" value="<?= $rolename; ?>" readonly />

                            </div>

                        </div>

                    </div>
                </form>

            </div>

        </div>

        <div class="card mb-5 mb-xl-5">

            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Contraseña y recuperación</h3>
                </div>
            </div>

            <div id="kt_account_settings_signin_method" class="collapse show">

                <div class="card-body border-top p-9">

                    <div class="d-flex flex-wrap align-items-center">

                        <div id="kt_signin_email">
                            <div class="fs-6 fw-bold mb-1">Correo electrónico</div>
                            <div class="fw-semibold text-gray-600" id="lbEmail"><?= $userEmail; ?></div>
                        </div>

                        <div id="kt_signin_email_edit" class="flex-row-fluid d-none">

                            <form id="kt_signin_change_email" class="form needs-validation" novalidate="novalidate">
                                <div class="row mb-6">
                                    <div class="col-lg-6 mb-4 mb-lg-0">
                                        <div class="fv-row mb-0">
                                            <label for="txtNewEmail" class="form-label fs-6 fw-bold mb-3">Nuevo correo electrónico</label>
                                            <input type="email" class="form-control form-control-solid form-control-sm" id="txtNewEmail" placeholder="Correo electrónico" name="txtNewEmail" value="<?= $userEmail; ?>" required />
                                            <div class="invalid-feedback">
                                                El campo es requerido
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="fv-row mb-0">
                                            <label for="txtEmailPasswordConfirm" class="form-label fs-6 fw-bold mb-3">Confirmar contraseña</label>
                                            <input type="password" class="form-control form-control-solid form-control-sm" name="txtEmailPasswordConfirm" id="txtEmailPasswordConfirm" required />
                                            <div class="invalid-feedback">
                                                El campo es requerido
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button id="kt_signin_submit" type="submit" class="btn btn-primary btn-sm me-2 px-6">Actualizar contraseña</button>
                                    <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-500 btn-sm btn-active-light-primary px-6">Cancelar</button>
                                </div>
                            </form>

                        </div>

                        <div id="kt_signin_email_button" class="ms-auto">
                            <button class="btn btn-light btn-active-light-primary" type="button" id="btnChangeEmail">Cambiar correo</button>
                        </div>

                    </div>

                    <div class="separator separator-dashed my-6"></div>

                    <div class="d-flex flex-wrap align-items-center">

                        <div id="kt_signin_password">
                            <div class="fs-6 fw-bold mb-1">Contraseña</div>
                            <div class="fw-semibold text-gray-600">************</div>
                        </div>

                        <div id="kt_signin_password_edit" class="flex-row-fluid d-none">

                            <form id="kt_signin_change_password" class="form" novalidate="novalidate">
                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="txtCurrentPassword" class="form-label fs-6 fw-bold mb-3">Contraseña actual</label>
                                            <input type="password" class="form-control form-control-sm form-control-solid" name="txtCurrentPassword" id="txtCurrentPassword" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="txtNewPassword" class="form-label fs-6 fw-bold mb-3">Nueva contraseña</label>
                                            <input type="password" class="form-control form-control-sm form-control-solid" name="txtNewPassword" id="txtNewPassword" />
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12">
                                                <div class="password-rules-item">
                                                    <span class="password-rules-icon password-rules-icon-length">
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                    <span class="password-rules-text">Debe tener al menos 6 caracteres</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="password-rules-item">
                                                    <span class="password-rules-icon password-rules-icon-number">
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                    <span class="password-rules-text">Debe tener al menos un número</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="password-rules-item">
                                                    <span class="password-rules-icon password-rules-icon-uppercase">
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                    <span class="password-rules-text">Debe tener al menos una mayúscula</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="password-rules-item">
                                                    <span class="password-rules-icon password-rules-icon-lowercase">
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                    <span class="password-rules-text">Debe tener al menos una minúscula</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="fv-row mb-0">
                                            <label for="txtConfirmPassword" class="form-label fs-6 fw-bold mb-3">Confirme nueva contraseña</label>
                                            <input type="password" class="form-control form-control-sm form-control-solid" name="txtConfirmPassword" id="txtConfirmPassword" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button id="kt_password_submit" type="submit" class="btn btn-sm btn-primary me-2 px-6">Actualizar contraseña</button>
                                    <button id="kt_password_cancel" type="button" class="btn btn-sm btn-color-gray-500 btn-active-light-primary px-6">Cancelar</button>
                                </div>
                            </form>

                        </div>

                        <div id="kt_signin_password_button" class="ms-auto">
                            <button type="button" class="btn btn-light btn-active-light-primary" id="btnChangePassword">Cambiar contraseña</button>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
$jsModules = [
    'profile'
];
