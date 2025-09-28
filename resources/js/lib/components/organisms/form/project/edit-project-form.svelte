<script lang="ts">
    import * as Dialog from "$lib/components/ui/dialog/index.js";
    import {Button, buttonVariants} from "$lib/components/ui/button/index.js";
    import {Input} from "$lib/components/ui/input/index.js";
    import {Label} from "$lib/components/ui/label/index.js";
    import {useForm, Form} from "@inertiajs/svelte";

    let {project} = $props();

    const form = useForm({
        name: project?.name ?? '',
        description: project?.description ?? ''
    });

    let modalClose = $state<HTMLButtonElement | null>(null);

    function handleSuccess() {
        modalClose?.click();
    }
</script>

<Dialog.Root>
    <Dialog.Trigger class={buttonVariants({ variant: "outline" })}>
        Edit project
    </Dialog.Trigger>
    <Dialog.Content class="sm:max-w-[425px]">
        <Dialog.Header>
            <Dialog.Title>Edit project</Dialog.Title>
            <Dialog.Description>
                Update the project name and description below.
            </Dialog.Description>
        </Dialog.Header>
        <Form
            action={`/dashboard/projects/${project.id}`}
            method="put"
            {form}
            class="grid gap-4 py-4"
            resetOnSuccess
            onSuccess={handleSuccess}
            let:processing
        >
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="name" class="text-right">Name</Label>
                <Input id="name" name="name" type="text" class="col-span-3" required bind:value={$form.name}/>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="description" class="text-right">Description</Label>
                <Input id="description" name="description" type="text" class="col-span-3" required
                       bind:value={$form.description}
                />
            </div>
            <Dialog.Footer>
                <Button type="submit" disabled={processing}>Save changes</Button>
                <Dialog.Close class="hidden">
                    <Button variant="outline" class="hidden" bind:ref={modalClose}>Close</Button>
                </Dialog.Close>
            </Dialog.Footer>
        </Form>
    </Dialog.Content>
</Dialog.Root>
