<script lang="ts">
    import * as Card from "$lib/components/ui/card/index.js";

    let {items} = $props();
</script>

<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    {#each items as project}
        <Card.Root>
            <Card.Header>
                <Card.Title>{project.name}</Card.Title>
                <Card.Description>{project.description}</Card.Description>
            </Card.Header>
            <Card.Content>
                <p>Created by: {project.created_by}</p>
                <p>Created at: {project.created_at}</p>
            </Card.Content>
            <Card.Footer>
                <p>Project ID: {project.id}</p>
            </Card.Footer>
        </Card.Root>
    {/each}
</div>
