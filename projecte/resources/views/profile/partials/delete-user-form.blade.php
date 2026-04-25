<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Eliminar Cuenta') }}
        </h2>
        <p class="mt-1 text-sm text-gray-400">
            {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos se borrarán permanentemente.') }}
        </p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Eliminar Cuenta') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-gray-800">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-white">
                {{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                {{ __('Por favor, introduce tu contraseña para confirmar que deseas eliminar tu cuenta permanentemente.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4 bg-gray-900 border-gray-700 text-white" placeholder="{{ __('Contraseña') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="bg-gray-700 text-white hover:bg-gray-600 border-none">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Eliminar Cuenta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>