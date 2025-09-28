<script lang="ts">
    import * as Card from "$lib/components/ui/card/index.js";
    import * as AlertDialog from "$lib/components/ui/alert-dialog/index.js";
    import {Button} from "$lib/components/ui/button";
    import {Input} from "$lib/components/ui/input";
    import {Form, Link} from "@inertiajs/svelte";

    let {items} = $props();

    let modalClose = $state<HTMLButtonElement | null>(null);

    function handleSuccess() {
        modalClose?.click();
    }
</script>

<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    {#each items as project}
        <Card.Root>
            <Card.Header>
                <Card.Title>{project.name}</Card.Title>
                <Card.Description>{project.description}</Card.Description>
            </Card.Header>
            <Card.Content class="py-2">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">ID:</span>
                        <span class="text-gray-500">{project.id}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Created by:</span>
                        <span class="text-gray-500">{project.created_by}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Created at:</span>
                        <span class="text-gray-500">{project.created_at}</span>
                    </div>
                </div>
            </Card.Content>
            <Card.Footer class="flex gap-2">
                <Link href={`/dashboard/projects/${project.id}`}>
                    <Button class="w-full" variant="outline">
                        Show Project
                    </Button>
                </Link>
                <AlertDialog.Root>
                    <AlertDialog.Trigger class="w-full">
                        <Button class="w-full">
                            Delete Project
                        </Button>
                    </AlertDialog.Trigger>
                    <AlertDialog.Content>
                        <AlertDialog.Header>
                            <AlertDialog.Title>Are you absolutely sure?</AlertDialog.Title>
                            <AlertDialog.Description>
                                This action cannot be undone. This will permanently delete the <b>{project.name}</b>
                                project and remove all of its data.
                            </AlertDialog.Description>
                        </AlertDialog.Header>
                        <AlertDialog.Footer>
                            <AlertDialog.Cancel bind:ref={modalClose}>
                                Cancel
                            </AlertDialog.Cancel>
                            <Form
                                action={`/dashboard/projects/${project.id}`}
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
