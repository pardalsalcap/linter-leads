<div>
    @if ($success)
        <p class="my-8 bg-green-600 p-4 text-white">{{ __("linter-leads::form.success_saving_lead") }}</p>

        <button
            class="bg-black inline-block text-white py-2 pl-4 font-fig font-semibold uppercase border border-black hover:bg-transparent hover:text-black"
            type="button" wire:click="clear">
            {{ __("linter-leads::form.send_another_message") }}
            <svg class="h-5 w-5 inline-block mx-4">
                <use xlink:href="/images/sprite.svg#arrow_right"></use>
            </svg>
        </button>

    @else
        <form wire:submit="submit()" class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="">
                <label for="name" class="hidden">{{ __("linter-leads::form.contact_name_field") }}</label>
                <input maxlength="255" minlength="3" required wire:model="name" type="text" name="name" id="name"
                       autocomplete="autocomplete"
                       class="ring-0 outline-none focus:border-black placeholder:uppercase placeholder:text-black bg-transparent w-full border-b border-main-gray py-2"
                       placeholder="{{ __("linter-leads::form.contact_name_field") }}"/>
                @error('name') <span class="block text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="">
                <label for="company" class="hidden">{{ __("linter-leads::form.contact_company_field") }}</label>
                <input maxlength="255" minlength="3" required wire:model="company" type="text" name="company"
                       id="company" autocomplete="autocomplete"
                       class="ring-0 outline-none focus:border-black placeholder:uppercase placeholder:text-black bg-transparent w-full border-b border-main-gray py-2"
                       placeholder="{{ __("linter-leads::form.contact_company_field") }}"/>
                @error('company') <span class="block text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="">
                <label for="email" class="hidden">{{ __("linter-leads::form.contact_email_field") }}</label>
                <input maxlength="255" minlength="3" required wire:model="email" type="email" name="email" id="email"
                       autocomplete="autocomplete"
                       class="ring-0 outline-none focus:border-black placeholder:uppercase placeholder:text-black bg-transparent w-full border-b border-main-gray py-2"
                       placeholder="{{ __("linter-leads::form.contact_email_field") }}"/>
                @error('email') <span class="block text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="">
                <label for="phone" class="hidden">{{ __("linter-leads::form.contact_phone_field") }}</label>
                <input maxlength="255" minlength="3" required wire:model="phone" type="text" name="phone" id="phone"
                       autocomplete="autocomplete"
                       class="ring-0 outline-none focus:border-black placeholder:uppercase placeholder:text-black bg-transparent w-full border-b border-main-gray py-2"
                       placeholder="{{ __("linter-leads::form.contact_phone_field") }}"/>
                @error('phone') <span class="block text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="">
                <label for="city" class="hidden">{{ __("linter-leads::form.contact_city_field") }}</label>
                <input maxlength="255" minlength="3" required wire:model="city" type="text" name="city" id="city"
                       autocomplete="autocomplete"
                       class="ring-0 outline-none focus:border-black placeholder:uppercase placeholder:text-black bg-transparent w-full border-b border-main-gray py-2"
                       placeholder="{{ __("linter-leads::form.contact_city_field") }}"/>
                @error('city') <span class="block text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="message" class="hidden">{{ __("linter-leads::form.contact_message_field") }}</label>
                <textarea minlength="3" required wire:model="message" name="message" id="message"
                          class="ring-0 outline-none focus:border-black placeholder:uppercase placeholder:text-black bg-transparent w-full border-b border-main-gray py-2"
                          placeholder="{{ __("linter-leads::form.contact_message_field") }}"></textarea>
                @error('message') <span class="block text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="policy">
                    <input class="bg-transparent" type="checkbox" name="policy" id="policy" wire:model="policy"/>
                    {{ __("linter-leads::form.contact_policy") }}
                </label>
                @error('policy') <span class="block text-red-600">{{ $message }}</span> @enderror
            </div>


            <div class="md:col-span-2">
                <button
                    class="bg-black inline-block text-white py-2 pl-4 font-fig font-semibold uppercase border border-black hover:bg-transparent hover:text-black"
                    type="submit">
                    {{ __("linter-leads::form.contact_submit") }}
                    <svg class="h-5 w-5 inline-block mx-4">
                        <use xlink:href="/images/sprite.svg#arrow_right"></use>
                    </svg>
                </button>
            </div>
        </form>
    @endif
</div>
