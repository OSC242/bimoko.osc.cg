@extends('_layouts.master')

@push('meta')
    <meta property="og:title" content="Contact {{ $page->siteName }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $page->getUrl() }}"/>
    <meta property="og:description" content="Contactez-nous – {{ $page->siteName }}" />
@endpush

@section('body')
<h1>Contactez-nous</h1>

<p class="mb-8">
    Que vous ayez des questions à nous poser, un mot d’encouragement, ou des suggestions à nous faire, n’hésitez pas à utiliser le formulaire ci-dessous.
</p>

<form id="contact-form" action="{{ $page->contactFormEndpoint }}" method="POST" class="mb-12">
    <input type="hidden" name="_language" value="fr">

    <div class="flex flex-wrap mb-6 -mx-3">
        <div class="w-full md:w-1/2 mb-6 md:mb-0 px-3">
            <label class="block mb-2 text-gray-800 text-sm font-semibold" for="contact-name">
                Comment vous appelez-vous?
            </label>

            <input
                type="text"
                id="contact-name"
                placeholder="Jane Doe"
                name="name"
                class="block w-full border shadow rounded-lg outline-none mb-2 px-4 py-3"
                required
            >
        </div>

        <div class="w-full px-3 md:w-1/2">
            <label class="block text-gray-800 text-sm font-semibold mb-2" for="contact-email">
                Adresse e-mail
            </label>

            <input
                type="email"
                id="contact-email"
                placeholder="email@domain.com"
                name="_replyto"
                class="block w-full border shadow rounded-lg outline-none mb-2 px-4 py-3"
                required
            >
        </div>
    </div>

    <div class="w-full mb-12">
        <label class="block text-gray-800 text-sm font-semibold mb-2" for="contact-message">
            Message
        </label>

        <textarea
            id="contact-message"
            rows="4"
            name="message"
            class="block w-full border shadow rounded-lg outline-none appearance-none mb-2 px-4 py-3"
            required
        ></textarea>
    </div>

    <div class="flex justify-end w-full">
        <button
            type="button"
            class="block bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold leading-snug tracking-wide uppercase shadow rounded-lg cursor-pointer px-6 py-3 g-recaptcha"
            data-sitekey="6LeuxfEUAAAAALCvX2_cMlUbwURFBM_ZLwUfWyrq"
            data-callback="recaptchaCallback"
            data-expired-callback="recaptchaExpiredCallback"
            data-error-callback="recaptchaErrorCallback"
        >
            Envoyer
        </button>

        <div id="form-success" class="hidden w-full bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center" role="alert">
            <strong class="font-bold">Merci!</strong>
            <span class="block sm:inline">Le formulaire a bien été envoyé</span>
        </div>
    </div>
</form>
@stop

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function recaptchaCallback(token) {
            let form = document.getElementById('contact-form'),
                formSuccess = document.getElementById('form-success'),
                formData = {},
                btn = form.getElementsByClassName('g-recaptcha')[0];

            btn.classList.add('opacity-50');
            btn.classList.add('cursor-not-allowed');
            btn.classList.remove('hover:bg-blue-600');
            btn.setAttribute('disabled', 'disabled');
            btn.innerText = 'En cours…';

            for (let i=0, len=form.length-1; i<len; ++i) {
                formData[form[i].name] = form[i].value;
            }

            axios.post(form.getAttribute('action'), formData)
                 .then(function (response) {
                    btn.remove();
                    formSuccess.classList.remove('hidden');
                 })
                 .catch(function (error) {
                    recaptchaErrorCallback();
                 });
        }

        function recaptchaErrorCallback(token) {
            let form = document.getElementById('contact-form'),
                btn = form.getElementsByClassName('g-recaptcha')[0];

            btn.classList.remove('opacity-50');
            btn.classList.remove('cursor-not-allowed');
            btn.classList.add('hover:bg-blue-600');
            btn.removeAttribute('disabled');
            btn.innerText = 'Envoyer';
        }

        function recaptchaExpiredCallback() {
            recaptchaErrorCallback();
        }
    </script>
@endpush
