<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    </head>
    <body class="antialiased">

        <div class="container">
            <div class="chat-container mt-5">
                <ul class="chat-list"></ul>
            </div>

            <div class="chat-section mb-3">
                <div class="form-control" id="chatInput" contenteditable=""></div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
         crossorigin="anonymous"></script>

        <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"
        integrity="sha384-2huaZvOR9iDzHqslqwpR87isEmrfxqyWOF7hr7BY6KG0+hVKLoEXMPUJw3ynWuhO"
        crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <script>
           $(function(){
                let ip_address = '127.0.0.1';
                let socket_port = '3000';
                let socket = io(ip_address + ':' + socket_port);
                // socket.on('connection');

                let chatInput = $("#chatInput");
                chatInput.keypress(function (e) {
                    let message = $(this).html();
                    console.log(message);
                    if(e.which === 13 && !e.shiftKey) {
                        socket.emit('sendChatToServer',message);
                        chatInput.html('');
                        return false;
                    }
                });

                socket.on('sendChatToClient',(message) => {
                    $(".chat-list").append(`<li>${message}</li>`);
                });
           });
        </script>
    </body>
</html>
