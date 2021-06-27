<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>
    $(document).ready(function() {

        var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
            cluster: '{{env("PUSHER_APP_CLUSTER")}}',
            encrypted: true
        });

        var channel = pusher.subscribe('notify-channel');
        channel.bind('App\\Events\\Notify', function(data) {

            if(data.type === "success")
            {
                iziToast.show({
                    color: 'success',
                    title: data.title,
                    message: data.message,
                    position: 'topRight',
                    progressBar: true,
                    theme: 'light',
                });
            }else if(data.type === 'error' ){
                iziToast.show({
                    color: 'red',
                    title: data.title,
                    message: data.message,
                    position: 'topRight',
                    progressBar: true,
                    theme: 'light',
                });
            }else if(data.type === 'info'){
                iziToast.show({
                    color: 'info',
                    title: data.title,
                    message: data.message,
                    position: 'topRight',
                    progressBar: true,
                    theme: 'light',
                });
            }
        });

    })
</script>
