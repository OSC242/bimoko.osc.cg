<div class="flex justify-center lg:-mx-12 my-12 p-6 md:px-12 bg-gray-200 border border-gray-400 text-sm md:rounded shadow">
    <!-- Begin Mailchimp Signup Form -->
    <div id="mc_embed_signup">
        <form action="{{ $page->mailchimp->action }}" method="POST" class="validate" target="_blank" autocomplete="on" {{-- novalidate --}}>
            <input type="hidden" name="u" value="{{ $page->mailchimp->userId }}">
            <input type="hidden" name="id" value="{{ $page->mailchimp->listId }}">
            <div id="mc_embed_signup_scroll">
                <h2>Inscrivez-vous à notre newsletter</h2>
                <div class="mc-field-group">
                    <label for="mce-EMAIL">Adresse e-mail</label>
                    <input type="email" name="MERGE0" class="required email" id="mce-EMAIL" placeholder="Adresse e-mail" autocomplete="email" required>
                </div>

                <!-- Real people should not fill this in and expect good things - do not remove this or risk form bot signups -->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_25582686a9fc051afd5453557_189578c854" tabindex="-1" value=""></div>
                <div class="clear"><input type="submit" value="S’inscrire" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
        </form>
    </div>
    <!--End Mailchimp Signup Form -->
</div>
