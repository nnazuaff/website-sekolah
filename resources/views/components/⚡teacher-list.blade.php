<?php

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function with(): array
    {
        return [
            'teachers' => Teacher::query()
                ->where('is_active', true)
                ->when($this->search, fn ($query) => $query->where('name', 'like', '%'.$this->search.'%')
                )
                ->paginate(8),
        ];
    }
};
?>

<div>
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            class="w-full rounded-sm border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand-700 focus:ring-2 focus:ring-brand-100 sm:flex-1"
            placeholder="Cari guru..."
            aria-label="Cari guru"
        >

        <div class="rounded-sm border border-slate-200 bg-white px-5 py-3 text-center sm:min-w-44">
            <div class="text-xs font-bold uppercase tracking-wide text-slate-500">Total guru aktif</div>
            <div class="text-xl font-extrabold text-brand-950">{{ $teachers->total() }}</div>
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" wire:loading.class="opacity-50">
        @forelse ($teachers as $teacher)
            <div class="site-card relative p-6 transition hover:border-blue-300">
                <span class="absolute right-5 top-5 rounded-sm bg-brand-50 px-3 py-1 text-xs font-bold text-brand-700">
                    Aktif
                </span>

                <div class="flex items-start gap-4">
                    @if ($teacher->photo)
                        <img
                            src="{{ asset('storage/' . $teacher->photo) }}"
                            alt="Foto {{ $teacher->name }}"
                            class="h-20 w-20 shrink-0 rounded-md object-cover"
                        >
                    @else
                        <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-md bg-brand-50 text-2xl font-bold text-brand-700">
                            {{ strtoupper(substr($teacher->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="min-w-0 pt-1">
                        <h2 class="pr-14 text-lg font-extrabold text-brand-950">{{ $teacher->name }}</h2>
                        <p class="mt-1 text-sm font-semibold text-brand-700">{{ $teacher->position }}</p>
                    </div>
                </div>

                @if ($teacher->description)
                    <p class="mt-5 line-clamp-3 text-sm leading-6 text-slate-600">{{ $teacher->description }}</p>
                @endif

                <dl class="mt-5 space-y-3 border-t border-slate-100 pt-4 text-sm text-slate-600">
                    <div class="flex gap-2">
                        <dt class="font-bold text-brand-950">NIP:</dt>
                        <dd class="break-all">{{ $teacher->nip }}</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="font-bold text-brand-950">Mata pelajaran:</dt>
                        <dd>{{ $teacher->subject }}</dd>
                    </div>
                </dl>
            </div>
        @empty
            <div class="site-empty col-span-full">
                <div class="site-empty-mark" aria-hidden="true">—</div>
                <h2>Belum ada guru yang ditampilkan</h2>
                <p>Belum ada guru yang cocok dengan pencarian.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $teachers->links() }}
    </div>
</div>