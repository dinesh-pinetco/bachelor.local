<div class="flex justify-end">
    <img style="height:70px;"
         src="{{ asset('images/logo.png') }}"
         alt="logo">
</div>
<div class="flex text-sm font-light text-gray-500">
    <p class="flex-1 mt-20 ml-32">NORDAKADEMIE | Köllner Chaussee 11 | 25337 Elmshorn</p>
    <p class="flex-nowrap mr-24 mt-20">NORDAKADEMIE Hochschule der Wirtschaft <br>
        Köllner Chaussee 11 <br>
        25337 Elmshorn</p>
    <p>Tel: 04121 4090 - 0 <br>
    Fax: 04121 4090 - 40 <br>
    info@nordakademie.de <br>
    nordakademie.de <br>
</p>
</div>

<div>
    <p>{{ $user->first_name }}  {{ $user->last_name }}</p>
    <p>{{ $street_house_number }}</p>
    <p>{{ $postal_code }} , {{ $location }}</p>
</div>
