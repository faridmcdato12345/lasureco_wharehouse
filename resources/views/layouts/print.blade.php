<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('LASURECO', 'LASURECO') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <style>
        @media print{
            table{
                font-size:12px;
            }
        }
        .name{
            text-transform: uppercase;
            font-weight: bold;
        }
        hr{
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            margin: 0;
        }
        .horizontal{
            display: inline-block;
            position: relative;
            padding: 0;
            margin: 8px 0px -8px 0px;
            height: 0;
            width: 50%;
            max-height: 0;
            font-size: 1px;
            line-height: 0;
            clear: both;
            border: none;
            border-top: 2px solid #000000;
            border-bottom: 1px solid #ffffff;
        }
        .order-number-div .col-md-4{
            text-align:left;
        }
        .order-number-div .col-md-4 div{
            display: inline-block;
            width: 100%;
        }
        .voucher_code.underline{
            border-bottom: 2px solid black;
            display: inline-block;
            width: 50%;
        }
        .underline{
            border-bottom: 2px solid black;
            display: inline-block;
            width: 50%;
        }
    </style>
</head>
<body onload="window.print()" onafterprint="returnToPage()">
    <div id="app">
        <main class="py-4 container">
            <div>
                <div style="float:left;width:10%;"><img src="{{asset('images/logo.gif')}}" alt="lasureco logo" style="width: 100%;"></div>
                <div style="float:right;width:90%;padding-left:1%;">
                    <h3>LANAO DEL SUR ELECTRIC COOPERATIVE, INC.</h3>
                    <h5>Satellite Office, Provincial Capitol Complex, Marawi City 9700</h5>
                    <span><a href="">teamlasureco@ymail.com</a></span>
                </div>
            </div>
            @yield('content')
            
        </main>
    </div>
</body>
<script type="text/javascript">
    function returnToPage(){
        window.history.back();
        // console.log(window.location.href)
        // let url = window.location.href
        // url = url.substring(0,url.indexOf('print'))
        // console.log(url)
        // window.open(url,"_self")
    }
</script>
</html>