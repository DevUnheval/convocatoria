@extends('layouts.material')

@section('css')
@endsection

@section('content')
<div class="card">
    <div class="card-body table-responsive">
        <div class="card-body wizard-content bg-light">
            <form action="#" class="tab-wizard wizard-circle">
            <h4 class="card-title">Nueva Convocatoria</h4>
            <br>
            <section>
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstName1">Código de la convocatoria :</label>
                            <input type="text" class="form-control" id="firstName1"> </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location1">Tipo de Proceso :</label>
                            <select class="custom-select form-control" id="location1" name="location">
                                <option value="">*Seleccione*</option>
                                <option value="Amsterdam">CAS/1057</option>
                                <option value="Frankfurt">Prácticas</option>
                                <option value="Berlin">276</option>
                                <option value="Frankfurt">728</option>
                            </select>
                        </div>
                    </div>  
                </div>                  
                <div class="row">                        
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastName1">Nombre de la convocatoria:</label>
                            <input type="text" class="form-control" id="" placeholder="Cargo al que postula"> </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="emailAddress1">Puesto de la convocatoria :</label>
                            <input type="text" class="form-control" id="" placeholder="Area/Unidad al que postula"> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location1">Select City :</label>
                            <select class="custom-select form-control" id="location1" name="location">
                                <option value="">Select City</option>
                                <option value="Amsterdam">India</option>
                                <option value="Berlin">USA</option>
                                <option value="Frankfurt">Dubai</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="date1">Date of Birth :</label>
                            <input type="date" class="form-control" id="date1"> </div>
                    </div>
                </div>
            </section>
            <div  class="row">
                <div class="form-group col-md-12">
                    <button data-repeater-delete="" class="btn btn-danger waves-effect waves-light m-l-10" type="button">Cancelar
                    </button>
                    <button class="btn btn-success waves-effect waves-light" type="submit">Guardar
                    </button>  
                </div>
            </div>            
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
{{-- Ajustes de vista --}}
@endsection