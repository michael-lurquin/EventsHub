<aside>
    @includeIf('admin.tenants.form.tabs')
    <div class="mx-auto max-w-7xl py-6">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            @includeWhen($errors->isNotEmpty() || session('success'), 'admin.layouts.flash')
            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                @includeIf('admin.components.form.select', [
                    'fieldname' => 'owner_id',
                    'label' => 'Owner',
                    'values' => $owners,
                ])
            </div>
        </div>
    </div>
</aside>