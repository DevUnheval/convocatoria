                @if(session()->has('gris'))
                    <div class="alert alert-default">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>Mensaje: </strong>{{ session('gris') }}.
                    </div>
                @endif
                @if(session()->has('azul2'))
                    <div class="alert alert-primary">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>¡Éxito!</strong>{{ session('azul2') }}..
                    </div>
                @endif
                @if(session()->has('verde'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                         <strong>¡Bien hecho! </strong>{{ session('verde') }}.
                    </div>
                @endif
                @if(session()->has('azul'))
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>¡Atento! </strong>{{ session('azul') }}.
                    </div>
                @endif

                @if(session()->has('naranja'))
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                         <strong>¡Cuidado! </strong>{{ session('naranja') }}.
                    </div>
                @endif

                @if(session()->has('rojo'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>¡Error! </strong>{{ session('rojo') }}
                    </div>
                @endif
                @if(session()->has('negro'))
                    <div class="alert alert-dark">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <strong>¡Acceso denegado! </strong>{{ session('negro')}}.
                    </div>
                @endif