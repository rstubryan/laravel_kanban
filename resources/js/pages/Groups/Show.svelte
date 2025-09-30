<script lang="ts">
    import * as Card from "$lib/components/ui/card/index.js";
    import {Button} from "$lib/components/ui/button";
    import {Link} from "@inertiajs/svelte";
    import ContentLayout from "$lib/layouts/content-layout.svelte";

    let {group} = $props();
</script>

<ContentLayout>
    <Card.Root>
        <Card.Header>
            <Card.Title>{group.name}</Card.Title>
            <Card.Description>{group.description}</Card.Description>
        </Card.Header>
        <Card.Content class="py-4">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Group ID:</span>
                    <span class="text-gray-500">{group.id}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Created by:</span>
                    <span class="text-gray-500">{group.created_by}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Created at:</span>
                    <span class="text-gray-500">{group.created_at}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-gray-700">Updated at:</span>
                    <span class="text-gray-500">{group.updated_at}</span>
                </div>
            </div>
        </Card.Content>
        <Card.Footer class="flex gap-2">
            <Link href={`/dashboard/groups`}>
                <Button class="w-full" variant="outline">
                    Back to Groups
                </Button>
            </Link>
        </Card.Footer>
    </Card.Root>
</ContentLayout>
