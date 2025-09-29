<script lang="ts">
    import * as Card from "$lib/components/ui/card/index.js";
    import * as AlertDialog from "$lib/components/ui/alert-dialog/index.js";
    import {Button} from "$lib/components/ui/button";
    import {Input} from "$lib/components/ui/input";
    import {Form, Link} from "@inertiajs/svelte";
    import EditIssueForm from "$lib/components/organisms/form/issue/edit-issue-form.svelte";

    let {items, tasks = [], users = []} = $props();

    let modalClose = $state<HTMLButtonElement | null>(null);

    function handleSuccess() {
        modalClose?.click();
    }
</script>

<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    {#each items as issue}
        <Card.Root>
            <Card.Header>
                <Card.Title>{issue.title}</Card.Title>
                <Card.Description>{issue.description ?? '-'}</Card.Description>
            </Card.Header>
            <Card.Content class="py-2">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">ID:</span>
                        <span class="text-gray-500">{issue.id}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Status:</span>
                        <span class="text-gray-500">{issue.status}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Task:</span>
                        <span class="text-gray-500">
                            {tasks.find(t => t.id === issue.task_id)?.title ?? '-'}
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Assigned To:</span>
                        <span class="text-gray-500">{issue.assigned_to ?? '-'}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Due Date:</span>
                        <span class="text-gray-500">{issue.due_date ?? '-'}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Created by:</span>
                        <span class="text-gray-500">
                            {users.find(u => u.id === issue.created_by)?.name ?? issue.created_by}
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Created at:</span>
                        <span class="text-gray-500">{issue.created_at}</span>
                    </div>
                </div>
            </Card.Content>
            <Card.Footer class="flex gap-2">
                <EditIssueForm issue={issue} tasks={tasks} users={users}/>
                <Link href={`/dashboard/issues/${issue.id}`}>
                    <Button class="w-full" variant="outline">
                        Show Issue
                    </Button>
                </Link>
                <AlertDialog.Root>
                    <AlertDialog.Trigger class="w-full">
                        <Button class="w-full">
                            Delete Issue
                        </Button>
                    </AlertDialog.Trigger>
                    <AlertDialog.Content>
                        <AlertDialog.Header>
                            <AlertDialog.Title>Are you absolutely sure?</AlertDialog.Title>
                            <AlertDialog.Description>
                                This action cannot be undone. This will permanently delete the <b>{issue.title}</b>
                                issue and remove all of its data.
                            </AlertDialog.Description>
                        </AlertDialog.Header>
                        <AlertDialog.Footer>
                            <AlertDialog.Cancel bind:ref={modalClose}>
                                Cancel
                            </AlertDialog.Cancel>
                            <Form
                                action={`/dashboard/issues/${issue.id}`}
                                method="post"
                                resetOnSuccess
                                onSuccess={handleSuccess}
                            >
                                <AlertDialog.Action type="submit">
                                    <Input type="hidden" name="_method" value="delete"/>
                                    Delete
                                </AlertDialog.Action>
                            </Form>
                        </AlertDialog.Footer>
                    </AlertDialog.Content>
                </AlertDialog.Root>
            </Card.Footer>
        </Card.Root>
    {/each}
</div>
