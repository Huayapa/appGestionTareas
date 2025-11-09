<x-app-layout>
    <div class="max-w-screen-xl gap-6 grid lg:grid-cols-2">
        <div class="p-4 sm:p-8 bg-dark-30 border border-dark shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-dark-30 border border-dark shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="lg:col-span-2 p-4 sm:p-8 bg-dark-30 border border-dark shadow sm:rounded-lg">
            <div class="">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
