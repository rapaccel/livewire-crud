<div>
    <h1 class="text-2xl font-bold mb-4">Users</h1>

    <livewire:components.table.data-table :model="\App\Models\User::class" :columns="['id', 'name', 'role', 'email']" />
</div>
