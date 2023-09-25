<x-mail::message>
    # Team-Location

    WELCOME TO THE BEST RENT-WEBSITE MY DEAR.


    <x-mail::button :url="'http://127.0.0.1:8000/addAnnonce'">
        Voir
    </x-mail::button>
    <x-mail::table>
        | Objet demande       | Client         | EmailClient  |
        | ------------- |:-------------:| --------:|
        | {{ $annonces->title }}      | {{ Auth::user()->name }}             | {{ Auth::user()->email }}   |
    </x-mail::table>
    Thanks,<br>
    Team-Location-Gi2
</x-mail::message>

