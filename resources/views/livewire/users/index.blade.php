<div class="p-6 bg-white border-b border-gray-200">
    <div class="flex justify-between mb-4">
        <input wire:model.live="search" type="text" placeholder="Buscar usuarios..." class="border rounded px-4 py-2">
        <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Crear Usuario</a>
    </div>

    <table class="min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Roles</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">
                        @foreach($user->roles as $role)
                            <span class="bg-gray-200 rounded px-2 py-1 text-sm">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="border px-4 py-2">
                        @if($user->trashed())
                            <span class="text-red-500">Inactivo</span>
                        @else
                            <span class="text-green-500">Activo</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.users.edit', $user) }}"
                            class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">Editar</a>
                        @if($user->trashed())
                            <button wire:click="restore({{ $user->id }})"
                                class="bg-green-500 text-white px-2 py-1 rounded text-sm">Activar</button>
                        @else
                            <button wire:click="delete({{ $user->id }})"
                                class="bg-red-500 text-white px-2 py-1 rounded text-sm">Desactivar</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>