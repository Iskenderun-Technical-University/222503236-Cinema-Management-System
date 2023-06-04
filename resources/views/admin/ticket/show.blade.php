<link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">


<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


    <div class="row">

        <div class="ticket" id="printable">
            <div class="movie">{{$session->movie->title}}</div>


            <div class="gap"></div>
            <div class="bottom">
                <div class="section-one">Tek Kisilik</div>
                <div class="section-two">
                    <div class="info">
                        <div class="title">Salon</div>
                        <div class="content">{{$session->cinema->name}}</div>
                    </div>
                    <div class="info">
                        <div class="title">Kisim</div>
                        <div class="content">{{ substr($info->seat_name,0,1) }}</div>
                    </div>
                    <div class="info">
                        <div class="title">Koltuk</div>
                        <div class="content">{{ substr($info->seat_name,1,strlen($info->seat_name)-1 ) }}</div>
                    </div>

                </div>

                <div class="section-three">{{\Carbon\Carbon::parse($session->date)->format('d M Y')}} | {{\Carbon\Carbon::parse($session->time)->format('H:i')}} </div>
                <div class="section-four">Price : {{$info->purchase_price}}</div>
            </div>


        </div>
        <div id="non-printable">
            <div><a class="btn btn-warning" href="{{route('tickets.sell',$session->id)}}">Back</a></div>
            <div><a class="btn btn-dark print" href="#">Print and Back </a></div>
        </div>
    </div>

    <style>
        .ticket {
            background-image: url("{{asset('screen.jpg')}}");
            position: relative;
            width: 250px;
            height: 600px;
            border: solid;
            border-radius: 7px;
            background-color: gainsboro;
        }

        .ticket .movie {
            font-size: 25px;
            text-transform: uppercase;
            text-align: center;
            height: 60px;
            background-color: black;
            color: coral;
            width: 210px;
            margin: 10px auto;
            border-radius: 4px;
            padding-top: 10px;
        }

        .gap {
            height: 350px;
        }

        .section-one {
            color: white;
            text-transform: uppercase;
            text-align: center;
            font-weight: 700;
            font-size: 22px;
            padding: 10px 0;
        }

        .section-two {
            display: flex;
            justify-content: space-evenly;
            color: white;
            text-transform: uppercase;
            text-align: center;

        }

        .section-three {
            text-align: center;
            color: white;
            font-size: 14px;
            padding: 4px 0 0 0;
        }

        .section-four {
            text-align: center;
            color: white;
            font-size: 14px;
            padding: 0 0 10px 0;
        }

        .info {
            color: black;
            background-color: white;
            width: 60px;
            height: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .title {
            font-size: 10px;
        }

        .content {
            font-size: 15px;
        }

        .bottom {
            position: absolute;
            bottom: 0;
            background-color: #F78C6C;
            width: 100%;
        }

        @media print
        {
            #non-printable { display: none; }
            #printable { display: block; }
        }
    </style>


<script>
    $(function () {
        $('.print').on('click', function () {

            console.log('tiklandi')
            window.print();
            window.location.href = '{{route('tickets.sell',$session->id)}}';
        });
    });
</script>
