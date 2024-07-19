<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ekendra Lamsal">
    <meta name="csrf-token" content="{!!  csrf_token() !!}"/>

    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <title>Notices and Guidelines || {!! config('app.name') !!}</title>
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
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Notices & Guidelines
                        </header>
                        <div class="panel-body">
                            <p>Ensure you have read all the notices and guidelines before working in OPS/LPTS. All read items are marked green.</p><p>यो प्रणाली (OPS) प्रयोग पुर्व तल देखाइएका सम्पूर्ण सूचना तथा मार्गदर्शनहरु (आँखा <i class="fa fa-lg fa-eye"></i> चिन्ह क्लिक गरि) राम्ररी पढ्नुहोस् | पढिसकेका सूचना हरियो मार्कद्वारा इंकित छन् |

                            </p>
                            <div class="adv-table editable-table ">
                                <table class="table-hover table table-bordered table-striped" id="guideline-table">
                                    <thead>
                                    <tr>
                                    <th style="width:0px;padding-right: 0px;"></th>
                                        <th>
                                            SN
                                        </th>
                                        <th>
                                            Topic
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                        <th>
                                            Published Date
                                        </th>
                                        <th>
                                            Expires on
                                        </th>
                                        <th>
                                            Read option
                                        </th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                    <th style="width:0px;padding-right: 0px;"></th>
                                        <th>
                                            SN
                                        </th>
                                        <th>
                                            Topic
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                        <th>
                                            Published Date
                                        </th>
                                        <th>
                                            Expires on
                                        </th>
                                        <th>
                                            Read option
                                        </th>
                                    </tfoot>
                                    <tbody id="tablebody">
                                    @foreach($guidelines as $index=>$guideline)
                                        <tr class="gradeX" data-href="{!! route('guideline.show', $guideline->id) !!}" style="cursor: pointer;" id="row_{{ $guideline->id }}">
                                            <td class="{!! $user->getGuidelineReadStatus($guideline) !!}" tile="{!! ucwords($user->getGuidelineReadStatus($guideline)) !!}"></td>
                                            <td>
                                                {{ $index+1 }}
                                            </td>
                                            <td class="heading">
                                                {{ $guideline->heading }}
                                            </td>
                                            <td class="description">
                                                {!! str_limit($guideline->description, 200) !!}
                                            </td>
                                            <td class="published_at">
                                                {{ $guideline->getPublishedAt() }}
                                            </td>
                                            <td class="published_at">
                                            {!! $guideline->getExpiredon() !!}
                                            </td>
                                            <td>
                                               <a href="{!! route('guideline.show', $guideline->id) !!}"title="Show Guideline (सूचना पढ्नुहोस्)">
                                                    <i class="fa fa-lg fa-eye"></i>
                                             </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </section>
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
<script type="text/javascript">
$('tr[data-href]').on("click", function() {
    document.location = $(this).data('href');
});
</script>
<script src="{{ asset('js/applist.js') }}"></script>
</body>
</html>
