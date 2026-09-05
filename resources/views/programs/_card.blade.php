@props(['program', 'mode' => 'enquire'])

<article class="ki-card">
    <div class="ki-card-meta">
        <h3 class="ki-card-title" style="margin-bottom:0">{{ $program->name }}</h3>
        <span class="ki-badge">{{ $program->program_type }}</span>
    </div>

    <p class="ki-card-body">{{ $program->description }}</p>

    @if($mode === 'enquire')
        <p class="ki-card-note">
            Register your interest and we&rsquo;ll keep you informed as this programme develops.
        </p>
    @else
        <dl class="ki-card-list" style="list-style:none">
            <div class="ki-card-meta" style="margin-bottom:0.35rem">
                <dt>Duration</dt>
                <dd>{{ $program->duration }}</dd>
            </div>
            @if($program->recruitment_end_date)
                <div class="ki-card-meta" style="margin-bottom:0.35rem">
                    <dt>Closes</dt>
                    <dd>{{ $program->recruitment_end_date->format('d M Y') }}</dd>
                </div>
            @endif
            @if($program->number_needed)
                <div class="ki-card-meta" style="margin-bottom:0.35rem">
                    <dt>Places</dt>
                    <dd>{{ $program->number_needed }}</dd>
                </div>
            @endif
        </dl>
    @endif

    @if($mode === 'enquire')
        <button type="button"
                onclick="openProgramRegisterModal({{ $program->id }})"
                class="ki-btn ki-btn-block">
            Register
        </button>
    @else
        <a href="{{ auth()->check()
                ? route('internship_application', ['program' => $program->id])
                : route('registerintern', ['program' => $program->id]) }}"
           class="ki-btn ki-btn-block">
            Apply now
        </a>
    @endif
</article>
