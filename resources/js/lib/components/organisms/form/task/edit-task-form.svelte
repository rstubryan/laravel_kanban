<script lang="ts">
    import * as Dialog from "$lib/components/ui/dialog/index.js";
    import * as Select from "$lib/components/ui/select/index.js";
    import {Button, buttonVariants} from "$lib/components/ui/button/index.js";
    import {Input} from "$lib/components/ui/input/index.js";
    import {Label} from "$lib/components/ui/label/index.js";
    import {useForm, Form} from "@inertiajs/svelte";

    let {task, users = [], projects = []} = $props();

    const statusOptions = [
        {value: "pending", label: "Pending"},
        {value: "in_progress", label: "In Progress"},
        {value: "completed", label: "Completed"}
    ];

    const form = useForm({
        title: task?.title ?? '',
        description: task?.description ?? '',
        status: task?.status ? task.status.toLowerCase().replace(' ', '_') : 'pending',
        project_id: task?.project_id ? String(task.project_id) : '',
        due_date: task?.due_date ?? '',
        assigned_to: task?.assigned_to_id ? String(task.assigned_to_id) : '',
    });

    let modalClose = $state<HTMLButtonElement | null>(null);

    function handleSuccess() {
        modalClose?.click();
    }
</script>

<Dialog.Root>
    <Dialog.Trigger class={buttonVariants({ variant: "outline" })}>
        Edit task
    </Dialog.Trigger>
    <Dialog.Content class="sm:max-w-[425px]">
        <Dialog.Header>
            <Dialog.Title>Edit task</Dialog.Title>
            <Dialog.Description>
                Update the task details below.
            </Dialog.Description>
        </Dialog.Header>
        <Form
            action={`/dashboard/tasks/${task.id}`}
            method="put"
            {form}
            class="grid gap-4 py-4"
            resetOnSuccess
            onSuccess={handleSuccess}
            let:processing
        >
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="title" class="text-right">Title</Label>
                <Input id="title" name="title" type="text" class="col-span-3" required bind:value={$form.title}/>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="description" class="text-right">Description</Label>
                <Input id="description" name="description" type="text" class="col-span-3"
                       bind:value={$form.description}/>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label class="text-right">Status</Label>
                <div class="col-span-3">
                    <Select.Root
                        type="single"
                        bind:value={$form.status}
                        name="status"
                        required
                    >
                        <Select.Trigger class="w-full">
                            {statusOptions.find(o => o.value === $form.status)?.label ?? "Select status"}
                        </Select.Trigger>
                        <Select.Content>
                            {#each statusOptions as option}
                                <Select.Item value={option.value}>{option.label}</Select.Item>
                            {/each}
                        </Select.Content>
                    </Select.Root>
                </div>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label class="text-right">Project</Label>
                <div class="col-span-3">
                    <Select.Root
                        type="single"
                        bind:value={$form.project_id}
                        name="project_id"
                        required
                    >
                        <Select.Trigger class="w-full">
                            {projects.find(p => String(p.id) === $form.project_id)?.name ?? "Select project"}
                        </Select.Trigger>
                        <Select.Content>
                            {#each projects as project}
                                <Select.Item value={String(project.id)}>{project.name}</Select.Item>
                            {/each}
                        </Select.Content>
                    </Select.Root>
                </div>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="due_date" class="text-right">Due Date</Label>
                <Input id="due_date" name="due_date" type="date" class="col-span-3" bind:value={$form.due_date}/>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label class="text-right">Assigned To</Label>
                <div class="col-span-3">
                    <Select.Root
                        type="single"
                        bind:value={$form.assigned_to}
                        name="assigned_to"
                    >
                        <Select.Trigger class="w-full">
                            {users.find(u => String(u.id) === $form.assigned_to)?.name ?? "Select user"}
                        </Select.Trigger>
                        <Select.Content>
                            {#each users as user}
                                <Select.Item value={String(user.id)}>{user.name}</Select.Item>
                            {/each}
                        </Select.Content>
                    </Select.Root>
                </div>
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
