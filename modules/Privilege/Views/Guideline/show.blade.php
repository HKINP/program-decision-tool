<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="PeaceNepalDOTCom">
    <meta name="csrf-token" content="{!!  csrf_token() !!}"/>

    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <title>Guidelines || {!! config('app.name') !!}</title>
    <link href="{{ asset('css/applist.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script>
        var rootUrl = '{!! url('') !!}';
    </script>
</head>
<body>

<div class="loading" style="display: none;"></div>

<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        @include('layout.header')
    </header>
    <!--header end-->
    <aside>
        <div class="nav-collapse" id="sidebar">
            <!-- sidebar menu start-->
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a href="{!! route('dashboard') !!}" id="dashboard">
                            <i class="fa fa-dashboard">
                            </i>
                            <span>
                        Dashboard
                    </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            @include('layout.breadcrumb')

    <div class="row">
        <div class="col-md-12">

            <div data-collapsed="0" class="panel">

                <header class="panel-heading">
                    Guideline Detail
                </header>

                <div class="panel-body">
                    <table class="table-hover table table-bordered table-condensed">
                        <tr>
                            <td class="gray-bg">Heading</td>
                            <td>{!! $guideline->heading !!}</td>
                            <td class="gray-bg">Published Date</td>
                            <td>{!! $guideline->getPublishedAt() !!}</td>
                        </tr>
                        <tr>
                            <td class="gray-bg">Description</td>
                            <td colspan="3">{!! $guideline->description !!}</td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>
    </div>
        </section>
        <!--footer start-->
        <footer class="footer clearfix">
            @include('layout.footer')
        </footer>
        <!--footer end-->
    </section>
    <!--main content end-->
    <!--right sidebar start-->
    <!--right sidebar end-->

</section>
<!-- Placed js at the end of the document so the pages load faster -->

<script src="{{ asset('js/applist.js') }}"></script>
</body>
</html>
