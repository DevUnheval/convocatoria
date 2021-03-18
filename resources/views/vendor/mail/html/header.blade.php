<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="" class="logo" alt="Laravel Logo">
@else
{{--{{ $slot }}--}}
<!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="{{route('index')}}">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Light Logo icon -->
                            <img src="{{substr(\App\Ajuste::find(1)->elemento('logo'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('logo'))
                                    :asset(\App\Ajuste::find(1)->elemento('logo'))}}" alt="Logo" class="light-logo" height="45px"/>
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- Light Logo text -->
                            <img src="{{substr(\App\Ajuste::find(1)->elemento('logo texto 2'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('logo texto 2'))
                                    :asset(\App\Ajuste::find(1)->elemento('logo texto 2'))}}" class="light-logo" alt="Convocatoria" style="max-width: 150px; max-height: 45px"/>
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
@endif
</a>
</td>
</tr>
