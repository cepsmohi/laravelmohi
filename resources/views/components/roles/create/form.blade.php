<x-form.form-modal
    formCondition="createRoleForm"
    :submitCondition="true"
    submitFun="addRole"
    formId="addRoleForm"
    formTitle="Add New Role"
    submitIcon="plus"
    submitTag="Add Role"
>
    <x-form.inputwire
        name="name"
        placeholder="New Role"
        icon="rank"
    />
    <x-form.inputwire
        name="label"
        placeholder="Label"
        icon="tag"
    />
</x-form.form-modal>
