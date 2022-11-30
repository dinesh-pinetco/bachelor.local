<center>
    <div style="border: 2px solid gray;padding: 4%;margin-top: 5%;width: 30%">
            @if($user->application_status->id() < 8)
                <div style="margin-top: 3%;">
                    <img height="100px" width="100px" src="https://cdn-icons-png.flaticon.com/512/463/463612.png" alt="failed">
                    <h2 style="color: lightcoral">You failed in exam try again.</h2>
                </div>
                <div>
                    <div>
                        <h2>Name: {{ $user->first_name }}</h2>
                        <h2>Zip: {{ $zipCode }}</h2>
                        <h2>City: {{ $city }}</h2>
                        <h2>Date Of Birth: {{ $date_of_birth }}</h2>
                    </div>
                </div>
            @else
                <div style="margin-top: 3%;">
                    <img height="100px" width="100px" src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Passed">
                    <h2 style="color: lightseagreen">You have passed exam.</h2>
                </div>
                <div>
                    <div>
                        <h2>Name: {{ $user->first_name }}</h2>
                        <h2>Zip: {{ $zipCode }}</h2>
                        <h2>City: {{ $city }}</h2>
                        <h2>Date Of Birth: {{ $date_of_birth }}</h2>
                    </div>
                </div>
            @endif
            <div>
                <a href="{{ route('index') }}">Done</a>
            </div>
    </div>
</center>
