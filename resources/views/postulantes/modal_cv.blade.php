
<!--  Modal content for the above example -->
<div class="modal fade" id="modal_cv" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myLargeModalLabel">Curriculum Vitae</h4>
                <button type="button" class="close ml-auto" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    {{-- <div class="col-lg-6"> --}}
                        <div class="card">
                            <div class="card-body">

                                {{-- <h4 class="card-title mb-3">Tabs Bordered</h4> --}}

                                <ul class="nav nav-tabs nav-bordered mb-3 customtab">
                                    <li class="nav-item">
                                        <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Datos Personales</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#profile-b1" data-toggle="tab" aria-expanded="true"
                                            class="nav-link active">
                                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Formacion Académica</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#settings-b1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Experiencia Laboral</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane" id="home-b1">
                                        <p>Pancracio</p>
                                        <p class="mb-0">Rios</p>
                                    </div>
                                    <div class="tab-pane show active" id="profile-b1">
                                        <p>primaria</p>
                                        <p class="mb-0">secu y pre</p>
                                    </div>
                                    <div class="tab-pane" id="settings-b1">
                                        <p>maestro pokemon :v</p>
                                        <p class="mb-0">influencer</p>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    {{-- </div> <!-- end col --> --}}
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->