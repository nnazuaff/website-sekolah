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
                ->when($this->search, fn ($query) =>
                    $query->where('name', 'like', '%' . $this->search . '%')
                )
                ->paginate(8),
        ];
    }
};
?>

<div>
    {{-- ================= TOOLBAR ================= --}}
    <div class="toolbar">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            class="search-input"
            placeholder="Cari guru..."
        >

        <div class="stat-card">
            <div>
                <div class="stat-label">Total Guru Aktif</div>
                <div class="stat-value">{{ $teachers->total() }}</div>
            </div>
        </div>
    </div>

    {{-- ================= GRID ================= --}}
    <div class="teachers-grid" wire:loading.class="opacity-50">

        @forelse ($teachers as $teacher)
            <div class="teacher-card" wire:key="teacher-{{ $teacher->id }}">
                <span class="badge-active">Aktif</span>

                <h3>{{ $teacher->name }}</h3>
                <p class="position">{{ $teacher->position }}</p>

                <div class="card-top">
                    @if ($teacher->photo)
                        <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="teacher-photo">
                    @else
                        <div class="no-photo">{{ strtoupper(substr($teacher->name, 0, 1)) }}</div>
                    @endif

                    @if ($teacher->description)
                        <p class="desc-preview">{{ $teacher->description }}</p>
                    @endif
                </div>

                <div class="meta-line">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><line x1="7" y1="9" x2="17" y2="9"/><line x1="7" y1="13" x2="13" y2="13"/></svg>
                    NIP. {{ $teacher->nip }}
                </div>

                <div class="meta-line">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                    {{ $teacher->subject }}
                </div>
            </div>

        @empty

            <div class="empty-state">Belum ada guru yang cocok dengan pencarian.</div>

        @endforelse

    </div>

    {{-- ================= PAGINATION ================= --}}
    <div class="pagination-wrap">
        {{ $teachers->links() }}
    </div>
</div>