<html>
<head>
<title>Login Page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/md5.js') }}"></script>
</head>

<body>

    <form name="sendin" action="{{ $linkloginonly }}" method="post">
        <input type="hidden" name="username" />
		<input type="hidden" name="password" />
		<input type="hidden" name="dst" value="{{ $linkorig }}" />
		<input type="hidden" name="popup" value="true" />
	</form>

    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h3 id="h-title">SMARTID PORTAL</h3>
        </div>
        <div class="login-box">
            <form class="login-form" name="login">
                <h4 class="login-head" style="padding-top:0px"><i class="fa fa-lg fa-fw fa-check"></i> {{$mac}}</h4>
                <center><p id="AlertMac">test</p></center>
                <div class="form-group">
                    <label class="control-label">NIM</label>
                    <input class="form-control" id='Nim' name="username" type="text" value="{{ $username }}" placeholder="Username" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">Course</label>
                    <input class="form-control" id="Schedule" type="text" placeholder="Today Schedules">
                </div>
                <div class="form-group">
                    <div class="utility">
                        <p class="semibold-text mb-0"><a id="wifiAccess" data-toggle="flip">Wifi Access ?</a></p>
                    </div>
                </div>
                <div class="form-group btn-container">
                    <button id="SignIN" class="btn btn-primary btn-block" disabled><i class="fa fa-sign-in fa-lg fa-fw"></i>Absent</button>
                </div>
            </form>
            <form class="forget-form" action="{{ $linkloginonly }}" method="post" onSubmit="return doLogin()">
                <div class="form-group">
                    <input type="hidden" name="dst" value="{{ $linkorig }}" />
                    <input type="hidden" name="popup" value="true" />
                    <label class="control-label">USERNAME</label>
                    <input class="form-control" id='UserName' name="username" type="text" value="{{ $username }}" placeholder="Username" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">PASSWORD</label>
                    <input class="form-control" name="password" type="password" placeholder="Password">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SEND</button>
                </div>
                <div class="form-group">
                    <p class="semibold-text mt-10"><a id="backTo" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>Back to Login</a></p>
                </div>
            </form>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            $.ajax({
                type: 'GET',
                url: '{{ url('/api/portal/login/getmac?mac=') . $mac }}',
                dataType: 'json',
                success: function(data) {
                    if(data.status == 200){
                        console.log(data);
                        if(data['data'].nim){
                            console.log("nim exists");
                        }
                        $('.login-head > ').css('color', 'green');
                        $('#Nim').val(data['data'].nim);
                        $('#AlertMac').html('<b>MAC ADDRESS REGISTERED</b>').css('color', 'green');
                        $('#SignIN').prop('disabled', false);
                        $('#Schedule').val(data['data'].matakuliah);
                    }
                    else {
                        $('.login-head > i ')
                            .removeClass('fa-check')
                            .addClass('fa-times')
                            .css('color', 'red');
                        $('#AlertMac').html('<b>YOUR MAC ADDRESS UNREGISTERED</b>').css('color', 'red');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            })
        });

        $('#wifiAccess').click(function(){
            $('#h-title').text('WIFI ACCESS');
        });

        $('#backTo').click(function(){
            $('#h-title').text('SMARTID PORTAL');
        });
    </script>

    <script>
        function doLogin() {
            <?php if (strlen($chapid) < 1) {
                echo "return true;\n";
            } ?>
            document.sendin.username.value = document.login.username.value;
            document.sendin.password.value = hexMD5('{{ $chapid }}' + document.login.password.value + '{{ $chapchallenge }}');
            document.sendin.submit();
            return false;
        }
    </script>

</body>

</html>
