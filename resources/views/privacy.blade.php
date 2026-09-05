<x-app-layout>
    <!-- Meta tags -->
    @section('meta')
    @php
    $metaTitle = "Privacy Policy (POPIA) | KAYISE IT";
    $metaDescription = "How KAYISE IT collects, uses, protects and shares your personal information in terms of the Protection of Personal Information Act 4 of 2013 (POPIA).";
    $metaKeywords = "Privacy Policy, POPIA, Protection of Personal Information Act, Data Protection, KAYISE IT, South Africa";
    @endphp
    @endsection

    <div class="bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            {{-- Header --}}
            <div class="mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900">Privacy Policy</h1>
                <p class="mt-3 text-slate-600">
                    This Privacy Policy explains how KAYISE IT collects, uses, stores, protects and shares your
                    personal information in accordance with the Protection of Personal Information Act 4 of 2013
                    (<span class="font-semibold">POPIA</span>) of South Africa.
                </p>
                <p class="mt-2 text-sm text-slate-500">Last updated: {{ date('j F Y') }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-10 space-y-10">

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">1. Who we are</h2>
                    <p class="text-slate-700 leading-relaxed">
                        KAYISE IT (registration number 2015/184122/07) is an Information Technology company based in
                        South Africa, providing software and web development, IT consulting, drone training and 4IR
                        skills training. For the purposes of POPIA, KAYISE IT is the
                        <span class="font-semibold">"responsible party"</span> that determines why and how your
                        personal information is processed.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">2. Personal information we collect</h2>
                    <p class="text-slate-700 leading-relaxed mb-3">
                        Depending on how you interact with us, we may collect the following personal information:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-slate-700">
                        <li><span class="font-semibold">Identity and contact details</span> &mdash; name, surname, ID number (where required, e.g. training enrolment or drone registration), email address, phone number and physical address.</li>
                        <li><span class="font-semibold">Account information</span> &mdash; login credentials and profile details when you register on our website.</li>
                        <li><span class="font-semibold">Education and career information</span> &mdash; qualifications, CVs and related details when you apply for internships, training programmes or opportunities.</li>
                        <li><span class="font-semibold">Payment information</span> &mdash; billing details for services purchased. Card details are processed by our payment gateway (DPO PayGate) and are <span class="font-semibold">not stored on our website</span>.</li>
                        <li><span class="font-semibold">Communications</span> &mdash; messages you send us via contact forms, email, WhatsApp or our website chatbot.</li>
                        <li><span class="font-semibold">Technical information</span> &mdash; IP address, browser type, device information and website usage data collected through cookies and analytics tools.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">3. How and why we use your information</h2>
                    <p class="text-slate-700 leading-relaxed mb-3">
                        We process personal information only for lawful purposes, including to:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-slate-700">
                        <li>Provide and manage our services, training programmes and internships;</li>
                        <li>Process orders, invoices and payments;</li>
                        <li>Respond to enquiries and provide customer support;</li>
                        <li>Register learners for accredited training and issue certificates;</li>
                        <li>Comply with legal and regulatory obligations (e.g. tax, SACAA drone regulations, SETA requirements);</li>
                        <li>Improve our website, services and user experience;</li>
                        <li>Send you service updates or marketing communications, where you have consented or where otherwise permitted by POPIA. You may opt out at any time.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">4. Lawful basis for processing</h2>
                    <p class="text-slate-700 leading-relaxed">
                        We rely on one or more of the following justifications under POPIA: your consent; the
                        conclusion or performance of a contract with you; compliance with a legal obligation; or the
                        pursuit of our legitimate interests, provided those interests do not override your rights.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">5. Sharing of personal information</h2>
                    <p class="text-slate-700 leading-relaxed mb-3">
                        We do not sell your personal information. We only share it with:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-slate-700">
                        <li><span class="font-semibold">Service providers (operators)</span> who process information on our behalf, such as hosting providers, payment processors (DPO PayGate) and analytics providers (Google Analytics), under appropriate confidentiality and security obligations;</li>
                        <li><span class="font-semibold">Training and accreditation bodies</span> where required to register learners or issue certification;</li>
                        <li><span class="font-semibold">Regulators and authorities</span> where disclosure is required by law.</li>
                    </ul>
                    <p class="text-slate-700 leading-relaxed mt-3">
                        Where personal information is transferred outside South Africa (for example, to cloud service
                        providers), we ensure the recipient is subject to a law, binding corporate rules or an
                        agreement providing an adequate level of protection as required by section 72 of POPIA.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">6. Cookies and analytics</h2>
                    <p class="text-slate-700 leading-relaxed">
                        Our website uses cookies and similar technologies, including Google Analytics and Google
                        reCAPTCHA, to keep the site secure, understand how visitors use it and improve our content.
                        You can control or delete cookies through your browser settings; some site features may not
                        function properly if cookies are disabled.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">7. Security safeguards</h2>
                    <p class="text-slate-700 leading-relaxed">
                        In line with section 19 of POPIA, we take appropriate, reasonable technical and organisational
                        measures to protect personal information against loss, damage, unauthorised destruction and
                        unlawful access. These include encrypted connections (SSL/TLS), access controls and secure
                        payment processing. Should a data breach occur that compromises your personal information, we
                        will notify the Information Regulator and affected data subjects as required by section 22 of
                        POPIA.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">8. Retention of information</h2>
                    <p class="text-slate-700 leading-relaxed">
                        We retain personal information only for as long as necessary to fulfil the purposes for which
                        it was collected, or as required by law (for example, financial records retained for tax
                        purposes, or training records retained for accreditation requirements). Thereafter it is
                        securely deleted, destroyed or de-identified.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">9. Your rights as a data subject</h2>
                    <p class="text-slate-700 leading-relaxed mb-3">Under POPIA, you have the right to:</p>
                    <ul class="list-disc pl-6 space-y-2 text-slate-700">
                        <li>Be notified when your personal information is collected or has been accessed unlawfully;</li>
                        <li>Request access to the personal information we hold about you;</li>
                        <li>Request correction or deletion of inaccurate, irrelevant, excessive, outdated or unlawfully obtained information;</li>
                        <li>Object to the processing of your personal information;</li>
                        <li>Object to direct marketing and withdraw consent at any time;</li>
                        <li>Not be subject to a decision based solely on automated processing;</li>
                        <li>Lodge a complaint with the Information Regulator.</li>
                    </ul>
                    <p class="text-slate-700 leading-relaxed mt-3">
                        To exercise any of these rights, contact our Information Officer using the details below.
                        Requests for access to records may also be made in terms of the Promotion of Access to
                        Information Act 2 of 2000 (PAIA).
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">10. Information Officer and contact details</h2>
                    <div class="text-slate-700 leading-relaxed space-y-1">
                        <p><span class="font-semibold">Information Officer:</span> Thando Hlophe</p>
                        <p><span class="font-semibold">Company:</span> KAYISE IT (Reg. No. 2015/184122/07)</p>
                        <p><span class="font-semibold">Address:</span> 39B Brown Street, Mbombela, 1201, South Africa</p>
                        <p><span class="font-semibold">Email:</span> <a href="mailto:info@kayiseit.co.za" class="text-blue-600 hover:underline">info@kayiseit.co.za</a></p>
                        <p><span class="font-semibold">Telephone:</span> <a href="tel:+27877022625" class="text-blue-600 hover:underline">+27 87 702 2625</a></p>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">11. The Information Regulator</h2>
                    <p class="text-slate-700 leading-relaxed">
                        If you believe we have processed your personal information unlawfully, you may lodge a
                        complaint with the Information Regulator (South Africa):
                    </p>
                    <div class="text-slate-700 leading-relaxed mt-3 space-y-1">
                        <p><span class="font-semibold">Address:</span> JD House, 27 Stiemens Street, Braamfontein, Johannesburg, 2001</p>
                        <p><span class="font-semibold">Email:</span> <a href="mailto:POPIAComplaints@inforegulator.org.za" class="text-blue-600 hover:underline">POPIAComplaints@inforegulator.org.za</a></p>
                        <p><span class="font-semibold">Website:</span> <a href="https://inforegulator.org.za" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">inforegulator.org.za</a></p>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">12. Changes to this policy</h2>
                    <p class="text-slate-700 leading-relaxed">
                        We may update this Privacy Policy from time to time. The latest version will always be
                        published on this page with the date of the last update. Please also see our
                        <a href="{{ route('terms') }}" class="text-blue-600 hover:underline">Terms &amp; Conditions</a>.
                    </p>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
