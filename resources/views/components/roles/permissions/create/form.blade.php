<x-form.form-modal
    formCondition="showPermissionForm"
    :submitCondition="true"
    submitFun="addPermission"
    formId="addPermissionForm"
    formTitle="Add New Permission"
    submitIcon="plus"
    submitTag="Add Permission"
>
    <x-form.inputwire
        name="name"
        placeholder="New Permission"
        icon="rank"
    />
    <x-form.inputwire
        name="group"
        placeholder="group"
        icon="group"
    />
    <x-form.inputwire
        name="label"
        placeholder="Label"
        icon="tag"
    />
</x-form.form-modal>
