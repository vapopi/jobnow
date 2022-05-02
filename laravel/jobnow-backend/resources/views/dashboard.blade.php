<style>
    .color{  
        background-color: #6356e5 !important;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="text-center">
    <h3><strong>
        Welcome to jobnow {{ Auth::user()->name }}!
        </strong>
    </h3>
</div>
<br>
<div class="text-center botonera">

    @if (Auth::user()->role_id == 4 && Auth::user()->email_verified_at != null)

        <a class="color btn btn-primary" href="{{route('premium.index')}}" role="button">Premium</a>
        <a class="color btn btn-primary" href="" role="button">Offers</a> <!-- React -->
        <a class="color btn btn-primary" href="" role="button">Companies</a> <!-- React -->
        <a class="color btn btn-primary" href="" role="button">Posts</a> <!-- React -->
        <a class="color btn btn-primary" href="" role="button">Notifications</a> <!-- React -->
        <a class="color btn btn-primary" href="" role="button">Tickets</a> <!-- React -->
        <a class="color btn btn-primary" href="" role="button">Chat</a> <!-- React -->

    @endif

    @if (Auth::user()->role_id == 1 && Auth::user()->email_verified_at != null)

        <a class="color btn btn-primary" href="{{route('security.index')}}" role="button">Security</a>

    @endif
    
</div>


