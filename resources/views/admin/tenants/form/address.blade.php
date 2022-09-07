<aside>
    @includeIf('admin.tenants.form.tabs')
    <div class="mx-auto max-w-7xl py-6">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            @includeWhen($errors->isNotEmpty() || session('success'), 'admin.layouts.flash')
            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6">
                        @includeIf('admin.components.form.textarea', [
                            'fieldname' => 'address[street]',
                            'label' => 'Street address',
                            'autocomplete' => 'street',
                            'optional' => true,
                        ])
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                        @includeIf('admin.components.form.input', [
                            'type' => 'text',
                            'fieldname' => 'address[post_code]',
                            'label' => 'ZIP / Postal code',
                            'autocomplete' => 'post_code',
                            'optional' => true,
                        ])
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        @includeIf('admin.components.form.input', [
                            'type' => 'text',
                            'fieldname' => 'address[city]',
                            'label' => 'City',
                            'autocomplete' => 'city',
                            'optional' => true,
                        ])
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        @includeIf('admin.components.form.input', [
                            'type' => 'text',
                            'fieldname' => 'address[state]',
                            'label' => 'State / Province',
                            'autocomplete' => 'state',
                            'optional' => true,
                        ])
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        @includeIf('admin.components.form.select', [
                            'fieldname' => 'address[country_code]',
                            'label' => 'Country',
                            'values' => listOfCountries(),
                            'optional' => true,
                            'empty' => true,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>