<x-front-layout>
    <div class="bg-88-orange w-screen h-screen bg-welcome bg-no-repeat bg-center bg-cover">
        <div class="flex flex-col h-full justify-center content-center items-center">
            <div class="w-96">
                <x-application-logo></x-application-logo>
            </div>
            <input type="hidden" name="string" id="string" value="{{ request()->route('encrypt') }}">
            <span>Kindly hold on as we verify your account.</span>
            <div class="mt-3 w-96 flex justify-center content-center items-center">
                <!-- By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL -->
                <svg width="135" height="50" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                    <rect y="10" width="15" height="120" rx="6">
                        <animate attributeName="height"
                             begin="0.5s" dur="1s"
                             values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
                             repeatCount="indefinite" />
                        <animate attributeName="y"
                             begin="0.5s" dur="1s"
                             values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
                             repeatCount="indefinite" />
                    </rect>
                    <rect x="30" y="10" width="15" height="120" rx="6">
                        <animate attributeName="height"
                             begin="0.25s" dur="1s"
                             values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
                             repeatCount="indefinite" />
                        <animate attributeName="y"
                             begin="0.25s" dur="1s"
                             values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
                             repeatCount="indefinite" />
                    </rect>
                    <rect x="60" width="15" height="140" rx="6">
                        <animate attributeName="height"
                             begin="0s" dur="1s"
                             values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
                             repeatCount="indefinite" />
                        <animate attributeName="y"
                             begin="0s" dur="1s"
                             values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
                             repeatCount="indefinite" />
                    </rect>
                    <rect x="90" y="10" width="15" height="120" rx="6">
                        <animate attributeName="height"
                             begin="0.25s" dur="1s"
                             values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
                             repeatCount="indefinite" />
                        <animate attributeName="y"
                             begin="0.25s" dur="1s"
                             values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
                             repeatCount="indefinite" />
                    </rect>
                    <rect x="120" y="10" width="15" height="120" rx="6">
                        <animate attributeName="height"
                             begin="0.5s" dur="1s"
                             values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
                             repeatCount="indefinite" />
                        <animate attributeName="y"
                             begin="0.5s" dur="1s"
                             values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
                             repeatCount="indefinite" />
                    </rect>
                </svg>
            </div>
        </div>
    </div>
</x-front-layout>

<script>
    $(document).ready(function () {
        setTimeout(function () {
            fetch("{{ route('verify.submit') }}", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body:JSON.stringify({
                    'encrypted_id': $('#string').val()
                })
            }).then(function(res) {
                //res.json();
                window.location.href = "{{ route('homepage') }}";
            });
        }, 1500);
    });
</script>


