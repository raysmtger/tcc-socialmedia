<div class="container my-5">
    @if ($ideas->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-lightbulb display-1 text-muted mb-3"></i>
            <p class="text-muted fs-5 mb-4">Você ainda não criou nenhuma ideia.</p>
        </div>
    @else
        <div class="row g-4 justify-content-center">
            @foreach ($ideas as $idea)
                <x-idea-card :idea="$idea" />
            @endforeach
        </div>
    @endif
</div>
