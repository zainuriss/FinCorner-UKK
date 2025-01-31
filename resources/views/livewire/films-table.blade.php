<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between mb-4">        
        <select wire:model="perPage" class="border p-2 rounded w-1/12 bg-neutral-100 text-current">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>

        <input type="text" wire:model="search" placeholder="Cari..." 
            class="border p-2 rounded w-1/3 bg-current" />
    </div>
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-white uppercase bg-[#0369A1]">
            <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">Title</th>
                <th scope="col" class="px-6 py-3">Release Year</th>
                <th scope="col" class="px-6 py-3">Creator</th>
                <th scope="col" class="px-6 py-3">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($films as $key => $f)
            <tr class="bg-white border-b hover:bg-blue-100">
                <td class="px-6 py-4">{{ ($films->currentPage() - 1) * $films->perPage() + $loop->iteration }}</td>
                <td class="px-6 py-4">{{ $f->title }}</td>
                <td class="px-6 py-4">{{ $f->release_year }}</td>
                <td class="px-6 py-4">{{ $f->creator }}</td>
                <td class="px-6 py-4">
                    Delete
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
