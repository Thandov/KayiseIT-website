<div class="bg-white rounded-2xl p-6 md:p-8 border border-[#d5dde8]"
     x-data="{
        step: 0,
        answers: [],
        questions: [
            { q: 'What do you enjoy most?', options: [
                { label: 'Building apps & websites', tag: 'build' },
                { label: 'Solving technical problems', tag: 'solve' },
                { label: 'Protecting systems from hackers', tag: 'protect' },
                { label: 'Leading teams & projects', tag: 'lead' },
            ]},
            { q: 'Which school subjects did you like?', options: [
                { label: 'Maths & IT', tag: 'solve' },
                { label: 'Art & Design', tag: 'creative' },
                { label: 'Business Studies', tag: 'organize' },
                { label: 'Working with people', tag: 'people' },
            ]},
            { q: 'How do you like to work?', options: [
                { label: 'On my own, deep focus', tag: 'build' },
                { label: 'In a team', tag: 'lead' },
                { label: 'Helping customers', tag: 'people' },
                { label: 'Mix of everything', tag: 'solve' },
            ]},
            { q: 'What matters most to you?', options: [
                { label: 'High salary potential', tag: 'solve' },
                { label: 'Creative freedom', tag: 'creative' },
                { label: 'Job security', tag: 'protect' },
                { label: 'Making a difference', tag: 'people' },
            ]},
        ],
        pick(tag) {
            this.answers[this.step] = tag;
            if (this.step < this.questions.length - 1) {
                this.step++;
            } else {
                this.applyFilter();
            }
        },
        applyFilter() {
            const scores = {};
            this.answers.forEach(t => { scores[t] = (scores[t] || 0) + 1; });
            const top = Object.keys(scores).sort((a,b) => scores[b] - scores[a])[0] || '';
            document.querySelectorAll('[data-career-tags]').forEach(el => {
                const tags = (el.getAttribute('data-career-tags') || '').split(',');
                el.classList.toggle('ring-4', top && tags.includes(top));
                el.classList.toggle('ring-kg-700', top && tags.includes(top));
                el.classList.toggle('opacity-40', top && !tags.includes(top));
            });
            this.step = 'done';
        },
        reset() {
            this.step = 0;
            this.answers = [];
            document.querySelectorAll('[data-career-tags]').forEach(el => {
                el.classList.remove('ring-4', 'ring-kg-700', 'opacity-40');
            });
        }
     }">
    <h2 class="text-2xl font-bold text-kb-700 mb-2">Find your fit</h2>
    <p class="text-gray-600 text-sm mb-6">Answer 4 quick questions — we'll highlight careers that match you.</p>

    <template x-if="step !== 'done'">
        <div>
            <p class="text-sm text-kb-100 font-semibold mb-1" x-text="'Question ' + (step + 1) + ' of ' + questions.length"></p>
            <p class="text-lg font-bold text-kb-700 mb-4" x-text="questions[step].q"></p>
            <div class="grid gap-3 sm:grid-cols-2">
                <template x-for="opt in questions[step].options" :key="opt.tag">
                    <button type="button"
                            @click="pick(opt.tag)"
                            class="min-h-[44px] text-left px-4 py-3 rounded-xl border-2 border-white bg-white hover:border-kb-100 hover:bg-kb-50 transition font-medium text-kb-700"
                            x-text="opt.label"></button>
                </template>
            </div>
        </div>
    </template>

    <template x-if="step === 'done'">
        <div class="text-center">
            <p class="text-lg font-bold text-kb-700 mb-2">Here are your best matches!</p>
            <p class="text-sm text-gray-600 mb-4">Highlighted cards below fit your answers. Tap any card to see the full path.</p>
            <button type="button" @click="reset()" class="text-sm font-semibold text-kb-100 underline min-h-[44px]">Start over</button>
        </div>
    </template>
</div>
