 <!DOCTYPE html>

<html lang="en" class="default-style layout-fixed layout-navbar-fixed">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ asset('Admin/assets/fonts/fontawesome.css')}}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/fonts/ionicons.css')}}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/fonts/linearicons.css')}}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/fonts/open-iconic.css')}}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/fonts/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/fonts/feather.css')}}">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{ asset('Admin/assets/css/bootstrap-material.css')}}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/css/shreerang-material.css')}}">
    <link rel="stylesheet" href="{{ asset('Admin/assets/css/uikit.css')}}">

    <!-- Libs -->
    <link rel="stylesheet" href="{{ asset('Admin/assets/libs/perfect-scrollbar/perfect-scrollbar.css')}}">
    <style>
        html,
        body {
            background: #fff !important;
        }

        body> :not(.invoice-print) {
            display: none !important;
        }

        .invoice-print {
            min-width: 768px !important;
            font-size: 15px !important;
        }

        .invoice-print * {
            border-color: #aaa !important;
            color: #000 !important;
        }
    </style>
        <div class="invoice-print p-5">
            <div class="row">
                <div class="col-sm-12 pb-4 text-center">
                    <div class="media align-items-center mb-1">
                        <a href="!#" class="navbar-brand app-brand demo py-0 mr-4">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('11.png')}}" style="width:120px;height:70px;" alt="Brand Logo" class="img-fluid">
                            </span>
                            <span class="app-brand-text demo font-weight-bold text-dark ml-4" style="text-transform:uppercase;font-size:50px;">Safeway Junior School</span>
                        </a>
                        @foreach($student_report_details as $detail)
                            <img style="width:100px;height:80px;" src="{{asset('storage/Student_photos/'.$detail->photo)}}">
                        @endforeach
                    </div>
                    <div class="mb-1" style="font-weight:bold; text-transform:uppercase;font-size:36px;">Kawempe- TTula</div>
                    <div class="mb-1" style="font-weight:bold; text-transform:uppercase;font-size:20px;">0772-380547 | 0702-932992</div>
                    <div style="box-shadow: 0 0 0 1px #8897AA inset; font-weight:bold;">TERMLY REPORT</div>
                </div>
            </div>
            <hr class="mb-4">
            
            @foreach($student_report_details as $detail)
            <div class="row">
                <div class="col-sm-4 mb-4">
                    <div class="font-weight-bold mb-2">Name:&nbsp;<span class="text-muted">{{$detail->last_name}} {{$detail->first_name}} {{$detail->other_names}}</span></div>
                </div>
                <div class="col-sm-4 mb-4">
                    <div class="font-weight-bold mb-2">Class:&nbsp;<span class="text-muted">{{$detail->level}}</span></div>
                </div>
                <div class="col-sm-4 mb-4">
                    <div class="font-weight-bold mb-2">Term:&nbsp;<span class="text-muted">{{$detail->term}}</span></div>
                </div>
                <div class="col-sm-4 mb-4">
                @php
                    $age=\Modules\ReportCard\Entities\Result::join('students','students.id','results.student_id')->where('student_id',$detail->student_id)->value('date_of_birth');
                    $year =\Carbon\Carbon::parse($detail->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years');
                    $today =\Carbon\Carbon::now()->format('Y-m-d');
                @endphp
                    <div class="font-weight-bold mb-2">Age: &nbsp;<span class="text-muted">{{$year}}</span></div>
                </div>
                <div class="col-sm-4 mb-4">
                    <div class="font-weight-bold mb-2">Sex: &nbsp;<span class="text-muted">{{$detail->gender}}</span></div>
                </div>
                <div class="col-sm-4 mb-4">
                    <div class="font-weight-bold mb-2">Date:&nbsp; <span class="text-muted">{{$today}}</span></div>
                </div>
            </div>
            
            @endforeach
            <div class="table-responsive mb-4">
            <div class="font-weight-bold text-center">MID TERM EXAM</div>
                <table class="table m-0 table-bordered">
                    <thead>
                        <tr>
                            <th class="py-3">
                                SUBJECT
                            </th>
                            <th class="py-3">
                                SCORE
                            </th>
                            <th class="py-3">
                                OUT OF
                            </th>
                            <th class="py-3">
                                REMARKS
                            </th>
                            <th class="py-3">
                                INITIALS
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($student_report_cards as $card)
                        <tr>
                            <td class="py-3">
                                {{$card->subject}}
                            </td>
                            <td class="py-3">
                            {{$card->assessment_marks}}
                            </td>
                            <td class="py-3 text-danger font-weight-bold">
                            100
                            </td>
                            <td class="py-3" style="text-transform:capitalize;">
                            {{$card->remark}}
                            </td>
                            <td class="py-3">
                            {{$card->teacher_initials}}
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            
                            <td class="py-3">
                                Total
                            </td>
                            @foreach($student_report_cards as $card)
                            @php
                                $total_exam_marks =\Modules\ReportCard\Entities\Result::where('student_id',$card->student_id)->whereYear('created_at', '=', \Carbon\Carbon::today())->sum('assessment_marks');
                            @endphp
                            @endforeach
                            <td class="py-3 font-weight-bold">
                            {{$total_exam_marks}}
                            </td>
                            <td class="py-3 font-weight-bold">
                            
                            </td>
                            <td class="py-3">
                            </td>
                            <td class="py-3">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-6 mb-4">
                    <div class="font-weight-bold mb-2">GRADE:.............................................................................................</div>
                </div>
                <div class="col-sm-6 mb-4">
                    <div class="font-weight-bold mb-2">OUT OF :................................................................................................</div>
                </div>
            </div>
            <hr class="mb-4">
            <div class="row">
                <div class="col-sm-8 mb-4">
                    <div class="font-weight-bold mb-2">Class Teacher's Report:...................................................................................................</div>
                </div>
                <div class="col-sm-4 mb-4">
                    <div class="font-weight-bold mb-2">Sign:............................................................</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 mb-4">
                    <div class="font-weight-bold mb-2">Head Teacher's Report:.....................................................................................................</div>
                </div>
                <div class="col-sm-4 mb-4">
                    <div class="font-weight-bold mb-2">Sign:............................................................</div>
                </div>
            </div>
            <div class="text-center" style="font-weight:bold; font-size:20px;font-family: "Times New Roman", Times, serif;">
                <strong>'Aim at excellence'</strong> 
            </div>
        </div>
    <script src="{{ asset('Admin/assets/js/pace.js')}}"></script>
<script src="{{ asset('Admin/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('Admin/assets/libs/popper/popper.js')}}"></script>
<script src="{{ asset('Admin/assets/js/bootstrap.js')}}"></script>
<script src="{{ asset('Admin/assets/js/sidenav.js')}}"></script>
<script src="{{ asset('Admin/assets/js/layout-helpers.js')}}"></script>
<script src="{{ asset('Admin/assets/js/material-ripple.js')}}"></script>

<!-- Libs -->
<script src="{{ asset('Admin/assets/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{ asset('Admin/assets/libs/eve/eve.js')}}"></script>
<script src="{{ asset('Admin/assets/libs/flot/flot.js')}}"></script>
<script src="{{ asset('Admin/assets/libs/flot/curvedLines.js')}}"></script>
<script src="{{ asset('Admin/assets/libs/chart-am4/core.js')}}"></script>
<script src="{{ asset('Admin/assets/libs/chart-am4/charts.js')}}"></script>
<script src="{{ asset('Admin/assets/libs/chart-am4/animated.js')}}"></script>

<!-- Demo -->
<script src="{{ asset('Admin/assets/js/demo.js')}}"></script>
<script src="{{ asset('Admin/assets/js/analytics.js')}}"></script>
<!-- Alpine v3 -->
{{-- <script defer src="{{asset('assets/js/cdn.js')}}"></script>
<link href="{{asset('assets/css/tailwind.css')}}" rel="stylesheet">
@livewireScripts
@livewire('livewire-ui-modal') --}}
<script src="{{ asset('Admin/assets/js/pages/dashboards_index.js')}}"></script>
    <script>
        // -------------------------------------------------------------------------
        // Print on window load

        $(function() {
            window.print();
        });
    </script>
</html>