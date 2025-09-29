<script lang="ts">
    import * as Card from "$lib/components/ui/card/index.js";
    import {Button} from "$lib/components/ui/button";
    import {Link} from "@inertiajs/svelte";
    import ContentLayout from "$lib/layouts/content-layout.svelte";

    let {task} = $props();
</script>

<ContentLayout>
    <Card.Root>
        <Card.Header>
            <Card.Title>{task.data.title}</Card.Title>
            <Card.Description>{task.data.description}</Card.Description>
        </Card.Header>
        <Card.Content class="py-4">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Task ID:</span>
                    <span class="text-gray-500">{task.data.id}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Status:</span>
                    <span class="text-gray-500">{task.data.status}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Project:</span>
                    <span class="text-gray-500">{task.data.project}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Assigned To:</span>
                    <span class="text-gray-500">{task.data.assigned_to}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Due Date:</span>
                    <span class="text-gray-500">{task.data.due_date}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Created by:</span>
                    <span class="text-gray-500">{task.data.created_by}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Created at:</span>
                    <span class="text-gray-500">{task.data.created_at}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Updated at:</span>
                    <span class="text-gray-500">{task.data.updated_at}</span>
                </div>
            </div>
        </Card.Content>
        <Card.Footer class="flex gap-2">
            <Link href={`/dashboard/tasks`}>
                <Button class="w-full" variant="outline">
                    Back to Tasks
                </Button>
            </Link>
        </Card.Footer>
    </Card.Root>
</ContentLayout>
