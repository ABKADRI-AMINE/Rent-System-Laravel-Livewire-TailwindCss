<x-mail::message>
    # Team-Location

    WELCOME TO THE BEST RENT-WEBSITE MY DEAR.


    <x-mail::button :url="'http://127.0.0.1:8000'">
        Voir
    </x-mail::button>
    <x-mail::table>
        | Objet Loué       | Partenaire de l'objet         | Client  |
        | ------------- |:-------------:| --------:|
        | {{ $objetLoue }} | {{ $partenaire }} | {{ $client }} |
    </x-mail::table>
    Thanks,<br>
    Team-Location-Gi2
</x-mail::message>
