<script lang="ts">
    import * as Dialog from "$lib/components/ui/dialog/index.js";
    import {Button, buttonVariants} from "$lib/components/ui/button/index.js";
    import {Input} from "$lib/components/ui/input/index.js";
    import {Label} from "$lib/components/ui/label/index.js";
    import {Form} from "@inertiajs/svelte";

    let {task, users = [], projects = []} = $props();

    const statusOptions = [
        {value: "pending", label: "Pending"},
        {value: "in_progress", label: "In Progress"},
        {value: "completed", label: "Completed"}
    ];

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
            resetOnSuccess
            setDefaultsOnSuccess
            onSuccess={handleSuccess}
            let:processing
            class="grid gap-4 py-4"
        >
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="title" class="text-right">Title</Label>
                <Input id="title" name="title" type="text" class="col-span-3" required value={task.title}/>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="description" class="text-right">Description</Label>
                <Input id="description" name="description" type="text" class="col-span-3" value={task.description}/>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label class="text-right">Status</Label>
                <div class="col-span-3">
                    <select
                        name="status"
                        class="w-full border rounded px-2 py-1"
                        required
                        value={task.status}
                    >
                        <option value="">Select status</option>
                        {#each statusOptions as option}
                            <option value={option.value}>{option.label}</option>
                        {/each}
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label class="text-right">Project</Label>
                <div class="col-span-3">
                    <select
                        name="project_id"
                        class="w-full border rounded px-2 py-1"
                        required
                        value={task.project_id}
                    >
                        <option value="">Select project</option>
                        {#each projects as project}
                            <option value={String(project.id)}
                                    selected={String(project.id) === task.project_id}>{project.name}</option>
                        {/each}
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label for="due_date" class="text-right">Due Date</Label>
                <Input id="due_date" name="due_date" type="date" class="col-span-3" value={task.due_date}/>
            </div>
            <div class="grid grid-cols-4 items-center gap-4">
                <Label class="text-right">Assigned To</Label>
                <div class="col-span-3">
                    <select
                        name="assigned_to"
                        class="w-full border rounded px-2 py-1"
                        value={task.assigned_to_id}
                    >
                        <option value="">Select user</option>
                        {#each users as user}
                            <option value={String(user.id)}
                                    selected={String(user.id) === task.assigned_to_id}>{user.name}</option>
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
