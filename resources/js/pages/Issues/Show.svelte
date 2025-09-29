<script lang="ts">
    import * as Card from "$lib/components/ui/card/index.js";
    import {Button} from "$lib/components/ui/button";
    import {Link} from "@inertiajs/svelte";
    import ContentLayout from "$lib/layouts/content-layout.svelte";

    let {issue, tasks = [], users = []} = $props();
</script>

<ContentLayout>
    <Card.Root>
        <Card.Header>
            <Card.Title>{issue.title}</Card.Title>
            <Card.Description>{issue.description ?? '-'}</Card.Description>
        </Card.Header>
        <Card.Content class="py-4">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Issue ID:</span>
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
                    <span class="text-gray-500">
                        {users.find(u => u.id === issue.assigned_to)?.name ?? '-'}
                    </span>
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
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Updated at:</span>
                    <span class="text-gray-500">{issue.updated_at}</span>
                </div>
            </div>
        </Card.Content>
        <Card.Footer class="flex gap-2">
            <Link href={`/dashboard/issues`}>
                <Button class="w-full" variant="outline">
                    Back to Issues
                </Button>
            </Link>
        </Card.Footer>
    </Card.Root>
</ContentLayout>
