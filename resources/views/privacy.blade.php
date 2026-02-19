@extends('layouts.app')

@section('title', 'Privacy Policy & Legal Information - HiveNarratives')
@section('meta-description', 'Read HiveNarratives Privacy Policy, Terms & Conditions, Refund Policy, Services Policy, and Local Contact Information.')
@section('meta-keywords', 'privacy policy, terms and conditions, refund policy, services policy, HiveNarratives')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10 text-gray-800 leading-relaxed">

    <h1 class="text-4xl font-bold text-purple-700 mb-6">Privacy Policy & Legal Information</h1>

    <p class="mb-4">
        HiveNarratives is a digital content publishing platform that allows users to submit and publish articles
        through various paid packages. This page explains our policies, user responsibilities,
        refund conditions, and legal information in a clear and transparent manner.
    </p>

    <!-- 1. TERMS & CONDITIONS -->
    <h2 class="text-2xl font-semibold mt-8 mb-2 text-purple-600">1. Terms & Conditions</h2>

    <p class="mb-4">
        By accessing or using HiveNarratives, you agree to comply with these Terms & Conditions.
        If you do not agree with any part of these terms, you must discontinue using our services.
    </p>

    <p class="mb-4">
        Users must not misuse the platform, attempt unauthorized access,
        or engage in any unlawful or harmful activities.
    </p>

    <p class="mb-4">
        HiveNarratives reserves the right to modify, suspend, or terminate services or user accounts
        that violate platform rules without prior notice.
    </p>

    <!-- 2. SERVICES POLICY -->
    <h2 class="text-2xl font-semibold mt-8 mb-2 text-purple-600">2. Services Policy</h2>

    <p class="mb-4">
        HiveNarratives provides digital article publishing and content promotion services.
        Users may choose from different packages that allow them to publish articles
        according to the selected plan.
    </p>

    <p class="mb-4">
        All services are digital in nature. No physical goods are sold or delivered.
        Once an article is successfully published, the service is considered completed.
    </p>

    <!-- 3. REFUND & RETURN POLICY -->
    <h2 class="text-2xl font-semibold mt-8 mb-2 text-purple-600">3. Refund & Return Policy</h2>

    <p class="mb-4">
        Due to the digital nature of our services, refunds are only applicable under limited conditions.
    </p>

    <p class="mb-4">
        A refund may be issued if a user experiences repeated technical issues
        that prevent their article from being published after successful payment,
        and the issue cannot be resolved by our technical support team.
    </p>

    <ul class="list-disc list-inside mb-4 space-y-1">
        <li>Continuous platform errors during article submission</li>
        <li>Paid service not delivered due to system malfunction</li>
    </ul>

    <p class="mb-4">
        Refunds are <strong>not applicable</strong> if:
    </p>

    <ul class="list-disc list-inside mb-4 space-y-1">
        <li>The article has been successfully published</li>
        <li>The selected package has been fully used</li>
        <li>The issue is related to content quality, guideline violations, or user error</li>
    </ul>

    <p class="mb-4">
        Once an article is published, no refund will be issued under any circumstances.
    </p>

    <!-- 4. PRIVACY POLICY -->
    <h2 class="text-2xl font-semibold mt-8 mb-2 text-purple-600">4. Privacy Policy</h2>

    <p class="mb-4">
        HiveNarratives respects user privacy and is committed to protecting personal information.
        We collect only the information necessary to provide our services.
    </p>

    <ul class="list-disc list-inside mb-4 space-y-1">
        <li>Name and email address</li>
        <li>Article content submitted for publishing</li>
        <li>Payment confirmation details</li>
        <li>Basic technical data for security and performance</li>
    </ul>

    <p class="mb-4">
        We do not sell, rent, or share user data with unauthorized third parties.
        Payment processing is handled securely by trusted third-party payment gateways.
    </p>

    <!-- CONTENT RESTRICTIONS -->
    <h3 class="text-xl font-semibold mt-6 mb-2 text-purple-600">Content Restrictions</h3>

    <p class="mb-4">
        Users are strictly prohibited from submitting or promoting content that includes:
    </p>

    <ul class="list-disc list-inside mb-4 space-y-1">
        <li>Sexual, adult, or pornographic material</li>
        <li>Alcohol, drugs, gambling, or illegal products</li>
        <li>Hate speech, violence, or extremist content</li>
        <li>Scam, misleading, or harmful promotions</li>
        <li>Links to malicious or low-quality websites</li>
    </ul>

    <p class="mb-4">
        Any violation may result in content removal, account suspension,
        or permanent termination without refund.
    </p>

    <!-- 5. LOCAL CONTACT & ADDRESS -->
    <h2 class="text-2xl font-semibold mt-8 mb-2 text-purple-600">5. Local Contact & Address</h2>

    <p class="mb-4">
        Users may contact us for support, technical issues, or refund requests using the details below.
    </p>

    <p class="mb-4">
        <strong>Pakistan Office:</strong><br>
        Chak Chatha 357 GB<br>
        Tehsil Gojra<br>
        District Toba Tek Singh<br>
        Punjab, Pakistan
    </p>

    <p class="mb-4">
        <strong>Lahore Office:</strong><br>
        Shadman Area<br>
        Lahore, Punjab<br>
        Pakistan
    </p>

    <p class="mb-4">
        Email:
        <a href="mailto:mail@hivenarratives.com" class="text-purple-600 underline">
            mail@hivenarratives.com
        </a>
    </p>

    <p class="mb-4">
        <!-- WhatsApp CTA -->
        <div class="mt-6">
            <a href="https://wa.me/923211417347?text=Hi! I'm interested in a custom project. Can we discuss my requirements?" 
               target="_blank" 
               class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-full text-lg transition-colors inline-flex items-center mx-auto">
                <i class="fab fa-whatsapp mr-2 text-xl"></i> Chat on WhatsApp
            </a>
        </div>
    </p>

</div>
@endsection
