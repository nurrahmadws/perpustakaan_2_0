<!DOCTYPE html>
<html>
@include('admin.template.header')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('admin.template.navbar')

    @include('admin.template.side_menu')

    <div class="content-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                @yield('breadcrumb')
            </ol>
        </nav>

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
        </section>
    </div>


  @include('admin.template.footer')
</div>

@include('admin.template.script')
</body>
</html>
