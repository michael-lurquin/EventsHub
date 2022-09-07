<aside>
    @includeIf('admin.tenants.form.tabs')
    <div class="mx-auto max-w-7xl py-6">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            @includeWhen($errors->isNotEmpty() || session('success'), 'admin.layouts.flash')
            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-5 gap-6">
                    <div class="col-span-5 sm:col-span-2">
                        @includeIf('admin.components.form.input', [
                            'type' => 'text',
                            'fieldname' => 'name',
                            'label' => 'Name',
                            'placeholder' => 'My company',
                        ])
                    </div>
                    <div class="col-span-5 sm:col-span-3">
                        @includeIf('admin.components.form.input', [
                            'type' => 'text',
                            'fieldname' => 'subdomain',
                            'label' => 'Subdomain',
                            'placeholder' => 'my-company',
                            'prefix' => 'https://',
                            'suffix' => config('session.domain'),
                        ])
                    </div>
                    <div class="col-span-5 sm:col-span-3">
                        @includeIf('admin.components.form.input', [
                            'type' => 'email',
                            'fieldname' => 'email',
                            'label' => 'Email address',
                            'placeholder' => 'you@example.com',
                            'autocomplete' => 'email',
                        ])
                    </div>
                </div>

                @includeIf('admin.components.form.file', [
                    'fieldname' => 'logo_url',
                    'label' => 'Logo',
                    'file' => !empty($tenant) ? $tenant->logo_url : null,
                    'optional' => true,
                ])

                @includeIf('admin.components.form.textarea', [
                    'fieldname' => 'about',
                    'label' => 'About',
                    'placeholder' => 'About my company',
                    'help' => 'Brief description for your company.',
                    'optional' => true,
                    'rows' => 5
                ])

                @includeIf('admin.components.form.input', [
                    'type' => 'text',
                    'fieldname' => 'url',
                    'label' => 'URL',
                    'placeholder' => 'https://my-company.com',
                    'autocomplete' => 'off',
                    'optional' => true,
                    'leftIcon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />',
                ])
            </div>
        </div>
    </div>
</aside>