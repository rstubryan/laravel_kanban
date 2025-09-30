<script lang="ts">
    import * as Dialog from "$lib/components/ui/dialog/index.js";
    import {Button, buttonVariants} from "$lib/components/ui/button/index.js";
    import {Input} from "$lib/components/ui/input/index.js";
    import {Label} from "$lib/components/ui/label/index.js";
    import {Form} from "@inertiajs/svelte";

    let modalClose = $state<HTMLButtonElement | null>(null);

    function handleSuccess() {
        modalClose?.click();
    }
</script>

<Dialog.Root>
    <Dialog.Trigger class={buttonVariants({ variant: "outline" })}>
        Create new group
    </Dialog.Trigger>
    <Dialog.Content class="sm:max-w-[425px]">
        <Dialog.Header>
            <Dialog.Title>Create new group</Dialog.Title>
            <Dialog.Description>
                Enter the group name and description below.
            </Dialog.Description>
        </Dialog.Header>
        <Form
            action="/dashboard/groups"
            method="post"
            class="grid gap-4 py-4"
            resetOnSuccess
            onSuccess={handleSuccess}
            let:processing
        >
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="name" class="text-right">Name</Label>
                <Input id="name" name="name" class="col-span-3" required/>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="description" class="text-right">Description</Label>
                <Input id="description" name="description" class="col-span-3" required/>
            </div>
            <Dialog.Footer>
                <Button type="submit" disabled={processing}>Save changes</Button>
            </Dialog.Footer>
        </Form>
        <Dialog.Close class="hidden">
            <Button variant="outline" class="hidden" bind:ref={modalClose}>Close</Button>
        </Dialog.Close>
    </Dialog.Content>
</Dialog.Root>
