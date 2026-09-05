<x-app-layout>
  @section('meta')
  @php
  $metaTitle = "About KAYISE IT — Technology delivery & youth development";
  $metaDescription = "KAYISE IT delivers enterprise IT solutions from Nelspruit while developing South African youth through training, internships, and workplace programmes.";
  $metaKeywords = "KAYISE IT, About, Nelspruit, ICT, Software Development, Internships, Youth Development, MICT SETA, Mpumalanga";
  @endphp
  @endsection

  <x-page-header
      title="About KAYISE IT"
      subtitle="Technology delivery and youth development from Mpumalanga"
      hero-id="about-hero-new"
      background-image="images/KayiseIT-Team.jpg"
      height="h-96" />

  @include('_about')

  @if($ceo || $leadership->isNotEmpty() || $interns->isNotEmpty())
  <section class="ki-about-section ki-about-section--muted" id="our-team">
    <div class="container mx-auto px-4 max-w-7xl">
      <div class="ki-about-section-head ki-reveal">
        <span class="ki-kicker">Our people</span>
        <h2 class="ki-about-heading ki-about-heading--center">The team behind the work</h2>
        <p class="ki-about-lead ki-about-lead--center">
          Commercial delivery and skills programmes run by the same people — not as a separate CSR poster.
        </p>
      </div>

      @if($ceo)
      <article class="ki-team-featured ki-reveal">
        <div class="ki-team-featured-photo" aria-hidden="true">
          @if($ceo->photo_url)
            <img src="{{ $ceo->photo_url }}" alt="" loading="lazy">
          @else
            <span>{{ $ceo->initials }}</span>
          @endif
        </div>
        <div class="ki-team-featured-copy">
          <p class="ki-team-featured-label">Leadership</p>
          <h3 class="ki-team-name ki-team-name--lg">{{ $ceo->full_name }}</h3>
          @if($ceo->job_title)
            <p class="ki-team-role">{{ $ceo->job_title }}</p>
          @endif
          <p class="ki-team-featured-bio">
            Leads KAYISE IT’s dual mandate: profitable technology delivery and pathways for young people into ICT work.
          </p>
        </div>
      </article>
      @endif

      @if($leadership->isNotEmpty())
      <div class="ki-team-grid ki-reveal" style="animation-delay: 0.08s">
        @foreach($leadership as $member)
          <article class="ki-team-member">
            <div class="ki-team-photo" aria-hidden="true">
              @if($member->photo_url)
                <img src="{{ $member->photo_url }}" alt="" loading="lazy">
              @else
                {{ $member->initials }}
              @endif
            </div>
            <h3 class="ki-team-name">{{ $member->full_name }}</h3>
            @if($member->job_title)
              <p class="ki-team-role">{{ $member->job_title }}</p>
            @endif
          </article>
        @endforeach
      </div>
      @endif

      @if($interns->isNotEmpty())
      <div class="ki-team-interns ki-reveal" style="animation-delay: 0.14s">
        <h3 class="ki-team-band-title">Interns</h3>
        <div class="ki-team-grid ki-team-grid--compact">
          @foreach($interns as $member)
            <article class="ki-team-member">
              <div class="ki-team-photo" aria-hidden="true">
                @if($member->photo_url)
                  <img src="{{ $member->photo_url }}" alt="" loading="lazy">
                @else
                  {{ $member->initials }}
                @endif
              </div>
              <h3 class="ki-team-name">{{ $member->full_name }}</h3>
              @if($member->job_title)
                <p class="ki-team-role">{{ $member->job_title }}</p>
              @endif
            </article>
          @endforeach
        </div>
      </div>
      @endif
    </div>
  </section>
  @endif

  <section class="ki-about-section" id="vision-mission">
    <div class="container mx-auto px-4 max-w-7xl">
      <div class="ki-about-section-head ki-reveal">
        <span class="ki-kicker">Purpose</span>
        <h2 class="ki-about-heading ki-about-heading--center">What we aim for</h2>
      </div>

      <div class="ki-about-purpose ki-reveal">
        <div class="ki-about-purpose-block">
          <h3 class="ki-about-purpose-title">Vision</h3>
          <p>
            To be South Africa’s leading technology company that achieves exceptional profitability while creating transformative opportunities for youth through business excellence and social impact.
          </p>
        </div>
        <div class="ki-about-purpose-block">
          <h3 class="ki-about-purpose-title">Mission</h3>
          <p>
            To drive profitable business growth through world-class IT solutions while developing South African youth into skilled ICT professionals through comprehensive training and internship programmes.
          </p>
        </div>
      </div>

      <div class="ki-about-values ki-reveal" style="animation-delay: 0.1s">
        <div class="ki-card">
          <span class="ki-card-index">01</span>
          <h4 class="ki-card-title">Profitability</h4>
          <p class="ki-card-body">Financial discipline, measurable ROI, and growth that funds the training work.</p>
        </div>
        <div class="ki-card">
          <span class="ki-card-index">02</span>
          <h4 class="ki-card-title">Youth development</h4>
          <p class="ki-card-body">Training, mentorship, and career pathways for young South Africans entering ICT.</p>
        </div>
        <div class="ki-card">
          <span class="ki-card-index">03</span>
          <h4 class="ki-card-title">Integrated excellence</h4>
          <p class="ki-card-body">Commercial delivery and skills programmes run as one business.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="ki-about-section ki-about-section--dark" id="visual-gallery">
    <div class="container mx-auto px-4 max-w-7xl">
      <div class="ki-about-section-head ki-reveal">
        <span class="ki-kicker ki-kicker--on-dark">In the field</span>
        <h2 class="ki-about-heading ki-about-heading--center ki-about-heading--light">Work, training, and community</h2>
        <p class="ki-about-lead ki-about-lead--center ki-about-lead--muted">
          Moments from programmes, placements, and delivery — not stock art.
        </p>
      </div>

      <div class="ki-about-mosaic ki-reveal">
        @foreach([
          ['images/gallery/internship-2023-2024/318110873_557073029762347_5509873214173641249_n.jpg', 'Team', 'tall'],
          ['images/gallery/internship-2023-2024/319183456_563484435787873_8326613098780373042_n.jpg', 'Training', ''],
          ['images/gallery/internship-2023-2024/330785452_686402603275943_7224705160606685331_n.jpg', 'Workshop', 'wide'],
          ['images/gallery/internship-2023-2024/340140852_1458720341623964_8727235806007319528_n.jpg', 'Event', ''],
          ['images/gallery/internship-2023-2024/340851034_3727464414140331_5502527995688493162_n.jpg', 'Team building', ''],
          ['images/gallery/tvet-placement-2022-2023/306366474_482669353869382_332993973053090666_n.jpg', 'Placement', 'wide'],
        ] as [$src, $alt, $span])
          <figure class="ki-about-mosaic-item {{ $span ? 'ki-about-mosaic-item--'.$span : '' }}">
            <img src="{{ asset($src) }}" alt="KAYISE IT {{ $alt }}" loading="lazy">
          </figure>
        @endforeach
      </div>

      <div class="ki-about-section-cta ki-reveal">
        <a href="{{ route('gallery') }}" class="ki-about-btn ki-about-btn--on-dark">Open the gallery</a>
      </div>
    </div>
  </section>

  <section class="ki-about-section" id="our-partners">
    <div class="container mx-auto px-4 max-w-7xl">
      <div class="ki-about-section-head ki-reveal">
        <span class="ki-kicker">Partners</span>
        <h2 class="ki-about-heading ki-about-heading--center">Who we build with</h2>
        <p class="ki-about-lead ki-about-lead--center">
          Education, skills, and industry partners that make programmes and placements possible.
        </p>
      </div>

      @if($partners->isNotEmpty())
        <div class="ki-about-partners ki-reveal">
          @foreach($partners as $dbPartner)
            @php
              $pLogoUrl = $dbPartner->logo_path;
              if ($pLogoUrl && str_starts_with($pLogoUrl, 'partners/')) {
                  $pLogoUrl = 'images/partners/' . basename($pLogoUrl);
              }
            @endphp
            <article class="ki-about-partner">
              @if($pLogoUrl)
                <img src="{{ asset($pLogoUrl) }}" alt="{{ $dbPartner->name }}" loading="lazy">
              @endif
              <h3>{{ $dbPartner->name }}</h3>
              @if($dbPartner->description)
                <p>{{ $dbPartner->description }}</p>
              @endif
            </article>
          @endforeach
        </div>
      @else
        <div class="ki-about-partners ki-reveal">
          @foreach([
            ['images/partners/mict.png', 'MICT SETA', 'Media, Information and Communication Technologies SETA'],
            ['images/partners/Ehlanzeni.png', 'Ehlanzeni TVET College', 'TVET partner for skills development'],
            ['images/partners/tarsus.png', 'Tarsus on Demand', 'Technology distribution and solutions'],
            ['images/partners/scg.png', 'SCG South Africa', 'Strategic technology partner'],
          ] as [$logo, $name, $desc])
            <article class="ki-about-partner">
              <img src="{{ asset($logo) }}" alt="{{ $name }}" loading="lazy">
              <h3>{{ $name }}</h3>
              <p>{{ $desc }}</p>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  <section class="ki-about-cta-band">
    <div class="container mx-auto px-4 max-w-7xl ki-reveal">
      <h2 class="ki-about-heading ki-about-heading--light">Ready to work with us?</h2>
      <p class="ki-about-lead ki-about-lead--muted">
        Whether you need IT delivery, a training partnership, or a place on a programme — start a conversation.
      </p>
      <div class="ki-about-actions ki-about-actions--center">
        <a href="{{ route('contact') }}" class="ki-about-btn ki-about-btn--primary">Contact KAYISE IT</a>
        <a href="{{ route('opportunities') }}" class="ki-about-btn ki-about-btn--on-dark">See opportunities</a>
      </div>
    </div>
  </section>
</x-app-layout>
