<script lang="ts">
    import * as Dialog from "$lib/components/ui/dialog/index.js";
    import {Button, buttonVariants} from "$lib/components/ui/button/index.js";
    import {Input} from "$lib/components/ui/input/index.js";
    import {Label} from "$lib/components/ui/label/index.js";
    import {Form} from "@inertiajs/svelte";

    let {issue, tasks = [], users = []} = $props();

    const statusOptions = [
        {value: "open", label: "Open"},
        {value: "in_progress", label: "In Progress"},
        {value: "resolved", label: "Resolved"},
        {value: "closed", label: "Closed"}
    ];

    let open = $state(false);

    let status = $state(issue?.status ? issue.status.toLowerCase().replace(' ', '_') : 'open');
    let task_id = $state(issue?.task_id ? String(issue.task_id) : '');
    let assigned_to = $state(issue?.assigned_to_id ? String(issue.assigned_to_id) : '');

    let modalClose = $state<HTMLButtonElement | null>(null);

    function handleSuccess() {
        modalClose?.click();
    }

    function resetState() {
        status = issue?.status ? issue.status.toLowerCase().replace(' ', '_') : 'open';
        task_id = issue?.task_id ? String(issue.task_id) : '';
        assigned_to = issue?.assigned_to_id ? String(issue.assigned_to_id) : '';
    }

    function handleOpenChange(val: boolean) {
        if (!val) resetState();
    }
</script>

<Dialog.Root bind:open={open} onOpenChange={handleOpenChange}>
    <Dialog.Trigger class={buttonVariants({ variant: "outline" })}>
        Edit issue
    </Dialog.Trigger>
    <Dialog.Content class="sm:max-w-[425px]">
        <Dialog.Header>
            <Dialog.Title>Edit issue</Dialog.Title>
            <Dialog.Description>
                Update the issue details below.
            </Dialog.Description>
        </Dialog.Header>
        <Form
            action={`/dashboard/issues/${issue.id}`}
            method="put"
            resetOnSuccess
            setDefaultsOnSuccess
            onSuccess={handleSuccess}
            let:processing
            class="grid gap-4 py-4"
        >
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="title" class="text-right">Title</Label>
                <Input id="title" name="title" class="col-span-3" required value={issue.title}/>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="description" class="text-right">Description</Label>
                <Input id="description" name="description" class="col-span-3" value={issue.description}/>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label class="text-right">Status</Label>
                <div class="col-span-3">
                    <select
                        name="status"
                        class="w-full border rounded px-2 py-1"
                        required
                        value={status}
                    >
                        {#each statusOptions as option}
                            <option value={option.value}>{option.label}</option>
                        {/each}
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label class="text-right">Task</Label>
                <div class="col-span-3">
                    <select
                        name="task_id"
                        class="w-full border rounded px-2 py-1"
                        value={task_id}
                    >
                        <option value="">Select task</option>
                        {#each tasks as task}
                            <option value={String(task.id)} selected={String(task.id) === task_id}>{task.title}</option>
                        {/each}
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="due_date" class="text-right">Due Date</Label>
                <Input id="due_date" name="due_date" type="date" class="col-span-3" value={issue.due_date}/>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label class="text-right">Assigned To</Label>
                <div class="col-span-3">
                    <select
                        name="assigned_to"
                        class="w-full border rounded px-2 py-1"
                        value={assigned_to}
                    >
                        <option value="">Select user</option>
                        {#each users as user}
                            <option value={String(user.id)}
                                    selected={String(user.id) === assigned_to}>{user.name}</option>
                        {/each}
                    </select>
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
