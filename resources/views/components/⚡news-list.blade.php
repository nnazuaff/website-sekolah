<?php

use App\Models\News;
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
            'news' => News::query()
                ->where('status', 'published')
                ->when($this->search, fn ($query) =>
                    $query->where('title', 'like', '%' . $this->search . '%')
                )
                ->latest('published_at')
                ->paginate(6),
        ];
    }
};
?>

<div>
    <div class="toolbar">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            class="search-input"
            placeholder="Cari berita..."
        >
    </div>

    <div class="news-grid" wire:loading.class="opacity-50">

        @forelse ($news as $item)
            <div class="news-card" wire:key="news-{{ $item->id }}">
                @if ($item->thumbnail)
                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="news-thumb">
                @else
                    <div class="news-thumb news-thumb-empty"></div>
                @endif

                <div class="news-body">
                    <p class="news-date">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ optional($item->published_at)->translatedFormat('d F Y') }}
                    </p>

                    <h3>{{ $item->title }}</h3>
                    <p class="news-excerpt">{{ $item->excerpt }}</p>

                    <a href="{{ route('news.show', $item->slug) }}" class="news-link">
                        Baca selengkapnya
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </div>

        @empty

            <div class="empty-state">Belum ada berita.</div>

        @endforelse

    </div>

    <div class="pagination-wrap">
        {{ $news->links() }}
    </div>
</div>