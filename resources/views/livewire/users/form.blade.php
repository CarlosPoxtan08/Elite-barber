<div class="p-6 bg-white border-b border-gray-200">
    <form wire:submit="save">
        <div class="mb-4">
            <label class="block text-gray-700">Nombre</label>
            <input wire:model="name" type="text" class="w-full border rounded px-4 py-2">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input wire:model="email" type="email" class="w-full border rounded px-4 py-2">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Contraseña {{ $user ? '(Dejar en blanco para mantener)' : '' }}</label>
            <input wire:model="password" type="password" class="w-full border rounded px-4 py-2">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Rol</label>
            <select wire:model="role" class="w-full border rounded px-4 py-2">
                @foreach($roles as $roleOption)
                    <option value="{{ $roleOption->slug }}">{{ $roleOption->name }}</option>
                @endforeach
            </select>
            @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
        <a href="{{ route('admin.users.index') }}" class="ml-2 text-gray-600">Cancelar</a>
    </form>
</div>